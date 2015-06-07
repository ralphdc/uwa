<?php /* PFA Template Cache File. Create Time:2015-06-06 22:59:15 */ ?>
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
	<dt><strong><?php echo(L("ADD_SINGLE_PAGE")); ?></strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle"><?php echo(L("TITLE")); ?></td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="" name="sp_title" maxlength="96" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry"><?php echo(L("SP_TITLE_TIP")); ?></span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("GROUP")); ?></td>
				<td class="inputTitle"><?php echo(L("DISPLAY_ORDER")); ?></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="i" type="text" value="default" name="sp_group" maxlength="32" size="16"> <span class="fc_gry"><?php echo(L("SP_GROUP_TIP")); ?></span>
				</td>
				<td class="inputArea">
					<input class="i" type="text" value="50" name="sp_display_order" maxlength="10" size="4"> <span class="fc_gry"><?php echo(L("SP_DISPLAY_ORDER_TIP")); ?></span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("IS_HTML")); ?></td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="sp_is_html"> <?php echo(L("OFF")); ?></label>
					<label><input type="radio" value="1" name="sp_is_html" checked="checked"> <?php echo(L("ON")); ?></label>
				</td>
				<td class="inputArea">
					<span class="fc_gry"><?php echo(L("SP_IS_HTML_TIP")); ?></span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("TEMPLATE")); ?></td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="sp_tpl" class="required i" type="text" value="show_single_page" name="sp_tpl" maxlength="96" size="30"> <span class="btn_l choose_template" base_dir="home" to_id="sp_tpl"><?php echo(L("CHOOSE")); ?></span>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry"><?php echo(L("SP_TPL_TIP")); ?></span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("HTML_NAMING")); ?></td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="i" type="text" value="" name="sp_html_naming" maxlength="96" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_gry"><?php echo(L("SP_HTML_NAMING_TIP")); ?></span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("CONTENT")); ?> <span class="fc_gry"><?php echo(L("SP_CONTENT_TIP")); ?></span></td>
				<td class=""></td>
			</tr>
			<tr>
				<td colspan="2" class="inputArea">
					<textarea class="editor" name="sp_content" style="width:95%;height:240px;"></textarea>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("KEYWORDS")); ?></td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="i" type="text" value="" name="sp_keywords" maxlength="255" size="50">
				</td>
				<td class="inputTip">
					<?php echo(L("SP_KEYWORDS_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("DESCRIPTION")); ?></td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" name="sp_description" style="width:360px;height:60px;"></textarea>
				</td>
				<td class="inputTip">
					<?php echo(L("SP_DESCRIPTION_TIP")); ?>
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
	<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
	<span class="btn_b submit" action="<?php echo(Url::U("single_page/add_single_page_do")); ?>" to="#formAdd"><?php echo(L("SUBMIT")); ?></span>
	<input class="btn_l" type="reset" value="<?php echo(L("RESET")); ?>" />
	<a class="btn_l" href="<?php echo(Url::U("single_page/list_single_page")); ?>"><?php echo(L("BACK")); ?></a>
	<label><input type="checkbox" name="build_now" value="1" checked="checked" /> <?php echo(L("BUILD_NOW")); ?></label>
</div>
</form>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="<?php echo(__PUBLIC__); ?>js/editor/ckeditor.js"></script>
<script src="<?php echo(__PUBLIC__); ?>js/dialog/artdialog.js"></script>
<script>
$(document).ready(function() {
	var editor_option = {
		filebrowserBrowseUrl : '<?php echo(Url::U("finder/browse?typeset=all&type=single_page")); ?>',
		filebrowserImageBrowseUrl : '<?php echo(Url::U("finder/browse?typeset=image&type=single_page")); ?>',
		filebrowserUploadUrl : '<?php echo(Url::U("upload/upload_file?typeset=all&upload_type=single_page&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}")); ?>',
		filebrowserImageUploadUrl : '<?php echo(Url::U("upload/upload_file?typeset=image&upload_type=single_page&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}")); ?>'
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