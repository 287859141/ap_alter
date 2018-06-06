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
</head>
<body class="page-header-fixed">
<?php echo W('menu/head');?>
<!--营销管理员-->


<div class="page-sidebar nav-collapse collapse;" >
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
   <!--客户管理-->
<li class="">

    <a href="javascript:;">

    <i class="icon-user-md"></i> 

    <span class="title">快捷订购</span>

    <span class="arrow "></span>

    </a>

    <ul class="sub-menu">
        <li >
            <a href="/ap_alter/beijing/order/o_agent">代订购产品</a>
        </li>       
       <li >
            <a href="/ap_alter/beijing/order/o_show_agent">拟代定购产品</a>
       </li>
    </ul>
</li>			
<!--产品管理-->
<!--客户管理-->
<li class="">

    <a href="javascript:;">

    <i class="icon-user-md"></i> 

    <span class="title">客户管理</span>

    <span class="arrow "></span>

    </a>

    <ul class="sub-menu" >
        <li >
            <a href="/ap_alter/beijing/member/index">客户列表</a>
        </li>
        <li >
            <a href="/ap_alter/beijing/member/m_add">添加客户</a>
        </li>
        <!--
        <li >
            <a href="/ap_alter/beijing/member/m_add">额度管理</a>
        </li>-->
    </ul>
</li>			
<!--产品管理-->
<li class="">

    <a href="javascript:;">

    <i class="icon-shopping-cart"></i> 

    <span class="title">产品管理</span>

    <span class="arrow "></span>
    </a>
    <ul class="sub-menu">
        <li >
            <a href="/ap_alter/beijing/product/index">产品列表</a>
        </li>
        <li >
            <a href="/ap_alter/beijing/product/p_add">添加产品</a>
        </li>
        <li >
            <a href="/ap_alter/beijing/product/p_type">产品分类</a>
        </li>
        <li >
            <a href="/ap_alter/beijing/product/p_logs">产品日志</a>
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
            <a href="/ap_alter/beijing/order/o_ending">结束订单</a>
        </li>             
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
            <a href="/ap_alter/beijing/order/o_logs">订单日志</a>
        </li>
        <li >
            <a href="/ap_alter/beijing/order/o_orderall">历史订单</a>
        </li>
        <li >
            <a href="/ap_alter/beijing/order/o_checktime">锁定时间</a>
        </li>
    </ul>

</li>
<!--数据导出-->
<li class="">

    <a href="javascript:;">

    <i class="icon-th"></i> 

    <span class="title">数据管理</span>

    <span class="arrow "></span>

    </a>

    <ul class="sub-menu" style="display: none;">
        <li >
            <a href="/ap_alter/beijing/dates/index">数据导出</a>
        </li>
        <li >
            <a href="/ap_alter/beijing/dates/pt_upload">产品导入</a>
        </li>
    </ul>

</li>
<!--库存管理-->
<li class="">

    <a href="javascript:;">

    <i class="icon-shopping-cart"></i> 

    <span class="title">库存管理</span>

    <span class="arrow "></span>
    </a>
    <ul class="sub-menu">
        <li >
            <a href="/ap_alter/beijing/Stock/storage_management">入库管理</a>
        </li>
        <li >
            <a href="/ap_alter/beijing/Stock/warehouse_management">出库管理</a>
        </li>
        <li >
            <a href="/ap_alter/beijing/Stock/index">库存管理</a>
        </li>
        <li >
            <a href="/ap_alter/beijing/product/p_logs">操作日志</a>
        </li>
    </ul>
</li>
    <!--            统计分析
                
				<li class="">

					<a href="javascript:;">

					<i class="icon-bar-chart"></i> 

					<span class="title">库存管理</span>

					<span class="arrow "></span>

					</a>

					<ul class="sub-menu">

						<li >

						<a href="/ap_alter/beijing/Statistic/costing">入库管理</a> 
							<a href="/ap_alter/beijing/Stock/storage_management">入库管理</a>
						</li>
                        <li >

						 <a href="/ap_alter/beijing/Statistic/data_analysis">出库管理</a> 
							<a href="/ap_alter/beijing/Stock/warehouse_management">出库管理</a>
						</li>

						<li >

							 <a href="/ap_alter/beijing/Statistic/data_export">库存管理</a> 
							<a href="/ap_alter/beijing/Stock/index">库存管理</a>
						</li>

						<li >

							<a href="table_managed.html">操作日志</a>

						</li>					
                       

					</ul>

				</li> -->
				<!--库存管理-->
                
