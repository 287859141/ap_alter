<?php

namespace Beijing\Controller;

use Think\Controller;

class UserController extends Controller {

    public function index(){

		header("Content-type:text/html;charset=utf-8");

		import("ORG.Util.Page"); 

		$user = M("users");		

		if($_GET){		    

			$uid['id'] = $_GET['id'];				

			$data['deltriger'] = 1;					

			$user ->where($uid)->save($data);

		}

		$where['group']=array('IN',array(15,14,91,92,9),'OR' );	

		$where['v_users.deltriger'] = 0;								

		$p=getpage($user,$where,10);					

		$list=$user->field("v_users.*,v_companies.name as companiesname")->join('LEFT JOIN  v_companies ON v_users.company = v_companies.id',' RIGHT ON v_companies.name as companiesname')->where($where)->order('id desc')->select();			

		$this->assign('user_list',$list);

		$this->assign('page',$p->show());

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);	

        $this->display();	

    }
	public function download(){
		
		
		
		  header("Content-type:text/html;charset=utf-8");
	      import("ORG.Net.Http");
           $http=new \Org\Net\Http();
           $file="Public/beijing/help.pdf";
		   echo 
           $http->download($file);			
	}

	 public function del_ausers(){

		header("Content-type:text/html;charset=utf-8");

		import("ORG.Util.Page"); 

		$user = M("users");		

		if($_GET){		    

			$uid['id'] = $_GET['id'];	

			//echo $where['id'];

			//die();

			$data['deltriger'] = 1;					

			$user ->where($uid)->save($data);

		}

		$where['group']=array('IN',array(15,14,91,92,9),'OR' );				

		$wheres['v_users.deltriger'] = 1;						

		$p=getpage($user,$where,10);					

		$list=$user->field("v_users.*,v_companies.name as companiesname")->join('LEFT JOIN  v_companies ON v_users.company =  v_companies.id',' RIGHT ON v_companies.name as companiesname')->where( $wheres)->order('id desc')->select();			

		$this->assign('user_list',$list);

		$this->assign('page',$p->show());	

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);

        $this->display();	

    }

	public function del_users_reset(){

	header("Content-type:text/html;charset=utf-8");		

	$user = M("users");	

	$company['id'] = $_GET['$user.company'];

	if($_POST){		

		$where['id'] = $_POST['key'];

		$dpass = $_POST['pass'];		

		if(!empty($dpass)){

			$data['password'] = $_POST['pass'];

			$data['password'] = md5('shangshan&ruoshui' .md5($data['password']));

		}		

		$data['realname'] = $_POST['rname'];

		$data['group'] = $_POST['role'];

		$data['company'] = $_POST['cpny'];

		$data['deltriger'] = $_POST['status'];

		$data['salt'] = '';

		$user->where($where)->save($data);

		echo "<script>alert('修改成功');window.location.href='del_users_reset'</script>";		

	}else{

		$company = M("companies");

		$id = $_GET['id'];

		$uname = 'username';

		$rname = 'realname';

		$where['id'] = $id;	

		$cmpy['deltriger'] = 0;		

		$lisc = $company->where($cmpy)->select();		

		$list = $user->where($where)->find();

		$this->assign('id',$id);	

		$this->assign('list',$list);

		$this->assign('lisc',$lisc);

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);

	  }	

		$this->display();

	}

    public function auser_add(){		

		header("Content-type:text/html;charset=utf-8");		

		$users = M("users");		

		if($_POST){

	    $timenow=time();

    	$ipnow=$_SERVER['REMOTE_ADDR'];

		$data['username']= $_POST[ 'name'];

		$data['password'] = $_POST['pass'];

		$data['group']= $_POST['role'];		

		$data['company']= $_POST['cpny'];		

		$data['active'] = "$timenow";

    	$data['host']="$ipnow";

    	$data['password'] = md5('shangshan&ruoshui' .md5($data['password']));    	

		$users->add($data);

		echo "<script>alert('添加成功');window.location.href='auser_add'</script>";

		}else{

		$company = M("companies");

		$id = $_GET['id'];

		$uname = 'username';

		$rname = 'realname';

		$mid['id'] = $id;

		$cmpy['deltriger'] = 0;

		$lisc = $company->where($cmpy)->select();	

		}

		$this->assign('lisc',$lisc);

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);   

		$this->display();

	}
	//验证账号是否存在
	public function check_name()
		{
			$username=$_GET['username'];

			$ckuname = M("users");	

			$w['username']=$username;			

			$ckname = $ckuname->where($w)->count();	
			
			echo $ckname;
		}
	

	public function auser_edit(){

	header("Content-type:text/html;charset=utf-8");		

	$user = M("users");	

	$company['id'] = $_GET['$user.company'];

	if($_POST){		

		$where['id'] = $_POST['key'];

		$dpass = $_POST['pass'];

		if(!empty($dpass)){

			$data['password'] = $_POST['pass'];

			$data['password'] = md5('shangshan&ruoshui' .md5($data['password']));

		}		

		$data['realname'] = $_POST['rname'];

		$data['group'] = $_POST['role'];

		$data['company'] = $_POST['cpny'];

		$data['salt'] = '';

		$user->where($where)->save($data);

		 echo "<script>alert('修改成功');window.location.href='auser_edit'</script>";		

	}else{

		$company = M("companies");

		$id = $_GET['id'];

		$uname = 'username';

		$rname = 'realname';

		$where['id'] = $id;

		$cmpy['deltriger'] = 0;		

		$lisc = $company->where($cmpy)->select();		

		$list = $user->where($where)->find();

		$this->assign('id',$id);	

		$this->assign('list',$list);

		$this->assign('lisc',$lisc);

	  }	

	  $this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);   

	  $this->display();

	}

	public function member(){

		header("Content-type:text/html;charset=utf-8");

		import("ORG.Util.Page"); 

		$user = M("users");		

		if($_POST){		    

			$where['id'] = $_POST['usid'];

			$dels['deltriger'] = 1;				

			$user ->where($where)  ->save($dels);

		}else{

			$where['group']=array(array('eq',5),'OR' );			

			$p=getpage($user,$where,10);		

			$list=$user->field("v_users.*,v_companies.name as companiesname")->join('LEFT JOIN  v_companies ON v_users.company =  v_companies.id',' RIGHT ON v_companies.name as companiesname')->where($where,'deltriger = 0' )->order('id desc')->select();			

			$this->assign('user_list',$list);

			$this->assign('page',$p->show());	

		}

	    $this->display();

	}

	public function user_log(){

		header("Content-type:text/html;charset=utf-8");

		$user=M("users");	   

		import("ORG.Util.Page");	

		$adminlog=M("adminlog");				

		$where['uid']=$_GET['id'];						

		$p=getpage($adminlog,$where,10);					

		$logdata=$adminlog->field("v_adminlog.*,v_users.username as usname,v_users.realname as rlname")->join('LEFT JOIN  v_users ON v_users.id =  v_adminlog.uid','LEFT JOIN  v_users ON v_users.notes as note','RIGHT JOIN v_users ON v_users.username as usname ')->where($where)->order("logid desc")->limit($p->firstRow,10)->select();	

		$this->assign('uslogs_list',$logdata);

		$this->assign('page',$p->show());

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);			

        $this->display();

	}

