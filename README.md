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

For existing MySQL table with scheme:
 
```
 CREATE TABLE test
 (
     id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
     user_id INT(11) COMMENT 'ID user',
     name VARCHAR(255) NOT NULL COMMENT 'Name',
     phone VARCHAR(50) NOT NULL COMMENT 'Phone',
     created DATETIME NOT NULL COMMENT 'Date created'
 );
```

Migration script create in app\migrations directory? file m_test.php with content:

```php
<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%test}}`.
 */
class m_test extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%test}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->comment('ID user'),
            'name' => $this->string(255)->notNull()->comment('Name'),
            'phone' => $this->string(50)->notNull()->comment('Phone'),
            'created' => $this->dateTime()->notNull()->comment('Date created'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%test}}');
    }
}
```

### TODO in next releases

- Support Foreign keys
- Support ENUM fields