<?php
namespace Admin\Controller;
use Think\Controller;
class AdmController extends Controller {
    public function __construct(){
        //var_dump(session('aid'));
        parent::__construct();
        $this->aid=session('aid');
        if($this->aid<0){
        	$this->error("账号或密码错误",'/Admin/Login/index');
        }
        $this->user=D("admin")->where(array('aid'=>$this->aid))->find();
        if(!$this->user){
        	$this->error("账号不存在",'/Admin/Login/index');
        }
    }
}