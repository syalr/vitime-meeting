<script src='/js/mymeeting.js'></script>
<?php if($is_login):?>
    <div class="nav">
    	<ul>
			<li><a href="/mymeeting/company_meeting" class="<?php echo ($_action=='company_meeting'?'selected':'');?>">企业会议室</a></li>
            <li><a href="/mymeeting/public_meeting" class="<?php echo ($_action=='public_meeting'?'selected':'');?>">公共会议室</a></li>
            <li><a href="/mymeeting/change_password" class="<?php echo ($_action=='change_password'?'selected':'');?>">修改密码</a></li>
        </ul>
    </div>
<?php endif;?>