<?php
class defaultController extends Controller
{
    public function defaultAction()
    {
        $this->hl="hello world";
        $this->data="Welcome to Vincentguo frame";
        $target=new Mysql();
        $target->query("111");
        //return $this->render();
        trigger_error("A custom error has been triggered");
        throw new Exception('Uncaught Exception occurred');
        return $this->render("default");
    }
}
