<?php /* PFA Template Cache File. Create Time:2015-06-06 10:21:56 */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="/tpl/default/admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="/tpl/default/admin/css/mf.css" />
</head>
<body>
<form id="formEdit" action="" method="post">
<dl class="abox">
	<dt><span><a href="<?php echo(Url::U("option/edit_option_site")); ?>"><?php echo(L("SITE")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_core")); ?>"><?php echo(L("CORE")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_index")); ?>"><?php echo(L("INDEX")); ?></a></span><strong><?php echo(L("PERFORMANCE")); ?></strong><span><a href="<?php echo(Url::U("option/edit_option_upload")); ?>"><?php echo(L("UPLOAD")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_image")); ?>"><?php echo(L("IMAGE")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_member")); ?>"><?php echo(L("MEMBER")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_interaction")); ?>"><?php echo(L("INTERACTION")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_custom_option")); ?>"><?php echo(L("CUSTOM_OPTION")); ?></a></span></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle"><?php echo(L("CACHE_TYPE")); ?> [performance/cache_type]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="File" name="performance[cache_type]"<?php if('File'==$_O['performance']['cache_type']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("FILE_CACHE")); ?></label>
					<label><input type="radio" value="Memcache" name="performance[cache_type]"<?php if('Memcache'==$_O['performance']['cache_type']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("MEMCACHE")); ?></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("CACHE_TYPE_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("MEMCACHE_HOST")); ?> [performance/memcache_host]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['performance']['memcache_host']); ?>" name="performance[memcache_host]" maxlength="50" size="20">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("MEMCACHE_HOST_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("MEMCACHE_PORT")); ?> [performance/memcache_port]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['performance']['memcache_port']); ?>" name="performance[memcache_port]" maxlength="5" size="5">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("MEMCACHE_PORT_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("SPHINX_SWITCH")); ?> [performance/sphinx_switch]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="performance[sphinx_switch]"<?php if(0==$_O['performance']['sphinx_switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("OFF")); ?></label>
					<label><input type="radio" value="1" name="performance[sphinx_switch]"<?php if(1==$_O['performance']['sphinx_switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("ON")); ?></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("SPHINX_SWITCH_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("SPHINX_HOST")); ?> [performance/sphinx_host]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['performance']['sphinx_host']); ?>" name="performance[sphinx_host]" maxlength="50" size="20">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("SPHINX_HOST_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("SPHINX_PORT")); ?> [performance/sphinx_port]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['performance']['sphinx_port']); ?>" name="performance[sphinx_port]" maxlength="5" size="5">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("SPHINX_PORT_TIP")); ?>
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
	<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
	<span class="btn_b submit" action="<?php echo(Url::U("option/edit_option_performance_do")); ?>" to="#formEdit"><?php echo(L("SUBMIT")); ?></span>
	<input class="btn_l" type="reset" value="<?php echo(L("RESET")); ?>" />
</div>
</form>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script>
var l_option_not_saved_tip = '<?php echo(L("OPTION_NOT_SAVED_TIP")); ?>';
</script>
<script src="/tpl/default/admin/js/c.js"></script>
<script src="/tpl/default/admin/js/o.js"></script>
</body>
</html>