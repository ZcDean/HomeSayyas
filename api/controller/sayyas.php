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
            "uuid",
            "password"
        ));
        $uuid = request("uuid");
        $password = request("password");
        //连接mysql数据库
        $db = db::getConnect();
        if($db == null){
            util::ajaxError("数据库连接失败",500);
        }
        $datas = $db->select("userinfo",[
            "uuid",
            "uname",
            "tel",
            "email",
            "job"
        ],["uuid"=>$uuid,"password"=>$password]);
        if(count($datas) <= 0){
            util::ajaxError("用户名密码有误！",201);
        }else{
            $_R = array(
                "status" => "success",
                "code"=>200,
                "data"=>$datas[0]
            );
            util::ajaxReturn($_R);
        }
    }



    public function project(){
        //参数检查
        util::check_param(array(
            "uuid",
        ));
        $uuid = request("uuid");
        //连接mysql数据库
        $db = db::getConnect();
        if($db == null){
            util::ajaxError("数据库连接失败",500);
        }
        $datas = $db->select("project",[
            "id",
            "uuid",
            "report_time",
            "contact",
            "contact_tel",
            "address",
            "create_time"
        ],["uuid"=>$uuid,"ORDER" => ["create_time"=>"DESC"]]);
        $_R = array(
            "status" => "success",
            "code"=>200,
            "data"=>$datas
        );
        util::ajaxReturn($_R);
    }

    public function project_info(){
        //参数检查
        util::check_param(array(
            "project_id",
        ));
        $id = request("project_id");
        //连接mysql数据库
        $db = db::getConnect();
        if($db == null){
            util::ajaxError("数据库连接失败",500);
        }
        $project = $db->get("project",[
            "id",
            "uuid",
            "report_time",
            "contact",
            "contact_tel",
            "address",
            "create_time"
        ] , [
            "id" => $id
        ]);
        $project["schedule"] =  $db->select("schedule",[
            "id",
            "content",
            "create_time",
        ],["project_id"=>$id,"ORDER" => ["create_time"=>"DESC"]]);
        $_R = array(
            "status" => "success",
            "code"=>200,
            "data"=>$project
        );
        util::ajaxReturn($_R);
    }

    public function modify_project(){
        //参数检查
        util::check_param(array(
            "uuid",
            "report_time",
            "contact",
            "contact_tel",
            "address"
        ));
        $uuid = request("uuid");
        $report_time = request("report_time");
        $contact = request("contact");
        $contact_tel = request("contact_tel");
        $address = request("address");
        //连接mysql数据库
        $db = db::getConnect();
        if($db == null){
            util::ajaxError("数据库连接失败",500);
        }
        $project_id = request("project_id");
        if($project_id == "" || $project_id == null){
            //添加
            $project_id = util::getUUid();
            //开启事务
            $db->pdo->beginTransaction();
            try{
                $db->insert("project",[
                    "id" => $project_id,
                    "uuid" => $uuid,
                    "report_time"=>$report_time,
                    "contact"=>$contact,
                    "contact_tel" => $contact_tel,
                    "address" => $address
                ]);
                $schedult = request('schedule');
                if( $schedult != null){
                    Log::info($schedult);
                    $schedult = json_decode($schedult,true);
                    if(count($schedult) > 0){
                        $data = array();
                        foreach($schedult as $row){
                            $row['id'] = util::getUUid();
                            $row['project_id'] = $project_id;
                            if(!isset($row['create_time'])){
                                $row['create_time'] = date("Y-m-d");
                            }
                            array_push($data,$row);
                        }
                        $db->insert("schedule",$data);
                    }
                }
                $db->pdo->commit();
                $_R = [
                    "code" => 200,
                    "status" => "success",
                    "msg" => "数据添加成功",
                    "data" => [
                        "project_id" => $project_id
                    ]
                ];
                util::ajaxReturn($_R);
            }catch (Exception $e){
                //回滚操作
                $db->pdo->rollBack();
                util::ajaxError('数据库操作失败!',403);
            }

        }else{
            //更新
        }
    }
}