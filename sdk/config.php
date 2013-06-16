<?php
$config = array();
$config['global'] = array("sitename" => "Where there is a will ,there is a way");
$config['mvc']['default'] = array("action" => "default", "layout" => "default", "controller" => "default");
$config['secury'] = array(
    "cookiepre" => "vincent_" . substr(md5("/|"), 0, 4) . "_",
    "authkey" => "sdfqrewr",
);
define("DBPREFIX", "edu_");
$config['db'][0] = array(
    "hostname" => "localhost", //服务器地址
    "username" => "root", //数据库用户名
    "password" => "root", //数据库密码
    "database" => "education", //数据库名称
    "charset" => "utf8", //数据库编码
    "pconnect" => 0, //开启持久连接
    "log" => 1, //开启日志
    "logfilepath" => ROOT_PATH."resource/cache/dblog.txt" //开启日志
);
