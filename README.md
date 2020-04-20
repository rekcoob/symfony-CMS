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