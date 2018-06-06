<?php

namespace Beijing\Controller;

use Think\Controller;



class NoticeController extends Controller {

    public function index(){

		header("Content-type:text/html;charset=utf-8");

		import("ORG.Util.Page"); 

		$notice = M("gonggao");		

		if($_GET){		    

			$cid['cid'] = $_SESSION["v_company_session"];				

			$data['deltriger'] = 1;					

			$notice ->where($uid)->save($data);

		}

		//$where['cid']=$_SESSION["v_company_session"];	

		//$where['v_users.deltriger'] = 0;

		$groups=$_SESSION["v_username_group"];

		$where['delflag'] = 0;		

		$where['cid'] = $_SESSION["v_company_session"];			

		$p=getpage($notice,$where,10);					

		$list=$notice->field("v_gonggao.*,v_companies.name as companiesname")->join('LEFT JOIN  v_companies ON v_gonggao.cid = v_companies.id',' RIGHT ON v_companies.name as companiesname')->where($where)->order('id desc')->select();			

		$this->assign('gonggao_list',$list);

		$this->assign('groups',$groups);

		$this->assign('page',$p->show());

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);	

        $this->display();	

    }

	 public function n_add(){		

		header("Content-type:text/html;charset=utf-8");		

		$notice = M("gonggao");		

		if($_POST){

	    $timenow=time();

    	$ipnow=$_SERVER['REMOTE_ADDR'];

		$data['titles']= $_POST[ 'titles'];

		$data['contents'] = $_POST['contents'];

		$data['jointime']=  $timenow;	

		$data['status']= 1;	

		$data['joinuid']= $_SESSION["v_uid_session"];		   

		$data['cid']= $_POST["customer"];	  	

		$notice->add($data);

		$timenow=time();

		$ipnow=$_SERVER['REMOTE_ADDR'];

		$log = M("adminlog");

		$adminlog['uid']=$_SESSION["v_uid_session"];

		$adminlog['notes']="添加公告[".$data['titles']."] ";

		$adminlog['utime']=$timenow;

		$adminlog['ipadd']=$ipnow;

	    $log->data($adminlog)->add(); 

		echo "<script>alert('添加成功');window.location.href='n_add'</script>";

		}else{

		$company = M("companies");

		$where['deltriger'] = 0;

	    $where['id'] = $_SESSION["v_company_session"];	

		$lisc = $company->where($where)->select();	

		}

		$this->assign('lisc',$lisc);

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);   

		$this->display();

	}

	 public function n_edit(){

		 if($_POST)

		 {

			$notice = M("gonggao");

			$timenow=time();

			$ipnow=$_SERVER['REMOTE_ADDR'];

			$where['gid']= $_POST[ 'id'];			

			$data['contents'] = $_POST['contents'];				

			$data['joinuid']= $_SESSION["v_uid_session"];		   

			$data['cid']= $_POST["customer"];	  	

			$notice->where($where)->save($data);

			$timenow=time();

			$ipnow=$_SERVER['REMOTE_ADDR'];

			$log = M("adminlog");

			$adminlog['uid']=$_SESSION["v_uid_session"];

			$adminlog['notes']="编辑公告[".$data['titles']."] ";

			$adminlog['utime']=$timenow;

			$adminlog['ipadd']=$ipnow;

			$log->data($adminlog)->add(); 

			echo "<script>alert('修改成功');window.location.href='index'</script>"; 

			 

			 }

		 else

		 {

			 $id=$_GET['id'];

			 $notice = M("gonggao");

			 $where['gid']= $id;

			 $list=$notice->field("v_gonggao.*,v_companies.name as companiesname")->join('LEFT JOIN  v_companies ON v_gonggao.cid = v_companies.id',' RIGHT ON v_companies.name as companiesname')->where($where)->find();	

			 $company = M("companies");

			$where['deltriger'] = 0;

			$where['id'] = $_SESSION["v_company_session"];	

			$lisc = $company->where($where)->select();	

			$this->assign('lisc',$lisc);			

			$this->assign('noticeinfo',$list);

			$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);   

			$this->display();

		}

	 }

	 public function setstatus()

	 {

		 $id=$_POST['id'];

		 $status=$_POST['status'];

		 $notice = M("gonggao");

		 $where['gid']= $id;

		 $data['status'] = $status;		

		 $notice->where($where)->save($data);

		 $list=$notice->field("titles")->where($where)->find();	

		 $timenow=time();

		 $ipnow=$_SERVER['REMOTE_ADDR'];

		 $log = M("adminlog");

		 $adminlog['uid']=$_SESSION["v_uid_session"];

		 if($status){

			  $adminlog['notes']="解冻公告[".$list['titles']."] ";

		 }else{

		 $adminlog['notes']="冻结公告[".$list['titles']."] ";

		 }

		 $adminlog['utime']=$timenow;

		 $adminlog['ipadd']=$ipnow;

		 $log->data($adminlog)->add(); 

	}

	public function n_del()//单个几多个的删除操作

	{

		if($_POST){		

			$gonggao=M("gonggao");//数据表实例对象

			$idlist=explode(',',$_POST['id']); 

			array_filter($idlist);   

			$where['gid'] =array('IN',$idlist,'OR' );//需要删除的ID项			

			$data['delflag'] = 1;					

			$gonggao ->where($where)->save($data);

		}	

	}

	public function n_look(){

		$notice = M("gonggao");	

		$where['delflag'] = 0;		

		$where['cid'] = $_SESSION["v_company_session"];			

		$p=getpage($notice,$where,10);					

		$list=$notice->field("v_gonggao.*,v_companies.name as companiesname")->join('LEFT JOIN  v_companies ON v_gonggao.cid = v_companies.id',' RIGHT ON v_companies.name as companiesname')->where($where)->order('id desc')->select();			

		$this->assign('gonggao_list',$list);

		$this->assign('page',$p->show());

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);	

        $this->display();	

	 

	}

	

}