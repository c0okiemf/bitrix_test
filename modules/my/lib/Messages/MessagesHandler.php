<?php namespace My\Messages;

use CPHPCache;
use My\ORM\MessagesTable;

class MessagesHandler
{
    const CACHE_TTL = 3600;
    const CACHE_ID = 'messages_table';
    const CACHE_DIR = '/bitrix/cache/my/';

    public static function retrieveMessages($cnt)
    {
        $cacheDir = $_SERVER["DOCUMENT_ROOT"] . self::CACHE_DIR;
        $cache  = new CPHPCache();
        if($cache->InitCache(self::CACHE_TTL, self::CACHE_ID, $cacheDir)) {
            $result = $cache->GetVars()['mess'];
        } else {
            $messRes = MessagesTable::getList([
                'order' => ['UF_FIELD_DATE' => 'DESC'],
                'limit' => $cnt,
            ]);
            $result = [];
            while ($mess = $messRes->fetch()) {
                $result[] = [
                    'MESSAGE' => $mess['UF_FIELD_MESSAGE'],
                    'DATE' => $mess['UF_FIELD_DATE']
                ];
            }
            $cache->StartDataCache(self::CACHE_TTL, self::CACHE_ID, $cacheDir);
            $cache->EndDataCache(['mess' => $result]);
        }

        return $result;
    }
}
