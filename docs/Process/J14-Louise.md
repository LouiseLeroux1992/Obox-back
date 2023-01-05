# J14

## service timer

### Modifications

changement du nom du timer : auparavant nommé TimerToDoList, mais le timer et la todolist sont deux composants séparés du tableau de bord de l'utilisateur. Renommé TimerService.

Concernant le format du return $timeleft : 'Il reste %R%d jours avant le déménagement' n'est pas le plus adapté car on a juste besoin de renvoyer l'information du nombre de jours restant en JSON pour que le front utilise cette donnée comme il le souhaite. Mieux vaut renvoyer un format Date qu'une chaîne de caractères ?

Pas besoin de currentDate dans le construct puisqu'on définir le currentDate à 'now' directement dans la méthode du timer sans utiliser le $this->currentDate.

Essai du service :

Erreur "Cannot resolve argument $timerService of "App\Controller\TimerController::read()": Cannot autowire service "App\Service\TimerService": argument "$timer" of method "__construct()" references class "App\Entity\Timer" but no such service exists."

Essai de transmettre la movingDate directement plutôt que l'entité timer.

Rajout de CurrentDate en propriété et setter du currentDate directement dans le construct en utilisant Datetime->('now').

Erreur :
Cannot resolve argument $timerService of "App\Controller\TimerController::read()": Cannot autowire service "App\Service\TimerService": argument "$movingDate" of method "__construct()" has no type-hint, you should configure its value explicitly.

rajout de DateTimeInterface en type pour movingDate dans le construct

Cannot resolve argument $timerService of "App\Controller\TimerController::read()": Cannot autowire service "App\Service\TimerService": argument "$movingDate" of method "__construct()" references interface "DateTimeInterface" but no such service exists. Did you create a class that implements this interface?

Modification en DateTime

Cannot resolve argument $timerService of "App\Controller\TimerController::read()": Cannot autowire service "App\Service\TimerService": argument "$movingDate" of method "__construct()" references class "DateTime" but no such service exists.

Modification en Date

Cannot resolve argument $timerService of "App\Controller\TimerController::read()": Cannot autowire service "App\Service\TimerService": argument "$movingDate" of method "__construct()" references class "Symfony\Component\Validator\Constraints\Date" but no such service exists.

J'ai bien les use pour chacun des essais mais cela ne change rien :
use DateTime;
use DateTimeInterface;
use Symfony\Component\Validator\Constraints\Date;

Modification totale : plus aucun argument dans le construct, argument $movingDate directement dans la méthode timer(). 

Résultat : "Il reste +2 jours avant le déménagement" ça marche !

J'ai enlevé la condition car on va finalement envoyer un DateInterval directement à la demande du front, et ce sera positif ou négatif en fonction de si on a dépassé ou non la date du déménagement.


Finalement, le front a choisi le format "%a" qui renvoie la différence directement en nombre de jours. 

