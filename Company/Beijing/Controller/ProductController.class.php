<?php

namespace Beijing\Controller;

use Think\Controller;

class ProductController extends Controller {

    public function index(){

		header("Content-type:text/html;charset=utf-8");

		if(empty( $_SESSION["v_uid_session"]))

		{

			 echo "<script>alert('没有登录');window.location.href='../index'</script>";

		}

		global $BeijingRolesStatus,$BeijingGroups;	

		import("ORG.Util.Page"); 

		$product = M("products");	

		$user  =M("users");

		$ptype = M("productstype");

		$plogs = M("products_logs");

		if(!empty( $_SESSION["v_company_session"])){			

		$where['v_products.company'] = $_SESSION["v_company_session"];

	}			

		$where['v_products.deltriger'] = 0;									

		$p=getpage($product,$where,10);	

		$datas['company'] = 'company';

		$datas['number'] = 'number';	

		$plist=$product->field("v_products.*,v_companies.name as cmpe")->join('LEFT JOIN  v_companies ON v_products.company =  v_companies.id','RIGHT RIGHT ON v_companies.name as cmpe')->where($where )->order(array('sort'=>'asc','number'=>'asc',))->select($datas);		

		$groups=$_SESSION["v_username_group"];	

		$this->assign('groups',$groups);

		$this->assign('p_list',$plist);

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);	

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

	$data['versionnumber']= $_POST['versionnumber'];	

	$data['patternurlurl']='';		

	//$_FILES['upimg'];

	if(!empty($_FILES['upimg']['name'])){

	$upload = new \Think\Upload(); // 实例化上传类

	$upload->maxSize   =     3145728 ;// 设置附件上传大小

	$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg','pdf');// 设置附件上传类型

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

	 }	//		 

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

	$data['versionnumber']= $_POST['versionnumber'];	

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

	$data['sort'] = $_POST['sort'];			

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

	$adminlog['uid']=$_SESSION["v_uid_session"];

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

	$where['deltriger'] = 0;

	if(!empty($_SESSION["v_company_session"])){

	$where['id'] = $_SESSION["v_company_session"];	

	

	}

	$lisc = $company->where($where)->select();

	$pttype=array();

	if(count($lisc)>0){

	//取得当前用户企业的产品分类

	$productstype=M("productstype");

	$ptwhere['deltriger'] = 0;

	$ptwhere['company']=$lisc[0]['id'];

	$pttype=$productstype->where($ptwhere)->select();

	}

	$this->assign('pttype',$pttype);

	$this->assign('id',$id);	

	$this->assign('lisc',$lisc);	 

