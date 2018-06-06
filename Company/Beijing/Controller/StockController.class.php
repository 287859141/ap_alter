<?php

namespace Beijing\Controller;

use Think\Controller;

class StockController extends Controller {

    public function index(){		

		header("Content-type:text/html;charset=utf-8");			

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

		$where['v_orders.status'] = 1;	

		$firstrolelarr=$BeijingGroups['Permissions']['分行审核'];

		$salesrolelarr=$BeijingGroups['Permissions']['营销管理员'];

        $xiadingdanarr=$BeijingGroups['Permissions']['订购产品'];

		if(in_array( $_SESSION["v_username_group"],$firstrolelarr)or$_SESSION["v_username_group"]==9)

		{

			$reviewstatus=1;//初审

			$yiyourenarr=explode(',',$userinfo['uid_role']);

		 	$yiyourenarr=array_filter($yiyourenarr);	

			$where['v_orders.uid']=array('in',$yiyourenarr);	

		}

		/*else if(in_array( $_SESSION["v_username_group"],$salesrolelarr))

		{

			$reviewstatus=1;//复审

			if(!empty($userinfo['uid_role'])){

			$yiyourenarr=explode(',',$userinfo['uid_role']);

		 	$yiyourenarr=array_filter($yiyourenarr);	

			$where['v_orders.shenheuser']=array('in',$yiyourenarr);

			}

			if(empty($userinfo['uid_role'])){

			echo "<script>alert('权限错误!');window.history.back(-1)</script>";

			return;

			}

			$where['v_orders.status'] = 2;

			$where['shenhechg'] = 1;	

		}*/

               else if(in_array( $_SESSION["v_username_group"],$xiadingdanarr))

		{

			$reviewstatus=0;//提交人	

			$where['v_orders.uid']=$_SESSION["v_uid_session"];

		}

$searchcount=$order->field("v_orders.*,v_companies.id as cpid,v_companies.name as cpname,v_users.company as comname,v_users.department as depart,v_users.realname as realname")->join('LEFT JOIN  v_users ON v_users.id = v_orders.uid LEFT JOIN  v_companies ON v_companies.id = v_users.company')->where($where)->count();

		$p = new \Think\Page($searchcount,10);	

		$olist=$order->field("v_orders.*,v_companies.id as cpid,v_companies.name as cpname,v_users.company as comname,v_users.department as depart,v_users.realname as realname")->join('LEFT JOIN  v_users ON v_users.id = v_orders.uid LEFT JOIN  v_companies ON v_companies.id = v_users.company')->limit($p->firstRow,10)->where($where)->order('v_orders.id desc')->select();	

		//echo $order->getLastSql();

		//die();

		$this->assign('reviewstatus',$reviewstatus);

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);			

		$this->assign('order',$olist);

		$this->assign('page',$p->show());	

