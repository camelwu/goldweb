<?php
/**
 *
 * @package	Code2travel
 * @author	heluo Dev Team
 * @copyright	Copyright (c) 2003 - 2017, 河洛, Inc. (http://www.be-member.com/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://be-member.com
 * @since	Version 4.2.1
 * @filesource
 */
//根目录
define('V_ROOT', dirname(__FILE__));
//合法应用config文件
define('B_ENG', '1');
//debug模式
define('B_BUG', '1');
B_BUG ? error_reporting(E_ALL & ~E_NOTICE) : error_reporting(0);
//模板开启
define('B_TEMP', '1');
//路径设置
$system_path = 'core';
$source_path = 'resource';
$view_path = 'view';
define('BASEPATH', V_ROOT.'/'.$system_path);
define('VIEWPATH', V_ROOT.'/'.$view_path);
//设定完毕，开始
include_once (BASEPATH . '/index.php');
?>