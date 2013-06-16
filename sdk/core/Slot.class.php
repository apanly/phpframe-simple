<?php
/**
 * Created by JetBrains PhpStorm.
 * User: vincent
 * Date: 2/16/13
 * Time: 2:23 PM
 * To change this template use File | Settings | File Templates.
 */
class Slot
{
    public static function includeSlot($path, $data)
    {
        $path=str_replace("_","/",$path);
        $view_file = SLOT_PATH . $path . '.php';
        if (file_exists($view_file)) {
            extract($data);
            ob_start();
            include $view_file;
            $content = ob_get_contents();
            ob_end_clean();
            return  $content;
        } else {
            trigger_error('加载 ' . $view_file . ' 模板不存在');
        }
    }
}
