<?php /* PFA Template Cache File. Create Time:2015-06-04 01:42:37 */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title><?php echo(SOFT_NAME); ?> <?php echo(SOFT_CODENAME); ?></title>
<style type="text/css">
input,select,button{vertical-align:middle;font-family:'Microsoft YaHei',Verdana,Tahoma,Arial}
body{margin:0;padding:60px 0;background:#333;font-family:'Microsoft YaHei',Verdana,Tahoma,Arial}
#container{width:200px;margin:0 auto;padding:20px;background:#fff;border-radius:5px;box-shadow:0 0 5px rgba(0,0,0,0.5)}
.worldmap{margin:10px 0;width:200px;height:100px;border:0;background:url('http://localhost:90/install/tpl/default/img/worldmap.gif') no-repeat}
#chooseLanguage{width:100%;border:2px solid #0af;font-size:16px;display:block;border-radius:5px;box-shadow:0 0 5px #0af}
#stepNext{margin:20px 0 10px 150px;width:50px;height:50px;line-height:50px;text-align:center;border:0;background:url('http://localhost:90/install/tpl/default/img/step_next.gif') no-repeat;cursor:pointer !important}
#stepNext:hover{background-position:0 -50px;}
h1{margin:0 auto 20px;width:200px;height:40px;font-size:36px;color:#fff;text-indent:-5000px;background:url("http://localhost:90/install/tpl/default/img/install_title.gif") no-repeat}
</style>
</head>

<body>
<h1><span id="softName"><?php echo(SOFT_NAME); ?> <?php echo(SOFT_CODENAME); ?></span><span id="INSTALL_WIZARD"><?php echo(L("INSTALL_WIZARD")); ?></span></h1>
<div id="container">
	<div class="worldmap"></div>
	<form action="" method="get">
		<select size="<?php echo($selectHight); ?>" id="chooseLanguage" name="l">
		<?php if(isset($_LANGSET) and is_array($_LANGSET)) : foreach($_LANGSET as $lang) : ?>
			<option value="<?php echo($lang['alias']); ?>"<?php if($hal == $lang['alias']) :  ?> selected="selected"<?php endif; ?>><?php echo($lang['name']); ?></option>
		<?php endforeach; endif; ?>
		</select>
		<button id="stepNext" type="submit"></button>
	</form>
</div>
</body>
</html>