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
        return $this->render("default");
    }
}
