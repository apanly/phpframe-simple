<?php
class defaultController extends Controller
{
    public function defaultAction()
    {
        $this->hl="hello world";
        $this->data="Welcome to Vincentguo frame";
        //return $this->render();
        return $this->render("default");
    }
}
