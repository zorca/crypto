<?php

namespace Apps\Core\Config;

/**
 * Класс Json
 * @version 0.0.1
 * @package Apps\Core\Config\Json
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
final class Json
{

    public function get(string $fileName): self
    {
        if (is_file($fileName)) {
            $this->load($fileName);
        }
        return $this;
    }

    private function load(string $fileName): self
    {
        $jsonData = json_decode(file_get_contents($fileName));
        $this->selfLoad($jsonData);
        return $this;
    }

    private function selfLoad($jsonData): void
    {
        foreach ($jsonData as $key => $value) {
            $this->$key = $value;
        }
    }

    public function set(string $file, $data): self
    {
        $this->selfLoad($data);
        file_put_contents($file, $data, FILE_APPEND | LOCK_EX);
        return $this;
    }

}
