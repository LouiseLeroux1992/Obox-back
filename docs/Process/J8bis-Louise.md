# J8 - backoffice du blog

## CRUD pour Article

```bash
bc make:crud

 The class name of the entity to create CRUD (e.g. DeliciousPopsicle):
 > Article

 Choose a name for your controller class (e.g. ArticleController) [ArticleController]:
 > Backoffice\Article

 Do you want to generate tests for the controller?. [Experimental] (yes/no) [no]:
 > no

 created: src/Controller/Backoffice/ArticleController.php
 created: src/Form/ArticleType.php
 created: templates/backoffice/article/_delete_form.html.twig
 created: templates/backoffice/article/_form.html.twig
 created: templates/backoffice/article/edit.html.twig
 created: templates/backoffice/article/index.html.twig
 created: templates/backoffice/article/new.html.twig
 created: templates/backoffice/article/show.html.twig

           
  Success!
```

## CRUD pour Theme

```bash
bc make:crud

 The class name of the entity to create CRUD (e.g. GrumpyGnome):
 > Theme

 Choose a name for your controller class (e.g. ThemeController) [ThemeController]:
 > Backoffice\Theme

 Do you want to generate tests for the controller?. [Experimental] (yes/no) [no]:
 > no

 created: src/Controller/Backoffice/ThemeController.php
 created: src/Form/ThemeType.php
 created: templates/backoffice/theme/_delete_form.html.twig
 created: templates/backoffice/theme/_form.html.twig
 created: templates/backoffice/theme/edit.html.twig
 created: templates/backoffice/theme/index.html.twig
 created: templates/backoffice/theme/new.html.twig
 created: templates/backoffice/theme/show.html.twig

           
  Success!
```

```bash
bc make:cont

 Choose a name for your controller class (e.g. DeliciousPopsicleController):
 > Backoffice\Main

 created: src/Controller/Backoffice/MainController.php
 created: templates/backoffice/main/index.html.twig
```

Documentation des routes dans le Google Doc dictionnaire des routes.

Rajout de contraintes et labels dans les builders de formulaires ArticleType et ThemeType, gestion du slug directement dans la méthode new.
