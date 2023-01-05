# J7 - création du projet symfony

## Installation des packages

```bash
composer create-project symfony/skeleton:"^5.4" O-box
```

```bash
mv O-box/* O-box/.* .
```

```bash
composer require annotations
```

```bash
composer require --dev symfony/profiler-pack
```

```bash
composer require symfony/asset
```

```bash
composer require --dev vardumper
```

```bash
composer require --dev symfony/debug-bundle
```

```bash
composer require --dev symfony/maker-bundle
```

```bash
composer require symfony/orm-pack
...
 doctrine/doctrine-bundle  instructions:

  * Modify your DATABASE_URL config in .env

  * Configure the driver (postgresql) and
    server_version (14) in config/packages/doctrine.yaml
```

```bash
composer require --dev symfony/maker-bundle
```

```bash
composer require --dev orm-fixtures
```

```bash
composer require fakerphp/faker
```

```bash
composer require symfony/form
```

```bash
composer require form validator
```

```bash
composer require symfony/validator doctrine/annotations
```

```bash
composer require security-csrf 
```

```bash
composer require symfony/intl
```

```bash
composer require security
```

```bash
composer require symfony/http-client
```

```bash
composer require symfony/serializer
```

```bash
composer require lexik/jwt-authentication-bundle
```

```bash
composer require nelmio/cors-bundle
```

```bash
composer req phpunit --dev
```

```bash
composer require twig
```

## Configuration de l'environnement de dev

Dans le fichier .env :
Modification de DATABASE_URL en :

```bash
DATABASE_URL="mysql://obox:obox@127.0.0.1:3306/obox?serverVersion=mariadb-10.3.25"
```

Création d'un fichier .env.local contenant :

```bash
APP_ENV=dev
```

## Création de user et authenticator

```bash
bin/console make:user
The name of the security user class (e.g. User) [User]:
 > 

 Do you want to store user data in the database (via Doctrine)? (yes/no) [yes]:
 > 

 Enter a property name that will be the unique "display" name for the user (e.g. email, username, uuid) [email]:
 > 

 Will this app need to hash/check user passwords? Choose No if passwords are not needed or will be checked/hashed by some other system (e.g. a single sign-on server).

 Does this app need to hash/check user passwords? (yes/no) [yes]:
 > 

 created: src/Entity/User.php
 created: src/Repository/UserRepository.php
 updated: src/Entity/User.php
 updated: config/packages/security.yaml

           
  Success! 
           

 Next Steps:
   - Review your new App\Entity\User class.
   - Use make:entity to add more fields to your User entity and then run make:migration.
   - Create a way to authenticate! See https://symfony.com/doc/current/security.html
```

```bash
bin/console make:auth

 What style of authentication do you want? [Empty authenticator]:
  [0] Empty authenticator
  [1] Login form authenticator
 > 1

 The class name of the authenticator to create (e.g. AppCustomAuthenticator):
 > Obox

 Choose a name for the controller class (e.g. SecurityController) [SecurityController]:
 > 

 Do you want to generate a '/logout' URL? (yes/no) [yes]:
 > 

 created: src/Security/OboxAuthenticator.php
 updated: config/packages/security.yaml
 created: src/Controller/SecurityController.php
 created: templates/security/login.html.twig

           
  Success! 
           

 Next:
 - Customize your new authenticator.
 - Finish the redirect "TODO" in the App\Security\OboxAuthenticator::onAuthenticationSuccess() method.
 - Review & adapt the login template: templates/security/login.html.twig.
 ```

## Création des entités

### Entity Article

```bash
bin/console make:entity

 Class name of the entity to create or update (e.g. VictoriousChef):
 > Article

 created: src/Entity/Article.php
 created: src/Repository/ArticleRepository.php
 
 Entity generated! Now let's add some fields!
 You can always add more fields later manually or by re-running this command.

 New property name (press <return> to stop adding fields):
 > title

 Field type (enter ? to see all types) [string]:
 > 

 Field length [255]:
 > 

 Can this field be null in the database (nullable) (yes/no) [no]:
 > 

 updated: src/Entity/Article.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > slug 

 Field type (enter ? to see all types) [string]:
 > 

 Field length [255]:
 > 

 Can this field be null in the database (nullable) (yes/no) [no]:
 > 

 updated: src/Entity/Article.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > summary

 Field type (enter ? to see all types) [string]:
 > text

 Can this field be null in the database (nullable) (yes/no) [no]:
 > 

 updated: src/Entity/Article.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > content

 Field type (enter ? to see all types) [string]:
 > text

 Can this field be null in the database (nullable) (yes/no) [no]:
 > 

 updated: src/Entity/Article.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > image

 Field type (enter ? to see all types) [string]:
 > 

 Field length [255]:
 > 

 Can this field be null in the database (nullable) (yes/no) [no]:
 > yes

 updated: src/Entity/Article.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > 


           
  Success! 
           

 Next: When you're ready, create a migration with php bin/console make:migration
 ```

