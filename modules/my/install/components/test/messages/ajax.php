<?php

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use My\ORM\MessagesTable;

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

try {
    $request = Application::getInstance()->getContext()->getRequest();
} catch (Exception $e) {
    die();
}

if ($request->isAjaxRequest()) {

    $message = $request->get('message');

    Loader::includeModule('my');
    $res = MessagesTable::add([
        'UF_FIELD_MESSAGE' => $message,
        'UF_FIELD_DATE' => (new \Bitrix\Main\Type\DateTime())
    ]);
}

require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/include/epilog_after.php");


