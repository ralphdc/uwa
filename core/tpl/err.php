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
<title>404</title>
<meta charset="utf-8"/>
<style>
body{font-family:'Microsoft YaHei',Verdana,Tahoma,Arial;font-size:12px;background:#e5e5e5}
a{text-decoration:none;color:#3d6dcc}
a:hover{text-decoration:none;color:#f30}
.notice{position:absolute;top:50%;left:50%;padding:10px;margin-top:-100px;margin-left:-200px;width:400px;color:#666;background:#fff;border:1px solid #ccc;box-shadow:2px 2px 2px rgba(0,0,0,0.1)}
h2{border-bottom:1px solid #ddd;margin:0 0 5px;padding:8px 0;font-size:20px}
</style>
</head>
<body>
<div class="notice">
	<h2>404</h2>
	<div>[ <a href="javascript:history.go(0);"><?php echo L('_TRY_LATER_');?></a> ] [ <a href="javascript:history.go(-1);"><?php echo L('_GO_BACK_');?></a> ] <?php echo L('_OR_');?> [ <a href="<?php echo __APP__;?>"><?php echo L('_GO_HOME_');?></a> ]</div>
	<p><?php echo L('_404_TIPS_');?></p>
	<p><?php echo $error;?></p>
	<p style="color:#f30;margin:5pt">
		<?php echo APP_NAME;?> <sup style='color:gray;font-size:9pt'><?php echo date('Y');?></sup>
	</p>
</div>
</body>
</html>