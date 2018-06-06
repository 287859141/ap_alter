<?php

namespace Beijing\Controller;

use Think\Controller;


class IndexController extends Controller {
    public function index(){
		header("Content-type:text/html;charset=utf-8");
        $this->display();	
    }    
    public function login(){	
    	header("Content-type:text/html;charset=utf-8");
    	$name=$_POST['name'];
    	$password=$_POST['password'];
    	$userinfo=M("users")->where(array('username'=>$name,'deltriger'=>0,))->find();	
		if( empty ($userinfo)){
		    echo "<script>alert('用户名不存在');window.location.href='index'</script>";
			return;
		}
    	if ($userinfo["password"] == md5('shangshan&ruoshui' .md5($password).$userinfo["salt"]))
    	{
			global $BeijingGroups,$LandnowCom; 

			

			if(($userinfo['group']!=9 && $userinfo['company']==$LandnowCom ) || $userinfo['group']==9){

			

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

    	    $log->data($insdata)->add(); //

    	    $_SESSION["v_uid_session"]=$userinfo['id'];

		    $_SESSION["v_username_group"]=$userinfo['group'];

    	    $_SESSION["v_username_session"]=$userinfo['username'];

    	    $_SESSION["v_realname_session"]=$userinfo['realname'];    	    

    	    $_SESSION["v_group_session"]=",".$userinfo['group'].",";

    	    $_SESSION["v_company_session"]=$userinfo['company'];          

		    $_SESSION["v_username_leftmenu"]="menu/index";	

					

		if($userinfo['group']=='5')

		{		

			$_SESSION["v_username_leftmenu"]="Menu/dgindex";    

			echo "<script>alert('支行客户-登录成功!');window.location.href='dg_main'</script>";

			return;

		}

		elseif($userinfo['group']=='15'){

			$_SESSION["v_username_leftmenu"]="Menu/yx_index";		

		    echo "<script>alert('营销管理员-登录成功!');window.location.href='dg_main'</script>";

            return;

        }

		elseif($userinfo['group']=='81'){

			$_SESSION["v_username_leftmenu"]="Menu/headof";		

		    echo "<script>alert('分行管理员-登录成功!');window.location.href='dg_main'</script>";

            return;

        }

		elseif($userinfo['group']=='82'){

			$_SESSION["v_username_leftmenu"]="Menu/finans";		

		    echo "<script>alert('集采管理员-登录成功!');window.location.href='dg_main'</script>";

            return;

        }

		elseif($userinfo['group']=='9'){

			$_SESSION["v_username_leftmenu"]="Menu/index";		

		    echo "<script>alert('系统管理员-登录成功!');window.location.href='dg_main'</script>";

            return;

        }

		}else{

		    echo"<script>alert('权限错误!');window.location.href='index'</script>";

		}

	}else{    	

		    echo"<script>alert('密码不正确');window.location.href='index'</script>";

			return;

		}	  

			  	 	

    }

	public function unlogin(){

	header("Content-type:text/html;charset=utf-8");	 

	$_SESSION['v_uid_session']=' ';

	$_SESSION['v_username_session']=' ';

	$_SESSION['v_realname_session']=' ';

	$_SESSION['v_group_session_echo']=' ';

	$_SESSION['v_group_session']=' ';

	$_SESSION['v_company_session']=' ';

	$_SESSION['v_username_leftmenu']=' ';

	$_SESSION["v_username_group"]=' ';

	unset($_SESSION['v_uid_session']);

	unset($_SESSION['v_username_session']);

	unset($_SESSION["v_username_group"]);

	unset($_SESSION['v_realname_session']);

	unset($_SESSION['v_group_session_echo']);

	unset($_SESSION['v_group_session']);

	unset($_SESSION['v_company_session']);

	unset($_SESSION['v_username_leftmenu']);

	session(null);

	echo "<script>alert('退出成功');window.location.href='index'</script>";

	}

	public function main(){		

    	header("Content-type:text/html;charset=utf-8");	 

		$menu = A('Controller/Menu');     

        $asst=$_SESSION["v_username_group"];

    	$this->display();    	

    }

