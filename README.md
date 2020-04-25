composer create-project symfony/skeleton free_code_symf

composer require maker-bundle

php bin/console

composer require annotations

php bin/console make:controller MainController

symfony/var-dumper // doesnt need mb
server // doesnt need mb
composer require template

composer require orm-pack // done by annotations?

php bin/console doctrine:database:create

php bin/console make:entity Post

php bin/console doctrine:schema:update

php bin/console doctrine:schema:update --dump-sql

php bin/console doctrine:schema:update --force

php bin/console make:controller PostController
// also makes twig folder and template

php bin/console make // show make commands

composer require form validator

composer require symfony/profiler-pack // mb not need
composer require symfony/profiler-pack --dev // for develop only!!

## Make authentification
#make user entity
composer require security

#make auth
php bin/console make:auth

#make user // its better to make user instead of make entity. adds to packages
php bin/console make:user  

## Make User table in DB
php bin/console doctrine:schema:update --dump-sql
php bin/console doctrine:schema:update --force

@Repeated Type Field //for confirm password

## Add Getters & Setters to Existing Entities
php bin/console make:entity --regenerate

#migrate
php bin/console doctrine:schema:update --force

## Create Category
php bin/console make:entity Category

php bin/console make:entity --regenerate

php bin/console doctrine:schema:update --force

# Services
php bin/console debug:container
php bin/console debug:container fileUploader