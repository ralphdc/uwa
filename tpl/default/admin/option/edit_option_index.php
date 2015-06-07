<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}js/dialog/artdialog.css" />
</head>
<body>
<form id="formEdit" action="" method="post">
<dl class="abox">
	<dt><span><a href="{-url:option/edit_option_site-}">{-:@SITE-}</a></span><span><a href="{-url:option/edit_option_core-}">{-:@CORE-}</a></span><strong>{-:@INDEX-}</strong><span><a href="{-url:option/edit_option_performance-}">{-:@PERFORMANCE-}</a></span><span><a href="{-url:option/edit_option_upload-}">{-:@UPLOAD-}</a></span><span><a href="{-url:option/edit_option_image-}">{-:@IMAGE-}</a></span><span><a href="{-url:option/edit_option_member-}">{-:@MEMBER-}</a></span><span><a href="{-url:option/edit_option_interaction-}">{-:@INTERACTION-}</a></span><span><a href="{-url:option/edit_custom_option-}">{-:@CUSTOM_OPTION-}</a></span></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@INDEX_HTML_SWITCH-} [index/html_switch]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="index[html_switch]"{-if:0==$_O['index']['html_switch']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
					<label><input type="radio" value="1" name="index[html_switch]"{-if:1==$_O['index']['html_switch']-} checked="checked"{-:/if-}> {-:@ON-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@INDEX_HTML_SWITCH_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@INDEX_PAGING_SWITCH-} [index/paging_switch]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="index[paging_switch]"{-if:0==$_O['index']['paging_switch']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
					<label><input type="radio" value="1" name="index[paging_switch]"{-if:1==$_O['index']['paging_switch']-} checked="checked"{-:/if-}> {-:@ON-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@INDEX_PAGING_SWITCH_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@INDEX_PAGE_SIZE-} [index/page_size]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['index']['page_size']-}" name="index[page_size]" maxlength="10" size="6">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@INDEX_PAGE_SIZE_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@INDEX_TEMPLATE-} [index/tpl]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="index_tpl" class="required i" type="text" value="{-:$_O['index']['tpl']-}" name="index[tpl]" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="home" to_id="index_tpl">{-:@CHOOSE-}</span>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@INDEX_TEMPLATE_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@INDEX_TEMPLATE_PAGING-} [index/tpl_paging]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="index_tpl_paging" class="required i" type="text" value="{-:$_O['index']['tpl_paging']-}" name="index[tpl_paging]" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="home" to_id="index_tpl_paging">{-:@CHOOSE-}</span>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@INDEX_TEMPLATE_PAGING_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@INDEX_HTML_NAMING-} [index/html_naming]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['index']['html_naming']-}" name="index[html_naming]" maxlength="255" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@INDEX_HTML_NAMING_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@INDEX_HTML_NAMING_PAGING-} [index/html_naming_paging]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['index']['html_naming_paging']-}" name="index[html_naming_paging]" maxlength="255" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@INDEX_HTML_NAMING_PAGING_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@INDEX_HTML_PATH_PAGING-} [index/html_path_paging]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['index']['html_path_paging']-}" name="index[html_path_paging]" maxlength="255" size="50" />
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@INDEX_HTML_PATH_PAGING_TIP-}
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_b submit" action="{-url:option/edit_option_index_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script>
var url_choose_template_file = '{-url:template/choose_template_file-}',
	l_choose_template = '{-:@CHOOSE_TEMPLATE-}';

var l_option_not_saved_tip = '{-:@OPTION_NOT_SAVED_TIP-}';
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/c_t.js"></script>
<script src="{-:*__THEME__-}admin/js/o.js"></script>
</body>
</html>