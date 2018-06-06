<?php
namespace Index\Controller;
use Think\Controller;

class MemberController extends Controller {
    public function index(){
		header("Content-type:text/html;charset=utf-8");
		import("ORG.Util.Page"); 
		$user = M("users");		
		if($_GET){		    
			$uid['id'] = $_GET['id'];	
			$data['deltriger'] = 1;					
			$user ->where($uid) ->save($data);		
		}
			$where['group']=array('IN',array(5),'OR' );	
			$where['v_users.deltriger'] = 0;						
			$p=getpage($user,$where,10);					
			$list=$user->field("v_users.*,v_companies.name as companiesname")->join('LEFT JOIN  v_companies ON v_users.company =  v_companies.id','RIGHT RIGHT ON v_companies.name as companiesname')->where($where )->order('id desc')->select();			
			$this->assign('user_list',$list);
			$this->assign('page',$p->show());	
	
        $this->display();
	
    }
    public function m_add(){		
		header("Content-type:text/html;charset=utf-8");		
		$users = M("users");
		if($_POST){
	    $timenow=time();
    	$ipnow=$_SERVER['REMOTE_ADDR'];
		$data['username']= $_POST[ 'name'];
		$data['password'] = $_POST['pass'];
		$data['group']= $_POST['role'];	
		$data['company'] = $_POST['cpny'];		
		$data['active'] = "$timenow";
    	$data['host']="$ipnow";
		$data['department']=$_POST['department'];
    	$data['password'] = md5('shangshan&ruoshui' .md5($data['password']));    	
		$users->add($data);
		}
		else{
		$company = M("companies");
		$id = $_GET['id'];
		$uname = 'username';
		$rname = 'realname';
		$mid['id'] = $id;
		$cmpy['deltriger'] = 0;
		$lisc = $company->where($cmpy)->select();		
		//$list = $user->where($mid)->find();
		$this->assign('id',$id);	
		$this->assign('list',$list);
		$this->assign('lisc',$lisc);
	  }	
		$this->display();
	}
	
	public function m_edit(){
	header("Content-type:text/html;charset=utf-8");		
	$user = M("users");	
	if($_POST){
		$where['id'] = $_POST['key'];
		$dpass = $_POST['pass'];
		if(!empty($dpass)){
			$data['password'] = $_POST['pass'];
			$data['password'] = md5('shangshan&ruoshui' .md5($data['password']));
		}		
		$timenow=time();
    	$ipnow=$_SERVER['REMOTE_ADDR'];	
		$data['active'] = "$timenow";
    	$data['host']="$ipnow";
		$data['realname'] = $_POST['rname'];
		$data['group'] = $_POST['role'];
		$data['department']=$_POST['department'];
		$data['company'] = $_POST['cpny'];
		$data['salt'] = '';		
		$this -> assign('department',$department);
		$user->where($where)->save($data);
		
	}else{
		$company = M("companies");
		$id = $_GET['id'];
	    $data['salt'] = '';		
		$uname = 'username';
		$rname = 'realname';		
		$cid['id'] = $id;
		$cmpy['deltriger'] = 0;		
		$lisc = $company->where($cmpy)->select();			
		$list = $user->where($cid)->find();
		$this->assign('id',$id);	
		$this->assign('list',$list);
		$this->assign('lisc',$lisc);
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
	
}