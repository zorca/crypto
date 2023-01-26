<?php

namespace Apps\Core\Router;

if (!defined('ROOT')) {
    exit();
}

use Apps\Core\Config\Json;
use Apps\Core\Request\Server;
use stdClass;

/**
 * Класс Router
 * @version 0.0.1
 * @package Apps\Core\Router\Router
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class Router
{

    /**
     * Строка запроса
     * @var string
     */
    public static string $patch = "";

    /**
     * Все возможные машруты запроса
     * @var Json
     */
    private static Json $routes;

    /**
     * Метод запроса
     * @var string
     */
    private string $method = "";

    /**
     * Конструктор класса
     * @param Server $server Объект класса \Apps\Core\Request\Server
     */
    public function __construct(Server $server)
    {
        $this->method = $this->getMethod($server);
        self::$patch = $this->getPatch($server);
        self::$routes = $this->loadRoutes($this->method);
    }

    /**
     * Получение метода запроса
     * @param Server $server Объект класса \Apps\Core\Request\Server
     * @return string|false Метод запроса
     */
    private function getMethod(Server $server)
    {
        if (isset($server->REQUEST_METHOD)) {
            if (!empty($server->REQUEST_METHOD)) {
                return mb_strtolower($server->REQUEST_METHOD);
            }
        }
        return 'cli';
    }

    /**
     * Получение форматированой строки запроса без GET параметров
     * @param Server $server Объект класса \Apps\Core\Request\Server
     * @return string путь для поиска и выполнения маршрута
     */
    private function getPatch(Server $server): string
    {
        $patch = urldecode(trim(parse_url($server->REQUEST_URI, PHP_URL_PATH), '/'));
        if (!$patch) {
            return 'default';
        }
        return $patch;
    }

    /**
     * Загрузка маршрутов
     * @param string $method Метод запроса для поиска файла маршрутов
     * @return Json Объект с объектами маршрутов
     */
    private function loadRoutes(string $method): Json
    {
        $routeFile = ROOT . 'routes' . SEP . $method . '.json';
        return (new Json())->get($routeFile);
    }

    /**
     * Запуск машрутизации
     * @return   Результат выполнения запроса в случае успеха или false в случае неудачи
     */
    public function run()
    {
        foreach (self::$routes as $pattern => $command) {
            if (preg_match('~^' . $pattern . '~ui', self::$patch)) {
                $this->pattern = $pattern;
                return $this->command($command);
            }
        }
        return false;
    }

    /**
     * Исполнение запроса
     * @param stdClass $command Объект класса со свойствами для выполнения запроса
     * @param string $pattern Шаблон регулярного выражения для поиска параметров
     * @return   Результат выполнения запроса
     */
    private function command(stdClass $command)
    {
        $controller = $command->controller;
        $action = $this->getAction($command->method);
        $params = $this->getParams($command->params, self::$patch, $this->pattern);
        if (class_exists($controller) and method_exists($controller, $action)) {
            return call_user_func_array([new $controller(), $action], $params);
        }
        return false;
    }

    /**
     * Получить метод который необходимо выполнить в запрошенном классе
     * @param string $method Краткое наименование метода
     * @return string Наименование метода
     */
    private function getAction($method = false): string
    {
        if ($this->method === 'cli' and $method) {
            return $this->getCliAction($method);
        } elseif (!$method) {
            return $this->method . 'IndexAction';
        }
        return $this->method . ucfirst($this->getCliAction($method)) . 'Action';
    }

    private function getCliAction(string $method)
    {
        return preg_replace('~^' . $this->pattern . '$~ui', $method, self::$patch);
    }

    /**
     * Получить параметры для метода запроса
     * @param array $params Массив значений для замены по регулярному выражению
     * @param string $patch Строка запроса
     * @param string $pattern Шаблон регулярного выражения для поиска параметров
     * @return array Массив параметров
     */
    private function getParams(array $params, string $patch): array
    {
        $data = [];
        foreach ($params as $param) {
            $data[] = preg_replace('~^' . $this->pattern . '$~ui', $param, $patch);
        }
        return $data;
    }

}
