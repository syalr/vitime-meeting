<script src='/js/mymeeting.js'></script>
<?php if($is_login):?>
    <div class="nav">
    	<ul>
			<li><a href="/company/company_meeting" class="<?php echo ($_action=='company_meeting'?'selected':'');?>">企业会议室</a></li>
            <li><a href="/company/public_meeting" class="<?php echo ($_action=='public_meeting'?'selected':'');?>">公共会议室</a></li>
        </ul>
    </div>
<?php endif;?>