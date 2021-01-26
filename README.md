# IP Address Project

**Table of Contents**

[TOCM]

[TOC]

# Introduction
This is a full-stack web project built using Laravel on the backend and Angularjs on the frontend. This is a simple project built to show my angularjs and laravel learning.

# Project Setup
Below are the steps to run the project in local environment.
## Project Stack
This project is built using the following technologies:
- PHP 8.0.1
- Laravel 8.12
- Angularjs 11.01
- MySQL database

## Cloning the project
- Clone the project using ssh. It has two folders backend and frontend.
`$ git clone <ssh>`.

## Backend Setup
- cd into the main directory then enter the laravel-api folder.
- Run `$ composer install` to install all of the project dependencies.
- You will need an environment file for the database configuration. Make a copy of the .env.example file and create a .env file by running `$ cp .env.example .env`.
- Generate an app encryption key by running `$ php artisan key:generate`.
- Create an empty database on mysql and write the database name, username and password in the .env file.
- Run the migration command `$ php artisan migrate` to create the tables in the database.
- Run the project in `$ php artisan serve`.

## Frontend setup
- Enter the frontend folder.
- Run the comman `$ npm install` to install all the dependencies.
- Run the command `$ ng serve` to run the project.
