<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html><head>

<meta name="keywords" content="">
<meta name="description" content="">
<title>智能凭证通订单管理系统</title>
<meta  charset="utf-8" />
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<meta content="" name="description" />
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<meta name="renderer" contert="webkit|ie-stand|ie-comp">
<meta content="" name="author" />

	<!-- BEGIN GLOBAL MANDATORY STYLES -->

	<link href="/ap_alter/Public/css/log-css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

	<link href="/ap_alter/Public/css/log-css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>

	<link href="/ap_alter/Public/css/log-css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

	<link href="/ap_alter/Public/css/log-css/style-metro.css" rel="stylesheet" type="text/css"/>

	<link href="/ap_alter/Public/css/log-css/style.css" rel="stylesheet" type="text/css"/>

	<link href="/ap_alter/Public/css/log-css/style-responsive.css" rel="stylesheet" type="text/css"/>

	<link href="/ap_alter/Public/css/log-css/default.css" rel="stylesheet" type="text/css" id="style_color"/>

	<link href="/ap_alter/Public/css/log-css/uniform.default.css" rel="stylesheet" type="text/css"/>

	<!-- END GLOBAL MANDATORY STYLES -->

	<!-- BEGIN PAGE LEVEL STYLES --> 

	<link href="/ap_alter/Public/css/log-css/jquery.gritter.css" rel="stylesheet" type="text/css"/>

	<link href="/ap_alter/Public/css/log-css/daterangepicker.css" rel="stylesheet" type="text/css" />

	<link href="/ap_alter/Public/css/log-css/fullcalendar.css" rel="stylesheet" type="text/css"/>

	<link href="/ap_alter/Public/css/log-css/jqvmap.css" rel="stylesheet" type="text/css" media="screen"/>

	<link href="/ap_alter/Public/css/log-css/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="/ap_alter/Public/css/log-css/user.css" rel="stylesheet" type="text/css"/> 

	<!-- END PAGE LEVEL STYLES -->

	<link rel="shortcut icon" href="/ap_alter/Public/image/favicon.ico" />
</head>

<body class="page-header-fixed">
   
<title>智能凭证通订单管理系统</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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


