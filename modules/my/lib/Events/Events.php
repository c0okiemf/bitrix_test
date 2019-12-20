<?php namespace My\Events;

use Bitrix\Main\Loader;
use CPHPCache;
use My\Messages\MessagesHandler;

class Events
{
    const EVENTS = [
        ['main', 'MessagesOnAfterUpdate', 'my', '\my\Events\Events', 'clearCache'],
        ['main', 'MessagesOnAfterDelete', 'my', '\my\Events\Events', 'clearCache'],
        ['main', 'MessagesOnAfterAdd', 'my', '\my\Events\Events', 'clearCache']
    ];

    public static function bind()
    {
        foreach (self::EVENTS as $event) {
            RegisterModuleDependences(...$event);
        }
    }

    public static function unBind()
    {
        foreach (self::EVENTS as $event) {
            UnRegisterModuleDependences(...$event);
        }
    }

    public static function clearCache()
    {
        $obCache = new CPHPCache();
        $cacheDir = $_SERVER["DOCUMENT_ROOT"] . MessagesHandler::CACHE_DIR;
        $obCache->Clean(MessagesHandler::CACHE_ID, $cacheDir);
    }
}