Même procédé pour créer les entités Theme, ReserveTask, Tag, Task, Timer, modifier le User pour rajouter le username.

Pour la propriété $done de Task : création d'un construct afin de définir automatiquement la valeur à "false" à la création de d'une new Task.

Suite à demande du front : ajout d'une propriété "image_description" pour les tables Article et Theme afin d'y stocker le contenu de l'attribut Alt de la balise image.

## Mise en place des relations entre entités

Relation entre ReserveTask et Tag :

```bash
bc make:entity ReserveTask

 Your entity already exists! So let's add some new fields!

 New property name (press <return> to stop adding fields):
 > tag

 Field type (enter ? to see all types) [string]:
 > relation

 What class should this entity be related to?:
 > Tag

What type of relationship is this?
 ------------ ---------------------------------------------------------------------- 
  Type         Description                                                           
 ------------ ---------------------------------------------------------------------- 
  ManyToOne    Each ReserveTask relates to (has) one Tag.                            
               Each Tag can relate to (can have) many ReserveTask objects            
                                                                                     
  OneToMany    Each ReserveTask can relate to (can have) many Tag objects.           
               Each Tag relates to (has) one ReserveTask                             
                                                                                     
  ManyToMany   Each ReserveTask can relate to (can have) many Tag objects.           
               Each Tag can also relate to (can also have) many ReserveTask objects  
                                                                                     
  OneToOne     Each ReserveTask relates to (has) exactly one Tag.                    
               Each Tag also relates to (has) exactly one ReserveTask.               
 ------------ ---------------------------------------------------------------------- 

 Relation type? [ManyToOne, OneToMany, ManyToMany, OneToOne]:
 > ManyToOne

 Is the ReserveTask.tag property allowed to be null (nullable)? (yes/no) [yes]:
 > no

 Do you want to add a new property to Tag so that you can access/update ReserveTask objects from it - e.g. $tag->getReserveTasks()? (yes/no) [yes]:
 > yes

 A new property will also be added to the Tag class so that you can access the related ReserveTask objects from it.

 New field name inside Tag [reserveTasks]:
 > 

 Do you want to activate orphanRemoval on your relationship?
 A ReserveTask is "orphaned" when it is removed from its related Tag.
 e.g. $tag->removeReserveTask($reserveTask)
 
 NOTE: If a ReserveTask may *change* from one Tag to another, answer "no".

 Do you want to automatically delete orphaned App\Entity\ReserveTask objects (orphanRemoval)? (yes/no) [no]:
 > no

 updated: src/Entity/ReserveTask.php
 updated: src/Entity/Tag.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > 


           
  Success! 
           

 Next: When you're ready, create a migration with php bin/console make:migration
 ```

Relation entre Task et Tag :

```bash
bc make:entity Task

 Your entity already exists! So let's add some new fields!

 New property name (press <return> to stop adding fields):
 > tag

 Field type (enter ? to see all types) [string]:
 > relation

 What class should this entity be related to?:
 > Tag

What type of relationship is this?
 ------------ --------------------------------------------------------------- 
  Type         Description                                                    
 ------------ --------------------------------------------------------------- 
  ManyToOne    Each Task relates to (has) one Tag.                            
               Each Tag can relate to (can have) many Task objects            
                                                                              
  OneToMany    Each Task can relate to (can have) many Tag objects.           
               Each Tag relates to (has) one Task                             
                                                                              
  ManyToMany   Each Task can relate to (can have) many Tag objects.           
               Each Tag can also relate to (can also have) many Task objects  
                                                                              
  OneToOne     Each Task relates to (has) exactly one Tag.                    
               Each Tag also relates to (has) exactly one Task.               
 ------------ --------------------------------------------------------------- 

 Relation type? [ManyToOne, OneToMany, ManyToMany, OneToOne]:
 > ManyToOne

 Is the Task.tag property allowed to be null (nullable)? (yes/no) [yes]:
 > yes

 Do you want to add a new property to Tag so that you can access/update Task objects from it - e.g. $tag->getTasks()? (yes/no) [yes]:
 > yes

 A new property will also be added to the Tag class so that you can access the related Task objects from it.

 New field name inside Tag [tasks]:
 > 

 updated: src/Entity/Task.php
 updated: src/Entity/Tag.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > 


           
  Success! 
           

 Next: When you're ready, create a migration with php bin/console make:migration
```

