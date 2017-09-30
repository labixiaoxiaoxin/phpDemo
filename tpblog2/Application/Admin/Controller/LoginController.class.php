<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
    	if(I("get.do")==chk){
    		$auser=I("post.auser");
    		$apass=I("post.apass");
    		//var_dump($auser);
    		$admin=D("admin");
    		$where=array('auser'=>$auser,'apass'=>$apass);
    		$user=$admin->where($where)->find();
    		if($user){
    			session('aid',$user['aid']);  //设置session
    			return $this->success('登录成功', '/Admin/Index/index',3);
    		}else{
    			return $this->error('登录失败','/Admin/Login/index',1);
    		}

    	}
       	$this->display();
    }

    public function logout(){
    	session('aid',null); // 删除name
    	return $this->success('退出成功','/Admin/Login/index',1);
    }
}