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
	<dt><span><a href="{-url:option/edit_option_site-}">{-:@SITE-}</a></span><span><a href="{-url:option/edit_option_core-}">{-:@CORE-}</a></span><span><a href="{-url:option/edit_option_index-}">{-:@INDEX-}</a></span><span><a href="{-url:option/edit_option_performance-}">{-:@PERFORMANCE-}</a></span><span><a href="{-url:option/edit_option_upload-}">{-:@UPLOAD-}</a></span><span><a href="{-url:option/edit_option_image-}">{-:@IMAGE-}</a></span><span><a href="{-url:option/edit_option_member-}">{-:@MEMBER-}</a></span><span><a href="{-url:option/edit_option_interaction-}">{-:@INTERACTION-}</a></span><strong>{-:@CUSTOM_OPTION-}</strong></dt>
	<dd>
		<div class="mainTips">
			{-:@CUSTOM_OPTION_TIP-}
			<span class="btn_l" id="add_custom_option">{-:@ADD_CUSTOM_OPTION-}</span>
		</div>
		<table class="formTable">
			{-foreach:$_CO,$co-}
			<tr>
				<td class="inputTitle">
					{-:$co['o_title']-} [{-:$co['o_key']-}]
					<span class="fc_gry fs_11">HTML{-:@CODE-}: {-php:echo '{';-}-:$_G['{-:$co['o_key']-}']-}</span>
					<a href="{-url:option/delete_custom_option_do?o_key={$co['o_key']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" title="{-:@DELETE_CUSTOM_OPTION-}" class="fw_b fs_16" onclick="javascript:return delete_confirm();" >&times;</a></td>
				{-if:'image' == $co['o_value_type']-}
				<td rowspan="2" class="inputArea">
					<img height="90" id="{-:$co['o_key']-}_preview" src="{-:$co['o_value']-}" />
				</td>
				{-else:-}
				<td class=""></td>
				{-:/if-}
			</tr>
			<tr>
				<td class="inputArea">
				{-if:'string' == $co['o_value_type']-}
					<input class="i" type="text" value="{-:$co['o_value']-}" name="{-:$co['o_key']-}" maxlength="255" size="50" />
				{-elseif:'number' == $co['o_value_type']-}
					<input class="i" type="text" value="{-:$co['o_value']-}" name="{-:$co['o_key']-}" maxlength="20" size="10" />
				{-elseif:'bool' == $co['o_value_type']-}
					<label><input type="radio" value="Y" name="{-:$co['o_key']-}"{-if: 'Y' == $co['o_value']-} checked="checked"{-:/if-}/> {-:@ON-}</label>
					<label><input type="radio" value="N" name="{-:$co['o_key']-}"{-if: 'N' == $co['o_value']-} checked="checked"{-:/if-}/> {-:@OFF-}</label>
				{-elseif:'multi_text' == $co['o_value_type']-}
					<textarea class="i" name="{-:$co['o_key']-}" style="width:500px;height:60px;">{-:$co['o_value']-}</textarea>
				{-elseif:'html_text' == $co['o_value_type']-}
					<textarea class="editor_simple" name="{-:$co['o_key']-}" style="width:580px;height:80px;">{-:$co['o_value']-}</textarea>
				{-elseif:'image' == $co['o_value_type']-}
					<input id="{-:$co['o_key']-}" class="i" type="text" value="{-:$co['o_value']-}" name="{-:$co['o_key']-}" maxlength="255" size="50">
					<input id="{-:$co['o_key']-}_uploader" to="#{-:$co['o_key']-}" preview="#{-:$co['o_key']-}_preview" btntext="{-:@UPLOAD-}" typeset='image' class="uploader" type="file" />
					<span id="{-:$co['o_key']-}_finder" to="#{-:$co['o_key']-}" preview="#{-:$co['o_key']-}_preview" typeset='image' class="btn_l finder">{-:@BROWSE_SERVER-}</span><br />
					<span class="fc_gry">{-:$co['o_description']-}</span>
				{-:/if-}
				</td>
				{-if:'image' != $co['o_value_type']-}
				<td class="inputTip">
					{-:$co['o_description']-}
				</td>
				{-:/if-}
			</tr>
			{-:/foreach-}
		</table>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_b submit" action="{-url:option/edit_custom_option_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
</div>
</form>
<div id="form_add_custom_option" style="display:none">
<form id="formAdd" action="{-url:option/add_custom_option_do-}" method="post">
	<table class="formTable">
		<tr>
			<td class="inputArea"><strong>{-:@OPTION_TITLE-}</strong></td>
			<td class="inputArea" width="8"></td>
			<td class="inputArea">
				<input class="required i" type="text" value="" name="o_title" maxlength="255" size="30"><span class="fc_r">*</span>
			</td>
		</tr>
		<tr>
			<td><strong>{-:@OPTION_KEY-}</strong></td>
			<td></td>
			<td>
				<input class="required i" type="text" value="" name="o_key" maxlength="96" size="30"><span class="fc_r">*</span>
			</td>
		</tr>
		<tr>
			<td class="inputArea"></td>
			<td class="inputArea"></td>
			<td class="inputArea"><span class="fc_gry">{-:@OPTION_KEY_TIP-}</span></td>
		</tr>
		<tr>
			<td class="inputArea"><strong>{-:@OPTION_TYPE-}</strong></td>
			<td class="inputArea"></td>
			<td class="inputArea">
				<label><input type="radio" value="string" name="o_value_type" checked="checked"> {-:@STRING-}</label>
				<label><input type="radio" value="number" name="o_value_type"> {-:@NUMBER-}</label>
				<label><input type="radio" value="bool" name="o_value_type"> {-:@BOOLEAN-}</label>
				<label><input type="radio" value="multi_text" name="o_value_type"> {-:@MUTLI_TEXT-}</label>
				<label><input type="radio" value="html_text" name="o_value_type"> {-:@HTML_TEXT-}</label>
				<label><input type="radio" value="image" name="o_value_type"> {-:@IMAGE-}</label>
			</td>
		</tr>
		<tr>
			<td><strong>{-:@OPTION_VALUE-}</strong></td>
			<td></td>
			<td>
				<input class="i" type="text" value="" name="o_value" maxlength="255" size="40">
			</td>
		</tr>
		<tr>
			<td class="inputArea"></td>
			<td class="inputArea"></td>
			<td class="inputArea"><span class="fc_gry">{-:@OPTION_VALUE_TIP-}</span></td>
		</tr>
		<tr>
			<td><strong>{-:@OPTION_DESCRIPTION-}</strong></td>
			<td></td>
			<td>
				<textarea class="i" name="o_description" style="width:360px;height:40px;"></textarea>
				<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
				<input name="token" type="hidden" value="{-:$_TK['token']-}">
			</td>
		</tr>
		<tr>
			<td class="inputArea"></td>
			<td class="inputArea"></td>
			<td class="inputArea"><span class="fc_gry">{-:@OPTION_DESCRIPTION_TIP-}</span></td>
		</tr>
	</table>
</form>
</div>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/uploadify/uploadify.js"></script>
<script src="{-:*__PUBLIC__-}js/editor/ckeditor.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script>
$(document).ready(function() {
	var editor_option_simple = {
		filebrowserBrowseUrl : '{-url:finder/browse?typeset=all&type=site-}',
		filebrowserImageBrowseUrl : '{-url:finder/browse?typeset=image&type=site-}',
		filebrowserUploadUrl : '{-url:upload/upload_file?typeset=all&upload_type=site&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',
		filebrowserImageUploadUrl : '{-url:upload/upload_file?typeset=image&upload_type=site&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',
		toolbar : 'uwa_simple',
		width : 640, height : 90
	};
	$('.editor_simple').each(function(){
		CKEDITOR.replace(this, editor_option_simple);
	});
});

var type_desc_all = '{-:@FILE-}', file_type_exts_all = '{-:$_OU['all']-}',
	type_desc_image = '{-:@IMAGE-}', file_type_exts_image = '{-:$_OU['img']-}',
	form_data = {'{-php:echo session_name();-}' : '{-php:echo session_id();-}', 'timeKey' : '{-:$_TK["timeKey"]-}', 'token' : '{-:$_TK["token"]-}'},
	uploadify_swf = '{-:*__PUBLIC__-}js/uploadify/uploadify.swf',
	uploader_all = '{-url:upload/upload_file?typeset=all&upload_type=site-}',
	uploader_image = '{-url:upload/upload_file?typeset=image&upload_type=site-}',
	uploader_image_thumb = '{-url:upload/upload_file?typeset=image&upload_type=site&thumb=yes-}',
	uploader_image_thumb_both = '{-url:upload/upload_file?typeset=image&upload_type=site&thumb=both-}';

var finder_browse_url_all = '{-url:finder/browse?typeset=all&type=site-}',
	finder_browse_url_image = '{-url:finder/browse?typeset=image&type=site-}',
	finder_browse_url_file = '{-url:finder/browse?typeset=file&type=site-}';

/* add custom option */
$('#add_custom_option').bind('click', function() {
	dialog({
		title:'{-:@ADD_CUSTOM_OPTION-}',
		content: document.getElementById('form_add_custom_option'),
		id:'FACO',
		button:[
			{
				value:'{-:@OK-}',
				callback:function() {
					$('#formAdd').submit();
					return false;
				}
			},
			{
				value:'{-:@CANCEL-}'
			}
		]
	}).showModal();
});

var l_option_not_saved_tip = '{-:@OPTION_NOT_SAVED_TIP-}';
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/u.js"></script>
<script src="{-:*__THEME__-}admin/js/f.js"></script>
<script src="{-:*__THEME__-}admin/js/o.js"></script>
</body>
</html>