<!doctype html>
<html>
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta HTTP-EQUIV="pragma" CONTENT="no-cache"> 
	<meta HTTP-EQUIV="Cache-Control" CONTENT="no-store, must-revalidate">
	<meta HTTP-EQUIV="expires" CONTENT="Wed, 26 Feb 1997 08:21:57 GMT">
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
        	<div class="userInfo"><a href="/<?php echo strtolower($_controller)?>/update_info" style='color:white;padding:2px;border:1px solid'>修改个人资料</a>,<a href="/<?php echo strtolower($_controller)?>/change_password" style='color:white;padding:2px;border:1px solid'>修改密码</a>,欢迎回来,<?php echo $login_user->username?></div>
            <div class="userBtn">
            	<a class="btn btnExit" href="/" style="margin-right:10px;">首页</a><a href="#" class="btn btnAc">帐号</a><a href="#" class="btn btnBuy">充值</a><a href="/members/logout" class="btn btnExit">退出</a>
            </div>
        </div>
        <?php else:?>
        <div class="userBox">
        <div class="userInfo">&nbsp;</div>
            <div class="userBtn">
            	<a href="/" class="btn btnExit">首页</a>
            </div>
        </div>
        <?php endif;?>
    </div>
