<?php namespace My\ORM;

use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Event;
use My\Events\Events;

Loc::loadMessages(__FILE__);

class MessagesTable extends DataManager
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'messages';
    }

    /**
     * Returns entity map definition.
     *
     * @return array
     */
    public static function getMap()
    {
        return array(
            'ID' => array(
                'data_type' => 'integer',
                'primary' => true,
                'autocomplete' => true,
                'title' => Loc::getMessage('_ENTITY_ID_FIELD'),
            ),
            'UF_FIELD_MESSAGE' => array(
                'data_type' => 'text',
                'title' => Loc::getMessage('_ENTITY_UF_FIELD_MESSAGE_FIELD'),
            ),
            'UF_FIELD_DATE' => array(
                'data_type' => 'datetime',
                'title' => Loc::getMessage('_ENTITY_UF_FIELD_DATE_FIELD'),
            ),
        );
    }

    public static function OnAfterAdd(Event $event)
    {
        Events::clearCache();
    }

    public static function OnAfterDelete(Event $event)
    {
        Events::clearCache();
    }

    public static function OnAfterUpdate(Event $event)
    {
        Events::clearCache();
    }
}