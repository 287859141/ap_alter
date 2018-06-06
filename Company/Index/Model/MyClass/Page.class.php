<?php
namespace Index\Controller;
use Think\Controller;

class IndexController extends Controller {
    public function index(){
        $this->display();
    }
    public function login(){
    	header("Content-type:text/html;charset=utf-8");
    	$name=$_POST['name'];
    	$password=$_POST['password'];
    	//$this->assign('login',M('member')->field('login')->where(array('uid'=>UID))->find()['login']);
    	//echo $name;
    	//die();
		//$m=M("users")->select();
		//var_dump ($userinfo);
		//die();
    	$userinfo=M("users")->where(array('username'=>$name,'deltriger'=>0))->find();
		
		if( empty ($userinfo)){
		    echo "<script>alert('用户名不存在');window.location.href='bank'</script>";
			return;
		}
    	if ($userinfo["password"] == md5('shangshan&ruoshui' .md5($password).$userinfo["salt"]))
    	{
    	    $timenow=time();
    	    $ipnow=$_SERVER['REMOTE_ADDR'];
    	    $users = M("users");//实例化
    	    $data['active'] = "$timenow";
    	    $data['host']="$ipnow";
    	    $users->where(array('id'=>$userinfo['id']))->save($data);
    	    $log = M("adminlog");//实例化
    	    $insdata['uid']=$userinfo["id"];
    	    $insdata['notes']="登陆";
    	    $insdata['utime']="$timenow";
    	    $insdata['ipadd']="$ipnow";
    	   $log->data($insdata)->add(); 
    	   $_SESSION["v_uid_session"]=$userinfo['id'];
    	   $_SESSION["v_username_session"]=$userinfo['username'];
    	   $_SESSION["v_realname_session"]=$userinfo['realname'];
    	   $_SESSION["v_group_session_echo"]=$userinfo['group'];
    	   $_SESSION["v_group_session"]=",".$userinfo['group'].",";
    	   $_SESSION["v_company_session"]=$userinfo['company'];
    	} else{
		    echo"<script>alert('密码不正确');window.location.href='bank'</script>";
			return;
		}
		
    	$this->display();    	
    }
    public function bank(){
        
       $this->display();
    }
   
}