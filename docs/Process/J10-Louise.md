# Vendredi 10/12

## Modifs du back-office

Modification de l'affichage des articles et des thèmes, traduction de l'anglais au français pour les noms des champs.

Suppression du champ slug sur la page d'accueil (le slug est créé automatiquement par la méthode new du controller, à partir du nom/title de l'entité). Il n'est pas possible de modifier le slug dans le formulaire, mais la modification du titre modifie le slug (méthode edit du controller).

## Création du UserController

```bash
bc make:cont

 Choose a name for your controller class (e.g. VictoriousChefController):
 > User

 created: src/Controller/UserController.php
 created: templates/user/index.html.twig

           
  Success!
  ```

code de la méthode add du UserController

Suppression du template user/index.html.twig (j'aurais dû créer le controller avec l'option --no-template comme nous travaillons en mode API).

## mise en place des JWT

On utilise le bundle lexik web token. Le require du bundle a déjà été fait à l'installation du projet.

Commande à exécuter une seule fois (la première fois que l'on déploie le site sur un serveur).

```bash
php bin/console lexik:jwt:generate-keypair
```

Cela rajoute dans un dossier jwt deux fichiers private.pem et public.pem qui sont obligatoires pour le fonctionnement des jwt. Un autre fichier a été rajouté dans le dossier package : lexik_jwt_authentication.yaml qui contient

```text
lexik_jwt_authentication:
    secret_key: '%env(resolve:JWT_SECRET_KEY)%'
    public_key: '%env(resolve:JWT_PUBLIC_KEY)%'
    pass_phrase: '%env(JWT_PASSPHRASE)%'
```

On rajoute dans ce fichier un paramètre, le TTL (la durée de vie du token) et on le définit à 18h pour qu'il dure toute une journée de travail.

```yaml
token_ttl: 64800
```

Le fichier .ennv a également été modifié

```yaml
###> lexik/jwt-authentication-bundle ###
JWT_SECRET_KEY=%kernel.project_dir%/config/jwt/private.pem
JWT_PUBLIC_KEY=%kernel.project_dir%/config/jwt/public.pem
JWT_PASSPHRASE=631917bf8057c5817ff21f0a254c5472
###< lexik/jwt-authentication-bundle ###
```

### Il faut ensuite sécuriser les routes

Dans le fichier security.yaml

```yaml
firewalls:
        login:
            pattern: ^/api/login
            stateless: true
            json_login:
                check_path: /api/login_check
                success_handler: lexik_jwt_authentication.handler.authentication_success
                failure_handler: lexik_jwt_authentication.handler.authentication_failure

        api:
            pattern:   ^/api
            stateless: true
            jwt: ~
```

```yaml
access_control:
        - { path: ^/api/login, roles: PUBLIC_ACCESS }
        - { path: ^/api,       roles: IS_AUTHENTICATED_FULLY }
```

Dans le fichier routes.yaml

```yaml
api_login_check:
    path: /api/login_check
```

Maintenant, la route pour s'authentifier est celle-ci : /api/login_check

### Pour obtenir un token

```bash
curl -X POST -H "Content-Type: application/json" https://localhost/api/login_check -d '{"username":"johndoe","password":"test"}'
```

traduction de la commande Curl :

Route POST http://localhost:8080/api/login_check

```json
{
    "username": "johndoe",
    "password": "text"
}
```

L'objet JSON doit avoir exactement cette forme, avec ces propriétés précisément, sinon cela ne fonctionne pas.

Pour se connecter, on utilise directement les identifiants et mdp des Users de la bdd.

Ainsi, la requête POST http://localhost:8080/api/login_check avec l'objet JSON contenant l'identifiant et mdp du User Louise en bdd

```json
{
  "username": "louise@oclock.io",
  "password": "louise"
}
```

renvoie en réponse Status: 200 OK et l'objet JSON

```json
{
  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NzA1OTc3NDUsImV4cCI6MTY3MDY2MjU0NSwicm9sZXMiOlsiUk9MRV9VU0VSIl0sInVzZXJuYW1lIjoibG91aXNlIn0.fmgMOuPVS9NdMG55ycCixqir2wLHes4oz3RJr0hLPddqPid1ebkI2GUo46WOEixozEyulcY_SAmWOdicSdSrbEIz3yisdPEE1kUI1yhgqaXOMwZuYNZ8Ui4U5nLAoW6Q3YYx8DTYQmaRR_YCh5YiSsahPwnAB_XNwlarcFVrO3_s3vm1NaYMaNiK573sMjr2zowQvwS0ZvFhrnkLW61HjiBPy7szg14UDO_CO5kNXVQLaswskSAolFUDILRWD6hZXQlr2YrYFckdD5iSllCxFDfjngePYvgHz-N6dT0CVnFBZDl1HoLVFH70L5LzDqlj5XdjIl4Tt7bkafHnF1kGkg"
}
```

Pour se connecter avec Thunder Client et accéder aux routes, on exécute la requête POST afin d'obtenir le Token, et ensuite pour toutes les routes d'API on doit fournir le token (sans les guillemets) dans l'oglet auth/bearer.
