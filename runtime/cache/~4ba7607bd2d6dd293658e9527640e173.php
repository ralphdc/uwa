<?php /* PFA Template Cache File. Create Time:2015-06-06 01:14:49 */ ?>
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
<dl class="atab">
	<dt><strong><?php echo(L("GENERAL")); ?></strong><strong><?php echo(L("ADDON_FIELD")); ?></strong></dt>
	<dd>
		<div class="tabCntnt">
			<table class="formTable">
				<tr>
					<td class="inputTitle"><?php echo(L("ID")); ?></td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<?php echo($_AMI['archive_model_id']); ?><input type="hidden" value="<?php echo($_AMI['archive_model_id']); ?>" name="archive_model_id">
					</td>
					<td class="inputTip">
						<?php echo(L("ARCHIVE_MODEL_ID_TIP")); ?>
					</td>
				</tr>
				<tr>
					<td class="inputTitle"><?php echo(L("NAME")); ?></td>
					<td class="inputTitle"><?php echo(L("DISPLAY_ORDER")); ?></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="<?php echo($_AMI['am_name']); ?>" name="am_name" maxlength="64" size="30">
						<span class="fc_gry"><span class="fc_r">*</span> <?php echo(L("AM_NAME_TIP")); ?></span>
					</td>
					<td class="inputArea">
						<input class="required i" type="text" value="<?php echo($_AMI['am_display_order']); ?>" name="am_display_order" maxlength="10" size="6">
						<span class="fc_gry"><span class="fc_r">*</span> <?php echo(L("AM_DISPLAY_ORDER_TIP")); ?></span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle"><?php echo(L("ALIAS")); ?></td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<?php echo($_AMI['am_alias']); ?>
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
						<?php echo($_AMI['am_addon_table']); ?>
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
					<?php if(0 == $_AMI['am_type']) :  ?><?php echo(L("SYSTEM")); ?><?php elseif(1 == $_AMI['am_type']) :  ?><?php echo(L("CUSTOM")); ?><?php endif; ?>
					</td>
					<td class="inputTip">
					<?php if(0 == $_AMI['am_type']) :  ?>
						<span class="fc_r"><?php echo(L("AM_TYPE_SYSTEM_TIP")); ?></span>
					<?php else : ?>
						<?php echo(L("AM_TYPE_TIP")); ?>
					<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td class="inputTitle"><?php echo(L("STATUS")); ?></td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<label><input type="radio" name="am_status" <?php if(1 == $_AMI['am_status']) :  ?> checked="checked"<?php endif; ?> value="1"> <?php echo(L("ON")); ?></label>
						<label><input type="radio" name="am_status" <?php if(0 == $_AMI['am_status']) :  ?> checked="checked"<?php endif; ?> value="0"> <?php echo(L("OFF")); ?></label>
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
						<input id="am_tpl_list" class="required i" type="text" value="<?php echo($_AMI['am_tpl_list']); ?>" name="am_tpl_list" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="admin" to_id="am_tpl_list"><?php echo(L("CHOOSE")); ?></span>
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
						<input id="am_tpl_add" class="required i" type="text" value="<?php echo($_AMI['am_tpl_add']); ?>" name="am_tpl_add" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="admin" to_id="am_tpl_add"><?php echo(L("CHOOSE")); ?></span>
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
						<input id="am_tpl_edit" class="required i" type="text" value="<?php echo($_AMI['am_tpl_edit']); ?>" name="am_tpl_edit" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="admin" to_id="am_tpl_edit"><?php echo(L("CHOOSE")); ?></span>
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
						<input id="am_tpl_list_member" class="i" type="text" value="<?php echo($_AMI['am_tpl_list_member']); ?>" name="am_tpl_list_member" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="member" to_id="am_tpl_list_member"><?php echo(L("CHOOSE")); ?></span>
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
						<input id="am_tpl_add_member" class="i" type="text" value="<?php echo($_AMI['am_tpl_add_member']); ?>" name="am_tpl_add_member" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="member" to_id="am_tpl_add_member"><?php echo(L("CHOOSE")); ?></span>
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
						<input id="am_tpl_edit_member" class="i" type="text" value="<?php echo($_AMI['am_tpl_edit_member']); ?>" name="am_tpl_edit_member" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="member" to_id="am_tpl_edit_member"><?php echo(L("CHOOSE")); ?></span>
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
					<input id="ac_tpl_index_default" class="i" type="text" value="<?php echo($_AMI['ac_tpl_index_default']); ?>" name="ac_tpl_index_default" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="home" to_id="ac_tpl_index_default"><?php echo(L("CHOOSE")); ?></span>
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
					<input id="ac_tpl_list_default" class="i" type="text" value="<?php echo($_AMI['ac_tpl_list_default']); ?>" name="ac_tpl_list_default" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="home" to_id="ac_tpl_list_default"><?php echo(L("CHOOSE")); ?></span>
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
					<input id="ac_tpl_archive_default" class="i" type="text" value="<?php echo($_AMI['ac_tpl_archive_default']); ?>" name="ac_tpl_archive_default" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="home" to_id="ac_tpl_archive_default"><?php echo(L("CHOOSE")); ?></span>
				</td>
				<td class="inputTip">
					<?php echo(L("AC_TPL_ARCHIVE_DEFAULT_TIP")); ?>
				</td>
			</tr>
			</table>
		</div>
		<div class="tabCntnt">
			<div id="operation">
				<a class="btn_l" href="<?php echo(Url::U("archive_model/add_model_field?archive_model_id={$_AMI['archive_model_id']}")); ?>"><?php echo(L("ADD_FIELD")); ?></a>
			</div>
			<table class="listTable">
				<tr>
					<th scope="col"><?php echo(L("FIELD_NAME")); ?></th>
					<th scope="col"><?php echo(L("NAME")); ?></th>
					<th scope="col"><?php echo(L("DATA_TYPE")); ?></th>
					<th scope="col"><?php echo(L("FORM_TYPE")); ?></th>
					<th scope="col"><?php echo(L("MANAGE")); ?></th>
				</tr>
				<?php if(isset($_AMI['am_field']) and is_array($_AMI['am_field'])) : foreach($_AMI['am_field'] as $k => $v) : ?>
				<tr>
					<td><?php echo($k); ?></td>
					<td><?php echo($v['f_item_name']); ?></td>
					<td><?php echo(L("FILED_{$v['f_type']}")); ?></td>
					<td><?php if(1 == $v['f_is_auto']) :  ?><?php echo(L("AUTO_FIELD")); ?><?php else : ?><?php echo(L("FIXED_FIELD")); ?><?php endif; ?></td>
					<td><a href="<?php echo(Url::U("archive_model/edit_model_field?archive_model_id={$_AMI['archive_model_id']}&f_name={$k}")); ?>"><?php echo(L("EDIT")); ?></a> | <a href="<?php echo(Url::U("archive_model/delete_model_field_do?archive_model_id={$_AMI['archive_model_id']}&f_name={$k}&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>" onclick="javascript:return delete_confirm();" ><?php echo(L("DELETE")); ?></a></td>
				</tr>
				<?php endforeach; endif; ?>
			</table>
			<table class="formTable">
				<tr>
					<td colspan="2" class="inputTitle"><?php echo(L("AM_FIELDSET")); ?> <span class="fc_gry fw_n"><span class="fc_r">*</span> <?php echo(L("AM_FIELDSET_TIP")); ?></span></td>
				</tr>
				<tr>
					<td colspan="2" class="inputArea">
						<textarea class="i" name="am_fieldset" style="width:90%;height:150px;"><?php echo($_AMI['am_fieldset']); ?></textarea>
					</td>
				</tr>
			</table>
		</div>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
	<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
	<span class="btn_b submit" action="<?php echo(Url::U("archive_model/edit_model_do")); ?>" to="#formEdit"><?php echo(L("SUBMIT")); ?></span>
	<input class="btn_l" type="reset" value="<?php echo(L("RESET")); ?>" />
	<a class="btn_l" href="<?php echo(Url::U("archive_model/list_model")); ?>"><?php echo(L("BACK")); ?></a>
</div>
</form>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="<?php echo(__PUBLIC__); ?>js/dialog/artdialog.js"></script>
<script>
var url_choose_template_file = '<?php echo(Url::U("template/choose_template_file")); ?>',
	l_choose_template = '<?php echo(L("CHOOSE_TEMPLATE")); ?>';
</script>
<script src="/tpl/default/admin/js/c.js"></script>
<script src="/tpl/default/admin/js/c_t.js"></script>
</body>
</html>