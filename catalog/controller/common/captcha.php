<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/17
 * Time: 15:57
 */

class ControllerCommonCaptcha extends Controller{
    function getContactVer(){
        include "system/helper/captcha.php";
        $code=new ValidationCode(80, 30, 4);
        $_SESSION['quoteContactVer'] = $code->getCheckCode();
        $code->showImage();   //输出到页面中供 注册或登录使用
    }


    function getHomeQuote(){
        include "system/helper/captcha.php";
        $code=new ValidationCode(80, 30, 4);
        $_SESSION['getHomeQuote'] = $code->getCheckCode();
        $code->showImage();   //输出到页面中供 注册或登录使用
    }


    function cQuote(){
        include "system/helper/captcha.php";
        $code=new ValidationCode(80, 30, 4);
        $_SESSION['quoteVer'] = $code->getCheckCode();
        $code->showImage();   //输出到页面中供 注册或登录使用
    }


    function getRegister(){
        include "system/helper/captcha.php";
        $code=new ValidationCode(80, 30, 4);
        $_SESSION['register'] = $code->getCheckCode();
        $code->showImage();   //输出到页面中供 注册或登录使用
    }


    /**
     *  获取return
     */
    function getReturn(){
        include "system/helper/captcha.php";
        $code=new ValidationCode(80, 30, 4);
        $_SESSION['return'] = $code->getCheckCode();
        $code->showImage();   //输出到页面中供 注册或登录使用
    }
}



