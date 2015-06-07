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
	<dt><strong>{-:@EDIT_FIELD-}</strong></dt>
	<dd>
		<table id="main_params" class="formTable">
			<tr>
				<td class="inputTitle">{-:@NAME-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_AMFI['f_item_name']-}" name="f_item_name" maxlength="64" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@F_ITEM_NAME_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@FIELD_NAME-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					{-:$_AMFI['f_name']-}<input type="hidden" value="{-:$_AMFI['f_name']-}" name="f_name">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@F_NAME_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@DATA_TYPE-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<select name="f_type">
					{-foreach:$_FT,$v-}
						<option value="{-:$v-}"{-if:$v==$_AMFI['f_type']-} selected="selected"{-:/if-}>{-:@FILED_{$v}-}</option>
					{-:/foreach-}
					</select>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@F_TYPE_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@LENGTH-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="i" type="text" value="{-:$_AMFI['f_length']-}" name="f_length" maxlength="8" size="6">
				</td>
				<td class="inputTip">
					{-:@F_LENGTH_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@DEFAULT-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" name="f_default" style="width:240px;height:40px;">{-:$_AMFI['f_default']-}</textarea>
				</td>
				<td class="inputTip">
					{-:@F_DEFAULT_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@FORM_TYPE-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" name="f_is_auto" {-if:1 == $_AMFI['f_is_auto']-} checked="checked"{-:/if-} value="1"> {-:@AUTO_FIELD-}</label>
					<label><input type="radio" name="f_is_auto" {-if:0 == $_AMFI['f_is_auto']-} checked="checked"{-:/if-} value="0"> {-:@FIXED_FIELD-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@F_IS_AUTO_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@IS_LIST-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" name="f_is_list" {-if:1 == $_AMFI['f_is_list']-} checked="checked"{-:/if-} value="1"> {-:@ON-}</label>
					<label><input type="radio" name="f_is_list" {-if:0 == $_AMFI['f_is_list']-} checked="checked"{-:/if-} value="0"> {-:@OFF-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@F_IS_LIST_TIP-}
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<input type="hidden" value="{-:$_AMFI['archive_model_id']-}" name="archive_model_id">
	<span class="btn_b submit" action="{-url:archive_model/edit_model_field_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:archive_model/edit_model?archive_model_id={$_AMFI['archive_model_id']}-}">{-:@BACK-}</a>
	<a class="btn_l" href="{-url:archive_model/list_model-}">{-:@ARCHIVE_MODEL_LIST-}</a>
</div>
</form>
<table id="extra_params" style="display:none;">
	<tr params_for="datetime">
		<td class="inputTitle">{-:@DATETIME_FORMAT-}</td>
		<td class=""></td>
	</tr>
	<tr params_for="datetime">
		<td class="inputArea">
			<input class="i" type="text" value="{-:$_AMFI['f_datetime_format']-}" name="f_datetime_format" maxlength="16" size="11">
		</td>
		<td class="inputTip">
			{-:@F_DATETIME_FORMAT_TIP-}
		</td>
	</tr>
	<tr params_for="simpletext multitext htmltext">
		<td class="inputTitle">{-:@IS_FILTER-}</td>
		<td class=""></td>
	</tr>
	<tr params_for="simpletext multitext htmltext">
		<td class="inputArea">
			<label><input type="radio" name="f_is_filter" {-if:1 == $_AMFI['f_is_filter']-} checked="checked"{-:/if-} value="1"> {-:@ON-}</label>
			<label><input type="radio" name="f_is_filter" {-if:0 == $_AMFI['f_is_filter']-} checked="checked"{-:/if-} value="0"> {-:@OFF-}</label>
		</td>
		<td class="inputTip">
			<span class="fc_r">*</span> {-:@F_IS_FILTER_TIP-}
		</td>
	</tr>
	<tr params_for="multitext img addon">
		<td class="inputTitle">{-:@IS_SERIALIZE-}</td>
		<td class=""></td>
	</tr>
	<tr params_for="multitext img addon">
		<td class="inputArea">
			<label><input type="radio" name="f_is_serialize" {-if:1 == $_AMFI['f_is_serialize']-} checked="checked"{-:/if-} value="1"> {-:@ON-}</label>
			<label><input type="radio" name="f_is_serialize" {-if:0 == $_AMFI['f_is_serialize']-} checked="checked"{-:/if-} value="0"> {-:@OFF-}</label>
		</td>
		<td class="inputTip">
			<span class="fc_r">*</span> {-:@F_IS_SERIALIZE_TIP-}
		</td>
	</tr>
	<tr params_for="img addon">
		<td class="inputTitle">{-:@MULTI_UPLOAD-}</td>
		<td class=""></td>
	</tr>
	<tr params_for="img addon">
		<td class="inputArea">
			<label><input type="radio" name="f_multi_upload" {-if:1 == $_AMFI['f_multi_upload']-} checked="checked"{-:/if-} value="1"> {-:@ON-}</label>
			<label><input type="radio" name="f_multi_upload" {-if:0 == $_AMFI['f_multi_upload']-} checked="checked"{-:/if-} value="0"> {-:@OFF-}</label>
		</td>
		<td class="inputTip">
			<span class="fc_r">*</span> {-:@F_MULTI_UPLOAD_TIP-}
		</td>
	</tr>
	<tr params_for="img addon">
		<td class="inputTitle">{-:@BROWSE_SERVER-}</td>
		<td class=""></td>
	</tr>
	<tr params_for="img addon">
		<td class="inputArea">
			<label><input type="radio" name="f_browse_server" {-if:1 == $_AMFI['f_browse_server']-} checked="checked"{-:/if-} value="1"> {-:@ON-}</label>
			<label><input type="radio" name="f_browse_server" {-if:0 == $_AMFI['f_browse_server']-} checked="checked"{-:/if-} value="0"> {-:@OFF-}</label>
		</td>
		<td class="inputTip">
			<span class="fc_r">*</span> {-:@F_BROWSE_SERVER_TIP-}
		</td>
	</tr>
	<tr params_for="img">
		<td class="inputTitle">{-:@THUMB_TYPE-}</td>
		<td class=""></td>
	</tr>
	<tr params_for="img">
		<td class="inputArea">
			<label><input type="radio" name="f_thumb_type" {-if:'no' == $_AMFI['f_thumb_type']-} checked="checked"{-:/if-} value="no"> {-:@ONLY_SOURCE-}</label>
			<label><input type="radio" name="f_thumb_type" {-if:'yes' == $_AMFI['f_thumb_type']-} checked="checked"{-:/if-} value="yes"> {-:@ONLY_THUMB-}</label>
			<label><input type="radio" name="f_thumb_type" {-if:'both' == $_AMFI['f_thumb_type']-} checked="checked"{-:/if-} value="both"> {-:@BOTH_SOURCE_AND_THUMB-}</label>
		</td>
		<td class="inputTip">
			<span class="fc_r">*</span> {-:@F_THUMB_TYPE_TIP-}
		</td>
	</tr>
	<tr params_for="htmltext">
		<td class="inputTitle">{-:@SAVE_REMOTE-}</td>
		<td class=""></td>
	</tr>
	<tr params_for="htmltext">
		<td class="inputArea">
			<label><input type="radio" name="f_save_remote" {-if:1 == $_AMFI['f_save_remote']-} checked="checked"{-:/if-} value="1"> {-:@ON-}</label>
			<label><input type="radio" name="f_save_remote" {-if:0 == $_AMFI['f_save_remote']-} checked="checked"{-:/if-} value="0"> {-:@OFF-}</label>
		</td>
		<td class="inputTip">
			<span class="fc_r">*</span> {-:@F_SAVE_REMOTE_TIP-}
		</td>
	</tr>
	<tr params_for="htmltext">
		<td class="inputTitle">{-:@WATERMARK_REMOTE-}</td>
		<td class=""></td>
	</tr>
	<tr params_for="htmltext">
		<td class="inputArea">
			<label><input type="radio" name="f_watermark_remote" {-if:1 == $_AMFI['f_watermark_remote']-} checked="checked"{-:/if-} value="1"> {-:@ON-}</label>
			<label><input type="radio" name="f_watermark_remote" {-if:0 == $_AMFI['f_watermark_remote']-} checked="checked"{-:/if-} value="0"> {-:@OFF-}</label>
		</td>
		<td class="inputTip">
			<span class="fc_r">*</span> {-:@F_WATERMARK_REMOTE_TIP-}
		</td>
	</tr>
	<tr params_for="htmltext">
		<td class="inputTitle">{-:@GET_THUMB-}</td>
		<td class=""></td>
	</tr>
	<tr params_for="htmltext">
		<td class="inputArea">
			<label><input type="radio" name="f_get_thumb" {-if:1 == $_AMFI['f_get_thumb']-} checked="checked"{-:/if-} value="1"> {-:@ON-}</label>
			<label><input type="radio" name="f_get_thumb" {-if:0 == $_AMFI['f_get_thumb']-} checked="checked"{-:/if-} value="0"> {-:@OFF-}</label>
		</td>
		<td class="inputTip">
			<span class="fc_r">*</span> {-:@F_GET_THUMB_TIP-}
		</td>
	</tr>
	<tr params_for="htmltext">
		<td class="inputTitle">{-:@GET_ABSTRACT-}</td>
		<td class=""></td>
	</tr>
	<tr params_for="htmltext">
		<td class="inputArea">
			<label><input type="radio" name="f_get_abstract" {-if:1 == $_AMFI['f_get_abstract']-} checked="checked"{-:/if-} value="1"> {-:@ON-}</label>
			<label><input type="radio" name="f_get_abstract" {-if:0 == $_AMFI['f_get_abstract']-} checked="checked"{-:/if-} value="0"> {-:@OFF-}</label>
		</td>
		<td class="inputTip">
			<span class="fc_r">*</span> {-:@F_GET_ABSTRACT_TIP-}
		</td>
	</tr>
	<tr params_for="htmltext">
		<td class="inputTitle">{-:@IS_PAGING-}</td>
		<td class=""></td>
	</tr>
	<tr params_for="htmltext">
		<td class="inputArea">
			<label><input type="radio" name="f_is_paging" {-if:1 == $_AMFI['f_is_paging']-} checked="checked"{-:/if-} value="1"> {-:@ON-}</label>
			<label><input type="radio" name="f_is_paging" {-if:0 == $_AMFI['f_is_paging']-} checked="checked"{-:/if-} value="0"> {-:@OFF-}</label>
		</td>
		<td class="inputTip">
			<span class="fc_r">*</span> {-:@F_IS_PAGING_TIP-}
		</td>
	</tr>
	<tr params_for="select radio checkbox">
		<td class="inputTitle">{-:@SHOW_TYPE-}</td>
		<td class=""></td>
	</tr>
	<tr params_for="select radio checkbox">
		<td class="inputArea">
			<label><input class="i required" type="radio" value="1" name="f_select_show_type"{-if:1 == $_AMFI['f_select_show_type']-} checked="checked"{-:/if-}> {-:@ITEM_KEY-}</label>
			<label><input class="i required" type="radio" value="2" name="f_select_show_type"{-if:2 == $_AMFI['f_select_show_type']-} checked="checked"{-:/if-}> {-:@ITEM_VALUE-}</label>
			<span class="fc_gry"><span class="fc_r">*</span> {-:@F_SELECT_SHOW_TYPE_TIP-}</span>
		</td>
		<td class="inputArea">
			<label><input class="i required" type="text" value="{-:$_AMFI['f_select_separator']-}" name="f_select_separator" size="4"> {-:@SELECT_SEPARATOR-} <span class="fc_gry"><span class="fc_r">*</span> {-:@F_SELECT_SEPARATOR_TIP-}</span></label>
		</td>
	</tr>
	<tr params_for="linkage">
		<td class="inputTitle">{-:@LINKAGE-}</td>
		<td class=""></td>
	</tr>
	<tr params_for="linkage">
		<td class="inputArea">
			<input id="f_linkage_alias" class="i required" type="text" value="{-:$_AMFI['f_linkage_alias']-}" name="f_linkage_alias" maxlength="32" size="20"> <span class="btn_l choose_linkage" to_id="f_linkage_alias">{-:@CHOOSE_LINKAGE-}</span>
		</td>
		<td class="inputTip">
			<span class="fc_r">*</span> {-:@F_LINKAGE_ALIAS_TIP-}
		</td>
	</tr>
	<tr params_for="linkage">
		<td class="inputTitle">{-:@SHOW_TYPE-}</td>
		<td class=""></td>
	</tr>
	<tr params_for="linkage">
		<td class="inputArea">
			<label><input class="i required" type="radio" value="1" name="f_linkage_show_type"{-if:1 == $_AMFI['f_linkage_show_type']-} checked="checked"{-:/if-}> {-:@ITEM_ID-}</label>
			<label><input class="i required" type="radio" value="2" name="f_linkage_show_type"{-if:2 == $_AMFI['f_linkage_show_type']-} checked="checked"{-:/if-}> {-:@ITEM_NAME-}</label>
			<label><input class="i required" type="radio" value="3" name="f_linkage_show_type"{-if:3 == $_AMFI['f_linkage_show_type']-} checked="checked"{-:/if-}> {-:@ITEM_PATH-}</label>
			<span class="fc_gry"><span class="fc_r">*</span> {-:@F_LINKAGE_SHOW_TYPE_TIP-}</span>
		</td>
		<td class="inputArea">
			<label><input class="i required" type="text" value="{-:$_AMFI['f_linkage_path_separator']-}" name="f_linkage_path_separator" size="4"> {-:@LINKAGE_PATH_SEPARATOR-} <span class="fc_gry"><span class="fc_r">*</span> {-:@F_LINKAGE_PATH_SEPARATOR_TIP-}</span></label>
		</td>
	</tr>
</table>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script>
var url_choose_linkage = '{-url:linkage/choose_linkage-}',
	l_choose_linkage = '{-:@CHOOSE_LINKAGE-}';
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/mf.js"></script>
<script src="{-:*__THEME__-}admin/js/c_l.js"></script>
</body>
</html>