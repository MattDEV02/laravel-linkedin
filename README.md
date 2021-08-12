<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>   
<p align="center"> <a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a> <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a> <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a> <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a> </p>   

# Laravel-Linkedin  

### [http://project2.vallauritest.tk/](http://project2.vallauritest.tk/)

## Run this Commands to replicate the Application:

- #### git clone https://github.com/MattDEV02/laravel-linkedin.git
- #### npm install
- #### composer install (if you use Linux add the --ignore-platform-reqs flag)
- #### php artisan storage:link
- #### php artisan optimize:clear
- #### php artisan db:create
- #### php artisan migrate:refresh --seed
- #### php artisan serve --host 0.0.0.0 --port PORT

  ##### N.B. = If the migration command does not work, there is an .sql file in the Database folder to replicate it.

# About this Application

## Technologies used:

- ### Laravel 8
- ### PHP 8.0.9
- ### Blade
- ### MySQL 8.0.25
- ### Eloquent
- ### Livewire 2.4.4
- ### Bootstrap 4.6
- ### JavaScript (ES11), Jquery 3.6.1
- ### SASS 1.15.2
- ### GIT 2.31.1, GITHUB
- ### Markdown
- ### Windows
- ### Ubuntu
- ### Composer 2.0.10
- ### NPM 7.14.0
- ### Artisan
- ### JSON, XML
- ### PHPUnit
- ### PHPDocs
- ### HTTP 1.1
- ### DigitalOcean
- ### PHPStorm, Visual-studio Code.

### Project phases

- ER Model
- Relational Model

## Description and guide:

The first web page will be the Home page, reachable at the root ('/').  
Through the Home page, it is possible to reach the registration and/or login page.  
On the registration page, it is possible to insert new users in the database, who enter values ​​such as email (unique), password, name, surname, role in the world of work and City of residence.  
Once the user is registered, he will be redirected to the login page (obviously you can go there even without having registered) and enter your credentials (email and password), and if present in the database, a redirection will take place in an area ('/ feed') where he can view his posts plus those of his friends and like each post. On this page, you can also publish new posts and comment them.  
Also in this area, we can find a horizontal navigation bar, thanks to which we can reach different pages and perform different actions, such as:

- Access your profile card, edit it, view your posts, like them, view your links and remove them.

- Search for other users and view (by clicking) their tabs, view their posts and connect with them.

- Logout.

- Access to the Home page and main area ('/ feed').

On the Login page, the user can also retrieve his password by entering his email and new password.

## Features

- Portable, the Application is tested in 3 different SO:

  1) Windows.  
  2) Linux.     
  3) MacOS.

- Robust (checks in Client-side, Server-side and also in the DataBase).

- Responsive-layout.

- Easy to carry from one machine to another (both database and application).

- Simple to use.

- Modular Code.

- Secure.

- Good graphics.

## Laravel "components" used:

- ### Route 

- ### Controller 

- ### Model 

- ### Migration 

- ### Seeder 

- ### Factory

- ### Blade (with components and other)

- ### Auth

- ### LiveWire 

- ### Middleware

- ### Session 

- ### Cookie

- ### Command

- ### Storage

- ### Log

- ### Test

- ### Hash

- ### DB

- ### Http

- ### Console

- ### Str

- ### Observer

- ### EventServiceProvider

- ### File

- ### Request

- ### Artisan

- ### Mail