Relation entre Task et User :

```bash
bin/console make:entity Task

 Your entity already exists! So let's add some new fields!

 New property name (press <return> to stop adding fields):
 > user

 Field type (enter ? to see all types) [string]:
 > relation

 What class should this entity be related to?:
 > User

What type of relationship is this?
 ------------ ---------------------------------------------------------------- 
  Type         Description                                                     
 ------------ ---------------------------------------------------------------- 
  ManyToOne    Each Task relates to (has) one User.                            
               Each User can relate to (can have) many Task objects            
                                                                               
  OneToMany    Each Task can relate to (can have) many User objects.           
               Each User relates to (has) one Task                             
                                                                               
  ManyToMany   Each Task can relate to (can have) many User objects.           
               Each User can also relate to (can also have) many Task objects  
                                                                               
  OneToOne     Each Task relates to (has) exactly one User.                    
               Each User also relates to (has) exactly one Task.               
 ------------ ---------------------------------------------------------------- 

 Relation type? [ManyToOne, OneToMany, ManyToMany, OneToOne]:
 > ManyToOne

 Is the Task.user property allowed to be null (nullable)? (yes/no) [yes]:
 > no

 Do you want to add a new property to User so that you can access/update Task objects from it - e.g. $user->getTasks()? (yes/no) [yes]:
 > yes

 A new property will also be added to the User class so that you can access the related Task objects from it.

 New field name inside User [tasks]:
 > 

 Do you want to activate orphanRemoval on your relationship?
 A Task is "orphaned" when it is removed from its related User.
 e.g. $user->removeTask($task)
 
 NOTE: If a Task may *change* from one User to another, answer "no".

 Do you want to automatically delete orphaned App\Entity\Task objects (orphanRemoval)? (yes/no) [no]:
 > yes

 updated: src/Entity/Task.php
 updated: src/Entity/User.php
```

Relation entre Timer et User : OneToOne

```bash
bc make:entity Timer

 Your entity already exists! So let's add some new fields!

 New property name (press <return> to stop adding fields):
 > user

 Field type (enter ? to see all types) [string]:
 > relation

 What class should this entity be related to?:
 > User

What type of relationship is this?
 ------------ ----------------------------------------------------------------- 
  Type         Description                                                      
 ------------ ----------------------------------------------------------------- 
  ManyToOne    Each Timer relates to (has) one User.                            
               Each User can relate to (can have) many Timer objects            
                                                                                
  OneToMany    Each Timer can relate to (can have) many User objects.           
               Each User relates to (has) one Timer                             
                                                                                
  ManyToMany   Each Timer can relate to (can have) many User objects.           
               Each User can also relate to (can also have) many Timer objects  
                                                                                
  OneToOne     Each Timer relates to (has) exactly one User.                    
               Each User also relates to (has) exactly one Timer.               
 ------------ ----------------------------------------------------------------- 

 Relation type? [ManyToOne, OneToMany, ManyToMany, OneToOne]:
 > OneToOne

 Is the Timer.user property allowed to be null (nullable)? (yes/no) [yes]:
 > no

 Do you want to add a new property to User so that you can access/update Timer objects from it - e.g. $user->getTimer()? (yes/no) [no]:
 > yes

 A new property will also be added to the User class so that you can access the related Timer object from it.

 New field name inside User [timer]:
 > 

 updated: src/Entity/Timer.php
 updated: src/Entity/User.php
```

Relation entre Tag et User : ManyToMany

```bash
bc make:entity User

 Your entity already exists! So let's add some new fields!

 New property name (press <return> to stop adding fields):
 > tags

 Field type (enter ? to see all types) [string]:
 > relation

 What class should this entity be related to?:
 > Tag

What type of relationship is this?
 ------------ --------------------------------------------------------------- 
  Type         Description                                                    
 ------------ --------------------------------------------------------------- 
  ManyToOne    Each User relates to (has) one Tag.                            
               Each Tag can relate to (can have) many User objects            
                                                                              
  OneToMany    Each User can relate to (can have) many Tag objects.           
               Each Tag relates to (has) one User                             
                                                                              
  ManyToMany   Each User can relate to (can have) many Tag objects.           
               Each Tag can also relate to (can also have) many User objects  
                                                                              
  OneToOne     Each User relates to (has) exactly one Tag.                    
               Each Tag also relates to (has) exactly one User.               
 ------------ --------------------------------------------------------------- 

 Relation type? [ManyToOne, OneToMany, ManyToMany, OneToOne]:
 > ManyToMany

 Do you want to add a new property to Tag so that you can access/update User objects from it - e.g. $tag->getUsers()? (yes/no) [yes]:
 > no

 updated: src/Entity/User.php
```

