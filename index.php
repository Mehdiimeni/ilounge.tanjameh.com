<?php
//index.php 

// route definer

// local
$_Base_Root = dirname(__FILE__, 2) ."/icore"; 
//online
$_Base_Root = "https://icore.tanjameh.com"; 


require $_Base_Root ."/vendor/autoload.php";
SessionTools::init();


(new ConfigTools($_Base_Root."/idefine/"))->StoperCheck(1);
$objFileToolsInit = new FileTools($_Base_Root."/idefine/" . "conf/init.iw");

(new MakeDirectory)->MKDir($_Base_Root."/irepository/" . 'log/error/', 'ilounge', 0755);
$objInitTools = new InitTools($objFileToolsInit->KeyValueFileReader(), $_Base_Root."/irepository/" . 'log/error/ilounge/viewerror.log');

(new IWCheckTools((new GlobalVarTools())->GetVarToJson(), $_Base_Root."/idefine/"))->IWKEYShower($_Base_Root."/idefine/" . "conf/key.iw");
new IPTools($_Base_Root."/idefine/");

include $_Base_Root."/idefine/" . "lang/" . $objInitTools->getLang() . "_web.php";

$objGlobalVar = new GlobalVarTools();
$objACL = new ACLTools();

if ($objGlobalVar->JsonDecode($objGlobalVar->ServerVarToJson())->HTTP_HOST == 'localhost')
    error_reporting(E_ALL);

require_once $_Base_Root."/idefine/" . 'conf/tablename.php';
require_once $_Base_Root."/idefine/" . 'conf/viewname.php';
require_once $_Base_Root."/idefine/" . 'conf/functionname.php';
require_once $_Base_Root."/idefine/" . 'conf/procedurename.php';
require( dirname(__FILE__, 1)."/core/urls.php");
exit();