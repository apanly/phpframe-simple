phpframe-simple
===============

自己写的php小框架，方便，简单

#ToDoList
 * 希望在数据库中加入备注 例如 #controller@base.php (line) databasename
 * set_error_handler();set_exception_handler();register_shutdown_function
 * syslog()

#框架介绍
 * 框架目录结构
    |– controller 所有的controller都放在这个文件夹下
    | |– aController.php
    |– layout 相同的布局目录
    |– resource   框架核心
    | |– cache
    | | |– autoload.php
    | | |– 其他一些常用文件
    | |– class   所有的类文件，如果以class.php结尾的可以实现自动加载
    | | |– a.class.php
    | |– core
    | |– bootstart.php 框架启动文件，每个入口文件都应该包含这个文件
    | |– function.php  在controller之外的调用的方法都可以放在这个里面
    | |– config.php    数据库配置等等
    |– static   静态文件
    | |-image   图片文件夹
    | |-css     样式表文件夹
    | |-js      js文件夹
    |– view     试图层
    | |-a    这个是以controller命名的文件夹
    | | |– b.php   以action命令的php文件
    | |-slot  这里是存放slot片段的文件夹
    |– index.php 入口文件
 * 框架流程
   * 本框架是多入口文件，例如目录结构的index.php，就是一个入口文件,一般入口文件只需要包含一个文件即可，示例如下
   `<?php
        if(count($argv)==3){
            $_GET['c']=$argv[1]?$argv[1]:"default";//这是为了兼容命令行模式 定义controller
            $_GET['a']=$argv[2]?$argv[2]:"default";//这是为了兼容命令行模式 定义Action
        }
        define("ROOT_PATH", realpath(dirname(__FILE__) . "/./") . "/");
        include(ROOT_PATH."./resource/bootstart.php");
   ?>`
 如果你想做多个入口文件，你可以新建a.php，b.php，只要你包括的上面的代码都可以，这样的入口文件的好处不需要rewrite扩展的支持

   * 框架核心介绍,本框架是一个非常简单的MVC模式，这个框架基本上把M层弱化了，并且本框架有一个优点，不需要开发人员关系C，V的之间的映射关系
     如何实现的?本框架的核心就是resource/core下的dispatcher进行控制的，这个分发控制类会根据c和a的参数决定你的controller位置和需要执行
     的方法。由于所有的controller都是放在项目下的controller文件夹下，而如何去命令的，这个会根据你请求的c参数决定文件名，但是所有的
     controller命令规范都是类似paramController.php的这样的格式，例如一个请求是index.php?c=aa&a=bb,所以你只要在controller新建文件
     aaController.php,并且继承Conroller类而且在aaController.php中实现`public function bbAction(){}`即可。
     如何渲染页面(render)?这个其实不需要开发太多的关注这个事情，只需要调用`return $this->render();//这个方法是每个Controller集成父类的方法`
     方法就可以了，那么如何使用到了layout共用模板，示例如下`return $this->render("test");`,这样就会使用layout下的test.php作为共用模板的。
     view页面在哪里？在view文件夹下根据参数c的名称建立一个文件夹，根据a的名称建立一个对应的php文件，例如index.php?c=aa&a=bb，在view就需要有
     aa这个文件夹和bb.php(在aa这个文件夹下)
     for example
        aaController.php //这个文件需要放在controller目录
          `class aaController extends Controller{
                public function bbAction(){
                     $this->data=$data;//赋值给view层
                     return $this->render();//or return $this->render("layoutname");
                }
           }`
        bb.php //这个可以放在view下的aa文件夹下
           `<?php var_dump($data);?>`
        layoutname.php //这个放在layout文件夹下
            `<html><head></head><body><?php echo $layoutcontent;?></body></html>`
   * 框架关键技术

