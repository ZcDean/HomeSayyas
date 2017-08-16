<?php
/**
 * Created by PhpStorm.
 * User: Dean.Zhang
 * Date: 2016-6-29
 * Time: 11:28
 * All Right Reserved.
 */
namespace Home\Controller;
use Common\Utils\CurlUtil;
use Think\Controller;
class LoginController extends Controller{



    function index(){
        $this->display();
    }


    function login(){
        $uid = I("uuid",'');
        $pwd = I("pwd",'');

        $login_url = C('PROJECT_API').'?c=sayyas&a=login&uuid='.$uid.'&password='.$pwd;
        $login_data = json_decode(CurlUtil::curl($login_url),true);
        if($login_data['code'] != 200){
            $this->ajaxReturn(-1);
        }else{
            session('user',$login_data['data']);
            $this->redirect('Index/index','登录成功',3);
        }
    }

    function logout(){
        session('uid',null);
        $this->redirect('index');
    }

}