<?php
/**
 * @copyright Copyright (c) 2015 ET-Soft
 * @license MIT
 * @link https://github.com/et-soft/yii2-migrations-create
 */
namespace etsoft\yii2migrations;

use Yii;
use yii\console\Controller;
use yii\db\Schema;

/**
 * This command create migration files from exiting database tables.
 *
 * @author Evgeny Titov <etsoft2015@gmail.com>
 * @since 0.1
 */
class MigrationsController extends Controller
{
    /**
     * This command create migration files for all tables in current database.
     */
    public function actionIndex()
    {
        $tables = Yii::$app->db->schema->getTableSchemas();

        foreach ($tables as $table)
        {
            $this->createMigration($table);
        }
    }

    /**
     * This command create migration file for selected table.
     *
     * @param $table_name - name of table
     */
    public function actionTable($table_name = null)
    {
        $table = Yii::$app->db->schema->getTableSchema($table_name);

        $this->createMigration($table);
    }

    /**
     * Method for create migration file for selected table.
     *
     * @param $table - Yii2 object with meta of DB table
     * @param string $prefix - Prefix for created files name
     */
    private function createMigration($table, $prefix = 'm')
    {
        $fields = array();

        if (property_exists($table, 'columns'))
        {
            foreach ($table->columns as $column)
            {
                $fields[] = [ 'property' => $column->name, 'decorators' => $this->getFieldsParams($column)];
            }
        }

        $params = array('table' => "{{%{$table->name}}}", 'className' => 'm_' . $table->name, 'fields' => $fields, 'foreignKeys' => array());

        $tpl = $this->renderFile(Yii::getAlias('@yii/views/createTableMigration.php'), $params);

        file_put_contents(Yii::getAlias('@app/migrations')."/{$prefix}_".$table->name.'.php', $tpl);
    }

    /**
     * Method for create string with Yii2 methods for description every fields.
     *
     * @param $params - array of params field
     * @return string
     */
    private function getFieldsParams($params)
    {
        $result = '';

        if ($params->isPrimaryKey == 1)
        {
            $result .= 'primaryKey()->';
        }

        if ($params->type == SCHEMA::TYPE_SMALLINT)
        {
            $result .= 'smallInteger()';
        }
        elseif ($params->type == SCHEMA::TYPE_INTEGER)
        {
            $result .= 'integer()';
        }
        elseif ($params->type == SCHEMA::TYPE_BIGINT)
        {
            $result .= 'bigInteger()';
        }
        elseif ($params->type == SCHEMA::TYPE_STRING)
        {
            if (!empty($params->size))
            {
                $result .= "string({$params->size})";
            }
            else
            {
                $result .= 'string()';
            }
        }
        elseif ($params->type == SCHEMA::TYPE_TEXT)
        {
            $result .= 'text()';
        }
        elseif ($params->type == SCHEMA::TYPE_DATETIME)
        {
            $result .= 'dateTime()';
        }

        if ($params->allowNull != 1)
        {
            $result .= '->notNull()';
        }
        if ($params->defaultValue != '')
        {
            $result .= "->defaultValue('{$params->defaultValue}')";
        }
        if ($params->comment != '')
        {
            $result .= "->comment('{$params->comment}')";
        }

        return $result;
    }
}
