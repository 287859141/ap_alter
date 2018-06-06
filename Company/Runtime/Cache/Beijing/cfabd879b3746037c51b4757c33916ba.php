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
								<a href="#">用户管理</a>
								<span class="icon-angle-right"></span>
							</li>
							<li><a href="#">编辑用户</a></li>
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
											<div class="caption"><i class="icon-reorder"></i>编辑用户</div>
											<div class="tools">
											</div>
										</div>
                                        <!--/用户名-->
										<div class="portlet-body form">
											<form action="/ap_alter/beijing/member/m_edit" class="horizontal-form" id="form_edit" method="post" >
												<div class="row-fluid">
													<div class="us_at ">
														<div class="control-group">                                                        
                                                                <div class="us_box">
                                                                        <label class="user_name"  for="firstName">用户名</label>
                                                                </div>                                                                
															<div class="us_box_ad">
                                                                     <input type="text" id="name" value="<?php echo ($list["username"]); ?>" name="name" class="m-wrap span12" placeholder="请输入账号">
                                                                     <input type="hidden" name="key" value="<?php echo ($list["id"]); ?>">
															</div>
                                                            <div class="txt_add"> <span class="help-block"><i class="icon-star" style="color:#F00;"></i>用户名以注册成功无法更改</span></div>
														</div>
													</div>
												</div>
												<!--/密码-->
												<div class="row-fluid">
													<div class="us1 ">
														<div class="control-group">
                                                            <div class="us_box">
															        <label class="user_name" >密码</label>
                                                            </div>                                                            
                                                            <div class="us_box_ad">
                                                                     <input type="password" id="pass" name="pass" class="m-wrap span12" placeholder="初始密码">
															</div>                                                            
                                                             <div class="txt_add"> <span class="help-block"><i class="icon-star" style="color:#F00;"></i>为新用户创建一个6-10位初始登陆密码</span></div>
														</div>
													</div>
												</div>
												<!--/密码确认-->  
												<div class="row-fluid">
													<div class="us1 ">
														<div class="control-group">
                                                            <div class="us_box">
															        <label class="user_name" >密码确认</label>
                                                            </div>
                                                            
                                                            <div class="us_box_ad">
                                                                     <input type="password" id="repass" name="repass" class="m-wrap span12" placeholder="密码确认">
															</div>                                                            
                                                              <div class="txt_add"> <span class="help-block"><i class="icon-star" style="color:#F00;"></i>确认6-10位初始登陆密码</span></div>
														</div>
													</div>
												</div>
												<!--/真实姓名--> 
                                               <div class="row-fluid">
													<div class="us1 ">
														<div class="control-group">
                                                            <div class="us_box">
															        <label class="user_name" >真实姓名</label>
                                                            </div>                                                            
                                                            <div class="us_box_ad">
                                                                     <input type="text" value="<?php echo ($list["realname"]); ?>" id="rname" name="rname" class="m-wrap span12" placeholder="真实姓名"> 
															</div>                                                            
                                                             <div class="txt_add"> <span class="help-block"><i class="icon-star" style="color:#F00;"></i>真实姓名</span></div>
														</div>
													</div>	
											  </div>
                                                <!--/性别--> 
                                               <div class="row-fluid">
													<div class="us1 ">
														<div class="control-group">
                                                            <div class="us_box">
															        <label class="user_name" >性&nbsp;&nbsp;别</label>
                                                            </div>                                                            
                                                            <div class="us_box_ad">                                                                     
                                                              <select class="span12 select2_category" id="gender" name="gender" data-placeholder="请在这里选择性别" tabindex="1">
																	 <option value="1" <?php if(($list["gender"] == 1)): ?>selected="selected"<?php endif; ?>>女</option>
                                                                      <option value="0" <?php if(($list["gender"] == 0)): ?>selected="selected"<?php endif; ?>>男</option>  
															  </select>   
															</div>                                                            
                                                             <div class="txt_add"> <span class="help-block"><i class="icon-star" style="color:#F00;"></i>这里选择性别</span></div>
														</div>
													</div>	
											  </div>
											  <!--所属部门-->     
												<div class="row-fluid">
													<div class="span6 ">
														<div class="control-group">
                                                            <div class="us_box">
															        <label class="user_name" >所属部门</label>
                                                            </div>                                                            
                                                            <div class="us_box_ad">
                                                                     <input type="text" id="department" name="department" class="m-wrap span12"  value="<?php echo ($list["department"]); ?>">
															</div>                                                            
                                                           <div class="txt_add"> <span class="help-block"><i class="icon-star" style="color:#F00;"></i>填写所属部门</span></div>
														</div>
													</div>
												</div>
												<!--/所属企业-->  
                                            	<div class="row-fluid">
													<div class="us1 ">
														<div class="control-group">
                                                            <div class="us_box">
															         <label class="user_name" >所属企业</label>
                                                            </div>
															<div class="us_box_ad"  >
																<select class="span12 select2_category"  id="cpny" name="cpny" data-placeholder="请在这里选择一个角色权限" tabindex="1">
																	<?php if(is_array($lisc)): $i = 0; $__LIST__ = $lisc;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$company): $mod = ($i % 2 );++$i;?><option value="<?php echo ($company["id"]); ?>" selected   ><?php echo ($company["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>	
																</select>
															</div>
                                                            <div class="txt_add"> <span class="help-block"><i class="icon-star" style="color:#F00;"></i>所属企业</span></div>
														</div>
													</div>	
												</div>
												<!--/角色权限--> 
												<div class="row-fluid">
													<div class="us1 ">
														<div class="control-group">
                                                            <div class="us_box">
															         <label class="auser_name" >角色权限</label>
                                                            </div>
															<div class="us_box_ad"  >
																<select class="span12 select2_category" id="role" name="role" data-placeholder="请在这里选择一个角色权限" tabindex="1">																	
                                                                       <?php if(is_array($grouparr)): $i = 0; $__LIST__ = $grouparr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$grouparr): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" ><?php echo ($grouparr); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
																</select>
															</div>
														</div>
													</div>
												</div>
                                                 <div class="row-fluid">
                                                    <div class="span6 ">
                                                        <div class="control-group">
                                                              <div class="us_box">
                                                                    <label class="user_name" >电话</label>
                                                              </div>                                                            
                                                              <div class="us_box_ad">
                                                                   <input type="text" id="tel" name="tel" class="m-wrap span12" value="<?php echo ($list["tel"]); ?>" placeholder="010-88888888/13888888888">
                                                              </div>                                                            
                                                              <div class="txt_add"> <span class="help-block"><i class="icon-star" style="color:#F00;"></i>联系电话&nbsp;例:010-88888888|13888888888</span></div>
                                                            </div>
                                                        </div>	
                                                 </div> 
                                                <div class="row-fluid">    
                                                <div class="span6 ">    
                                                    <div class="control-group">
                                                            <div class="us_box">    
                                                                 <label class="user_name" >送货地址</label>
                                                            </div>                            
                                                            <div class="us_box_ads">  
                                                            <select id="provinces" onChange="prechange()">
                                                            <option value="">请选择省份</option>
                                                            <?php if(is_array($reglists)): $i = 0; $__LIST__ = $reglists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$re): $mod = ($i % 2 );++$i;?><option value="<?php echo ($re["id"]); ?>"   ><?php echo ($re["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                            </select>                          
                                                            <select id="citys" onChange="citychange()" >
                                                            <option value="">请选择市</option>
                                                            </select> 
                                                            <select id="countys" name="countys" onChange="countyschange()">
                                                            <option value="">请选择县</option>
                                                            </select>
                                                            <input type="text" id="readdress" name="readdress" class="m-wrap span12" value="<?php echo ($list["sendaddr"]); ?>" placeholder="送货地址">     
                                                            </div>                            
                                                    </div>                         
                                                       
                                                    <div class="txt_add">
                                                     <span class="help-block" style="color:#F00;line-height: 34px;">重要提醒<i class="icon-star" style="color:#F00;"></i>请及时更新联系人和送货地址</span>
                                                     </div>      
                                               </div>
                                     </div>
												<div class="form-actions">
													<button type="button" class="btn blue" onClick=" return valdata()"><i class="icon-ok"></i>&nbsp;&nbsp; 确&nbsp;&nbsp;定&nbsp;&nbsp;</button>
													<button type="button" class="btn">&nbsp;&nbsp;取&nbsp;&nbsp;消&nbsp;&nbsp;</button>
												</div>
											</form>							 
<script type="text/jscript">

function valdata(){
		
		var name = document.getElementById("name");
		var department = document.getElementById("department");
		var pass = document.getElementById("cpny");															
		var role = document.getElementsByName("role").item(0);
		if(name.value.trim() == ""){														        
			alert("用户名不能为空");
			return false;
		}

		if((cpny.value).trim() == ""){
			alert("请选择所属企业");
			return false;
		}
		if(department.value.trim() == ""){
			alert("所在部门不能为空");
			return false;
		}
		if((role.value).trim() == ""){
			alert("请选择用户权限");
			return false;
		}
		document.getElementById("form_edit").submit();
}
 function isNull(arg1)
	{
	 return !arg1 && arg1!==0 && typeof arg1!=="boolean"?true:false;
	}

</script>
<script type="text/javascript">
           var readdress=document.getElementById("readdress");
                
                function prechange() {
					$id=document.getElementById("provinces").value;
					var options=$("#provinces option:selected");  //获取选中的项				
					readdress.value=options.text()+" ";
					$.get('/ap_alter/beijing/member/region',{'id':$id},function(data) {
                            $("#citys").html("<option value=''>请选择市</option>");
							 var json = eval('(' + data + ')');                             var reglist=json.reglist;
							 for(var i=0;i<reglist.length;i++){
								 $("#citys").append("<option value='" + reglist[i].id + "'>" + reglist[i].name + "</option>");
								 }
                           
                   
                    });
				}

              function citychange() {
                   $id=document.getElementById("citys").value;
				   var options=$("#citys option:selected");  //获取选中的项
				   var $readdress=readdress.value;
				   var dressarr=$readdress.split(' ');
				   if(dressarr.length>2){
					   dressarr[1]=options.text();
					   var ddress=dressarr.toString();
					   document.getElementById("readdress").value= dressarr[0]+" "+dressarr[1]+" ";
				   }else{
					document.getElementById("readdress").value=document.getElementById("readdress").value+options.text()+" ";
				   }
				
					$.get('/ap_alter/beijing/member/region',{'id':$id},function(data) {
                            $("#countys").html("<option value=''>请选择市</option>");
							 var json = eval('(' + data + ')');                             var reglist=json.reglist;
							 for(var i=0;i<reglist.length;i++){
								 $("#countys").append("<option value='" + reglist[i].id + "'>" + reglist[i].name + "</option>");
								 }
                           
                   
                    });
				}
				function countyschange()
				{
					var options=$("#countys option:selected");  //获取选中的项				
					var $readdress=readdress.value;
				  	var dressarr=$readdress.split(' ');
				   if(dressarr.length>3){
					   dressarr[2]=options.text();
					  var ddress=dressarr.toString();
					   document.getElementById("readdress").value=dressarr[0]+" "+dressarr[1]+" "+dressarr[2]+" ";
				   }else{
					document.getElementById("readdress").value=document.getElementById("readdress").value+options.text()+" ";
				   }
				
				
					}
        </script>

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
	jQuery(document).ready(function() {    
	   // initiate layout and plugins
	   App.init();
	   FormSamples.init();
	});
</script> 
<script type="text/javascript">  var _gaq = _gaq || [];  _gaq.push(['_setAccount', 'UA-37564768-1']);  _gaq.push(['_setDomainName', 'keenthemes.com']);  _gaq.push(['_setAllowLinker', true]);  _gaq.push(['_trackPageview']);  (function() {    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);  })();</script>
</body>
</html>