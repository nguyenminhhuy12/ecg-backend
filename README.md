# ECG Backend

RESTful API backend for the ECG project, built with Laravel.

## Overview

ECG Backend provides RESTful APIs for managing patients, medical cases,
ECG images, and prediction results.

## Tech Stack

- Laravel
- PHP
- MySQL
- JWT Authentication
- Composer

## Features

- User authentication
- Patient management
- Medical case management
- ECG image management
- ECG prediction management
- RESTful CRUD APIs
## Requirements

- PHP 8.2+
- Composer
- MySQL 8.0+

## Installation

Clone the repository:

```bash
git clone https://github.com/nguyenminhhuy12/ecg-backend.git

cd ecg-backend

Install dependencies:

composer install

Create the environment file:

cp .env.example .env

Generate the application key:

php artisan key:generate

Configure your database in .env, then run:

php artisan migrate

Start the development server:

php artisan serve

The API will be available at:

http://127.0.0.1:8000