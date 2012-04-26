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
		}
		
	});
}

function fn_copy(meinId) {
    var meintext = document.getElementById(meinId).innerHTML;
    if (window.clipboardData) {
        // the IE-manier
        window.clipboardData.setData("Text", meintext);
        // waarschijnlijk niet de beste manier om Moz/NS te detecteren;
        // het is mij echter onbekend vanaf welke versie dit precies werkt:
        return alert("已复制到剪贴版");
    } else if (window.netscape) {
        try {
            netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
        } catch(e) {
            alert("被浏览器拒绝！\n请在浏览器地址栏输入'about:config'并回车\n然后将'signed.applets.codebase_principal_support'设置为'true'");
        }
        // dit is belangrijk maar staat nergens duidelijk vermeld:
        // you have to sign the code to enable this, or see notes below
        // netscape.security.PrivilegeManager.enablePrivilege('UniversalXPConnect');
        // maak een interface naar het clipboard
        var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);
        if (!clip) return;
        // maak een transferable
        var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);
        if (!trans) return;
        // specificeer wat voor soort data we op willen halen; text in dit geval
        trans.addDataFlavor('text/unicode');
        // om de data uit de transferable te halen hebben we 2 nieuwe objecten
        // nodig om het in op te slaan
        var str = new Object();
        var len = new Object();
        var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);
        var copytext = meintext;
        str.data = copytext;
        trans.setTransferData("text/unicode", str, copytext.length * 2);
        var clipid = Components.interfaces.nsIClipboard;
        if (!clip) return false;
        clip.setData(trans, null, clipid.kGlobalClipboard);
        return alert("已复制到剪贴版");
    }
    alert("您的浏览器不支持复制功能，无法完成复制");
    return false;
}