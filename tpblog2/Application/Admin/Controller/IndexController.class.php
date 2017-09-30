<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends AdmController {
    public function index(){
        //var_dump(session('aid'));
        $this->display();
    }
}