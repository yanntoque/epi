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

Cloner le projet à la racine de votre serveur (ex: /var/html/www , wamp64 : wamp64/www ).

Le projet a besoin d'une base données nommée : epi 

Vous pouvez la télécharger depuis le lien suivant :  https://goo.gl/hU33Qa

Il suffira ensuite de l'importer depuis phpmyadmin.

Une fois cela fait le vous pouvez vous rendre à l'adresse : http://localhost/epi/web/login

Comme vous pouvez le remarquer il faut se connecter. Il y a deux environnemnents disponible pour les utilisateurs selon leur rôle : 
    
   * Ceux qui ont le rôle : ROLE_ADMIN pourront accéder à l'interface d'administration 
    
   * Ceux qui les rôles : ROLE_TEACHER ou ROLE_STUDENT pourront accéder à l'interface de l'EPI 

Il y a des utilisateurs par défaut, vous devez utiliser leur identifiant pour accéder aux différents environnement.

   * Un administrateur dont le pseudo est Gwenael et le mot de passe root
   
   * Un professeur dont le pseudo est Erwan et le mot de passe root 
   

En utilisant le compte de Gwenael vous aurez accès aux fonctionnalités des administrateurs et avec celui d'Erwan celles de l'epi.


 
   
   
