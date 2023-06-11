<?php

namespace Apps\Core\AbstractClasses;

if ( ! defined('ROOT')) {
    exit();
}

use Apps\Core\Config\Config;
use Apps\Core\DataBase\DataBase;
use Apps\Core\Interfaces\ModelInteface;
use Exception;
use PDO;
use stdClass;

/**
 * Класс AbstractModel
 * @version 0.0.1
 * @package Apps\Core\AbstractClasses\AbstractModel
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
abstract class AbstractModel extends AbstractFactoryModel implements ModelInteface
{

    public static Config $settings;
    public static string $sql;
    public DataBase $DB;
    public int $count = 1;
    public array $bindParam = [];

    /**
     * Конструктор класса
     */
    public function __construct()
    {
        self::$settings = new Config('mysql');
        $this->DB = new \Apps\Core\DataBase\DataBase(self::$settings);
    }

    /**
     * Обработка вызова не существующего статического метода
     * @param string $name имя вызываемого метода
     * @param array $params параметры вызываемого метода
     * @return mixed|stdClass
     */
    public static function __callStatic(string $name, array $params)
    {
        $obj = new static();
        if (method_exists($obj, $name)) {
            return call_user_func_array([$obj, $name], $params);
        }
        return $obj->__call($name, $params);
    }

    public function __call(string $name, array $params)
    {
        $requestFilds = [];
        $filds = explode(' ', mb_strtolower(preg_replace(['~^getBy~ui', '~and~ui'], ['', ' '], $name)));
        foreach ($filds as $fild) {
            $requestFilds[] = $this->getFildName($fild);
        }
        $queryParams = $this->getCallParams($requestFilds, $params);
        if ($queryParams) {
            $query = $this->DB->query($queryParams, $this->bindParam);
            if ($this->count > 1) {
                return $query->fetchAll(PDO::FETCH_CLASS, $this->className);
            } else {
                return $query->fetchObject($this->className);
            }
        }
        return parent::__call($name, $params);
    }

    public function getFildName(string $name): string
    {
        foreach ($this->getFilds() as $key) {
            if (strtolower($key) === strtolower($name)) {
                return strtolower($key);
            }
        }
        return '';
    }

    /**
     * Получить список колонок таблицы
     * @return array
     */
    public function getFilds(): array
    {
        return array_keys(($this->getTableStructure())['filds']);
    }

    /**
     * Получить структуру таблицы
     * @return array
     */
    public function getTableStructure(): array
    {
        return $this->tableStructure;
    }

    /**
     * Генерация параметров для запроса в базу данных по несуществующим методам
     * @param type $requestFilds
     * @param type $params
     * @return array
     */
    private function getCallParams($requestFilds, $params): string
    {
        $sql = "SELECT * FROM `" . $this->getTableName() . "`";
        $endWhere = '';
        $order = $this->getOrderSql();
        for ($i = 0, $iMax = count($requestFilds); $i < $iMax; $i ++ ) {
            if (isset($params[$i]) and isset($requestFilds[$i]) and (is_string($params[$i]) or is_int($params[$i]) or is_array($params[$i]))) {
                $endWhere .= $this->getCondition($params, $requestFilds, $i);
            }
        }
        if (count($params) - 2 > count($requestFilds)) {
            $order = $this->getOrderSql(array_pop($params));
        }
        self::$sql = $sql . $endWhere . $order;
        self::$sql .= $this->getLimitParams($params, $requestFilds);
        return self::$sql;
    }

    /**
     * Получить наименование таблицы в базе данных
     * @return string
     * @throws Exception
     */
    public function getTableName(): string
    {
        $structure = $this->getTableStructure();
        if (isset($structure['tablePrefix']) and isset($structure['tableName'])) {
            return mb_strtolower($structure['tablePrefix'] . $structure['tableName']);
        } elseif ( ! isset($structure['tablePrefix']) and isset($structure['tableName'])) {
            return mb_strtolower($structure['tableName']);
        }
        throw new Exception('Не укзано название таблицы в моделе ' . $this->className);
    }

    private function getOrderSql(array $order = []): string
    {
        $count = count($order);
        $sql = ' ORDER BY ' . $this->getFildName('date_create') . ' ASC';
        if ( ! $order or $count === 0) {
            return $sql;
        }
        $sql = ' ORDER BY ';
        $keys = array_keys($order);
        $values = array_values($order);
        for ($i = 0; $i < $count; $i ++ ) {
            if (is_string($values[$i]) and mb_strtoupper($values[$i]) !== 'ASC') {
                $sort = 'DESC';
            } else {
                $sort = 'ASC';
            }
            if ($i > 0) {
                $sql .= ', ';
            }
            $sql .= $this->getFildName($keys[$i]) . ' ' . $sort;
        }
        return $sql;
    }

    private function getCondition($params, $requestFilds, $i)
    {
        $endWhere = '';
        $condition = ' = ';
        if (is_array($params[$i])) {
            $endWhere .= $this->toArrayCondition($params, $i, $requestFilds);
        } else {
            $endWhere .= $this->toStringCondition($i, $requestFilds, $condition, $params[$i]);
        }
        return $endWhere;
    }

    private function toArrayCondition($params, $i, $requestFilds)
    {
        $sql = '';
        $condition = "IN (";
        $step = 0;
        foreach ($params[$i] as $param) {
            if ($step > 0) {
                $condition .= ", ";
            }
            $condition .= $this->setBindParams($param);
            $step ++;
        }
        $condition .= ") ";
        if ($i === 0) {
            $sql .= ' WHERE `' . $this->getTableName() . '`.`' . $this->getFildName($requestFilds[$i]) . "` " . $condition;
        } else {
            $sql .= ' AND `' . $this->getTableName() . '`.`' . $this->getFildName($requestFilds[$i]) . "` " . $condition;
        }
        return $sql;
    }

    public function setBindParams($value)
    {
        $bindName = $this->getBindName('params');
        $this->bindParam[$bindName] = $value;
        return $bindName;
    }

    /**
     * Сгенерировать наименование bind-параметра
     * @param string $name Наименование параметра
     * @return string
     */
    public function getBindName(string $name): string
    {
        return ':' . preg_replace('~(\W+)~u', '_', $name) . '_' . count($this->bindParam);
    }

    private function toStringCondition($i, $requestFilds, $condition, $param)
    {
        $sql = '';
        if ($i === 0) {
            $sql .= ' WHERE `' . $this->getTableName() . '`.`' . $this->getFildName($requestFilds[$i]) .
                "`" . $condition . $this->setBindParams($param);
        } else {
            $sql .= ' AND `' . $this->getTableName() . '`.`' . $this->getFildName($requestFilds[$i]) .
                "`" . $condition . $this->setBindParams($param);
        }
        return $sql;
    }

    private function getLimitParams($params)
    {
        $countParams = count($params);
        $sql = '';
        $start = 0;
        $count = end($params);
        settype($count, 'int');
        if ($count <= 0) {
            $count = 1;
        }
        if (($countParams - 2) > 1) {
            $start = $params[$countParams - 2];
        }
        settype($start, 'int');
        $this->count = $count;
        $query = $this->DB->query(self::$sql, $this->bindParam);
        if ($count = $query->rowCount()) {
            $this->View->count_elements = $count;
        }
        $sql .= ' LIMIT ' . $this->count;
        if ($start) {
            $sql .= ' OFFSET ' . $start;
        }
        return $sql;
    }

    public function getFildStructure(string $fildName): array
    {
        $filds = $this->getTableStructure()['filds'];
        $keys = array_keys($filds);
        for ($i = 0, $iMax = count($filds); $i < $iMax; $i ++ ) {
            if ($this->getFildName($fildName) === $keys[$i]) {
                if (isset($keys[$i - 1])) {
                    $filds[$keys[$i]]['after'] = $keys[$i - 1];
                }
                $filds[$keys[$i]]['name'] = $keys[$i];
                $filds[$keys[$i]];
                return $filds[$keys[$i]];
            }
        }
        return [];
    }

    /**
     * Получить новое свойство текущего объекта
     * @param string $name Наименование свойства текущего объекта
     * @return
     */
    public function __get(string $name)
    {
        $method = 'get' . ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method();
        }
        $this->$name = parent::__get($name);
        return $this->$name;
    }

    /**
     * Установить новое свойство текущего объекта
     * @param string $name Наименование свойства текущего объекта
     * @param type $value Установливоемое значение свойства
     * @return self
     */
    public function __set(string $name, $value)
    {
        $this->$name = $value;
        return $this;
    }

    /**
     * Сохранить или обновить запись в базе данных
     * @return ModelInteface|false
     * @throws Exception
     */
    public function save()
    {
        $check = $this->check();
        if ( ! $check) {
            return $this->create();
        }
        return $this->update($check);
    }

    /**
     * Проверить существование записи в таблице по колонке $fildName
     * @param string $fildName Наименование кололки в таблице
     * @return object
     * @throws Exception
     */
    public function check(string $fildName = 'uid')
    {
        $this->{($this->getFildName('uid'))} = $this->getUid();
        if (in_array($this->getFildName($fildName), $this->getFilds())) {
            $fildValue = $this->getFildName($fildName);
            $sql = "SELECT * FROM `" . $this->getTableName() . "` " .
                "WHERE `" . $this->getFildName($fildName) . "` = " .
                $this->setBindParams($this->$fildValue);
            $result = $this->DB->query($sql, $this->bindParam)->fetchObject($this->className);
            if ($result) {
                return $result;
            }
            return false;
        }
        throw new Exception('Указана отсутcтвующая колонка ' . $fildName . ' в моделе ' . $this->className);
    }

    /**
     * Получить текущее значение uid или сгенерировать новое
     * @return string
     */
    public function getUid(): string
    {
        $uidName = $this->getFildName('uid');
        if ( ! isset($this->$uidName)) {
            $data = new stdClass();
            foreach ($this as $key => $value) {
                if ( ! in_array($key, $this->getIgnoreFilds())
                    and in_array($key, $this->getFilds())) {
                    $data->$key = $value;
                }
            }
            $md5 = md5(json_encode($data));
            return preg_replace(
                '~^(\w{8})(\w{4})(\w{4})(\w{4})(\w{12})~',
                '$1-$2-$3-$4-$5',
                $md5
            );
        }
        return $this->$uidName;
    }

    /**
     * Получить список игнорируемых колонок таблицы при создании sql запроса
     * @return array
     */
    public function getIgnoreFilds(): array
    {
        $ignoreFilds = [];
        $filds = ($this->getTableStructure())['filds'];
        foreach ($filds as $key => $value) {
            if (isset($value['ignored']) and $value['ignored']) {
                $ignoreFilds[] = $this->getFildName($key);
            }
        }
        return $ignoreFilds;
    }

    /**
     * Создать запись в базе данных
     * @return ModelInteface|false
     */
    private function create()
    {
        $this->{($this->getFildName('date_create'))} = date('Y-m-d H:i:s');
        $this->{($this->getFildName('date_update'))} = date('Y-m-d H:i:s');
        $this->{($this->getFildName('uid'))} = $this->getUid();
        $filds = $this->toArray();
        $this->bindParam = [];
        $queryParams = $this->getInsertParams($filds);
        $query = $this->DB->query($queryParams, $this->bindParam);
        if ($query->rowCount()) {
            $newUserId = $this->DB->getLatsInsertId('id');
            return $this->getById($newUserId);
        }
        return false;
    }

    /**
     * Получить текущий объект в виде массива
     * @return array
     */
    public function toArray(): array
    {
        $arrayData = [];
        foreach ($this as $key => $value) {
            if (in_array($key, $this->getFilds())) {
                $arrayData[$key] = $value;
            }
        }
        return $arrayData;
    }

    private function getInsertParams($filds)
    {
        $fildsKeys = $this->getFilds();
        $fildsString = '';
        $valuesString = '';
        foreach ($this as $key => $value) {
            if (in_array($key, $fildsKeys) and $key !== $this->getFildName('id')) {
                $fildsString .= ' `' . $this->getFildName($key) . '`,';
                $valuesString .= ' ' . $this->setBindParams($value) . ',';
            }
        }
        $sql = 'INSERT INTO `' . $this->getTableName() . '` (' .
            trim($fildsString, ',') . ') VALUES (' .
            trim($valuesString, ',') . ')';
        return $sql;
    }

    public function getById($userId)
    {
        $this->bindParam = [];
        $sql = "SELECT * FROM `" . self::$settings->db_name . "`.`" . $this->getTableName() .
            "` WHERE `id` = " . $this->setBindParams($userId);
        $result = $this->query($sql, $this->bindParam)->fetchObject($this->className);
        return $result;
    }

    public function query($sql, $binds = []): \PDOStatement
    {
        return $this->DB->query($sql, $binds);
    }

    /**
     * Обновление записи в таблице
     * @return ModelInteface|false
     * @throws Exception
     */
    public function update($obj)
    {
        $updateData = $this->getUpdateParams($obj);
        $query = $this->DB->query($updateData, $obj->bindParam);
        if ($query) {
            $result = $this->getById($obj->{($obj->getFildName('id'))});
            return $result;
        }
        return false;
    }

    /**
     * Генерация параметров для обновления записи
     * @param type $filds
     * @param type $fildsKeys
     * @return array
     */
    private function getUpdateParams($obj)
    {
        $obj->{$this->getFildName('date_update')} = date('Y-m-d H:i:s');
        $sql = "UPDATE `" . $obj->getTableName() . "` SET ";
        foreach ($obj as $key => $value) {
            if (in_array($key, array_keys($obj->toArray())) and $key !== 'id') {
                $sql .= "`" . $key . "` = " . $obj->setBindParams($value) . ', ';
            }
        }
        $sql = trim($sql, ', ') . " WHERE `id` = " . $obj->setBindParams($obj->id);
        return $sql;
    }

    /**
     * Получить текущий объект или его свойство $name
     * @param string $name Наименование свойства объкта
     * @return
     */
    public function get(string $name = '')
    {
        if ( ! $name) {
            return $this;
        }
        return $this->{$this->getFildName($name)};
    }

    private function checkFilds($filds)
    {
        $fildsKeys = array_keys($filds);
        foreach ($this->getFilds() as $fild) {
            if ( ! in_array($fild, $fildsKeys)) {
                return false;
            }
        }
        return true;
    }

}
