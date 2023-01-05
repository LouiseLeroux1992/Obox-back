# J12

## suite des méthodes de la todolist

Suppression de la méthode taskDone et création de la méthode edit qui remplace aussi taskDone.

Création de la méthode delete pour la todolist.
Vu avec les devs front : choix d'un status 200 + message "la tâche a bien été supprimée" plutôt que status 204 (no content).

Pour la méthode api_tag_browse
le front a besoin d'une liste avec tous les tags et un statut particulier qui distingue celles qui sont cochées par le user et celles qui ne sont pas cochées : rajout d'une propriété "cheked" dans l'entité Tag que l'on va passer à true uniquement dans la méthode si le tag est lié au user, et la valeur true ne sera pas sauvegardée en bdd, elle sera juste transmise au front.

Création des méthodes delete, tagAddTask et tagDeleteTask.

## début des méthodes du timer

Création de la méthode read du timer, attente du service Timer pour créer la méthode setTimer.
