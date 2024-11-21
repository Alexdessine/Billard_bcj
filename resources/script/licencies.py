import os
from dotenv import load_dotenv
import requests
from bs4 import BeautifulSoup
import mysql.connector

# Charger les variables d'environnement depuis le fichier .env
load_dotenv()

# Déterminer l'environnement
app_env = os.getenv("APP_ENV", "development")

# Charger la configuration de la base de données selon l'environnement
if app_env == "production":
    DB_HOST = os.getenv("DB_HOST_PROD")
    DB_PORT = int(os.getenv("DB_PORT_PROD", 3306))
    DB_NAME = os.getenv("DB_DATABASE_PROD")
    DB_USER = os.getenv("DB_USERNAME_PROD")
    DB_PASSWORD = os.getenv("DB_PASSWORD_PROD")
else:
    DB_HOST = os.getenv("DB_HOST")
    DB_PORT = int(os.getenv("DB_PORT", 3306))
    DB_NAME = os.getenv("DB_DATABASE")
    DB_USER = os.getenv("DB_USERNAME")
    DB_PASSWORD = os.getenv("DB_PASSWORD")

# Informations d'identification MySQL
db_config = {
    'host': DB_HOST,
    'user': DB_USER,
    'password': DB_PASSWORD,
    'database': DB_NAME
}

conn = mysql.connector.connect(**db_config)
cursor = conn.cursor()

# Verifier si la table 'licencies' existe
cursor.execute("""
               SELECT COUNT(*)
               FROM information_schema.tables
               WHERE table_name = 'licencies'
               """)
table_exists = cursor.fetchone()[0]

if table_exists:
    print("La table 'licencies' existe, elle sera vidée.")
    cursor.execute('TRUNCATE TABLE licencies') #Vider la table si elle existe
else:
    print("La table 'licencies' n'existe pas, elle sera créée.")
    # Création de la table "licencies" si elle n'existe pas
    cursor.execute('''
        CREATE TABLE IF NOT EXISTS licencies (
            id INT AUTO_INCREMENT PRIMARY KEY,
            licence VARCHAR(255),
            nom VARCHAR(255),
            prenom VARCHAR(255),
            url VARCHAR(1000)
        )
    ''')

# Ouvrir le fichier texte pour enregistrer les données
with open('licencies.txt', 'w', encoding='utf-8') as f:

    # URL de la page
    url = "https://www.telemat.org/FFBI/sif/?num=&nom=&prenom=&club=15061&cs=4.4e8caa4669b605602da29fce0147c7038d4c&find=auto"

    # Envoyer une requête GET à l'URL
    response = requests.get(url)

    # Vérifier que la requête a réussie
    if response.status_code == 200:
        # Créer un objet BeautifulSoup avec le contenu de la reponse
        soup = BeautifulSoup(response.content, 'html.parser')

        # Trouver la div avec la class liste
        table_div = soup.find('div', class_='liste')

        # Si la div est trouvée
        if table_div:
            # Rechercher tous les tr dans la div
            rows = table_div.find_all('tr')

            # Parcourir chaque ligne de la table HTML
            for row in rows:
                # Trouver toutes les balises td dans la ligne
                tds = row.find_all('td')

                # Vérifier si la ligne contient au moins trois colonnes
                if len(tds) >= 3:
                    # Extraire les textes des trois premières colonnes
                    first_td = tds[0].find('a')
                    if first_td:
                        # Récupérer la licence et l'url
                        licence = first_td.text.strip()
                        url = f"https://www.telemat.org/FFBI/sif/{first_td['href']}"
                    else:
                        licence = first_td.text.strip()
                    nom = tds[1].text.strip().title()
                    prenom = tds[2].text.strip().title()

                    # Insertion dans la base de données MySQL
                    cursor.execute('''
                                INSERT INTO licencies (licence, nom, prenom, url)
                                VALUES (%s, %s, %s, %s)
                                ''', (licence, nom, prenom, url))
                    

                    f.write(f"{prenom} {nom}\n")

                    print(f"Colonne 1: {licence}, Colonne 2: {nom}, Colonne 3: {prenom}")
                    
                    # Sauvegarder les modifications
                    conn.commit()
        else:
            print("La div avec la classe 'liste' n'a pas été trouvée")
    else:
        print(f"Erreur lors de la récupération de la page : {response.status_code}")

    # fermer la connexion
    conn.close()