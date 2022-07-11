# Laravel Domain Oriented
This package builds a structure to domain-oriented application (not DDD).

## Requirements
- PHP 7.2+, 8.0, 8.1
- Laravel 7.x, 8.x, 9.x

## Introduction
I want to build structures in an organized and productive way. Take a look at the final structure:
```bash
src
├── App
│   ├── Admin
│   │   ├── Controllers
│   │   ├── Middlewares
│   │   ├── Requests
│   │   └── ...
│   ├── Api
│   │   ├── Controllers
│   │   ├── Middlewares
│   │   ├── Requests
│   │   └── ...
│   └── Console
│       ├── Commands
│       └── ...
├── Domain
│   ├── Dummy
│   │   ├── Actions
│   │   ├── QueryBuilders
│   │   ├── Collections
│   │   ├── DataTransferObjects
│   │   ├── Events
│   │   ├── Exceptions
│   │   ├── Listeners
│   │   ├── Models
│   │   ├── Rules
│   │   └── States
│   └── ...
├── Support
│   ├── Providers
│   ├── Middlewares
│   ├── Controllers
│   └── ...
database
├── factories
├── migrations
└── seeders
...
```

## Setup
1. Run this Composer command to install the latest version
```bash
composer require hungthai1401/laravel-domain-oriented --dev
```
2. If you prefer, you can export the config files:
```bash
php artisan vendor:publish --provider="HT\LaravelDomainOriented\ServiceProvider" --tag="config"
```
3. Run this command to build the domain structure:
```bash
php artisan domain:make Dummy
```
4. And of course, if you want to remove the structure, just run this command:
```bash
php artisan domain:remove Dummy
```

## Reading Articles
1. [Domain oriented Laravel](https://stitcher.io/blog/laravel-beyond-crud-01-domain-oriented-laravel)
2. [Please, stop talking about Repository pattern with Eloquent](https://adelf.tech/2019/useless-eloquent-repositories)
