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
<!-- 总行菜单 -->
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
<!-- 订购菜单 -->
				
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
            <!-- <a href="/ap_alter/beijing/order/index"> 待审核订单</a> -->
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
            <a href="/ap_alter/beijing/order/o_checktime">锁定时间</a>
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
<!--数据导出-->                  
<li class="">
        <a href="javascript:;">
        <i class="icon-user"></i> 
        <span class="title">个人中心</span>
        <span class="arrow "></span>
        </a>
        <ul class="sub-menu">
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
							<li><a href="#">用户资料</a></li>
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
							<div class="caption"><i class="icon-reorder"></i>修改资料</div>	
										</div>
			<div class="portlet-body form">	
				<form action="/ap_alter/beijing/user/edit_user" class="horizontal-form" id="form_add" method="post" >
						<div class="row-fluid">
								<div class="us_at ">
										<div class="control-group">
                                              <div class="us_box">
                                                   <label class="user_name"  for="rname">真实姓名</label>
                                              </div>         
								<div class="us_box_ad">
                                     <input type="text" id="rname" name="rname" class="m-wrap span12" value="<?php echo ($edit_user["realname"]); ?>" placeholder="请输入账号">  
                                </div>
                                <div class="txt_add"> <span class="help-block"><i class="icon-star" style="color:#F00;"></i>请填写真是姓名只支持中文不支持字母数字</span></div>
								</div>
							</div>
					</div>	             
               
            <div class="row-fluid">
                <div class="us_at ">
                    <div class="group">
                        <div class="us_box">
                                 <label class="user_name" >性&nbsp;&nbsp;别</label>
                        </div>
                        <div class="us_box_ad"  >
                              <select class="span12 select2_category" id="gender" name="gender" data-placeholder="请在这里选择性别" tabindex="1">             
                              
                                      <option value="1" <?php if(($edit_user["gender"] == 1)): ?>selected="selected"<?php endif; ?>>女</option>
                                      <option value="0" <?php if(($edit_user["gender"] == 0)): ?>selected="selected"<?php endif; ?>>男</option>  
                           
                                      
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
                               <input type="text" id="tel" name="tel" class="m-wrap span12" value="<?php echo ($edit_user["tel"]); ?>" placeholder="010-88888888/13888888888">
						  </div>                                                            
                          <div class="txt_add"> <span class="help-block"><i class="icon-star" style="color:#F00;"></i>联系电话&nbsp;例:010-88888888|13888888888</span></div>
						</div>
					</div>	
             </div> 
		<div class="row-fluid">
			<div class="span6 ">
				<div class="control-group">
                      <div class="us_box">
							<label class="user_name" >Email</label>
                      </div>                                                            
                      <div class="us_box_ad">
                            <input type="text" id="email" name="email" class="m-wrap span12" value="<?php echo ($edit_user["email"]); ?>" placeholder="Email地址">  
					</div>                                                            
                      <div class="txt_add"> <span class="help-block"><i class="icon-star" style="color:#F00;"></i>邮箱地址</span></div>
				</div>
			</div>
	</div>	
                <div class="row-fluid">    
                    <div class="span6 ">    
                        <div class="control-group">
                            <div class="us_box">    
                                 <label class="user_name" >当前密码</label>
                            </div>                            
                            <div class="us_box_ad">    
                                 <input type="password" id="firstpass" name="firstpass" class="m-wrap span12" placeholder="当前密码">
                            </div>                            
                             <div class="txt_add"> <span class="help-block"><i class="icon-star" style="color:#F00;"></i>当前登陆密码</span></div>    
                        </div>    
                    </div> 
                </div>
                <div class="row-fluid">    
                    <div class="span6 ">    
                        <div class="control-group">
                            <div class="us_box">    
                                 <label class="user_name" >新密码</label>
                            </div>                            
                            <div class="us_box_ad">    
                                 <input type="password" id="pass" name="pass" class="m-wrap span12" placeholder="新密码">
                            </div>                            
                            <div class="txt_add"> <span class="help-block"><i class="icon-star" style="color:#F00;"></i>新的6-8位登陆密码</span></div>    
                        </div>    
                    </div> 
                </div> 
                <div class="row-fluid">    
                    <div class="span6 ">    
                        <div class="control-group">
                            <div class="us_box">    
                                 <label class="user_name" >密码确认</label>
                            </div>                            
                            <div class="us_box_ad">    
                                 <input type="password" id="repass" name="repass" class="m-wrap span12" placeholder="密码确认">  
                            </div>                            
                            <div class="txt_add"> <span class="help-block"><i class="icon-star" style="color:#F00;"></i>确认6-8位登陆密码</span></div>    
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
                            <input type="text" id="readdress" name="readdress" class="m-wrap span12" value="<?php echo ($edit_user["sendaddr"]); ?>" placeholder="送货地址">     
                            </div>                            
                            
                        </div>                         
                        <div class="txt_add"> <span class="help-block" style="color:#F00;line-height: 34px;">重要提醒<i class="icon-star" style="color:#F00;"></i>请及时更新联系人和送货地址</span></div>      
                    </div> 
                </div>    
                <div class="form-actions">    
                    <button type="button" class="btn blue" onClick=" return valdata()"><i class="icon-ok"></i>&nbsp;&nbsp; 确&nbsp;&nbsp;定&nbsp;&nbsp;</button>    
                    <button type="button" class="btn">&nbsp;&nbsp;取&nbsp;&nbsp;消&nbsp;&nbsp;</button>    
                </div>    
            </form>										
<script type="text/jscript">
function valdata(){		
	var firstpass = document.getElementById("firstpass");											
		var pass = document.getElementById("pass");
		var repass = document.getElementById("repass");														
		if((firstpass.value).trim()!= ""){															
			if(pass.value.length < 6){
				alert("密码长度不能小于6位");
				return false;
			}
			if((repass.value).trim() == ""){
				alert("请输入确认密码");
				return false;
			}
			if(pass.value != repass.value){
				alert("两次输入密码不同，请重新输入！");
				return false;
			}			
			var ftpass=document.getElementById("firstpass").value;			
			$.get('/ap_alter/beijing/user/checkpwd',{'pwd':ftpass},function(data){		
			
				if(data==1)
				{
					document.getElementById("form_add").submit();
					 alert("修改成功");
				}else
				{
					alert("原密码错误");
					}					
			});
	  }else{	
		document.getElementById("form_add").submit();
		 alert("修改成功");
	  }	 
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
					$.get('/ap_alter/beijing/user/region',{'id':$id},function(data) {
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
				
					$.get('/ap_alter/beijing/user/region',{'id':$id},function(data) {
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