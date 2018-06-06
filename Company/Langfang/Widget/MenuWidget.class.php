<?php
namespace Langfang\Widget;
use Think\Controller;

class MenuWidget extends Controller {
public function head(){
	header("Content-type:text/html;charset=utf-8");
	global $LangRolesStatus,$LangGroups;
	$data['id']=$_SESSION["v_uid_session"];
	$data['realname']=$_SESSION["v_realname_session"]; 
	$data['company']=$_SESSION["v_company_session"];		
	$arr=array();
	$groupname="";	
	if(isset($LangRolesStatus[$_SESSION["v_company_session"]])){
			$arr=$LangRolesStatus[$_SESSION["v_company_session"]]['group'];
			}else{
			$arr=$LangRolesStatus['group'];
		}	
	foreach($arr as $key=>$v){
	    if($key==$_SESSION["v_username_group"]){
		    $groupname="$v";
			break;
		}
	}
	if(empty($groupname)){
		$arr=array();
	    if(!empty( $_SESSION["v_company_session"])){		    
			if(isset($LangRolesStatus[$_SESSION["v_company_session"]]))
			{
				$arr=$LangRolesStatus[$_SESSION["v_company_session"]]['Admingroup'];
			}else{
			$arr=$LangRolesStatus['Admingroup'];
		  }	
		}foreach($arr as $key=>$v){
	    if($key==$_SESSION["v_username_group"]){
		    $groupname="$v";
			break;
		}
	  }
	}	
	$user=M("users");
	$where['id']=$_SESSION["v_uid_session"];
	$usergender=$user->where($where)->find();	
	
	$gonggao = M("gonggao");
	$where['cid']= $_SESSION["v_company_session"];	
	$where['delflag']=0;
	$gonggaonum = $gonggao->where($where)->count();
	
	$order = M("orders");
	$comp= $_SESSION["v_company_session"];
	$where['status']= 1;
	$cmpys['uid']= $_SESSION["v_uid_session"];		
	$pronewnum = $order->where($cmpys)->count();
	$groups=$_SESSION["v_username_group"];
	
	$this->assign('groups',$_SESSION["v_username_group"]);
	$this->assign('usergender',$usergender);	
	$this->assign('groups',$groups);
	$this->assign('gonggaonum',$gonggaonum);	
	$this->assign('pronewnum',$pronewnum );
	$this->assign('gname',$groupname);	
	$this->assign('listu',$data['realname']);		
    $this->display('Menu:head');
}
}