<div class="page-container">     
		<div class="page-content">
        	  <div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
												<div class="color-panel hidden-phone">
                        <div class="color-panel adrs">
					    <div class="color-panel adrs_t ">你好,,欢迎使用智能凭证通订单管理系统，今天是<?php echo ( date("Y年m月d日 ",time()) ); echo "今天是星期" . mb_substr( "日一二三四五六",date("w"),1,"utf-8" ); ?></div>

							<div class="color-panel adrs_b">&nbsp;供应商电话 于航 010-63273723、 13911729068&nbsp;</div>
                       </div>
						</div>
	
                        <h3 class="page-title">&nbsp;</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="/ap_alter/beijing/index/dg_main">主页</a> 
								<i class="icon-angle-right"></i>
							</li>
							<li><a href="#">功能面板</a></li>	
						</ul>
					</div>
				</div>	
                <?php if(($userinfo["group"] == 15) OR($userinfo["group"] == 9) ): ?><div id="dashboard">
               
					<div class="row-fluid">
						<div class="span3 responsive" data-tablet="span6" data-desktop="span3">

							<div class="dashboard-stat blue">

								<div class="visual">

									<i class="icon-list-alt"></i>

								</div>

								<div class="details">

									<div class="number">

										<?php echo ($pronum); ?>

									</div>

									<div class="desc">                           

										产品数量

									</div>

								</div>

								<a class="more" href="/ap_alter/beijing/Product/index" title="产品数量">

								详情 <i class="m-icon-swapright m-icon-white"></i>

								</a>                 

							</div>

						</div>

						<div class="span3 responsive" data-tablet="span6" data-desktop="span3">

							<div class="dashboard-stat green">

								<div class="visual">

									<i class="icon-exclamation-sign"></i>

								</div>

								<div class="details">

									<div class="number"><?php echo ($usernum); ?></div>

									<div class="desc">用户总数</div>

								</div>

								<a class="more" href="/ap_alter/beijing/member/index" title="用户总数">

								详情 <i class="m-icon-swapright m-icon-white"></i>

								</a>                 

							</div>

						</div>

						<div class="span3 responsive" data-tablet="span6  fix-offset" data-desktop="span3">

							<div class="dashboard-stat purple">

								<div class="visual">

									<i class="icon-question-sign"></i>

								</div>

								<div class="details">

									<div class="number"><?php echo ($pronewnum); ?></div>

									<div class="desc">未审核订单</div>

								</div>

								<a class="more" href="/ap_alter/beijing/Order/index" title="未审订单">

								详情 <i class="m-icon-swapright m-icon-white"></i>

								</a>                 

							</div>

						</div>

						<div class="span3 responsive" data-tablet="span6" data-desktop="span3">

							<div class="dashboard-stat yellow">

								<div class="visual">

									<i class="icon-download"></i>

								</div>

								<div class="details">

									<div class="number">12,5M$</div>

									<div class="desc">数据导出</div>

								</div>

								<a class="more" href="/ap_alter/beijing/Dates/index" title="数据导出">

								详情 <i class="m-icon-swapright m-icon-white"></i>

								</a>                 

							</div>

						</div>

					</div><?php endif; ?>			
					<div class="clearfix"></div>
					<div class="row-fluid">
						<div class="portlet-body form" >
                    <div id="product">                                          
                        <table width="100%">
                             <tr height="45" style=" font-family:'微软雅黑'; font-size:14px; font-weight:500; color:#557abb;">
                                   <td width="5%" align="center">订单号</td>
                                   <td width="20%" align="center">订单提交者</td>
                                   <td width="12%" align="center">订单提交时间</td>
                                   <td width="15%" align="center">操作</td>
                             </tr>
                           <?php if(is_array($order)): $k = 0; $__LIST__ = $order;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($k % 2 );++$k;?><tr id="user_table">
                              <td height="45" onMouseOver="this.style.backgroudcolor='#247BFF';"> <input type="checkbox" name="checkbox_uid[]" value="<?php echo ($order["id"]); ?>"><?php echo ($order["number"]); ?></td>
                              <td height="45" ><?php echo ($order["cpname"]); ?>&nbsp;&nbsp;<?php echo ($order["depart"]); ?>&nbsp;&nbsp;<?php echo ($order["realname"]); ?></td>
                              <td height="45" style="text-align:center" ><?php echo (date("Y-m-d H:i",$order['starttime'])); ?></td>
                              <td class="user_edit" style="text-align:center" >
                              <a class="user_et" href="/ap_alter/beijing/order/o_see/id/<?php echo ($order["id"]); ?>">查看</a> &nbsp;&nbsp;
                               <?php if(($reviewstatus == 0)OR($reviewstatus == 1)): ?><a class="user_et" href="/ap_alter/beijing/order/o_list_edit/id/<?php echo ($order["id"]); ?>">编辑</a> &nbsp;&nbsp;<?php endif; ?>
                              <?php if(($reviewstatus > 0)): ?><a href="javascript:onelist(<?php echo ($order["id"]); ?>,<?php echo ($reviewstatus); ?>,1)">审核确认</a> &nbsp;&nbsp;<?php endif; ?>                                                        
                             <!-- <a href="javascript:dellist(<?php echo ($order["id"]); ?>)">删除</a>-->
                              </td>                          
                           </tr><?php endforeach; endif; else: echo "" ;endif; ?>                                  
                        </table>
                   
                       <div class="portlet-body form">        
                         <div class="pagination">
                        　　<?php echo ($page); ?>
                        </div>	
                    </div>
             </div>
    </div>
				    </div>   
				        </div>
                      <!--
                        	<div class="span6">
                             <div class="portlet-body form" >
                                <div id="users">
                                          
                                        <table width="100%">
                                                   <tr height="45" style=" font-family:'微软雅黑'; font-size:14px; font-weight:500; color:#557abb;">
                                                           <td width="8%">选择</td>
                                                           <td width="15%">用户名</td>
                                                           <td width="10%">姓名</td>
                                                           <td width="20%">角色</td>
                                                           <td width="5%">性别</td>
                                                           <td width="12%">电话</td>
                                                           <td width="10%">状态</td>
                                                           <td width="12%">邮箱</td>
                                                           <td width="15%">操作</td>
                                                   </tr>
                                                   <?php if(is_array($user_list)): $i = 0; $__LIST__ = $user_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><tr id="user_table">
                                                          <td height="45" onMouseOver="this.style.backgroudcolor='#247BFF';">
                                                                  <input type="checkbox" name="checkbox_uid[]" value="352">
                                                                   
                                                          </td>
                                                          <td height="45" onMouseOver="this.style.backgroudcolor='#247BFF';"><?php echo ($user["username"]); ?></td>
                                                          <td height="45" onMouseOver="this.style.backgroudcolor='#247BFF';"><?php echo ($user["realname"]); ?></td>
                                                          <td height="45" onMouseOver="this.style.backgroudcolor='#247BFF';">
                                                          <?php if(($user["group"] == 9)): ?>超级管理员
                                                          <?php elseif(($user["group"] == 91)): ?>普通管理员
                                                          <?php elseif(($user["group"] == 14)): ?>仓储管理员
                                                          <?php elseif(($user["group"] == 15)): ?>营销管理员
                                                          <?php elseif(($user["group"] == 92)): ?>客户管理员&nbsp;&nbsp;[<?php echo ($user["companiesname"]); ?>]
                                                          <?php else: ?>普通用户<?php endif; ?></td>
                                                          <td height="45" onMouseOver="this.style.backgroudcolor='#247BFF';"><?php if(($user["gender"] == 0) ): ?>男 <?php else: ?>女<?php endif; ?></td>
                                                          <td height="45" onMouseOver="this.style.backgroudcolor='#247BFF';"><?php echo ($user["tel"]); ?></td>
                                                           <td height="45" onMouseOver="this.style.backgroudcolor='#247BFF';">
                                                           <?php if(($user["deltriger"] == 1)): ?>停用
                                                           <?php else: ?>启用<?php endif; ?>
                                                           </td>
                                                          <td height="45" onMouseOver="this.style.backgroudcolor='#247BFF';"><?php echo ($user["email"]); ?></td>
                                                         
                                                          <td class="user_edit" height="45" onMouseOver="this.style.backgroudcolor='#247BFF';" >&nbsp;&nbsp;<a class="user_et" href="/ap_alter/user/auser_edit/id/<?php echo ($user["id"]); ?>">编辑</a> <a href="/ap_alter/user/auser_edit/id/<?php echo ($user["id"]); ?>">查看记录</a>&nbsp;&nbsp;
                                                          <a href="/ap_alter/user/index/id/<?php echo ($user["id"]); ?>">删除</a></td>
                                                  
                                                   </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                                  
                                        </table>
                   
										<div class="portlet-body form">
                                         <div class="pagination">
                                        　　<?php echo ($page); ?>
                                        </div>	
								</div>
                         </div>
				</div>    -->

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

	<script src="/ap_alter/Public/js/log-js/jquery.vmap.js" type="text/javascript"></script>   

	<script src="/ap_alter/Public/js/log-js/jquery.vmap.russia.js" type="text/javascript"></script>

	<script src="/ap_alter/Public/js/log-js/jquery.vmap.world.js" type="text/javascript"></script>

	<script src="/ap_alter/Public/js/log-js/jquery.vmap.europe.js" type="text/javascript"></script>

	<script src="/ap_alter/Public/js/log-js/jquery.vmap.germany.js" type="text/javascript"></script>

	<script src="/ap_alter/Public/js/log-js/jquery.vmap.usa.js" type="text/javascript"></script>

	<script src="/ap_alter/Public/js/log-js/jquery.vmap.sampledata.js" type="text/javascript"></script>  

	<script src="/ap_alter/Public/js/log-js/jquery.flot.js" type="text/javascript"></script>

	<script src="/ap_alter/Public/js/log-js/jquery.flot.resize.js" type="text/javascript"></script>

	<script src="/ap_alter/Public/js/log-js/jquery.pulsate.min.js" type="text/javascript"></script>

	<script src="/ap_alter/Public/js/log-js/date.js" type="text/javascript"></script>

	<script src="/ap_alter/Public/js/log-js/daterangepicker.js" type="text/javascript"></script>     

	<!--<script src="/ap_alter/Public/js/log-js/jquery.gritter.js" type="text/javascript"></script>-->

	<script src="/ap_alter/Public/js/log-js/fullcalendar.min.js" type="text/javascript"></script>

	<script src="/ap_alter/Public/js/log-js/jquery.easy-pie-chart.js" type="text/javascript"></script>

	<script src="/ap_alter/Public/js/log-js/jquery.sparkline.min.js" type="text/javascript"></script>  

	<script src="/ap_alter/Public/js/log-js/app.js" type="text/javascript"></script>

	<script src="/ap_alter/Public/js/log-js/index.js" type="text/javascript"></script>  
    
	<script>

		jQuery(document).ready(function() {    

		   App.init(); // initlayout and core plugins

		   Index.init();

		   Index.initJQVMAP(); // init index page's custom scripts

		   Index.initCalendar(); // init index page's custom scripts

		   Index.initCharts(); // init index page's custom scripts

		   Index.initChat();

		   Index.initMiniCharts();

		   Index.initDashboardDaterange();

		   Index.initIntro();

		});

	</script>



<script type="text/javascript"> 
 var 
  _gaq = _gaq || []; 
  _gaq.push(['_setAccount', 'UA-37564768-1']); 
  _gaq.push(['_setDomainName', 'keenthemes.com']);  
  _gaq.push(['_setAllowLinker', true]);  
  _gaq.push(['_trackPageview']); 
   (function()
    {    
	var ga = document.createElement('script'); ga.type = 'text/javascript';
	 ga.async = true;    
	 ga.src = ('/ap_alter/Public/js/dc.js');    
	 var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);  })();
	 </script>

</body>
</html>