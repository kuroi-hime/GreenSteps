# GreenSteps

GreenSteps est une application web, disponible en version mobile, qui aide les gens à s'occuper de leurs plantes et à réussir leurs plantations. Le but est de simplifier le jardinage pour tout le monde, même pour les débutants.

## Cahier des Charges :

1. Contexte:

Le projet GreenSteps est né d'une discussion avec mes amis sur les difficultés du jardinage. Nous avons remarqué que beaucoup de gens veulent cultiver leurs propres plantes à la maison, mais ils abandonnent souvent parce qu'ils manquent de connaissances.

L'objectif est de créer une plateforme créative et fonctionnelle permettant aux utilisateurs de parcourir et réussir leurs projets verts selon leurs besoins.

Notre mission est de développer cette application en utilisant des langages ou des frameworks comme: HTML, CSS, Tailwind, Bootstrap, JS, React, Vue.js, PHP POO, Laravel et SQL et en passant par la conception UML(diagrammes de cas d'utilisations et de classe).

2. Identifications des acteurs:

Pour que l'application soit sécurisée et personnalisée, nous distinguons trois types d'acteurs:

- Utilisateur Non-identifié (Visiteur).

- Utilisateur Identifié (Jardinier).

- Administrateur.

3. Analyse fonctionnelle

- En tant qu’apprenant, je veux planifier mes tâches, suivre leur avancement et organiser la progression via GitHub Projects, afin d’améliorer la gestion du temps du développement.
- En tant que concepteur, je vais dessiner la structure Zoning des pages.
- En tant que concepteur, je vais créer des Wireframes pour montrer comment les pages seront organisées.
- En tant que concepteur, je vais faire les Maquettes pour les écrans d’ordinateur et pour les téléphones, pour que le site soit facile à utiliser partout.
- En tant que concepteur, je vais créer un Prototype, une version test du site
- En tant que développeur Front-End, je vais transformer les maquettes en pages web fonctionnelles.
- En tant que développeur Front-End, je vais m’assurer que le site soit joli, fonctionnel, et s’adapte bien à tous les écrans (Desktop / Smartphone).
- En tant que développeur Front-End, je vais suivre les bonnes règles du web et valider le code avec le service W3C.
- En tant que développeur Front-End, je vais publier le site sur GitHub Pages
- En tant que développeur Back-End, je vais coder les fonctionnalitées ci-dessous.
- En tant que visiteur, je peux m'inscrire à tout moment.
- En tant que visiteur, je peux consulter les différentes catégories des plantes.
- En tant que visiteur, je veux rechercher une plante par son nom afin de trouver rapidement des informations sur elle.
- En tant que visiteur, je peux afficher les détails d'une plante spécifique.
- En tant qu'utilisateur, je veux créer un compte afin de sauvegarder mes plantes préférées.
- En tant qu'utilisateur, je veux ajouter une plante à "Mon Jardin" afin de suivre sa croissance personnellement.
- En tant qu'utilisateur, je peux lire les étapes de plantation afin de comprendre comment cultiver une plante spécifique.
- En tant qu'administrateur, je veux ajouter une nouvelle fiche de plante afin d'enrichir le catalogue de l'application.
- En tant qu'administrateur, je veux modifier ou supprimer une information erronée afin de garantir la qualité des conseils donnés aux utilisateurs.
- En tant qu'administrateur, je veux gérer les catégories des plantes ainsi que leurs étapes de plantations.
-En tant qu'administrateur, je peux gérer les jardiniers et les commentaires.

* Bonus:
- En tant qu'utilisateur, je peux consulter le calendrier de plantation afin de savoir quelles plantes je peux faire pousser ce mois-ci.
- En tant qu'utilisateur, je veux recevoir une notification d'arrosage afin d'éviter que mes plantes ne meurent par oubli.

4. Dictionnaire des données :

- Table : role
    * id_role : Identifiant unique de le rôle.
    * nom_role : Nom du rôle (pour ce moment: 'jardinier', 'admin') qui définit les droits d'accès au site.

- Table : utilisateurs
    * id_user : Identifiant unique de l'utilisateur.
    * nom_user : Nom ou pseudonyme de l'utilisateur.
    * email : Adresse email (doit être unique pour la connexion).
    * password : Mot de passe sécurisé (haché).
    * date_inscription : Date et heure de création du compte.
    * role_id : Référence au rôle concerné.

- Table : categories
    * id_categorie : Identifiant unique de la catégorie.
    * nom_categorie : Nom de la catégorie (ex: Légumes, Fleurs).
    * description_cat : Brève description du type de plantes dans cette catégorie.

- Table : plantes
    * id_plante : Identifiant unique de la plante.
    * nom_commun : Nom courant de la plante (ex: Menthe).
    * nom_scientifique : Nom botanique en latin.
    * description_plate: Informations générales sur la plante.
    * mois_plantation : Chiffre de 1 à 12 représentant le mois idéal de plantation.
    * frequence_arrosage : Nombre de jours recommandé entre deux arrosages.
    * categorie_id : Référence à la catégorie concernée.

- Table : images
    * id_image : Identifiant unique de l'image.
    * image_url : Lien ou chemin vers la photo de la plante.

- Table : etapes_plantation
    * id_etape : Identifiant unique de l'étape.
    * plante_id : Référence à la plante concernée.
    * ordre : Numéro d'ordre de l'étape (1, 2, 3...).
    * instruction : Texte expliquant ce qu'il faut faire à cette étape.

- Table : mon_jardin
    * id_suivi : Identifiant unique du suivi.
    * user_id : Référence à l'utilisateur propriétaire.
    * plante_id : Référence à la plante ajoutée au jardin.
    * date_ajout : Date à laquelle l'utilisateur a ajouté la plante.
    * dernier_arrosage : Date du dernier arrosage enregistré par l'utilisateur.

- Table : commentaires
    * id_com : Identifiant unique du commentaire.
    * user_id : Référence à l'auteur du commentaire.
    * plante_id : Référence à la plante commentée.
    * contenu : Le texte du message laissé par l'utilisateur.
    * date_commentaire : Date de publication du commentaire.

5. Design et Ergonomie (UX/UI)
- Charte graphique : 
    * Couleurs principales
    * typographies.

- Technologies :
    * Blade(Fontend).
    * Laravel(Backend).
    * MySQL(BDD).

6. Planning et Livrables

Phase 1 : Conception et Schématisation.

Phase 2 : Développement Frontend.

Phase 3 : Développement Backend.

Phase 4 : Tests et Déploiement sur GitHub pages.

## Bibliothèques :
Breeze :
```Bash

```
Blade :
```Bash
composer require ddfsn/blade-components
php artisan vendor:publish --tag=blade-components-config
```