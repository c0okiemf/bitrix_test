<?php

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Loader;

class MigrateIBlock
{
    const NAME = 'Messages';
    const TABLE_NAME = 'messages';

    const FIELDS = [
        [
            'ENTITY_ID' => 'HLBLOCK_',
            'FIELD_NAME' => 'UF_FIELD_MESSAGE',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => 'message',
            'SORT' => '100',
            'MANDATORY' => 'Y',
            'EDIT_FORM_LABEL'   => [
                'ru'    => 'Сообщение',
                'en'    => 'Message',
            ],
            'LIST_COLUMN_LABEL' => [
                'ru'    => 'Сообщение',
                'en'    => 'Message',
            ],
            'LIST_FILTER_LABEL' => [
                'ru'    => 'Сообщение',
                'en'    => 'Message',
            ]
        ],
        [
            'ENTITY_ID' => 'HLBLOCK_',
            'FIELD_NAME' => 'UF_FIELD_DATE',
            'USER_TYPE_ID' => 'datetime',
            'XML_ID' => 'date_created',
            'SORT' => '100',
            'MANDATORY' => 'Y',
            'EDIT_FORM_LABEL'   => [
                'ru'    => 'Дата создания',
                'en'    => 'Date created',
            ],
            'LIST_COLUMN_LABEL' => [
                'ru'    => 'Дата создания',
                'en'    => 'Date created',
            ],
            'LIST_FILTER_LABEL' => [
                'ru'    => 'Дата создания',
                'en'    => 'Date created',
            ]
        ]
    ];

    private static function connect()
    {
        Loader::includeModule('highloadblock');
    }

    public static function up()
    {
        self::connect();
        $res = HighloadBlockTable::add(array(
            'NAME' => self::NAME,
            'TABLE_NAME' => self::TABLE_NAME
        ));
        if ($res->isSuccess()) {
            self::addColumn($res->getId());
        } else {
            throw new Exception('Unable to create table "messages"');
        }
    }

    private static function addColumn($id)
    {
        $obUserField = new CUserTypeEntity;
        $fields = self::FIELDS;
        foreach ($fields as &$field) {
            $field['ENTITY_ID'] .= $id;
            $res = $obUserField->Add($field);
            if (!$res) {
                throw new Exception('Unable to create a column.');
            }
        }
    }

    public static function down()
    {
        self::connect();
        $id = HighloadBlockTable::getList(['filter' => ['NAME' => self::TABLE_NAME], 'select' => ['ID']])->fetch();
        HighloadBlockTable::delete($id);
    }
}