	public function dg_main(){

	    $product = M("products");

		$comp= $_SESSION["v_company_session"];

		$pronum = $product->where("company=$comp AND deltriger=0")->count();

		$user = M("users");

		//$deltriger=0;

		$usercp= $_SESSION["v_company_session"];

		$usernum = $user->where("company=$usercp AND deltriger=0" )->count();	

		//echo $usernum;

		//die();

		$order = M("orders");

		$comp= $_SESSION["v_company_session"];

		$where['status']= 1;

		$cmpys['uid']= $_SESSION["v_uid_session"];		

		$pronewnum = $order->where($cmpys)->count();

		if(empty( $_SESSION["v_uid_session"]))

		{

			 echo "<script>alert('没有登录');window.location.href='../index'</script>";

		}

		global $BeijingRolesStatus,$BeijingGroups;	

		import("ORG.Util.Page"); 

		$users = M("users");	

		$order = M("orders");	

		$ologs = M("orders_logs");

		$osendlogs = M("orders_sendlogs");

		$reviewstatus=0;//浏览

		$usewhere['id']= $_SESSION["v_uid_session"];

		$userinfo=$users->where($usewhere)->find();
		

		if(!empty( $_SESSION["v_company_session"]))

		{			

			$where['v_companies.id'] = $_SESSION["v_company_session"];

		}	

		if($_SESSION["v_username_group"]==5)

		{

			$where['v_orders.uid']= $_SESSION["v_uid_session"];

		}	

		$where['v_orders.status'] = 1;	

		$firstrolelarr=$BeijingGroups['Permissions']['分行审核'];

		if(in_array( $_SESSION["v_username_group"],$firstrolelarr))

		{

			$reviewstatus=1;//初审

			$yiyourenarr=explode(',',$userinfo['uid_role']);

		 	$yiyourenarr=array_filter($yiyourenarr);

			if(count($yiyourenarr)>0){	

				$where['v_orders.uid']=array('in',$yiyourenarr);

			}else

			{

			//去分配用户

			}

		}

		else if(in_array( $_SESSION["v_username_group"],$lastrolelarr))

		{

			//$reviewstatus=2;//复审

			if(!empty($userinfo['uid_role'])){

			$yiyourenarr=explode(',',$userinfo['uid_role']);

		 	$yiyourenarr=array_filter($yiyourenarr);	

				if(count($yiyourenarr)>0){			

					$where['v_orders.shenheuser']=array('in',$yiyourenarr,'or');

				}else

				{

				//去分配用户

				 echo "<script>alert('没有登录');window.location.href='member/setreview'</script>";

				}

			}

			if(empty($userinfo['uid_role'])){

				echo "<script>alert('权限错误!');window.history.back(-1)</script>";

				return;

			}

			$where['v_orders.status'] = 2;

			$where['shenhechg'] = 1;	

		}

												

$searchcount=$order->field("v_orders.*,v_companies.id as cpid,v_companies.name as cpname,v_users.company as comname,v_users.department as depart,v_users.realname as realname")->join('LEFT JOIN  v_users ON v_users.id = v_orders.uid LEFT JOIN  v_companies ON v_companies.id = v_users.company')->where($where)->count();

		$p = new \Think\Page($searchcount,10);	

		

		$olist=$order->field("v_orders.*,v_companies.id as cpid,v_companies.name as cpname,v_users.company as comname,v_users.department as depart,v_users.realname as realname")->join('LEFT JOIN  v_users ON v_users.id = v_orders.uid LEFT JOIN  v_companies ON v_companies.id = v_users.company')->limit($p->firstRow,10)->where($where)->order('v_orders.id desc')->select();	

		$this->assign('order',$olist);
		
		$this->assign('userinfo',$userinfo);	

		$this->assign('usernum',$usernum );		

		$this->assign('pronum',$pronum );	

		$this->assign('pronewnum',$pronewnum );

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);

		$this->display('');

	}



    public function bank(){

        

       $this->display();

    }

   

}