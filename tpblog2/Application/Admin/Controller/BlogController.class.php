<?php
namespace Admin\Controller;
use Think\Controller;
class BlogController extends AdmController {
    public function index(){
        //var_dump(session('aid'));
       	$pageModel=D('page');
       	$setting=D('Setting');
       	$cfg=$setting->getAll();

    	//$blogs=$pageModel->order("pid desc")->limit(0,20)->select();
    	$count = $pageModel->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,$cfg['pagenum']);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show  = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$blogs = $pageModel->order('pid desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('blogs',$blogs);// 赋值数据集
		$this->assign('show',$show);// 赋值分页输出
    	//var_dump($users);
    	$this->display();
    }

    public function add(){
    	$pid=I("get.pid");
    	$pageModel=D('page');
    	$blog=array(
    			'pid'=>0,
    			'title'=>'',
    			'author'=>'',
    			'content'=>''
    			);
    	if($pid>0){
    		$blog=$pageModel->where(array('pid'=>$pid))->find();
    	}
    	$this->assign("blog",$blog);
    	$this->display();
    }

    public function delete(){
    	$pid=I("get.pid");
    	$pageModel=D('page');
    	$where=array('pid'=>$pid);
    	$pageModel->where($where)->delete();
    	return $this->redirect("/Admin/Blog");
    }

    public function save(){
    	$pid=I("get.pid");
    	$pageModel=D('page');
    	if(IS_POST){
    		$title=I("post.title");
    		$author=I("post.author");
    		$content=I("post.content");
	    	$rule=array(
	    		array("title","require","标题不能为空！"),
	    		array("author","require","作者不能为空！"),
	    		array("content","require","正文不能为空！"),
	    		);
	    	if(!$pageModel->validate($rule)->create()){
	    		$this->error("填写项不能为空",'/Admin/Blog/add');
	    	}

	    	$insert=array(
	    		'title'=>$title,
	    		'author'=>$author,
	    		'content'=>$content,
	    		);
	    	if($pid>0){
	    		$insert['uptime']=time();
	    		$pid=$pageModel->where(array('pid'=>$pid))->save($insert);
	    	}else{
	    		$insert['intime']=time();
	    		$insert['uptime']=time();
	    		$pid=$pageModel->add($insert);
	    	}
    	}
    	if($pid){
    		$this->success("操作成功","/Admin/Blog/index");
    	}else{
    		$this->error("操作失败","/Admin/Blog/add");
    	}
    	
    }

    public function upload(){

    	$result=array();
    	$result['success']=false;
    	$result['msg']='';
    	$result['file_path']='';

	    $upload = new \Think\Upload();// 实例化上传类
	    $upload->maxSize = 3145728 ;// 设置附件上传大小
	    $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	    $upload->rootPath = './Uploads/'; // 设置附件上传根目录
	    // 上传单个文件 
	    $info = $upload->uploadOne($_FILES['file2']);
	    if(!$info) {// 上传错误提示错误信息 
	        $result['msg']=$this->error($upload->getError());
	    }else{// 上传成功 获取上传文件信息
	    	//var_dump($info);
	        //echo $info['savepath'].$info['savename'];
	        $url='./Uploads/'.$info['savepath'].$info['savename'];
	        $result['success']=true;
	    	$result['msg']='';
	    	$result['file_path']=$url;

	    }
	    $this->ajaxReturn($result);//返回json，告诉编辑器上传成功
	}
}