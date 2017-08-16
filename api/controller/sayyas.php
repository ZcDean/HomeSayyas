<?php

/**
 * Created by PhpStorm.
 * User: Dean
 * Date: 2017/8/15
 * Time: 11:01
 */
class sayyas
{

    public function login(){
        //参数检查
        util::check_param(array(
            'uuid',
            'password'
        ));
        $uuid = request('uuid');
        $password = request('password');
        //连接mysql数据库
        $db = db::getConnect();
        if($db == null){
            util::ajaxError('数据库连接失败',500);
        }
        $datas = $db->select("userinfo",[
            'uuid',
            'uname',
            'tel',
            'email',
            'job'
        ],['uuid'=>$uuid,'password'=>$password]);
        if(count($datas) <= 0){
            util::ajaxError('用户名密码有误！',201);
        }else{
            $_R = array(
                'status' => 'success',
                'code'=>200,
                'data'=>$datas[0]
            );
            util::ajaxReturn($_R);
        }
    }



    public function project(){
        //参数检查
        util::check_param(array(
            'uuid',
        ));
        $uuid = request('uuid');
        //连接mysql数据库
        $db = db::getConnect();
        if($db == null){
            util::ajaxError('数据库连接失败',500);
        }
        $datas = $db->select("project",[
            'id',
            'uuid',
            'report_time',
            'contact',
            'contact_tel',
            'address',
            'create_time'
        ],['uuid'=>$uuid,"ORDER" => ["create_time"=>"DESC"]]);
        $_R = array(
            'status' => 'success',
            'code'=>200,
            'data'=>$datas
        );
        util::ajaxReturn($_R);
    }

    public function project_info(){
        //参数检查
        util::check_param(array(
            'project_id',
        ));
        $id = request('project_id');
        //连接mysql数据库
        $db = db::getConnect();
        if($db == null){
            util::ajaxError('数据库连接失败',500);
        }
        $project = $db->get("project",[
            'id',
            'uuid',
            'report_time',
            'contact',
            'contact_tel',
            'address',
            'create_time'
        ] , [
            "id" => $id
        ]);
        $project['schedule'] =  $db->select("schedule",[
            'id',
            'content',
            'create_time',
        ],['project_id'=>$id,"ORDER" => ["create_time"=>"DESC"]]);
        $_R = array(
            'status' => 'success',
            'code'=>200,
            'data'=>$project
        );
        util::ajaxReturn($_R);
    }
}