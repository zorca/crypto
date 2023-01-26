<?php

namespace Apps\Models\Users;

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
        'tableName' => 'users',
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
                'virtuality' => false,
                'media-type' => false,
                'ignored' => true
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
                'ignored' => true
            ],
            'data' => [
                'type' => 'text',
                'charset' => 'utf8'
            ],
            'country' => [
                'type' => 'varchar',
                'lenght' => 25,
                'default' => null,
                'null' => null,
                'charset' => 'utf8',
                'comment' => 'Код страны',
            ],
            'region' => [
                'type' => 'varchar',
                'lenght' => 150,
                'charset' => 'utf8',
                'default' => null,
                'null' => null,
                'comment' => 'Регион',
            ],
            'city' => [
                'type' => 'varchar',
                'lenght' => 150,
                'default' => null,
                'null' => null,
                'charset' => 'utf8',
                'comment' => 'Населенный пункт',
            ],
            'street' => [
                'type' => 'varchar',
                'lenght' => 150,
                'default' => null,
                'null' => null,
                'charset' => 'utf8',
                'comment' => 'Улица',
            ],
            'name_company' => [
                'type' => 'varchar',
                'lenght' => 250,
                'default' => null,
                'null' => null,
                'charset' => 'utf8',
                'comment' => 'Краткое название компании',
            ],
            'full_name_company' => [
                'type' => 'text',
                'default' => null,
                'null' => null,
                'charset' => 'utf8',
                'comment' => 'Полное название компании',
            ],
            'name' => [
                'type' => 'varchar',
                'lenght' => 150,
                'default' => null,
                'null' => null,
                'charset' => 'utf8',
                'comment' => 'Имя и отчество пользователя',
            ],
            'last_name' => [
                'type' => 'varchar',
                'lenght' => 150,
                'default' => null,
                'null' => null,
                'charset' => 'utf8',
                'comment' => 'last_name пользователя',
            ],
            'official' => [
                'type' => 'varchar',
                'lenght' => 150,
                'default' => null,
                'null' => null,
                'charset' => 'utf8',
                'comment' => 'official пользователя',
            ],
            'snils' => [
                'type' => 'varchar',
                'lenght' => 150,
                'default' => null,
                'null' => null,
                'charset' => 'utf8',
                'comment' => 'СНИЛС пользователя',
            ],
            'ogrn' => [
                'type' => 'varchar',
                'lenght' => 150,
                'default' => null,
                'null' => null,
                'charset' => 'utf8',
                'comment' => 'ОГРН организации пользователя',
            ],
            'inn_yl' => [
                'type' => 'varchar',
                'lenght' => 150,
                'default' => null,
                'null' => null,
                'charset' => 'utf8',
                'comment' => 'ИНН юридического лица пользователя',
            ],
            'inn' => [
                'type' => 'varchar',
                'lenght' => 150,
                'default' => null,
                'null' => null,
                'charset' => 'utf8',
                'comment' => 'ИНН физического лица',
            ],
            'thumbprint' => [
                'type' => 'varchar',
                'lenght' => 150,
                'default' => null,
                'null' => null,
                'charset' => 'utf8',
                'comment' => 'Отпечаток сертификата пользователя',
            ],
            'email' => [
                'type' => 'varchar',
                'lenght' => 50,
                'default' => null,
                'null' => null,
                'charset' => 'utf8',
                'comment' => 'Email пользователя',
            ],
            'container' => [
                'type' => 'varchar',
                'lenght' => 350,
                'default' => '',
                'charset' => 'utf8',
                'comment' => 'Ключевой контейнер сертификата пользователя',
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
                'ignored' => true
            ]
        ]
    ];

}
