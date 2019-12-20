<? use Bitrix\Main\Loader;

use My\Messages\MessagesHandler;

class MessagesComponent extends CBitrixComponent
{
    public function onPrepareComponentParams($arParams)
    {
        $this->retrieveMessages($arParams['MESSAGE_COUNT']);
        return $arParams;
    }

    public function executeComponent()
    {
        $this->includeComponentTemplate();
    }

    private function retrieveMessages($cnt)
    {
        Loader::includeModule('my');
        $this->arResult['MESSAGES'] = MessagesHandler::retrieveMessages($cnt);
    }
}