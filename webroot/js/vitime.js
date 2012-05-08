/**
 * 全局函数
 */

jQuery(function(){
	fn_copy();
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
		}
		
	});
}

function fn_copy() {
	var copy_button = document.getElementById('copy_button');
	if(!copy_button){
		return;
	}
	if(window.clipboardData){
		$(copy_button).click(function(){
			window.clipboardData.setData("Text", $('#meeting-content').html());
	        debug_log('复制内容：'+meintext);
	        return alert("已复制到剪贴板");
		});
	} else{
		ZeroClipboard.setMoviePath('/js/ZeroClipboard.swf');
    	var clip = new ZeroClipboard.Client();
    	clip.setHandCursor( true );
    	clip.addEventListener('load', function (client) {
    		debug_log("Flash movie loaded and ready.");
		});

		clip.addEventListener('mouseOver', function (client) {
			clip.setText( $('#meeting-content').html() );
		});

    	clip.addEventListener('complete', function (client, text) {
    		return alert("已复制到剪贴板");
		});
    	clip.glue('copy_button');
    }
    //alert("您的浏览器不支持复制功能，无法完成复制");
    return false;
}



function debug_log(msg) {
	if(console && console.log){
		console.log(msg);
	}
}