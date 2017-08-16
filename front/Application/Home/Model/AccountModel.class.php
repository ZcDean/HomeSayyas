<?php
/**
 * Created by PhpStorm.
 * User: Dean.Zhang
 * Date: 2016-7-6
 * Time: 14:10
 * All Right Reserved.
 */
namespace Home\Model;
use Think\Model;

class AccountModel extends Model{

    private  $ACCOUNT;
    public function __construct()
    {
        parent::__construct();
        $this->ACCOUNT =  M('account');
    }

    /**
     * 获取所有记账信息
     * @return mixed
     */
    public function getAccountList($uid=''){

        if($uid == ''){
            $uid = session('uid');
        }
        $list = $this->ACCOUNT->where('uid="'.$uid.'"')->order('date DESC')->select();
        return $list;
    }

    /**
     * 添加一条记录
     * @param $data
     * @return mixed
     */
    public function addOneAccount($data){
        $data['uid'] = session('uid');
        $res = $this->ACCOUNT->data($data)->add();
        if($res){
            return true;
        }

        return false;
    }

    /**
     * 检验当天数据是否已添加
     * @param $date
     * @return bool
     */
    public function checkTodayAccount($date){
        $res = $this->ACCOUNT->where('uid="zhangchao" AND date="'.$date.'"')->find();
        if($res != false && $res != null){
            return true;
        }
        return false;
    }

    /**
     * 删除一条记录
     * @param $id
     * @return bool
     */
    public function delOneAccount($id){
        $res = $this->ACCOUNT->where('id='.$id)->delete();
        if($res && $res>0){
            return true;
        }

        return false;
    }


    public function getAllData($begin='',$end=''){
        $uid = session('uid');
        $condition = 'uid="'.$uid.'"';
        if($begin != ''){
            $condition .= ' AND date >= "'.$begin.'"';
        }

        if($end != ''){
            $condition .= ' AND date <= "'.$end.'"';
        }
        $list = $this->ACCOUNT->field("id,uid,food,amuse,bus,shopping,other,date,remark,total")->where($condition)->order('date ASC')->select();
        return $list;
    }



    public function getDetailInfo($date,$name=''){
        $uid = session('uid');
        $data = $this->ACCOUNT->field($name)->where('uid="'.$uid.'" AND date="'.$date.'"')->find();
        return $data;
    }

    public function getDataByMonth($m=''){
        $uid = session('uid');
        $condition = 'uid="'.$uid.'"';
        if($m != ''){
            $condition .= ' AND month="'.$m.'"';
        }
        $list = $this->ACCOUNT->field("uid,sum(food) AS food,sum(amuse) AS amuse,sum(shopping) AS shopping,sum(bus) AS bus,sum(other) AS others, SUM(total) AS total,month")->
            group('month,uid')->having($condition)->select();
        return $list;

    }


    public function getDataByDate($begin='',$end=''){

        $uid = session('uid');
        $condition = 'uid="'.$uid.'"';
        if($begin != ''){
            $condition .= ' AND date >= "'.$begin.'"';
        }

        if($end != ''){
            $condition .= ' AND date <= "'.$end.'"';
        }
        $list = $this->ACCOUNT->field("uid,sum(food) AS food,sum(amuse) AS amuse,sum(shopping) AS shopping,sum(bus) AS bus,sum(other) AS others, SUM(total) AS total,month")->where($condition)->select();

        return $list;
    }


}