<?php

abstract class Controller
{
    protected $vars = array();
    /**
     * Set array vars for rendering
     *
     * @param $key                the vars key
     * @param $value              the value of the key
     *
     * @return void
     */
    public function __set($key, $value) {
        $this->vars[$key] = $value;
    }

    /**
     * Get array vars value used key
     *
     * @param  $key              the vars key
     * @return value
     */
    public function __get($key) {
        return $this->vars[$key];
    }

    public function execute($controllerInstance, $funcName) {
            if (method_exists($controllerInstance, $funcName)) {
                $this->vars['action']=Dispatcher::getInstance()->getAct();
                $this->vars['controller']=Dispatcher::getInstance()->getCon();
                $content = call_user_func_array(array(&$controllerInstance, $funcName), array());
            } else {
               throw new Exception(get_class($controllerInstance)."的{$funcName}方法不存在");
            }
            return $content;
    }

    protected function render($layout=null, $tpl=null) {
        $view = new View();
        return $view->render($this->vars, $layout, $tpl);
    }

    public function alert($message,$url="index.php"){
        $tmp=<<<EOF
        <script type="text/javascript">
          alert('$message');
          window.location.href='$url';
        </script>
EOF;
        log::out($tmp);exit();
    }
    public function location($url){
      header("Location:{$url}");exit();
    }

    public function tips($message,$url="index.php"){
        Dispatcher::getInstance()->setAct("error");
        Dispatcher::getInstance()->setCon("default");
        $this->message=$message;
        $this->url=$url;
        echo  $this->render();exit();
    }
}
