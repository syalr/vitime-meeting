﻿
var PageName = '注册界面';
var PageId = 'f5a0facd63554f528d5c50d656a60abe'
var PageUrl = '注册界面.html'
document.title = '注册界面';
var PageNotes = 
{
"pageName":"注册界面",
"showNotesNames":"False"}
var $OnLoadVariable = '';

var $CSUM;

var hasQuery = false;
var query = window.location.hash.substring(1);
if (query.length > 0) hasQuery = true;
var vars = query.split("&");
for (var i = 0; i < vars.length; i++) {
    var pair = vars[i].split("=");
    if (pair[0].length > 0) eval("$" + pair[0] + " = decodeURIComponent(pair[1]);");
} 

if (hasQuery && $CSUM != 1) {
alert('Prototype Warning: The variable values were too long to pass to this page.\nIf you are using IE, using Firefox will support more data.');
}

function GetQuerystring() {
    return '#OnLoadVariable=' + encodeURIComponent($OnLoadVariable) + '&CSUM=1';
}

function PopulateVariables(value) {
    var d = new Date();
  value = value.replace(/\[\[OnLoadVariable\]\]/g, $OnLoadVariable);
  value = value.replace(/\[\[PageName\]\]/g, PageName);
  value = value.replace(/\[\[GenDay\]\]/g, '13');
  value = value.replace(/\[\[GenMonth\]\]/g, '6');
  value = value.replace(/\[\[GenMonthName\]\]/g, '六月');
  value = value.replace(/\[\[GenDayOfWeek\]\]/g, '星期三');
  value = value.replace(/\[\[GenYear\]\]/g, '2012');
  value = value.replace(/\[\[Day\]\]/g, d.getDate());
  value = value.replace(/\[\[Month\]\]/g, d.getMonth() + 1);
  value = value.replace(/\[\[MonthName\]\]/g, GetMonthString(d.getMonth()));
  value = value.replace(/\[\[DayOfWeek\]\]/g, GetDayString(d.getDay()));
  value = value.replace(/\[\[Year\]\]/g, d.getFullYear());
  return value;
}

function OnLoad(e) {

}

var u21 = document.getElementById('u21');

var u51 = document.getElementById('u51');

var u25 = document.getElementById('u25');
gv_vAlignTable['u25'] = 'center';
var u16 = document.getElementById('u16');
gv_vAlignTable['u16'] = 'top';
var u55 = document.getElementById('u55');

var u46 = document.getElementById('u46');

var u31 = document.getElementById('u31');

var u38 = document.getElementById('u38');
gv_vAlignTable['u38'] = 'top';
var u32 = document.getElementById('u32');

u32.style.cursor = 'pointer';
if (bIE) u32.attachEvent("onclick", Clicku32);
else u32.addEventListener("click", Clicku32, true);
function Clicku32(e)
{
windowEvent = e;


if (true) {

	SetPanelVisibility('u41','','none',500);

}

}

var u23 = document.getElementById('u23');

var u62 = document.getElementById('u62');
gv_vAlignTable['u62'] = 'top';
var u53 = document.getElementById('u53');

var u1 = document.getElementById('u1');
gv_vAlignTable['u1'] = 'center';
var u4 = document.getElementById('u4');
gv_vAlignTable['u4'] = 'center';
var u7 = document.getElementById('u7');

var u66 = document.getElementById('u66');
gv_vAlignTable['u66'] = 'top';
var u30 = document.getElementById('u30');
gv_vAlignTable['u30'] = 'top';
var u8 = document.getElementById('u8');
gv_vAlignTable['u8'] = 'center';
var u60 = document.getElementById('u60');

u60.style.cursor = 'pointer';
if (bIE) u60.attachEvent("onclick", Clicku60);
else u60.addEventListener("click", Clicku60, true);
function Clicku60(e)
{
windowEvent = e;


if (true) {

	self.location.href="管理员登录界面.html" + GetQuerystring();

}

}

var u34 = document.getElementById('u34');

