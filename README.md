# Introduction
This repo is the API for the Aurora Medical Software.

**Only push to the DEV branch.**

Documentation:
This Documentation is a work in progress and is not complete. All new end points added should properly documented.
https://api.dev.aurorasw.com.au/docs

Logs:
https://api.dev.aurorasw.com.au/log-viewer

Test Servers:
MAIN BRANCH: https://api.demo.aurorasw.com.au/
DEV BRANCH: https://api.dev.aurorasw.com.au/

# Local Installation

## install desired database

Windows: XXAMP

Create database for application

## Install composer dependency

composer install (from project root)

## config .env file.

create .env from env.example

config DB vars

## Generate APP_KEY and JWT Secret Key

php artisan key:generate

php artisan jwt:secret

## Create a symbolic link for file storage to access from web.

php artisan storage:link

# Commands for Development

## Run Server

php artisan serve

Routes:
main endpoint: http://localhost:8000/
docs: http://localhost:8000/docs
logs: http://localhost:8000/log-viewer


## Fresh migration and Seeding (LOCAL ONLY)

php artisan migrate:fresh --seed

## View Route List

php artisan route:list
