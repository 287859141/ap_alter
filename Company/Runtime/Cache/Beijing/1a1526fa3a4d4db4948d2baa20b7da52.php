<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->

<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

<meta charset="utf-8" />

<title>智能凭证通管理系统</title>

<meta content="width=device-width, initial-scale=1.0" name="viewport" />

<meta content="" name="description" />

<meta content="" name="author" />

<link href="/ap_alter/Public/css/log-css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

<link href="/ap_alter/Public/css/log-css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>

<link href="/ap_alter/Public/css/log-css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

<link href="/ap_alter/Public/css/log-css/style-metro.css" rel="stylesheet" type="text/css"/>

<link href="/ap_alter/Public/css/log-css/style.css" rel="stylesheet" type="text/css"/>

<link href="/ap_alter/Public/css/log-css/style-responsive.css" rel="stylesheet" type="text/css"/>

<link href="/ap_alter/Public/css/log-css/default.css" rel="stylesheet" type="text/css" id="style_color"/>

<link href="/ap_alter/Public/css/log-css/uniform.default.css" rel="stylesheet" type="text/css"/>

<link href="/ap_alter/Public/css/log-css/user.css" rel="stylesheet" type="text/css"/>   

<link rel="stylesheet" type="text/css" href="/ap_alter/Public/css/log-css/select2_metro.css" />

<link rel="shortcut icon" href="/ap_alter/Public/image/favicon.ico" />

<script src="/ap_alter/Public/js/mydate/WdatePicker.js" type="text/javascript" /></script>

<script language="JavaScript" type="text/javascript" src="/ap_alter/Public/js/FunctionsMain.js"></script>

<script src="/ap_alter/Public/js/ajax.js" type="text/javascript" /></script>

</head>

<body class="page-header-fixed">

<?php echo W('menu/head');?>

		<!-- 支行订购菜单 -->
		<div class="page-sidebar nav-collapse collapse">		
			<ul class="page-sidebar-menu">
				<li>
					<div class="sidebar-toggler hidden-phone"></div>
				</li>
				<li>
					<form class="sidebar-search">
						<div class="input-box">
						</div>
					</form>
				</li>  
                 <!--快捷订购-->              
                  <li class="">
					<a href="javascript:;">
					<i class="icon-shopping-cart"></i>
					<span class="title">产品订购</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li >
							<a href="/ap_alter/beijing/order/o_ordernew">订购产品</a>
						</li>
						<li >
							<a href="/ap_alter/beijing/order/o_showorderitem">拟定购产品</a>
						</li>
					</ul>
				</li>               
            <!--订单管理-->
                <li class="">
					<a href="javascript:;">
					<i class="icon-file-text"></i> 
					<span class="title">订单管理</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">                       
						<li >
							<a href="/ap_alter/beijing/order/index">新提交订单</a>
						</li>
						<li >
							<a href="/ap_alter/beijing/order/o_overs">已审核订单</a>
						</li>
                        <li >
							<a href="/ap_alter/beijing/order/o_ends">已结束订单</a>
						</li>
                        <li >
							<a href="/ap_alter/beijing/order/o_dels">已删除订单</a>
						</li>
                        <li >
							<a href="/ap_alter/beijing/order/o_serchs">搜索订单</a>
						</li>                    
                        <li >
							<a href="/ap_alter/beijing/order/o_orderall">历史订单</a>
						</li> 
					</ul>
				</li>
                <!--数据导出-->
				<li class="">
					<a href="javascript:;">
					<i class="icon-th"></i> 
					<span class="title">数据导出</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li >
							<a href="/ap_alter/beijing/dates/index">数据导出</a>
						</li> 
					</ul>
				</li>          
       	  <li class="">
					<a href="javascript:;">
					<i class="icon-user"></i> 
					<span class="title">个人中心</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
                        <li >
							<a href="/ap_alter/beijing/user/download" style="color:#FF2626">帮助文档</a>
						</li>
                        <li >
							<a href="/ap_alter/beijing/user/edit_user">个人信息</a>
						</li>                      
                         <li >
							<a href="/ap_alter/beijing/user/my_user_log">

							操作日志</a>

						</li>

						<li >

							<a href="/ap_alter/beijing/index/unlogin">

							安全退出</a>

						</li>						

					</ul>

				</li>
               
		  </ul>
		</div>

