function checkall(form) {
	$('input[name="allowstr[]"]').attr("checked",true);
}
function checkother(form) {
	$('input[name="allowstr[]"]').attr("checked",false);

}

function checkallmember() {
	$('input[name="memberstr[]"]').attr("checked",true);
}
function checkothermember() {
	$('input[name="memberstr[]"]').attr("checked",false);

}

function checker(n,m){
	for (var i=0;i<m;i++ ){
		document.getElementById(n+i).checked = document.getElementById(n).checked;
	}
}
function checkerd(m){
	document.getElementById(m).checked = true;
}
function del_nsort() {
	var cf = window.confirm("是否确定该操作？");
	return cf;
}
function select_all(obj,cName){
	var checkboxs = document.getElementsByName(cName);
    for(var i=0;i<checkboxs.length;i++){checkboxs[i].checked = obj.checked;}
}
function changecid(){
	var sel = arguments[0];
	var locationid = sel.options[sel.selectedIndex].value;
	var ids = sel.id;
	var index = ids.substring(3);
	var aid = document.getElementById("aid"+index);
	var city = document.getElementById("city"+index);
	if (aid){
		aid.length = 0;
		aid.options[0] = new Option('国家', 0);
		for (var i=0;i <c_aid.length; i++){
			if (c_aid[i][1] == locationid){
				aid.options[aid.length] = new Option(c_aid[i][0], c_aid[i][2]);
			}        
		}
	}
	if (city){
		city.length = 0;
		city.options[0] = new Option('二级地区', 0);
	}
}
function changeaid(){
	var sel = arguments[0];
	var locationid = sel.options[sel.selectedIndex].value;
	var ids = sel.id;
	var index = ids.substring(3);
	var city = document.getElementById("city"+index);
	if (city){
		city.length = 0;
		city.options[0] = new Option('二级地区', 0);
		for (var i=0;i <c_city.length;i++){
			if (c_city[i][1] == locationid){
				city.options[city.length] = new Option(c_city[i][0], c_city[i][2]);
			}        
		}
	}
}