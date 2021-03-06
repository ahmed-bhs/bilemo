# bilemo

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/9c7b27f8969447c4b41b7d1eb818afc1)](https://www.codacy.com/app/zohac/bilemo?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=zohac/bilemo&amp;utm_campaign=Badge_Grade)

## About

A web service exposing an API.
Project 7 of the OpenClassrooms "Application Developer - PHP / Symfony" course.

## Requirements

* PHP: SnowTricks requires PHP version 7.1 or greater. [![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.1-8892BF.svg?style=flat-square)](https://php.net/)
* MySQL: for the database. [![Minimum MySQL Version](https://img.shields.io/badge/MySQL-%3E%3D5.7-blue.svg?style=flat-square)](https://www.mysql.com/fr/downloads/)
* Composer: to install the dependencies. [![Minimum Composer Version](https://img.shields.io/badge/Composer-%3E%3D1.6-red.svg?style=flat-square)](https://getcomposer.org/download/)

## Installation

### Git Clone

You can also download the bilemo source directly from the Git clone:

    git clone https://github.com/zohac/bilemo.git bilemo
    cd bilemo

Give write access to the /var directory

    chmod 777 -R var

Then

    composer update

Configure the application by completing the file /app/config/parameters.yml

    php bin/console doctrine:schema:update --dump-sql
    php bin/console doctrine:schema:update --force

If you want to use a data set

    php bin/console doctrine:fixtures:load

Configure the jwt authentication

    mkdir var/jwt
    openssl genrsa -out var/jwt/private.pem -aes256 4096
    openssl rsa -pubout -in var/jwt/private.pem -out var/jwt/public.pem

Changes the jwt_key_pass_phrase parameter in the 'app/config/parameters.yml' file.

## Tests

You can start the tests with the following command:

    ./vendor/bin/simple-phpunit --coverage-html web/test-coverage

## Dependency

* FOSRestBundle "friendsofsymfony/rest-bundle"
  * Bundle addressing common issues during REST API development.
* LexikJWTAuthenticationBundle "lexik/jwt-authentication-bundle"
  * JWT authentication.
* NelmioApiDocBundle "nelmio/api-doc-bundle"
  * Document the API.
* BazingaHateoasBundle "willdurand/hateoas-bundle"
  * Make the API self-discoverable (last level of the Richardson maturity model).
* JMSSerializerBundle "jms/serializer-bundle"
  * Required for BazingaHateoasBundle.
* orm-fixtures "doctrine/doctrine-fixtures-bundle"

## Using the API

Use the documentation at the address:

    http://my.server/api/doc

## Issues

Bug reports and feature requests can be submitted on the [Github Issue Tracker](https://github.com/zohac/bilemo/issues)

## Author

Simon JOUAN
[https://jouan.ovh](https://jouan.ovh)
