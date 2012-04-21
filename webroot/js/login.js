
function admin_login(){
	var form = document.getElementById('loginForm');
	
	form.submit();
}

function login(){
var form = document.getElementById('loginForm');
	
	form.submit();
}

function validForm(form){
	
}

function changeVerify(){
	document.getElementById('verifyCode').src = '/captcha.php?'+new Date().getTime();
}