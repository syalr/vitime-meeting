<?php if($is_login):?>
    <div class="nav">
    	<ul>
        	<li><a href="/company/listuser" class="<?php echo ($_action=='listuser' || $_action=='index'?'selected':'');?>">用户管理</a></li>
            <li><a href="/company/adduser" class="<?php echo ($_action=='adduser'?'selected':'');?>">添加用户</a></li>
<!--            <li><a href="/company/deluser" class="<?php echo ($_action=='deluser'?'selected':'');?>">删除</a></li>-->
			<li><a href="/company/company_meeting" class="<?php echo ($_action=='company_meeting'?'selected':'');?>">企业会议室</a></li>
            <li><a href="/company/public_meeting" class="<?php echo ($_action=='public_meeting'?'selected':'');?>">公共会议室</a></li>
        </ul>
    </div>
<?php endif;?>