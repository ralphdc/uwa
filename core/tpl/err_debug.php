<?php

/**
 *--------------------------------------
 * page trace
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2014-12-16
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */

defined('PFA_PATH') or exit('Access Denied');
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo L('_SYSTEM_ERROR_');?></title>
<meta charset="utf-8"/>
<style>
body{font-family:'Microsoft YaHei',Verdana,Tahoma,Arial;font-size:12px;background:#e5e5e5}
a{text-decoration:none;color:#3d6dcc}
a:hover{text-decoration:none;color:#f30}
.notice{position:absolute;top:50%;left:50%;padding:10px;margin-top:-240px;margin-left:-360px;width:720px;height:480px;color:#666; background:#fff;border:1px solid #ccc;box-shadow:2px 2px 2px rgba(0,0,0,0.1)}
h2{border-bottom:1px solid #ddd;margin:0 0 5px;padding:8px 0;font-size:20px}
.title{color:#f30;margin: 0}
.message, #trace{padding:0;border:0;margin:5px 0 10px;line-height:18px}
.red{color:red;font-weight:bold}
</style>
</head>
<body>
<div class="notice">
	<h2><?php echo L('_SYSTEM_ERROR_');?></h2>
	<div>[ <a href="javascript:history.go(0);"><?php echo L('_TRY_LATER_');?></a> ] [ <a href="javascript:history.go(-1);"><?php echo L('_GO_BACK_');?></a> ] <?php echo L('_OR_');?> [ <a href="<?php echo __APP__;?>"><?php echo L('_GO_HOME_');?></a> ]</div>
	<?php if(isset($e['file'])){?>
	<p><strong><?php echo L('_ERROR_POSITION_');?>: </strong><?php echo L('_FILE_');?>: <span class="red"><?php echo $e['file'] ;?></span> <?php echo L('_LINE_');?>: <span class="red"><?php echo $e['line'];?></span></p>
	<?php }?>
	<p class="title">[ <?php echo L('_ERROR_INFORMATION_');?> ]</p>
	<p class="message"><?php echo strip_tags($e['message']);?></p>
	<?php if(isset($e['trace'])){?>
	<p class="title">[ <?php echo L('_PAGE_TRACE_INFO_');?> ]</p>
	<p id="trace">
	<?php echo nl2br($e['trace']);?>
	</p>
	<?php }?>
	<p align="center" style="color:#FF3300;margin:5pt;font-family:Verdana">
		PFA <sup style='color:gray;font-size:9pt'><?php echo PFA_VERSION;?></sup>
	</p>
</div>
</body>
</html>