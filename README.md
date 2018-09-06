# Commercial People Code Kata

## Introduction

This is a basic Symfony application, producing a JSON API without the use of the FOSRest Bundle.

As it used Doctrine, basic commands like `php bin/console doctrine:database:create`
and `php bin/console doctrine:fixtures:load` should function as expected.

Symfony 4, Doctrine 2, and PHPUnit 7 are the main tools used here, as well as the `symfony-bundles/json-request-bundle`
library.  SQLite is the only real infrastructure used, apart from PHP 7.2.

Run the tests with `./vendor/bin/phpunit`. 
