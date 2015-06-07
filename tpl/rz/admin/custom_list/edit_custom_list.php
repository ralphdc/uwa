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
	<dt><strong>{-:@EDIT_CUSTOM_LIST-}</strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@TITLE-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_CLI['cl_title']-}" name="cl_title" maxlength="96" size="50">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@CL_TITLE_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@IS_BUILD-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="cl_is_build"{-if:0==$_CLI['cl_is_build']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
					<label><input type="radio" value="1" name="cl_is_build"{-if:1==$_CLI['cl_is_build']-} checked="checked"{-:/if-}> {-:@ON-}</label>
				</td>
				<td class="inputArea">
					<span class="fc_gry">{-:@CL_IS_BUILD_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@TEMPLATE-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="cl_tpl" class="required i" type="text" value="{-:$_CLI['cl_tpl']-}" name="cl_tpl" maxlength="96" size="40"> <span class="btn_l choose_template" base_dir="home" to_id="cl_tpl">{-:@CHOOSE-}</span>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@CL_TPL_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@BUILD_NAMING-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_CLI['cl_build_naming']-}" name="cl_build_naming" maxlength="96" size="50">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@CL_BUILD_NAMING_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@CONTENT_TYPE-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="cl_content_type" class="required i" type="text" name="cl_content_type" size="20" value="{-:$_CLI['cl_content_type']-}">
					<select id="cl_content_type_select" onchange="$('#cl_content_type').val($('#cl_content_type_select').val());">
						<option value="">{-:@SELECT-}</option>
						<option{-if:'text/html' == $_CLI['cl_content_type']-} selected="selected"{-:/if-} value="text/html">{-:@HTML_FILE-}</option>
						<option{-if:'text/xml' == $_CLI['cl_content_type']-} selected="selected"{-:/if-}  value="text/xml">{-:@XML_FILE-}</option>
						<option{-if:'text/plain' == $_CLI['cl_content_type']-} selected="selected"{-:/if-}  value="text/plain">{-:@PLAIN_TEXT-}</option>
						<option value="">{-:@CUSTOM-}</option>
					</select>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@CL_CONTENT_TYPE_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="inputArea">
					<label>
						<strong>{-:@CHANNEL-}</strong>
						<select name="cl_config[cid]">
							<option value="all">{-:@NOT_LIMIT-}</option>
							{-:$_ACLStr-}
						</select>
					</label>
					<label>
						<strong>{-:@FLAG-}</strong>
						<select name="cl_config[flag]">
							<option value="">{-:@NOT_LIMIT-}</option>
						{-foreach:$_AFL,$f-}
							<option{-if:$f['af_alias']==$_CLI['cl_config']['flag']-} selected="selected"{-:/if-} value="{-:$f['af_alias']-}">{-:$f['af_name']-}</option>
						{-:/foreach-}
						</select>
					</label>
					<label>
						<strong>{-:@DAYS_LIMIT-}</strong>
						<input name="cl_config[days]" class="i" type="text" value="{-:$_CLI['cl_config']['days']-}" size="5" />
						<span class="fc_gry">{-:@TAG_A_LIST_DAYS_TIP-}</span>
					</label>
					<label>
						<strong>{-:@KEYWORDS-}</strong>
						<input name="cl_config[keywords]" class="i" type="text" value="{-:$_CLI['cl_config']['keywords']-}" size="10" />
						<span class="fc_gry">{-:@TAG_A_LIST_KEYWORDS_TIP-}</span>
					</label>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="inputArea">
					<label>
						<strong>{-:@ORDER-}</strong>
						<select name="cl_config[orderby]">
							<option value="">{-:@DISPLAY_ORDER-}</option>
							<option{-if:'archive_id'==$_CLI['cl_config']['orderby']-} selected="selected"{-:/if-} value="archive_id">{-:@ID-}</option>
							<option{-if:'a_edit_time'==$_CLI['cl_config']['orderby']-} selected="selected"{-:/if-} value="a_edit_time">{-:@EDIT_TIME-}</option>
							<option{-if:'a_rank'==$_CLI['cl_config']['orderby']-} selected="selected"{-:/if-} value="a_rank">{-:@RANK-}</option>
							<option{-if:'a_view_count'==$_CLI['cl_config']['orderby']-} selected="selected"{-:/if-} value="a_view_count">{-:@VIEW_COUNT-}</option>
							<option{-if:'a_support_count'==$_CLI['cl_config']['orderby']-} selected="selected"{-:/if-} value="a_support_count">{-:@SUPPORT_COUNT-}</option>
						</select>
					</label>
					<label>
						<select name="cl_config[order]">
							<option value="">{-:@ORDER-}</option>
							<option value="desc">{-:@DESC-}</option>
							<option value="asc">{-:@ASC-}</option>
						</select>
					</label>
					<label>
						<strong>{-:@PAGE_ROW-}</strong>
						<input name="cl_config[row]" class="i" type="text" value="{-:$_CLI['cl_config']['row']-}" size="5" />
					</label>
					<label>
						<strong>{-:@MAX_PAGE-}</strong>
						<input class="required i" type="text" value="{-:$_CLI['cl_config']['max_page']-}" name="cl_config[max_page]" maxlength="10" size="4">
						<span class="fc_gry"><span class="fc_r">*</span> <span class="fc_gry">{-:@CL_MAX_PAGE_TIP-}</span></span>
					</label>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@KEYWORDS-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="i" type="text" value="{-:$_CLI['cl_keywords']-}" name="cl_keywords" maxlength="255" size="50">
				</td>
				<td class="inputTip">
					{-:@CL_KEYWORDS_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@DESCRIPTION-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" name="cl_description" style="width:360px;height:60px;">{-:$_CLI['cl_description']-}</textarea>
				</td>
				<td class="inputTip">
					{-:@CL_DESCRIPTION_TIP-}
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<input name="custom_list_id" type="hidden" value="{-:$_CLI['custom_list_id']-}">
	<span class="btn_b submit" action="{-url:custom_list/edit_custom_list_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:custom_list/list_custom_list-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script>
var url_choose_template_file = '{-url:template/choose_template_file-}',
	l_choose_template = '{-:@CHOOSE_TEMPLATE-}';
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/c_t.js"></script>
</body>
</html>