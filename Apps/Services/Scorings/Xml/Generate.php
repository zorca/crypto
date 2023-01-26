<?php

namespace Apps\Services\Scorings\Xml;

if (!defined('ROOT')) {
    exit();
}

use Apps\Core\Config\Config;
use XMLWriter;

/**
 * Класс Generate
 * @version 0.0.1
 * @package Apps\Services\Scorings\Xml\Generate
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич.
 */
abstract class Generate
{

    protected ?XMLWriter $obj = null;
    protected ?string $file = null;
    protected $config;

    public function __construct()
    {
        $this->config = (new Config())->get('equifax');
        $this->file = ROOT . 'private' . SEP . 'xml' . SEP .
            'scorings' . SEP . date('d.m.Y') . SEP . time() . rand() . '.xml';
        $dir = dirname($this->file);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        $this->obj = new XMLWriter();
        $this->obj->openUri($this->file);
    }

    /**
     * Получить путь к файлу документа
     * @return string
     */
    protected function get(): string
    {
        $this->obj->endDocument();
        return $this->file;
    }

    /**
     * Запустить генерацию документа
     * @param string $version Версия документа
     * @param string $encoding Кодировка документа
     * @return self
     */
    protected function startDocument(string $version = '1.0', string $encoding = 'utf-8'): self
    {
        $this->obj->startDocument($version, $encoding);
        return $this;
    }

    /**
     * Добавить элемент с содержанием
     * @param string $name Наименование элемента
     * @param string $content Содержание элемента
     * @param array $attribites Атрибуты элемента
     * @param string|null $comment Коментарий элемента
     * @return self
     */
    protected function addElement(string $name, ?string $content = null, array $attribites = [], ?string $comment = null): self
    {
        if ($name and $content) {
            $this->startElement($name, $attribites, $comment);
            $this->obj->text($content);
            $this->closeElement();
        }
        return $this;
    }

    /**
     * Открыть элемент схемы
     * @param string $name Наименование элемента
     * @param array $attribites Атрибуты элемента
     * @param string|null $comment коментарий к элементу
     * @return self
     */
    protected function startElement(string $name, array $attribites = [], ?string $comment = null): self
    {

        if ($comment) {
            $this->obj->startComment();
            $this->obj->text($comment);
            $this->obj->endComment();
        }
        $this->obj->startElement($name);
        if ($attribites) {
            foreach ($attribites as $key => $value) {
                $this->addAttribute($key, $value);
            }
        }
        return $this;
    }

    /**
     * Добавить атрибут к элементу
     * @param string $name Наименование атрибута
     * @param string $text Значение атрибута
     * @return self
     */
    protected function addAttribute(string $name, string $text): self
    {
        if ($name and $text) {
            $this->obj->startAttribute($name);
            $this->obj->text($text);
            $this->obj->endAttribute();
        }
        return $this;
    }

    /**
     * Закрыть элемент схемы
     * @return self
     */
    protected function closeElement(): self
    {
        $this->obj->endElement();
        return $this;
    }

    /**
     *
     * @param string $date
     * @param string $format
     * @return string
     */
    protected function dateFormat(string $date, string $format = 'd.m.Y'): string
    {
        return date($format, strtotime($date));
    }

}
