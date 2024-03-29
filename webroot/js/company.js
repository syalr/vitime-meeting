/**
 * 企业管理员
 */

//会议查看用户
var meeting_user_list = {};
jQuery(function(){
	$('.meeting_row').click(function(){
		$('.selected-tr').removeClass('selected-tr');
		$(this).addClass('selected-tr');
		var id = this.id.split('-').pop();
		if(typeof(meeting_user_list[id]) == 'object' && meeting_user_list[id].length >0){
			return render_meeting_user_list(meeting_user_list[id]);
		}
		$.getJSON('/company/get_meeting_user_list/'+id,function(list){
			if(typeof(list)=='object' && list.length>0){
				meeting_user_list[id] = list;
			}
			render_meeting_user_list(list);
		});
	});
});
//渲染用户
function render_meeting_user_list(list){
	$('#meeting_user_list').empty();
	$.each(list ,function(index,item){
		$('#meeting_user_list').append('<div class="spanUser"><span class="icon icon-freg"></span><span class="username">'+((item.name!='')?item.name:item.username)+'</span></div>');
	});
	$('#meeting_user_list').append('<div class="clearfix"></div>').parent().parent().show();;
	
		
}

//预约会议界面，版定用户选择
jQuery(function(){
	if($('#start_time').length >0){
		$('#start_time').datepicker();
	}
	$('#left_user_list input:checkbox').live('click',function(){
    	$('#right_user_list').append($(this).attr('checked',true).parent().remove());
    });

	$('#right_user_list input:checkbox').live('click',function(){
    	$('#left_user_list').append($(this).attr('checked',false).parent().remove());
    });
});

//跳转到更新用户资料
function update_company_user(user_id){
	window.location.href = '/company/update_user/'+user_id;
}

function delete_company_user(user_id){
	if(!confirm("您确定要删除该用户？")){
		return false;
	}
	jQuery.post('/company/do_delete_user',{user_id:user_id},function(response){
		try{
			eval('response = '+response);
		}catch(ex){
			alert("发生了错误");
		}
		if(response.status == 1){
			alert(response.msg);
			window.location.reload();
		}else{
			alert(response.msg);
		}
	});
	
}

//进入会议
function enter_meeting(meeting_id){
	window.location.href = '/meeting/index/'+meeting_id;
}

//编辑会议
function edit_company_meeting(meeting_id){
	window.location.href = '/company/edit_company_reservation/'+meeting_id;	
}
//编辑会议
function edit_public_meeting(meeting_id){
	window.location.href = '/company/edit_public_reservation/'+meeting_id;	
}
//删除会议
function delete_company_meeting(meeting_id){
	if(meeting_id == ''){
		alert('参数错误');
		return;
	}
	if(!confirm('您确定要取消该会议吗？')){
		return false;
	}
	$.post('/company/delete_meeting',{meet_id:meeting_id},function(res){
		try{
			eval('res='+res);
		}catch(ex){
			alert('发送错误了！');
		}
		if(res.status == 1){
			alert(res.msg);
			window.location.reload();
		}else{
			alert(res.msg);
		}
	});
}

//预约会议
function open_meeting(){
	window.location.href = '/company/company_reservation';
}

function do_open_meeting(form){
	if($.trim(form.title.value) == ""){
		alert('会议主题不能为空');
		return false;
	}
	if($.trim(form.start_time.value) ==''){
		alert('会议开始时间必须填写');
		return false;
	}
	
	var user_list = [];
	$('#right_user_list input:checked').each(function(){
		user_list.push(this.value);
	});
	
	form.user_list.value = user_list.join(',');
	form.submit();
}

//预约公共会议
function open_public_meeting(){
	window.location.href = '/company/public_reservation';
}


function do_open_public_meeting(form){
	if($.trim(form.title.value) == ""){
		alert('会议主题不能为空');
		return false;
	}
	if($.trim(form.start_time.value) ==''){
		alert('会议开始时间必须填写');
		return false;
	}
	if($.trim(form.start_time.value) ==''){
		alert('会议开始时间必须填写');
		return false;
	}
	
	form.submit();
}


function do_edit_public_meeting(form){
	if($.trim(form.title.value) == ""){
		alert('会议主题不能为空');
		return false;
	}
	if($.trim(form.start_time.value) ==''){
		alert('会议开始时间必须填写');
		return false;
	}
	if($.trim(form.start_time.value) ==''){
		alert('会议开始时间必须填写');
		return false;
	}
	
	form.submit();
}

function do_edit_meeting(form){
	if($.trim(form.title.value) == ""){
		alert('会议主题不能为空');
		return false;
	}
	if($.trim(form.start_time.value) ==''){
		alert('会议开始时间必须填写');
		return false;
	}
	
	var user_list = [];
	$('#right_user_list input:checked').each(function(){
		user_list.push(this.value);
	});
	
	form.user_list.value = user_list.join(',');
	form.submit();
}

function validateCPWDForm(form){
	if(form.password.value == ''){
		alert('原密码不能为空');
		return false;
	}
	if(form.newpassword.value== ''){
		alert('新密码不能为空');
		return false;
	}
	
	if(form.newpassword.value != form.renewpassword.value){
		alert('两次密码输入不一致，请重新输入');
		return false;
	}
	return true;
}

function validateUpUserForm(form){
	if(form.password.value != ''){
		if(form.repassword.value!= form.password.value){
			alert('两次密码输入不一致，请重新输入');
			return false;
		}
	}
	
	
	return true;
}

function validateAddUserForm(form){
	if($.trim(form.username.value) == ""){
		alert('请输入用户名');
		$('#username_ftip').show().find('.attTip').addClass('errorTip');
		return false;
	}else{
		$('#username_ftip .attTip').removeClass('errorTip');
	}
	
	if($.trim(form.password.value) == ""){
		alert('请输入密码');
		$('#password_ftip').show().find('.attTip').addClass('errorTip');
		return false;
	}else{
		$('#password_ftip .attTip').removeClass('errorTip');
	}
	
	if(form.password.value != form.repassword.value){
		alert('两次密码输入不一致，请重新输入');
		$('#repassword_ftip').show().find('.attTip').addClass('errorTip');
		return false;
	}else{
		$('#repassword_ftip .attTip').removeClass('errorTip');
	}
	
	if(form.mobile.value==''){
		alert('请输入手机号码');
		$('#mobile_ftip').show().find('.attTip').addClass('errorTip');
		return false;
	}else{
		$('#mobile_ftip .attTip').removeClass('errorTip');
	}
	
	if(form.email.value==''){
		alert('请输入邮箱地址');
		$('#email_ftip').show().find('.attTip').addClass('errorTip');
		return false;
	}else{
		$('#email_ftip .attTip').removeClass('errorTip');
	}
	return true;
}