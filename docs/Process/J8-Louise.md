# J8 - création des controllers pour le blog

## ArticleController

```bash
bin/console make:controller --no-template

 Choose a name for your controller class (e.g. BravePuppyController):
 > Article

 created: src/Controller/ArticleController.php

           
  Success! 
           

 Next: Open your new controller class and add some pages!
```

Code des routes GET /api/articles (api_article_browse) et /api/articles/id (api_article_read).

## ThemeController

```bash
bin/console make:controller --no-template

 Choose a name for your controller class (e.g. AgreeableKangarooController):
 > Theme

 created: src/Controller/ThemeController.php
```

Code des routes GET /api/articles/themes (api_theme_browse) et /api/articles/themes/id (api_theme_read).
