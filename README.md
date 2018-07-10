# Generate Entities and Sync Database with Yml Config File

* [Installation](#installation)
* [Usage](#usage)
  * [Config Yml-Orm](#config-yml-orm)
  * [Generate Entities](#generate-entities)
  * [Sync Database](#sync-database)
* [Example](#example) 
* [Contributing](#contributing)
* [License](#license)

This package allows you to manage database scheme with yml orm config.

The orm config file just like this:

```yaml
Entity\User:
    type: entity
    table: user
    id:
        id:
            type: integer
            id: true
            generator:
                strategy: IDENTITY
    fields:
        username:
            type: string
            nullable: true
            length: 128
        password:
            type: string
            nullable: true
```

## Installation

### Laravel

This package can be used in Laravel 5.4 or higher.

You can install the package via composer:

``` bash
composer require n2boost/laravel-doctrine-mapping dev-master
```

In Laravel 5.5 the service provider will automatically get registered. In older versions of the framework just add the service provider in `config/app.php` file:

```php
'providers' => [
    // ...
    N2boost\LaravelDoctrineMapping\LaravelDoctrineMappingServiceProvider::class,
];
```

You can publish the config file with:

```bash
php artisan vendor:publish --provider="N2boost\LaravelDoctrineMapping\LaravelDoctrineMappingServiceProvider::class" --tag="config"
```

When published, [the `config/laravel-doctrine-mapping.php` config file](https://github.com/spatie/laravel-permission/blob/master/config/permission.php) contains:

```php
return [
    'mapping_type' => 'yaml',
    'mapping_file_dir' => '',
    'entities_file_dir' => '',
    'profile' => 'local',
    'isDevMode' => true,
    'connection' => 'mysql',
];
```

### Lumen

You can install the package via Composer:

``` bash
composer require n2boost/laravel-doctrine-mapping dev-master
```

Copy the required files:

```bash
cp vendor/n2boost/laravel-permission/config/laravel_doctrine_mapping.php config/laravel-doctrine-mapping.php
```

As well as the configuration and the service provider:

```php
$app->configure('laravel_doctrine_mapping');
$app->register(N2boost\LaravelDoctrineMapping\LaravelDoctrineMappingServiceProvider::class);
```

Now, define your orm files in `path`.


## Usage

* [Config Yml-Orm](#config-yml-orm)
* [Generate Entities](#generate-entities)
* [Sync Database](#sync-database)

### Config Yml-Orm

### Generate Entities

### Sync Database

### Sponsor

文档参考

[Laravel 5.5 Package Development – Markus Tripp – Medium](https://medium.com/@markustripp/laravel-5-5-package-development-e72f3e7a8f38)
[How to create a Laravel 5 package in 10 easy steps - Laravel Daily](https://laraveldaily.com/how-to-create-a-laravel-5-package-in-10-easy-steps/)

## Design

Config file

config/laravel-doctrine-mapping.php
- 配置数据库连接
- 配置 mapping 文件目录
- 配置 entity 生成文件目录

Command Lines

- php artisan n2boost:orm:generate-entities
- php artisan n2boost:orm:scheme-tool:update

Tools 

composer remove symfony/yaml