<?

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->ShowHead(false);

$APPLICATION->IncludeComponent(
    "test:messages",
    "",
    [
        'MESSAGE_COUNT' => 10
    ]
);

require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/include/epilog_after.php");