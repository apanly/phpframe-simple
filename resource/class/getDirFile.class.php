<?php
if(!defined('IN_WEB')) {
    exit('Access Denied');
}

class getDirFile{
    private $ignoreDir=array("cache");
    //获取目录列表
    public function getDir( $Dir ){
        if( is_dir($Dir) ){
            if( false != ($Handle = opendir($Dir)) ){
                while( false != ($File = readdir($Handle)) ){
                    if( $File!='.' && $File!='..' && !strpos($File,'.') && !in_array($File,$this->ignoreDir) ){
                        $DirArray[] = $File;
                    }
                }
                closedir( $Handle );
            }
        }else{
            $DirArray[] = '[Path]:\''.$Dir.'\' is not a dir or not found!';
        }
        return $DirArray;
    }

    //获取文件列表
    public function getFile( $Dir ){
        $FileArray=array();
        if( is_dir($Dir) ){
            if( false != ($Handle = opendir($Dir)) ) {
                while( false != ($File = readdir($Handle)) ){
                    if( $File!='.' && $File!='..' && strpos($File,'.class.php') ){
                        $FileArray[substr($File,0,stripos($File,"."))] = $Dir.DS.$File;
                    }
                }
                closedir( $Handle );
            }
        }else{
            $FileArray[] = '[Path]:\''.$Dir.'\' is not a dir or not found!';
        }
        return $FileArray;
    }

    //获取目录/文件列表
    public function getDirFileList(  $Dir ){
        $DirFileArray=array();
        if( is_dir($Dir) ){
            $dirList= $this->getDir($Dir);
            if( $dirList ){
                foreach( $dirList as $Handle ){
                    $File = $Dir.$Handle;
                    $DirFileArray= array_merge($this->getFile($File),$DirFileArray);
                }
            }
        }else{
            echo  '[Path]:\''.$Dir.'\' is not a dir or not found!';
        }
        return $DirFileArray;
    }
    public function scanDirFile(array $dirs){
          if($dirs && is_array($dirs)){
              $tmpFiles=array();
              $tmpDirFile=array();
              foreach($dirs as $val){
                  $tmpDirFile=$this->getDirFileList($val);
                  $tmpFiles=array_merge($tmpFiles,$tmpDirFile);
              }
             file_put_contents(AUTOPATH,"<?php\nreturn ".var_export($tmpFiles,TRUE).";");
          }
    }
}