public function checkpwd()	{	
		$pwd=$_GET['pwd'];		

		$userinfo=M("users")->where(array('id'=> $_SESSION["v_uid_session"]))->find();
			
		if ($userinfo["password"] == md5('shangshan&ruoshui' .md5($pwd).$userinfo["salt"]))

		{				

		echo 1;

		return;

		}

		echo -1;

	}	

	public function edit_user(){

		header("Content-type:text/html;charset=utf-8");

		$user = M("users");	

		$region=M("region");

		$user_region=M("user_region");	

		if($_POST){	

		if(!empty($_POST['rname'])){  

			$data['realname'] = $_POST['rname'];

		}	

		if(!empty($_POST['gender'])){  

			$data['gender'] = $_POST['gender'];

		}

		if(!empty($_POST['pass'])&&!empty($_POST['firstpass'])){  

			$userinfo=M("users")->where(array('id'=> $_SESSION["v_uid_session"]))->find();

			$data['password']=md5('shangshan&ruoshui' .md5($_POST['pass']).$userinfo["salt"]);

			}

		if(!empty($_POST['readdress'])){  

			$data['sendaddr'] = $_POST['readdress'];

		}

		if(!empty($_POST['countys'])){  

			//用户地区关联表保存

			$reg['uid'] =$_SESSION["v_uid_session"];

			$isval=$user_region->field("id")->where($reg)->find();

			if(is_array($isval) && !empty($isval['region_id'])){

				$reg['regid'] =$_POST['countys'];

				$rewhere['region_id'] = $isval['region_id'];

				$user_region ->where($rewhere)->save($reg);

			}else

			{

				$reg['regid'] =$_POST['countys'];

				$user_region ->add($reg);

				}

		}	

		if(!empty($_POST['tel'])){  

			$data['tel'] = $_POST['tel'];

		}

		if(!empty($_POST['email'])){  

			$data['email'] = $_POST['email'];

		}

		

			$uid['id'] = $_SESSION["v_uid_session"];					

			$user ->where($uid)->save($data);

				

		}	

		

		$where['id'] = $_SESSION["v_uid_session"];

		$list=$user->field("v_users.*")->where($where)->find();	

		

		/**$wuser_region['uid'] =$_SESSION["v_uid_session"];

		$isval=$user_region->field("id,uid,regid,region_name,region_type,parent_id")->join(" left join v_region on id=region_id")->where($wuser_region)->find();//用户地区关联表读取

		if(is_array($isval) && !empty($isval['id'])){

			

		}**/

		$reglist=$region->field("region_id as id,region_name as name")->where("parent_id=1")->select();

		$this->assign('reglists',$reglist);		

		$this->assign('edit_user',$list);

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);      

	    $this->display();

	}

	public function region(){

	    $id=$_GET['id'];

		$region=M("region");

		$reglist=$region->field("region_id as id,region_name as name")->where("parent_id=$id")->select();

		echo json_encode(array("reglist"=>$reglist));

		

	}

	public function my_user_log(){

		header("Content-type:text/html;charset=utf-8");

		$user=M("users");	   

		import("ORG.Util.Page");

		$adminlog=M("adminlog");				

		$where['id']= $_SESSION["v_uid_session"];

		$logspages=$adminlog->field("v_adminlog.*,v_users.username as usname,v_users.realname as rlname")->join('LEFT JOIN  v_users ON v_users.id =  v_adminlog.uid','LEFT JOIN  v_users ON v_users.notes as note','RIGHT JOIN v_users ON v_users.username as usname ')->where($where)->order("logid desc")->count();			

		$p = new \Think\Page($logspages,20);

		$logdata=$adminlog->field("v_adminlog.*,v_users.username as usname,v_users.realname as rlname")->join('LEFT JOIN  v_users ON v_users.id =  v_adminlog.uid','LEFT JOIN  v_users ON v_users.notes as note','RIGHT JOIN v_users ON v_users.username as usname ')->limit($p->firstRow . ',' . $p->listRows)->where($where)->order("logid desc")->select();			

		//var_dump ($logdata);

	    // die();	

		$this->assign('myuslogs_list',$logdata);

		$this->assign('page',$p->show());	

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);		

        $this->display();

	}

}