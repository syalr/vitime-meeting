﻿
var PageName = '修改密码';
var PageId = '8123d80d50854217a31f7de82f4ae14e'
var PageUrl = '修改密码_1.html'
document.title = '修改密码';
var PageNotes = 
{
"pageName":"修改密码",
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

var u3 = document.getElementById('u3');

var u16 = document.getElementById('u16');
gv_vAlignTable['u16'] = 'top';
var u12 = document.getElementById('u12');

var u15 = document.getElementById('u15');
gv_vAlignTable['u15'] = 'center';
var u4 = document.getElementById('u4');
gv_vAlignTable['u4'] = 'center';
var u0 = document.getElementById('u0');

var u8 = document.getElementById('u8');
gv_vAlignTable['u8'] = 'center';
var u19 = document.getElementById('u19');

var u10 = document.getElementById('u10');

var u17 = document.getElementById('u17');
gv_vAlignTable['u17'] = 'top';
var u5 = document.getElementById('u5');

var u1 = document.getElementById('u1');
gv_vAlignTable['u1'] = 'center';
var u9 = document.getElementById('u9');
gv_vAlignTable['u9'] = 'top';
var u14 = document.getElementById('u14');

u14.style.cursor = 'pointer';
if (bIE) u14.attachEvent("onclick", Clicku14);
else u14.addEventListener("click", Clicku14, true);
function Clicku14(e)
{
windowEvent = e;


if (true) {

	self.location.href="修改成功.html" + GetQuerystring();

}

}

var u20 = document.getElementById('u20');

var u6 = document.getElementById('u6');
gv_vAlignTable['u6'] = 'center';
var u2 = document.getElementById('u2');

var u11 = document.getElementById('u11');
gv_vAlignTable['u11'] = 'center';
var u13 = document.getElementById('u13');
gv_vAlignTable['u13'] = 'center';
var u18 = document.getElementById('u18');

var u7 = document.getElementById('u7');

if (window.OnLoad) OnLoad();
