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
								<a href="#">产品订购</a>
								<span class="icon-angle-right"></span>
							</li>
							<li><a href="#">快捷下单</a></li>
						</ul>
					</div>
				</div>                              
<table width=100%  border=0 cellspacing=0 cellpadding=0>
<tr>
	<td height="30">	
		<input type="text" name="skey" id="skey" value="<?php echo ($skey); ?>" placeholder="搜索编号或产品名称" style="width:220px; height:30px;">&nbsp;
			<select name="ptid" id="select_tab"  >
            <option value="0"  >全部分类</option>
            <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pttype): $mod = ($i % 2 );++$i;?><option value="<?php echo ($pttype["ptid"]); ?>" <?php if(($pttype["ptid"] == $ptid)): ?>selected="selected"<?php endif; ?> ><?php echo ($pttype["ptname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
		<input  type="button" onClick="searchval()" value='搜&nbsp;&nbsp;&nbsp;&nbsp;索' style="height:30px">
	</td>
</tr>
</table>
<div class="portlet box blue">
      <div  class="portlet-title">
            <div class="caption" name='$ordersee'><i class="icon-reorder" ></i>全部产品</div>
                        <div class="tools">
                        </div>
			</div>  
               <div class="portlet-body form" >
                                <div id="product">
                                <form action="/ap_alter/beijing/order/o_ordernew_confirm" class="horizontal-form" id="from_adorder" method="post">                                        
        <table width="100%">
          <tr>
                    <?php echo ($orderform_locktime_str); ?> 
                    <TD colspan="20" height="40" align="right">
                    <input type="button" id="button"  onClick="together()" value="添加选中的产品" style="height:25px;width:200px">&nbsp;&nbsp;<input type="hidden" id="ordertype" value="<?php echo ($ordertype); ?>"/><input type="hidden" id="idlist" name="idlist" /><input type="hidden" id="idvar" name="idvar" /><input type="hidden" name="amountkc" id="amountkc"/>
                    </TD> 
                   </tr>
                   <tr height="45" style=" font-family:'微软雅黑'; font-size:14px; font-weight:500; color:#557abb;">
                           <td width="12%" style="text-align:center">编号</td>
                           <td width="32%" style="text-align:left">产品名称</td>
                           <td width="15%" style="text-align:center">所属分类</td>
                           <!--<td width="8%" style="text-align:center">库存数量</td>-->
                           <td width="8%" style="text-align:center">订购上限</td>
                           <td width="12%" style="text-align:center">订购数量</td>
                           <td width="15%" style="text-align:center">包装规格</td>
                   </tr>
               <?php if(is_array($plist)): $i = 0; $__LIST__ = $plist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$plist): $mod = ($i % 2 );++$i;?><tr id="user_table">
                      <td height="35" style="text-align:center">                       
				 <?php if(($plist["patternurlurl"] != '')): ?><a width="50" height="50" onClick="showchangetime('<?php echo ($plist["name"]); ?>','<?php echo ($plist["pnum"]); ?>','<?php echo ($plist["patternurlurl"]); ?>')" title="点击查看大图" style="border:1px solid #F00;"><?php echo ($plist["pnum"]); ?> </a>
                       <?php else: ?>
                        <?php echo ($plist["pnum"]); endif; ?>
                      </td>
                      <td height="35" style="float:left; line-height:40px;" ><?php echo ($plist["name"]); ?></td>
                      <td height="35" style="text-align:center" ><?php echo ($plist["ptname"]); ?></td>
                     <!-- <td height="35" style="text-align:center" ><?php echo ($plist["aunt"]); ?></td>-->
                      <td height="35" style="text-align:center" >
                      <?php echo ($plist["limiamount"]); ?>
                     <input type='hidden' id='limit_<?php echo ($plist['id']); ?>' value='<?php echo ($plist["limiamount"]); ?>' >
                      </td>
                      <td height="35" style="text-align:center" >
                      <?php if(($plist["iszero"] == 1) ): ?>无法订购
                      <?php else: ?>
                      <input type='hidden' name='id[]' value='<?php echo ($plist['id']); ?>'>
                      <input type='hidden' name='amount_kc[]' value='<?php echo ($plist["amount"]); ?>' id='kc_<?php echo ($plist['id']); ?>'>
                      <input type='text' name='amount[]' style='width:50px;text-align:right;' value='' id='sq_<?php echo ($plist['id']); ?>' onmouseover='this.select()' onBlur="changeval(<?php echo ($plist['id']); ?>)">
                       <?php echo ($plist["unit"]); ?>&nbsp;&nbsp;<?php endif; ?>
                      </td>
                      <td height="35" style="text-align:center" >
                     <?php echo ($plist["baozhuangguige"]); ?>
                      </td> 
       </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
        </form>
        <div class="od_ed_at">
		</div>
<script>

function changeval(id)
{
	var ordertypes=document.getElementById("ordertype");
	if(ordertypes.value=="1"){
		var kcnum=parseInt(document.getElementById("kc_"+id).value);
		var sqnum=parseInt(document.getElementById("sq_"+id).value);
		if(sqnum>kcnum)
		{
			alert("订购数量请不要超出库存数量");
			document.getElementById("sq_"+id).value=kcnum;
		}
	}
	var ltnums=parseInt(document.getElementById("limit_"+id).value);
	var sqnums=parseInt(document.getElementById("sq_"+id).value);
	if((ltnums>0)&&(sqnums>ltnums))
	{
		alert("订购数量请不要超出订购上限");
		document.getElementById("sq_"+id).value=ltnums;
	}
	}
	function valdata(){
	//document.getElementById("from_adorder").submit();
	}
</script>
<script>
function together(){	    
//获取所有已选中产品
    var ids;
	var idvars;
	var mtkcs;
	$("input[name*='id[]']").each(function(){
	   id = $(this).val();
       var isempty=document.getElementById("sq_"+id).value;
	   var mtkc=document.getElementById("kc_"+id).value;
       if(isempty.replace(/(^s*)|(s*$)/g, "").length >0 && isempty!=0)//不为空
       {
		    if(typeof(ids) == "undefined"){
            ids=id;   
			idvars=isempty; 
			mtkcs=mtkc;   
       } else{
		       ids+=","+id;
			   idvars+=","+isempty;
			   mtkcs+=","+mtkc;
			   
		   } }
	});   
	//alert(ids);
document.getElementById("idlist").value=ids;
document.getElementById("idvar").value=idvars;
document.getElementById("amountkc").value=mtkcs;
  $.get('/ap_alter/beijing/order/o_ordernew_check',{'idlist':ids},function(data){

            if(data==0){
                document.getElementById("from_adorder").submit();
                }else{
                 if(window.confirm('产品已存在，确定合并数量吗？'))
        			{
        			 document.getElementById("from_adorder").submit();
        		    }
                }    				
		});
        return false;
}
</script>
			</div>
		</div>
	</div>
 <div class="TB_overlayBG" id="TB_overlay" style=" position: fixed; z-index: 100;top: 0;left: 0; height: 100%; width: 100%;background-color: #000;opacity: 0.75; display:none;"></div>

                <div id="showdiv" style=" position:absolute; left:50%; top:50%;width:1024px; height:auto; background:#ffffff; display:none; z-index:1000"><div style="width:100%; background-color:#4b8df8;  font-size: 14px; color:white; height:30px; line-height:30px; font-family:微软雅黑;font-weight:500;">&nbsp;&nbsp;产品名称&nbsp;&nbsp;<span id="productname"><?php echo ($product["name"]); ?></span>&nbsp;&nbsp;版号&nbsp;&nbsp;<span id="clienname"><?php echo ($product["versionnumber"]); ?></span>的效果图<div style="float:right; padding-right:5px;"><a href="javascript:closechangetime()" style="color:white;">关闭</a></div></div>

                 <div  style="width:95%; text-align:center; margin-top:10px;" id="fullpicshow">
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
var showdiv=document.getElementById("showdiv");
var TB_overlay=document.getElementById("TB_overlay");
var fullpicshow=document.getElementById("fullpicshow");
var productname=document.getElementById("productname");
var cliennumber=document.getElementById("clienname");
//productname,,,clienname
function showchangetime(name,num,$pic)
		{			
			showdiv.style.display="block";
			TB_overlay.style.display="block";
			showdiv.style.marginLeft = "-512px" ;
			showdiv.style.marginTop = -230+document.documentElement.scrollTop+"px";
			fullpicshow.innerHTML="<img src=\"/ap_alter/Uploads/"+$pic+"\" width=\"1000\" height=\"auto\">";
			productname.innerHTML=name;
			cliennumber.innerHTML=num;
		}
function searchval()
{
	$skey=document.getElementById("skey");
	$select_tab=document.getElementById("select_tab");
	window.location="/ap_alter/beijing/order/o_ordernew/ptid/"+$select_tab.value+"/skey/"+$skey.value;
}	
		function closechangetime()
		{
			showdiv.style.display="none";	
			TB_overlay.style.display="none";
			showdiv.style.marginLeft = "0" ;
			showdiv.style.marginTop = "0px";
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