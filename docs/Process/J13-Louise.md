# J13

## fixtures

Fin des fixtures, mise à jour du serveur distant.

## Backoffice todolist

Nécessaire pour pouvoir rajouter manuellement les ReserveTasks et les Tags sur le serveur distantp, puisque nous n'auront pas accès à l'interface graphique d'Adminer comme c'est le cas sur nos VM.

```bash
bc make:crud

 The class name of the entity to create CRUD (e.g. AgreeablePuppy):
 > Tag

 Choose a name for your controller class (e.g. TagController) [TagController]:
 > Backoffice\Tag

 Do you want to generate tests for the controller?. [Experimental] (yes/no) [no]:
 > no

 created: src/Controller/Backoffice/TagController.php
 created: src/Form/TagType.php
 created: templates/backoffice/tag/_delete_form.html.twig
 created: templates/backoffice/tag/_form.html.twig
 created: templates/backoffice/tag/edit.html.twig
 created: templates/backoffice/tag/index.html.twig
 created: templates/backoffice/tag/new.html.twig
 created: templates/backoffice/tag/show.html.twig

           
  Success! 
           

 Next: Check your new CRUD by going to /backoffice/tag/
student@teleporter:/var/www/html/apo/O-box$ bc make:crud

 The class name of the entity to create CRUD (e.g. VictoriousKangaroo):
 > ReserveTask

 Choose a name for your controller class (e.g. ReserveTaskController) [ReserveTaskController]:
 > Backoffice\ReserveTask 

 Do you want to generate tests for the controller?. [Experimental] (yes/no) [no]:
 > no

 created: src/Controller/Backoffice/ReserveTaskController.php
 created: src/Form/ReserveTaskType.php
 created: templates/backoffice/reserve_task/_delete_form.html.twig
 created: templates/backoffice/reserve_task/_form.html.twig
 created: templates/backoffice/reserve_task/edit.html.twig
 created: templates/backoffice/reserve_task/index.html.twig
 created: templates/backoffice/reserve_task/new.html.twig
 created: templates/backoffice/reserve_task/show.html.twig

           
  Success! 
           

 Next: Check your new CRUD by going to /backoffice/reserve/task/
```

