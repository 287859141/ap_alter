<?php
namespace Index\Controller;
use Think\Controller;

class OrderController extends Controller {
    public function index(){
		header("Content-type:text/html;charset=utf-8");		
		import("ORG.Util.Page"); 
		$order = M("orders");	
		$ologs = M("orders_logs");
		$osendlogs = M("orders_sendlogs");
		if($_GET){		    
		$pid['uid'] = $_GET['id'];	
		$pstas['status'] = 1;					
		$order->where($pstas)->save();		
	}			
		$where['v_orders.status'] = 1;									
		$p=getpage($order,$where,10);	
		$datas['company'] = 'company';
		$datas['number'] = 'number';	
		$olist=$order->field("v_orders.*,v_companies.id as cpid,v_companies.name as cpname,v_users.company as comname,v_users.department as depart,v_users.realname as realname")->join('LEFT JOIN  v_users ON v_users.id = v_orders.uid LEFT JOIN  v_companies ON v_companies.id = v_users.company')->limit($p->firstRow,10)->where($where)->order('id desc')->select();	
					
		$this->assign('order',$olist);
		$this->assign('page',$p->show());	
	
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
			
		$seelist=$order->field("v_orders.*,v_companies.id as cpid,v_companies.name as cpname,v_users.company as comname,v_users.department as depart,v_users.realname as realname")->join('LEFT JOIN  v_users ON v_users.id = v_orders.uid LEFT JOIN  v_companies ON v_companies.id = v_users.company')->where($oid)->find();		
		
		$osid['v_orderitems.oid'] = $oid['v_orders.id'];			
		
		$ptlist= $oitems->field("v_orderitems.*,v_products.prefix as prefix,v_products.number as number,v_products.name as name,v_products.packing_12,v_products.packing_22,v_products.packing_32")->join('LEFT JOIN v_products ON  v_orderitems.pid = v_products.id')->where($osid)->select();		
		
		$p=getpage($oitems,$osid,10);		
		$this->assign('orderspct',$ptlist);
		
		$this->assign('ordersee',$seelist);
		$this->assign('page',$p->show());	
	
	    $this->display();
	}
	public function o_list_edit(){
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
	
	    $this->display();
	}
	 public function o_edit_up(){
		$order = M("orders");
		$oitems = M("orderitems");
		
		if($_POST){
		$orisnum = $_POST['amount'];
		$orisid = $_POST['amounts'];
		for($i=0;$i<count($orisid );$i++){
		    $c['id'] =$orisid[$i];
			$a['amount'] = $orisnum[$i];
			$oitems->where($c)->save($a);
		}
		$orpid['id']= $_POST['id'];
		$data['realname'] = $_POST['realname'];
		$data['tel'] = $_POST['adrtel'];
		$data['sendaddr'] = $_POST['sadr'];
		$data['notes'] = $_POST['notes'];
		$order->where($orpid)->save($data);
		}
			
		
		$this->success('新增成功', 'index');
	}
	public function o_del(){
		$ckorder = M("orders");			
		$where['id'] = $_GET['id'];
		$data['status'] = 20; 
		$data['shenhechg'] = 0;	
		$data['shenheuser'] = $_SESSION['jbl_uid_session'];
		$data['shenhetime'] = time();
		$ckorder->where($where)->save($data);
	}
	public function o_cheks(){
		
		$ckorder = M("orders");		
		$where['status'] = 1;
		$where['id'] = $_GET['id'];
		$data['status'] = 5; 
		$data['shenhechg'] = 1;	
		$data['shenheuser'] = $_SESSION['jbl_uid_session'];
		$data['shenhetime'] = time();
		$ckorder->where($where)->save($data);		
		
	}
	 public function o_overs(){		
		header("Content-type:text/html;charset=utf-8");		
		import("ORG.Util.Page"); 
		$order = M("orders");	
		$ologs = M("orders_logs");
		$osendlogs = M("orders_sendlogs");
				
		$where['v_orders.status'] = array('IN',array(5,6,7,21),'OR' );									
		$p=getpage($order,$where,10);	
		$datas['company'] = 'company';
		$datas['number'] = 'number';
		$data['shenheuser'] = $_SESSION['jbl_uid_session'];	
		$olist=$order->field("v_orders.*,v_companies.id as cpid,v_companies.name as cpname,v_users.company as comname,v_users.department as depart,v_users.realname as realname,v_users.realname as realname")->join('LEFT JOIN  v_users ON v_users.id = v_orders.uid LEFT JOIN  v_companies ON v_companies.id = v_users.company')->limit($p->firstRow,10)->where($where)->order('id desc')->select();	
					
		$this->assign('order',$olist);
		$this->assign('page',$p->show());	
	
        $this->display();	
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
				
		$where['v_orders.status'] = 21;									
		$p=getpage($order,$where,10);	
		$datas['company'] = 'company';
		$datas['number'] = 'number';
		$data['shenheuser'] = $_SESSION['jbl_uid_session'];	
		$olist=$order->field("v_orders.*,v_companies.id as cpid,v_companies.name as cpname,v_users.company as comname,v_users.department as depart,v_users.realname as realname,v_users.realname as realname")->join('LEFT JOIN  v_users ON v_users.id = v_orders.uid LEFT JOIN  v_companies ON v_companies.id = v_users.company')->limit($p->firstRow,10)->where($where)->order('id desc')->select();	
					
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
	
	    $this->display();
	  }
	   public function o_dels(){		
		header("Content-type:text/html;charset=utf-8");		
		import("ORG.Util.Page"); 
		$order = M("orders");	
		$ologs = M("orders_logs");
		$osendlogs = M("orders_sendlogs");				
		$where['v_orders.status'] = 20;									
		$p=getpage($order,$where,10);	
		$datas['company'] = 'company';
		$datas['number'] = 'number';
		$data['shenheuser'] = $_SESSION['jbl_uid_session'];	
		$olist=$order->field("v_orders.*,v_companies.id as cpid,v_companies.name as cpname,v_users.company as comname,v_users.department as depart,v_users.realname as realname,v_users.realname as realname")->join('LEFT JOIN  v_users ON v_users.id = v_orders.uid LEFT JOIN  v_companies ON v_companies.id = v_users.company')->limit($p->firstRow,10)->where($where)->order('id desc')->select();	
					
		$this->assign('order',$olist);
		$this->assign('page',$p->show());	
	
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
	    $this->display();
	 }
	
}