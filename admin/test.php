<?php
require_once ('includes/init.php');
require_once ('includes/checklogin.php');
require_once ('includes/func_line.php');

$excel_file = "D:/Book1.xlsx";
var_dump(read_excel2007($excel_file));

?>