	$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);	

	$this->display();

	}	

	//添加产品第二步

	public function p_add_next(){		

	header("Content-type:text/html;charset=utf-8");			

	$id=$_GET['id'];//提取产品信息

	$products = M("products");	

	$cmpy['id']=$id;

	$lisc = $products->field("id,(select name from v_companies c where c.id=v_products.company) as companyname,prefix,name,number,(select ptname from v_productstype p where p.ptid=v_products.ptid ) as 	ptName,patternurlurl,versionnumber,width,height,other,measurement,barcode,class,binding,wrapper,packing_12,packing_21,packing_22,packing_31,packing_32,price,amount,alarmamount,limitamount,sort,default")->where($cmpy)->find();	 

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

	$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);	

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

			$data['version_number']= $_POST['version_number'];	

			$data['weight'] = $_POST['weight'];

			$data['color'] = $_POST['colors'];

			$data['printing'] = $_POST['printing'];

			$data['back'] =  $_POST['backs'];

			$data['number'] =  $_POST['number'];     

			$items->where($where)->save($data);  	

			$this->success('编辑成功', 'p_add_next/id/'.$id);

			$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);	

			$this->display();

		 }

		else

		 {

		$items = M("items"); // 实例化items对象

		$data['pid'] = $_POST['pid'];

		//$id=$_POST['pid'];

		$data['name'] = $_POST['item_name'];

		$data['paper'] = $_POST['paper'];

		$data['version_number']= $_POST['version_number'];	

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

		global $BeijingRolesStatus,$BeijingGroups;	

		import("ORG.Util.Page"); 

		$company = M("companies");		

		$cmpy['deltriger'] = 0;

		$cmpy['id']= $_SESSION["v_company_session"];

		$lisc = $company->where($cmpy)->select();		

		$productstype = M("productstype");		

		$companyid=$_GET['cid'];

		$where=array();

		$where['deltriger']=0;

		$where['company']= $_SESSION["v_company_session"];

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

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);

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

		public function p_type_add(){

			global $BeijingRolesStatus,$BeijingGroups;	

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

			$cmpy['id']= $_SESSION["v_company_session"];

			$lisc = $company->where($cmpy)->select();

			$id=$_GET['id'];

			$productstype = M("productstype");

			$oneptype=array();

			$ptye['ptid']=$id;

			$oneptype = $productstype->where($ptye)->find();	

			$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);	

			$this->assign('oneptype',$oneptype);	

			$this->assign('lisc',$lisc);

			$this->display();	

			}

		public function p_look(){

		header("Content-type:text/html;charset=utf-8");			

		$id=$_GET['id'];//提取产品信息

		$products = M("products");	

		$cmpy['id']=$id;

		$lisc = $products->field("id,(select name from v_companies c where c.id=v_products.company) as companyname,prefix,name,number,(select ptname from v_productstype p where p.ptid=v_products.ptid ) as 	ptName,patternurlurl,versionnumber,width,height,other,measurement,barcode,class,binding,wrapper,packing_12,packing_21,packing_22,packing_31,packing_32,price,amount,alarmamount,limitamount,sort,default")->where($cmpy)->find();	 

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

		//print_r($lisc);

		//die();

		$this->assign('width_inch',$width_inch);	

		$this->assign('height_inch',$height_inch);	

		$this->assign('special',$special);	

		$this->assign('other_area',$other_area);

		$this->assign('third_packing',$third_packing);

		$this->assign('packing_default',$packing_default);			

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);	

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

		$data['versionnumber']= $_POST['versionnumber'];				

		$data['name']= $_POST['name'];	

		//$data['patternurlurl']='';		

		//$_FILES['upimg'];

		if(!empty($_FILES['upimg']['name'])){  

		$upload = new \Think\Upload();// 实例化上传类

		//$upload->uploadReplace = true;   //同名替换
		
		$upload->Replace=true;//如果存在同名文件是否进行覆盖

		$upload->autoSub = true;//使用子目录保存上传

		$upload->subName  =  $_POST[ 'customer'].'/'.$data['number']; // 设置附件上传（子）目录文件

		//$upload->subType = $_POST[ 'customer'];//使用日期模式创建子目录

		$upload->maxSize   =     3145728 ;// 设置附件上传大小

		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型

		$upload->rootPath  =      './Uploads/'; // 设置附件上传根目录

		$upload->saveName =$_POST[ 'number']."-".date("Y-m-d-H-i-s");

		// 上传单个文件 

		$info   =   $upload->uploadOne($_FILES['upimg']);

		if(!$info) {// 上传错误提示错误信息

			//$data['patternurlurl']='';

			$this->error($upload->getError());

		}else{// 上传成功 获取上传文件信息

			$data['patternurlurl']=$info['savepath'].$info['savename'];

		}

		 }		//

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

		$data['versionnumber']= $_POST['versionnumber'];			

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

		$data['sort'] = $_POST['sort'];					

		$data['deltriger'] = 0;

    	$data['available']=1;

		$data['ordered'] = 0;

		$data['hash']=generate_hash();

		$gtid=$_POST['id'];

		$where['id']=$gtid;

		$oldptid=$products->field("ptid")->where($where)->find();

		$products->where($where)->save($data);	

		

		if($oldptid!=$ptid)//更新产品后，产品分类与旧的产品分类不一致则更新产品分类下的产品数量

		{

		$productstype = M("productstype");//缺少产品日志写入
		//记录产品日志
		//$products_logs=M('products_logs');				

		//$pdata=array();

		//$pdata['pid']=$gtid;				

		//$pdata['chgnum_type']='-';

		//$pdata['chgnum_nums']=$amount;
//
//		$pdata['uid']=$_SESSION["v_uid_session"];
//
//		$pdata['ugroup']=$_SESSION["v_username_group"];
//
//		$pdata['ucompany']=$companytmp;
//
//		$pdata['atype']='order_cut';
//
//		$pdata['oid']=$oid;
//
//		$pdata['number']=$number;
//
//		$pdata['notes']="产品 ".$nametmp."[".$prefixtmp."-".$numbertmp."] 订单 #".$number." 订货 ".$amount."";
//
//		$pdata['utime']=$timenow;
//
//		$pdata['ipadd']=$ipnow;
//		
//		var_dump($pdata);
//		die();
//
//		$products_logs->add($pdata);

		$w=array();

		$w['ptid']= $oldptid;			

		$productstype->where($w)->setDec("ptnums");//旧分类下减1

		$w=array();

		$w['ptid']= $ptid;			

		$productstype->where($w)->setInc("ptnums");//新分类下加1			

		}

		

		

	    $timenow=time();

		$ipnow=$_SERVER['REMOTE_ADDR'];

		$log = M("adminlog");

		$adminlog['uid']=$_SESSION["v_uid_session"];

		$adminlog['notes']="编辑产品".$data['name']."[".$number."] ";

		$adminlog['utime']=$timenow;

		$adminlog['ipadd']=$ipnow;

		$log->data($adminlog)->add(); 

	    $this->success('修改成功', 'p_add_next/id/'.$gtid); 	

		}

		$where=array();

		$products = M("products");

		$ptype = M("productstype");

		$plogs = M("products_logs");			 

		$company = M("companies");

		$where['deltriger'] = 0;

		if(!empty($_SESSION["v_company_session"])){

	$where['id'] = $_SESSION["v_company_session"];	

	

	}

		$companylist = $company->where($where)->select();				

		$id=$_GET['id'];

		$cmpy['id']=$id;

		$lisc = $products->field("id,company,ptid,(select name from v_companies c where c.id=v_products.company) as companyname,prefix,name,number,versionnumber,(select ptname from v_productstype p where p.ptid=v_products.ptid ) as 	ptName,patternurlurl,width,height,other,measurement,barcode,class,binding,wrapper,packing_12,packing_21,packing_22,packing_31,packing_32,price,amount,alarmamount,limitamount,sort,default")->where($cmpy)->find();	 

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

		$pttype=array();

		if(count($lisc)>0){

		//取得当前用户企业的产品分类

		$productstype=M("productstype");

		$ptwhere['deltriger'] = 0;

		$ptwhere['company']=$lisc['company'];

		$pttype=$productstype->where($ptwhere)->select();

	

		}

	    $this->assign('pttype',$pttype);		

		$this->assign('product',$lisc);		

		$this->assign('companylist',$companylist);				

		$this->assign('width_inch',$width_inch);	

		$this->assign('height_inch',$height_inch);	

		$this->assign('special',$special);	

		$this->assign('other_area',$other_area);

		$this->assign('third_packing',$third_packing);

		$this->assign('packing_default',$packing_default);	

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);

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

		

		$timenow=time();

		$ipnow=$_SERVER['REMOTE_ADDR'];	

		$log = M("adminlog");

		$adminlog['uid']=$_SESSION["v_uid_session"];

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

		$adminlog['uid']=$_SESSION['v_uid_session'];

		$adminlog['utime']=$timenow;

		$adminlog['ipadd']=$ipnow;

		$adminlog['notes']="产品".$data['name'].$data['prefix']."-".$data['number'].$type.$nums.'库存';					

		$log->data($adminlog)->add();

		$plogs = M("products_logs");

		$products_logs['pid']= $id;

		$products_logs['chgnum_type']= $type;

		$products_logs['chgnum_nums']= $nums;

		$products_logs['uid']= $_SESSION['v_uid_session'];

		$products_logs['ugroup']= $_SESSION['v_group_session'];

		$products_logs['ucompany']= $_SESSION['v_company_session'];

		$products_logs['atype']= $atype;

		$products_logs['notes']= "产品".$data['name'].$data['prefix']."-".$data['number'].$type.$nums.'库存';

		$plogs->data($products_logs)->add();				

		}

		public function p_logs(){

		header("Content-type:text/html;charset=utf-8");

		global $BeijingRolesStatus,$BeijingGroups;	

		$user=M("users");	     

		import("ORG.Util.Page"); 			   	

		$ptlogs=M("products_logs");		

		//$product=M('products');		

		$company = M("companies");

		$cmpy['uid']= $_SESSION["v_uid_session"];

	    $cmpy['deltriger'] = 0;
		
		$cmpy['id']= $_SESSION["v_company_session"];	

		$where['ucompany']= $_SESSION["v_company_session"];			

		$companylist = $company->where($cmpy)->select();			
	
		$ptlogpages=$ptlogs->field("v_products_logs.*,v_users.realname as relname")->join('LEFT JOIN  v_users ON v_users.id =  v_products_logs.uid','RIGHT JOIN v_users ON v_users.realname as relname')->where($where)->order("plid desc")->count();		

		$p=getpage($ptlogs,$where,10);					

		$pslogdata=$ptlogs->field("v_products_logs.*,v_users.realname as relname")->join('LEFT JOIN  v_users ON v_users.id =  v_products_logs.uid','RIGHT JOIN v_users ON v_users.realname as relname')->limit($p->firstRow . ',' . $p->listRows)->where($where)->order("plid desc")->select();

		//var_dump ($pslogdata);

		//die();			

		//cache('a',null);

		$this->assign('companylist',$companylist);

		$this->assign('ptlogs_list',$pslogdata);

		$this->assign('page',$p->show());	

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);			

        $this->display();

	}

}