Projet Commum : EPI
========================

Dans le cadre d’un besoin d’amélioration de la plateforme EPI existante, nous nous sommes vu
attribuer la mission de créer une plateforme plus facile d’accès et plus intuitive que celle déjà
existante.

Cette nouvelle plateforme comportera des fonctionnalités permettant une communication simple et
efficace entre le corps enseignant et les étudiants de Paris 1. Les principales fonctionnalités retenues
pour y parvenir et qui doivent passer en priorité sont :
 * Le dépôt de cours de la part des enseignants, cours ensuite consultables par les étudiants
concernés
 * Le dépôt de TD / Projets / Exposé de la part des étudiants, qui pourront être consultés et
récupérés par les enseignants concernés.
 * La consultation de l’agenda des étudiants. Afin d’organiser au mieux la distribution de
travaux par les enseignants.


Configuration
--------------

Environnement requis pour faire fonctionner l'application :

  * Apache 2.4; 

  * PHP 7;

  * MySQL;
 
    ou 
   
  * Wamp/Wamp64 - Xampp
  
  
Installation
--------------

Cloner le projet à la racine de votre serveur (ex: /var/www/html, sur wamp64 : wamp64/www). 

    * En effectuant la commande : git clone https://github.com/yanntoque/epi.git
    
Une fois le clone effectué rendez-vous dans le dossier de l'application à l'aide de la commande : 

    * cd epi 
    
Puis effectuer cette commande afin de récupérer les dépendances : 

    * php composer.phar install 


Il vous sera demandé de renseigner les champs suivants :

    * database_host (localhost) : Appuyez sur Entrée sauf si votre hote diffère de localhost
    * database_port (null) : Appuyez sur Entrée sauf si le port est différent
    * database_name (epi) :  Appuyez sur Entrée
    * database_user (root) : Si root n'est pas votre user renseigner le 
    * database_password (null): Si vous n'avez pas de mot de passe tapez Entrée sinon saisissez le  
    * mailer_transport (smtp) : Appuyez sur Entrée
    * mailer_host (null) : Appuyez sur Entrée
    * mailer_user (null) : Appuyez sur Entrée
    * mailer_password : Appuyez sur Entrée
    * secret (ThisTokenIsNotSecretChangeIt):Appuyez sur Entrée
    

Le projet a besoin d'une base données nommée : epi 

Vous pouvez la télécharger depuis le lien suivant :  https://goo.gl/G2wXvn

Il suffira ensuite de créer une base de données avec le nom epi depuis phpmyadmin et importer le fichier téléchargé.

Une fois cela fait vous pouvez vous rendre à l'adresse : http://localhost/epi/web/login

La page de connexion doit s'afficher.

Comme vous pouvez le remarquer il faut se connecter. Il y a deux environnemnents disponible pour les utilisateurs selon leur rôle : 
    
   * Ceux qui ont le rôle : ROLE_ADMIN pourront accéder à l'interface d'administration 
    
   * Ceux qui les rôles : ROLE_TEACHER ou ROLE_STUDENT pourront accéder à l'interface de l'EPI 

Il y a des utilisateurs par défaut, vous devez utiliser leur identifiant pour accéder aux différents environnements.

| Roles          | Pseudo  | Mot de passe |
|----------------|---------|--------------|
| Administrateur | Gwenael | root         |
| Administrateur | Hermine | root         |
| Professeur     | Erwan   | root         |
| Professeur     | Isa     | root         |
| Étudiant       | Elon    | root         |
| Étudiant       | Victor  | root         |


 
   
   
