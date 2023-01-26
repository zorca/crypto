<?php

namespace Apps\Core\Interfaces;

use PDOStatement;

/**
 * Интерфейс ModelInteface
 * @version 0.0.1
 * @package Apps\Core\AbstractClasses\ModelInteface
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
interface ModelInteface
{

    /**
     * Конструктор класса
     */
    public function __construct();

    public function query(string $sql, array $bindParams = []): PDOStatement;

    /**
     * Получить наименование таблицы в базе данных
     * @return string
     * @throws Exception
     */
    public function getTableName(): string;

    /**
     * Получить наименование колонки в таблице
     * @param string $name
     * @return string
     */
    public function getFildName(string $name): string;

    /**
     * Получить структуру колонки в моделе
     * @param string $fildName
     * @return array
     */
    public function getFildStructure(string $fildName);

    /**
     * Получить структуру таблицы
     * @return array
     */
    public function getTableStructure(): array;

    /**
     * Получить текущее значение uid или сгенерировать новое
     * @return string
     */
    public function getUid(): string;

    /**
     * Установить новое свойство текущего объекта
     * @param string $name Наименование свойства текущего объекта
     * @param type $value Установливоемое значение свойства
     * @return self
     */
    public function __set(string $name, $value);

    /**
     * Проверить существование записи в таблице по колонке $fildName
     * @param string $fildName Наименование кололки в таблице
     * @return object
     * @throws Exception
     */
    public function check(string $fildName = 'uid');

    /**
     * Получить список полей таблицы в виде массива
     * @return array
     */
    public function getFilds(): array;

    /**
     * Получить список игнорируемых колонок таблицы при создании sql запроса
     * @return array
     */
    public function getIgnoreFilds(): array;

    /**
     * Сгенерировать наименование bind-параметра
     * @param string $name Наименование параметра
     * @return string
     */
    public function getBindName(string $name): string;

    /**
     * Получить текущий объект в виде массива
     * @return array
     */
    public function toArray(): array;

    /**
     * Получить текущий объект или его свойство $name
     * @param string $name Наименование свойства объкта
     * @return
     */
    public function get(string $name = '');

    /**
     * Сохранить или обновить запись в базе данных
     * @return ModelInteface|false
     */
    public function save();
}
