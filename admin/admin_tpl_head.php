<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/admin.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="kindeditor/themes/default/default.css" />
<link rel="stylesheet" href="kindeditor/plugins/code/prettify.css" />
<script charset="utf-8" src="kindeditor/kindeditor.js"></script>
<script charset="utf-8" src="kindeditor/lang/zh_CN.js"></script>
<script charset="utf-8" src="kindeditor/plugins/code/prettify.js"></script>
<script type="text/javascript" src="js/jquery-1.4.js"></script>
<script type="text/javascript" src="js/check.js"></script>
<script>
    KindEditor.ready(function(K) {
        var editor1 = K.create('textarea[name="word"]', {
            cssPath : 'kindeditor/plugins/code/prettify.css',
            uploadJson : 'kindeditor/php/upload_json.php',
            fileManagerJson : 'kindeditor/php/file_manager_json.php',
            allowFileManager : true,
            afterCreate : function() {
                var self = this;
                K.ctrl(document, 13, function() {
                    self.sync();
                    K('form[name=add_frm]')[0].submit();
                });
                K.ctrl(self.edit.doc, 13, function() {
                    self.sync();
                    K('form[name=add_frm]')[0].submit();
                });
            },
			afterBlur: function(){this.sync();}
        });
        prettyPrint();
    });
//
function select_all(obj,cName){
	/*var i,slength=0;
	if(frm.sel_id==null){return false;}
	var sall=frm.sel_all.checked;
	var checkboxs = document.getElementsByName('sel_id[]');
	if(frm.sel_id[].length){
		slength=frm.sel_id[].length;
		for (i=0;i<slength;i++) { frm.sel_id[i].checked=sall; }
	}else{
		frm.sel_id.checked=sall;
	}*/
	var checkboxs = document.getElementsByName(cName);
    for(var i=0;i<checkboxs.length;i++){checkboxs[i].checked = obj.checked;} 
}
</script>
<title>网站 - 管理后台</title>
</head>
<body>
<?php
function list_top($tit,$types,$nsort,$c_id){
echo "<table cellspacing=1 cellpadding=4 class=table>
<tr><th colspan=2>".$tit."管理</th></tr>
<tr><td align=center colspan=2 height=30>
  <table border=0>
  <tr>
  <td><a href='?types=".$types."'>".$tit."列表</a></td>
  <td width=10></td>
  <td><a href='?types=".$types."&action=add&c_id=".$c_id."'>添加".$tit."</a></td>";

  echo"</tr>
  </table>
</td></tr>
<tr><td align=center>
  <table border=0 cellspacing=0 cellpadding=2>
  <form action='?action=list' method=get>
  <input type=hidden name=types value='".$types."'>
  <input type=hidden name=c_id value='".$c_id."'>
  <tr>
  <td>搜索（".$tit."列表） 关键字：</td>
  <td><input type=text name=keyword value='' size=15 maxlength=20></td>
  <td><input type=submit value='搜索'></td>
  </tr>
  </form>
  </table>
</td></tr>
</table>";
}

?>