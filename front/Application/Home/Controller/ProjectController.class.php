<?php
namespace Home\Controller;
use Common\Utils\CurlUtil;
use Think\Controller;
use Think\Log;

class ProjectController extends Controller {




    public function modify(){
        $project_id = I('project_id');
        if($project_id !== '' && $project_id != null ){
            $project_url =  C('PROJECT_API').'?c=sayyas&a=project_info&project_id='.$project_id;
            $project_info = json_decode(CurlUtil::curl($project_url),true);
            if($project_info['code'] == 200){
                $this->assign('project',$project_info['data']);
            }
        }
        $this->assign('project_id',$project_id);
        $this->assign('modify','selected');
        $this->display();
    }


    //添加或修改一个项目
    public function modifyPro(){
        $project_id = I('project_id');
        $project_url =  C('PROJECT_API').'?c=sayyas&a=modify_project';
        Log::record('添加项目 id='.$project_id,Log::INFO);
        if($project_id == '' || $project_id == null ){
            //添加
            $data = array(
                'uuid'=>session('user.uuid'),
                'report_time' => I('report_time'),
                'contact' => I('contact'),
                'contact_tel' => I('contact_tel'),
                'address' => I('address'),
            );
            if(I('schedule') != null){
                $data['schedule'] = json_encode(I('schedule'));
            }
            $add_info = json_decode(CurlUtil::curl($project_url,'POST',$data),true);
            if($add_info['code'] == 200){
                $this->ajaxReturn(1);
            }else{
                $this->ajaxReturn(-1);
            }
        }else{

        }
    }


    public function plist(){
        $this->assign('project','selected');

        $uuid = session('user.uuid');
        $project_url =  C('PROJECT_API').'?c=sayyas&a=project&uuid='.$uuid;
        $project_info = json_decode(CurlUtil::curl($project_url),true);
        if($project_info['code'] == 200){
            $this->assign('projects',$project_info['data']);
        }
        $this->display();
    }
}