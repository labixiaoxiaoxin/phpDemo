<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
       //var_dump(D('page')->find());
    	$setting=D("Admin/Setting");
    	$cfg=$setting->getAll();
    	$pageModel=D("page");
    	$blogs=$pageModel->order("pid desc")->limit(0,20)->select();
    	$this->assign("cfg",$cfg);
    	$this->assign("blogs",$blogs);
    	//var_dump($blogs);
    	$this->display();
    }

    public function read(){
    	$setting=D("Admin/Setting");
    	$cfg=$setting->getAll();
    	$pid=I("get.pid");
    	$pageModel=D("page");
    	$where=array('pid'=>$pid);
    	$read=$pageModel->where($where)->find();
    	if(!$read){
    		$this->error("操作失败","/Home/Index/index");
    	}
    	$this->assign("cfg",$cfg);
    	$this->assign("read",$read);
    	$this->display();
    }
}