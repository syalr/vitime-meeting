/**
 * 企业管理员
 */

//会议查看用户
var meeting_user_list = {};
jQuery(function(){
	$('.meeting_row').click(function(){
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
		$('#meeting_user_list').append('<div class="spanUser"><span class="icon icon-freg"></span><span class="username">'+item+'</span></div>');
	});
	$('#meeting_user_list').append('<div class="clearfix"></div>');
	
		
}

//预约会议界面，版定用户选择
jQuery(function(){
	$('#start_time').datepicker();
	$('#left_user_list input:checkbox').live('click',function(){
    	$('#right_user_list').append($(this).parent().remove());
    });

	$('#right_user_list input:checkbox').live('click',function(){
    	$('#left_user_list').append($(this).parent().remove());
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
	
}

//编辑会议
function edit_company_meeting(meeting_id){
	
}
//删除会议
function delete_company_meeting(meeting_id){
	
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
		user_list.push(this.id);
	});
	
	form.user_list = user_list.join(',');
	form.submit();
}

//预约公共会议
function open_public_meeting(){
	window.location.href = '/company/public_reservation';
}