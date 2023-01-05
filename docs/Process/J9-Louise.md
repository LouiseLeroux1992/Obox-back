# J9 - suite backoffice du blog

Modification des permissions dans security.yaml
Modification de l'url de redirection dans OboxAuthenticator.php
Modification de la route par défaut "/" dans \backoffice\MainController
Modification des templates twig pour un rendu du backoffice cohérent avec le front.

```bash
composer require symfony/twig-pack
```

Installation d'un package pour gérer les erreurs 403 (access denied) et 404 (not found) grâce à des templates twigs créés dans bundles/TwigBundle/Exception. 

Pour l'instant l'erreur 403 renvoie toujours une erreur symfony access denied.

Utilisation du thème de bootstrap pour mettre en forme les formulaires du back-office :

```bash
# config/packages/twig.yaml
twig:
    form_themes: ['bootstrap_5_layout.html.twig']
```

Suppression des checkboxes pour ajouter des articles directement dans le formulaire de création d'un thème.

Modification des templates twig pour tout adapter en français et avec la palette de couleur du site. 
