<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
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
								<a href="#">订购产品</a>
								<span class="icon-angle-right"></span>
							</li>
							<li><a href="#">拟订购产品(根据产品列表生成订单)</a></li>
						</ul>
					</div>
				</div>
<div class="portlet box blue">	
      <div  class="portlet-title">   
            <div class="caption" name='$ordersee'> <i class="icon-reorder" ></i>订单产品列表</div>
				<div class="tools">
                    <i class="icon-plus" ></i><a href="/ap_alter/beijing/order/o_ordernew" title="增加新产品">增加新产品</a>
				</div>    
			</div>             
       <div class="portlet-body form" >
            <div id="product" style="height:100%;">           
        <table width="100%">
               <tr>
                    <?php echo ($orderform_locktime); ?>                    
               </tr>
                    <?php if(($total > 0) ): ?><tr height="45" style=" font-family:'微软雅黑'; font-size:14px; font-weight:500; color:#557abb;">
                           <td width="12%" style="text-align:center">编号</td>
                           <td width="32%" style="text-align:center">产品名称</td>
                           <td width="15%" style="text-align:center">订购数量</td>
                           <!--<td width="8%" style="text-align:center">库存数量</td>-->
                           <td width="8%" style="text-align:center">订购上限</td>
                           <td width="12%" style="text-align:center">包装规格</td>
                           <td width="15%" style="text-align:center">操作</td> 
                   </tr>                  
               <?php if(is_array($oritemarr)): $i = 0; $__LIST__ = $oritemarr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$oritemarr): $mod = ($i % 2 );++$i;?><tr id="user_table">
                      <td height="35" style="text-align:center"> <?php echo ($oritemarr["pnum"]); ?></td>
                      <td height="35" style="text-align:center" ><?php echo ($oritemarr["name"]); ?></td>
                      <td height="35" style="text-align:center" ><?php echo ($oritemarr["amount"]); echo ($oritemarr["unit"]); ?></td>
                      <!--<td height="35" style="text-align:center" ><?php echo ($oritemarr["pamount"]); echo ($oritemarr["unit"]); ?></td>   -->                   
                      <td height="35" style="text-align:center" ><?php echo ($oritemarr["limitamount_echo"]); ?></td>
                      <td height="35" style="text-align:center" ><?php echo ($oritemarr["baozhuangguige"]); ?></td>
                      <td height="35" style="text-align:center" > <a href="javascript:dellist(<?php echo ($oritemarr["id"]); ?>)">删除</a></td>          
       </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>                        
        </table>
        
                                              
                                                
                                                  <?php if(($total > 0) ): ?><form name="form1" method="post" class="o_adrs" action="/ap_alter/beijing/order/neworder">
            <div class="od_msg_sub">
                                                	<button type="submit" class="btn blue"  onClick="inneworder()"><i class="icon-ok"></i>&nbsp;&nbsp; 确认所选产品无误，立即生成订单&nbsp;&nbsp;</button>       
                                                </div>
            <div class="od_ed_at">
                     <div style=" font-family:Arial, Helvetica, sans-serif; font-weight:600; font-size:16px;color:#FF0048">请及时到个人信息修改更新您的联系信息保证准确收货</div>
                          <div class="od_msg">                                                		 
                                                  		 <div class="od_msg_txt">收件人</div>
                                                         <div class="od_msg_int"> <input type="text" id="realname" name="realname" class="od_msg_in_put" value="<?php echo ($userinfo["realname"]); ?>" placeholder="收件人" readonly="readonly"  ></div>
                                                </div>
                                                <div class="od_msg">
                                                 		 <div class="od_msg_txt">联系电话</div>
                                                         <div class="od_msg_int"> <input type="text" id="adrtel" name="adrtel" class="od_msg_in_put" value="<?php echo ($userinfo["tel"]); ?>" placeholder="联系电话"  readonly="readonly"></div>
                                                </div>        
                                                <div class="od_msg">
                                                 		 <div class="od_msg_txt">送货地址</div>
                                                         <div class="od_msg_int"> <input type="text" id="sadr" name="sadr" class="od_msg_in_put" value="<?php echo ($userinfo["sendaddr"]); ?>" placeholder="送货地址"  readonly="readonly"></div>
                                                </div>
                                                <div class="od_msg">
                                                 		 <div class="od_msg_txt">附注</div>
                                                         <div class="od_msg_int"> <textarea style="max-width: 200px; height:50px;" id="notes" name="notes" class="od_msg_in_put" cols='100' rows='15' value="" placeholder="附注"></textarea></div>                                                      
                                                </div>
                                                                                                
                                        </div>
                                        </form><?php endif; ?>   
<script>
	function dellist($oid)
{
	if (confirm("确认要删除？")) { 
	if($oid!=""){
			post_res="id="+$oid;								
			postAjax('/ap_alter/beijing/order/oitem_del',post_res,function(data){
				//alert(data);		
												
			});					
	}		
  }window.location.reload();		
}
function inneworder(){
//document.getElementById("from_adorder").submit();
}

</script>
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

	jQuery(document).ready(function() {    

	   // initiate layout and plugins

	   App.init();

	   FormSamples.init();

	});
</script>
<script type="text/javascript">  var _gaq = _gaq || [];  _gaq.push(['_setAccount', 'UA-37564768-1']);  _gaq.push(['_setDomainName', 'keenthemes.com']);  _gaq.push(['_setAllowLinker', true]);  _gaq.push(['_trackPageview']);  (function() {    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);  })();</script>
</body>
</html>