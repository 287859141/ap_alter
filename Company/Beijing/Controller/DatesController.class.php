<?php
namespace Beijing\Controller;
use Think\Controller;
class DatesController extends Controller {
    public function index(){
		$company = M("companies"); 
		$where['deltriger']= 0;	
		if(!empty($_SESSION["v_company_session"])){
	   $where['id'] = $_SESSION["v_company_session"];
    	}
		$zhihangstatic=0;
		$groups=$_SESSION["v_username_group"];
		if($_SESSION["v_username_group"]==5){
			$zhihangstatic=1;
		}
		$cplist=$company->where($where)->select();
		$this->assign('zhihangstatic',$zhihangstatic);
		$this->assign('cplist',$cplist);
		$this->assign('groups',$groups);
		$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);	
        $this->display();
    }	  
    public function d_chart(){
    	$company = M("companies"); 
    	$where['deltriger']= 0;	
    	if(!empty($_SESSION["v_company_session"])){
	   $where['id'] = $_SESSION["v_company_session"];
    	}
		$zhihangstatic=0;
		$groups=$_SESSION["v_username_group"];
		if($_SESSION["v_username_group"]==5){
			$zhihangstatic=1;
		}
		$cplist=$company->where($where)->select();
		$this->assign('cplist',$cplist);
		$this->assign('groups',$groups);
    	$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);	
    	$this->display();
    }
	public function importexcel()	{		  
    header("Content-type:text/html;charset=utf-8");
        $data = array();
		global $BeijingStatus;	
		$order_items=M('orderitems');	
		$company			=encodestrall($_POST["company"]);
		$clientuser		    =encodestrall($_POST["SelectedCuser_all"]);//客户筛选条件radio
		$SelectedCuser		=encodestrall($_POST["SelectedCuser"]);
		$clientproduct	    =encodestrall($_POST["SelectedProduct_all"]);//产品筛选条件radio
		$SelectedProc		=encodestrall($_POST["SelectedProc"]);
		$clientorder		=encodestrall($_POST["Selectedstatus_all"]);//订单筛选条件radio
		$Selectedstatus		=encodestrall($_POST["Selectedstatus"]);	
		$begintime			=encodestrall($_POST["begintime"]);
		$overtime			=encodestrall($_POST["overtime"]);
		$status				=encodestrall($_POST["orderstatus"]);	
	    $submit				=encodestrall($_REQUEST["submit"]);
	    $byzhihang			=encodestrall($_REQUEST["byzhihang"]);
	    $bychanpin			=encodestrall($_REQUEST["bychanpin"]);
	$where['p.company']=$company;
	$where['u.deltriger']=0;
	if(isset($BeijingStatus[$company]))
		{
			$arr=$BeijingStatus[$company]['orderStatus'];
		}
		else
		{
			$arr=$BeijingStatus['orderStatus'];
		}	 
		if($_SESSION["v_username_group"]==5){
			$where['oi.uid']= $_SESSION["v_uid_session"];
		}else{
				if($clientuser==0){			
				$SelectedCuser_Array=str_replace("|",",",$SelectedCuser);
				$where['oi.uid']=array('IN',$SelectedCuser_Array);			
				}
	}	
	if($clientproduct==0){
		$SelectedPro_array=str_replace("|",",",$SelectedProc);
		$where['oi.pid']=array('IN',$SelectedPro_array);
	}	
	if($clientorder==0){
	$Selectedstatus_Array=str_replace("|",",",$Selectedstatus);	
	$where['o.status']=array('IN',$Selectedstatus_Array );
	}else{		
	$orderstatus = array();
	foreach($arr as $key=>$v)
	{
		$orderstatus[]=$key;	
	}
		//$likec.=" and ( o.status IN (1,5,6,7,21,20) )"; 		//显示已删除	
		$where['o.status']=array('IN',implode(',',$orderstatus));
	}
	//echo $begintime;
	//die();
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
	$status	;
	$orderbystr=" o.starttime ASC";
	if($status=="3") $orderbystr="oi.pid ASC";
	if($status=="2") $orderbystr="oi.uid ASC";
	$listseach=array();
	//echo $order_items->getLastSql();
    // die();  
	if(!empty( $submit)){
	header("Content-type:text/html;charset=utf-8");
	$searchlist=$order_items->field("oi.amount,oi.price as allprice,o.number as ordernum,o.starttime,o.id as oid,o.status,u.department,u.realname,u.tel,u.sendaddr,p.id as pid,p.prefix,p.number,p.name,p.packing_12,p.packing_21,p.packing_22,p.packing_31,p.packing_32,p.price,p.default")->join("  oi LEFT JOIN v_orders o ON o.id=oi.oid LEFT JOIN v_users u ON u.id=oi.uid LEFT JOIN v_products p ON p.id=oi.pid ")->where($where)->order($orderbystr)->select();
	foreach($searchlist as $key=>$v){
		$starttime=$v["starttime"];
		$packing_12=$v["packing_12"];
		$packing_21=$v["packing_21"];
		$packing_22=$v["packing_22"];
		$packing_31=$v["packing_31"];
		$packing_32=$v["packing_32"];
		$default=$v["default"];	
	    $baozhuang="1".$packing_12." × ".$packing_21.$packing_22;
	    $baozhuang=(($packing_31)&&($packing_32))?$baozhuang." × ".$packing_31.$packing_32:$baozhuang;
		$v['baozhuang']=$baozhuang;	
		$danwei="packing_".$default."2";
		$danwei=$$danwei;
		$v['danwei']=$danwei;
		$starttime=($starttime)?date("Y-m-d H:i",$starttime):"";
		$data[$key][starttime] = $starttime;
		$data[$key][ordernum] =$v['ordernum'];
		$data[$key][status] =$arr[$v['status']];
		$data[$key][prornum] =$v['prefix'].'-'.$v['number'];
		$data[$key][name] =decode_editor($v['name']);
		$data[$key][baozhuang]  =$v['baozhuang'];
		$data[$key][danwei]  =$v['danwei'];
		$data[$key][price]  = $v['price'];
		$data[$key][amount] = $v['amount'];
		$data[$key][allprice] =$v['allprice'];
		$data[$key][department] =$v['department'];
		$data[$key][realname] =$v['realname'];
		$data[$key][tel] =$v['tel'];
		$data[$key][sendaddr] =$v['sendaddr'];
	}   
        foreach ($data as $field=>$v){
            if($field == 'starttime'){
                $headArr[0]='订单提交时间';
            }
            if($field == 'ordernum'){
                $headArr[1]='订单号';
            }
            if($field == 'status'){
                $headArr[2]='状态';
            }
            if($field == 'prornum'){
                $headArr[3]='产品编号';
            }
            if($field == 'name'){
                $headArr[4]='产品名称';
            }
            if($field == 'baozhuang'){
                $headArr[5]='包装规格';
            }
            if($field == 'danwei'){
                $headArr[6]='单位';
            }
            if($field == 'price'){
                $headArr[7]='单价';
            }
            if($field == 'amount'){
                $headArr[8]='订购数量';
            }
			if($field == 'allprice'){
                $headArr[9]='合计金额';
            }
			if($field == 'department'){
                $headArr[10]='订货部门';
            }
			if($field == 'department'){
                $headArr[11]='联系人';
            }
			if($field == 'department'){
                $headArr[12]='联系电话';
            }
			if($field == 'department'){
                $headArr[13]='通讯地址';
            }
        }	
        $filename="date_excel";		
	}else if(!empty($byzhihang))
	{
		header("Content-type:text/html;charset=utf-8");
		if($clientorder==0){
			$Selectedstatus_Array=str_replace("|",",",$Selectedstatus);	
			$where['o.status']=array('IN',$Selectedstatus_Array );
			}else{		
			$orderstatus = array();
			foreach($arr as $key=>$v)
			{
				$orderstatus[]=$key;	
			}
				//$likec.=" and ( o.status IN (1,5,6,7,21,20) )"; 		//显示已删除	
				$where['o.status']=array('IN',implode(',',$orderstatus));
			}
		$companyquery = M("companies");
		if(!empty( $_SESSION["v_company_session"]))
		{			
			$cmpwhere['id'] = $_SESSION["v_company_session"];
		}	
		$cplist=$companyquery->where($cmpwhere)->find();	
		$searchlist=$order_items->field("SUM(oi.amount) as amount,SUM(oi.price) as allprice,u.department,u.username,u.realname,u.tel,u.sendaddr")->join("  oi LEFT JOIN v_orders o ON o.id=oi.oid LEFT JOIN v_users u ON u.id=oi.uid LEFT JOIN v_products p ON p.id=oi.pid ")->where($where)->order($orderbystr)->group("oi.uid")->select();
		$switchtime=date("Y-m-d H:i",time());
		$data[0][title] ="产品所属";
		$data[0][cmname] =$cplist['name'];//
		$data[1][title] ="查询时间";	
        $data[1][switchtime] =$switchtime;							
		$data[2][title] ="数据开始时间";
		$begintime2=date("Y-m-d h:i");
		$overtime2=date("Y-m-d h:i");
		if(!empty($begintime))
		{
			$begintime2		=$begintime;	
		}	
		if(!empty($overtime))
		{
			$overtime2		=$overtime;	
		}
        $data[2][switchtime] =$begintime2."至".$overtime2+1;
		$tatol=count($searchlist);	
		$data[3][department] ="订货部门";	
		$data[3][username] ="账号";	
		$data[3][amount] ="订购数量";	
		$data[3][allprice] ="金额合计";
		$data[3][realname] ="联系人";
		$data[3][tel] ="联系电话";
		$data[3][sendaddr] ="通讯地址";
		$amount_heji=0;	
		$allprice_heji=0;						
		foreach($searchlist as $key=>$v){
		 $data[$key+4][department] =$v['department'];
		 $data[$key+4][username] =" ".$v['username'];		
		 $data[$key+4][amount] =$v['amount'];
		 $data[$key+4][allprice] =$v['allprice'];
		 $data[$key+4][realname] =" ".$v['realname'];
		 $data[$key+4][tel] =" ".$v['tel'];
		 $data[$key+4][sendaddr] =" ".$v['sendaddr'];
		 $amount_heji+=$v['amount'];
		 $allprice_heji+=$v['allprice'];	
		}
		 $data[$tatol+4][department] ="合计";
		 $data[$tatol+4][username] ='';
		 $data[$tatol+4][amount] = $amount_heji;
		 $data[$tatol+4][allprice] =$allprice_heji;		
		 $headArr=array();		
		 $filename="branch_sum";
	}
	else if(!empty($bychanpin))
	{
		header("Content-type:text/html;charset=utf-8");
		if($clientorder==0){
		$Selectedstatus_Array=str_replace("|",",",$Selectedstatus);	
		$where['o.status']=array('IN',$Selectedstatus_Array );
		}else{		
		$orderstatus = array();
		foreach($arr as $key=>$v)
		{
			$orderstatus[]=$key;	
		}
			//$likec.=" and ( o.status IN (1,5,6,7,21,20) )"; 		//显示已删除	
			$where['o.status']=array('IN',implode(',',$orderstatus));
		}
		$companyquery = M("companies");
		if(!empty( $_SESSION["v_company_session"]))
		{			
			$cmpwhere['id'] = $_SESSION["v_company_session"];
		}	
		$cplist=$companyquery->where($cmpwhere)->find();	
		$switchtime=date("Y-m-d H:i",time());
		$data[0][title] ="产品所属分行";
		$data[0][cmname] =$cplist['name'];//
		$data[1][title] ="查询时间";	
        $data[1][switchtime] =$switchtime;							
		$data[2][title] ="数据开始时间";	
		$begintime2=date("Y-m-d H:i",time());
		$overtime2=date("Y-m-d H:i",time());
		if(!empty($begintime))
		{
			$begintime2		=$begintime;	
		}	
		if(!empty($overtime))
		{
			$overtime2		=$overtime;	
		}
        $data[2][switchtime] =$begintime2."至".$overtime2+1;
		$searchlist=$order_items->field("SUM(oi.amount) as amount,SUM(oi.price) as allprice,u.department,u.username,p.prefix,p.number,p.name,p.packing_12,p.packing_21,p.packing_22,p.packing_31,p.packing_32,p.price,p.default")->join("  oi LEFT JOIN v_orders o ON o.id=oi.oid LEFT JOIN v_users u ON u.id=oi.uid LEFT JOIN v_products p ON p.id=oi.pid ")->where($where)->order($orderbystr)->group("oi.pid desc")->select();
		 $tatol=count($searchlist);	
		 $data[3][department] ="订货部门";	
		 $data[3][username] ="账号";	
		 $data[3][prornum] ="产品编号";	
		 $data[3][name] ="产品名称";
		 $data[3][baozhuang] ="包装规格";
		 $data[3][danwei] ="单位";
		 $data[3][amount] ="订购数量";	
		 $data[3][allprice] ="金额合计";
		 $amount_heji=0;	
		 $allprice_heji=0;						//
		foreach($searchlist as $key=>$v){
			$packing_12=$v["packing_12"];
			$packing_21=$v["packing_21"];
			$packing_22=$v["packing_22"];
			$packing_31=$v["packing_31"];
			$packing_32=$v["packing_32"];	
			$baozhuang="1".$packing_12." × ".$packing_21.$packing_22;
			$baozhuang=(($packing_31)&&($packing_32))?$baozhuang." × ".$packing_31.$packing_32:$baozhuang;
			$v['baozhuang']=$baozhuang;
			$default=$v["default"];				
            $danwei= 'packing_'.$default.'2';
	        $danwei = $v[$danwei];
			 $data[$key+4][department] =$v['department'];
			 $data[$key+4][username] =" ".$v['username'];
			 $data[$key+4][prornum] =$v['prefix'].'-'.$v['number'];
			 $data[$key+4][name] =decode_editor($v['name']);
			 $data[$key+4][baozhuang]  =$v['baozhuang'];
        	 $data[$key+4][danwei]  =$danwei;         
			 $data[$key+4][amount] =$v['amount'];
			 $data[$key+4][allprice] =$v['allprice'];
			 $amount_heji+=$v['amount'];
			$allprice_heji+=$v['allprice'];	
		}
		 $data[$tatol+4][department] ="合计";
		 $data[$tatol+4][username] ='';		
		 $data[$tatol+4][prornum] =" ";	
		 $data[$tatol+4][name] =" ";
		 $data[$tatol+4][baozhuang] =" ";
		 $data[$tatol+4][danwei] =" ";
		 $data[$tatol+4][amount] = $amount_heji;
		 $data[$tatol+4][allprice] =$allprice_heji;		
		 $headArr=array();
		   $filename="product_sum";
		}
		$this->getExcel($filename,$headArr,$data);	
	}
	 private  function getExcel($fileName,$headArr,$data){
        //导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
        import("Org.Util.PHPExcel");
        import("Org.Util.PHPExcel.Writer.Excel5");
        import("Org.Util.PHPExcel.IOFactory.php");
        $date = date("y_m_d",time());
        $fileName .= "_{$date}.xls";
        //创建PHPExcel对象，注意，不能少了
        $objPHPExcel = new \PHPExcel();
        $objProps = $objPHPExcel->getProperties();
        //设置表头
        $key = ord("A");
        //print_r($headArr);exit;
        foreach($headArr as $v){
            $colum = chr($key);
            $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
            $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
            $key += 1;
        }
        $column = 2;
        $objActSheet = $objPHPExcel->getActiveSheet();
        //print_r($data);exit;
        foreach($data as $key => $rows){ //行写入
            $span = ord("A");
            foreach($rows as $keyName=>$value){// 列写入
                $j = chr($span);
                $objActSheet->setCellValue($j.$column, $value);
                $span++;
            }
            $column++;
        }
        $fileName = iconv('utf-8', 'gb2312', $fileName);
        //重命名表
        //$objPHPExcel->getActiveSheet()->setTitle('test');
        //设置活动单指数到第一个表,所以Excel打开这是第一个表
        $objPHPExcel->setActiveSheetIndex(0);
        ob_end_clean();//清除缓冲区,避免乱码
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output'); //文件通过浏览器下载
        exit;
    }
	public function datasearch()
	{
		global $BeijingStatus;	
		import('ORG.Util.Page');
		$order_items=M('orderitems');	
		$company				=encodestrall($_GET["company"]);
		$clientuser		        =encodestrall($_GET["clientuser"]);//客户筛选条件radio
		$SelectedCuser			=encodestrall($_GET["SelectedCuser"]);
		$clientproduct	        =encodestrall($_GET["product"]);//产品筛选条件radio
		$SelectedProc			=encodestrall($_GET["SelectedProc"]);
		$clientorder		    =encodestrall($_GET["order"]);//订单筛选条件radio
		$Selectedstatus			=encodestrall($_GET["Selectedstatus"]);		
		$begintime				=encodestrall($_GET["begintime"]);
		$overtime				=encodestrall($_GET["overtime"]+1);
		$status				    =encodestrall($_GET["status"]);
	  $this->assign('company',$company);
	  $this->assign('clientuser',$clientuser);
	  $this->assign('SelectedCuser',$SelectedCuser);
	  $this->assign('clientproduct',$clientproduct);
	  $this->assign('SelectedProc',$SelectedProc);
	  $this->assign('clientorder',$clientorder);
	  $this->assign('Selectedstatus',$Selectedstatus);
	  $this->assign('begintime',$begintime);
	  $this->assign('overtime',$overtime);
	  $this->assign('status',$status);
	  $where['p.company']=$company;
	  $where['u.deltriger']=0;	
	if(isset($BeijingStatus[$company]))
		{
			$arr=$BeijingStatus[$company]['orderStatus'];
		}
		else
		{
			$arr=$BeijingStatus['orderStatus'];
		} 	
		
	if($_SESSION["v_username_group"]==5||$_SESSION["v_username_group"]==82){
			$where['oi.uid']= $_SESSION["v_uid_session"];
		}else{
				if($clientuser==0){
				$SelectedCuser_Array=str_replace("|",",",$SelectedCuser);
				$where['oi.uid']=array('IN',$SelectedCuser_Array);	
				}
	}
	if($clientproduct==0){
		$SelectedPro_array=str_replace("|",",",$SelectedProc);
		$where['oi.pid']=array('IN',$SelectedPro_array);
	}	
	if($clientorder==0){
	$Selectedstatus_array=str_replace("|",",",$Selectedstatus);	
	$where['o.status']=array('IN',$Selectedstatus_array );	
	}else{		
		$orderstatus = array();
		foreach($arr as $key=>$v)
		{
			$orderstatus[]=$key;	
		}
		//$likec.=" and ( o.status IN (1,5,6,7,21,20) )"; 		//显示已删除		
		$where['o.status']=array('IN',implode(',',$orderstatus));
	}
	//echo $begintime;
	//die();
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
	$status	;
	$orderbystr=" o.starttime desc";
	if($status=="3") $orderbystr="oi.pid desc";
	if($status=="2") $orderbystr="oi.uid desc";
	if($status=="21") $orderbystr="oi.id desc";
	$listseach=array();
	$searchcount=$order_items->field("oi.amount")->join(" oi LEFT JOIN v_orders o ON o.id=oi.oid LEFT JOIN v_users u ON u.id=oi.uid LEFT JOIN v_products p ON p.id=oi.pid ")->where($where)->count();		
	$p = new \Think\Page($searchcount,20);
	$searchlist=$order_items->field("oi.amount,oi.price as allprice,o.number as ordernum,o.starttime,o.id as oid,o.status,u.department,p.id as pid,p.prefix,p.number,p.name,p.packing_12,p.packing_21,p.packing_22,p.packing_31,p.packing_32,p.price,p.default")->join(" oi LEFT JOIN v_orders o ON o.id=oi.oid LEFT JOIN v_users u ON u.id=oi.uid LEFT JOIN v_products p ON p.id=oi.pid ")->where($where)->order($orderbystr)->limit($p->firstRow . ',' . $p->listRows)->select();	
	//echo $order_items->getLastSql();
   //die();
	foreach($searchlist as $key=>$v){		
		$starttime=$v["starttime"];		
		$packing_12=$v["packing_12"];
		$packing_21=$v["packing_21"];
		$packing_22=$v["packing_22"];
		$packing_31=$v["packing_31"];
		$packing_32=$v["packing_32"];	
		$default=$v["default"];	
	    $baozhuang="1".$packing_12." × ".$packing_21.$packing_22;
	    $baozhuang=(($packing_31)&&($packing_32))?$baozhuang." × ".$packing_31.$packing_32:$baozhuang;
		$v['baozhuang']=$baozhuang;
		$v['status'] =$arr[$v['status']];
		$danwei="packing_".$default."2";
		$danwei=$$danwei;
		$v['danwei']=$danwei;		
		$listseach[]=$v;
	}	 
	//$p=getpage($order_items,$where,20);	
	$u_group=$_SESSION["v_username_group"];
	$this->assign('search_page',$p->show());	
    $this->assign('search_list',$listseach);
	$this->assign('u_group',$u_group);
	$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);
	$this->display();	
	}	
	public function pt_upload(){
	header("Content-type:text/html;charset=utf-8");	 
	$this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);
    $this->display();	
	}
	//上传execl文件
	public function up_upload(){
	    $upload = new \Think\Upload();//实例化上传类
		$companyquery = M("companies");
		$gtcp=$_SESSION["v_company_session"];
		$upload->maxSize = 0;//设置附件上传大小
		$upload->exts = array('xls','xlsx','csv');//设置附件上传类型
		$upload->rootPath  =     './Dates/'; // 设置附件上传根目录		
		$upload->savePath = $gtcp.'/';//设置上传目录
		$upload->replace = true;
		$upload->saveName   =   array('date','Y-m-d');
		$upload->subName = true;
		//上传处理
		$info = $upload->uploadOne($_FILES['fileload']);
		$filename =  $upload.$info['savename'];	
		$fileds	=   './Dates/'.$gtcp.'/';			
		$exts = $info['ext'];			
		if(!$info){//上传错误提示信息		
		$this->error($upload->getError());
		}else{//上传成功
		     $this->up_import($filename,$exts,$fileds);
		}
	}
	//获取表中数据，写入数据
	private  function up_import($filename,$exts = 'xls',$fileds){		
		header("Content-type: text/html; charset=utf-8"); 
         //导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
		// $fileds=$upload.$info['rootPath'].$upload.$info['savePath'].$filename;
        import("Org.Util.PHPExcel");		
		//read($filename,$type='xls');		
		$PHPExcel =  new \PHPExcel();
		if($exts =='xls'){
           // import("Org.Util.PHPExcel.Reader.Excel5");
			Vendor("Org.Util.PHPExcel.Reader.Excel5");			
			//Vendor("PHPExcel.PHPExcel.IOFactory");	
			$PHPReader = new \PHPExcel_Reader_Excel5();			
            //$objReader = PHPExcel_IOFactory::createReader('Excel5');
		}else if($exts=='xlsx'){
			import("Org.Util.PHPExcel.Reader.Excel2007");
		    $PHPReader = new \PHPExecl_Reader_Execl2007();
			//$objExcel = $objReader ->load($filename);
		}	
		//载入文件
		$PHPExcel = $PHPReader->load($fileds.$filename);	
	
		//获取表中的第一个工作边，如果要获取第二个，把0改为1，以此类推
		$currentSheet = $PHPExcel->getSheet(0);
		//获取总列数
		$allColumn = $currentSheet->getHighestColumn();
		//获取总行数
		$allRow = $currentSheet->getHighestRow();
		//循环获取表中的数据，$currentRow表述当前行，从哪行开始读去数据，索引值从0开	
		for($currentRow = 1;$currentRow <= $allRow; $currentRow++){
		    //从哪列开始，A表示第一列
			for($currentColumn = 'A'; $currentColumn <= $allColumn;$currentColumn++){
			    //数据坐标
				$address = $currentColumn . $currentRow;
				//读取到的数据，保存到数组$arr中
				$data[$currentRow][$currentColumn] = $currentSheet->getCell($address)->getValue();
				//$this->save_import($data);
			}
		}		
		$outerr=$this->save_import($data);
		//dump($data);		
		//die();
		// array("truenum"=>$numtrue,"falsenum"=>$numfalse,"sum"=>$sum,"errdata"=>$errorarr);
	 $this->assign('truenum',$outerr['truenum']);	
	 $this->assign('falsenum',$outerr['falsenum']);	
	 $this->assign('sum',$outerr['sum']);	
	 $this->assign('errordate',$outerr['errdata']);	
	 $this->assign('leftmenu',$_SESSION["v_username_leftmenu"]);	
	 $this->display();  
	}
	private  function save_import($data){	
	header("Content-type:text/html;charset=utf8");		
		$errorarr=array();//失败数据		
		$products=M("products");
		$company=M("companies");
		$productstype=M("productstype");
		$numtrue=0;
		$numfalse=0;
		$sum=count($data);
	foreach($data as $key => $list){
		if($key<2)continue;
		if(empty ($list['A'])||empty($list['B'])||empty($list['C'])||empty($list['D'])||empty($list['E'])||empty($list['F'])||empty($list['G'])){
		      $list['error']="信息缺失!";
			  $errorarr[]=$list;
			  $numfalse++;
			  continue;
		}
		$num=explode('-',$list['B']);
		$firstnum=$num[0];
		$secondnum=$num[1].'-'.$num[2];
		
		//dump($secondnum);
		//die();
		//$num[0];
		
		$cpwheres['name']=$list['A'];
		$cpwheres['deltriger']=0;
		$cplist=$company->where($cpwheres)->find();
		$companyid=$cplist['id'];
		$ptwheres['ptname']=$list['D'];
			$ptwheres['deltriger']=0;
			$ptwheres['company']=$cplist['id'];
			$ptstype=$productstype->where($ptwheres)->find();
		$ptid=	$ptstype['ptid'];
		if(($companyid)&&($ptid))
		{
			$where['company']= $companyid;
			$where['prefix']=$firstnum;
			$where['number']=$secondnum;
			$pts=$products->where($where)->count();
			if($pts==0){
				while ( true) {
					$where=array();
					$hash = generate_hash();
					$where['hash']=$hash;
					$ptshash=$products->where($where)->count();					
					if ($ptshash==0) break;
				}
				$name=encodestrall($list['C']);
				$name=$name?$name:"未知";
				$packing_12=$list['E'];
				$default=$list['F'];
				$packing_12=$packing_12?$packing_12:"未知";
				$default=$default==$packing_12?1:2;				
				$timenow=time();
				$ipnow=$_SERVER['REMOTE_ADDR'];				
				$dataad['company']=$companyid;
				$dataad['ptid']=$ptid;	
				
				$dataad['hash'] =$hash;			
				$dataad['prefix']=$firstnum;
				$dataad['number']=$secondnum;
				$dataad['versionnumber']='';
				$dataad['name']=$list['C'];				
				$dataad['packing_12']=$packing_12;
				$dataad['default']=$default;
				$dataad['price']=$list['G'];
				$dataad['width']='0';
				$dataad['height']='0';
				$dataad['measurement']='0';
				$dataad['barcode']='';
				$dataad['class']='';
				$dataad['binding']='';
				$dataad['wrapper']='';				
				$dataad['packing_21']='';
				$dataad['packing_22']='';
				$dataad['packing_31']='';
				$dataad['packing_32']='';				
				$dataad['amount']='';
				$dataad['alarmamount']='0';
				$dataad['limitamount']='0';
				$dataad['sort']='0';					
				$dataad['deltriger'] = 0;
				$dataad['available']=1;
				$dataad['ordered'] = 0;	
				$uppt=$products->add($dataad);
				if(!$uppt){
				    $list['error']="数据库插入错误!";
					$errorarr[]=$list;
					 $numfalse++;
				}else{
				$numtrue++;
				}
			}	
			else//产品ID已经存在
				{
					$list['error']="产品ID已经存在!";
					$errorarr[]=$list;
					 $numfalse++;
				}
			}
			else//企业或产品分类不存在
			{
				$list['error']="企业或产品分类不存在";
				$errorarr[]=$list;
				 $numfalse++;
			}		
		}
		return array("truenum"=>$numtrue,"falsenum"=>$numfalse,"sum"=>$sum,"errdata"=>$errorarr);
	}
	
	//ajax获取订单状态
	public function getorderstatuslist()
	{ 
		global $BeijingStatus;
		 $cpid=$_POST['comp'];
		if(isset($BeijingStatus[$cpid]))
		{
			$arr=$BeijingStatus[$cpid]['orderStatus'];
		}
		else
		{
			$arr=$BeijingStatus['orderStatus'];
		}
		 $html="";
		foreach($arr as $key=>$v)
		{
			$html.="<option value=\"".$key."\">".$v."</option>";	
		}
		echo $html;
	}	
	//ajax获取客户
	public function getclientuserlist()
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
	//ajax获取产品
   public function getproductlist()
   {
	   $cpid=$_POST['comp'];
	   	$products = M("products");
		$cmpy['deltriger'] = 0;
	   	$cmpy['company']= $cpid;		
		$lisc = $products->where($cmpy)->select();
		$html="";
		foreach($lisc as $key=>$v)
		{
			if(!empty($v['name']))
			{
			$html.="<option value=\"".$v['id']."\">".$v['prefix'].'-'.$v['number'].' '.$v['name']."</option>";		
			}			
		}
		echo $html;
   }
}