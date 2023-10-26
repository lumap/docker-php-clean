<?php
namespace Controller;

use Controller\Connection;
use \Smarty;

class View
{
    static private array $datas;

    static private Smarty $smartyEngine;

    static private $engine;

    static public function Init(string $title)
    {
        $Smarty = new Smarty();
        $Smarty->setTemplateDir(DIR_VIEW);
        $Smarty->setCompileDir(DIR_PRIVATE . "templates_c/");
        $Smarty->setCacheDir(DIR_PRIVATE . "cache_c/");
        $Smarty->assign("title", $title . " - Site Docker");
        self::$smartyEngine = $Smarty;
    }

    static public function Set(string $var, $value)
    {
        self::$smartyEngine->Assign($var, $value);
    }

    static public function Display(string $view)
    {
        return self::$smartyEngine->display($view . ".tpl");
    }
}
?>