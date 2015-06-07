<?php /* PFA Template Cache File. Create Time:2015-06-07 00:37:52 */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="/tpl/rz/admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="/tpl/rz/admin/css/mf.css" />
<link rel="stylesheet" type="text/css" href="<?php echo(__PUBLIC__); ?>js/dialog/artdialog.css" />
<link rel="stylesheet" type="text/css" href="<?php echo(__PUBLIC__); ?>js/calendar/calendar.css" />
<script src="<?php echo(__PUBLIC__); ?>js/calendar/calendar.js"></script>
<script src="<?php echo(__PUBLIC__); ?>js/calendar/lang/<?php echo(ACookie::get("lang")); ?>.js"></script>
</head>
<body>
<form id="formEdit" action="" method="post">
<dl class="atab">
	<dt><strong><?php echo(L("GENERAL")); ?></strong><strong><?php echo(L("ADVANCED")); ?></strong><strong><?php echo(L("CONTENT")); ?></strong></dt>
	<dd>
		<div class="tabCntnt">
			<table class="formTable">
				<tr>
					<td class="inputTitle"><?php echo(L("NAME")); ?></td>
					<td class="inputTitle"><?php echo(L("MODEL")); ?></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="<?php echo($_ACI['ac_name']); ?>" name="ac_name" maxlength="64" size="30"> <span class="fc_r">*</span>
					</td>
					<td class="inputArea">
						<?php echo($_ACI['am_name']); ?> | <?php echo($_ACI['am_alias']); ?> <span class="fc_r">*</span> <span class="fc_gry"><?php echo(L("ARCHIVE_MODEL_TIP")); ?></span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle"><?php echo(L("PARENT_CHANNEL")); ?></td>
					<td class="inputTitle"><?php echo(L("DISPLAY_SWITCH")); ?></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="ac_parent_id" type="hidden" value="<?php echo($_ACI['ac_parent_id']); ?>" name="ac_parent_id" />
						<span id="ac_parent_id_channel_select" class="channel_select" to='#ac_parent_id' archive_model_id="<?php echo($_ACI['archive_model_id']); ?>"></span>
					</td>
					<td class="inputArea">
						<label><input type="radio" value="0" name="ac_display_switch"<?php if(0==$_ACI['ac_display_switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("HIDDEN")); ?></label>
						<label><input type="radio" value="1" name="ac_display_switch"<?php if(1==$_ACI['ac_display_switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("SHOW")); ?></label>
						<span class="fc_gry"><span class="fc_r">*</span> <?php echo(L("AC_DISPLAY_SWITCH_TIP")); ?></span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle"><?php echo(L("CHANNEL_TYPE")); ?></td>
					<td class="inputTitle"><?php echo(L("DISPLAY_ORDER")); ?></td>
				</tr>
				<tr>
					<td class="inputArea">
						<label><input type="radio" value="1" name="ac_type"<?php if(1==$_ACI['ac_type']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("CHANNEL_COVER")); ?></label>
						<label><input type="radio" value="2" name="ac_type"<?php if(2==$_ACI['ac_type']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("CHANNEL_LIST")); ?></label>
					</td>
					<td class="inputTip">
						<input class="required i" type="text" value="<?php echo($_ACI['ac_display_order']); ?>" name="ac_display_order" maxlength="10" size="6"> <span class="fc_r">*</span> <?php echo(L("AC_DISPLAY_ORDER_TIP")); ?>
					</td>
				</tr>
				<tr>
					<td class="inputTitle"><?php echo(L("AC_TPL_INDEX")); ?></td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="ac_tpl_index" class="required i" type="text" value="<?php echo($_ACI['ac_tpl_index']); ?>" name="ac_tpl_index" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="home" to_id="ac_tpl_index"><?php echo(L("CHOOSE")); ?></span>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> <?php echo(L("AC_TPL_INDEX_TIP")); ?>
					</td>
				</tr>
				<tr>
					<td class="inputTitle"><?php echo(L("AC_TPL_LIST")); ?></td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="ac_tpl_list" class="required i" type="text" value="<?php echo($_ACI['ac_tpl_list']); ?>" name="ac_tpl_list" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="home" to_id="ac_tpl_list"><?php echo(L("CHOOSE")); ?></span>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> <?php echo(L("AC_TPL_LIST_TIP")); ?>
					</td>
				</tr>
				<tr>
					<td class="inputTitle"><?php echo(L("AC_TPL_ARCHIVE")); ?></td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="ac_tpl_archive" class="required i" type="text" value="<?php echo($_ACI['ac_tpl_archive']); ?>" name="ac_tpl_archive" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="home" to_id="ac_tpl_archive"><?php echo(L("CHOOSE")); ?></span>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> <?php echo(L("AC_TPL_ARCHIVE_TIP")); ?>
					</td>
				</tr>
				<tr>
					<td class="inputTitle"><?php echo(L("PAGE_SIZE")); ?></td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="<?php echo($_ACI['ac_page_size']); ?>" name="ac_page_size" maxlength="10" size="6">
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> <?php echo(L("AC_PAGE_SIZE_TIP")); ?>
					</td>
				</tr>
				<?php if(0==$_ACI['ac_parent_id']) :  ?><tr>
					<td class="inputTitle"><?php echo(L("UPDATE_SUB")); ?></td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<label><input type="checkbox" value="1" name="update_sub"> <?php echo(L("UPDATE")); ?></label>
					</td>
					<td class="inputTip">
						<?php echo(L("UPDATE_SUB_TIP")); ?>
					</td>
				</tr><?php endif; ?>
			</table>
		</div>
		<div class="tabCntnt">
			<table class="formTable">
				<tr>
					<td class="inputTitle"><?php echo(L("AC_VIEW_ML_IDS")); ?></td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<select name="ac_view_ml_ids[]" multiple="multiple" size="4" style="width:180px;">
							<option value="-1"<?php if(in_array(-1, $_ACI['ac_view_ml_ids'])) :  ?> selected="selected"<?php endif; ?>><?php echo(L("CLOSE_ALL")); ?></option>
							<option value="0"<?php if(empty($_ACI['ac_view_ml_ids']) or in_array(0, $_ACI['ac_view_ml_ids'])) :  ?> selected="selected"<?php endif; ?>><?php echo(L("OPEN_ALL")); ?></option>
						<?php if(isset($_MLL) and is_array($_MLL)) : foreach($_MLL as $l) : ?>
							<option value="<?php echo($l['member_level_id']); ?>"<?php if(in_array($l['member_level_id'], $_ACI['ac_view_ml_ids'])) :  ?> selected="selected"<?php endif; ?>><?php echo($l['ml_name']); ?></option>
						<?php endforeach; endif; ?>
						</select>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> <?php echo(L("AC_VIEW_ML_IDS_TIP")); ?>
					</td>
				</tr>
				<tr>
					<td class="inputTitle"><?php echo(L("AC_ADD_ML_IDS")); ?> <span class="fc_gry fw_n"><span class="fc_r">*</span> <?php echo(L("AC_ADD_ML_IDS_TIP")); ?></span></td>
					<td class="inputTitle"><?php echo(L("PASS_SWITCH")); ?></td>
				</tr>
				<tr>
					<td class="inputArea">
						<label>
							<select name="ac_add_ml_ids[]" multiple="multiple" size="4" style="width:180px;">
								<option value="-1"<?php if(in_array(-1, $_ACI['ac_add_ml_ids'])) :  ?> selected="selected"<?php endif; ?>><?php echo(L("CLOSE_ALL")); ?></option>
								<option value="0"<?php if(empty($_ACI['ac_add_ml_ids']) or in_array(0, $_ACI['ac_add_ml_ids'])) :  ?> selected="selected"<?php endif; ?>><?php echo(L("OPEN_ALL")); ?></option>
							<?php if(isset($_MLL) and is_array($_MLL)) : foreach($_MLL as $l) : ?>
								<option value="<?php echo($l['member_level_id']); ?>"<?php if(in_array($l['member_level_id'], $_ACI['ac_add_ml_ids'])) :  ?> selected="selected"<?php endif; ?>><?php echo($l['ml_name']); ?></option>
							<?php endforeach; endif; ?>
							</select>
						</label>
					</td>
					<td class="inputArea">
						<label><input type="radio" value="0" name="ac_pass_switch"<?php if(0==$_ACI['ac_pass_switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("OFF")); ?></label>
						<label><input type="radio" value="1" name="ac_pass_switch"<?php if(1==$_ACI['ac_pass_switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("ON")); ?></label>
						<span class="fc_r">*</span> <span class="fc_gry"><?php echo(L("AC_PASS_SWITCH_TIP")); ?></span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">HTML<?php echo(L("SWITCH")); ?></td>
					<td class="inputTitle"><?php echo(L("REVIEW_SWITCH")); ?></td>
				</tr>
				<tr>
					<td class="inputArea">
						<label><input type="radio" value="0" name="ac_is_html"<?php if(0==$_ACI['ac_is_html']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("NOT_HTML")); ?></label>
						<label><input type="radio" value="1" name="ac_is_html"<?php if(1==$_ACI['ac_is_html']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("IS_HTML")); ?></label>
						<label><input type="radio" value="2" name="ac_is_html"<?php if(2==$_ACI['ac_is_html']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("ONLY_ARCHIVE_IS_HTML")); ?></label>
					</td>
					<td class="inputArea">
						<label><input type="radio" value="0" name="ac_review_switch"<?php if(0==$_ACI['ac_review_switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("OFF")); ?></label>
						<label><input type="radio" value="1" name="ac_review_switch"<?php if(1==$_ACI['ac_review_switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("ON")); ?></label>
					</td>
				</tr>
				<tr>
					<td class="inputTitle"><?php echo(L("AC_HTML_DIR")); ?></td>
					<td class=""></td>
				</tr>
				<tr>
					<td colspan="2" class="inputArea">
						<input class="i" type="text" value="<?php echo($_ACI['ac_html_dir']); ?>" name="ac_html_dir" maxlength="255" size="40">
						<span class="fc_gry"><?php echo(L("AC_HTML_DIR_TIP")); ?></span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle"><?php echo(L("AC_HTML_INDEX")); ?></td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="i" type="text" value="<?php echo($_ACI['ac_html_index']); ?>" name="ac_html_index" maxlength="255" size="30">
					</td>
					<td class="inputTip">
						<?php echo(L("AC_HTML_INDEX_TIP")); ?>
					</td>
				</tr>
				<tr>
					<td class="inputTitle"><?php echo(L("AC_HTML_NAMING_LIST")); ?></td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="i" type="text" value="<?php echo($_ACI['ac_html_naming_list']); ?>" name="ac_html_naming_list" maxlength="255" size="30">
					</td>
					<td class="inputTip">
						<?php echo(L("AC_HTML_NAMING_LIST_TIP")); ?>
					</td>
				</tr>
				<tr>
					<td class="inputTitle"><?php echo(L("AC_HTML_NAMING_ARCHIVE")); ?></td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="i" type="text" value="<?php echo($_ACI['ac_html_naming_archive']); ?>" name="ac_html_naming_archive" maxlength="255" size="30">
					</td>
					<td class="inputTip">
						<?php echo(L("AC_HTML_NAMING_ARCHIVE_TIP")); ?>
					</td>
				</tr>
			</table>
		</div>
		<div class="tabCntnt">
			<table class="formTable">
				<tr>
					<td class="inputTitle"><?php echo(L("CHANNEL_THUMB")); ?></td>
					<td class="inputArea" rowspan="6" valign="top" style="padding-left:20px;">
					<?php if(!empty($_ACI['ac_thumb'])) :  ?>
						<img id="ac_thumb_preview" src="<?php echo($_ACI['ac_thumb']); ?>" /></td>
					<?php else : ?>
						<img id="ac_thumb_preview" src="<?php echo(__APP__); ?>u/site/default_channel_thumb.png" /></td>
					<?php endif; ?>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="ac_thumb" class="i" type="text" value="<?php echo($_ACI['ac_thumb']); ?>" name="ac_thumb" maxlength="255" size="70">
						<input id="ac_thumb_uploader" to="#ac_thumb" preview="#ac_thumb_preview" btntext="<?php echo(L("UPLOAD")); ?>" typeset='image' thumb='no' class="uploader" type="file" />
						<span id="ac_thumb_finder" to="#ac_thumb" preview="#ac_thumb_preview" typeset='image' class="btn_l finder"><?php echo(L("BROWSE_SERVER")); ?></span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle"><?php echo(L("KEYWORDS")); ?></td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<textarea class="i" name="ac_keywords" style="width:360px;height:40px;"><?php echo($_ACI['ac_keywords']); ?></textarea> <span class="fc_gry"><?php echo(L("AC_KEYWORDS_TIP")); ?></span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle"><?php echo(L("DESCRIPTION")); ?></td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<textarea class="i" name="ac_description" style="width:360px;height:60px;"><?php echo($_ACI['ac_description']); ?></textarea> <span class="fc_gry"><?php echo(L("AC_DESCRIPTION_TIP")); ?></span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle"><?php echo(L("CONTENT")); ?> <span class="fc_gry"><?php echo(L("AC_CONTENT_TIP")); ?></span></td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea" colspan="2">
						<textarea class="editor" name="ac_content" style="width:95%;height:180px;"><?php echo(htmlspecialchars($_ACI['ac_content'])); ?></textarea>
					</td>
				</tr>
			</table>
		</div>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
	<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
	<input type="hidden" value="<?php echo($_ACI['archive_channel_id']); ?>" name="archive_channel_id">
	<input type="hidden" value="<?php echo($_ACI['archive_model_id']); ?>" name="archive_model_id">
	<span class="btn_b submit" action="<?php echo(Url::U("archive_channel/edit_channel_do")); ?>" to="#formEdit"><?php echo(L("SUBMIT")); ?></span>
	<input class="btn_l" type="reset" value="<?php echo(L("RESET")); ?>" />
	<a class="btn_l" href="<?php echo(Url::U("archive_channel/list_channel")); ?>"><?php echo(L("BACK")); ?></a>
</div>
</form>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="<?php echo(__PUBLIC__); ?>js/uploadify/uploadify.js"></script>
<script src="<?php echo(__PUBLIC__); ?>js/editor/ckeditor.js"></script>
<script src="<?php echo(__PUBLIC__); ?>js/dialog/artdialog.js"></script>
<script>
$(document).ready(function() {
	var editor_option = {
		filebrowserBrowseUrl : '<?php echo(Url::U("finder/browse?typeset=all&type=channel")); ?>',
		filebrowserImageBrowseUrl : '<?php echo(Url::U("finder/browse?typeset=all&type=channel")); ?>',
		filebrowserUploadUrl : '<?php echo(Url::U("upload/upload_file?typeset=all&upload_type=channel&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}")); ?>',
		filebrowserImageUploadUrl : '<?php echo(Url::U("upload/upload_file?typeset=image&upload_type=channel&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}")); ?>'
	};
	$('.editor').each(function(){
		CKEDITOR.replace(this, editor_option);
	});
});

var type_desc_all = '<?php echo(L("FILE")); ?>', file_type_exts_all = '<?php echo($_OU['all']); ?>',
	type_desc_image = '<?php echo(L("IMAGE")); ?>', file_type_exts_image = '<?php echo($_OU['img']); ?>',
	form_data = {'<?php echo session_name(); ?>' : '<?php echo session_id(); ?>', 'timeKey' : '<?php echo($_TK["timeKey"]); ?>', 'token' : '<?php echo($_TK["token"]); ?>'},
	uploadify_swf = '<?php echo(__PUBLIC__); ?>js/uploadify/uploadify.swf',
	uploader_all = '<?php echo(Url::U("upload/upload_file?typeset=all&upload_type=channel")); ?>',
	uploader_image = '<?php echo(Url::U("upload/upload_file?typeset=image&upload_type=channel&watermark=yes")); ?>',
	uploader_image_thumb = '<?php echo(Url::U("upload/upload_file?typeset=image&upload_type=channel&thumb=yes")); ?>',
	uploader_image_thumb_both = '<?php echo(Url::U("upload/upload_file?typeset=image&upload_type=channel&thumb=both")); ?>';

var finder_browse_url_all = '<?php echo(Url::U("finder/browse?typeset=all&type=channel")); ?>',
	finder_browse_url_image = '<?php echo(Url::U("finder/browse?typeset=image&type=channel")); ?>',
	finder_browse_url_file = '<?php echo(Url::U("finder/browse?typeset=file&type=channel")); ?>';

var url_choose_template_file = '<?php echo(Url::U("template/choose_template_file")); ?>',
	l_choose_template = '<?php echo(L("CHOOSE_TEMPLATE")); ?>';

var url_get_channel_select = '<?php echo(Url::U("ajax/get_channel_select")); ?>';
</script>
<script src="/tpl/rz/admin/js/c.js"></script>
<script src="/tpl/rz/admin/js/u.js"></script>
<script src="/tpl/rz/admin/js/f.js"></script>
<script src="/tpl/rz/admin/js/c_t.js"></script>
<script src="/tpl/rz/admin/js/g_ac.js"></script>
</body>
</html>