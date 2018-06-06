<?php

namespace Langfang\Controller;

use Think\Controller;





class MemberController extends Controller {

    public function index(){

		header("Content-type:text/html;charset=utf-8");

		if(empty( $_SESSION["v_uid_session"]))

		{

			 echo "<script>alert('没有登录');window.location.href='../index'</script>";

			 return;

		}

		import("ORG.Util.Page");

		global $LangRolesStatus,$LangGroups;	 

		$user = M("users");			

		if(!empty( $_SESSION["v_company_session"]))

		{

			if(isset($LangRolesStatus[$_SESSION["v_company_session"]]))

			{

				$arr=$LangRolesStatus[$_SESSION["v_company_session"]]['group'];

			}

			$where['v_users.company'] = $_SESSION["v_company_session"];

		}else

		{

			$arr=$LangRolesStatus['group'];

		} 

			$rolearr=array_keys($arr);

			$firstrolelarr=$LangGroups['Permissions']['总行审核'];

			$lastrolelarr=$LangGroups['Permissions']['财务复核'];

			$where['v_users.group']=array('IN',$rolearr,'OR');	

			$where['v_users.deltriger'] = 0;						

			$p=getpage($user,$where,10);

			//echo "111";

			//die();					

			$list=$user->field("v_users.*,v_companies.name as companiesname")->join('LEFT JOIN v_companies ON v_users.company = v_companies.id')->where($where )->order('id desc')->select();

			//var_dump($list);

			

			$uselist=array();

			foreach($list as $k=>$v)

			{

				$v['editordergroup']=0;

				if(in_array($v["group"],$firstrolelarr))

				{

					$v['editordergroup']=1;

				}

				if(in_array($v["group"],$lastrolelarr))

				{

					$v['editordergroup']=2;

				}

				$uselist[]=$v;

			}					

			$this->assign('user_list',$uselist);

			$this->assign('page',$p->show());		

			$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);	

