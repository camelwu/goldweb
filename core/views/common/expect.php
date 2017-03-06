<?php
/**
 * Created by PhpStorm.
 * User: qizhenzhen
 * Date: 2016/11/1
 * Time: 13:59
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no"/>
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href="<?php echo $this->config->item('resources_url') ?>/resources/images/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/base.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/layout.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('resources_url') ?>/resources/css/assembly.css">
</head>
<body>
<div class="all">
    <?php echo $header; ?>
    <div class="contents">
        <div class = "expect"><img src="../../../resources/images/expect.png" alt="">
        </div>
    </div>
    <?php echo $footer; ?>
</div>
</body>
</html>
