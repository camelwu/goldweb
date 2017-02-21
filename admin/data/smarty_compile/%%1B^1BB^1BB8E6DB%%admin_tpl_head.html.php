<?php /* Smarty version 2.6.20, created on 2015-10-19 21:08:14
         compiled from admin_tpl_head.html */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/check.js"></script>
<link href="css/admin.css" rel="stylesheet" type="text/css" />
<?php if ($this->_tpl_vars['action'] == 'add' || $this->_tpl_vars['action'] == 'edit'): ?>
<link rel="stylesheet" href="kindeditor/themes/default/default.css" />
<link rel="stylesheet" href="kindeditor/plugins/code/prettify.css" />
<script charset="utf-8" src="kindeditor/kindeditor.js"></script>
<script charset="utf-8" src="kindeditor/lang/zh_CN.js"></script>
<script charset="utf-8" src="kindeditor/plugins/code/prettify.js"></script>
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
			afterBlur : function() {
				this.sync();
			}
		});
		if ($("#info")) {
			var editor2 = K.create('textarea[name="info"]', {
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
				afterBlur : function() {
					this.sync();
				}
			});
		}
		if ($("#feature")) {
			var editor3 = K.create('textarea[name="feature"]', {
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
				afterBlur : function() {
					this.sync();
				}
			});
		}
		prettyPrint();
	});
</script>
<?php endif; ?>
<title>旅行社计调分销 - 管理后台 - <?php echo $this->_tpl_vars['tit']; ?>
</title>
</head>
<body>
	<table cellspacing=1 cellpadding=4 class=table>
		<tr>
			<th colspan=2><?php echo $this->_tpl_vars['tit']; ?>
管理</th>
		</tr>
		<tr>
			<td align=center colspan=2 height=30>
				<table border=0>
					<tr>
						<td><a href='?types=<?php echo $this->_tpl_vars['types']; ?>
'><?php echo $this->_tpl_vars['tit']; ?>
列表</a></td>
						<td width=10></td>
						<td><a href='?action=add&types=<?php echo $this->_tpl_vars['types']; ?>
&ctype=<?php echo $this->_tpl_vars['ctype']; ?>
'>添加<?php echo $this->_tpl_vars['tit']; ?>
</a></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align=center>
				<table border=0 cellspacing=0 cellpadding=2>
					<form action='?action=list' method=get>
						<input type=hidden name=types value='<?php echo $this->_tpl_vars['types']; ?>
'> <input
							type=hidden name=ctype value='<?php echo $this->_tpl_vars['ctype']; ?>
'>
						<tr>
							<td>搜索（<?php echo $this->_tpl_vars['tit']; ?>
列表） 关键字：</td>
							<td><input type=text name=keyword value='<?php echo $this->_tpl_vars['keyword']; ?>
'
								size=15 maxlength=20></td>
							<td><input type=submit value='搜索'></td>
						</tr>
					</form>
				</table>
			</td>
		</tr>
	</table>