<?php if (!defined('THINK_PATH')) exit();?>
	<div class="header navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="brand" href="index.html">
				<img src="/ap_alter/Public/image/logo.png" alt="logo"/>
				</a>
				<a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
				<img src="/ap_alter/Public/image/menu-toggler.png" alt="" />
				</a> 
				<ul class="nav pull-right">
					<li class="dropdown" id="header_notification_bar">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-bell" id="kcyj" style="color:#fcb322;"></i>
						<span class="badge"><?php echo ($gonggaonum); ?></span>
                         <h3 class="dropdown-txt">最新公告</h3>
						</a> 
						<ul class="dropdown-menu extended notification">
							<li class="external">
								<a href="/ap_alter/beijing/notice/index">查看详细<i class="m-icon-swapright"></i></a>
							</li>
						</ul>
					</li>
                     <?php if(($groups == 15) OR ($groups == 9) OR ($groups == 81) OR ($groups == 82) ): ?><li class="dropdown" id="header_inbox_bar">
						<a href="/ap_alter/beijing/order/index" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-envelope"></i>
						<span class="badge"><?php echo ($pronewnum); ?></span>
                        <h3 class="dropdown-txt">新增订单</h3>
						</a>
						<ul class="dropdown-menu extended inbox">
							<li class="external">
								<a href="/ap_alter/beijing/order/index">产看详情<i class="m-icon-swapright"></i></a>
							</li>
						</ul>
					</li><?php endif; ?>
					<li class="dropdown user">

						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php if(($usergender["gender"] == 0)): ?><img alt="" src="/ap_alter/Public/image/avatarnan_small.jpg" /><?php endif; ?>
                         <?php if(($usergender["gender"] == 1)): ?><img alt="" src="/ap_alter/Public/image/avatarnv_small.jpg" /><?php endif; ?>
						<span class="username"><?php echo ($listu); ?>&nbsp;<?php echo ($gname); ?></span>

						<i class="icon-angle-down"></i>

						</a>
						<ul class="dropdown-menu">
                            <?php if(($groups == 15)||($groups == 9)): ?><li><a href="/ap_alter/beijing/notice/index"><i class="icon-bell"></i> 公告管理</a></li><?php endif; ?>
							<li><a href="/ap_alter/beijing/user/edit_user"><i class="icon-user"></i> 个人信息</a></li>
							<li><a href="/ap_alter/beijing/user/my_user_log"><i class="icon-tasks"></i> 操作日志</a></li>							
							<li><a href="/ap_alter/beijing/index/unlogin"><i class="icon-key"></i> 安全退出</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>