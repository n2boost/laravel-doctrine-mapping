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

If it doesn't works, please type:

```bash
php artisan vendor:publish
```

And select the true number options.

When published, [the `config/laravel-doctrine-mapping.php` config file](https://github.com/spatie/laravel-permission/blob/master/config/permission.php) contains:

```php
return [

    /*
     * Mapping Config Engines.
     * Can set to: yaml
     */

    'mapping_type' => 'yaml',

    /*
     * Mapping config files dir
     * full path will like this example: config/mappings/yaml/User.dcm.yml
     */
    'mapping_file_dir' => 'config/mappings',

    'entities_file_dir' => 'resources/classes',

    'profile' => 'local',
    'isDevMode' => true,

    'use_connection_pool' => 'laravel', // laravel, self
    'connection' => 'mysql',

    'connections' => [
        'mysql' => [
            'driver' => 'pdo_mysql',
            'host' => '127.0.0.1',
            'port' => 3306,
            'user' => 'root',
            'password' => '',
            'dbname' => 'hunter',
            'charset' => 'utf8mb4',
            'collate' => 'utf8mb4_unicode_ci',
        ]
    ]
];
```

If you use `yaml` config file engine, please install this dependence:

```
composer require symfony/yaml
```

## Usage

* [Config Yml-Orm](#config-yml-orm)
* [Generate Entities](#generate-entities)
* [Sync Database](#sync-database)

### Config Yml-Orm

### Generate Entities

```
php artisan n2boost:orm:generate-entities
```

### Sync Database

```
php artisan n2boost:orm:scheme-tool:update
```

### Sponsor

文档参考:

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
composer require symfony/yaml

