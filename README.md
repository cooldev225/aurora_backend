# Installation

## install php and composer

sudo apt install software-properties-common

sudo add-apt-repository ppa:ondrej/php

sudo apt update

sudo apt-get install php8.1 php8.1-zip php8.1-curl php8.1-mysql php8.1-xml

sudo apt install php8.1-cli

curl -sS https://getcomposer.org/installer | php

sudo mv composer.phar /usr/local/bin/composer

sudo chmod +x /usr/local/bin/composer

## install mysql and Create user and database

sudo apt install mysql-server

sudo mysql

`CREATE USER 'aurora'@'localhost' IDENTIFIED WITH mysql_native_password BY 'password';`

`GRANT ALL PRIVILEGES ON *.* TO 'aurora'@'localhost' WITH GRANT OPTION;`

`exit`

mysql -u aurora -p

`CREATE DATABASE aurora;`

## go to project directory and Composer install

composer install

## config .env file and update database name, username and password.

cp .env.example .env

nano .env

## Generate APP_KEY and JWT Secret Key

php artisan key:generate

php artisan jwt:secret

# Commands for Development

## Run Server

php artisan serve

## Database Migration

php artisan migrate

## Database Seeding

php artisan db:seed

## Fresh migration and Seeding

php artisan migrate:fresh --seed

## View Route List

php artisan route:list