<div class="page-content">

		  <div class="container-fluid">

				<div class="row-fluid">

					<div class="span12">

						<h3 class="page-title">

							 <small></small>

						</h3>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="/ap_alter/beijing/index/dg_main">主页</a> 

								<span class="icon-angle-right"></span>

							</li>

							<li>

								<a href="#">数据导出</a>

								<span class="icon-angle-right"></span>

							</li>

							<li><a href="#">导出报表</a></li>

						</ul>

					</div>

				</div>

<div class="row-fluid">

	 <div class="span12">

			<div class="tabbable tabbable-custom boxless">

					<div class="tab-content">

							<div class="tab-pane active" id="tab_1">

									<div class="portlet box blue">

										<div class="portlet-title">

											<div class="caption"><i class="icon-reorder"></i>导出条件</div>

										</div>

<div class="portlet-body form">

    <form action="/ap_alter/beijing/dates/datasearch" class="horizontal-form" id="form_add" method="get" >		

        <!--所属企业-->  

        <div class="row-fluid">

            <div class="pro_all ">

                <div class="pro_ad">

                    <div class="pro_box">

                             <label class="pro_companyname" >企业</label>

                    </div>

                    <div class="pro_box_ad"  >                   

                    

                        <select class="span12 select2_category"  id="company" name="company" data-placeholder="请在这里选择一个企业" tabindex="1" onChange="selcustomer(this)">
                       

                        <?php if(is_array($cplist)): $i = 0; $__LIST__ = $cplist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$company): $mod = ($i % 2 );++$i;?><option value="<?php echo ($company["id"]); ?>" ><?php echo ($company["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>

                        </select>

                    </div>

                </div>

            </div>

</div>                                                                                          

    
	<?php if(($zhihangstatic == '0') ): ?><div class="row-fluid">

    <div class="pro_all ">

        <div class="pro_ad">

            <div class="pro_box">



                     <label class="pro_companyname" >客户账号</label>

            </div>



            <div class="pro_box_ad"  id="select_tab" >

                <input type="radio" name="clientuser" value="1" checked onClick="clientusershow(0)" />选择所有

                <input type="radio" name="clientuser"  value="0" onClick="clientusershow(1)"/>手动选择

            </div>

        </div>

    </div>

</div><?php endif; ?>
    <div class="row-fluid"  id="mutiuComShowTr" style="DISPLAY:none; z-index:10 ">

    <div class="pr_excl_all" >  

     <table width="50%" cellpadding="0" >

        <tr align="center" valign="middle">

          <td width="200px">

            <fieldset>

              <legend>所有客户列表</legend>

                  <select name='clientuserList' id='clientuserList'  multiple='multiple' style="width:360px;height:400px" ondblclick="JavaScript:addItem(clientuserList,SelectedclientuserList)">                

                  </select>

            </fieldset>

          </td>

          <td width="10px" align="center">

            <input type="button" value=">>" onClick="JavaScript:addItem(clientuserList,SelectedclientuserList)" /><br /><BR>

            <input type="button" value="<<" onClick="JavaScript:delItem(SelectedclientuserList)" />

          </td>

          <td width="200px">

            <fieldset>

              <legend>所选客户列表</legend>

              <select name="SelectedclientuserList" multiple="multiple" style="width:360px;height:400px" ondblclick="JavaScript:delItem(SelectedclientuserList)">

              </select>

            </fieldset>

          </td>

        </tr>

      </table> 

  </div>				

</div>     





<div class="row-fluid">

    <div class="pro_all ">

        <div class="pro_ad">

            <div class="pro_box">

                <label class="pro_companyname" >产品</label>

            </div>

            <div class="pro_box_ad"  id="select_tab" >

                <input type="radio" name="product" value="1" checked   onClick="productshow(0)"/>选择所有

                <input type="radio" name="product" value="0"  onClick="productshow(1)"/>手动选择

            </div>

        </div>

    </div>

</div>

    <div class="row-fluid"  id="mutiuProShowTr" style="DISPLAY:none; z-index:10 ">

    <div class="pr_excl_all" >  

     <table width="50%" cellpadding="0" >

        <tr align="center" valign="middle">

          <td width="200px">

            <fieldset>

              <legend>所有产品列表</legend>

                  <select name='ProcList' id='ProcList'  multiple='multiple' style="width:360px;height:400px" ondblclick="JavaScript:addItem(ProcList,SelectedProcList)">                

                  </select>

            </fieldset>

          </td>

          <td width="10px" align="center">

            <input type="button" value=">>" onClick="JavaScript:addItem(ProcList,SelectedProcList)" /><br /><BR>

            <input type="button" value="<<" onClick="JavaScript:delItem(SelectedProcList)" />

          </td>

          <td width="200px">

            <fieldset>

              <legend>所选产品列表</legend>

              <select name="SelectedProcList" multiple="multiple" style="width:360px;height:400px" ondblclick="JavaScript:delItem(SelectedProcList)">

              </select>

            </fieldset>

          </td>

        </tr>

      </table> 

  </div>

</div>    



<div class="row-fluid">

    <div class="pro_all ">

        <div class="pro_ad">

            <div class="pro_box">

                 <label class="pro_companyname" >订单状态</label>

            </div>

            <div class="pro_box_ad"  id="select_tab" >

                <input type="radio" name="order" value="1" checked  onClick="ordershow(0)"/>选择所有

                <input type="radio" name="order" value="0" onClick="ordershow(1)"/>手动选择

            </div>

        </div>

    </div>

</div>

  <div class="row-fluid"  id="mutiuOrderShowTr" style="DISPLAY:none; z-index:10 ">

    <div class="pr_excl_all" >  

     <table width="50%" cellpadding="0" >

        <tr align="center" valign="middle">

          <td width="200px">

            <fieldset>

              <legend></legend>

                  <select name='OrderList' id='OrderList'  multiple='multiple' style="width:360px;height:400px" ondblclick="JavaScript:addItem(OrderList,SelectedOrderList)">

                

                  </select>

            </fieldset>

          </td>

          <td width="10px" align="center">

            <input type="button" value=">>" onClick="JavaScript:addItem(OrderList,SelectedOrderList)" /><br /><BR>

            <input type="button" value="<<" onClick="JavaScript:delItem(SelectedOrderList)" />

          </td>

          <td width="200px">

            <fieldset>

              <legend></legend>

              <select name="SelectedOrderList" multiple="multiple" style="width:360px;height:400px" ondblclick="JavaScript:delItem(SelectedOrderList)">

              </select>

            </fieldset>

          </td>

        </tr>

      </table> 

  </div>

</div>       



<div class="row-fluid">

    <div class="pro_all ">

        <div class="pro_ad">

            <div class="pro_box">

                 <label class="pro_companyname" >排序方式</label>

            </div>

            <div class="pro_box_ad"  id="select_tab" >

                <input type="radio" name="status" value="1" checked />订单时间

                <input type="radio" name="status" value="2" />支行

<input type="radio" name="status" value="3" />产品

            </div>

        </div>

    </div>

</div>        



<div class="row-fluid">

<div class="pro_all ">

    <div class="pro_ad">

        <div class="pro_box">

             <label class="pro_companyname" >时间段</label>

        </div>

        <div class="pro_box_ad"  id="padd_tab" >

            <div class="cmm_num"><input class="Wdate" type="text" name="begintime" id="begintime" onClick="WdatePicker({dateFmt:'yyyy-M-d',skin:'whyGreen',maxDate: '%y-%M-%d'})"></div>            

            <div class="x_txt" >至</div>

            <div class="cmm_num"><input class="Wdate" type="text" name="overtime" id="overtime" onClick="WdatePicker({dateFmt:'yyyy-M-d',skin:'whyGreen',maxDate: '%y-%M-%d'})">时间段内提交的订单</div>              

        </div>

    </div>

</div>

</div>

<div class="form-actions">

<button type="button" class="btn blue" onClick=" return valdata()"><i class="icon-ok"></i>&nbsp;&nbsp; 查&nbsp;&nbsp;询&nbsp;&nbsp;</button>

<input type="hidden" name="SelectedCuser"><input type="hidden" name="SelectedProc"><input type="hidden" name="Selectedstatus">

</div>

</form>

</div>

</div>

                </div>



            </div>



        </div>



    </div>



</div>

			</div>

		</div>

	</div>

<div class="clearfix"></div>
<div class="footer">
		<div class="footer-inner">
			copyright 2005-2016 by jinbaolian.com</div>
		<div class="footer-tools">
			<span class="go-top">
			<i class="icon-angle-up"></i>
			</span>
		</div>
	</div>



<script src="/ap_alter/Public/js/log-js/jquery-1.10.1.min.js" type="text/javascript"></script>



<script src="/ap_alter/Public/js/log-js/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>



<script src="/ap_alter/Public/js/log-js/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      



<script src="/ap_alter/Public/js/log-js/bootstrap.min.js" type="text/javascript"></script>



<!--[if lt IE 9]>



<script src="/ap_alter/Public/js/log-js/excanvas.min.js"></script>



<script src="/ap_alter/Public/js/log-js/respond.min.js"></script>  



<![endif]-->   



<script src="/ap_alter/Public/js/log-js/jquery.slimscroll.min.js" type="text/javascript"></script>



<script src="/ap_alter/Public/js/log-js/jquery.blockui.min.js" type="text/javascript"></script>  



<script src="/ap_alter/Public/js/log-js/jquery.cookie.min.js" type="text/javascript"></script>



<script src="/ap_alter/Public/js/log-js/jquery.uniform.min.js" type="text/javascript" ></script>



<script type="text/javascript" src="/ap_alter/Public/js/log-js/select2.min.js"></script>



<script src="/ap_alter/Public/js/log-js/app.js"></script>



<script src="/ap_alter/Public/js/log-js/form-samples.js"></script> 



<script>

var SelectedCuser =document.getElementsByName("SelectedCuser").item(0);

var SelectedProc =document.getElementsByName("SelectedProc").item(0);

var Selectedstatus =document.getElementsByName("Selectedstatus").item(0);

var SelectedclientuserList=document.getElementsByName("SelectedclientuserList").item(0);

var SelectedProcList=document.getElementsByName("SelectedProcList").item(0);

var SelectedOrderList=document.getElementsByName("SelectedOrderList").item(0);



var radioclientuser=document.getElementsByName("clientuser");

var radioproduct=document.getElementsByName("product");

var radioorder=document.getElementsByName("order");



function valdata()

{

	SelectedCuser.value		=	joinItem(SelectedclientuserList);

	SelectedProc.value		=	joinItem(SelectedProcList);

	Selectedstatus.value	=	joinItem(SelectedOrderList);		

	

	 if ((radioclientuser.value == "0")&&(SelectedclientuserList.value == ""))

	 {

		 alert("错误\n请选择客户！");

		clientuserList.focus();

		 return (false);

	 }		



	 if ((radioproduct.value == "0")&&(SelectedProcList.value == ""))

	 {

		 alert("错误\n请选择产品！");

		ProcList.focus();

		 return (false);

	 }



	 if ((Selectedstatus.value == "0")&&(SelectedOrderList.value == ""))

	 {

		 alert("错误\n请选择订单状态！");

		 OrderList.focus();

		 return (false);

	 }
	
	 document.getElementById("form_add").submit();

}



//选择企业后重置筛选条件

function selcustomer(v)

{

	//客户

	radioclientuser.item(0).checked="checked";

	radioclientuser.item(0).parentNode.className="checked";

	radioclientuser.item(1).parentNode.className=" ";

	document.getElementById("mutiuComShowTr").style.display="none";

	//产品 

	radioproduct.item(0).checked="checked";

	radioproduct.item(0).parentNode.className="checked";

	radioproduct.item(1).parentNode.className=" ";

	document.getElementById("mutiuProShowTr").style.display="none";

	//订单

	radioorder.item(0).checked="checked";

	radioorder.item(0).parentNode.className="checked";

	radioorder.item(1).parentNode.className=" ";

	document.getElementById("mutiuOrderShowTr").style.display="none";

	

	

	//排序方式

	document.getElementsByName("status").item(0).checked="checked";

	document.getElementsByName("status").item(0).parentNode.className="checked";

	document.getElementsByName("status").item(1).parentNode.className=" ";

	document.getElementsByName("status").item(2).parentNode.className=" ";

}



	//手动选择客户

function clientusershow(v)

{

	if(v==1){

		var customer=document.getElementById("company");

		if(customer.value<=0)

		{

			alert("请先选择企业");

			return false;

		}else

		{

				post_res = 'comp='+customer.value;

		postAjax("/ap_alter/beijing/Dates/getclientuserlist",post_res,function(data){

			var mutiuComShowTr=document.getElementById("mutiuComShowTr");

			var clientuserList=document.getElementById("clientuserList");

			clientuserList.innerHTML=data;

			mutiuComShowTr.style.display="block";

			//alert(data);

		//	window.location.reload();

		});			

			}			

	}

	else 

	{

		document.getElementById("mutiuComShowTr").style.display="none";

		}

	}



//手动选择产品

function productshow(v)

{

	if(v==1){

		var customer=document.getElementById("company");

		if(customer.value<=0)

		{

			alert("请先选择企业");

			return false;

		}else

		{

				post_res = 'comp='+customer.value;

		postAjax("/ap_alter/beijing/Dates/getproductlist",post_res,function(data){

			var promutiu=document.getElementById("mutiuProShowTr");

			var ProcList=document.getElementById("ProcList");

			ProcList.innerHTML=data;

			promutiu.style.display="block";

			//alert(data);

		//	window.location.reload();

		});			

			}			

	}

	else 

	{

		document.getElementById("mutiuProShowTr").style.display="none";

		}

	}		

//手动选择订单状态	

function ordershow(v)

{

	if(v==1){

		var customer=document.getElementById("company");

		if(customer.value<=0)

		{

			alert("请先选择企业");

			return false;

		}else

		{

				post_res = 'comp='+customer.value;

		postAjax("/ap_alter/beijing/Dates/getorderstatuslist",post_res,function(data){

			var order=document.getElementById("mutiuOrderShowTr");

				var OrderList=document.getElementById("OrderList");

			OrderList.innerHTML=data;

			order.style.display="block";

			//alert(data);

		//	window.location.reload();

		});			

			}			

	}

	else 

	{

		document.getElementById("mutiuOrderShowTr").style.display="none";

		}

	}	

	jQuery(document).ready(function() {    



	   // initiate layout and plugins



	   App.init();



	   FormSamples.init();

	});

</script>

<script type="text/javascript">  var _gaq = _gaq || [];  _gaq.push(['_setAccount', 'UA-37564768-1']);  _gaq.push(['_setDomainName', 'keenthemes.com']);  _gaq.push(['_setAllowLinker', true]);  _gaq.push(['_trackPageview']);  (function() {    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);  })();</script>

</body>

</html>