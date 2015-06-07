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
	<dt><span><a href="{-url:option/edit_option_site-}">{-:@SITE-}</a></span><span><a href="{-url:option/edit_option_core-}">{-:@CORE-}</a></span><span><a href="{-url:option/edit_option_index-}">{-:@INDEX-}</a></span><strong>{-:@PERFORMANCE-}</strong><span><a href="{-url:option/edit_option_upload-}">{-:@UPLOAD-}</a></span><span><a href="{-url:option/edit_option_image-}">{-:@IMAGE-}</a></span><span><a href="{-url:option/edit_option_member-}">{-:@MEMBER-}</a></span><span><a href="{-url:option/edit_option_interaction-}">{-:@INTERACTION-}</a></span><span><a href="{-url:option/edit_custom_option-}">{-:@CUSTOM_OPTION-}</a></span></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@CACHE_TYPE-} [performance/cache_type]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="File" name="performance[cache_type]"{-if:'File'==$_O['performance']['cache_type']-} checked="checked"{-:/if-}> {-:@FILE_CACHE-}</label>
					<label><input type="radio" value="Memcache" name="performance[cache_type]"{-if:'Memcache'==$_O['performance']['cache_type']-} checked="checked"{-:/if-}> {-:@MEMCACHE-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@CACHE_TYPE_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@MEMCACHE_HOST-} [performance/memcache_host]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['performance']['memcache_host']-}" name="performance[memcache_host]" maxlength="50" size="20">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@MEMCACHE_HOST_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@MEMCACHE_PORT-} [performance/memcache_port]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['performance']['memcache_port']-}" name="performance[memcache_port]" maxlength="5" size="5">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@MEMCACHE_PORT_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@SPHINX_SWITCH-} [performance/sphinx_switch]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="performance[sphinx_switch]"{-if:0==$_O['performance']['sphinx_switch']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
					<label><input type="radio" value="1" name="performance[sphinx_switch]"{-if:1==$_O['performance']['sphinx_switch']-} checked="checked"{-:/if-}> {-:@ON-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@SPHINX_SWITCH_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@SPHINX_HOST-} [performance/sphinx_host]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['performance']['sphinx_host']-}" name="performance[sphinx_host]" maxlength="50" size="20">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@SPHINX_HOST_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@SPHINX_PORT-} [performance/sphinx_port]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['performance']['sphinx_port']-}" name="performance[sphinx_port]" maxlength="5" size="5">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@SPHINX_PORT_TIP-}
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_b submit" action="{-url:option/edit_option_performance_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script>
var l_option_not_saved_tip = '{-:@OPTION_NOT_SAVED_TIP-}';
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/o.js"></script>
</body>
</html>