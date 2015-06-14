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
<form id="formAdd" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@ADD_CCATEGORY-}</strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@TITLE-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="" name="ccategory_title" maxlength="96" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@CT_TITLE_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@GROUP-}</td>
				<td class="inputTitle">{-:@DISPLAY_ORDER-}</td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="i" type="text" value="default" name="ccategory_group" maxlength="32" size="16"> <span class="fc_gry">{-:@CT_GROUP_TIP-}</span>
				</td>
				<td class="inputArea">
					<input class="i" type="text" value="50" name="ccategory_display_order" maxlength="10" size="4"> <span class="fc_gry">{-:@CT_DISPLAY_ORDER_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@PARENTCATEGORY-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
				    <select name="ccategory_parent">
				    {-foreach:$ps,$p-}
				        <option value="{-:$p['pcategory_id']-}">{-:$p['pcategory_title']-}</option>
				    {-:/foreach-}
				    </select>
				</td>
				<td class="inputTip">
					{-:@PARENT_CATEGORY_TIP-}
					
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@KEYWORDS-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="i" type="text" value="" name="ccategory_keywords" maxlength="255" size="50">
				</td>
				<td class="inputTip">
					{-:@CT_KEYWORDS_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@DESCRIPTION-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" name="ccategory_description" style="width:360px;height:60px;"></textarea>
				</td>
				<td class="inputTip">
					{-:@CT_DESCRIPTION_TIP-}
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_b submit" action="{-url:ccategory/add_ccategory_do-}" to="#formAdd">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:ccategory/list_ccategory-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/editor/ckeditor.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script>
var url_choose_template_file = '{-url:template/choose_template_file-}',
	l_choose_template = '{-:@CHOOSE_TEMPLATE-}';
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/c_t.js"></script>
</body>
</html>