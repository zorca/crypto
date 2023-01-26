<?php

namespace Apps\Core\DataBase;

if (!defined('ROOT')) {
    exit();
}

use Apps\Core\Config\Config;
use PDO;
use stdClass;

/**
 * Класс DataBase
 * @version 0.0.1
 * @package Apps\Core\DataBase\DataBase
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class DataBase
{

    private static array
        $connect,
        $stmt,
        $query;
    private static int $queryCount = 0;
    public $settings;
    private string $connectIndex;

    public function __construct(Config $settings)
    {
        $this->connectIndex = md5(json_encode($settings));
        $this->settings = $settings;
        if (!isset(self::$connect[$this->connectIndex])) {
            self::$connect[$this->connectIndex] = new PDO(
                $this->settings->dsn,
                $this->settings->username,
                $this->settings->password,
                $this->getOptions($this->settings->options)
            );
            self::$connect[$this->connectIndex]->beginTransaction();
        }
    }

    private function getOptions(stdClass $options)
    {
        $data = [];
        foreach ($options as $key => $value) {
            if (defined($key)) {
                if (defined($value)) {
                    $data[constant($key)] = constant($value);
                } else {
                    $data[constant($key)] = $value;
                }
            }
        }
        return $data;
    }

    public function __destruct()
    {
        $this->commit();
    }

    public function commit()
    {
        if (self::$connect[$this->connectIndex]->inTransaction()) {
            self::$connect[$this->connectIndex]->commit();
        }
    }

    public function getLatsInsertId(string $name = 'id')
    {
        return self::$connect[$this->connectIndex]->lastInsertId($name);
    }

    public function rollBack()
    {
        $this->settings->rollBack();
    }

    public function query(string $sql, array $bindParams = [], array $prepareOptions = [])
    {
        $queryIndex = md5($sql . json_encode($bindParams));
        self::$queryCount++;
        if (self::$queryCount >= 30000) {
            $this->commit();
        }
        self::$stmt[$queryIndex] = $this->prepare($sql, $queryIndex, $prepareOptions);
        self::$query[$queryIndex] = self::$stmt[$queryIndex]->execute($bindParams);
        return self::$stmt[$queryIndex];
    }

    private function prepare(string $sql, string $queryIndex, array $prepareOptions = [])
    {
        if (!isset(self::$stmt[$queryIndex])) {
            self::$stmt[$queryIndex] = self::$connect[$this->connectIndex]->prepare($sql, $prepareOptions);
        }
        return self::$stmt[$queryIndex];
    }

}
