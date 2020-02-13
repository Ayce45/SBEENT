1 - composer install
2 - php bin/console doctrine:database:drop --force
3 - php bin/console doctrine:database:create
4 - php bin/console doctrine:migrations:migrate
5 - php bin/console doctrine:fixtures:load
6 - php -S localhost:8000 -t public