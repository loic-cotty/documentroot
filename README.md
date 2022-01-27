INSTALLATION:

symfony new documentroot --version=next

cd documentroot/

//installation du certification SSL
brew install nss (automatisation certificat pour firefox)
symfony server:ca:install (certificat)

//Run webserver
symfony serve -d # lancement server
symfony server:stop # Arret server
symfony server:logs # Stream des logs symfony

Installation des bundles inévitables:

* composer require symfony/maker-bundle --dev
    * (symfony composer req maker --dev )
* composer require symfony/profiler-pack --dev
    * (symfony composer req profiler --dev)
* composer require symfony/debug --dev
    * (symfony composer req debug --dev)
* composer require symfony/monolog-bundle -W
    * (symfony composer req logger -W) # -W with-all-dependencies
* composer require sensio/framework-extra-bundle
    * (symfony composer req annotations)
* composer require symfony/orm-pack:^2
    * (symfony composer req "orm:^2" )
* composer require symfony/validator
    * (symfony composer req validator)
* composer require symfony/twig-pack
    * (symfony composer req twig)
* composer require twig/intl-extra:^3
    * (symfony composer req "twig/intl-extra:^3")
* composer require twig/extra-bundle
    * (symfony composer req "twig/extra-bundle")
* composer require phpunit/phpunit --dev
    * (symfony composer req phpunit --dev)
* composer require doctrine/doctrine-fixtures-bundle --dev
    * (symfony composer req orm-fixtures --dev)

## Installation Postgres sql via docker:

on complète le fichier docker-compose.yaml:

```
version: '3'

services:
  database:
    image: postgres:13-alpine
    environment:
      POSTGRES_USER: document
      POSTGRES_PASSWORD: root
      POSTGRES_DB: documentroot
    ports: [5432]
```

Puis on lance le container:
```
docker-compose up -d
```
Pour récupérer le port de connection:
```
docker ps
```
Pour se connecter à Postgres dans le container:

```
docker exec -it f71d5165055f psql -d documentroot -U document
```

rappel postgres :
* \? : liste des commandes
* \l : show databases
* \c documentroot : changer de bdd
* \dt : show tables
* \d <table_name> : show table details

Aujourd'hui, il faut relancer la migration pour remplir la bdd.

Generation et execution de la migration pour la bdd.
```
symfony console make:migration
symfony console doctrine:migrations:migrate
```

mettre à jour le port dans le .env:
```
DATABASE_URL="postgresql://document:root@0.0.0.0:53419/docroot?serverVersion=13&charset=utf8"
```


## Initialisation du front :

Techno :
twig, webpack encore(equivalent de npm, yarn), vuejs, bootstrap, scss



```
composer require symfony/webpack-encore-bundle
* symfony composer req encore

yarn add node-sass sass-loader --dev
yarn add bootstrap@4 jquery popper.js bs-custom-file-input --dev
yarn add vue --dev


encore dev

symfony run yarn encore dev
symfony run yarn encore dev --watch
```

On génère les 2 premieres entités, contenant la relation ManyToMany:
```
symfony console make:entity Post
symfony console make:entity Tag
```

Generation et execution de la migration pour la bdd.
```
symfony console make:migration
symfony console doctrine:migrations:migrate
```

Installation d'une interface admin
```
symfony composer req "admin:^3"
mkdir src/Controller/Admin/
symfony console make:admin:dashboard
symfony console make:admin:crud
```

```
composer require twig/markdown-extra
```

API PLATFORM : 
```
composer require api
```

Migration de la bdd sous docker (postgres) en local (mysql)
maj du .env DATABASE_URL
suppression des fichiers de migrations existants
```
bin/console doctrine:database:create
symfony console make:migration
bin/console doctrine:migrations:migrate
```

Doctrine Extension : 
```
composer require stof/doctrine-extensions-bundle
```
non utilisé:
https://github.com/doctrine-extensions/DoctrineExtensions
composer require gedmo/doctrine-extensions


https://blog.digivia.fr/article/un-bon-bundle-pour-vos-fixtures-en-yaml



rss-atom-bundle
https://github.com/alexdebril/rss-atom-bundle
composer config extra.symfony.allow-contrib true
composer require debril/rss-atom-bundle