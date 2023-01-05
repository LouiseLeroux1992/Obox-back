# J11

## Fix de dernière minute

modification /api/signup en /signup

## ToDoList

Création des controllers TodolistController et TagController

```bash
bc make:cont --no-template

 Choose a name for your controller class (e.g. VictoriousChefController):
 > Todolist

 created: src/Controller/TodolistController.php

           
  Success! 
           

 Next: Open your new controller class and add some pages!
student@teleporter:/var/www/html/apo/O-box$ bc make:cont --no-template 

 Choose a name for your controller class (e.g. VictoriousGnomeController):
 > Tag

 created: src/Controller/TagController.php

           
  Success!
  ```

Création des méthodes browse, read, et add du TodolistController

## modification de la propriété "username" de l'entité User en "name"

Modification de la propriété, du getter et du setter.

Pour mettre à jour la BDD :  

drop la database sur adminer
suppression des fichiers de migration pour tout mettre à jour avec une seule migration

```bash
bin/console doctrine:database:create
```

```bash
bin/console make:migration
```

```bash
bin/console doctrine:migrations:migrate
```

```bash
bin/console doctrine:fixtures:load
```
