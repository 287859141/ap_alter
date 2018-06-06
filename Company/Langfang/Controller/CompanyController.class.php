<?php
namespace Langfang\Controller;
use Think\Controller;

class CompanyController extends Controller {
    public function index(){		
        $this->display();
    }
	public function cp_type_list()
		{
			$company = M("companies");
			header("Content-type:text/html;charset=utf-8");		
	     	import("ORG.Util.Page"); 		
						
			$where['deltriger']= 0;								
			$p=getpage($company,$where,12);	
			$cplist=$company->where($where)->select();	
				
			$this->assign('cp_list',$cplist);
			$this->assign('page',$p->show());	
			$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);	
			$this->display();  
		}
	public function cp_depart_list()
	{
		import("ORG.Util.Page"); 
		$depart = M("departments");
		$cpny='';	
		if($_GET)
		{
			$cpny=$_GET['cpny'];
			if(!empty($cpny)){
				$where['cp_id']=$cpny;
			}
		}
		
		$where['status']= 0;								
			$p=getpage($depart,$where,8);	
			$cplist=$depart->where($where)->select();	
			
			$this->assign('cp_list',$cplist);
			$this->assign('cpny',$cpny);
			$this->assign('page',$p->show());		
			
		$company = M("companies");
		$cmpy['deltriger'] = 0;
		$lisc = $company->where($cmpy)->select();
		$this->assign('lisc',$lisc);
	      
		  $this->display();	
	}
	public function cp_depart(){
		header("Content-type:text/html;charset=utf-8");		
		$depart = M("departments");		
		if($_POST){	    
		$data['name']= $_POST[ 'name'];
		$data['cp_id']= $_POST['cpny'];		
		  	   	
		$depart->add($data);
		 echo "<script>alert('添加成功');window.location.href='cp_depart'</script>";
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
	      
		  	$this->display();   
	}
	public function cp_departedit()
	{
			$depart = M("departments");			
			
			if($_POST){
			$where['id']= $_POST['id'];
			$data['name']= $_POST[ 'name'];
			$data['cp_id']= $_POST['cpny'];	
			$depart ->where($where) ->save($data);
			echo "<script>alert('修改成功');window.location.href='cp_depart_list'</script>";	
			}
			$where['id']= $_GET['id'];
			$depart=$depart->where($where)->find();	
		
		$company = M("companies");
		$cmpy['deltriger'] = 0;
		$lisc = $company->where($cmpy)->select();
		$this->assign('lisc',$lisc);
		$this->assign('depart',$depart);
		$this->display();
	}
	public function cp_departdel(){
		$company = M("departments");		
		$idlist=explode(',',$_GET['id']);		
		$up['status']=1;
		array_filter($idlist);
		$where['id']=array('IN',$idlist,'OR' );
		$company->where($where)->save($up);	
	
	}
	public function cp_add(){
		if($_POST){
			$cpuname=$_POST['cpname'];
			$cpuser=$_POST['cpusers'];
			$cpdel=$_POST['cpdel'];
			$cporderby=$_POST['cporderby'];
			$company=M("companies");
			$arr=array(
			"name"=>$cpuname,
			"users"=>$cpuser,
			"deltriger"=>$cpdel,
			"ordertype"=>$cporderby,
			);
			$ok=$company->add($arr);
			   echo "<script>alert('添加成功');window.location.href='cp_add'</script>";
		}
		else
		{
		$company = M("companies");	
		$where['deltriger']=0;
		$arr=$company->where($where)->select();
		$this->assign('cp_list',$arr);
	    $this->display();
		}
	}
	public function cp_edit(){
	//header("Content-type:text/html;charset=utf-8");	     
			//$idlist=explode(',',$_GET['id']);
			$company = M("companies");				
			
			if($_POST){
			$where['id']= $_POST['id'];
			$datas['name']=$_POST['cpname'];
			$datas['deltriger']=$_POST['status'];
			$datas['ordertype']=$_POST['cporder'];	
			$company ->where($where) ->save($datas);
			echo "<script>alert('修改成功');window.location.href='cp_type_list'</script>";	
			}
			$where['id']= $_GET['id'];
			$rig=$company->where($where)->find();	
			//$cps->$where($where)->save($id);
			
			$this->assign('cp_rig',$rig);		
	        $this->display();
	}
	public function cp_del(){
		$company = M("companies");		
		$idlist=explode(',',$_GET['id']);		
		$up['deltriger']=1;
		array_filter($idlist);
		$where['id']=array('IN',$idlist,'OR' );
		$company->where($where)->save($up);	
	
	}
	public function cp_model(){
		
	    $this->display();
	}
   public function role_list()
   {
	   header("Content-type:text/html;charset=utf-8");
	   //分配权限，分配菜单--菜单连接地址
	   $compayid=$_GET['compayid'];
	   $roles=M('roles');	  
	   import("ORG.Util.Page"); 		
						
		$where['role_status']= 0;								
		$p=getpage($roles,$where,10);	
		$role=$roles->where($where)->select();	
			
		$this->assign('role_list',$role);
		$this->assign('cpid',$compayid);
		$this->assign('page',$p->show());	
	   $this->display(); 
	   
	}
	
	public function role_add()
   {
	    header("Content-type:text/html;charset=utf-8");
	   //分配权限，分配菜单--菜单连接地址   
	    global $perArray;
	    $compayid=$_GET['compayid'];
		$company = M("companies");	
		$roles=M('roles');	  
	    import("ORG.Util.Page"); 		
						
		$where['role_status']= 0;								
		$p=getpage($roles,$where,10);	
		$role=$roles->where($where)->select();	
			
		$this->assign('role_list',$role);
		$this->assign('cp_array',$perArray);
		//print_r ($perArray);
		//die();
		$this->assign('page',$p->show());	
	    $this->display(); 
	   
	}

   
}