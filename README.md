# yii2-migrations-create

[![Latest Stable Version](https://poser.pugx.org/et-soft/yii2-migrations-create/v/stable)](https://packagist.org/packages/et-soft/yii2-migrations-create)
[![License](https://poser.pugx.org/et-soft/yii2-migrations-create/license)](https://packagist.org/packages/et-soft/yii2-migrations-create)
[![Total Downloads](https://poser.pugx.org/et-soft/yii2-migrations-create/downloads)](https://packagist.org/packages/et-soft/yii2-migrations-create)
[![Monthly Downloads](https://poser.pugx.org/et-soft/yii2-migrations-create/d/monthly)](https://packagist.org/packages/et-soft/yii2-migrations-create)
[![Daily Downloads](https://poser.pugx.org/et-soft/yii2-migrations-create/d/daily)](https://packagist.org/packages/et-soft/yii2-migrations-create)

Console script for Yii2, for create Yii2 migrations files from existing database.

### Install

Either run

```
$ php composer.phar require et-soft/yii2-migrations-create "*"
```

or add

```
"et-soft/yii2-migrations-create": "*"
```

to the ```require``` section of your `composer.json` file.

In config/console.php add section:

```php
'controllerMap' => [
    'migrations' => 'etsoft\yii2migrations\MigrationsController',
]
```

### Using

In console, types: 

```
./yii migrations
```

For create migration files for all tables from database in directory app\migrations.

Also in console your may type: 

```
./yii migrations/table table_name
```

For create migration file selected table from database in directory app\migrations.

### Examples


Show selectbox with values from 2015 (current year) to 1995 year (-20 years from current year):

```php
<?php echo $form->field($model, 'year')->widget(etsoft\widgets\YearSelectbox::classname(), [
    'yearStart' => 0,
    'yearEnd' => -20,
 ]);
?>
```

### TODO in next releases

- Support Foreign keys
- Support ENUM fields