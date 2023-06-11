<?php

namespace Apps\Console;

if ( ! defined('ROOT')) {
    exit();
}

use Apps\Core\Apps\Apps;
use Apps\Core\Interfaces\ModelInteface;
use PDO;

/**
 * Класс Megrate
 * @version 0.0.1
 * @package Apps\Console\Megrate
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class Megrate
{

    private static $ignoreTypes = [
        'datetime',
        'current_timestamp'
    ];
    private ModelInteface $class;

    public function run()
    {
        $apps = Apps::getApps();
        foreach ($apps as $class) {
            if (class_exists($class) and method_exists($class, 'getTableStructure')) {
                $obj = new $class();
                $this->inpestor($obj->getTableStructure(), $obj);
            }
        }
    }

    private function inpestor(array $tableStructure, ModelInteface $class)
    {
        $structureInDb = [];
        $this->class = $class;
        $dbName = $class::$settings->db_name;
        $table = $class->getTableName();
        $dbTables = $this->getTablesInDb($class);
        echo PHP_EOL . "-------- Запуск миграции модели " . $this->class->className . "--------" . PHP_EOL;
        if (in_array($table, $dbTables)) {

            $structureInDb = $this->getTableStructureInDb($table, $dbName);
            $this->updateTable($structureInDb, $tableStructure);
        } else {
            echo "\t - Создание таблицы " . $table;
            $this->createTable();
        }
        echo "-------- Миграция выполнена --------" . PHP_EOL;
    }

    private function getTablesInDb($class): array
    {
        $tables = $class->query("SHOW TABLES FROM `" . $class::$settings->db_name . "`")->fetchAll(PDO::FETCH_CLASS);
        $data = [];
        foreach ($tables as $table) {
            $data[] = $table->{'Tables_in_' . $class::$settings->db_name};
        }
        return $data;
    }

    private function getTableStructureInDb($table, $dbName)
    {
        $sql = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS " .
            "WHERE table_name = " . $this->class->setBindParams($table) . " " .
            "AND TABLE_SCHEMA = " . $this->class->setBindParams($dbName);
        return $this->class->query($sql, $this->class->bindParam)->fetchAll(PDO::FETCH_ASSOC);
    }

    private function updateTable($structureTableInDb)
    {
        $columnsInDb = [];
        foreach ($structureTableInDb as $fild) {
            $columnsInDb[] = $fild['COLUMN_NAME'];
        }
        foreach ($this->class->getFilds() as $key => $newFild) {
            if ( ! in_array($newFild, $columnsInDb)) {
                $this->addFild($newFild);
            }
        }
        foreach ($columnsInDb as $key => $fild) {
            if ( ! in_array($fild, $this->class->getFilds())) {
                $this->dropColumn($fild);
                unset($columnsInDb[$key]);
            }
        }
        foreach ($columnsInDb as $fild) {
            $this->changeColumn($fild);
        }
        echo "\t Обновление таблицы " . $this->class->getTableName() . " - Завершено " . PHP_EOL;
    }

    public function addFild($newFild)
    {
        $message = "\t\t - Добавление новой колонки " . $newFild;
        $structure = $this->class->getFildStructure($newFild);
        $sql = "ALTER TABLE `" . $this->class->getTableName() . "` ADD `" . $newFild . "`";
        $sql .= $this->setColumnType($structure);
        $sql .= $this->setColumnLenght($structure);
        $sql .= $this->setColumnCharset($structure);
        $sql .= $this->setColumnNull($structure);
        $sql .= $this->setColumnAutoincrement($newFild);
        $sql .= $this->setColumnDefault($structure);
        $sql .= $this->setColumnComment($structure);
        $sql .= $this->setColumnAfter($structure);
        $sql .= $this->setColumnKeys($newFild);
        $exec = $this->class->DB->query($sql);
        if ($exec) {
            $message .= ' - Выполнено';
        } else {
            $message .= ' - Не выполнено';
        }
        echo $message . PHP_EOL;
    }

    private function setColumnType($structure)
    {
        if (isset($structure['type'])) {
            return ' ' . $structure['type'];
        } else {
            return ' VARCHAR ';
        }
    }

    private function setColumnLenght($structure)
    {
        if (isset($structure['lenght'])) {
            return '(' . $structure['lenght'] . ')';
        } elseif ( ! isset($structure['lenght']) and isset($structure['type']) and in_array($structure['type'], self::$ignoreTypes)) {
            return '';
        } else {
            return '(250)';
        }
    }

    private function setColumnCharset($structure)
    {
        $char = ' CHARACTER SET ';
        if (isset($structure['charset']) and $structure['charset']) {
            return $char . $structure['charset'];
        } else {
            return '';
        }
    }

    public function setColumnNull($structure)
    {
        if (isset($structure['null'])) {
            if ($structure['null'] === false) {
                return ' NOT NULL';
            }
        } else {
            return ' ';
        }
    }

    public function setColumnAutoincrement($newFild)
    {
        $structure = $this->class->getFildStructure($newFild);
        if (isset($structure['auto_incremet']) and $structure['auto_incremet']) {
            return ' AUTO_INCREMENT ';
        }
        return '';
    }

    public function setColumnDefault($structure)
    {
        $fild = false;
        if (isset($structure['default'])) {
            $fild = $structure['default'];
        }
        if (isset($fild)) {
            if ($fild === false) {
                return '';
            } elseif ($fild === null) {
                return ' DEFAULT NULL';
            } elseif ($fild === '') {
                return " DEFAULT ''";
            } elseif (mb_strtolower($fild) === 'not null') {
                return " DEFAULT NOT NULL";
            } elseif (in_array(mb_strtolower($fild), self::$ignoreTypes)) {
                return ' DEFAULT ' . mb_strtoupper($fild);
            } else {
                return " DEFAULT '" . $fild . "'";
            }
        } else {
            return ' DEFAULT NULL';
        }
    }

    private function setColumnComment($structure)
    {
        if (isset($structure['comment']) and ! empty($structure['comment'])) {
            return " COMMENT '" . trim($structure['comment']) . "'";
        }
        return false;
    }

    private function setColumnAfter($structure)
    {
        if (isset($structure['after'])) {
            return ' AFTER `' . $structure['after'] . '`';
        } else {
            return ' FIRST';
        }
    }

    public function setColumnKeys($fildName)
    {
        $indexes = [];
        $sql = '';
        $structure = $this->class->getFildStructure($fildName);
        if (isset($structure['indexes'])) {
            $indexes = $structure['indexes'];
        }
        foreach ($indexes as $index) {
            $key = ' KEY';
            if (mb_strtoupper($index) !== 'PRIMARY') {
                $key = '';
            }
            $sql .= ", ADD " . mb_strtoupper($index) . $key . "(`" . $fildName . "`)";
        }
        return $sql;
    }

    private function dropColumn(string $fildName)
    {
        $sql = "ALTER TABLE `" . $this->class->getTableName() . "` DROP `" . $fildName . "`;";
        $message = "\t\t - Удаление колонки " . $fildName . ' ';
        $exec = $this->class->query($sql);
        if ($exec) {
            $message .= ' - Выполнено';
        } else {
            $message .= ' - Не выполнено';
        }
        echo $message . PHP_EOL;
        return $exec;
    }

    private function changeColumn(string $fildName)
    {
        $structure = $this->class->getFildStructure($fildName);
        $message = "\t\t - Редактирование колонки " . $fildName;
        $sql = "ALTER TABLE `" . $this->class->getTableName() . "` CHANGE `" . $fildName . "` ";
        $sql .= "`" . $fildName . "`";
        $sql .= $this->setColumnType($structure);
        $sql .= $this->setColumnLenght($structure);
        $sql .= $this->setColumnCharset($structure);
        $sql .= $this->setColumnNull($structure);
        $sql .= $this->setColumnAutoincrement($fildName);
        $sql .= $this->setColumnDefault($structure);
        $sql .= $this->setColumnComment($structure);
        $sql .= $this->setColumnAfter($structure);
        $exec = $this->class->query($sql);
        if ($exec) {
            $message .= ' - Выполнено';
        } else {
            $message .= ' - Не выполнено';
        }
        echo $message . PHP_EOL;
    }

    private function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `" . $this->class::$settings->db_name . "`.`" . $this->class->getTableName() .
            "` ( `test` INT NOT NULL)";
        $this->class->query($sql);
        $structureTableInDb = $this->getTableStructureInDb($this->class->getTableName(), $this->class::$settings->db_name);
        echo "\t - Выполнено" . PHP_EOL;
        $this->updateTable($structureTableInDb);
    }

    public function getModelStructureByFildName($fildName, $fildsModel): array
    {
        if (in_array($this->class->getFildName($fildName), $fildsModel)) {
            return $this->class->getFildStructure($fildName);
        }
        return [];
    }

    public function addColumnKeys($newFild)
    {
        $indexes = [];
        $structure = $this->class->getFildStructure($newFild);
        if (isset($structure['indexes'])) {
            $indexes = $structure['indexes'];
        }
        foreach ($indexes as $index) {
            if (mb_strtolower($index) !== 'primary') {
                $sql = "ALTER TABLE `" . $this->class->getTableName() . "` ADD " . mb_strtoupper($index) . " KEY(`" . $newFild . "`)";
            } else {
                $sql = "ALTER TABLE `" . $this->class->getTableName() .
                    "`  ADD PRIMARY KEY (`" . $newFild . "`);";
            }
            $this->class->query($sql);
        }
    }

    private function getTabs($message)
    {
        $tabs = "\t";
        $lenght = ceil(strlen($message) / 8);
        for ($i = 0;
            $i < $lenght;
            $i ++) {
            $tabs .= "\t";
        }
        return $tabs;
    }

}
