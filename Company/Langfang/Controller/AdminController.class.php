<?php
namespace Langfang\Controller;
use Think\Controller;
class AdminController extends Controller {
   public function index(){
        $this->display();
    }
	//登录判断
    public function login(){
    	header("Content-type:text/html;charset=utf-8");
    	$name=$_POST['name'];
    	$password=$_POST['password'];    	
    	$userinfo=M("users")->where(array('username'=>$name,'deltriger'=>0))->find();		
		if( empty ($userinfo)){
		    echo "<script>alert('用户名不存在');window.location.href='bank'</script>";
			return;
		}
    }
}