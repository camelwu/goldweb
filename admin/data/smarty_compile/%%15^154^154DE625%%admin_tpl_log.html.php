<?php /* Smarty version 2.6.20, created on 2015-04-19 12:45:46
         compiled from admin_tpl_log.html */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/jquery-1.4.js"></script>
<script type="text/javascript" src="js/check.js"></script>
<link href="css/admin.css" rel="stylesheet" type="text/css" /><?php if ($this->_tpl_vars['action'] == 'edit' || $this->_tpl_vars['action'] == 'edit'): ?>
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
			afterBlur: function(){this.sync();}
        });
        prettyPrint();
    });
</script><?php endif; ?>
<title>旅行社计调分销 - 管理后台 - <?php echo $this->_tpl_vars['tit']; ?>
</title>
</head>
<body>