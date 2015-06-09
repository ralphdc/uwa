<?php /* PFA Template Cache File. Create Time:2015-06-10 02:13:04 */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="/tpl/rz/admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="/tpl/rz/admin/css/mf.css" />
<link rel="stylesheet" type="text/css" href="<?php echo(__PUBLIC__); ?>js/dialog/artdialog.css" />
</head>
<body>
<form id="formAdd" action="" method="post">
<dl class="abox">
	<dt><strong><?php echo(L("ADD_CONTENT")); ?></strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle"><?php echo(L("TITLE")); ?></td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="" name="content_title" maxlength="96" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry"><?php echo(L("CT_TITLE_TIP")); ?></span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("GROUP")); ?></td>
				<td class="inputTitle"><?php echo(L("DISPLAY_ORDER")); ?></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="i" type="text" value="default" name="content_group" maxlength="32" size="16"> <span class="fc_gry"><?php echo(L("CT_GROUP_TIP")); ?></span>
				</td>
				<td class="inputArea">
					<input class="i" type="text" value="50" name="content_display_order" maxlength="10" size="4"> <span class="fc_gry"><?php echo(L("CT_DISPLAY_ORDER_TIP")); ?></span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("CONTENT")); ?> <span class="fc_gry"><?php echo(L("CT_CONTENT_TIP")); ?></span></td>
				<td class=""></td>
			</tr>
			<tr>
				<td colspan="2" class="inputArea">
					<textarea class="editor" name="content_content" style="width:95%;height:240px;"></textarea>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("KEYWORDS")); ?></td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="i" type="text" value="" name="content_keywords" maxlength="255" size="50">
				</td>
				<td class="inputTip">
					<?php echo(L("CT_KEYWORDS_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("DESCRIPTION")); ?></td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" name="content_description" style="width:360px;height:60px;"></textarea>
				</td>
				<td class="inputTip">
					<?php echo(L("CT_DESCRIPTION_TIP")); ?>
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
	<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
	<span class="btn_b submit" action="<?php echo(Url::U("content/add_content_do")); ?>" to="#formAdd"><?php echo(L("SUBMIT")); ?></span>
	<input class="btn_l" type="reset" value="<?php echo(L("RESET")); ?>" />
	<a class="btn_l" href="<?php echo(Url::U("single_page/list_single_page")); ?>"><?php echo(L("BACK")); ?></a>
</div>
</form>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="<?php echo(__PUBLIC__); ?>js/editor/ckeditor.js"></script>
<script src="<?php echo(__PUBLIC__); ?>js/dialog/artdialog.js"></script>
<script>
$(document).ready(function() {
	var editor_option = {
		filebrowserBrowseUrl : '<?php echo(Url::U("finder/browse?typeset=all&type=content")); ?>',
		filebrowserImageBrowseUrl : '<?php echo(Url::U("finder/browse?typeset=image&type=content")); ?>',
		filebrowserUploadUrl : '<?php echo(Url::U("upload/upload_file?typeset=all&upload_type=content&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}")); ?>',
		filebrowserImageUploadUrl : '<?php echo(Url::U("upload/upload_file?typeset=image&upload_type=content&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}")); ?>'
	};
	$('.editor').each(function(){
		CKEDITOR.replace(this, editor_option);
	});
});
var url_choose_template_file = '<?php echo(Url::U("template/choose_template_file")); ?>',
	l_choose_template = '<?php echo(L("CHOOSE_TEMPLATE")); ?>';
</script>
<script src="/tpl/rz/admin/js/c.js"></script>
<script src="/tpl/rz/admin/js/c_t.js"></script>
</body>
</html>