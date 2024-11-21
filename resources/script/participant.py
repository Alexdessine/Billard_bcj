import os
from dotenv import load_dotenv
import requests
from bs4 import BeautifulSoup
import pandas as pd
from unidecode import unidecode
import mysql.connector
import datetime

# Charger les variables d'environnement depuis le fichier .env
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
    DB_NAME = os.getenv("DB_NAME")
    DB_USER = os.getenv("DB_USER")
    DB_PASSWORD = os.getenv("DB_PASSWORD")

# Obtenir la date du jour
date_du_jour = datetime.datetime.now().strftime("%Y-%m-%d")

# Fontion pour récupérer les URLs et noms de table depuis la base de données
def get_urls_from_database():
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="laravel"
    )

    cursor = db.cursor()
    cursor.execute("SELECT url, table_name FROM scraping_urls_participation")

    urls_and_tables = cursor.fetchall()
    db.close

    return urls_and_tables

# Charger les noms à partir du fichier texte
with open('licencies.txt', 'r', encoding='utf-8') as file:
    noms_a_rechercher = [unidecode(line.strip().lower().title()) for line in file]

# Dictionnaire global pour stocker les résultats filtrés
resultats_globaux = {}

# Fonction pour extraire les informations à partir d'une URL
def extraire_informations(url, noms_a_rechercher):
    response = requests.get(url)
    soup = BeautifulSoup(response.content, 'html.parser')

    # Trouver la balise div avec la classe 'participants content'
    participants_div = soup.find('div', {'class', 'participants content'})

    if participants_div:
        # Trouver toutes les balises div avec la class 'desc'
        desc_divs = participants_div.find_all('div', {'class': 'desc'})

        # Récupérer les noms et les mettre en minuscules
        noms = [unidecode(desc_div.text.strip().lower().title()) for desc_div in desc_divs]

        # Filtrer les résultats pour conserver uniquement ceux présents dans le fichier licencies.txt
        noms_filtres = [nom for nom in noms if nom in noms_a_rechercher]

        # Imprimer le nombre de résultats trouvés
        print(f"Nombre de résultats trouvés pour la catégorie : {len(noms)}")

        return noms_filtres
    else:
        print(f"Aucune balise <div> avec la classe 'desc' trouvée à l'intérieur de la balise 'participants content'.")
        return []

# Récupérer les URLs et noms de table depuis la base de données
urls_and_tables = get_urls_from_database()

# Parcourir les URLs et noms de tables correspondants
# for url, categorie_name in urls.items():
for (url, categorie_name) in urls_and_tables:
    print(f"\nTraitement de l'URL: {url}")

    # Utiliser la fonction extraire_informations avec la liste des noms à rechercher
    resultats_categorie = extraire_informations(url, noms_a_rechercher)

    # Imprimer le nombre de résultats filtrés
    print(f"Nombre de résultats filtrés pour la catégorie '{categorie_name}': {len(resultats_categorie)}")
    print(f"Résultats filtrés : {resultats_categorie}")

    # Stocker les résultats filtrés dans le dictionnaire global
    resultats_globaux[categorie_name] = resultats_categorie

# Construire le nom du fichier Excel avec la date du jour
nom_fichier_excel = f'participants_{date_du_jour}.xlsx'

# Construire le chemin d'accès absolu pour le fichier Excel avec la date
chemin_fichier_excel = f'C:/laragon/www/bcjLaravel/storage/app/public/participants/{nom_fichier_excel}'

# Enregistrer les résultats dans un fichier Excel avec une feuille par catégorie
excel_writer = pd.ExcelWriter(chemin_fichier_excel, engine='xlsxwriter')

for categorie_name, resultats_categorie in resultats_globaux.items():
    # Créer un DataFrame à partir des résultats
    df = pd.DataFrame(resultats_categorie, columns=['Noms'])

    # Enregistrer le DataFrame dans une feuille Excel avec le nom de la catégorie correspondante
    df.to_excel(excel_writer, sheet_name=categorie_name, index=False)

excel_writer.close()
print(f'Les résultats ont été enregistrés dans {chemin_fichier_excel}.')
