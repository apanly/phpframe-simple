<?php
function __autoload($classname){
    if(file_exists(AUTOPATH)){
        $tmpautoload=include(AUTOPATH);
    }
    if(isset($tmpautoload) && is_array($tmpautoload) && $tmpautoload[$classname]){
       $tmppath=$tmpautoload[$classname];
    }else{
       //$tmppath=ROOT_PATH."resource".DS."class".DS."{$classname}.class.php";
    }
    if(file_exists($tmppath)){
        include($tmppath);
    }else{
        include_once(ROOT_PATH."resource".DS."class".DS."getDirFile.class.php");
        $target = new getDirFile();
        $target->scanDirFile(array(ROOT_PATH . "resource/",ROOT_PATH . "sdk/"));
        log::error("{$tmppath}文件不存在");

    }
}

function require_class($name,$type){
       $tmppath=ROOT_PATH.$type.DS.$name.ucfirst($type).".php";
       if(file_exists($tmppath)){
           require($tmppath);
       }else{
           log::error("{$tmppath}文件不存在");
       }
}


function customError($errno, $errstr, $errfile, $errline)
{
    $tmp= "<b>Custom error:</b> [$errno] $errstr<br />";
    $tmp.= " Error on line $errline in $errfile<br />";
    customlog($tmp);
}

function customException($e){
    $tmp= "Exception:".$e->getMessage();
    $tmp.=var_export(debug_backtrace(),true);
    customlog($tmp);
}

function customlog($message){
    openlog("phpsimple", LOG_PID, LOG_USER);
    syslog(LOG_INFO, $message);
    closelog();
}