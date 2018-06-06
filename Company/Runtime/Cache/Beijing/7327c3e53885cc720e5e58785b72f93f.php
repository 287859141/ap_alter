<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8" />
<title>智能凭证通管理系统 产品列表</title>
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
								<a href="#">产品管理</a>
								<span class="icon-angle-right"></span>
							</li>
							<li><a href="#">产品列表</a></li>
						</ul>
					</div>
				</div>         
				<div class="portlet box blue">	
                               <div  class="portlet-title">   
                               	<div class="caption"><i class="icon-reorder"></i>产品列表</div>
											<div class="tools">
                                            
											</div>   
								</div>             
<div class="portlet-body form" >
      <div id="product">                                          
        <table width="100%">
           <tr height="45" style=" font-family:'微软雅黑'; font-size:14px; font-weight:500; color:#557abb;">
                   <td width="5%">选择</td>
                   <td width="12%" style="text-align:center">编号</td>
                   <td width="10%" style="text-align:center">所属企业</td>
                   <td width="25%" style="text-align:center">产品名称</td>
                <!--   <td width="5%" style="text-align:center">库存数量</td>-->                   
                   <td width="10%" style="text-align:center">状态</td>
                   <td width="8%" style="text-align:center">排序</td>
                   <td width="15%" style="text-align:center">操作</td>
           </tr>
           <?php if(is_array($p_list)): $k = 0; $__LIST__ = $p_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$product): $mod = ($k % 2 );++$k;?><tr id="user_table">
                  <td height="45" >
                          <input type="checkbox" name="checkbox_uid[]" value="<?php echo ($product["id"]); ?>">
                  </td>
                  <td height="45" style="text-align:center" ><?php echo ($product["prefix"]); ?>-<?php echo ($product["number"]); ?></td>
                  <td height="45" style="text-align:center"><?php echo ($product["cmpe"]); ?></td>
                  <td height="45" style="text-align:center"><?php echo ($product["name"]); ?></td>
                  <!--<td height="45" style="text-align:center" ><?php echo ($product["amount"]); ?></td>
                  <td height="45"  style="text-align:center" ><?php echo ($product["limitamount"]); ?></td>-->                 
                  <td height="45" style="text-align:center" >
                   <?php if(($product["available"] == 1)): ?>正常
                   <?php else: ?>冻结<?php endif; ?>
                   </td>
                    <td height="45" style="text-align:center">
                     <?php echo ($product["sort"]); ?>
                  </td>
                  <td class="user_edit" style="text-align:center" height="45"  >&nbsp;&nbsp;
                  <?php if(($groups == 15)OR($groups == 9)): ?><a class="user_et" href="/ap_alter/beijing/product/p_look/id/<?php echo ($product["id"]); ?>">查看</a>&nbsp;&nbsp
                  <a class="user_et"  href="/ap_alter/beijing/product/p_edit/id/<?php echo ($product["id"]); ?>">编辑</a>&nbsp;&nbsp;
                  <a class="user_et" href="javascript:showamount(<?php echo ($product["id"]); ?>,<?php echo ($k); ?>)">增加</a> &nbsp;&nbsp;
                      <?php if(($product["available"] == 1)): ?><a href="javascript:dellist(1,<?php echo ($product["id"]); ?>)" >冻结</a> 
                      <?php else: ?><a href="javascript:dellist(2,<?php echo ($product["id"]); ?>)">解冻</a><?php endif; ?>
                  <?php else: ?> <a class="user_et" href="/ap_alter/beijing/product/p_look/id/<?php echo ($product["id"]); ?>">查看</a>&nbsp;&nbsp<?php endif; ?>
                  
                  </td>                                                  
           </tr><?php endforeach; endif; else: echo "" ;endif; ?>                                                  
        </table>                   
       <div class="portlet-body form"><input type="button" onClick="dellist(3,0)" value="删除选择项"/>
                 <div class="pagination">
                　　<?php echo ($page); ?>
                </div>	
        </div>
         </div>
</div>
<div id="showamount"  class="showamount_num">
    <div class="showamount_at">
         <div class="showamount_txt">库存数量</div>
            <div class="showamount_selt">
                <select  tabindex="1" id="chgnum_type" class="num_aod">
                    <option value="+">增加</option>
                    <option value="-">减少</option>										
                </select>                 
            </div>
          
             <input type="text" id="chgnum_nums" height="35" class="showamount_sint" value="">
            
    </div>
        <div class="showamount_sint_at">
            <input type="button" value="保存" class="btn blue" onClick="upamount(0)">
                      
            <input type="button" value="取消" class="btn blue" onClick="upamount(1)">
        </div>
         <input type="hidden" id="hpid">
</div>
			</div>
		</div>
<script>
function showamount($id,index)
{
	var $hpid=document.getElementById("hpid");
		var $showamount=document.getElementById("showamount");
	$hpid.value=$id;
	$showamount.style.display="block";
	$showamount.style.top=42+(6*(index-1))+"%";
	//hpid
	}
function upamount($i)
{
	if($i==0){
	var $type=document.getElementById("chgnum_type");
	var $chgnum_nums=document.getElementById("chgnum_nums");
	var $hpid=document.getElementById("hpid");
	$.get('/ap_alter/beijing/product/p_amount',{'id':$hpid.value,'type':$type.value,'nums':$chgnum_nums.value},function(data){
										window.location.reload();
	});
	}else{
	var $hpid=document.getElementById("hpid");
	var $showamount=document.getElementById("showamount");
	$hpid.value=' ';
	$showamount.style.display="none";
	
	}
	}
function dellist(type,$id)
	{	
		if(type==3)
		{
			$id="";
			var listid=document.getElementsByName('checkbox_uid[]');			
			for($i=0;$i<listid.length;$i++)
			{
				if(listid.item($i).checked)
				{
					$id+=listid.item($i).value+",";
				}
			}	
		
		}
	$.get('/ap_alter/beijing/product/dongjie_pro',{'id':$id,'type':type},function(data){
		window.location.href=window.location.href;
	});
		
		}
</script>
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