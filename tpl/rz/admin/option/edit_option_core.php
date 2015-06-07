<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
</head>
<body>
<form id="formEdit" action="" method="post">
<dl class="abox">
	<dt><span><a href="{-url:option/edit_option_site-}">{-:@SITE-}</a></span><strong>{-:@CORE-}</strong><span><a href="{-url:option/edit_option_index-}">{-:@INDEX-}</a></span><span><a href="{-url:option/edit_option_performance-}">{-:@PERFORMANCE-}</a></span><span><a href="{-url:option/edit_option_upload-}">{-:@UPLOAD-}</a></span><span><a href="{-url:option/edit_option_image-}">{-:@IMAGE-}</a></span><span><a href="{-url:option/edit_option_member-}">{-:@MEMBER-}</a></span><span><a href="{-url:option/edit_option_interaction-}">{-:@INTERACTION-}</a></span><span><a href="{-url:option/edit_custom_option-}">{-:@CUSTOM_OPTION-}</a></span></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@HOST_PREFIX_SWITCH-} [core/host_prefix_switch]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="core[host_prefix_switch]"{-if:0==$_O['core']['host_prefix_switch']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
					<label><input type="radio" value="1" name="core[host_prefix_switch]"{-if:1==$_O['core']['host_prefix_switch']-} checked="checked"{-:/if-}> {-:@ON-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@HOST_PREFIX_SWITCH_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@REWRITE_SWITCH-} [core/rewrite_switch]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="core[rewrite_switch]"{-if:0==$_O['core']['rewrite_switch']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
					<label><input type="radio" value="1" name="core[rewrite_switch]"{-if:1==$_O['core']['rewrite_switch']-} checked="checked"{-:/if-}> {-:@ON-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@REWRITE_SWITCH_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@HTML_SWITCH-} [core/html_switch]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="core[html_switch]"{-if:0==$_O['core']['html_switch']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
					<label><input type="radio" value="1" name="core[html_switch]"{-if:1==$_O['core']['html_switch']-} checked="checked"{-:/if-}> {-:@ON-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@HTML_SWITCH_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@FORCED_HTML-} [core/forced_html]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="core[forced_html]"{-if:0==$_O['core']['forced_html']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
					<label><input type="radio" value="1" name="core[forced_html]"{-if:1==$_O['core']['forced_html']-} checked="checked"{-:/if-}> {-:@ON-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@FORCED_HTML_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@GZIP_SWITCH-} [core/gzip_switch]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="core[gzip_switch]"{-if:0==$_O['core']['gzip_switch']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
					<label><input type="radio" value="1" name="core[gzip_switch]"{-if:1==$_O['core']['gzip_switch']-} checked="checked"{-:/if-}> {-:@ON-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@GZIP_SWITCH_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@CACHE_EXPIRE-} [core/cache_expire]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['core']['cache_expire']-}" name="core[cache_expire]" maxlength="20" size="10">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@CACHE_EXPIRE_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@HTML_EXPIRE_INDEX-} [core/html_expire_index]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['core']['html_expire_index']-}" name="core[html_expire_index]" maxlength="20" size="10">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@HTML_EXPIRE_INDEX_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@HTML_EXPIRE_LIST-} [core/html_expire_list]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['core']['html_expire_list']-}" name="core[html_expire_list]" maxlength="20" size="10">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@HTML_EXPIRE_LIST_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@HTML_EXPIRE_ARCHIVE-} [core/html_expire_archive]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['core']['html_expire_archive']-}" name="core[html_expire_archive]" maxlength="20" size="10">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@HTML_EXPIRE_ARCHIVE_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@HTML_PATH-} [core/html_path]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['core']['html_path']-}" name="core[html_path]" maxlength="255" size="50" />
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@HTML_PATH_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@COOKIE_PREFIX-} [core/cookie_prefix]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['core']['cookie_prefix']-}" name="core[cookie_prefix]" maxlength="96" size="20">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@COOKIE_PREFIX_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@COOKIE_EXPIRE-} [core/cookie_expire]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['core']['cookie_expire']-}" name="core[cookie_expire]" maxlength="20" size="10">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@COOKIE_EXPIRE_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@COOKIE_KEY-} [core/cookie_key]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="cookie_key" class="required i" type="text" value="{-:$_O['core']['cookie_key']-}" name="core[cookie_key]" maxlength="96" size="30"> <span class="btn_l" onclick="generate_cookie_key();">{-:@REGENERATE-}</span>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@COOKIE_KEY_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@DEBUG_SWITCH-} [core/debug_switch]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="core[debug_switch]"{-if:0==$_O['core']['debug_switch']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
					<label><input type="radio" value="1" name="core[debug_switch]"{-if:1==$_O['core']['debug_switch']-} checked="checked"{-:/if-}> {-:@ON-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@DEBUG_SWITCH_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@DEBUG_STAT-} [core/debug_stat]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="core[debug_stat]"{-if:0==$_O['core']['debug_stat']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
					<label><input type="radio" value="1" name="core[debug_stat]"{-if:1==$_O['core']['debug_stat']-} checked="checked"{-:/if-}> {-:@ON-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@DEBUG_STAT_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@DEBUG_PAGE_TRACE-} [core/debug_switch]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="core[debug_page_trace]"{-if:0==$_O['core']['debug_page_trace']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
					<label><input type="radio" value="1" name="core[debug_page_trace]"{-if:1==$_O['core']['debug_page_trace']-} checked="checked"{-:/if-}> {-:@ON-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@DEBUG_PAGE_TRACE_TIP-}
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_b submit" action="{-url:option/edit_option_core_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
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

var l_option_not_saved_tip = '{-:@OPTION_NOT_SAVED_TIP-}';
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/o.js"></script>

</body>
</html>