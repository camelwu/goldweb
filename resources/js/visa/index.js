function search_visa(){
	linkstr = "/visa/"+encodeURI($("#country").val())+"-"+$("#vtype").val();
	window.location = linkstr;
}
