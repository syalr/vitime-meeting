
var PageName = '系统介绍';
var PageId = '67c4e761856c49a1bde3e668ffdafef4'
var PageUrl = '系统介绍.html'
document.title = '系统介绍';
var PageNotes = 
{
"pageName":"系统介绍",
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

var u31 = document.getElementById('u31');
gv_vAlignTable['u31'] = 'top';
var u36 = document.getElementById('u36');
gv_vAlignTable['u36'] = 'top';
var u16 = document.getElementById('u16');
gv_vAlignTable['u16'] = 'top';
var u17 = document.getElementById('u17');

if (bIE) u17.attachEvent("onfocus", Focusu17);
else u17.addEventListener("focus", Focusu17, true);
function Focusu17(e)
{
windowEvent = e;


if (true) {

	MoveWidgetTo('u3', 0,0,'linear',500);
function waitu45aa0df3b81b4dbf9bd380c1bff1e3661() {

	MoveWidgetTo('u8', 0,0,'linear',500);
function waitua6c5b9ad1af84620b9e98990fa0a91741() {

	MoveWidgetTo('u13', 0,0,'linear',500);
function waitu85276f903faa4782928d100f4f6147561() {

	MoveWidgetTo('u19', 0,0,'linear',500);
function waituec349a3172134862a0394e2227cd52591() {

	MoveWidgetTo('u23', 0,0,'linear',500);
function waitu15c6439610b2466fb14f33c049ec8a221() {

	MoveWidgetTo('u28', 0,0,'linear',500);
function waitu4063b7c3a767499ebc63e4142ea3a4ff1() {

	MoveWidgetTo('u33', 0,0,'linear',500);
}
setTimeout(waitu4063b7c3a767499ebc63e4142ea3a4ff1, 2000);
}
setTimeout(waitu15c6439610b2466fb14f33c049ec8a221, 2000);
}
setTimeout(waituec349a3172134862a0394e2227cd52591, 2000);
}
setTimeout(waitu85276f903faa4782928d100f4f6147561, 2000);
}
setTimeout(waitua6c5b9ad1af84620b9e98990fa0a91741, 2000);
}
setTimeout(waitu45aa0df3b81b4dbf9bd380c1bff1e3661, 2000);

}

}

var u28 = document.getElementById('u28');

var u29 = document.getElementById('u29');

var u8 = document.getElementById('u8');

var u30 = document.getElementById('u30');
gv_vAlignTable['u30'] = 'center';
var u21 = document.getElementById('u21');
gv_vAlignTable['u21'] = 'center';
var u6 = document.getElementById('u6');
gv_vAlignTable['u6'] = 'top';
var u32 = document.getElementById('u32');
gv_vAlignTable['u32'] = 'top';
var u15 = document.getElementById('u15');
gv_vAlignTable['u15'] = 'center';
var u13 = document.getElementById('u13');

var u14 = document.getElementById('u14');

var u4 = document.getElementById('u4');

var u38 = document.getElementById('u38');

u38.style.cursor = 'pointer';
if (bIE) u38.attachEvent("onclick", Clicku38);
else u38.addEventListener("click", Clicku38, true);
function Clicku38(e)
{
windowEvent = e;


if (true) {

	self.location.href="首页.html" + GetQuerystring();

}

}

var u40 = document.getElementById('u40');

if (bIE) u40.attachEvent("onfocus", Focusu40);
else u40.addEventListener("focus", Focusu40, true);
function Focusu40(e)
{
windowEvent = e;


if (true) {

	var obj1 = document.getElementById("u17");
    obj1.focus();

}

}

var u1 = document.getElementById('u1');
gv_vAlignTable['u1'] = 'center';
var u37 = document.getElementById('u37');
gv_vAlignTable['u37'] = 'top';
var u26 = document.getElementById('u26');
gv_vAlignTable['u26'] = 'top';
var u10 = document.getElementById('u10');
gv_vAlignTable['u10'] = 'center';
var u11 = document.getElementById('u11');
gv_vAlignTable['u11'] = 'top';
var u3 = document.getElementById('u3');

var u12 = document.getElementById('u12');
gv_vAlignTable['u12'] = 'top';
var u39 = document.getElementById('u39');
gv_vAlignTable['u39'] = 'center';
var u9 = document.getElementById('u9');

var u35 = document.getElementById('u35');
gv_vAlignTable['u35'] = 'center';
var u27 = document.getElementById('u27');
gv_vAlignTable['u27'] = 'top';
var u7 = document.getElementById('u7');
gv_vAlignTable['u7'] = 'top';
var u23 = document.getElementById('u23');

var u24 = document.getElementById('u24');

var u25 = document.getElementById('u25');
gv_vAlignTable['u25'] = 'center';
var u2 = document.getElementById('u2');

var u18 = document.getElementById('u18');

if (bIE) u18.attachEvent("onfocus", Focusu18);
else u18.addEventListener("focus", Focusu18, true);
function Focusu18(e)
{
windowEvent = e;


if (true) {

	var obj1 = document.getElementById("u17");
    obj1.focus();

}

}

var u19 = document.getElementById('u19');

var u20 = document.getElementById('u20');

var u5 = document.getElementById('u5');
gv_vAlignTable['u5'] = 'center';
var u22 = document.getElementById('u22');
gv_vAlignTable['u22'] = 'top';
var u33 = document.getElementById('u33');

var u34 = document.getElementById('u34');

var u0 = document.getElementById('u0');

if (window.OnLoad) OnLoad();