<!-- 				<li class="">

					<a href="javascript:;">

					<i class="icon-stock-marker"></i> 

					<span class="title">库存管理</span>

					<span class="arrow "></span>

					</a>

					<ul class="sub-menu">

						<li >

							<a href="/ap_alter/beijing/Stock/storage_management">入库管理</a>

						</li>

						<li >

							<a href="/ap_alter/beijing/Stock/warehouse_management">出库管理</a>

						</li>
						
						<li >

							<a href="/ap_alter/beijing/Stock/index">库存管理</a>

						</li>


					</ul>

				</li>

			
                 -->
<!--统计分析-->
<!-- 
<li class="">

    <a href="javascript:;">

    <i class="icon-bar-chart"></i> 

    <span class="title">统计分析</span>

    <span class="arrow "></span>

    </a>

    <ul class="sub-menu">

        <li >

            <a href="table_basic.html">统计统计</a>

        </li>
        <li >

            <a href="table_editable.html">数据分析</a>

        </li>

        <li >

            <a href="table_responsive.html">数据导出</a>

        </li>

        <li >

            <a href="table_managed.html">操作日志</a>

        </li>					

        <li >

            <a href="table_advanced.html">数据整合</a>

        </li>
        

    </ul>

</li>
 -->
<!--个人中心-->                         
<li class="">
<a href="javascript:;">
<i class="icon-user"></i> 
<span class="title">个人中心</span>
<span class="arrow "></span>
</a>
<ul class="sub-menu" style="display: none;">
    <li >
        <a href="/ap_alter/beijing/user/edit_user">个人信息</a>
    </li>
    <li >
        <a href="/ap_alter/beijing/user/my_user_log">操作日志</a>
    </li>
    <li >
        <a href="/ap_alter/beijing/index/unlogin">安全退出</a>
    </li>
</ul>
</li>
<!-- 地图标注 -->

<!-- <li class="">

    <a href="javascript:;">

    <i class="icon-map-marker"></i> 

    <span class="title">地图标注</span>

    <span class="arrow "></span>

    </a>

    <ul class="sub-menu">

        <li >

            <a href="maps_google.html">百度地图</a>

        </li>

        <li >

            <a href="maps_vector.html">高德地图</a>

        </li>

    </ul>

</li>    -->
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
								<a href="#">订单管理</a>
								<span class="icon-angle-right"></span>
							</li>
							<li><a href="/ap_alter/beijing/order/o_overs">已审核订单</a></li>
						</ul>
					</div>
				</div>                              
				<div class="portlet box blue">	
                     <div  class="portlet-title">   
                            <div class="caption"><i class="icon-reorder"></i>已审核订单</div>
                                <div class="tools">
                                </div>   
                            </div>     
						
               <div class="portlet-body form" >
                    <div id="product">                                          
                       <table width="100%">
                               <tr height="45" style=" font-family:'微软雅黑'; font-size:14px; font-weight:500; color:#557abb;">
                                   <td width="10%">订单号</td>
                                   <td width="25%" style="text-align:center">订单提交者</td>
                                   <td width="10%" style="text-align:center">订单提交时间</td>
                                   <td width="6%" style="text-align:center">状态</td>
                                   <td width="12%" style="text-align:center">审核人</td>
                                   <td width="8%" style="text-align:center">状态更改时间</td>
                                   <td width="15%" style="text-align:center">操作</td>
                               </tr>
                               <?php if(is_array($order)): $k = 0; $__LIST__ = $order;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($k % 2 );++$k;?><tr id="user_table">
                                  <td height="45" > <input type="checkbox" name="checkbox_uid[]" value="<?php echo ($order["id"]); ?>"><?php echo ($order["number"]); ?></td>
                                  <td height="45" style="text-align:center"><?php echo ($order["cpname"]); ?>&nbsp;&nbsp;<?php echo ($order["depart"]); ?>&nbsp;&nbsp;<?php echo ($order["realname"]); ?></td>
                                  <td height="45" style="text-align:center" ><?php echo (date("Y-m-d H:i",$order['starttime'])); ?></td>
                                  <td height="45" style="text-align:center" >
                                      <?php if(($order["status"] == 2)): ?>总行审核
                                      <?php elseif($order["status"] == 5): ?>集采复核<?php endif; ?>
                                  </td>
                                  <td height="45" style="text-align:center" >
                                  <?php if(($order["status"] == 2)): echo ($order["firstshenhe"]); ?> 
                                  <?php elseif($order["status"] == 5): ?>&nbsp;
                                  <?php echo ($order["laseshenhe"]); endif; ?>
                                  </td>
                                  <td height="45"  style="text-align:center" >
                                  <?php if(($order["status"] == 2)): echo (date("Y-m-d H:i",$order['shenhetime'])); ?>
                                  <?php elseif($order["status"] == 5): ?>&nbsp;
                                  <?php echo (date("Y-m-d H:i",$order['shenhetime1'])); endif; ?>
                                  </td>
                                  
                                  <td class="user_edit" style="text-align:center" height="45"  >
                                  <a class="user_et" href="/ap_alter/beijing/order/o_over_see/id/<?php echo ($order["id"]); ?>">查看</a>&nbsp;&nbsp;
                                  <?php if(($editpres == 1)): ?><a class="user_et" href="/ap_alter/beijing/order/o_over_edit/id/<?php echo ($order["id"]); ?>">编辑</a>&nbsp;&nbsp;
                                  <?php if(($editpres == 1)): ?><a href="javascript:showamount(<?php echo ($order["id"]); ?>,<?php echo ($k); ?>)">审核为</a><?php endif; ?>&nbsp;&nbsp;
                                  <a href="javascript:dellist(<?php echo ($order["id"]); ?>)">删除</a><?php endif; ?></td>                            
                               </tr><?php endforeach; endif; else: echo "" ;endif; ?>                                  
                        </table>                   
 <div class="portlet-body form"><input type="checkbox" name="allcheckbox" value="checkbox" onclick="javascript:select_all()" title="全选/取消">全选/取消 &nbsp;
 <input type="button" onClick="dellist(<?php echo ($order["id"]); ?>)" value="删除选择项"/> <?php if(($reviewstatus != 1)): ?><input type="button" onClick="showamount(<?php echo ($order["id"]); ?>,<?php echo ($k); ?>)" value="审核为结束订单"/><?php endif; ?>                
                         	
                                     <div class="pagination">
                                    　　<?php echo ($page); ?>
                                     </div>	
                            </div>
                      </div>
				</div>
