<?php
/**
 * Created by JetBrains PhpStorm.
 * User: vincent
 * Date: 6/18/13
 * Time: 9:28 PM
 * To change this template use File | Settings | File Templates.
 */
class File
{
    public function readData($path)
    {
        if (file_exists($path)) {
            $fp = fopen($path, "r");
            $tmp = "";
            while (!feof($fp)) {
                $tmp .= fgets($fp);
            }
            fclose($fp);
            return $tmp;
        } else {
            echo "fail";
        }
        return null;
    }

    public function readDir($path,$ignoreArray=array(".","..")){
        $returnVal=array();
        if(file_exists($path)){
            if(is_dir($path)){
                $fp=opendir($path);
                while(($tmp=readdir($fp))!=null){
                    if(in_array($tmp,$ignoreArray)){
                        continue;
                    }
                    $returnVal[]=$tmp;
                }
            }
        }
        return $returnVal;
    }
}