            $this->display();	

    }

	public function setreview()	{

		global $LangRolesStatus,$LangGroups;

		$users = M("users");

		if($_POST)

		{

			$uid=$_POST['uid'];

			$urole=$_POST['urole'];

			$SelectedCuser=$_POST['SelectedCuser'];

			$uidlist=str_replace("|",",",$SelectedCuser);

			$where['id']=$uid;

			$data['uid_role']=$uidlist;

			$users->where($where)->save($data);			

			

		}else{

		$uid=$_GET['id'];

		$urole=$_GET['urole'];

		}

		$where=array();

		 $nowu['id']=$uid;

		 $nowuser=$users->where($nowu)->find();

		$listnow=array();

		 //uid_roles

	if(!empty($nowuser['uid_role'])){

		 $yiyourenarr=explode(',',$nowuser['uid_role']);

		 $yiyourenarr=array_filter($yiyourenarr);

		$now['id']=array('in',$yiyourenarr);

		$listnow = $users->where($now)->select();//已包含权限

	}

		if($urole==1)//获取支行客户

		{		

			$firstrolelarr=$LangGroups['Permissions']['订购产品'];

			$where['group']=array('IN',$firstrolelarr);			

		}

		elseif($urole==2)//获取初审用户

		{

			$lastrolelarr=$LangGroups['Permissions']['总行审核'];

			$where['group']=array('IN',$lastrolelarr);	

		}

		if(!empty( $_SESSION["v_company_session"]))

		{			

			$where['company'] = $_SESSION["v_company_session"];

		}

		$where['deltriger'] = 0;

		 $lisc = $users->where($where)->select();	

		 $this->assign('urole',$urole);			 

		 $this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);	

		 $this->assign('user_list',$lisc);

		 $this->assign('listnow',$listnow);

		 $this->assign('nowuser',$nowuser);

		 $this->display();

	}

    public function m_add(){		

		header("Content-type:text/html;charset=utf-8");	

		global $LangRolesStatus,$LangGroups;	

		$users = M("users");
		
		$region=M("region");
		
		$user_region=M("user_region");	

		if($_POST){

	    $timenow=time();

    	$ipnow=$_SERVER['REMOTE_ADDR'];

		$data['username']= $_POST[ 'name'];

                $checkuser=$users->where($data)->select();

		if(count($checkuser)>0){

		echo "<script>alert('用户已存在');window.location.href='m_add'</script>";

		return;

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

		$data['password'] = $_POST['pass'];

		$data['group']= $_POST['role'];	

		$data['company'] = $_POST['cpny'];		
		
		$data['realname'] = $_POST['rname'];	
		
		$data['tel'] = $_POST['tel'];	

		$data['active'] = "$timenow";

    	$data['host']="$ipnow";

		$data['department']=$_POST['department'];

    	$data['password'] = md5('shangshan&ruoshui' .md5($data['password']));    
		
		$data['sendaddr']=$_POST['readdress']; 		

		$users->add($data);

		echo "<script>alert('添加成功');window.location.href='index'</script>";

		}

		else{

		if(!empty( $_SESSION["v_company_session"]))

		{

			if(isset($LangRolesStatus[$_SESSION["v_company_session"]]))

			{

				$arr=$LangRolesStatus[$_SESSION["v_company_session"]]['group'];

			}

			$cmpy['id'] = $_SESSION["v_company_session"];

		}else

		{

			$arr=$LangRolesStatus['group'];

		} 

		$company = M("companies");

		$id = $_GET['id'];

		$uname = 'username';

		$rname = 'realname';

		$mid['id'] = $id;

		$cmpy['deltriger'] = 0;

		$lisc = $company->where($cmpy)->select();		

		//$list = $user->where($mid)->find();
		$reglist=$region->field("region_id as id,region_name as name")->where("parent_id=1")->select();
	    $this->assign('reglists',$reglist);

		$this->assign('id',$id);	

		$this->assign('list',$list);

		$this->assign('lisc',$lisc);

		$this->assign('grouparr',$arr);		 

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);	

	  }	

		$this->display();

	}
		//获取地区
	public function region(){

	    $id=$_GET['id'];

		$region=M("region");

		$reglist=$region->field("region_id as id,region_name as name")->where("parent_id=$id")->select();

		echo json_encode(array("reglist"=>$reglist));		

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

	public function m_edit(){

	header("Content-type:text/html;charset=utf-8");		

	global $LangRolesStatus,$LangGroups;	

	$user = M("users");	
	
	$region=M("region");
	
	$user_region=M("user_region");	

	if($_POST){

		$where['id'] = $_POST['key'];

		$dpass = $_POST['pass'];

		if(!empty($dpass)){

			$data['password'] = $_POST['pass'];

			$data['password'] = md5('shangshan&ruoshui' .md5($data['password']));

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

		$timenow=time();

    	$ipnow=$_SERVER['REMOTE_ADDR'];	

		$data['active'] = "$timenow";

    	$data['host']="$ipnow";

		$data['realname'] = $_POST['rname'];

		$data['gender'] = $_POST['gender'];

		$data['group'] = $_POST['role'];

		$data['department']=$_POST['department'];

		$data['company'] = $_POST['cpny'];

		$data['salt'] = '';		
		
		$data['sendaddr']=$_POST['readdress']; 	
		
		$data['tel'] = $_POST['tel'];

		//$this -> assign('department',$department);	
	

		$user->where($where)->save($data);

		echo "<script>alert('修改成功');window.location.href='index'</script>";

		

	}else{

		if(!empty( $_SESSION["v_company_session"]))

		{

			if(isset($LangRolesStatus[$_SESSION["v_company_session"]]))

			{

				$arr=$LangRolesStatus[$_SESSION["v_company_session"]]['group'];

			}

			$where['id'] = $_SESSION["v_company_session"];

		}else

		{

			$arr=$LangRolesStatus['group'];

		} 

		$company = M("companies");

		$id = $_GET['id'];

	    $data['salt'] = '';		

		$uname = 'username';

		$rname = 'realname';		

		$grops='group';

		$cid['id'] = $id;

		$gender='gender';

		$where['deltriger'] = 0;		

		$where['id'] = $_SESSION["v_company_session"];	

		$lisc = $company->where($where)->select();			

		$list = $user->where($cid)->find();
		
		$reglist=$region->field("region_id as id,region_name as name")->where("parent_id=1")->select();
	    $this->assign('reglists',$reglist);
		
		$this->assign('m_et',$adlist);

		$this->assign('id',$id);	

		$this->assign('list',$list);

		$this->assign('lisc',$lisc);

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);	

		$this->assign('grouparr',$arr);		

	  }		  

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

			$list=$user->field("v_users.*,v_companies.name as companiesname")->join('LEFT JOIN  v_companies ON v_users.company =  v_companies.id','RIGHT RIGHT ON v_companies.name as companiesname')->where($where,'deltriger = 0' )->order('id desc')->select();			

			$this->assign('user_list',$list);

			$this->assign('page',$p->show());	

		}

	    $this->display();

	}

	public function m_edlist(){		    

	        $this->display();

	}

		public function m_log(){

		header("Content-type:text/html;charset=utf-8");

			$user=M("users");	   

			import("ORG.Util.Page"); 		   	

		    $adminlog=M("adminlog");				

			$where['uid']=$_GET['id'];						

			$p=getpage($adminlog,$where,10);					

			$logdata=$adminlog->field("v_adminlog.*,v_users.username as usname, v_users.realname as rlname")->join('LEFT JOIN  v_users ON v_users.id =  v_adminlog.uid','LEFT JOIN  v_users ON v_users.notes as note','RIGHT JOIN v_users ON v_users.username as usname ')->where($where)->order("logid desc")->limit($p->firstRow,10)->select();		

			$this->assign('mlogs',$logdata);

			$this->assign('page',$p->show());			

            $this->display();

	}

	public function a_del(){		

			$users=M("users");

			$idlist=explode(',',$_GET['id']); 

			array_filter($idlist);   

			$where['id'] =array('IN',$idlist);			

			$data['deltriger'] = 1;					

			$users ->where($where)->save($data);

			echo "删除成功";		

	}	

}