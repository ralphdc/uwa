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
	<dt><strong>{-:@EDIT_UPLOAD-}</strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@FILENAME-}</td>
				<td class="inputTitle"></td>
			</tr>
			<tr>
				<td colspan="2" class="inputArea">
					<input class="required i" type="text" value="{-:$_UI['u_filename']-}" name="u_filename" maxlength="96" size="30">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@U_FILENAME_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@SRC-}</td>
				<td class="inputTitle"></td>
			</tr>
			<tr>
				<td colspan="2" class="inputArea">
					<span class="preview a fc_b p_2_5 br_3 br_b" src="{-:$_UI['u_src']-}" title="{-:$_UI['u_filename']-}">{-:$_UI['u_src']-}</span>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="inputArea">
					<label><strong>{-:@TYPE-}</strong>: {-:$_UI['u_type']-}
					<span class="fc_r">*</span> <span class="fc_gry">{-:@U_TYPE_TIP-}</span></label>
					<label><strong>{-:@SIZE-}</strong>: {-:$_UI['u_size']|byte_format~@me-} [{-:$_UI['u_size']-} Byte]
					<span class="fc_r">*</span> <span class="fc_gry">{-:@U_SIZE_TIP-}</span></label>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="inputArea">
					<label><strong>{-:@MEMBER_ID-}</strong>: {-:$_UI['member_id']-}</label>
					<label><strong>{-:@ITEM_TYPE-}</strong>: {-:$_UI['u_item_type']-}</label>
					<label><strong>{-:@ITEM_ID-}</strong>: {-:$_UI['u_item_id']-}</label>
					<label><strong>{-:@ADD_TIME-}</strong>: {-:$_UI['u_add_time']|date~C('APP.TIME_FORMAT'),@me-}</label>
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<input type="hidden" value="{-:$_UI['upload_id']-}" name="upload_id">
	<span class="btn_b submit" action="{-url:upload/edit_upload_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:upload/list_upload-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script>
$(document).on('click', '.preview', function() {
	var i_src = $(this).attr('src'),
		i_title = $(this).attr('title');
	dialog({
		padding: 0,
		title: i_title,
		content: '<img src="' + i_src + '" />'
	}).showModal();
});
</script>
</body>
</html>