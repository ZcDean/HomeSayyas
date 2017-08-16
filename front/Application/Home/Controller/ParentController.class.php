<?php
/**
 * Created by PhpStorm.
 * User: Dean.Zhang
 * Date: 2016-6-29
 * Time: 13:11
 * All Right Reserved.
 */
namespace Home\Controller;
use Think\Controller;
class ParentController extends Controller{

    public function __construct()
    {
        parent::__construct();
        if(!session('?user')){
            $this->error('登录已超时，页面跳转中...',U('Login/index'), 3);
            exit();
        }
    }
}