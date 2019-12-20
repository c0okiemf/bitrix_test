<?

use my\Events\Events;

require_once('MigrateIBlock.php');
require_once(__DIR__ . '/../lib/Events/Events.php');

Class my extends CModule
{
    var $MODULE_ID = "my";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_CSS;

    function __construct()
    {
        $arModuleVersion = array();

        $path = str_replace("\\", "/", __FILE__);
        $path = substr($path, 0, strlen($path) - strlen("/index.php"));
        include($path."/version.php");

        if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion))
        {
            $this->MODULE_VERSION = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        }

        $this->MODULE_NAME = "my – кастомный модуль";
        $this->MODULE_DESCRIPTION = "После установки вы сможете пользоваться компонентом my:messages";
    }

    function InstallFiles()
    {
        if (!file_exists($_SERVER["DOCUMENT_ROOT"]."/local/components")) {
            mkdir($_SERVER["DOCUMENT_ROOT"]."/local/components");
        }
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/local/modules/my/install/components",
            $_SERVER["DOCUMENT_ROOT"]."/local/components", true, true);
        return true;
    }

    function UnInstallFiles()
    {
        DeleteDirFilesEx("/local/components/test");
        return true;
    }

    function DoInstall()
    {
        try {
            MigrateIBlock::up();
        } catch (Exception $e) {
            CAdminMessage::ShowNote($e->getMessage());
        }
        Events::bind();
        global $DOCUMENT_ROOT, $APPLICATION;
        $this->InstallFiles();
        RegisterModule("my");
        $APPLICATION->IncludeAdminFile("Установка модуля my", $DOCUMENT_ROOT."/local/modules/my/install/step.php");
    }

    function DoUninstall()
    {
        try {
            MigrateIBlock::down();
        } catch (Exception $e) {
            CAdminMessage::ShowNote($e->getMessage());
        }
        Events::unBind();
        Events::clearCache();
        global $DOCUMENT_ROOT, $APPLICATION;
        $this->UnInstallFiles();
        UnRegisterModule("my");
        $APPLICATION->IncludeAdminFile("Деинсталляция модуля my", $DOCUMENT_ROOT."/local/modules/my/install/unstep.php");
    }
}
?>