
# Crimes et Délits

Cette application Laravel a été développée pour aider l'association **Nouveaux Propriétaires** à analyser et valoriser les données liées aux crimes et délits enregistrés par les services de police et de gendarmerie. L'objectif est de fournir un outil simple, efficace et évolutif pour aider les familles à choisir un cadre de vie sûr.

## Fonctionnalités

### Version 0 (V0)
- **Carte interactive** : Visualisation des crimes et délits par département pour l'année 2022 (utilisant une librairie comme Leaflet.js).
- **Filtres avancés** :
  - Filtrage des données par année.
  - Filtrage par motif de crimes et délits.
- **Graphiques** : Évolution des crimes et délits sur les neuf dernières années pour un département choisi.
- **Classement** : Classement des 15 départements les plus sûrs pour l'année 2023.

## Prérequis

- PHP >= 8.1
- Composer ([Guide d'installation](https://getcomposer.org/))
- Node.js et npm/yarn pour gérer les dépendances front-end

## Installation

1. Clonez le dépôt Git :
   ```bash
   git clone https://github.com/CorentinHuet/projet-hackathon
   cd projet-hackathon
   ```

2. Installez les dépendances back-end :
   ```bash
   composer install
   ```

3. Configurez l'environnement :
   - Copiez le fichier `.env.example` en `.env` :
     ```bash
     cp .env.example .env
     ```

4. Générez la clé d'application Laravel :
   ```bash
   php artisan key:generate
   ```

5. Exécutez les migrations pour créer les tables nécessaires :
   ```bash
   php artisan migrate
   ```

6. Installez les dépendances front-end et compilez les assets :
   ```bash
   npm install && npm run dev
   ```

7. Démarrez le serveur de développement :
   ```bash
   php artisan serve
   ```

L'application sera accessible sur [http://localhost:8000](http://localhost:8000).

## Données

Les données utilisées proviennent de [data.gouv.fr](https://www.data.gouv.fr/fr/datasets/bases-statistiques-communale-departementale-et-regionale-de-la-delinquance-enregistree-par-la-police-et-la-gendarmerie-nationales/). Ensuite, les données sont retransmises à mon API personnalisée afin d'optimiser les temps de réponse.
Lien de l'API : http://localhost:8000/api

## Structure de l'application

- **Page d'accueil** :
  - Classement des 15 départements les plus sûrs pour l'année 2023.
  - Évolution des crimes et délits sur les neuf dernières années pour un département choisi.
- **Carte interactive** :
  - Visualisation des crimes et délits pour l'année 2022.
  - **Filtres avancés** :
  - Filtrage des données par année.
  - Filtrage par motif de crimes et délits.

## Livrables

1. Code source disponible sur [GitHub].
2. Documentation technique dans ce README.
3. Vidéo de démonstration présentant les fonctionnalités principales (https://youtu.be/-TGW0W6_5S0).