# IP Address Project


# Introduction
This is a full-stack web project built using Laravel on the backend and Angularjs on the frontend. This is a simple project built to show my angularjs and laravel learning.

This project uses Laravel on the backend to provide REST APIs. It uses JWT for authentication. The frontend uses Angularjs. Users can register with their email addresses then login to store validated IP addresses. Users have the functionality of editing their stored IP addresses and the backend keeps an audit log of the logins, additions and edits of the users. Bootstrap was applied on the frontend and notifications are provided by ng-snotify.

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
- Run the project by `$ php artisan serve` in port 8000.

## Frontend setup
- Enter the frontend folder.
- Run the comman `$ npm install` to install all the dependencies.
- Run the command `$ ng serve` to run the project in 4200 port.

# Screenshots of application
- Homepage ![](https://raw.githubusercontent.com/ridwanrahman/ridwanrahman.github.io/master/images/ip-project1.png)
- Login page ![](https://raw.githubusercontent.com/ridwanrahman/ridwanrahman.github.io/master/images/ip-project2.png)
- Dashboard ![](https://raw.githubusercontent.com/ridwanrahman/ridwanrahman.github.io/master/images/ip-project3.png)
- Add new ip page ![](https://raw.githubusercontent.com/ridwanrahman/ridwanrahman.github.io/master/images/ip-project5.png)
- Edit ip page ![](https://raw.githubusercontent.com/ridwanrahman/ridwanrahman.github.io/master/images/ip-project6.png)