<div id="showamount"  class="showamount_over_num">
    <div class="showamount_at">
         <div class="showamount_txt">选择状态</div>
            <div class="showamount_ov_status">
            <label class="radio">印刷中
			<input type="radio" name="status" value="6" checked />
			</label>
            <label class="radio">配送中
			<input type="radio" name="status" value="7" />
			</label>
            <label class="radio">订单已结束
			<input type="radio" name="status" value="21" />
			</label> 
            </div>          
    </div>
        <div class="showamount_sint_at">
            <input type="button" value="保存" class="btn blue" onClick="upamount(0)">
                      
            <input type="button" value="取消" class="btn blue" onClick="upamount(1)">
        </div>
         <input type="hidden" id="odid">
</div>
<script>
var allcheckbox=document.getElementsByName('allcheckbox')[0];
 function select_all()
{
	var listid=document.getElementsByName('checkbox_uid[]');
	if(allcheckbox.checked)
		{	
				for($i=0;$i<listid.length;$i++)
				{
					listid.item($i).checked="checked";					
					listid.item($i).parentNode.className="checked";
	
				}
		}else
		{
			for($i=0;$i<listid.length;$i++)
				{
					listid.item($i).checked=" ";
					listid.item($i).parentNode.className=" ";
				}
		}
}
function onelist($id,$reviewstatus,$type)
		{
			if($type==21)
				{
					$id="";
					var listid=document.getElementsByName('checkbox_uid[]');			
					for($i=0;$i<listid.length;$i++)
					{
						if(listid.item($i).checked)
						{
							$id+=listid.item($i).value+",";
							 window.location.reload();
						}
					}	
				
				}	
			
			$.get('/ap_alter/beijing/order/o_ck_ending',{'id':$id,'reviewstatus':$reviewstatus},function(data){
				
							window.location.reload();
		});
		
		}
 
function showamount($id,index)
{
	var $odid=document.getElementById("odid");
		var $showamount=document.getElementById("showamount");
	$odid.value=$id;
	$showamount.style.display="block";
	$showamount.style.top=42+(6*(index-1))+"%";
	//hpid
	}
function upamount($i)
{
	if($i==0){
	var $type=document.getElementsByName("status");
	var $c=6;
	for(var s=0;s<$type.length;s++){
	    if($type.item(s).checked){
		    $c=$type.item(s).value;
			break;
		}
		window.location.reload();
	}
	var $odid=document.getElementById("odid");
	$.get('/ap_alter/beijing/order/o_status',{'id':$odid.value,'type':$c},function(data){
		window.location.reload();
	});
	}else{
	var $odid=document.getElementById("odid");
	var $showamount=document.getElementById("showamount");
	$odid.value=' ';
	$showamount.style.display="none";
	
	}
	}
	   function dellist($id)
	{	
	if (!confirm("确认要删除？")) { 
window.event.returnValue = false; 
} 
		
	$.get('/ap_alter/beijing/order/o_del',{'id':$id},function(data){
										window.location.reload();
	});
		
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