import subprocess
import sys
print("Modules installés :")
subprocess.run([sys.executable, "-m", "pip", "list"])
import os
from dotenv import load_dotenv
import requests
from bs4 import BeautifulSoup
import mysql.connector
print(f"Python utilisé : {sys.executable}")

print("Chargement des variables d'environnement...")
load_dotenv()

app_env = os.getenv("APP_ENV", "development")
print(f"Environnement détecté : {app_env}")

# Choix des variables selon l'environnement
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

# Connexion MySQL
print("Connexion à la base de données...")
try:
    conn = mysql.connector.connect(
        host=DB_HOST,
        port=DB_PORT,
        user=DB_USER,
        password=DB_PASSWORD,
        database=DB_NAME
    )
    cursor = conn.cursor()
    print("Connexion réussie à la base de données.")
except mysql.connector.Error as err:
    print(f"Erreur de connexion MySQL : {err}")
    exit(1)

# Vérification de la table
print("Vérification de l'existence de la table 'licencies'...")
cursor.execute("""
    SELECT COUNT(*)
    FROM information_schema.tables
    WHERE table_schema = %s AND table_name = 'licencies'
""", (DB_NAME,))
table_exists = cursor.fetchone()[0]

if table_exists:
    print("La table existe, vidage en cours...")
    cursor.execute('TRUNCATE TABLE licencies')
else:
    print("Table inexistante, création en cours...")
    cursor.execute('''
        CREATE TABLE IF NOT EXISTS licencies (
            id INT AUTO_INCREMENT PRIMARY KEY,
            licence VARCHAR(255),
            nom VARCHAR(255),
            prenom VARCHAR(255),
            url VARCHAR(1000)
        )
    ''')

# URL source
url = "https://www.telemat.org/FFBI/sif/?num=&nom=&prenom=&club=15061&cs=4.4e8caa4669b605602da29fce0147c7038d4c&find=auto"
print(f"Téléchargement des données depuis : {url}")

try:
    response = requests.get(url)
    response.raise_for_status()
except requests.RequestException as e:
    print(f"Erreur lors de la récupération de la page : {e}")
    conn.close()
    exit(1)

soup = BeautifulSoup(response.content, 'html.parser')
table_div = soup.find('div', class_='liste')

if not table_div:
    print("La div avec la classe 'liste' n'a pas été trouvée.")
    conn.close()
    exit(1)

rows = table_div.find_all('tr')
print(f"{len(rows)} lignes trouvées. Début du traitement...")

total_inserted = 0

for row in rows:
    tds = row.find_all('td')
    if len(tds) >= 3:
        first_td = tds[0].find('a')
        if first_td:
            licence = first_td.text.strip()
            url = f"https://www.telemat.org/FFBI/sif/{first_td['href']}"
        else:
            licence = tds[0].text.strip()
            url = ""

        nom = tds[1].text.strip().title()
        prenom = tds[2].text.strip().title()

        cursor.execute('''
            INSERT INTO licencies (licence, nom, prenom, url)
            VALUES (%s, %s, %s, %s)
        ''', (licence, nom, prenom, url))

        print(f"Ajout : {prenom} {nom} ({licence})")
        total_inserted += 1

conn.commit()
print(f"Importation terminée. Total des licenciés insérés : {total_inserted}")

cursor.close()
conn.close()