Relation entre Article et Theme : ManyToMany

```bash
bc make:entity Article

 Your entity already exists! So let's add some new fields!

 New property name (press <return> to stop adding fields):
 > themes

 Field type (enter ? to see all types) [string]:
 > relation

 What class should this entity be related to?:
 > Theme

What type of relationship is this?
 ------------ -------------------------------------------------------------------- 
  Type         Description                                                         
 ------------ -------------------------------------------------------------------- 
  ManyToOne    Each Article relates to (has) one Theme.                            
               Each Theme can relate to (can have) many Article objects            
                                                                                   
  OneToMany    Each Article can relate to (can have) many Theme objects.           
               Each Theme relates to (has) one Article                             
                                                                                   
  ManyToMany   Each Article can relate to (can have) many Theme objects.           
               Each Theme can also relate to (can also have) many Article objects  
                                                                                   
  OneToOne     Each Article relates to (has) exactly one Theme.                    
               Each Theme also relates to (has) exactly one Article.               
 ------------ -------------------------------------------------------------------- 

 Relation type? [ManyToOne, OneToMany, ManyToMany, OneToOne]:
 > ManyToMany

 Do you want to add a new property to Theme so that you can access/update Article objects from it - e.g. $theme->getArticles()? (yes/no) [yes]:
 > yes

 A new property will also be added to the Theme class so that you can access the related Article objects from it.

 New field name inside Theme [articles]:
 > 

 updated: src/Entity/Article.php
 updated: src/Entity/Theme.php
```

## Création de la base de données

Sur Adminer : création d'un utilisateur ayant le username et le mdp indiqués dans le .env et lui octroyer les droits d'accès à une BDD nommée obox.

```bash
bc doctrine:database:create
Created database `obox` for connection named default
```

```bash
bc make:migration


           
  Success! 
           

 Next: Review the new migration "migrations/Version20221206152600.php"
 Then: Run the migration with php bin/console doctrine:migrations:migrate
 See https://symfony.com/doc/current/bundles/DoctrineMigrationsBundle/index.html
 ```

Revue de la migration et quelques modifications : LONGTEXT en TEXT pour Article.summary par exemple, et done TINYINT(1) en done TINYINT(0) pour tenter le default false ainsi.

```bash
bc doctrine:migrations:migrate

 WARNING! You are about to execute a migration in database "obox" that could result in schema changes and data loss. Are you sure you wish to continue? (yes/no) [yes]:
 > yes

[notice] Migrating up to DoctrineMigrations\Version20221206152600
[notice] finished in 1545.2ms, used 22M memory, 1 migrations executed, 17 sql queries
```

```bash
bc doctrine:schema:validate

Mapping
-------

                                                                                                                        
 [OK] The mapping files are correct.                                                                                    
                                                                                                                        

Database
--------

                                                                                                                        
 [ERROR] The database schema is not in sync with the current mapping file.
 ```

Apparemment les changements que j'ai apportés à la migration ont posé problème.
J'ai créé une nouvelle migration, sans apporter aucune modification cette fois :

```bash
bc make:mig


           
  Success! 
           

 Next: Review the new migration "migrations/Version20221206155531.php"
 Then: Run the migration with php bin/console doctrine:migrations:migrate
 See https://symfony.com/doc/current/bundles/DoctrineMigrationsBundle/index.html
student@teleporter:/var/www/html/apo/O-box$ bc d:m:m

 WARNING! You are about to execute a migration in database "obox" that could result in schema changes and data loss. Are you sure you wish to continue? (yes/no) [yes]:
 > yes

[notice] Migrating up to DoctrineMigrations\Version20221206155531
[notice] finished in 337.8ms, used 22M memory, 1 migrations executed, 2 sql queries

student@teleporter:/var/www/html/apo/O-box$ bc d:s:v

Mapping
-------

                                                                                                                        
 [OK] The mapping files are correct.                                                                                    
                                                                                                                        

Database
--------

                                                                                                                        
 [OK] The database schema is in sync with the mapping files.
 ```
