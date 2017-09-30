<?php
namespace Admin\Controller;
use Think\Controller;
class AuserController extends AdmController {
    public function index(){
        //var_dump(session('aid'));
       	$admin=D('admin');
    	$users=$admin->select();
    	//var_dump($users);
    	$this->assign("users",$users);
    	$this->display();
    }
    public function add(){
    	$aid=I("get.aid");
    	$admin=D('admin');
    	$user=array(
    		'aid'=>0,
    		'auser'=>'',
    		'apass'=>''
    		);
    	if($aid>0){
    		$user=$admin->where(array('aid'=>$aid))->find();
    	}
    	$this->assign("auser",$user);
    	$this->display();
    }

    public function delete(){
    	$aid=I("get.aid");
    	$admin=D('admin');
    	$where=array('aid'=>$aid);
    	$admin->where($where)->delete();
    	return $this->redirect("/Admin/Auser");
    }

    public function save(){
    	$aid=I("get.aid");
    	$admin=D('admin');
    	if(IS_POST){
    		$auser=I('post.auser');
	    	$apass=I('post.apass');
			//var_dump($auser.$apass);
			$rule=array(
				array('auser','require','账号不能为空！'), //默认情况下用正则进行验证
				array('apass','require','密码不能为空！'),
				);
			if(!$admin->validate($rule)->create()){
				$this->error("账号或密码不能为空",'/Admin/Auser/add');
			}

			if($aid<=0){
				$where=array('auser'=>$auser);
				if($admin->where($where)->select()){
					$this->error("用户名已存在",'/Admin/Auser/add');
				}
				$insert=array('auser'=>$auser,'apass'=>$apass);
				$aid=$admin->add($insert);

				if($aid){
					return $this->success("操作成功","/Admin/Auser/index");
				}else{
					return $this->error("操作失败","/Admin/Auser/add");
				}

			}

			if($aid>0){
				$where=array();
				$where['auser']=$auser;
				$where['aid']=array('NEQ',$aid);
				if($admin->where($where)->select()){
					$this->error("用户名已存在",'/Admin/Auser/add');
				}
				$insert=array('auser'=>$auser,'apass'=>$apass);
				$aid=$admin->where(array('aid'=>$aid))->save($insert);
				if($aid){
					return $this->success("操作成功","/Admin/Auser/index");
				}else{
					return $this->error("操作失败","/Admin/Auser/add");
				}
			}
	
			
    	}

    }
}