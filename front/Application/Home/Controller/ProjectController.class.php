<?php
namespace Home\Controller;
use Common\Utils\CurlUtil;
use Think\Controller;
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
        $this->assign('modify','selected');
        $this->display();
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