u34.style.cursor = 'pointer';
if (bIE) u34.attachEvent("onclick", Clicku34);
else u34.addEventListener("click", Clicku34, true);
function Clicku34(e)
{
windowEvent = e;


if (true) {

	self.location.href="系统介绍.html" + GetQuerystring();

}

}

var u17 = document.getElementById('u17');

var u64 = document.getElementById('u64');
gv_vAlignTable['u64'] = 'top';
var u19 = document.getElementById('u19');

var u49 = document.getElementById('u49');

var u11 = document.getElementById('u11');

var u41 = document.getElementById('u41');

var u71 = document.getElementById('u71');

var u15 = document.getElementById('u15');

var u45 = document.getElementById('u45');
gv_vAlignTable['u45'] = 'center';
var u36 = document.getElementById('u36');

var u58 = document.getElementById('u58');
gv_vAlignTable['u58'] = 'center';
var u37 = document.getElementById('u37');
gv_vAlignTable['u37'] = 'center';
var u2 = document.getElementById('u2');

var u22 = document.getElementById('u22');
gv_vAlignTable['u22'] = 'top';
var u13 = document.getElementById('u13');
gv_vAlignTable['u13'] = 'top';
var u52 = document.getElementById('u52');
gv_vAlignTable['u52'] = 'center';
var u43 = document.getElementById('u43');
gv_vAlignTable['u43'] = 'center';
var u0 = document.getElementById('u0');

var u3 = document.getElementById('u3');

var u27 = document.getElementById('u27');
gv_vAlignTable['u27'] = 'center';
var u47 = document.getElementById('u47');
gv_vAlignTable['u47'] = 'center';
var u68 = document.getElementById('u68');

var u20 = document.getElementById('u20');
gv_vAlignTable['u20'] = 'top';
var u50 = document.getElementById('u50');
gv_vAlignTable['u50'] = 'center';
var u28 = document.getElementById('u28');
gv_vAlignTable['u28'] = 'top';
var u24 = document.getElementById('u24');

var u54 = document.getElementById('u54');
gv_vAlignTable['u54'] = 'center';
var u39 = document.getElementById('u39');

var u69 = document.getElementById('u69');
gv_vAlignTable['u69'] = 'center';
var u6 = document.getElementById('u6');
gv_vAlignTable['u6'] = 'center';
var u61 = document.getElementById('u61');
gv_vAlignTable['u61'] = 'center';
var u35 = document.getElementById('u35');
gv_vAlignTable['u35'] = 'center';
var u26 = document.getElementById('u26');

var u65 = document.getElementById('u65');
gv_vAlignTable['u65'] = 'top';
var u56 = document.getElementById('u56');
gv_vAlignTable['u56'] = 'center';
var u5 = document.getElementById('u5');

var u12 = document.getElementById('u12');
gv_vAlignTable['u12'] = 'center';
var u9 = document.getElementById('u9');

var u42 = document.getElementById('u42');

var u33 = document.getElementById('u33');
gv_vAlignTable['u33'] = 'center';
var u72 = document.getElementById('u72');

var u63 = document.getElementById('u63');
gv_vAlignTable['u63'] = 'top';
var u18 = document.getElementById('u18');
gv_vAlignTable['u18'] = 'top';
var u48 = document.getElementById('u48');
gv_vAlignTable['u48'] = 'top';
var u67 = document.getElementById('u67');
gv_vAlignTable['u67'] = 'top';
var u57 = document.getElementById('u57');

var u10 = document.getElementById('u10');
gv_vAlignTable['u10'] = 'center';
var u40 = document.getElementById('u40');
gv_vAlignTable['u40'] = 'top';
var u70 = document.getElementById('u70');
gv_vAlignTable['u70'] = 'top';
var u14 = document.getElementById('u14');
gv_vAlignTable['u14'] = 'top';
var u44 = document.getElementById('u44');

var u29 = document.getElementById('u29');

var u59 = document.getElementById('u59');
gv_vAlignTable['u59'] = 'top';
if (window.OnLoad) OnLoad();
