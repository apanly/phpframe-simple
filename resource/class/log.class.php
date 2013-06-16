<?php
if(!defined('IN_WEB')) {
    exit('Access Denied');
}
class log
{
     public static function error($message){
       self::out("[error]".$message);
     }
     public static function out($message){
         echo $message;
     }
}
