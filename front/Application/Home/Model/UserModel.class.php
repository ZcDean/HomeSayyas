<?php
/**
 * Created by PhpStorm.
 * User: Dean.Zhang
 * Date: 2016-6-29
 * Time: 10:49
 * All Right Reserved.
 */
namespace Home\Model;
use Think\Model;
class UserModel extends Model{



    public function createUser($data){

        $user = M('user');
        $user->where("uid='zhangchao'")->data($data)->save();
    }

    /**
     * 查询用户信息
     * @param $uid
     * @return mixed
     */
    public function getUserInfo($uid){

        $user = M('user');
        $data = $user->where('uid="'.$uid.'"')->find();
        return $data;
    }


    public function modifyPassword($pwd){
        $user = M('user');
        $data['pwd'] = $pwd;
        $res = $user->where('uid="'.session("uid").'"')->save($data);
        return $res;
    }

}