<?php
namespace Index\Controller;
use Think\Controller;

class ProductController extends Controller {
    public function index(){
		header("Content-type:text/html;charset=utf-8");
		import("ORG.Util.Page"); 
		$product = M("products");	
		$ptype = M("productstype");
		$plogs = M("products_logs");
		if($_GET){		    
			$pid['id'] = $_GET['id'];	
			$data['deltriger'] = 0;					
			$product ->where($uid) ->save($data);		
		}			
			$where['v_products.deltriger'] = 0;									
			$p=getpage($product,$where,10);	
			$datas['company'] = 'company';
			$datas['number'] = 'number';	
			$plist=$product->field("v_products.*,v_companies.name as cmpe")->join('LEFT JOIN  v_companies ON v_products.company =  v_companies.id','RIGHT RIGHT ON v_companies.name as cmpe')->where($where )->order('id desc')->select($datas);			
			$this->assign('p_list',$plist);
			$this->assign('page',$p->show());	
	
        $this->display();	
    }   
	//添加产品
	 public function p_add(){		
		header("Content-type:text/html;charset=utf-8");			
		if($_POST){ 
		$products = M("products");
		$data['company']= $_POST[ 'customer'];
		$number = $_POST['number'];
		$nlist=explode('-',$number);
		$data['prefix']=$nlist[0];
		$data['number']=$nlist[1].'-'.$nlist[2];
		$data['name']= $_POST['name'];	
		$data['patternurlurl']='';
		
		//$_FILES['upimg'];
		 if(empty($_FILES)){  
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize   =     3145728 ;// 设置附件上传大小
		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->rootPath  =      './Uploads/'; // 设置附件上传根目录
		$upload->saveName =$_POST[ 'customer'];
		// 上传单个文件 
		$info   =   $upload->uploadOne($_FILES['upimg']);
		if(!$info) {// 上传错误提示错误信息
			$data['patternurlurl']='';
			//$this->error($upload->getError());
		}else{// 上传成功 获取上传文件信息
			$data['patternurlurl']=$info['savepath'].$info['savename'];
		}
		 }
		//
		$width_measurement=$_POST['width_measurement'];
		$height_measurement=$_POST['height_measurement'];
		$special=$_POST['special'];
		$measurement = ( $width_measurement )?'1':'0';
		$measurement .=( $height_measurement )? '1':'0';
		$measurement .=( $special )? '1':'0';
		$measurement= bindec( $measurement );
		$data['measurement']=$measurement;
		
		$ptid= $_POST[ 'ptid'];
		
		$data['ptid']=$ptid;
		$data['width'] = $_POST['width'];
		$data['height']= $_POST['height'];
		$data['other'] = $_POST['other'];	
		
		$data['barcode'] = $_POST['barcode'];
		$data['class']= $_POST['class'];
		$data['binding'] = $_POST['binding'];	
		$data['wrapper'] = $_POST['wrapper'];
			
		$data['packing_12'] = $_POST['packing_12'];
		$data['packing_21']= $_POST['packing_21'];
		$data['packing_22'] = $_POST['packing_22'];	
		$data['packing_31'] = $_POST['packing_31'];
			
		$data['packing_32'] = $_POST['packing_32'];
		$data['default']= $_POST['default'];
		$data['price'] = $_POST['price'];		
		
		$data['amount']= $_POST['amount'];
		$data['alarmamount'] = $_POST['alarmamount'];	
		$data['limitamount'] = $_POST['limitamount'];			
		$data['deltriger'] = 0;
    	$data['available']=1;
		$data['ordered'] = 0;
		$data['hash']=generate_hash();
		$insertid=$products->add($data);
		if(!empty($ptid))
		{			
			$productstype = M("productstype");
		 	$w['ptid']= $ptid;			
			$productstype->where($w)->setInc("ptnums");
			}
			 $timenow=time();
    	    $ipnow=$_SERVER['REMOTE_ADDR'];
			$log = M("adminlog");
			$adminlog['uid']=$_SESSION['jbl_uid_session'];
			$adminlog['notes']="添加新产品".$data['name']."[".$number."] ";
			$adminlog['utime']=$timenow;
			$adminlog['ipadd']=$ipnow;
			$log->data($adminlog)->add(); 
		$this->success('修改成功', 'p_add_next/id/'.$insertid);
		}
		
		$company = M("companies");
		$id = $_GET['id'];
		$uname = 'username';
		$rname = 'realname';
		$mid['id'] = $id;
		$cmpy['deltriger'] = 0;
		$lisc = $company->where($cmpy)->select();
		$this->assign('id',$id);	
		$this->assign('lisc',$lisc);	 
		$this->display();
	}
	
