<?php /* PFA Template Cache File. Create Time:2015-06-06 10:21:52 */ ?>
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
	<dt><span><a href="<?php echo(Url::U("option/edit_option_site")); ?>"><?php echo(L("SITE")); ?></a></span><strong><?php echo(L("CORE")); ?></strong><span><a href="<?php echo(Url::U("option/edit_option_index")); ?>"><?php echo(L("INDEX")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_performance")); ?>"><?php echo(L("PERFORMANCE")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_upload")); ?>"><?php echo(L("UPLOAD")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_image")); ?>"><?php echo(L("IMAGE")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_member")); ?>"><?php echo(L("MEMBER")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_interaction")); ?>"><?php echo(L("INTERACTION")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_custom_option")); ?>"><?php echo(L("CUSTOM_OPTION")); ?></a></span></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle"><?php echo(L("HOST_PREFIX_SWITCH")); ?> [core/host_prefix_switch]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="core[host_prefix_switch]"<?php if(0==$_O['core']['host_prefix_switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("OFF")); ?></label>
					<label><input type="radio" value="1" name="core[host_prefix_switch]"<?php if(1==$_O['core']['host_prefix_switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("ON")); ?></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("HOST_PREFIX_SWITCH_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("REWRITE_SWITCH")); ?> [core/rewrite_switch]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="core[rewrite_switch]"<?php if(0==$_O['core']['rewrite_switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("OFF")); ?></label>
					<label><input type="radio" value="1" name="core[rewrite_switch]"<?php if(1==$_O['core']['rewrite_switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("ON")); ?></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("REWRITE_SWITCH_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("HTML_SWITCH")); ?> [core/html_switch]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="core[html_switch]"<?php if(0==$_O['core']['html_switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("OFF")); ?></label>
					<label><input type="radio" value="1" name="core[html_switch]"<?php if(1==$_O['core']['html_switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("ON")); ?></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("HTML_SWITCH_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("FORCED_HTML")); ?> [core/forced_html]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="core[forced_html]"<?php if(0==$_O['core']['forced_html']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("OFF")); ?></label>
					<label><input type="radio" value="1" name="core[forced_html]"<?php if(1==$_O['core']['forced_html']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("ON")); ?></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("FORCED_HTML_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("GZIP_SWITCH")); ?> [core/gzip_switch]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="core[gzip_switch]"<?php if(0==$_O['core']['gzip_switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("OFF")); ?></label>
					<label><input type="radio" value="1" name="core[gzip_switch]"<?php if(1==$_O['core']['gzip_switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("ON")); ?></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("GZIP_SWITCH_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("CACHE_EXPIRE")); ?> [core/cache_expire]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['core']['cache_expire']); ?>" name="core[cache_expire]" maxlength="20" size="10">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("CACHE_EXPIRE_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("HTML_EXPIRE_INDEX")); ?> [core/html_expire_index]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['core']['html_expire_index']); ?>" name="core[html_expire_index]" maxlength="20" size="10">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("HTML_EXPIRE_INDEX_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("HTML_EXPIRE_LIST")); ?> [core/html_expire_list]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['core']['html_expire_list']); ?>" name="core[html_expire_list]" maxlength="20" size="10">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("HTML_EXPIRE_LIST_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("HTML_EXPIRE_ARCHIVE")); ?> [core/html_expire_archive]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['core']['html_expire_archive']); ?>" name="core[html_expire_archive]" maxlength="20" size="10">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("HTML_EXPIRE_ARCHIVE_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("HTML_PATH")); ?> [core/html_path]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['core']['html_path']); ?>" name="core[html_path]" maxlength="255" size="50" />
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("HTML_PATH_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("COOKIE_PREFIX")); ?> [core/cookie_prefix]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['core']['cookie_prefix']); ?>" name="core[cookie_prefix]" maxlength="96" size="20">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("COOKIE_PREFIX_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("COOKIE_EXPIRE")); ?> [core/cookie_expire]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['core']['cookie_expire']); ?>" name="core[cookie_expire]" maxlength="20" size="10">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("COOKIE_EXPIRE_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("COOKIE_KEY")); ?> [core/cookie_key]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="cookie_key" class="required i" type="text" value="<?php echo($_O['core']['cookie_key']); ?>" name="core[cookie_key]" maxlength="96" size="30"> <span class="btn_l" onclick="generate_cookie_key();"><?php echo(L("REGENERATE")); ?></span>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("COOKIE_KEY_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("DEBUG_SWITCH")); ?> [core/debug_switch]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="core[debug_switch]"<?php if(0==$_O['core']['debug_switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("OFF")); ?></label>
					<label><input type="radio" value="1" name="core[debug_switch]"<?php if(1==$_O['core']['debug_switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("ON")); ?></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("DEBUG_SWITCH_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("DEBUG_STAT")); ?> [core/debug_stat]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="core[debug_stat]"<?php if(0==$_O['core']['debug_stat']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("OFF")); ?></label>
					<label><input type="radio" value="1" name="core[debug_stat]"<?php if(1==$_O['core']['debug_stat']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("ON")); ?></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("DEBUG_STAT_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("DEBUG_PAGE_TRACE")); ?> [core/debug_switch]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="core[debug_page_trace]"<?php if(0==$_O['core']['debug_page_trace']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("OFF")); ?></label>
					<label><input type="radio" value="1" name="core[debug_page_trace]"<?php if(1==$_O['core']['debug_page_trace']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("ON")); ?></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("DEBUG_PAGE_TRACE_TIP")); ?>
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
	<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
	<span class="btn_b submit" action="<?php echo(Url::U("option/edit_option_core_do")); ?>" to="#formEdit"><?php echo(L("SUBMIT")); ?></span>
	<input class="btn_l" type="reset" value="<?php echo(L("RESET")); ?>" />
</div>
</form>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script>
function randomString(len) {
	len = len || 32;
	/* except oOLl,9gq,Vv,Uu,I1 */
	var $chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678';
	var maxPos = $chars.length;
	var pwd = '';
	for(i = 0; i < len; i++) {
		pwd += $chars.charAt(Math.floor(Math.random() * maxPos));
	}
	return pwd;
}
function generate_cookie_key() {
	var ck = randomString(16);
	$('#cookie_key').val(ck);
}

var l_option_not_saved_tip = '<?php echo(L("OPTION_NOT_SAVED_TIP")); ?>';
</script>
<script src="/tpl/default/admin/js/c.js"></script>
<script src="/tpl/default/admin/js/o.js"></script>

</body>
</html>