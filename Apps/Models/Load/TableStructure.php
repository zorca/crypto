<?php

namespace Apps\Models\Load;

/**
 * Трейт TableStructure
 * @version 0.0.1
 * @package Apps\Models\Users
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
trait TableStructure
{

    public $tableStructure = [
        'tableName' => 'files',
        'tablePrefix' => '',
        'filds' => [
            'id' => [
                'type' => 'INT',
                'lenght' => 11,
                'default' => false,
                'charset' => false,
                'null' => false,
                'attributes' => false,
                'auto_incremet' => true,
                'indexes' => [
                    'primary'
                ],
                'comment' => 'Id в системе',
            ],
            'uid' => [
                'type' => 'VARCHAR',
                'null' => false,
                'lenght' => 50,
                'default' => '',
                'charset' => 'utf8',
                'indexes' => [
                    'unique'
                ],
                'comment' => 'Уникальный идентификатор пользователя в системе',
            ],
            'flag' => [
                'type' => 'INT',
                'null' => false,
                'lenght' => 1,
                'default' => 0,
                'comment' => 'Флаг загрузки (0 - не скачан| 1 - скачан)',
            ],
            'alias' => [
                'type' => 'VARCHAR',
                'null' => false,
                'lenght' => 40,
                'default' => '',
                'charset' => 'utf8',
                'indexes' => [
                    'unique'
                ],
                'comment' => 'Алиас ссылки для файла',
            ],
            'file' => [
                'type' => 'VARCHAR',
                'null' => false,
                'lenght' => 250,
                'default' => '',
                'charset' => 'utf8',
                'comment' => 'Путь файла для загрузки',
            ],
            'type' => [
                'type' => 'VARCHAR',
                'null' => false,
                'lenght' => 10,
                'default' => '',
                'charset' => 'utf8',
                'comment' => 'Тип файла (file|sign)',
            ],
            'date_create' => [
                'type' => 'datetime',
                'default' => 'current_timestamp',
                'indexes' => [
                    'INDEX'
                ],
                'comment' => 'Дата создания записи в системе',
                'ignored' => true
            ],
            'date_update' => [
                'type' => 'datetime',
                'default' => 'current_timestamp',
                'indexes' => [
                    'INDEX'
                ],
                'comment' => 'Дата обновления записи в системе',
            ]
        ]
    ];

}
