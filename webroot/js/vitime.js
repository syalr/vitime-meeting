/**
 * 全局函数
 */

jQuery(function(){
	
});


/**
 * 配置表单验证
 */
function loadFormValid(){
	$(".validform").Validform({//所有可传入的参数如下;
		btnSubmit:"#btn_sub",
		tiptype:1,
		tipSweep:true,
		showAllError:false,
		postonce:true,
		ajaxPost:true,
		datatype:{//传入自定义datatype类型，可以是正则，也可以是函数（函数内可以获得两个参数）;
			"*6-16": /^[^\s]{6,20}$/,
			"z2-4" : /^[\u4E00-\u9FA5\uf900-\ufa2d]{2,4}$/,
			"username":function(gets,obj){
				//参数gets是获取到的表单元素值，obj为当前表单对象;
				var reg1=/^[\w\.]{4,16}$/,
				reg2=/^[\u4E00-\u9FA5\uf900-\ufa2d]{2,8}$/;
	 
				if(reg1.test(gets)){return true;}
				if(reg2.test(gets)){return true;}
				return false;
			}
		},
		
	});
}