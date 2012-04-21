<!doctype html>
<html>
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content=""> 
    <meta name="keywords" content=""> 
    <title>微泰移动视频会议系统-<?php echo $title?></title>  
	<link rel="stylesheet" type="text/css" href="/css/style.css" />
	<script src='/js/lib/jquery.min.js'></script>
	<script src='/js/vitime.js'></script>
</head>
<body>
	<div class="regTop">
    	<div class="logo">
        	<img src="/images/logo.png" alt="微泰移动视频会议系统"/>
            <span class="logoTxt">微泰移动视频会议系统</span>
        </div>
        <?php if($is_login):?>
        <div class="userBox">
        	<div class="userInfo">欢迎回来,<?php echo (!empty($login_user->company['company_name'])?$login_user->company['company_name']:$login_user->username)?></div>
            <div class="userBtn">
            	<a href="#" class="btn btnAc">帐号</a><a href="#" class="btn btnBuy">充值</a><a href="/members/logout" class="btn btnExit">退出</a>
            </div>
        </div>
        <?php endif;?>
    </div>
