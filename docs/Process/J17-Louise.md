# Commande DataLoadCommand

## fin de l'algo

J'ai terminé l'algo de la commande en m'inspirant de la logique des fixtures.

## mise en place des données réelles dans la BDD

```bash
bc doctrine:database:drop --force
Dropped database `obox` for connection named default
```

```bash
bc doctrine:database:create
Created database `obox` for connection named default
```


```bash
bc doctrine:migrations:migrate

 WARNING! You are about to execute a migration in database "obox" that could result in schema changes and data loss. Are you sure you wish to continue? (yes/no) [yes]:
 > yes

[notice] Migrating up to DoctrineMigrations\Version20221213113119
[notice] finished in 1742.6ms, used 22M memory, 2 migrations executed, 18 sql queries
```

```bash
bc app:data:load

                                                                                                                        
 [OK] Data loaded successfully !
```
