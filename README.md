# Installation du projet O-box

Vérifier la version de mysql installée.Sur serveur distant, vérifier que Apache est installé.

Dans le terminal :

```bash
mysql -V
mysql  Ver 15.1 Distrib 10.3.34-MariaDB, for debian-linux-gnu (x86_64) using readline 5.2
```

On peut lire ici que la version de MariaDB est 10.3.34

Faire un git clone de la clé ssh du projet

```bash
git clone git@github.com:O-clock-Inca/projet-5-o-box-back.git
```

Entrer dans le dossier du projet

```bash
cd projet-5-o-box-back/
```

Installer tous les composants du projet

```bash
composer install
```

## Paramétrage de Doctrine

Créer un nouvel utilisateur mysql ayant les droits sur la base de donnée que l'on va créer
(il est possible de faire cela directement sur Adminer : créer un utilisateur nommé obox et lui octroyer tous les droits pour une bdd du même nom)

Créer un fichier .env.local à la racine du projet

Editer le fichier .env.local :

inscrire dans ce fichier les informations relatives à la connexion à la base de données, en remplaçant les champs username, mdp et dbname par les valeurs correspondantes (nom d'utilisateur et mot de passe mysql, puis nom de la base de données pour le projet), et la version de mysql notée au départ (ici : 10.3.34)

```text
DATABASE_URL="mysql://username:mdp@127.0.0.1:3306/dbname?serverVersion=mariadb-10.3.34"
```

exemple avec les champs remplis, pour un utilisateur obox avec le mdp obox connecté à la bdd obox :

```text
DATABASE_URL="mysql://obox:obox@127.0.0.1:3306/obox?serverVersion=mariadb-10.3.34"
```

## Création de la base de données obox

Dans le terminal :

Création de la BDD obox

```bash
bin/console doctrine:database:create
Created database `obox` for connection named default
```

Création des tables de la BDD

```bash
bin/console doctrine:migrations:migrate

 WARNING! You are about to execute a migration in database "obox" that could result in schema changes and data loss. Are you sure you wish to continue? (yes/no) [yes]:
 > yes

[notice] Migrating up to DoctrineMigrations\Version20221208095015
[notice] finished in 721ms, used 22M memory, 2 migrations executed, 18 sql queries
```

Créations des données fictives (en environnement de dev)

```bash
bin/console doctrine:fixtures:load

 Careful, database "obox" will be purged. Do you want to continue? (yes/no) [no]:
 > yes

   > purging database
   > loading App\DataFixtures\AppFixtures
```

Création des vraies données (en environnement de dev ou de prod)

```bash
bin/console app:data:load
```

## Mise en place des tokens JWT

```bash
php bin/console lexik:jwt:generate-keypair
```

## Utilisation du serveur php

dans le terminal :

```bash
php -S 0.0.0.0:8080 -t public
```

Il est maintenant possible d'accéder aux routes à partir de localhost:8080 dans le navigateur