	//添加产品第二步
	 public function p_add_next(){			
			
	 $id=$_GET['id'];//提取产品信息
	 $products = M("products");
	
	 $cmpy['id']=$id;
	 $lisc = $products->field("id,(select name from v_companies c where c.id=v_products.company) as companyname,prefix,name,number,(select ptname from v_productstype p where p.ptid=v_products.ptid ) as ptName,patternurlurl,width,height,other,measurement,barcode,class,binding,wrapper,packing_12,packing_21,packing_22,packing_31,packing_32,price,amount,alarmamount,limitamount,default")->where($cmpy)->find();	 
	  if ( $lisc['packing_31'] && $lisc['packing_32'] ) $third_packing = true;
	  
	$measurement = decbin( $lisc['measurement'] );
	$measurement = substr( '000'.$measurement, strlen($measurement), 3 );
	if ( substr( $measurement, 0, 1 ) ) $width_inch = true;
	if ( substr( $measurement, 1, 1 ) ) $height_inch = true;
	if ( substr( $measurement, 2, 1 ) ) $special = true;
	if ( $lisc['other'] ) $other_area = true;
	
	$default = 'packing_'.$lisc['default'].'2';
	$packing_default = $lisc[$default];
	$items= M("items");	
	$where['pid'] = $id;
	$data = $items->where($where)->select();
	$type=$_GET['type'];
	$lid=$_GET['lid'];
	$onitem['id'] = $lid;
	$onitem = $items->where($onitem)->find();
	
	
	$this->assign('onitem',$onitem );
	$this->assign('type',$type );
	$this->assign('lista',$data );	
	$this->assign('id',$id);	
	$this->assign('product',$lisc);	
	$this->assign('width_inch',$width_inch);	
	$this->assign('height_inch',$height_inch);	
	$this->assign('special',$special);	
	$this->assign('other_area',$other_area);
	$this->assign('third_packing',$third_packing);
	$this->assign('packing_default',$packing_default);			
	 $this->display();
	 }
	 
	 //增加编辑操作v_items
	 public function items()
	 {
		  $id=$_POST['pid'];		 
			  
		 $type= $_POST['type'];
		 if($type=='edit'){
			 $items = M("items");
			 $lid=$_POST['lid'];
			 $where['id']=$lid;
			$data['name'] = $_POST['item_name'];
			$data['paper'] = $_POST['paper'];
			$data['weight'] = $_POST['weight'];
			$data['color'] = $_POST['colors'];
			$data['printing'] = $_POST['printing'];
			$data['back'] =  $_POST['backs'];
			$data['number'] =  $_POST['number'];     
			$items->where($where)->save($data);  	
			$this->success('编辑成功', 'p_add_next/id/'.$id);
		 }
		else
		 {
			 $items = M("items"); // 实例化items对象
		$data['pid'] = $_POST['pid'];
		$id=$_POST['pid'];
		$data['name'] = $_POST['item_name'];
		$data['paper'] = $_POST['paper'];
		$data['weight'] = $_POST['weight'];
		$data['color'] = $_POST['colors'];
		$data['printing'] = $_POST['printing'];
		$data['back'] =  $_POST['backs'];
		$data['number'] =  $_POST['number'];               
		$items->add($data);		
		$this->success('新增成功', 'p_add_next/id/'.$id);
		 }
				
	  

		 }
	//产品编号是否重复
	 public function checkproductName()
	 {
		$v=$_GET['v'];
		$products = M("products");
		$nlist=explode('-',$v);
		$cmpy['prefix']=$nlist[0];
		$cmpy['number']=$nlist[1].'-'.$nlist[2];
		$lisc = $products->where($cmpy)->count();
		 if( $lisc>0)
		 {
			 echo 1;
		}else
		{echo 0;}
		 
	}
	//根据企业选择产品分类
	 public function selectptype()
	 {
		 $id = $_GET['id'];		 
		 $productstype = M("productstype");
		 $cmpy['company']= $id;
		 $lists = $productstype->where($cmpy)->select();
		 $html="";
		 foreach($lists as $key=>$v)
		 {
			 $html .= "<option value=\"{$v['ptid']}\">{$v['ptname']}</option>\n";
		}
		 echo $html;		 
	}
	