        $this->display();	

    }  

	//ajax获取客户

		//入库管理
	public function storage_management(){
       $this->display();
    }
	//出库管理
	public function warehouse_management(){
       $this->display();
    }

	public function o_getuser()

	{

		 global $LangRole;

		 $cpid=$_POST['comp'];

		 $user = M("users");

		 $where['deltriger'] = 0;

		 $where['group']=5;

		 $where['company'] =  $cpid;

		 $lisc = $user->where($where)->select();

		 $html="";

		foreach($lisc as $key=>$v)

		{

			$html.="<option value=\"".$v['id']."\">".$v['realname'].'  ['.$v['department']."]</option>";	

		}

		echo $html;

	}	

	public function pt_upload(){

	header("Content-type:text/html;charset=utf-8");	 

	$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);

    $this->display();	

	} 

	public function o_agent(){

		$company = M("companies"); 

		$users=M("users");

		if(!empty($_SESSION["v_company_session"])){

	    $where['id'] = $_SESSION["v_company_session"];

    	}

	    $cplist=$company->where($where)->select();

		$this->assign('cplist',$cplist);

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);		

	    $this->display();		

	}

	public function o_at_newsub(){

	header("Content-type:text/html;charset=utf-8");	

	global $BeijingGroups,$LandnowCom; 

	$rolelarr=array(15,9);

	if($_POST){

	$comid				=encodestrall($_POST["company"]);

	$clientuser		=encodestrall($_POST["clientuser"]);//客户筛选条件radio

	$SelectedCuser			=encodestrall($_POST["SelectedCuser"]);

	$_SESSION["atnew_comid"]=$comid;

	$_SESSION["atnew_clientuser"]=$clientuser;

	$_SESSION["atnew_SelectedCuser"]=$SelectedCuser;

	}

	//$rolelarr=$BeijingGroups['Permissions']['订购产品'];

	//print_r($BeijingGroups['Permissions']);

	//die();

	//权限过滤

		if(in_array($_SESSION["v_username_group"],$rolelarr))

		{	

			$users=M('users');

			$uid['id']= $_SESSION["v_uid_session"];

			/**

			$data['orderdeny']='1';

			$data['orderbegin']=$begintime;

			$data['orderover']=$overtime;

			*/

			$userfind=$users->field("orderdeny,orderbegin,orderover")->where($uid)->find();

			if($userfind['orderdeny']==1)

			{

				$orderform_locktime_str="<td colspan=\"2\"><font color=red><b>提醒：您已经被锁定订货时间：".$userfind['orderbegin']." 至 ".$userfind['orderover']."</b></font></td>";

			}		

			$comid=$LandnowCom;

			$company = M("companies");

			$cowhere['id']=$comid;

			$Mrecord_Com=$company->field("ordertype")->where($cowhere)->find();

			//	$SQL="Select ordertype from jbl_companies where id='".$_SESSION["jbl_company_session"]."'";

		//$Mrecord_Com=@mysql_fetch_array(@mysql_query($SQL));

			$ptype = M("productstype");			

			$cmpy['company']= $comid;

			$lists = $ptype->where($cmpy)->select();

			$product = M("products");	

			$where['p.deltriger'] = 0;

			$where['p.company'] = $comid;

			$where['p.available'] = 1;

			if(!empty($_GET['skey']))

			{

				$skey=$_GET['skey'];

				$this->assign('skey',$skey );

				$where['p.name | p.number']=array("like","%".$skey."%");

				//$where['p.number']=array("like","%".$skey."%");

				}

			if(!empty($_GET['ptid']))

			{

				$ptid=$_GET['ptid'];

				$this->assign('ptid',$ptid );

				$where['p.ptid'] = $_GET['ptid'];

				}

			$plist=$product->field("p.*,pt.ptname")->join(' p LEFT JOIN v_productstype pt ON pt.ptid = p.ptid')->where($where )->order(array('p.sort'=>'asc','p.number'=>'asc'))->select();	

			$productarr=array();

			foreach($plist as $key=>$val){

			$id=$val["id"];

			$name=$val["name"];

			$prefix=$val["prefix"];

			$number=$val["number"];

			$patternurlurl=$val["patternurlurl"];

			$packing_12=$val["packing_12"];

			$packing_21=$val["packing_21"];

			$packing_22=$val["packing_22"];

			$packing_31=$val["packing_31"];

			$packing_32=$val["packing_32"];

			$default=$val["default"];

			$amount=$val["amount"];

			$limitamount=$val["limitamount"];

			$sort=$val["sort"];

			$ptname=$val["ptname"];	

			$default = 'packing_'.$default.'2';

			$unit=$$default;	

			$baozhuangguige="1".$packing_12;

			$baozhuangguige.=($packing_21&&$packing_22)?" × ".$packing_21.$packing_22:"";

			$baozhuangguige.=($packing_31&&$packing_32)?" × ".$packing_31.$packing_32:"";	

			$iszero=(($Mrecord_Com['ordertype'])&&($amount<=0))?1:0;

			$amount_font=($amount<=0)?" style='color:red;'":"";

			$limitamount_echo=$limitamount>0?$limitamount:"";

			$one=array();

			$one['id']=$id;

			$one['patternurlurl']=$patternurlurl;

			$one['pnum']=$prefix."-".$number;

			$one['name']=$name;

			$one['ptname']=$ptname;

			$one['amount']=$amount;

			$one['aunt']=$amount.$unit;

			$one['limiamount']=$limitamount_echo;

			$one['sort']=$sort;

			$one['unit']=$unit;

			$one['iszero']=$iszero;

			$one['baozhuangguige']=$baozhuangguige;

			$productarr[]=$one;

			}			

			$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);

			$this->assign('lists',$lists );

			$this->assign('ordertype',$Mrecord_Com['ordertype'] );

			$this->assign('orderform_locktime_str',$orderform_locktime_str);

			$this->assign('plist',$productarr );

			$this->display();

		}else

		{

			echo "无权限";

		}

	}

		//添加代订购产品

	public function o_agent_confirm()

	{	

		$products=M("products");

		$orderitems=M("orderitems");

		$id			=($_POST["id"]);

		$amount_kc	=($_POST["amount_kc"]);

		$amount		=($_POST["amount"]);

		$pwhere['available']=1;

		$pwhere['deltriger']=0;

		$insertdata=array();

		for($i=0;$i<count($id);$i++)

		{

			$amount[$i]=intval($amount[$i]);		

			if(( preg_match( '%^[1-9]\d*$%', $amount[$i] ) ))

			{

				$pwhere['id']=encodestrall($id[$i]);

				$sRecord_P=$products->where($pwhere)->find();		

				if($sRecord_P['id'])

				{		

					$owhere['pid']=$sRecord_P['id'];

					$owhere['uid']=$_SESSION["v_uid_session"];

					$owhere['oid']=0;

					$owhere['default']=$sRecord_P['default'];				

					$sRecord_OT=$orderitems->where($owhere)->find();					

					if($sRecord_OT['id'])

					{

						$amount_s=$amount[$i]+$sRecord_OT['amount'];

						if(($sRecord_P['limitamount']>0)&&($amount_s>$sRecord_P['limitamount']))

						{

							$limit=true;

							break;

						}

						//仓储式

						if($Mrecord_Com['ordertype']) $amount_s=$amount_s>$amount_kc[$i]?$amount_kc[$i]:$amount_s;						

						if($sRecord_OT['pid']=$sRecord_P['id'])						

						{										    

					     		$price=$sRecord_P['price'] * $amount_s;

								$upwhere['id']=$sRecord_OT['id'];

								$data['amount']=$amount_s;

								$data['price']=$price;						

								$orderitems->where($upwhere)->save($data);								

						}else{

								break;

							  }								

					}

					else

					{

						$amount_s=$amount[$i];

						if(($sRecord_P['limitamount']>0)&&($amount_s>$sRecord_P['limitamount']))

						{							

							$limit=true;

							break;

						}

						//仓储式

						if($Mrecord_Com['ordertype']) $amount_s=$amount_s>$amount_kc[$i]?$amount_kc[$i]:$amount_s;

						$price=$sRecord_P['price'] * $amount_s;

						$data=array();

						$data['pid']=$sRecord_P['id'];

						$data['uid']=$_SESSION["v_uid_session"];

						$data['oid']=0;

						$data['default']=$sRecord_P['default'];

						$data['amount']=$amount_s;

						$data['price']=$price;

						$insertdata[]=$data;

					}

				}

			}

		}

		if(count($insertdata)>0)

		{

			$orderitems->addAll($insertdata);

		}

		echo "<script>window.location.href='o_show_agent'</script>";

	}

	//显示代订购产品列表

	public function o_show_agent()

	{

		$users=M("users");

		$orderitems=M("orderitems");

		$orderform_locktime_str="";

		// id='".$_SESSION['v_uid_session']."' and `group`='5' and deltriger='0

		$uwhere['id']=$_SESSION["v_uid_session"];

		$uwhere['group']=5;

		$uwhere['deltriger']=0;

		$userinfo=$users->where($uwhere)->find();

		if($userinfo['orderdeny']==1)

		{

			$orderform_locktime_str="<font color=red><b>提醒：您已经被锁定订货时间：".$userinfo['orderbegin']." 至 ".$userinfo['orderover']."</b></font>";

		}	

		$owhere['o.oid']=0;

		$owhere['o.uid']=$_SESSION["v_uid_session"];

		$orderlist=$orderitems->field("o.id, o.amount, o.default, p.id as pid,p.amount as pamount,p.name, p.prefix,p.number,p.price,p.packing_12,p.packing_21, p.packing_22, p.packing_31, p.packing_32,p.limitamount")->join(" o LEFT JOIN v_products p ON o.pid = p.id")->where($owhere)->order("o.id ASC")->select();

		$arr=array();

		foreach($orderlist as $key=>$v){

		$id=$v["id"];

		$amount=$v["amount"];

		$default=$v["default"];

		$pid=$v["pid"];

		$name=$v["name"];

		$prefix=$v["prefix"];

		$number=$v["number"];

		$pamount=$v["pamount"];

		$packing_12=$v["packing_12"];

		$packing_21=$v["packing_21"];

		$packing_22=$v["packing_22"];

		$packing_31=$v["packing_31"];

		$packing_32=$v["packing_32"];

		$limitamount=$v["limitamount"];

		$baozhuangguige="1".$packing_12;

		$baozhuangguige.=($packing_21&&$packing_22)?" × ".$packing_21.$packing_22:"";

		$baozhuangguige.=($packing_31&&$packing_32)?" × ".$packing_31.$packing_32:"";

		$default = 'packing_'.$default.'2';

		$unit=$$default;

		$limitamount_echo=$limitamount>0?$limitamount:"";

		$v['baozhuangguige']=$baozhuangguige;

		$v['default_edit']=$default;

		$v['unit']=$unit;

		$v['limitamount_echo']=$limitamount_echo;

		$v['pnum']=$prefix."-".$number;

		$arr[]=$v;

		}

		$comid=$_SESSION["atnew_comid"];

		$clientuser=$_SESSION["atnew_clientuser"];

		$SelectedCuser=$_SESSION["atnew_SelectedCuser"];

				

		$zhihanguser = M("users");

		 $where['deltriger'] = 0;

		 $where['group']=5;

		 $where['company'] =  $comid;

		 if($clientuser==0){

			 $SelectedCuser_Array=str_replace("|",",",$SelectedCuser);

				$where['id']=array('IN',$SelectedCuser_Array);	

		 }

		 $zhihanglisc = $zhihanguser->where($where)->select();

		$this->assign('zhihanglisc',$zhihanglisc);

		$this->assign('sumzhihang',count($zhihanglisc));

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);

		$this->assign('orderform_locktime',$orderform_locktime_str);

		$this->assign('oritemarr',$arr);

		$this->assign('total',count($arr));

		$this->assign('userinfo',$userinfo);

		$this->display();

	}

	

	//加入订单 

	public function agent_neworder()

	{

		header("Content-type:text/html;charset=utf-8");

		$uidlist=$_POST['uidlist'];//encodestrall($_POST['uidlist']);	

		$notes=$_POST['notes'];		

		$istrue=0;

		$istruesum=0;

		$allsum=count($uidlist);

		$companies=M('companies');

		$s['id']=$_SESSION["v_company_session"];

		$EchoStr=array();

		$Mrecord_Com=$companies->field("ordertype")->where($s)->find();		

		$users=M('users');

		$orders=M('orders');

		$orderitems=M('orderitems');

		$owhere['uid']=$_SESSION["v_uid_session"];

		$owhere['oid']=0;		

		$sRecord_OT=$orderitems->where($owhere)->find();

		

		$arrlist=$orderitems->field("ot.*,p.amount as pamount,p.name,p.prefix,p.number,p.company,p.default,p.price ")->join("ot LEFT JOIN v_products p ON p.id = ot.pid")->where($owhere)->order("ot.id asc")->select();

		

		foreach($uidlist as $key=>$userid){

			$u['id']=$userid;

			$u['group']=5;

			$u['deltriger']=0;

			$sRecord_locktime=$users->where($u)->find();

			$orderform_locktime_str="";	

			if(!empty( $_SESSION["v_company_session"]))

			{			

				$where['v_companies.id'] = $_SESSION["v_company_session"];

			}			

			if($sRecord_locktime['orderdeny']==1)

			{

				$timenow		=time();

				$begintime		=getunix($sRecord_locktime['orderbegin']);

				$overtime		=getunix($sRecord_locktime['orderover'])+24*60*60;			

				if(($timenow<$begintime)||($timenow>$overtime))

				{	

					$EchoStr[]=array("uid"=>$userid ,"realname"=>$sRecord_locktime['realname'],"errortxt"=>"该用户被锁定订货时间：".$sRecord_locktime['orderbegin']." 至 ".$sRecord_locktime['orderover']."。现在不能提交订单");	

					continue;					

				}

			}		

					

		if($sRecord_OT['id'])

		{		

			

			$sRecord_Max=$orders->field("MAX(number) AS maxnumber")->find();		

			$number = intval($sRecord_Max['maxnumber']) + mt_rand( 1, 200 );		

			$rename=$sRecord_locktime['realname'];

			$adrtel=$sRecord_locktime['tel'];

			$sadr=$sRecord_locktime['sendaddr'];			

			$timenow=time();

			$ipnow=$_SERVER['REMOTE_ADDR'];

			$orderdata['number']=$number;

			$orderdata['uid']=$userid;

			$orderdata['starttime']=$timenow;

			$orderdata['status']=1;

			$orderdata['recipients']=$rename;

			$orderdata['sendaddr']=$sadr;

			$orderdata['tel']=$adrtel;

			$orderdata['notes']=$notes[$key];

			$oid=$orders->add($orderdata);		

			if($oid)

			{

				$allprice=0;

				$orderitemadd=array();

				//$orderitemadd['']=	

				//$sRecord_OT=$orderitems->where($owhere)->save($odata);

				//$oitemwhere['ot.oid']=$oid;

				//减少库存 BEGIN

							

				foreach($arrlist as $key=>$val){

				$id=$val["id"];

				$pid=$val["pid"];

				$amount=$val["amount"];

				$nametmp=$val["name"];

				$prefixtmp=$val["prefix"];

				$numbertmp=$val["number"];

				$companytmp=$val["company"];

				$pamount=$val["pamount"];

				$pricetmp=$val["price"];

				

				$orderitemadd['oid']=$oid;

				$orderitemadd['pid']=$pid;	

				$orderitemadd['hash']="";	

				$orderitemadd['uid']=$userid;

				$orderitemadd['default']=$val['default'];				

				//	

				//仓储式

				if($Mrecord_Com['ordertype'])

				{

					$amount=$amount>$pamount?$pamount:$amount;

					$price=$pricetmp * $amount;	

									

					$orderitemadd['amount']=$amount;

					$orderitemadd['price']=$price;

					

					$allprice+=$price;

					//$orderitems->where($oitemwhere)->save($odata);					

				}else{	//开放式		

					$price=$pricetmp * $amount;

					

					$orderitemadd['amount']=$amount;

					$orderitemadd['price']=$price;

					

					$allprice+=$price;					

				}

				$orderitems->add($orderitemadd);//添加产品

				

				$products=M('products');

				$pwhere['id']=$pid;

				//$pdata=array();

				//$pdata['amount']="amount-".$amount;

				$products->where($pwhere)->setDec("amount",$amount);//减少库存

				//记录产品日志

				$products_logs=M('products_logs');				

				$pdata=array();

				$pdata['pid']=$pid;

				$pdata['chgnum_type']='-';

				$pdata['chgnum_nums']=$amount;

				$pdata['uid']=$_SESSION["v_uid_session"];

				$pdata['ugroup']=5;

				$pdata['ucompany']=$companytmp;

				$pdata['atype']='order_cut';

				$pdata['oid']=$oid;

				$pdata['number']=$number;

				$pdata['notes']="产品 ".$nametmp."[".$prefixtmp."-".$numbertmp."] 订单 #".$number." 订货 ".$amount."";

				$pdata['utime']=$timenow;

				$pdata['ipadd']=$ipnow;

				$products_logs->add($pdata);

				}

				//减少库存 OVER				

				$log = M("adminlog");

				$otpwhere=array();

				$otpwhere['id']=$oid;

				$osdata=array();								

				$osdata['allprice']= $allprice;				

				$orders->where($otpwhere)->save($osdata);

				

				$adminlog['uid']=$_SESSION["v_uid_session"];

				$adminlog['notes']="添加订单 [#".$number."] ";

				$adminlog['utime']=$timenow;

				$adminlog['ipadd']=$ipnow;

				$log->data($adminlog)->add();

				$istrue=1;

				$istruesum+=1;				

			}

			else

			{				

				$EchoStr[]=array("uid"=>$userid ,"realname"=>$sRecord_locktime['realname'],"errortxt"=>"操作失败");	

				continue;

			}

		}

		}

		if($istrue){

			$orderitems=M('orderitems');

			$owhere=array();

			$owhere['uid']=$_SESSION["v_uid_session"];

			$owhere['oid']=0;		

			$orderitems->where($owhere)->delete();

			$_SESSION["atnew_comid"]=0;

			$_SESSION["atnew_clientuser"]=0;

			$_SESSION["atnew_SelectedCuser"]=0;

			unset($_SESSION["atnew_comid"]);

			unset($_SESSION["atnew_clientuser"]);

			unset($_SESSION["atnew_SelectedCuser"]);

		}		

		$this->assign('allsum',$allsum);

		$this->assign('truesum',$istruesum);

		$this->assign('errsum',count($EchoStr));

		$this->assign('errusers',$EchoStr);

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);	

		$this->display();

}

	public function o_see(){

	header("Content-type:text/html;charset=utf-8");	

	import("ORG.Util.Page"); 

	$order = M("orders");

	$ologs = M("orders_logs");

	$oitems = M("orderitems");

	$osendlogs = M("orders_sendlogs");

	$oid['v_orders.id'] = $_GET['id'];

	$seelist=$order->field("v_orders.*,v_companies.id as cpid,v_companies.name as cpname,v_users.company as comname,v_users.department as depart,v_users.realname as realname,v_users.tel as adrtel,v_users.sendaddr as sadr")->join('LEFT JOIN  v_users ON v_users.id = v_orders.uid LEFT JOIN  v_companies ON v_companies.id = v_users.company')->where($oid)->find();

	$osid['v_orderitems.oid'] = $oid['v_orders.id'];

	//$where['v_orderitems.oid'] = $oid['v_orders.id'];

    $p=getpage($oitems,$osid,10);

	$ptlist= $oitems->field("v_orderitems.*,v_products.prefix as prefix,v_products.number as number,v_products.name as name,v_products.packing_12,v_products.packing_22,v_products.packing_32")->join('LEFT JOIN v_products ON  v_orderitems.pid = v_products.id')->where($osid)->select();	

	$this->assign('orderspct',$ptlist);	

	$this->assign('ordersee',$seelist);

	$this->assign('page',$p->show());

	$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);	

    $this->display();

	}

	public function o_list_edit(){

	header("Content-type:text/html;charset=utf-8");	

	global $BeijingRolesStatus,$BeijingGroups;	

	import("ORG.Util.Page");

	$users = M("users");

	$order = M("orders");

	$ologs = M("orders_logs");

	$oitems = M("orderitems");

	$osendlogs = M("orders_sendlogs");

	$oid['v_orders.id'] = $_GET['id'];	

	$seelist=$order->field("v_orders.*,v_companies.id as cpid,v_companies.name as cpname,v_users.company as comname,v_users.department as depart,v_users.realname as realname,v_users.tel as adrtel,v_users.sendaddr as sadr")->join('LEFT JOIN  v_users ON v_users.id = v_orders.uid LEFT JOIN  v_companies ON v_companies.id = v_users.company')->where($oid)->find();

	$osid['v_orderitems.oid'] = $oid['v_orders.id'];

    $p=getpage($oitems,$osid,10);

	$ptlist= $oitems->field("v_orderitems.*,v_products.prefix as prefix,v_products.number as number,v_products.name as name,v_orderitems.id as oitid,v_products.packing_12,v_products.packing_21,v_products.limitamount,v_products.packing_22,v_products.packing_31,v_products.packing_32")->join('LEFT JOIN v_products ON  v_orderitems.pid = v_products.id')->where($osid)->select();	

	$usewhere['id']= $_SESSION["v_uid_session"];

	$userinfo=$users->where($usewhere)->find();

	$_SESSION["v_username_group"]=$userinfo['group'];

	$usgroups=$userinfo['group'];

	global $BeijingGroups,$LandnowCom; 

	$rolelarr=$BeijingGroups['Permissions']['新增产品'];

	//权限过滤

	if(in_array($_SESSION["v_username_group"],$rolelarr))

	{	

		$users=M('users');

		$uid['id']= $_SESSION["v_uid_session"];

		/**

		$data['orderdeny']='1';

		$data['orderbegin']=$begintime;

		$data['orderover']=$overtime;

		*/

		$userfind=$users->field("orderdeny,orderbegin,orderover")->where($uid)->find();

		if($userfind['orderdeny']==1)

		{

			$orderform_locktime_str="<td colspan=\"2\"><font color=red><b>提醒：您已经被锁定订货时间：".$userfind['orderbegin']." 至 ".$userfind['orderover']."</b></font></td>";

		}		

		$comid=$LandnowCom;

		$company = M("companies");

		$cowhere['id']=$comid;

		$Mrecord_Com=$company->field("ordertype")->where($cowhere)->find();

		//	$SQL="Select ordertype from jbl_companies where id='".$_SESSION["jbl_company_session"]."'";

	   //$Mrecord_Com=@mysql_fetch_array(@mysql_query($SQL));

		$ptype = M("productstype");	

		$cmpy['company']= $comid;

		$lists = $ptype->where($cmpy)->select();

		$product = M("products");

		$where['p.deltriger'] = 0;

		$where['p.company'] = $comid;

		$where['p.available'] = 1;

		if(!empty($_GET['skey']))

		{

			$skey=$_GET['skey'];

			$this->assign('skey',$skey );

			$where['p.name | p.number']=array("like","%".$skey."%");

		}

		if(!empty($_GET['ptid']))

		{

			$ptid=$_GET['ptid'];

			$this->assign('ptid',$ptid );

			$where['p.ptid'] = $_GET['ptid'];

		}

		$plist=$product->field("p.*,pt.ptname")->join(' p LEFT JOIN v_productstype pt ON pt.ptid = p.ptid')->where($where )->order(array('p.sort'=>'asc','p.id'=>'asc'))->select();	

		$productarr=array();

		foreach($plist as $key=>$val){

		$id=$val["id"];

		$name=$val["name"];

		$prefix=$val["prefix"];

		$number=$val["number"];

		$patternurlurl=$val["patternurlurl"];

		$packing_12=$val["packing_12"];

		$packing_21=$val["packing_21"];

		$packing_22=$val["packing_22"];

		$packing_31=$val["packing_31"];

		$packing_32=$val["packing_32"];

		$default=$val["default"];

		$amount=$val["amount"];

		$limitamount=$val["limitamount"];

		$sort=$val["sort"];

		$ptname=$val["ptname"];	

		$default = 'packing_'.$default.'2';

		$unit=$default;	

		$baozhuangguige="1".$packing_12;

		$baozhuangguige.=($packing_21&&$packing_22)?" × ".$packing_21.$packing_22:"";

		$baozhuangguige.=($packing_31&&$packing_32)?" × ".$packing_31.$packing_32:"";

		$iszero=(($Mrecord_Com['ordertype'])&&($amount<=0))?1:0;

		$amount_font=($amount<=0)?" style='color:red;'":"";

		$limitamount_echo=$limitamount>0?$limitamount:"";

		$one=array();

		$one['id']=$id;

		$one['patternurlurl']=$patternurlurl;

		$one['pnum']=$prefix."-".$number;

		$one['name']=$name;

		$one['ptname']=$ptname;

		$one['amount']=$amount;

		$one['aunt']=$amount.$unit;

		$one['limiamount']=$limitamount_echo;

		$one['sort']=$sort;

		$one['unit']=$unit;

		$one['iszero']=$iszero;

		$one['baozhuangguige']=$baozhuangguige;

		$productarr[]=$one;

		}	

		//$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);

		$this->assign('lists',$lists );

		//$this->assign('ordertype',$Mrecord_Com['ordertype'] );

		//$this->assign('orderform_locktime_str',$orderform_locktime_str );

		$this->assign('plist',$productarr );

		//$this->display();

		}else

		{

			echo "无权限";

		}

		$this->assign('orderspct',$ptlist);	

		$this->assign('ordersee',$seelist);

		$this->assign('oid',$_GET['id']);

		$this->assign('page',$p->show());

		$this->assign('usgroups',$usgroups);	

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);	

	    $this->display();

	}

	//增加产品

	public function o_ordernewadd(){

		header("Content-type:text/html;charset=utf-8");	

		global $BeijingGroups,$LandnowCom; 

		$rolelarr=$BeijingGroups['Permissions']['新增产品'];

		//权限过滤

		if(in_array($_SESSION["v_username_group"],$rolelarr))

		{	

			$users=M('users');

			$uid['id']= $_SESSION["v_uid_session"];

			/**

			$data['orderdeny']='1';

			$data['orderbegin']=$begintime;

			$data['orderover']=$overtime;

			*/

			$userfind=$users->field("orderdeny,orderbegin,orderover")->where($uid)->find();

			if($userfind['orderdeny']==1)

			{

				$orderform_locktime_str="<td colspan=\"2\"><font color=red><b>提醒：您已经被锁定订货时间：".$userfind['orderbegin']." 至 ".$userfind['orderover']."</b></font></td>";

			}		

			$comid=$LandnowCom;

			$company = M("companies");

			$cowhere['id']=$comid;

			$Mrecord_Com=$company->field("ordertype")->where($cowhere)->find();

			//	$SQL="Select ordertype from jbl_companies where id='".$_SESSION["jbl_company_session"]."'";

		//$Mrecord_Com=@mysql_fetch_array(@mysql_query($SQL));

			$ptype = M("productstype");			

			$cmpy['company']= $comid;

			$lists = $ptype->where($cmpy)->select();

			$product = M("products");	

			$where['p.deltriger'] = 0;

			$where['p.company'] = $comid;

			$where['p.available'] = 1;

			if(!empty($_GET['skey']))

			{

				$skey=$_GET['skey'];

				$this->assign('skey',$skey );

				$where['p.name | p.number']=array("like","%".$skey."%");

				}

			if(!empty($_GET['ptid']))

			{

				$ptid=$_GET['ptid'];

				$this->assign('ptid',$ptid );

				$where['p.ptid'] = $_GET['ptid'];

				}

			$plist=$product->field("p.*,pt.ptname")->join(' p LEFT JOIN v_productstype pt ON pt.ptid = p.ptid')->where($where )->order(array('p.sort'=>'asc','p.id'=>'asc'))->select();	

			$productarr=array();

			foreach($plist as $key=>$val){

			$id=$val["id"];

			$name=$val["name"];

			$prefix=$val["prefix"];

			$number=$val["number"];

			$patternurlurl=$val["patternurlurl"];

			$packing_12=$val["packing_12"];

			$packing_21=$val["packing_21"];

			$packing_22=$val["packing_22"];

			$packing_31=$val["packing_31"];

			$packing_32=$val["packing_32"];

			$default=$val["default"];

			$amount=$val["amount"];

			$limitamount=$val["limitamount"];

			$sort=$val["sort"];

			$ptname=$val["ptname"];	

			$default = 'packing_'.$default.'2';

			$unit=$$default;	

			$baozhuangguige="1".$packing_12;

			$baozhuangguige.=($packing_21&&$packing_22)?" × ".$packing_21.$packing_22:"";

			$baozhuangguige.=($packing_31&&$packing_32)?" × ".$packing_31.$packing_32:"";	

			$iszero=(($Mrecord_Com['ordertype'])&&($amount<=0))?1:0;

			$amount_font=($amount<=0)?" style='color:red;'":"";

			$limitamount_echo=$limitamount>0?$limitamount:"";

			$one=array();

			$one['id']=$id;

			$one['patternurlurl']=$patternurlurl;

			$one['pnum']=$prefix."-".$number;

			$one['name']=$name;

			$one['ptname']=$ptname;

			$one['amount']=$amount;

			$one['aunt']=$amount.$unit;

			$one['limiamount']=$limitamount_echo;

			$one['sort']=$sort;

			$one['unit']=$unit;

			$one['iszero']=$iszero;

			$one['baozhuangguige']=$baozhuangguige;

			$productarr[]=$one;

			}			

			$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);

			$this->assign('lists',$lists );

			$this->assign('ordertype',$Mrecord_Com['ordertype'] );

			$this->assign('orderform_locktime_str',$orderform_locktime_str );

			$this->assign('plist',$productarr );

			$this->display();

		}else

		{

			echo "无权限";

		}

	}

	//增加订购产品

	public function oit_edit_add()

	{	

		$products=M("products");

		$order = M("orders");	

		$orderitems=M("orderitems");

		$id			=($_POST["id"]);

		$amount_kc	=($_POST["amount_kc"]);

		$amount		=($_POST["amount"]);		

		$oiwhere['oid']=$_POST['osid'];			

		$pwhere['available']=1;

		$pwhere['deltriger']=0;	

		$insertdata=array();

		for($i=0;$i<count($id);$i++)

		{

			$amount[$i]=intval($amount[$i]);	

			if(( preg_match( '%^[1-9]\d*$%', $amount[$i] ) ))

			{

				$pwhere['id']=encodestrall($id[$i]);				

				$sRecord_P=$products->where($pwhere)->find();

				$orderad=$order->where($oiwhere)->find();		

				if($sRecord_P['id'])

				{

					$owhere['pid']=$sRecord_P['id'];

					if($_SESSION["v_group_session"]==5)

					{

					$owhere['uid']=$_SESSION["v_uid_session"];		

					}					

					$owhere['oid']=$_POST['osid'];	

					$owhere['default']=$sRecord_P['default'];

					$sRecord_OT=$orderitems->where($owhere)->find();	

					if($sRecord_OT['id'])

					{

						$amount_s=$amount[$i]+$sRecord_OT['amount'];

						if(($sRecord_P['limitamount']>0)&&($amount_s>$sRecord_P['limitamount']))

						{

							$limit=true;

							break;

						}

						//仓储式

						if($Mrecord_Com['ordertype']) $amount_s=$amount_s>$amount_kc[$i]?$amount_kc[$i]:$amount_s;

						//$price=$sRecord_P['price'] * $amount[$i]+$sRecord_OT['price'];

						$price=$sRecord_P['price'] * $amount_s;						

						$upwhere['id']=$sRecord_OT['id'];												

						$data['amount']=$amount_s;

						$data['price']=$price;

						$orderitems->where($upwhere)->save($data);		

						//@mysql_query($sql);

					}

					else

					{

						$amount_s=$amount[$i];

						if(($sRecord_P['limitamount']>0)&&($amount_s>$sRecord_P['limitamount']))

						{

							$limit=true;

							break;

						}

						//仓储式

						if($Mrecord_Com['ordertype']) $amount_s=$amount_s>$amount_kc[$i]?$amount_kc[$i]:$amount_s;

						$price=$sRecord_P['price'] * $amount_s;

						$data=array();

						$data['pid']=$sRecord_P['id'];

						$data['uid']=$_SESSION["v_uid_session"];						

						$data['oid']=$_POST['osid'];	

						$data['default']=$sRecord_P['default'];

						$data['amount']=$amount_s;

						$data['price']=$price;

						$insertdata[]=$data;		

					}

				}

			}

		}		

		if(count($insertdata)>0)

		{

			$orderitems->addAll($insertdata);

		}

		echo "<script>alert('添加成功!');self.location=document.referrer;</script>";

	}

	public function oit_edit_del(){		

		$orderitems=M("orderitems");		

		$id=$_GET['id'];		

		$where['id']=$id;

		$ckorder = M("orders");		

		$review=$_GET['reviewstatus'];	

		$idlist=explode(',',$_GET['id']); 

		$idlist=array_filter($idlist);   

		$where['id'] =array('IN',$idlist);		

		if($review==1)

		{

			$where['status'] = 1;

			$data['status'] = 2; 

			$data['shenhechg'] = 1;	

			$data['shenheuser'] = $_SESSION['v_uid_session'];

			$data['shenhetime'] = time();

		}

		elseif($review==2)

		{

			$where['status'] = 2;

			$data['status'] = 5;

			$data['shenhechg1'] = 1;	

			$data['shenheuser1'] = $_SESSION['v_uid_session'];

			$data['shenhetime1'] = time();

		}

		$ckorder->where($where)->save($data);	

		//$where['uid']=$_SESSION["v_uid_session"];			

		$orderitems->where($where)->delete();

		//echo $orderitems->getLastSql();

		//die();

		echo "删除成功";					

	}

	 public function o_edit_up(){

		$order = M("orders");

		$oitems = M("orderitems");

		$products = M("products");

		$companies = M("companies");

		$orders_logs = M("orders_logs");

		$timenow=time();

		$ipnow=$_SERVER['REMOTE_ADDR'];			

		if($_POST){

		global $BeijingRolesStatus,$BeijingGroups;

			if(isset($BeijingRolesStatus[$_SESSION["v_company_session"]]['group']))

		{	

			$groupval=$BeijingRolesStatus[$_SESSION["v_company_session"]]['group'][$_SESSION["v_username_group"]];

		}

		else 

		{

			$groupval=$BeijingRolesStatus['group'][$_SESSION["v_username_group"]];

		}

		if(empty($groupval)){

			if(isset($BeijingRolesStatus[$_SESSION["v_company_session"]]['Admingroup'][$_SESSION["v_username_group"]]))	{

				$groupval=$BeijingRolesStatus[$_SESSION["v_company_session"]]['Admingroup'][$_SESSION["v_username_group"]];

			}else

			{

			$groupval=$BeijingRolesStatus['Admingroup'][$_SESSION["v_username_group"]];

			}

		}

		$orisnum = $_POST['amount'];

		$orisid = $_POST['amounts'];

		$oid=$_POST['id'];

		$orpid['v_orders.id']= $oid;

		$Record_C=$order->field("v_orders.*,u.company")->join(" LEFT JOIN v_users u ON u.id = v_orders.uid")->where($orpid)->find();

		$comwhere['id']=$Record_C['company'];		

		$Mrecord_Com=$companies->field("ordertype")->where($comwhere)->find();

		for($i=0;$i<count($orisid );$i++){

		    $itemwhere=array();

			$itemwhere['id']=$orisid[$i];

			$itemarr=$oitems->where($itemwhere)->find();

			if($itemarr['amount']!=$orisnum[$i])

			{				

				$pwhere['id']=$itemarr['pid'];            

				$sRecord_P=$products->where($pwhere)->find();	

				$itemwhere['id']=$orisid[$i];

			    $where['id']=$itemwhere['pid'];		

				$a['amount'] = $orisnum[$i];				

				$a['price']=$sRecord_P['price']*$a['amount'] ;			

				$oitems->where($itemwhere)->save($a);//更新订单产品数量             

				$roletmp=$groupval;

				if(!empty($_SESSION["v_company_session"])){

					$where=array();

					$where['id'] = $_SESSION["v_company_session"];	

					$ucomarr=$companies->where($where)->find();

					$roletmp.="&nbsp;".$ucomarr['name'];

					}	

				$roletmp.="&nbsp;".$_SESSION["v_realname_session"];	

				$orderslog=array();

				$orderslog['oid']=$oid;

				$orderslog['roletmp']=$roletmp;

				$orderslog['number']=$Record_C['number'];

				$orderslog['uid']=$_SESSION["v_uid_session"];

				$orderslog['notes']="订单 [#".$Record_C['number']."] 更新产品 [".$itemarr['pid']."] ";

				$orderslog['logtime']=$timenow;	

				$orders_logs->data($orderslog)->add();	

			}		

			//if($itemarr['amount']>$orisnum[$i])//编辑库存

		//	{	

			  //  $itemwhere['id']=$orisid[$i];

			   // $where['id']=$itemwhere['pid'];

			   // $Record_up=$products->where($where)->seclect();				      

				//$a['amount'] = $orisnum[$i];				

			//	$a['price']=$sRecord_P['price']*$Record_up['amount'] ;

			   // var_dump($itemwhere['id']);

				//die();

				//$oitems->where($itemwhere)->save($a);//更新订单产品数量       

				//$roletmp=$groupval;

				//if(!empty($_SESSION["v_company_session"])){

//					$where=array();

//					$where['id'] = $_SESSION["v_company_session"];	

//					$ucomarr=$companies->where($where)->find();

//					$roletmp.="&nbsp;".$ucomarr['name'];

//					}	

//				$roletmp.="&nbsp;".$_SESSION["v_realname_session"];	

//				$orderslog=array();

//				$orderslog['oid']=$oid;

//				$orderslog['roletmp']=$roletmp;

//				$orderslog['number']=$Record_C['number'];

//				$orderslog['uid']=$_SESSION["v_uid_session"];

//				$orderslog['notes']="订单 [#".$Record_C['number']."] 编辑产品 [".$itemarr['pid']."] ";

//				$orderslog['logtime']=$timenow;	

//				$orders_logs->data($orderslog)->add();	

//

//			}

			//}else

			//{

				//}

		}

		$data['realname'] = $_POST['realname'];

		$data['tel'] = $_POST['adrtel'];

		$data['sendaddr'] = $_POST['sadr'];

		$data['notes'] = $_POST['notes'];

		$order->where($orpid)->save($data);

		$log = M("adminlog");

		$adminlog['uid']=$_SESSION["v_uid_session"];

		$adminlog['notes']="修改订单 [#".$Record_C['number']."]  ";

		$adminlog['utime']=$timenow;

		$adminlog['ipadd']=$ipnow;

		$log->data($adminlog)->add(); 

		}	

		$this->success('订单更新成功！', 'index');

	}

	public function o_del(){

		$ckorder = M("orders");	

		$idlist=explode(',',$_GET['id']); 

		$idlist=array_filter($idlist);   

		$delwhere['id'] =array('IN',$idlist);	

		$deldata['status'] = 20; 

		$deldata['shenhechg'] = 0;	

		$deldata['shenheuser'] = $_SESSION['v_uid_session'];

		$deldata['shenhetime'] = time();

		$delorderlist=$ckorder->where($delwhere)->select();

		$timenow=time();

		$ipnow=$_SERVER['REMOTE_ADDR'];	

		$orderitems=M('orderitems');

		$products=M('products');

		$products_logs=M('products_logs');

		$companies = M("companies");

		$orders_logs = M("orders_logs");

		global $BeijingRolesStatus,$BeijingGroups;

			if(isset($BeijingRolesStatus[$_SESSION["v_company_session"]]['group']))

		{	

			$groupval=$BeijingRolesStatus[$_SESSION["v_company_session"]]['group'][$_SESSION["v_username_group"]];

		}

		else 

		{

			$groupval=$BeijingRolesStatus['group'][$_SESSION["v_username_group"]];

		}

		if(empty($groupval)){

			if(isset($BeijingRolesStatus[$_SESSION["v_company_session"]]['Admingroup'][$_SESSION["v_username_group"]]))	{

				$groupval=$BeijingRolesStatus[$_SESSION["v_company_session"]]['Admingroup'][$_SESSION["v_username_group"]];

			}else

			{

			$groupval=$BeijingRolesStatus['Admingroup'][$_SESSION["v_username_group"]];

			}

		}

		foreach($delorderlist as $key=>$val)

		{

			$osid=array();

			$osid['v_orderitems.oid'] = $val['id'];		

			$ptlist= $orderitems->field("v_orderitems.*,v_products.prefix as prefix,v_products.number as number,v_products.name as name,v_products.packing_12,v_products.packing_21,v_products.limitamount,v_products.packing_22,v_products.packing_31,v_products.packing_32")->join('LEFT JOIN v_products ON  v_orderitems.pid = v_products.id')->where($osid)->select();	

			foreach($ptlist as $k=>$v){	

				//$SQL="delete from jbl_orderitems where id='".$otid."' and uid='".$Record_C['uid']."' and oid='".$oid."'";

				$ptwhere=array();

				$ptwhere['id']=$v['pid'];

				$products->where($pwhere)->setInc("amount",$v['amount']);

				$ptlogwhere['pid']=$v['pid'];

				$ptlogwhere['chgnum_type']="+";

				$ptlogwhere['chgnum_nums']=$v['amount'];

				$ptlogwhere['uid']=$_SESSION['v_uid_session'];

				$ptlogwhere['ugroup']=$_SESSION["v_username_group"];

				$ptlogwhere['ucompany']=$_SESSION["v_company_session"];

				$ptlogwhere['atype']='order_add';

				$ptlogwhere['oid']=$v['pid'];

				$ptlogwhere['number']=$v['pid'];

				$ptlogwhere['notes']=='产品'.$v['name']."[".$v['prefix']."-".$v['number']."] 订单 #".$val['number']." 订货修改退回 ".$v['amount'];

				$ptlogwhere['utime']=$timenow;

				$ptlogwhere['ipadd']=$ipnow;

				$products_logs->data(v)->add();			

			//编辑库存 OVER

			}

			$log = M("adminlog");

			$adminlog['uid']=$_SESSION["v_uid_session"];

			$adminlog['notes']="修改订单 [#".$val['number']."]  ";

			$adminlog['utime']=$timenow;

			$adminlog['ipadd']=$ipnow;

			$log->data($adminlog)->add(); 

			$roletmp=$groupval;

			if(!empty($_SESSION["v_company_session"])){

				$where=array();

				$where['id'] = $_SESSION["v_company_session"];	

				$ucomarr=$companies->where($where)->find();

				$roletmp.="&nbsp;".$ucomarr['name'];

				}	

				$roletmp.="&nbsp;".$_SESSION["v_realname_session"];				

				$orderslog=array();

				$orderslog['oid']=$val['id'];

				$orderslog['roletmp']=$roletmp;

				$orderslog['number']=$val['number'];

				$orderslog['uid']=$_SESSION["v_uid_session"];

				$orderslog['notes']="删除订单 [#".$val['number']."] ";

				$orderslog['logtime']=$timenow;			

				$orders_logs->data($orderslog)->add();

		}

		$ckorder->where($delwhere)->save($deldata);

	}

	public function o_cheks(){		

		$ckorder = M("orders");		

		$review=$_GET['reviewstatus'];	

		$idlist=explode(',',$_GET['id']); 

		$idlist=array_filter($idlist);   

		$where['id'] =array('IN',$idlist);		

		if($review==1)

		{

			$where['status'] = 1;

			$data['status'] = 2; 

			$data['shenhechg'] = 1;	

			$data['shenheuser'] = $_SESSION['v_uid_session'];

			$data['shenhetime'] = time();

		}

		elseif($review==2)

		{

			$where['status'] = 2;

			$data['status'] = 5;

			$data['shenhechg1'] = 1;	

			$data['shenheuser1'] = $_SESSION['v_uid_session'];

			$data['shenhetime1'] = time();

		}

		$ckorder->where($where)->save($data);	

	}

	 public function o_overs(){		

		header("Content-type:text/html;charset=utf-8");		

		import("ORG.Util.Page"); 

		$order = M("orders");	

		$ologs = M("orders_logs");

		$osendlogs = M("orders_sendlogs");

		$users=M('users');				

		$where['v_orders.status'] = array('IN',array(5,2),'OR' );

		global $BeijingRolesStatus,$BeijingGroups;

		$firstgroup=$BeijingRolesStatus[$_SESSION["v_company_session"]]['group'][81];	

		if(!empty( $_SESSION["v_company_session"]))

		{	

			$where['company'] = $_SESSION["v_company_session"];			

			$where['v_companies.id'] = $_SESSION["v_company_session"];

			$userwhere['company']=$_SESSION["v_company_session"];

			if(isset($BeijingRolesStatus[$_SESSION["v_company_session"]]))

			{

				$firstgroup=$BeijingRolesStatus[$_SESSION["v_company_session"]]['group'][81];	

				}

		}

		if($_SESSION["v_username_group"]==5)

		{

			$where['v_orders.uid']= $_SESSION["v_uid_session"];

		}	

		$editpres=0;

		if($_SESSION["v_username_group"]==15 || $_SESSION["v_username_group"]==9)

		{//管理员可以进行编辑、修改、删除

			$editpres=1;

			}								

	//	$p=getpage($order,$where,10);

		$searchcount=$order->field("v_orders.id")->join('LEFT JOIN  v_users ON v_users.id = v_orders.uid LEFT JOIN  v_companies ON v_companies.id = v_users.company')->where($where)->count();

		$p = new \Think\Page($searchcount,10);

		$userwhere['deltriger']=0;

		$userwhere['group']=81;

		$userfirstinfo=$users->where($userwhere)->select();

		//$userwhere['group']=82;	

		//$userlastinfo=$users->where($userwhere)->select();	

		$olist=$order->field("v_orders.*,v_companies.id as cpid,v_companies.name as cpname,v_users.company as comname,v_users.department as depart,v_users.realname as realname,v_users.realname as realname")->join('LEFT JOIN  v_users ON v_users.id = v_orders.uid LEFT JOIN  v_companies ON v_companies.id = v_users.company')->limit($p->firstRow,10)->where($where)->order('id desc')->select();

		$orderlist=array();

		foreach($olist as $key=>$val)

		{

			$val['firstshenhe']='未审核';

			$val['laseshenhe']='未审核';

			if(!empty($val['shenheuser']))

			{

				foreach($userfirstinfo as $k=>$v)

				{

					if($val['shenheuser']==$v['id']){

						$val['firstshenhe']=$firstgroup." ".$v['realname']."";

					break;

					}

				}

			}

			if(!empty($val['shenheuser1']))

			{

				foreach($userlastinfo as $k=>$v)

				{

					if($val['shenheuser1']==$v['id']){

						$val['laseshenhe']=$saleadmingroup.$v['realname'];

					break;

					}

				}

			}

			$orderlis[]=$val;

			}		

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);			

		$this->assign('order',$orderlis);

		$this->assign('editpres',$editpres);

		$this->assign('page',$p->show());

        $this->display();	

	 }

	 //结束以完成订单，管理员或送货员操作

	 public function o_ending(){

	 header("Content-type:text/html;charset=utf-8");	

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

		$where['v_orders.status'] = 2;	

		//$firstrolelarr=$BeijingGroups['Permissions']['总行审核'];

		//$adminrolearr=$BeijingGroups['Permissions']['客户管理'];

		$salerolearr=$BeijingGroups['Permissions']['客户管理'];

		//$lastrolelarr=$BeijingGroups['Permissions']['财务复核'];

       // $xiadingdanarr=$BeijingGroups['Permissions']['订购产品'];

		if(in_array( $_SESSION["v_username_group"],$salerolearr))

		{

			$status=2;//结束订单

			$yiyourenarr=explode(',',$userinfo['uid_role']);

		 	$yiyourenarr=array_filter($yiyourenarr);	

			$where['v_orders.uid']=array('in',$yiyourenarr);

			//$data['status']=	21;	

		}

$searchcount=$order->field("v_orders.*,v_companies.id as cpid,v_companies.name as cpname,v_users.company as comname,v_users.department as depart,v_users.realname as realname")->join('LEFT JOIN  v_users ON v_users.id = v_orders.uid LEFT JOIN  v_companies ON v_companies.id = v_users.company')->where($where)->count();

		$p = new \Think\Page($searchcount,10);	

		$olist=$order->field("v_orders.*,v_companies.id as cpid,v_companies.name as cpname,v_users.company as comname,v_users.department as depart,v_users.realname as realname")->join('LEFT JOIN  v_users ON v_users.id = v_orders.uid LEFT JOIN  v_companies ON v_companies.id = v_users.company')->limit($p->firstRow,10)->where($where)->order('v_orders.id desc')->select();	

		//echo $order->getLastSql();

		//die();

		 $this->assign('reviewstatus',$reviewstatus);

		 $this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);	

		 $this->assign('order',$olist);

		 $this->assign('page',$p->show());	

		 $this->assign('order',$olist);

		 $this->assign('saleadmingroup',$saleadmingroup);

		 $this->assign('page',$p->show());	

		 $this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);			

		 $this->display();	

	}

	public function o_ck_ending(){		

		$ckorder = M("orders");		

		$review=$_GET['reviewstatus'];	

		$idlist=explode(',',$_GET['id']); 

		$idlist=array_filter($idlist);   

		$where['id'] =array('IN',$idlist);		

		//echo $review;

		//die();

		if($review==1)

		{

			$where['status'] = 1;

			$data['status'] = 2; 

			$data['shenhechg'] = 1;	

			$data['shenheuser'] = $_SESSION['v_uid_session'];

			$data['shenhetime'] = time();

		}

		elseif($review==2)

		{

			$where['status'] = 2;

			$data['status'] = 21;

			$data['shenhechg1'] = 1;	

			$data['shenheuser1'] = $_SESSION['v_uid_session'];

			$data['shenhetime1'] = time();

		}

		$ckends=$ckorder->where($where)->save($data);	

	}

	 public function o_over_see(){

	 header("Content-type:text/html;charset=utf-8");	

		import("ORG.Util.Page"); 	

		$order = M("orders");	

		$ologs = M("orders_logs");

		$oitems = M("orderitems");

		$osendlogs = M("orders_sendlogs");				    

		$oid['v_orders.id'] = $_GET['id'];			

		$seelist=$order->field("v_orders.*,v_companies.id as cpid,v_companies.name as cpname,v_users.company as comname,v_users.department as depart,v_users.realname as realname")->join('LEFT JOIN  v_users ON v_users.id = v_orders.uid LEFT JOIN  v_companies ON v_companies.id = v_users.company')->where($oid)->find();			

		$osid['v_orderitems.oid'] = $oid['v_orders.id'];		

		$ptlist= $oitems->field("v_orderitems.*,v_products.prefix as prefix,v_products.number as number,v_products.name as name,v_products.packing_12,v_products.packing_22,v_products.packing_32")->join('LEFT JOIN v_products ON  v_orderitems.pid = v_products.id')->where($osid)->select();		

		$p=getpage($oitems,$osid,10);		

		$this->assign('orderspct',$ptlist);		

		$this->assign('ordersee',$seelist);

		$this->assign('page',$p->show());	

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);	

	    $this->display();

	 }

	  public function o_over_edit(){

		header("Content-type:text/html;charset=utf-8");	

		import("ORG.Util.Page"); 	

		$order = M("orders");	

		$ologs = M("orders_logs");

		$oitems = M("orderitems");

		$osendlogs = M("orders_sendlogs");				    

		$oid['v_orders.id'] = $_GET['id'];			

		$seelist=$order->field("v_orders.*,v_companies.id as cpid,v_companies.name as cpname,v_users.company as comname,v_users.department as depart,v_users.realname as realname,v_users.tel as adrtel,v_users.sendaddr as sadr")->join('LEFT JOIN  v_users ON v_users.id = v_orders.uid LEFT JOIN  v_companies ON v_companies.id = v_users.company')->where($oid)->find();		

		$osid['v_orderitems.oid'] = $oid['v_orders.id'];		

		$ptlist= $oitems->field("v_orderitems.*,v_products.prefix as prefix,v_products.number as number,v_products.name as name,v_products.packing_12,v_products.packing_21,v_products.limitamount,v_products.packing_22,v_products.packing_31,v_products.packing_32")->join('LEFT JOIN v_products ON  v_orderitems.pid = v_products.id')->where($osid)->select();		

		$p=getpage($oitems,$osid,10);		

		$this->assign('orderspct',$ptlist);		

		$this->assign('ordersee',$seelist);

		$this->assign('page',$p->show());	

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);

	    $this->display();

	  }

	  public function o_status(){			

		$id=$_GET['id'];

		$status=$_GET['type'];		

		$order = M("orders");

		$where['id']=$id;

		$data['status'] = $status; 

		$data = $order->where($where)->save($data);	

		/**$timenow=time();

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

		**/

		}

		public function o_ends(){		

		header("Content-type:text/html;charset=utf-8");		

		import("ORG.Util.Page"); 

		$order = M("orders");	

		$ologs = M("orders_logs");

		$osendlogs = M("orders_sendlogs");		

		$where['v_users.company'] = $_SESSION["v_company_session"];		

		$where['v_orders.status'] = 21;				

		$ordercount=$order->field("v_orders.*,v_companies.id as cpid,v_companies.name as cpname,v_users.company as comname,v_users.department as depart,v_users.realname as realname,v_users.realname as realname")->join('LEFT JOIN  v_users ON v_users.id = v_orders.uid LEFT JOIN  v_companies ON v_companies.id = v_users.company')->where($where)->count();	

	    $p = new \Think\Page($ordercount,20);			

		$datas['company'] = 'company';

		$datas['number'] = 'number';

		$data['shenheuser'] = $_SESSION['v_uid_session'];		

		$olist=$order->field("v_orders.*,v_companies.id as cpid,v_companies.name as cpname,v_users.company as comname,v_users.department as depart,v_users.realname as realname ,overuser.department as shenhedepart,overuser.realname as shenherealname,overuser.group")->join('LEFT JOIN  v_users ON v_users.id = v_orders.uid LEFT JOIN  v_users overuser ON overuser.id = v_orders.shenheuser1 LEFT JOIN v_companies ON v_companies.id = v_users.company')->limit($p->firstRow . ',' . $p->listRows)->where($where)->order('id desc')->select();

		global $BeijingRolesStatus,$BeijingGroups;

		$firstgroup=$BeijingRolesStatus[$_SESSION["v_company_session"]]['group'][81];		

		if(!empty( $_SESSION["v_company_session"]))

		{

			if(isset($BeijingRolesStatus[$_SESSION["v_company_session"]]))

			{				

		 $firstgroup=$BeijingRolesStatus[$_SESSION["v_company_session"]]['group'][81];		

			}

		}		

		//echo $order->getLastSql();

		//die();	

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);			

		$this->assign('order',$olist);

		$this->assign('page',$p->show());	

        $this->display();	

	 }

	  public function o_end_see(){

	 	header("Content-type:text/html;charset=utf-8");	

		import("ORG.Util.Page"); 	

		$order = M("orders");	

		$ologs = M("orders_logs");

		$oitems = M("orderitems");

		$osendlogs = M("orders_sendlogs");				    

		$oid['v_orders.id'] = $_GET['id'];			

		$seelist=$order->field("v_orders.*,v_companies.id as cpid,v_companies.name as cpname,v_users.company as comname,v_users.department as depart,v_users.realname as realname")->join('LEFT JOIN  v_users ON v_users.id = v_orders.uid LEFT JOIN  v_companies ON v_companies.id = v_users.company')->where($oid)->find();			

		$osid['v_orderitems.oid'] = $oid['v_orders.id'];		

		$ptlist= $oitems->field("v_orderitems.*,v_products.prefix as prefix,v_products.number as number,v_products.name as name,v_products.packing_12,v_products.packing_22,v_products.packing_32")->join('LEFT JOIN v_products ON  v_orderitems.pid = v_products.id')->where($osid)->select();		

		$p=getpage($oitems,$osid,10);		

		$this->assign('orderspct',$ptlist);		

		$this->assign('ordersee',$seelist);

		$this->assign('page',$p->show());

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);			

	    $this->display();

	 }

	  public function o_end_edit(){

		header("Content-type:text/html;charset=utf-8");	

		import("ORG.Util.Page"); 	

		$order = M("orders");	

		$ologs = M("orders_logs");

		$oitems = M("orderitems");

		$osendlogs = M("orders_sendlogs");				    

		$oid['v_orders.id'] = $_GET['id'];			

		$seelist=$order->field("v_orders.*,v_companies.id as cpid,v_companies.name as cpname,v_users.company as comname,v_users.department as depart,v_users.realname as realname,v_users.tel as adrtel,v_users.sendaddr as sadr")->join('LEFT JOIN  v_users ON v_users.id = v_orders.uid LEFT JOIN  v_companies ON v_companies.id = v_users.company')->where($oid)->find();		

		$osid['v_orderitems.oid'] = $oid['v_orders.id'];		

		$ptlist= $oitems->field("v_orderitems.*,v_products.prefix as prefix,v_products.number as number,v_products.name as name,v_products.packing_12,v_products.packing_21,v_products.limitamount,v_products.packing_22,v_products.packing_31,v_products.packing_32")->join('LEFT JOIN v_products ON  v_orderitems.pid = v_products.id')->where($osid)->select();		

		$p=getpage($oitems,$osid,10);		

		$this->assign('orderspct',$ptlist);

		$this->assign('ordersee',$seelist);

		$this->assign('page',$p->show());	

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);		

	    $this->display();

	  }

	   public function o_dels(){		

		header("Content-type:text/html;charset=utf-8");		

		import("ORG.Util.Page"); 

		$order = M("orders");	

		$ologs = M("orders_logs");

		$osendlogs = M("orders_sendlogs");				

		$where['v_orders.status'] = 20;	

		$where['v_users.company'] = $_SESSION["v_company_session"];	

		$saleadmingroup=$BeijingRolesStatus['group'][5];	

		if($_SESSION["v_username_group"]==5)

		{

			$where['v_orders.uid']= $_SESSION["v_uid_session"];

		}								

		$searchcount=$order->field("v_orders.*,v_companies.id as cpid,v_companies.name as cpname,v_users.company as comname,v_users.department as depart,v_users.realname as realname,v_users.realname as realname")->join('LEFT JOIN  v_users ON v_users.id = v_orders.uid LEFT JOIN  v_companies ON v_companies.id = v_users.company')->where($where)->count();	

	    $p = new \Think\Page($searchcount,15);		

		$datas['number'] = 'number';

		$data['shenheuser'] = $_SESSION['v_uid_session'];	

		$olist=$order->field("v_orders.*,v_companies.id as cpid,v_companies.name as cpname,v_users.company as comname,v_users.department as depart,v_users.realname as realname,v_users.realname as realname,overuser.department as deldepart,overuser.realname as delrealname,overuser.group as delgroup")->join('LEFT JOIN  v_users ON v_users.id = v_orders.uid LEFT JOIN  v_users overuser ON overuser.id = v_orders.shenheuser LEFT JOIN  v_companies ON v_companies.id = v_users.company')->limit($p->firstRow . ',' . $p->listRows)->where($where)->order('id desc')->select();		

		global $BeijingRolesStatus,$BeijingGroups;			

		if(isset($BeijingRolesStatus[$_SESSION["v_company_session"]]['group']))

		{	

			$grouplist=$BeijingRolesStatus[$_SESSION["v_company_session"]]['group'];

		}else

		{

			$grouplist=$BeijingRolesStatus['group'];

		}

		if(isset($BeijingRolesStatus[$_SESSION["v_company_session"]]['Admingroup']))

		{	

			$admingouplist=$BeijingRolesStatus[$_SESSION["v_company_session"]]['Admingroup'];

		}else

		{

			$admingouplist=$BeijingRolesStatus['Admingroup'];

		}

		$delorderlist=array();

		foreach($olist as $key=>$v)

		{

			$v['userrole']="";

			if(isset($grouplist[$v['delgroup']])){

				$v['userrole']=$grouplist[$v['delgroup']];

			}else if(isset($admingouplist[$v['delgroup']]))

			{

				$v['userrole']=$admingouplist[$v['delgroup']];

			}

			$delorderlist[]=$v;

		}

		$this->assign('order',$delorderlist);

		$this->assign('page',$p->show());

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);	

        $this->display();	

	 }

	 public function o_del_see(){

	 	header("Content-type:text/html;charset=utf-8");	

		import("ORG.Util.Page"); 	

		$order = M("orders");	

		$ologs = M("orders_logs");

		$oitems = M("orderitems");

		$osendlogs = M("orders_sendlogs");				    

		$oid['v_orders.id'] = $_GET['id'];			

		$seelist=$order->field("v_orders.*,v_companies.id as cpid,v_companies.name as cpname,v_users.company as comname,v_users.department as depart,v_users.realname as realname")->join('LEFT JOIN  v_users ON v_users.id = v_orders.uid LEFT JOIN  v_companies ON v_companies.id = v_users.company')->where($oid)->find();		

		$osid['v_orderitems.oid'] = $oid['v_orders.id'];		

		$ptlist= $oitems->field("v_orderitems.*,v_products.prefix as prefix,v_products.number as number,v_products.name as name,v_products.packing_12,v_products.packing_22,v_products.packing_32")->join('LEFT JOIN v_products ON  v_orderitems.pid = v_products.id')->where($osid)->select();		

		$p=getpage($oitems,$osid,10);		

		$this->assign('orderspct',$ptlist);		

		$this->assign('ordersee',$seelist);

		$this->assign('page',$p->show());

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);		

	    $this->display();

	 }

	 	public function o_logs(){

		header("Content-type:text/html;charset=utf-8");

		$orlogs=M("orders_logs");

		//$user=M("users");	   

		import("ORG.Util.Page"); 	

		$where['v_users.company'] = $_SESSION["v_company_session"];	

		//$where['uid'] = $_SESSION["v_uid_session"];	

		$orlogscount=$orlogs->field('v_orders_logs.*')->join(" LEFT join v_users on v_users.id=v_orders_logs.uid ")->order("v_orders_logs.olid desc")->where($where)->count();

		$p = new \Think\Page($orlogscoun,20);			

		$orlogdata=$orlogs->field('v_orders_logs.*')->join(" LEFT join v_users on v_users.id=v_orders_logs.uid ")->order("v_orders_logs.olid desc")->where($where)->limit($p->firstRow . ',' . $p->listRows)->select();

		//var_dump ($orlogdata);

		//die();			

		$this->assign('orlogs_list',$orlogdata);

		$this->assign('page',$p->show());

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);			

        $this->display();

	}

	public function o_serchslist()

	{//获取搜索结果

		global $BeijingRolesStatus,$BeijingGroups,$BeijingStatus;	

		$userwhere=array();

		if(!empty( $_SESSION["v_company_session"]))

		{

			//$cpwhere['id']=$_SESSION["v_company_session"];

			if(isset($BeijingStatus[$_SESSION["v_company_session"]]))

			{

				$orderStatusarr=$BeijingStatus[$_SESSION["v_company_session"]]['orderStatus'];

			}

		}

		else

		{

			$orderStatusarr=$BeijingStatus['orderStatus'];

		} 

		$company				=encodestrall($_GET["company"]);

		$clientuser		=encodestrall($_GET["clientuser"]);//客户筛选条件radio

		$SelectedCuser			=encodestrall($_GET["SelectedCuser"]);

		$orderstatus			=encodestrall($_GET["orderstatus"]);

		$begintime				=encodestrall($_GET["begintime"]);

		$overtime				=encodestrall($_GET["overtime"]);	

		$where['u.company']=$company;

        $userwhere['company']=$company;

		$where['u.deltriger']=0;		

		if($_SESSION["v_username_group"]==5){

			$where['o.uid']= $_SESSION["v_uid_session"];

		}else

		{

			if($clientuser==0){

				$SelectedCuser_Array=str_replace("|",",",$SelectedCuser);

				$where['o.uid']=array('IN',$SelectedCuser_Array);	

				}

			}

	if($orderstatus){

	$status_sql		=intval($orderstatus);

	$where['o.status']=$status_sql;

	}

	if(!empty($begintime) && !empty($overtime)){

		$begintime2		=strtotime($begintime);	

		$overtime2		=strtotime($overtime);	

		$where['o.starttime'] = array(array('egt',$begintime2),array('elt',$overtime2), 'and') ;

	}

	elseif(!empty($begintime) && empty($overtime)){		

		$begintime2		=strtotime($begintime);		

		$where['o.starttime'] = array('egt',$begintime2);

	}

	elseif(empty($begintime) && !empty($overtime)){		

		$overtime2		=strtotime($overtime);				

		$where['o.starttime'] = array('elt',$overtime2);

	}

	import('ORG.Util.Page');				

	$orders=M('orders');		

	$listseach=array();

	$searchcount=$orders->field("o.id")->join("o LEFT JOIN v_users u ON u.id=o.uid")->where($where)->count();

	$p = new \Think\Page($searchcount,20);

	$userwhere['deltriger']=0;

	$users=M("users");

		$userwhere['group']=81;

		$userfirstinfo=$users->where($userwhere)->select();		

		$userwhere['group']=82;	

		$userlastinfo=$users->where($userwhere)->select();	

	//$searchlist=$orders->field("o.id, o.number,o.recipients, o.starttime,o.status,o.shenheuser,o.shenhetime,o.allprice,u.department,u.realname,c.name ")->join(" o LEFT JOIN v_users u ON u.id = o.uid LEFT JOIN v_companies c ON u.company = c.id")->where($where)->order("o.id desc")->limit($p->firstRow . ',' . $p->listRows)->select();	

	$searchlist=$orders->field("o.*,v_companies.id as cpid,v_companies.name as name,u.company as comname,u.department ,u.realname")->join(' o LEFT JOIN  v_users u ON u.id = o.uid LEFT JOIN  v_companies ON v_companies.id = u.company')->limit($p->firstRow . ',' . $p->listRows)->where($where)->order('o.id desc')->select();

	$listseach=array();

	foreach($searchlist as $key=>$val){

		$val['firstshenhe']='未审核';

			$val['laseshenhe']='未审核';

			if(!empty($val['shenheuser']))

			{

				foreach($userfirstinfo as $k=>$v)

				{

					if($val['shenheuser']==$v['id']){

						$val['firstshenhe']=$firstgroup." ".$v['realname']."";

					break;

					}

				}

			}

			if(!empty($val['shenheuser1']))

			{

				foreach($userlastinfo as $k=>$v)

				{

					if($val['shenheuser1']==$v['id']){

						$val['laseshenhe']=$saleadmingroup.$v['realname'];

					break;

					}

				}

			}

		$val['orderstatus']=$orderStatusarr[$val['status']];

		$listseach[]=$val;	

	}

		$this->assign('search_page',$p->show());	

    	$this->assign('search_list',$listseach);

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);	

		$this->display();

	}

	public function o_serchs()

	{

		global $BeijingStatus;	

		if(isset($BeijingStatus[$company]))

		{

			$arr=$BeijingStatus[$company]['orderStatus'];

		}

		else

		{

			$arr=$BeijingStatus['orderStatus'];

		} 

		$company = M("companies");

		$zhihangstatic=0;

		if(!empty( $_SESSION["v_company_session"]))

		{			

			$cpwhere['id'] = $_SESSION["v_company_session"];

		}

		if($_SESSION["v_username_group"]==5){

		$zhihangstatic=1;

		}

		$cpwhere['deltriger']= 0;	

		$cplist=$company->where($cpwhere)->select();

		$this->assign('zhihangstatic',$zhihangstatic);

		$this->assign('orderstatus',$arr);

		$this->assign('cplist',$cplist);

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);

		$this->display();

		}

	//加入订单 

	public function neworder()

	{

		header("Content-type:text/html;charset=utf-8");

		$rename=encodestrall($_POST['realname']);

		$adrtel=encodestrall($_POST['adrtel']);

		$sadr=encodestrall($_POST['sadr']);

		$notes=encodestrall($_POST['notes']);		

		$companies=M('companies');

		$s['id']=$_SESSION["v_company_session"];

		$Mrecord_Com=$companies->field("ordertype")->where($s)->find();		

		$users=M('users');

		$u['id']=$_SESSION["v_uid_session"];

		$u['group']=5;

		$u['deltriger']=0;

		$sRecord_locktime=$users->where($u)->find();

		$orderform_locktime_str="";	

		if(!empty( $_SESSION["v_company_session"]))

		{			

			$where['v_companies.id'] = $_SESSION["v_company_session"];

		}			

		if($sRecord_locktime['orderdeny']==1)

		{

			$timenow		=time();

			$begintime		=getunix($sRecord_locktime['orderbegin']);

			$overtime		=getunix($sRecord_locktime['orderover'])+24*60*60;			

			if(($timenow<$begintime)||($timenow>$overtime))

			{			

				$EchoStr.="<script language=javascript>alert('抱歉：\\n您已经被锁定订货时间：".$sRecord_locktime['orderbegin']." 至 ".$sRecord_locktime['orderover']."。\\n现在不能提交订单，请联系您的管理员申请临时开放订货权限。')";

				$EchoStr.="window.location.href='o_showorderitem'</script>";

				echo $EchoStr;				

				exit();

			}

		}		

		$orderitems=M('orderitems');

		$owhere['uid']=$_SESSION["v_uid_session"];

		$owhere['oid']=0;		

		$sRecord_OT=$orderitems->where($owhere)->find();			

	if($sRecord_OT['id'])

	{		

		$orders=M('orders');

		$sRecord_Max=$orders->field("MAX(number) AS maxnumber")->find();		

		$number = intval($sRecord_Max['maxnumber']) + mt_rand( 1, 200 );		

		if(!empty($rename)||!empty($adrtel))

		{			

			$rename=$rename?$rename:$sRecord_locktime['realname'];

			$adrtel=$adrtel?$adrtel:$sRecord_locktime['tel'];

		}		

		$timenow=time();

		$ipnow=$_SERVER['REMOTE_ADDR'];

		$orderdata['number']=$number;

		$orderdata['uid']=$_SESSION["v_uid_session"];

		$orderdata['starttime']=$timenow;

		$orderdata['status']=1;

		$orderdata['recipients']=$rename;

		$orderdata['sendaddr']=$sadr;

		$orderdata['tel']=$adrtel;

		$orderdata['notes']=$notes;

		$oid=$orders->add($orderdata);		

		if($oid)

		{			

			$odata['oid']=$oid;		

			$sRecord_OT=$orderitems->where($owhere)->save($odata);

			$oitemwhere['ot.oid']=$oid;

			//减少库存 BEGIN

			$arrlist=$orderitems->field("ot.id, ot.pid,ot.amount,p.amount as pamount,p.name,p.prefix,p.number,p.company ")->join("ot LEFT JOIN v_products p ON p.id = ot.pid")->where($oitemwhere)->order("ot.id asc")->select();			

			foreach($arrlist as $key=>$val){

			$id=$val["id"];

			$pid=$val["pid"];

			$amount=$val["amount"];

			$nametmp=$val["name"];

			$prefixtmp=$val["prefix"];

			$numbertmp=$val["number"];

			$companytmp=$val["company"];

			$pamount=$val["pamount"];

			//仓储式

			if($Mrecord_Com['ordertype'])

			{

				$amount=$amount>$pamount?$pamount:$amount;

				$price=$sRecord_P['price'] * $amount;

				$oitemwhere=array();

				$oitemwhere['id']=$id;

				$odata=array();

				$odata['amount']=$amount;

				$odata['price']=$price;

				$orderitems->where($oitemwhere)->save($odata);					

			}

			$products=M('products');

			$pwhere['id']=$pid;

			//$pdata=array();

			//$pdata['amount']="amount-".$amount;

			$products->where($pwhere)->setDec("amount",$amount);//减少库存

			//记录产品日志

			$products_logs=M('products_logs');				

			$pdata=array();

			$pdata['pid']=$pid;

			$pdata['chgnum_type']='-';

			$pdata['chgnum_nums']=$amount;

			$pdata['uid']=$_SESSION["v_uid_session"];

			$pdata['ugroup']=5;

			$pdata['ucompany']=$companytmp;

			$pdata['atype']='order_cut';

			$pdata['oid']=$oid;

			$pdata['number']=$number;

			$pdata['notes']="产品 ".$nametmp."[".$prefixtmp."-".$numbertmp."] 订单 #".$number." 订货 ".$amount."";

			$pdata['utime']=$timenow;

			$pdata['ipadd']=$ipnow;

			$products_logs->add($pdata);

			}

			//减少库存 OVER				

			$log = M("adminlog");

			$adminlog['uid']=$_SESSION["v_uid_session"];

			$adminlog['notes']="添加订单 [#".$number."] ";

			$adminlog['utime']=$timenow;

			$adminlog['ipadd']=$ipnow;

			$log->data($adminlog)->add();			

			$EchoStr.="<script language=javascript>alert('操作已成功\\n订单 # ".$number." 添加成功，请等待我们的通知或者随时关注订单状态。');";

			$EchoStr.="window.location.href='index'</script>";

			echo $EchoStr;

		}

		else

		{

			$EchoStr.="<script language=javascript>alert('操作失败，请重试，再次失败请联系我们的管理员。')";

			$EchoStr.="window.location.href='o_showorderitem'</script>";;

			echo $EchoStr;

		}

	}		

}

	//显示添加产品列表

	public function o_showorderitem()

	{

		$users=M("users");

		$orderitems=M("orderitems");

		$orderform_locktime_str="";

		// id='".$_SESSION['v_uid_session']."' and `group`='5' and deltriger='0

		$uwhere['id']=$_SESSION["v_uid_session"];

		$uwhere['group']=5;

		$uwhere['deltriger']=0;

		$userinfo=$users->where($uwhere)->find();

		if($userinfo['orderdeny']==1)

		{

			$orderform_locktime_str="<font color=red><b>提醒：您已经被锁定订货时间：".$userinfo['orderbegin']." 至 ".$userinfo['orderover']."</b></font>";

		}	

		$owhere['o.oid']=0;

		$owhere['o.uid']=$_SESSION["v_uid_session"];

		$orderlist=$orderitems->field("o.id, o.amount, o.default, p.id as pid,p.amount as pamount,p.name, p.prefix,p.number, p.packing_12,p.packing_21, p.packing_22, p.packing_31, p.packing_32,p.limitamount")->join(" o LEFT JOIN v_products p ON o.pid = p.id")->where($owhere)->order("o.id ASC")->select();

		$arr=array();

		foreach($orderlist as $key=>$v){

		$id=$v["id"];

		$amount=$v["amount"];

		$default=$v["default"];

		$pid=$v["pid"];

		$name=$v["name"];

		$prefix=$v["prefix"];

		$number=$v["number"];

		$pamount=$v["pamount"];

		$packing_12=$v["packing_12"];

		$packing_21=$v["packing_21"];

		$packing_22=$v["packing_22"];

		$packing_31=$v["packing_31"];

		$packing_32=$v["packing_32"];

		$limitamount=$v["limitamount"];

		$baozhuangguige="1".$packing_12;

		$baozhuangguige.=($packing_21&&$packing_22)?" × ".$packing_21.$packing_22:"";

		$baozhuangguige.=($packing_31&&$packing_32)?" × ".$packing_31.$packing_32:"";		

		$default = 'packing_'.$default.'2';

		$unit=$$default;

		$limitamount_echo=$limitamount>0?$limitamount:"";

		$v['baozhuangguige']=$baozhuangguige;

		$v['default_edit']=$default;

		$v['unit']=$unit;

		$v['limitamount_echo']=$limitamount_echo;

		$v['pnum']=$prefix."-".$number;

		$arr[]=$v;

		}		

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);

		$this->assign('orderform_locktime',$orderform_locktime_str);

		$this->assign('oritemarr',$arr);		

		$this->assign('total',count($arr));

		$this->assign('userinfo',$userinfo);

		$this->display();

	}

	//删除orderitem

	public function oitem_del()

	{

		$id=$_POST['id'];

		$orderitems=M("orderitems");

		$where['id']=$id;

		$where['uid']=$_SESSION["v_uid_session"];		

		$orderitems->where($where)->delete();

		echo "删除成功";

		$this->assign('oitems',$deloitems);

		$this->display();

	}

	//添加订购产品

	public function o_ordernew_confirm()

	{	

		$products=M("products");

		$orderitems=M("orderitems");

		$id			=($_POST["id"]);

		$amount_kc	=($_POST["amount_kc"]);

		$amount		=($_POST["amount"]);

		$pwhere['available']=1;

		$pwhere['deltriger']=0;

		$insertdata=array();

		for($i=0;$i<count($id);$i++)

		{

			$amount[$i]=intval($amount[$i]);		

			if(( preg_match( '%^[1-9]\d*$%', $amount[$i] ) ))

			{

				$pwhere['id']=encodestrall($id[$i]);

				$sRecord_P=$products->where($pwhere)->find();		

				if($sRecord_P['id'])

				{		

					$owhere['pid']=$sRecord_P['id'];

					$owhere['uid']=$_SESSION["v_uid_session"];

					$owhere['oid']=0;

					$owhere['default']=$sRecord_P['default'];				

					$sRecord_OT=$orderitems->where($owhere)->find();					

					if($sRecord_OT['id'])

					{

						$amount_s=$amount[$i]+$sRecord_OT['amount'];

						if(($sRecord_P['limitamount']>0)&&($amount_s>$sRecord_P['limitamount']))

						{

							$limit=true;

							break;

						}

						//仓储式

						if($Mrecord_Com['ordertype']) $amount_s=$amount_s>$amount_kc[$i]?$amount_kc[$i]:$amount_s;						

						if($sRecord_OT['pid']=$sRecord_P['id'])						

						{										    

					     		$price=$sRecord_P['price'] * $amount_s;

								$upwhere['id']=$sRecord_OT['id'];

								$data['amount']=$amount_s;

								$data['price']=$price;						

								$orderitems->where($upwhere)->save($data);								

								 }else{

									 break;

									}								

					}

					else

					{

						$amount_s=$amount[$i];

						if(($sRecord_P['limitamount']>0)&&($amount_s>$sRecord_P['limitamount']))

						{							

							$limit=true;

							break;

						}

						//仓储式

						if($Mrecord_Com['ordertype']) $amount_s=$amount_s>$amount_kc[$i]?$amount_kc[$i]:$amount_s;

						$price=$sRecord_P['price'] * $amount_s;

						$data=array();

						$data['pid']=$sRecord_P['id'];

						$data['uid']=$_SESSION["v_uid_session"];

						$data['oid']=0;

						$data['default']=$sRecord_P['default'];

						$data['amount']=$amount_s;

						$data['price']=$price;

						$insertdata[]=$data;

					}

				}

			}

		}		

		if(count($insertdata)>0)

		{

			$orderitems->addAll($insertdata);

		}

		echo "<script>window.location.href='o_showorderitem'</script>";

	}

	//验证产品是否存在

	public function o_ordernew_check(){		

	   $products=M("products");

       $orderitems=M("orderitems");

       $idlist=explode(',',$_GET['idlist']); 

        array_filter($idlist);   

		$owhere['pid'] =array('IN',$idlist);			

		$owhere['uid']=$_SESSION["v_uid_session"];

        //$owhere['oid']=0;

        $sRecord_OT=$orderitems->where($owhere)->count();	

        if($sRecord_OT>0)	{			

		     echo "1";

		}else{

		     echo"0";

		}	}

	//订购产品

	public function o_ordernew(){

		header("Content-type:text/html;charset=utf-8");	

		global $BeijingGroups,$LandnowCom; 

		$rolelarr=$BeijingGroups['Permissions']['订购产品'];

	//权限过滤

		if(in_array($_SESSION["v_username_group"],$rolelarr))

		{	

			$users=M('users');

			$uid['id']= $_SESSION["v_uid_session"];

			/**

			$data['orderdeny']='1';

			$data['orderbegin']=$begintime;

			$data['orderover']=$overtime;

			*/

			$userfind=$users->field("orderdeny,orderbegin,orderover")->where($uid)->find();

			if($userfind['orderdeny']==1)

			{

				$orderform_locktime_str="<td colspan=\"2\"><font color=red><b>提醒：您已经被锁定订货时间：".$userfind['orderbegin']." 至 ".$userfind['orderover']."</b></font></td>";

			}		

			$comid=$LandnowCom;

			$company = M("companies");

			$cowhere['id']=$comid;

			$Mrecord_Com=$company->field("ordertype")->where($cowhere)->find();

			//	$SQL="Select ordertype from jbl_companies where id='".$_SESSION["jbl_company_session"]."'";

		//$Mrecord_Com=@mysql_fetch_array(@mysql_query($SQL));

			$ptype = M("productstype");			

			$cmpy['company']= $comid;

			$lists = $ptype->where($cmpy)->select();

			$product = M("products");	

			$where['p.deltriger'] = 0;

			$where['p.company'] = $comid;

			$where['p.available'] = 1;

			if(!empty($_GET['skey']))

			{

				$skey=$_GET['skey'];

				$this->assign('skey',$skey );

				$where['p.name | p.number']=array("like","%".$skey."%");

				//$where['p.number']=array("like","%".$skey."%");

				}

			if(!empty($_GET['ptid']))

			{

				$ptid=$_GET['ptid'];

				$this->assign('ptid',$ptid );

				$where['p.ptid'] = $_GET['ptid'];

				}

			$plist=$product->field("p.*,pt.ptname")->join(' p LEFT JOIN v_productstype pt ON pt.ptid = p.ptid')->where($where )->order(array('p.sort'=>'asc','p.number'=>'asc'))->select();	

			$productarr=array();

			foreach($plist as $key=>$val){

			$id=$val["id"];

			$name=$val["name"];

			$prefix=$val["prefix"];

			$number=$val["number"];

			$patternurlurl=$val["patternurlurl"];

			$packing_12=$val["packing_12"];

			$packing_21=$val["packing_21"];

			$packing_22=$val["packing_22"];

			$packing_31=$val["packing_31"];

			$packing_32=$val["packing_32"];

			$default=$val["default"];

			$amount=$val["amount"];

			$limitamount=$val["limitamount"];

			$sort=$val["sort"];

			$ptname=$val["ptname"];	

			$default = 'packing_'.$default.'2';

			$unit=$$default;	

			$baozhuangguige="1".$packing_12;

			$baozhuangguige.=($packing_21&&$packing_22)?" × ".$packing_21.$packing_22:"";

			$baozhuangguige.=($packing_31&&$packing_32)?" × ".$packing_31.$packing_32:"";	

			$iszero=(($Mrecord_Com['ordertype'])&&($amount<=0))?1:0;

			$amount_font=($amount<=0)?" style='color:red;'":"";

			$limitamount_echo=$limitamount>0?$limitamount:"";

			$one=array();

			$one['id']=$id;

			$one['patternurlurl']=$patternurlurl;

			$one['pnum']=$prefix."-".$number;

			$one['name']=$name;

			$one['ptname']=$ptname;

			$one['amount']=$amount;

			$one['aunt']=$amount.$unit;

			$one['limiamount']=$limitamount_echo;

			$one['sort']=$sort;

			$one['unit']=$unit;

			$one['iszero']=$iszero;

			$one['baozhuangguige']=$baozhuangguige;

			$productarr[]=$one;

			}			

			$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);

			$this->assign('lists',$lists );

			$this->assign('ordertype',$Mrecord_Com['ordertype'] );

			$this->assign('orderform_locktime_str',$orderform_locktime_str);

			$this->assign('plist',$productarr );

			$this->display();

		}else

		{

			echo "无权限";

		}

	}

	//锁定订货时间

	public function o_checktime()

	{

		header("Content-type:text/html;charset=utf-8");	

		global $BeijingGroups,$LandnowCom; 

		$rolelarr=$BeijingGroups['Permissions']['锁定订货时间'];

		//$role=explode(',',$rolelarr);

		$comid=$LandnowCom;		

		$company = M("companies"); 

		$cpwhere['deltriger']= 0;

		//企业过滤

		if(!empty( $_SESSION["v_company_session"]))

		{

			$cpwhere['id']=$_SESSION["v_company_session"];

		}

		//权限过滤

		if(in_array($_SESSION["v_username_group"],$rolelarr))

		{			

		 $cplist=$company->where($cpwhere)->select();

		//$nowTime

		 $this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);

		 $this->assign('nowTime',time());	

		 $this->assign('cplist',$cplist);	

		 $this->display();

		 }else

		{

			echo "无权限";

		}

	}

	//提交锁定订货时间

	public function setlocktime()

	{

		header("Content-type:text/html;charset=utf-8");	

		if(!empty($_GET["uid"]))

		{

			$where['id']=$_GET["uid"];

		}

		else

		{		

			$company		 =encodestrall($_GET["company"]);

			$clientuser		 =encodestrall($_GET["clientuser"]);//客户筛选条件radi		

			$SelectedCuser	 =encodestrall($_GET["SelectedCuser"]);

			if(!empty( $_SESSION["v_company_session"]))

			{

				$where['company']=$_SESSION["v_company_session"];

			}else{

			$where['company']=$company;

			}

			if($clientuser==0){

				$SelectedCuser_Array=str_replace("|",",",$SelectedCuser);

				$where['id']=array('IN',$SelectedCuser_Array);			

			}

		}

		    $timetiger		 =encodestrall($_REQUEST["timetiger"]);		

		    $begintime		 =encodestrall($_GET["begintime"]);

		    $overtime		 =encodestrall($_GET["overtime"]);	

		if($timetiger==1){

			$data['orderdeny']='1';

			$data['orderbegin']=$begintime;

			$data['orderover']=$overtime;			

		}

		else

		{

			$data['orderdeny']='0';

			$data['orderbegin']='';

			$data['orderover']='';			

		}

		$users=M('users');

		$cplist=$users->where($where)->save($data);		

		$timenow=time();

    	$ipnow=$_SERVER['REMOTE_ADDR'];

		$log = M("adminlog");

		$adminlog['uid']=$_SESSION["v_uid_session"];

		$adminlog['notes']="批量锁定订货时间";

		$adminlog['utime']=$timenow;

		$adminlog['ipadd']=$ipnow;

		$log->data($adminlog)->add(); 		

		echo "<script>alert('恭喜\\n批量锁定订货时间成功');window.location.href='showlocktime?company=".$company."&selclientuser=1'</script>";

	}

	public function showlocktime()

	{

			$companyid				=encodestrall($_GET["company"]);

			$clientuser		=encodestrall($_GET["selclientuser"]);//客户筛选条件radi		

			$SelectedCuser			=encodestrall($_GET["selSelectedCuser"]);

			$where['company']=$companyid;

			if($clientuser==0){

				$SelectedCuser_Array=str_replace("|",",",$SelectedCuser);

				$where['id']=array('IN',$SelectedCuser_Array);

			}

			import("ORG.Util.Page"); 

			$company = M("companies");

			$cowhere['id']=$companyid;

			$comname=$company->field("name")->where($cowhere)->find();

			$where['deltriger'] =0;	

			$where['group']=5;

			$users=M('users');

			$p=getpage($users,$where,20);			

			$userslist=$users->where($where)->order("company desc,id desc")->select();

			$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);		    	

			$this->assign('userslist',$userslist);

			$this->assign('comname',$comname);

			$this->assign('page',$p->show());

			$this->assign('nowTime',time());

			$this->display();			

		}

		public function changelocktime()

		{

			$id=$_POST["uid"];

			$rname					=encodestrall($_POST["rname"]);

			$timetiger				=encodestrall($_POST["timetiger"]);		

			$begintime				=encodestrall($_POST["begintime"]);

			$overtime				=encodestrall($_POST["overtime"]);

			$where['id']=$id;	

			$timenow=time();

			$ipnow=$_SERVER['REMOTE_ADDR'];

			if($timetiger==1){

				$data['orderdeny']='1';

				$data['orderbegin']=$begintime;

				$data['orderover']=$overtime;	

				$logtype="锁定在 ".$begintime." 至 ".$overtime;		

			}

			else

			{

				$data['orderdeny']='0';

				$data['orderbegin']='';

				$data['orderover']='';	

				$logtype="取消锁定";		

			}

			$users=M('users');

			$cplist=$users->where($where)->save($data);			

			$log = M("adminlog");

			$adminlog['uid']=$_SESSION["v_uid_session"];

			$adminlog['notes']="修改客户 ".$rname." 订货时间 ".$logtype;

			$adminlog['utime']=$timenow;

			$adminlog['ipadd']=$ipnow;

			$log->data($adminlog)->add(); 

			echo "恭喜\\n修改客户 ".$rname." 订货时间 ".$logtype;

		}	

		public function o_orderall()

		{

			header("Content-type:text/html;charset=utf-8");		

		import("ORG.Util.Page"); 

		$order = M("orders");	

		$ologs = M("orders_logs");

		$osendlogs = M("orders_sendlogs");		

		$where['v_users.company'] = $_SESSION["v_company_session"];		

		$ordercount=$order->field("v_orders.*,v_companies.id as cpid,v_companies.name as cpname,v_users.company as comname,v_users.department as depart,v_users.realname as realname,v_users.realname as realname")->join('LEFT JOIN  v_users ON v_users.id = v_orders.uid LEFT JOIN  v_companies ON v_companies.id = v_users.company')->where($where)->count();	

	    $p = new \Think\Page($ordercount,20);			

		$datas['company'] = 'company';

		$datas['number'] = 'number';

		$data['shenheuser'] = $_SESSION['v_uid_session'];		

		if($_SESSION["v_username_group"]==5)

		{

			$where['v_orders.uid']= $_SESSION["v_uid_session"];

		}	

		$olist=$order->field("v_orders.*,v_companies.id as cpid,v_companies.name as cpname,v_users.company as comname,v_users.department as depart,v_users.realname as realname ,overuser.department as shenhedepart,overuser.realname as shenherealname,overuser.group")->join('LEFT JOIN  v_users ON v_users.id = v_orders.uid LEFT JOIN  v_users overuser ON overuser.id = v_orders.shenheuser1 LEFT JOIN v_companies ON v_companies.id = v_users.company')->limit($p->firstRow . ',' . $p->listRows)->where($where)->order('id desc')->select();

		global $BeijingRolesStatus,$BeijingGroups;

		$saleadmingroup=$BeijingRolesStatus['group'][15];	

		if(!empty( $_SESSION["v_company_session"]))

		{

			if(isset($BeijingRolesStatus[$_SESSION["v_company_session"]]))

			{	

				$saleadmingroup=$BeijingRolesStatus[$_SESSION["v_company_session"]]['group'][15];

			}

		}

		//echo $order->getLastSql();

		//die();	

		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);			

		$this->assign('order',$olist);

		$this->assign('saleadmingroup',$saleadmingroup);

		$this->assign('page',$p->show());	

        $this->display();	

		}

}