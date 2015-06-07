<?php /* PFA Template Cache File. Create Time:2015-06-07 00:55:40 */ ?>
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
	<dt><strong><?php echo(L("GENERAL")); ?></strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle"><?php echo(L("NAME")); ?></td>
				<td class="inputTitle"><?php echo(L("DISPLAY_ORDER")); ?></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="" name="am_name" maxlength="64" size="30">
					<span class="fc_gry"><span class="fc_r">*</span> <?php echo(L("AM_NAME_TIP")); ?></span>
				</td>
				<td class="inputArea">
					<input class="required i" type="text" value="50" name="am_display_order" maxlength="10" size="6">
					<span class="fc_gry"><span class="fc_r">*</span> <?php echo(L("AM_DISPLAY_ORDER_TIP")); ?></span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("ALIAS")); ?></td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="" name="am_alias" maxlength="64" size="30"> <span class="btn_l" onClick="check_alias('am_alias');"><?php echo(L("CHECK_ALIAS")); ?></span> <span id="check_alias_result"></span>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("AM_ALIAS_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("ADDON_TABLE")); ?></td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="archive_addon_" name="am_addon_table" maxlength="64" size="30"> <span class="btn_l" onClick="check_table('am_addon_table');"><?php echo(L("CHECK_ADDON_TABLE")); ?></span> <span id="check_table_result"></span>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("AM_ADDON_TABLE_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("MODEL_TYPE")); ?></td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" name="am_type" value="0"> <?php echo(L("SYSTEM")); ?></label>
					<label><input type="radio" name="am_type" checked="checked" value="1"> <?php echo(L("CUSTOM")); ?></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("AM_TYPE_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("STATUS")); ?></td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" name="am_status" checked="checked" value="1"> <?php echo(L("ON")); ?></label>
					<label><input type="radio" name="am_status" value="0"> <?php echo(L("OFF")); ?></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("AM_STATUS_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("AM_TPL_LIST")); ?></td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="am_tpl_list"  class="required i" type="text" value="archive/list_archive" name="am_tpl_list" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="admin" to_id="am_tpl_list"><?php echo(L("CHOOSE")); ?></span>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("AM_TPL_LIST_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("AM_TPL_ADD")); ?></td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="am_tpl_add"  class="required i" type="text" value="archive/add_archive" name="am_tpl_add" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="admin" to_id="am_tpl_add"><?php echo(L("CHOOSE")); ?></span>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("AM_TPL_ADD_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("AM_TPL_EDIT")); ?></td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="am_tpl_edit"  class="required i" type="text" value="archive/edit_archive" name="am_tpl_edit" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="admin" to_id="am_tpl_edit"><?php echo(L("CHOOSE")); ?></span>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("AM_TPL_EDIT_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("AM_TPL_LIST_MEMBER")); ?></td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="am_tpl_list_member"  class="i" type="text" value="archive/list_archive" name="am_tpl_list_member" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="member" to_id="am_tpl_list_member"><?php echo(L("CHOOSE")); ?></span>
				</td>
				<td class="inputTip">
					<?php echo(L("AM_TPL_LIST_MEMBER_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("AM_TPL_ADD_MEMBER")); ?></td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="am_tpl_add_member"  class="i" type="text" value="archive/add_archive" name="am_tpl_add_member" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="member" to_id="am_tpl_add_member"><?php echo(L("CHOOSE")); ?></span>
				</td>
				<td class="inputTip">
					<?php echo(L("AM_TPL_ADD_MEMBER_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("AM_TPL_EDIT_MEMBER")); ?></td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="am_tpl_edit_member"  class="i" type="text" value="archive/edit_archive" name="am_tpl_edit_member" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="member" to_id="am_tpl_edit_member"><?php echo(L("CHOOSE")); ?></span>
				</td>
				<td class="inputTip">
					<?php echo(L("AM_TPL_EDIT_MEMBER_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("AC_TPL_INDEX_DEFAULT")); ?></td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="ac_tpl_index_default" class="i" type="text" value="index_channel" name="ac_tpl_index_default" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="home" to_id="ac_tpl_index_default"><?php echo(L("CHOOSE")); ?></span>
				</td>
				<td class="inputTip">
					<?php echo(L("AC_TPL_INDEX_DEFAULT_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("AC_TPL_LIST_DEFAULT")); ?></td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="ac_tpl_list_default" class="i" type="text" value="list_archive" name="ac_tpl_list_default" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="home" to_id="ac_tpl_list_default"><?php echo(L("CHOOSE")); ?></span>
				</td>
				<td class="inputTip">
					<?php echo(L("AC_TPL_LIST_DEFAULT_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("AC_TPL_ARCHIVE_DEFAULT")); ?></td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="ac_tpl_archive_default" class="i" type="text" value="show_archive" name="ac_tpl_archive_default" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="home" to_id="ac_tpl_archive_default"><?php echo(L("CHOOSE")); ?></span>
				</td>
				<td class="inputTip">
					<?php echo(L("AC_TPL_ARCHIVE_DEFAULT_TIP")); ?>
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
	<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
	<span class="btn_b submit" action="<?php echo(Url::U("archive_model/add_model_do")); ?>" to="#formAdd"><?php echo(L("SUBMIT")); ?></span>
	<input class="btn_l" type="reset" value="<?php echo(L("RESET")); ?>" />
	<a class="btn_l" href="<?php echo(Url::U("archive_model/list_model")); ?>"><?php echo(L("BACK")); ?></a>
</div>
</form>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="<?php echo(__PUBLIC__); ?>js/dialog/artdialog.js"></script>
<script>
var url_choose_template_file = '<?php echo(Url::U("template/choose_template_file")); ?>',
	l_choose_template = '<?php echo(L("CHOOSE_TEMPLATE")); ?>';

var url_check_alias = '<?php echo(Url::U("ajax/check_model_alias?type=archive")); ?>',
	url_check_table = '<?php echo(Url::U("ajax/check_table")); ?>',
	checking = '<?php echo(L("CHECKING")); ?>';
</script>
<script src="/tpl/rz/admin/js/c.js"></script>
<script src="/tpl/rz/admin/js/c_t.js"></script>
<script src="/tpl/rz/admin/js/am.js"></script>
</body>
</html>