	public function p_type()
	{
		import("ORG.Util.Page"); 
		$company = M("companies");		
		$cmpy['deltriger'] = 0;
		$lisc = $company->where($cmpy)->select();
		
		$productstype = M("productstype");		
		$companyid=$_GET['cid'];
		$where=array();
		$where['deltriger']=0;
		if(!empty($companyid))
		{
			$where['company']=$companyid;
			}
			 $p=getpage($productstype,$where,10);		
		 $productstypelist = $productstype->field("*,(select name from v_companies c where c.id=company) as companyname")->limit($p->firstRow,10)->where($where)->select();
		
		$this->assign('cid',$companyid);	
		$this->assign('productstypelist',$productstypelist);
		$this->assign('page',$p->show());	
		$this->assign('lisc',$lisc);	 
		$this->display();	
		
		}
		public function del_type()
		{
			$idlist=explode(',',$_GET['id']);
			$productstype = M("productstype");	
			$up['deltriger']=1;
			array_filter($idlist);
			$where['ptid']=array('IN',$idlist,'OR' );
			$productstype->where($where)->save($up);	
		}
		public function p_type_add()
		{
			if($_POST)
			{
				$productstype = M("productstype");	
				$customer=$_POST['customer'];
				$number=$_POST['number'];
				$data['company']=$customer;
				$data['ptname']=$number;
				$ptid=$_POST['ptid'];
				if(empty($ptid)){
					$productstype->add($data);	
				 $this->success('新增成功', 'p_type');
				}else
				{
					$ptye['ptid']=$ptid;
					$productstype->where($ptye)->save($data);	
				 $this->success('编辑成功', 'p_type');
				}
			}
			$company = M("companies");		
			$cmpy['deltriger'] = 0;
			$lisc = $company->where($cmpy)->select();
			$id=$_GET['id'];
			$productstype = M("productstype");
			$oneptype=array();
			$ptye['ptid']=$id;
			$oneptype = $productstype->where($ptye)->find();
		
			$this->assign('oneptype',$oneptype);	
			$this->assign('lisc',$lisc);
			$this->display();	
			}
		public function p_edit(){
			header("Content-type:text/html;charset=utf-8");	
			if($_POST){
			$products = M("products");
			$data['company']= $_POST[ 'customer'];
			$number = $_POST['number'];
			$nlist=explode('-',$number);
			$data['prefix']=$nlist[0];
			$data['number']=$nlist[1].'-'.$nlist[2];
			$data['name']= $_POST['name'];	
			$data['patternurlurl']='';
		
		//$_FILES['upimg'];
		 if(empty($_FILES)){  
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize   =     3145728 ;// 设置附件上传大小
		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->rootPath  =      './Uploads/'; // 设置附件上传根目录
		$upload->saveName =$_POST[ 'customer'];
		// 上传单个文件 
		$info   =   $upload->uploadOne($_FILES['upimg']);
		if(!$info) {// 上传错误提示错误信息
			$data['patternurlurl']='';
			//$this->error($upload->getError());
		}else{// 上传成功 获取上传文件信息
			$data['patternurlurl']=$info['savepath'].$info['savename'];
		}
		 }
		//
		$width_measurement=$_POST['width_measurement'];
		$height_measurement=$_POST['height_measurement'];
		$special=$_POST['special'];
		$measurement = ( $width_measurement )?'1':'0';
		$measurement .=( $height_measurement )? '1':'0';
		$measurement .=( $special )? '1':'0';
		$measurement= bindec( $measurement );
		$data['measurement']=$measurement;
		
		$ptid= $_POST[ 'ptid'];
		
		$data['ptid']=$ptid;
		$data['width'] = $_POST['width'];
		$data['height']= $_POST['height'];
		$data['other'] = $_POST['other'];	
		
		$data['barcode'] = $_POST['barcode'];
		$data['class']= $_POST['class'];
		$data['binding'] = $_POST['binding'];	
		$data['wrapper'] = $_POST['wrapper'];
			
		$data['packing_12'] = $_POST['packing_12'];
		$data['packing_21']= $_POST['packing_21'];
		$data['packing_22'] = $_POST['packing_22'];	
		$data['packing_31'] = $_POST['packing_31'];
			
		$data['packing_32'] = $_POST['packing_32'];
		$data['default']= $_POST['default'];
		$data['price'] = $_POST['price'];		
		
		$data['amount']= $_POST['amount'];
		$data['alarmamount'] = $_POST['alarmamount'];	
		$data['limitamount'] = $_POST['limitamount'];			
		$data['deltriger'] = 0;
    	$data['available']=1;
		$data['ordered'] = 0;
		$data['hash']=generate_hash();
		$gtid=$_POST['id'];
		$where['id']=$gtid;
		$oldptid=$products->field("ptid")->where($where)-find();
		$products->where($where)->save($data);
		if($oldptid!=$ptid)//更新产品后，产品分类与旧的产品分类不一致则更新产品分类下的产品数量
		{
			$productstype = M("productstype");
		 	$w['ptid']= $oldptid;			
			$productstype->where($w)->setDec("ptnums");//旧分类下减1
			$w['ptid']= $ptid;			
			$productstype->where($w)->setInc("ptnums");//新分类下加1
			
			}
		 $timenow=time();
    	    $ipnow=$_SERVER['REMOTE_ADDR'];
			$log = M("adminlog");
			$adminlog['uid']=$_SESSION['jbl_uid_session'];
			$adminlog['notes']="编辑产品".$data['name']."[".$number."] ";
			$adminlog['utime']=$timenow;
			$adminlog['ipadd']=$ipnow;
			$log->data($adminlog)->add(); 
		$this->success('修改成功', 'p_add_next/id/'.$insertid); 	
			}
			$products = M("products");
			$ptype = M("productstype");
		    $plogs = M("products_logs");			 
			$company = M("companies");
			$cmpy['deltriger'] = 0;
		    $companylist = $company->where($cmpy)->select();				
			$id=$_GET['id'];
			$cmpy['id']=$id;
			$lisc = $products->field("id,company,ptid,(select name from v_companies c where c.id=v_products.company) as companyname,prefix,name,number,(select ptname from v_productstype p where p.ptid=v_products.ptid ) as ptName,patternurlurl,width,height,other,measurement,barcode,class,binding,wrapper,packing_12,packing_21,packing_22,packing_31,packing_32,price,amount,alarmamount,limitamount,default")->where($cmpy)->find();	 
			if ( $lisc['packing_31'] && $lisc['packing_32'] ) $third_packing = true;			  
			$measurement = decbin( $lisc['measurement'] );
			$measurement = substr( '000'.$measurement, strlen($measurement), 3 );
			if ( substr( $measurement, 0, 1 ) ) $width_inch = true;
			if ( substr( $measurement, 1, 1 ) ) $height_inch = true;
			if ( substr( $measurement, 2, 1 ) ) $special = true;
			if ( $lisc['other'] ) $other_area = true;			
			$default = 'packing_'.$lisc['default'].'2';
			$packing_default = $lisc[$default];
			$items= M("items");	
			$where['pid'] = $id;
			$data = $items->where($where)->select();
			$type=$_GET['type'];
			$lid=$_GET['lid'];
			$onitem['id'] = $lid;
			$onitem = $items->where($onitem)->find();			
			
			$this->assign('product',$lisc);	
			$this->assign('companylist',$companylist);	
			
			$this->assign('width_inch',$width_inch);	
			$this->assign('height_inch',$height_inch);	
			$this->assign('special',$special);	
			$this->assign('other_area',$other_area);
			$this->assign('third_packing',$third_packing);
			$this->assign('packing_default',$packing_default);	
			$this->display();
			}
			function dongjie_pro()
			{
				
				$type=$_GET['type'];
				$id=explode(',',$_GET['id']);
				$products = M("products");
				array_filter($id);
				$where['id']=array('IN',$id,'OR' );
				if($type==1)
				{
				$up['available']=0;	
				$adminlog['notes']="冻结产品".implode(",",$id);				 
				}
				else if($type==2)
				{
				$up['available']=1;
				
				$adminlog['notes']="解冻产品".implode(",",$id);
				
				}
				else
				{
					$up['deltriger']=1;				
				$adminlog['notes']="删除产品".implode(",",$id);
				
					}
				$products->where($where)->save($up);	
			
			array_filter($idlist);
			//$where['ptid']=array('IN',$idlist,'OR' );
			$productstype->where($where)->save($up);
			 $timenow=time();
				$ipnow=$_SERVER['REMOTE_ADDR'];	
				$log = M("adminlog");
				$adminlog['uid']=$_SESSION['jbl_uid_session'];
				$adminlog['utime']=$timenow;
				$adminlog['ipadd']=$ipnow;
				$log->data($adminlog)->add(); 
				}
			function p_amount()
			{
				$id=$_GET['id'];
				$type=$_GET['type'];
				$nums=$_GET['nums'];
				$products = M("products");
				$where['id']=$id;
				$data = $products->where($where)->find();
				if($type=="-")
				{
					$atype="order_cut";
					$products->where($where)->setDec('amount',$nums);
					}
				else
				{
					$atype="order_del";
					$products->where($where)->setInc('amount',$nums); 
					}
				
			    $timenow=time();
				$ipnow=$_SERVER['REMOTE_ADDR'];	
				$log = M("adminlog");				
				$adminlog['uid']=$_SESSION['jbl_uid_session'];
				$adminlog['utime']=$timenow;
				$adminlog['ipadd']=$ipnow;
				$adminlog['notes']="产品".$data['name'].$data['prefix']."-".$data['number'].$type.$nums.'库存';		
				
				$log->data($adminlog)->add();
				$plogs = M("products_logs");
				$products_logs['pid']= $id;
				$products_logs['chgnum_type']= $type;
				$products_logs['chgnum_nums']= $nums;
				$products_logs['uid']= $_SESSION['jbl_uid_session'];
			    $products_logs['ugroup']= $_SESSION['jbl_group_session'];
				$products_logs['ucompany']= $_SESSION['jbl_company_session'];
				$products_logs['atype']= $atype;
				$products_logs['notes']= "产品".$data['name'].$data['prefix']."-".$data['number'].$type.$nums.'库存';
				$plogs->data($products_logs)->add();
				
				}
}