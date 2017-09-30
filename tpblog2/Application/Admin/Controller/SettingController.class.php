<?php
namespace Admin\Controller;
use Think\Controller;
class SettingController extends AdmController {
    public function index(){
        //var_dump(session('aid'));
        $setting=D("Setting");
        //var_dump($setting);
        $this->assign("settings",$setting->getAll());
        //var_dump($setting->getAll());
        $this->display();
    }

    public function save(){
    	$post=I("post.");
    	$setting=D("Setting");
    	foreach ($post as $key => $value) {
    		$setting->where(array('skey'=>$key))->save(array('sval'=>$value));
    	}
    	$this->redirect("/Admin/Setting/index");
    }
}