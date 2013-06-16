<?php
class icache
{
     private function getPath(){
          $path=ROOT_PATH . "resource".DS."cache".DS."icache.php";
          if(!file_exists($path)){
               touch($path);
               file_put_contents($path,"<?php \n return array();");
          }
         return $path;
     }
     public function set($key,$value){
            if($this->get($key)){

            }else{
                $path=$this->getPath();
                $data=file_get_contents($path);
                if(strlen($data)>23){
                    file_put_contents($path, str_replace(");", ",'{$key}'=>'" . serialize($value) . "');", $data));
                }else{
                    file_put_contents($path, str_replace(");", "'{$key}'=>'" . serialize($value) . "');", $data));
                }
            }
     }
     public function get($key){
         $path=$this->getPath();
         $cachedata = include_once($path);
         if (isset($cachedata[$key])) {
             return unserialize($cachedata[$key]);
         } else {
             return null;
         }
     }
     public function update($key,$value){

     }

}
