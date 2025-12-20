<p align="center">
  <img src="https://bcj37.fr/uploads/img/a97fed9810c39a9270caead79d014450.png"
       alt="Logo BCJ37"
       width="180">
</p>


## 🏗️ Architecture / Schéma

### Architecture générale

Le projet **bcj37.fr** repose sur une architecture **MVC Laravel** classique, enrichie par un **front moderne** et un **panel d’administration dédié**.


---
### Administration (OpenAdmin)

Le back-office est **totalement isolé** du site public.
---

Caractéristiques :

- Authentification indépendante
- Accès restreints aux administrateurs
- Formulaires personnalisés
- Gestion de structures legacy
- Séparation stricte front / administration

---

### Front-end

Le front-end est basé sur **Vite + Tailwind CSS**, optimisé pour la performance.

- Blade Components (`<x-layout>`, `<x-cadre>`, `<x-title>`)
- Alpine.js pour les interactions légères
- CSS organisé par fonctionnalités
- Build optimisé pour la production

---

### APIs & flux de données

- **CueScore API**
  - Classements nationaux
  - Classements régionaux
  - Résultats de tournois
- **Facebook Graph API**
  - Publications Facebook intégrées
- **Matomo**
  - Statistiques de fréquentation
  - Analyse des usages

---

## 🔐 Sécurité & bonnes pratiques

### Sécurité backend

- Framework **Laravel 10** maintenu et sécurisé
- Protection CSRF activée par défaut
- Validation systématique des entrées utilisateur
- Accès administrateur protégé
- Authentification API via **Laravel Sanctum**

---

### Sécurité des données

- Aucune clé API exposée côté client
- Variables sensibles stockées dans `.env`
- Séparation stricte entre :
  - données publiques
  - données administratives
- Accès restreints aux fonctionnalités sensibles

---

### Bonnes pratiques de développement

- Respect strict de l’architecture MVC
- Logique métier séparée de l’affichage
- Helpers dédiés pour les traitements complexes
- Aucune logique métier lourde dans les vues
- Assets compilés via Vite
- Versionnement Git

---

### Bonnes pratiques OpenAdmin

- Back-office isolé du front public
- Gestion explicite des champs ignorés (`ignore()`)
- Mapping manuel pour colonnes legacy
- Aucune modification des schémas historiques
- Formulaires robustes malgré des noms de colonnes non standards

---

### Performance & maintenance

- Minification JS et CSS activée
- Sourcemaps désactivées en production
- CSS découpé par fonctionnalité
- Requêtes API maîtrisées
- Architecture modulaire facilitant la maintenance

---

### Analytics & conformité

- Utilisation de **Matomo** (auto-hébergé)
- Aucune dépendance à Google Analytics
- Respect de la vie privée des utilisateurs
- Outils de suivi adaptés à un contexte associatif
