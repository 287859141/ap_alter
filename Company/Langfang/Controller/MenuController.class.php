<?php
namespace Langfang\Controller;
use Think\Controller;

class MenuController extends Controller {
    public function index(){
		//$this->assign('leftmenu',);		
        $this->display();
    }
	public function dgindex(){
	      global $LangGroups;	
		  $arr=$LangGroups;		 	
		  $this->display();		
		// $this->display();
	}	
	public function a_list(){
		$menu_info=M("menu_info");		
		$where['status'] = 0;		
		$arr=$menu_info->where($where)->select();
		//$result =$menu_info->where($where)->select();
		$result =   array();		
		//$parentlist =  i_array_column($arr, 'parent');
		//$parentlist=array_unique($parentlist);
		foreach($arr as $k=>$v){
			if($v['parent']==0)
			{			
				foreach($arr as $j=>$h){
					if($v['id']==$h['parent'])
					{
						$v['nextparent'][]=$h;
					}
			}
			$result[]=$v;
			}else
			{
				continue;
				}			
		}
		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);
		$this->assign('menu_list',$result);	   
	    $this->display();
	}
	public function a_add(){
		if($_POST){
			$menuname=$_POST['menuname'];
			$menulevel=$_POST['menulevel'];
			$menupratent=$_POST['menuparent'];
			$menusort=$_POST['menusort'];
			$menu_info=M("menu_info");
			$arr=array(
			"name"=>$menuname,
			"level"=>$menulevel,
			"parent"=>$menupratent,
			"sort"=>$menusort,
			);
			$ok=$menu_info->add($arr);
			echo "<script>alert('添加成功');window.location.href='a_add'</script>";
		}
		else
		{
		$menu_info=M("menu_info");
		$where['parent']=0;
		$arr=$menu_info->where($where)->select();
		$this->assign('menu_list',$arr);
	    $this->display();
		}
	}
	public function a_edit()
	{
		if($_POST){	
		$menu_info=M("menu_info");    
		$where['id'] = $_POST['id'];	
		$menuname=$_POST['menuname'];
		$menulevel=$_POST['menulevel'];
		$menupratent=$_POST['menuparent'];
		$menusort=$_POST['menusort'];
		$arr=array(
			"name"=>$menuname,
			"level"=>$menulevel,
			"parent"=>$menupratent,
			"sort"=>$menusort,
			);		
		$menu_info ->where($where)->save($arr);
		echo "<script>alert('修改成功');window.location.href='a_list'</script>";
		}else
		{
		$menu_info=M("menu_info");    
		$where['id'] = $_GET['id'];	
		$arr=$menu_info->where($where)->find();
		
		$parent['parent']=0;
		$parentlist=$menu_info->where($parent)->select();
		
		$this->assign('menu_list',$parentlist);
		$this->assign('arr',$arr);
		$this->display();
		}
	}
	 public function a_del(){
	//	 echo "ss";			
		if($_POST){		
			$menu_info=M("menu_info");
			$idlist=explode(',',$_POST['id']); 
			array_filter($idlist);   
			$where['id'] =array('IN',$idlist,'OR' );			
			$data['status'] = 1;					
			$menu_info ->where($where)->save($data);
		}				
    }
	public function head(){
		header("Content-type:text/html;charset=utf-8");
		global $LangRolesStatus,$LangGroups;	 
		$user = M("users");	
		$data['id']=$_SESSION["v_uid_session"];		
		$data['username']=$_SESSION["v_username_session"];
		$data['realname']=$_SESSION["v_realname_session"]; 
		$data['company']=	$_SESSION["v_company_session"];
		$where['deltriger'] = 0;			
		import("ORG.Util.Page"); 
		$user = M("users");				    
		//$uid['id'] = $_GET['id'];				
		//$data['deltriger'] = 1;					
		
		$listu=$user ->where($data)->find();
		$this->assign('listu',$listu);
		//var_dump ($listu );
		//die();
	
		//$where['company']=$_SESSION["v_company_session"];
		//$where['id']=$_SESSION["v_uid_session"];
		$this->display();
		
		
	} 
   
}