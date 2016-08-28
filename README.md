priseEnMain
===========
Pensez a installer les dépendances via composer :  
right-click project -> composer -> install (dev)  

#Branch [Master](https://github.com/loicAtSimplon/priseEnMain_Symfony/tree/master)    

Mise en place du projet des news afin d'avoir un exemple de gestion de donnéees variables  
dont la persistance est effectuée en base de données  

Points abordés :  
    * generation d'entité via console  
    * création de la table via cnosole  
    * formulaire de création de news  
    * affichage de toutes les entrées de la table  

---

#Branch [DAO_en_service](https://github.com/loicAtSimplon/priseEnMain_Symfony/tree/DAO_en_service)  

Mise en place du pattern DAO avec un accent sur le polymorphisme et sa puissance conceptuelle  
Utilisation du DAO comme un service  

Points abordés :  
    * Implementation du CRUD  
    * Notions de classes Abstraites / Concretes  
    * Ajout des services et pourquoi   
    * Notions de binding (pour lancer la branche suivante) avec le "shadow" formulaire  
    * Overide de méthodes / Dépréciation   

#Branch [Mise_au_propre](https://github.com/loicAtSimplon/priseEnMain_Symfony/tree/Mise_au_propre)  

On met un peu au propre l'application en utilisant les bon champs,  
en faisant les bonnes verifications, en passant du temps sur le formulaire via twig  
et en élaguant un peu le code coté controlleur.

Points abordés :  
  * Review de code  
  * Elagage de code  
  * Choix des champs  
  * Schema Update  
  * |raw('html') avec twig
  * Validation des données (back)  
  * Verification des données (front)  
  * Jeux avec les dates
