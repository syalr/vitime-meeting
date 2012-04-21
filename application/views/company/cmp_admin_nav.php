<?php if($is_login):?>
    <div class="nav">
    	<ul>
        	<li><a href="/company/listuser" class="<?php echo ($_action=='listuser' || $_action=='index'?'selected':'');?>">用户管理</a></li>
            <li><a href="/company/adduser" class="<?php echo ($_action=='adduser'?'selected':'');?>">添加用户</a></li>
            <li><a href="/company/deluser" class="<?php echo ($_action=='deluser'?'selected':'');?>">删除</a></li>
        </ul>
    </div>
<?php endif;?>