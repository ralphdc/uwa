<?php /* PFA Template Cache File. Create Time:2015-06-06 10:21:55 */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="/tpl/default/admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="/tpl/default/admin/css/mf.css" />
<link rel="stylesheet" type="text/css" href="<?php echo(__PUBLIC__); ?>js/dialog/artdialog.css" />
</head>
<body>
<form id="formEdit" action="" method="post">
<dl class="abox">
	<dt><span><a href="<?php echo(Url::U("option/edit_option_site")); ?>"><?php echo(L("SITE")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_core")); ?>"><?php echo(L("CORE")); ?></a></span><strong><?php echo(L("INDEX")); ?></strong><span><a href="<?php echo(Url::U("option/edit_option_performance")); ?>"><?php echo(L("PERFORMANCE")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_upload")); ?>"><?php echo(L("UPLOAD")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_image")); ?>"><?php echo(L("IMAGE")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_member")); ?>"><?php echo(L("MEMBER")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_interaction")); ?>"><?php echo(L("INTERACTION")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_custom_option")); ?>"><?php echo(L("CUSTOM_OPTION")); ?></a></span></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle"><?php echo(L("INDEX_HTML_SWITCH")); ?> [index/html_switch]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="index[html_switch]"<?php if(0==$_O['index']['html_switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("OFF")); ?></label>
					<label><input type="radio" value="1" name="index[html_switch]"<?php if(1==$_O['index']['html_switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("ON")); ?></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("INDEX_HTML_SWITCH_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("INDEX_PAGING_SWITCH")); ?> [index/paging_switch]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="index[paging_switch]"<?php if(0==$_O['index']['paging_switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("OFF")); ?></label>
					<label><input type="radio" value="1" name="index[paging_switch]"<?php if(1==$_O['index']['paging_switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("ON")); ?></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("INDEX_PAGING_SWITCH_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("INDEX_PAGE_SIZE")); ?> [index/page_size]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['index']['page_size']); ?>" name="index[page_size]" maxlength="10" size="6">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("INDEX_PAGE_SIZE_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("INDEX_TEMPLATE")); ?> [index/tpl]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="index_tpl" class="required i" type="text" value="<?php echo($_O['index']['tpl']); ?>" name="index[tpl]" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="home" to_id="index_tpl"><?php echo(L("CHOOSE")); ?></span>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("INDEX_TEMPLATE_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("INDEX_TEMPLATE_PAGING")); ?> [index/tpl_paging]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="index_tpl_paging" class="required i" type="text" value="<?php echo($_O['index']['tpl_paging']); ?>" name="index[tpl_paging]" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="home" to_id="index_tpl_paging"><?php echo(L("CHOOSE")); ?></span>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("INDEX_TEMPLATE_PAGING_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("INDEX_HTML_NAMING")); ?> [index/html_naming]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['index']['html_naming']); ?>" name="index[html_naming]" maxlength="255" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("INDEX_HTML_NAMING_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("INDEX_HTML_NAMING_PAGING")); ?> [index/html_naming_paging]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['index']['html_naming_paging']); ?>" name="index[html_naming_paging]" maxlength="255" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("INDEX_HTML_NAMING_PAGING_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("INDEX_HTML_PATH_PAGING")); ?> [index/html_path_paging]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['index']['html_path_paging']); ?>" name="index[html_path_paging]" maxlength="255" size="50" />
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("INDEX_HTML_PATH_PAGING_TIP")); ?>
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
	<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
	<span class="btn_b submit" action="<?php echo(Url::U("option/edit_option_index_do")); ?>" to="#formEdit"><?php echo(L("SUBMIT")); ?></span>
	<input class="btn_l" type="reset" value="<?php echo(L("RESET")); ?>" />
</div>
</form>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="<?php echo(__PUBLIC__); ?>js/dialog/artdialog.js"></script>
<script>
var url_choose_template_file = '<?php echo(Url::U("template/choose_template_file")); ?>',
	l_choose_template = '<?php echo(L("CHOOSE_TEMPLATE")); ?>';

var l_option_not_saved_tip = '<?php echo(L("OPTION_NOT_SAVED_TIP")); ?>';
</script>
<script src="/tpl/default/admin/js/c.js"></script>
<script src="/tpl/default/admin/js/c_t.js"></script>
<script src="/tpl/default/admin/js/o.js"></script>
</body>
</html>