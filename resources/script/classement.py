import os
from dotenv import load_dotenv
import requests
from bs4 import BeautifulSoup
import mysql.connector
from unidecode import unidecode

# Charger les variables d'environnements depuis le fichier .env
load_dotenv()

# Déterminer l'environnement
app_env = os.getenv("APP_ENV", "development")

# Charger la configuration de la base de données selon l'environnement
if app_env == "production":
    DB_HOST = os.getenv("DB_HOST_PROD")
    DB_PORT = int(os.getenv("DB_PORT_PROD", 3306))
    DB_NAME = os.getenv("DB_NAME_PROD")
    DB_USER = os.getenv("DB_USER_PROD")
    DB_PASSWORD = os.getenv("DB_PASSWORD_PROD")
else:
    DB_HOST = os.getenv("DB_HOST")
    DB_PORT = int(os.getenv("DB_PORT", 3306))
    DB_NAME = os.getenv("DB_DATABASE")
    DB_USER = os.getenv("DB_USERNAME")
    DB_PASSWORD = os.getenv("DB_PASSWORD")

def create_table_if_not_exists(cursor, table_name):
    cursor.execute('''
        CREATE TABLE IF NOT EXISTS {} (
            id INT AUTO_INCREMENT PRIMARY KEY,
            classement INT,
            joueur VARCHAR(255),
            points INT(11)
        )
    '''.format(table_name))

def chercher_points_et_position(nom_recherche, table):
    position = 0
    nom_recherche = unidecode(nom_recherche)
    for row in table.find_all('tr'):
        cells = row.find_all('td')
        position += 1
        if cells and len(cells) > 1 and nom_recherche in unidecode(cells[1].text.lower()):
            score_cell = row.find('td', {'class': 'rankScore'})
            if score_cell:
                points_trouves = int(score_cell.text.strip())
                return position, points_trouves

    return -1, None

def scrape_and_save(url, table_name):
    response = requests.get(url)
    soup = BeautifulSoup(response.text, 'html.parser')
    table = soup.find('table', {'id': 'RankingTable'})
    
    if table:
        resultats = []
        for nom in noms:
            position, points = chercher_points_et_position(nom.lower(), table)
            if points is not None:
                nom_capitalise = nom.title()
                resultats.append((position, nom_capitalise, points))

        resultats_tries = sorted(resultats, key=lambda x: x[0], reverse=False)

        db = mysql.connector.connect(
            host=DB_HOST,
            user=DB_USER,
            password=DB_PASSWORD,
            database=DB_NAME
        )

        cursor = db.cursor()
        create_table_if_not_exists(cursor, table_name)
        cursor.execute(f"DROP TABLE IF EXISTS {table_name}")

        cursor.execute(f'''CREATE TABLE {table_name} (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        classement INT,
                        joueur VARCHAR(255),
                        points INTEGER)''')

        for classement, nom, points in resultats_tries:
            classement -= 1
            cursor.execute(f"INSERT INTO {table_name} (classement, joueur, points) VALUES (%s, %s, %s)", (classement, nom, points))

        db.commit()
        db.close()

        print(f"Les résultats ont été enregistrés dans la base de données 'boal2619_test', table '{table_name}', triés par points décroissants avec les positions.")
    else:
        print("Tableau avec l'ID 'RankingTable' non trouvé sur la page.")

# Se connecter à la base de données pour récupérer les URL et les noms de table
db = mysql.connector.connect(
    host=DB_HOST,
    user=DB_USER,
    password=DB_PASSWORD,
    database=DB_NAME
)
cursor = db.cursor()
cursor.execute("SELECT url, table_name FROM scraping_urls")

# Récupérer les lignes de la table et appeler la fonction pour chaque entrée
for (url, table_name) in cursor.fetchall():
    # Lire les noms à partir du fichier texte
    with open('licencies.txt', 'r', encoding='utf-8') as file:
        noms = file.read().splitlines()

    scrape_and_save(url, table_name)

# Fermer la connexion à la base de données
db.close()
