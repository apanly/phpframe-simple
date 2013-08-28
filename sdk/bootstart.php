<?php
header("Content-type: text/html; charset=utf-8");
//error_reporting(E_ALL);
//ini_set( 'display_errors', 'On' );
define("DS",DIRECTORY_SEPARATOR);
define("IN_WEB", "1");
define("ROOT_PATH", realpath(dirname(__FILE__) . "/../") . DS);
define("UPLOAD_PATH", realpath(dirname(__FILE__) . "/../") . DS."static".DS);
$domain = $_SERVER['HTTP_HOST'];
if (!preg_match("/^http/", $domain)) {
    define("WEB_DOMAIN", "http://" . $domain);
} else {
    define("WEB_DOMAIN", $domain);
}
define("SLOT_PATH", ROOT_PATH . "view".DS."slot".DS);
define("AUTOPATH", ROOT_PATH . "resource".DS."cache".DS."autoload.php");
include(ROOT_PATH . "sdk".DS."function.php");
/*$target = new getDirFile();
$target->getDirFileList(ROOT_PATH . "resource/");*/
include(ROOT_PATH . "sdk".DS."config.php");
/*include(ROOT_PATH . "resource/class/util.class.php");
include(ROOT_PATH . "resource/core/Slot.class.php");
include(ROOT_PATH . "resource/core/Dispatcher.class.php");
include(ROOT_PATH . "resource/core/Controller.class.php");
include(ROOT_PATH . "resource/core/View.class.php");*/
$_GET = util::dstripslashes($_GET);
$_POST = util::dstripslashes($_POST);
$_COOKIE = util::dstripslashes($_COOKIE);

$filepath = $_SERVER['SCRIPT_FILENAME'];
if (strpos($filepath, ".php")) {
    $beginpos = strrpos($filepath, "/");
    $endpos = strrpos($filepath, ".php");
    $tmpindex = substr($filepath, $beginpos + 1, $endpos - $beginpos - 1);
    unset($filepath);
    unset($beginpos);
    unset($endpos);
}
try{
    Dispatcher::getInstance()->dispatch($config['mvc'][$tmpindex] ? $config['mvc'][$tmpindex] : $config['mvc']['default']);
}catch(Exception $e){
    throw new Exception($e->getMessage());
}