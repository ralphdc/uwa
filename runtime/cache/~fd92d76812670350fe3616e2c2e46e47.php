<?php /* PFA Template Cache File. Create Time:2015-06-06 12:00:46 */ ?>
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
	<dt><strong><?php echo(L("GENERAL")); ?></strong><strong><?php echo(L("ADVANCED")); ?></strong></dt>
	<dd>
		<div class="tabCntnt">
			<table class="formTable">
				<tr>
					<td class="inputTitle"><?php echo(L("TITLE")); ?></td>
					<td class="inputTitle"><?php echo(L("SHORT_TITLE")); ?></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="<?php echo($_AI['a_title']); ?>" name="a_title" maxlength="255" size="70"><span class="fc_r">*</span>
					</td>
					<td class="inputArea">
						<input class="i" type="text" value="<?php echo($_AI['a_short_title']); ?>" name="a_short_title" maxlength="30" size="20">
					</td>
				</tr>
				<tr>
					<td colspan="2" class="inputArea">
						<label><strong><?php echo(L("KEYWORDS")); ?></strong>: <input class="i" type="text" value="<?php echo($_AI['a_keywords']); ?>" name="a_keywords" maxlength="255" size="50"></label> <span class="fc_gry"><?php echo(L("A_KEYWORDS_TIP")); ?></span>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="inputArea">
						<label><strong><?php echo(L("CHANNEL")); ?></strong>:
						<input id="archive_channel_id" type="hidden" value="<?php echo($_AI['archive_channel_id']); ?>" name="archive_channel_id" />
						<span id="archive_channel_id_channel_select" class="channel_select" to='#archive_channel_id' archive_model_id="<?php echo($_AI['archive_model_id']); ?>"></span></label>
						<strong><?php echo(L("FLAG")); ?></strong>: <?php if(isset($_AFL) and is_array($_AFL)) : foreach($_AFL as $af) : ?><label><input type="checkbox" value="<?php echo($af['af_alias']); ?>" name="af_alias[]" <?php if(in_array($af['af_alias'], $_AI['af_alias'])) :  ?> checked="checked"<?php endif; ?>> <?php echo($af['af_name']); ?>[<?php echo($af['af_alias']); ?>]</label><?php endforeach; endif; ?>
						<label><strong><?php echo(L("RANK")); ?></strong>: <input class="i" type="text" value="<?php echo($_AI['a_rank']); ?>" name="a_rank" maxlength="6" size="6"></label>
					</td>
				</tr>
				<tr>
					<td class="inputTitle"><?php echo(L("THUMB")); ?></td>
					<td class="inputArea" rowspan="2">
					<?php if(!empty($_AI['a_thumb'])) :  ?>
						<img id="a_thumb_preview" src="<?php echo($_AI['a_thumb']); ?>" width="160" />
					<?php else : ?>
						<img id="a_thumb_preview" src="<?php echo(__APP__); ?>u/site/no_thumb.png" width="160" />
					<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="a_thumb" class="i" type="text" value="<?php echo($_AI['a_thumb']); ?>" name="a_thumb" maxlength="255" size="70">
						<input id="a_thumb_uploader" to="#a_thumb" preview="#a_thumb_preview" btntext="<?php echo(L("UPLOAD")); ?>" typeset='image' thumb='yes' class="uploader" type="file" />
						<span id="a_thumb_finder" to="#a_thumb" preview="#a_thumb_preview" typeset='image' class="btn_l finder"><?php echo(L("BROWSE_SERVER")); ?></span>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="inputArea">
						<label><?php echo(L("SOURCE")); ?> <input id="a_a_source" class="i" type="text" value="<?php echo($_AI['a_a_source']); ?>" name="a_a_source" maxlength="96" size="20"></label>
						<label><?php echo(L("AUTHOR")); ?> <input id="a_a_author" class="i" type="text" value="<?php echo($_AI['a_a_author']); ?>" name="a_a_author" maxlength="96" size="20"></label>
					</td>
				</tr>
				<?php echo($_FI); ?>
				<tr>
					<td class="inputTitle"><?php echo(L("DESCRIPTION")); ?></td>
					<td class="inputTitle"><?php echo(L("RELATED_CONTENT")); ?> <span class="btn_l choose_archive" to_id="a_related"><?php echo(L("CHOOSE_ARCHIVE")); ?></span></td>
				</tr>
				<tr>
					<td class="inputArea">
						<textarea class="i" name="a_description" style="width:360px;height:60px;" placeholder="<?php echo(L("A_DESCRIPTION_TIP")); ?>"><?php echo($_AI['a_description']); ?></textarea>
					</td>
					<td class="inputArea">
						<div class="archive_set" to_id="a_related">
						<?php if(!empty($_AI['a_related'])) :  ?><?php
$var_a = '_a_list_'.$_AI['a_related'].'_cid_no_flag_days_keywords_orderby_0_10';
$$var_a = S('~list/~'.ltrim($var_a, '_'));
if(empty($$var_a)) {
	$where = array();
	if(!empty($_AI['a_related'])) {
		$where['__ARCHIVE__.archive_id'] = array('IN', ''.$_AI['a_related'].'');
	}
	$$var_a = M('Archive')->get_archiveList($where, '`a_rank` DESC, `a_edit_time` DESC', '0,10', C('AM_ID'), true);
	S('~list/~'.ltrim($var_a, '_'), $$var_a);
}
if($$var_a) : foreach($$var_a as $k => $item): 
$item['a_title'] = AString::utf8_substr($item['a_title'], '20')
?>

							<span class="bg_wht br_b br_3 p_0_2 fc_b fw_b" aid="<?php echo($item['archive_id']); ?>"><a href="<?php echo($item['a_url']); ?>" target="_blank"><?php echo($item['a_title']); ?></a><b class="a p_0_5">╳</b></span>
						<?php endforeach; endif; ?>
<?php endif; ?>
						</div>
						<input id="a_related" type="hidden" name="a_related" value="<?php echo($_AI['a_related']); ?>" />
					</td>
				</tr>
			</table>
		</div>
		<div class="tabCntnt">
			<table class="formTable">
				<tr>
					<td class="inputTitle"><?php echo(L("MEMBER_ID")); ?></td>
					<td class="inputTitle"><?php echo(L("USERNAME")); ?></td>
				</tr>
				<tr>
					<td class="inputArea">
						<?php echo($_AI['member_id']); ?>
					</td>
					<td class="inputArea">
						<?php echo($_AI['m_username']); ?>
					</td>
				</tr>
				<tr>
					<td class="inputTitle"><?php echo(L("STATUS")); ?></td>
					<td class="inputTitle"><?php echo(L("REVIEW_SWITCH")); ?></td>
				</tr>
				<tr>
					<td class="inputArea">
						<label><input type="radio" value="0" name="a_status"<?php if(0 == $_AI['a_status']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("NOT_PASSED")); ?></label>
						<label><input type="radio" value="1" name="a_status"<?php if(1 == $_AI['a_status']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("PASSED")); ?></label>
						<label><input type="radio" value="2" name="a_status"<?php if(2 == $_AI['a_status']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("REFUNDED")); ?></label>
						<label><input type="checkbox" name="send_notify" checked="checked" value="y"> <?php echo(L("SEND_NOTIFY")); ?></label>
					</td>
					<td class="inputArea">
						<label><input type="radio" value="0" name="a_review_switch"<?php if(0 == $_AI['a_review_switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("OFF")); ?></label>
						<label><input type="radio" value="1" name="a_review_switch"<?php if(1 == $_AI['a_review_switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("ON")); ?></label>
					</td>
				</tr>
				<tr>
					<td class="inputTitle"><?php echo(L("COST_POINTS")); ?></td>
					<td class="inputTitle"><?php echo(L("COUNT")); ?></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="<?php echo($_AI['a_cost_points']); ?>" name="a_cost_points" maxlength="10" size="6"><?php echo(L("POINTS")); ?>
					</td>
					<td class="inputArea">
						<label><?php echo(L("VIEW")); ?>: <input class="required i" type="text" value="<?php echo($_AI['a_view_count']); ?>" name="a_view_count" maxlength="20" size="10"></label>
						<label><?php echo(L("REVIEW")); ?>: <input class="required i" type="text" value="<?php echo($_AI['a_review_count']); ?>" name="a_review_count" maxlength="20" size="10"></label>
						<label><?php echo(L("SUPPORT")); ?>: <input class="required i" type="text" value="<?php echo($_AI['a_support_count']); ?>" name="a_support_count" maxlength="20" size="10"></label>
						<label><?php echo(L("OPPOSE")); ?>: <input class="required i" type="text" value="<?php echo($_AI['a_oppose_count']); ?>" name="a_oppose_count" maxlength="20" size="10"></label>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">HTML<?php echo(L("SWITCH")); ?></td>
					<td class="inputTitle"><?php echo(L("EDIT_TIME")); ?></td>
				</tr>
				<tr>
					<td class="inputArea">
						<label><input type="radio" value="0" name="a_is_html"<?php if(0 == $_AI['a_is_html']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("NOT_HTML")); ?></label>
						<label><input type="radio" value="1" name="a_is_html"<?php if(1 == $_AI['a_is_html']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("IS_HTML")); ?></label>
					</td>
					<td class="inputArea">
						<?php echo(date(C('APP.TIME_FORMAT'), $_AI['a_edit_time'])); ?>
						<input class="i calendar" type="text" value="<?php echo date(C('APP.TIME_FORMAT'), time()); ?>" format="<?php echo(C("APP.TIME_FORMAT")); ?>" id="a_edit_time" name="a_edit_time" maxlength="255" size="20">
						<label><input type="checkbox" name="not_upodate_edit_time" value="n"> <?php echo(L("NOT_UPDATE_EDIT_TIME")); ?></label>
					</td>
				</tr>
				<tr>
					<td class="inputTitle"><?php echo(L("TEMPLATE")); ?></td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input id="a_tpl" class="i" type="text" value="<?php echo($_AI['a_tpl']); ?>" name="a_tpl" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="home" to_id="a_tpl"><?php echo(L("CHOOSE")); ?></span>
					</td>
					<td class="inputTip">
						<?php echo(L("A_TPL_TIP")); ?>
					</td>
				</tr>
				<tr>
					<td class="inputTitle"><?php echo(L("A_HTML_PATH")); ?></td>
					<td></td>
				</tr>
				<tr>
					<td class="inputArea">
						<label><input type="radio" value="0" name="a_html_path"<?php if(0 == $_AI['a_html_path']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("EXTEND_CHANNEL_SETTING")); ?></label>
						<label><input type="radio" value="1" name="a_html_path"<?php if(1 == $_AI['a_html_path']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("CUSTOM")); ?></label>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> <?php echo(L("A_HTML_PATH_TIP")); ?>
					</td>
				</tr>
				<tr>
					<td class="inputTitle"><?php echo(L("A_HTML_NAMING")); ?></td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="i" type="text" value="<?php echo($_AI['a_html_naming']); ?>" name="a_html_naming" maxlength="255" size="50">
					</td>
					<td class="inputTip">
						<?php echo(L("A_HTML_NAMING_TIP")); ?>
					</td>
				</tr>
			</table>
		</div>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
	<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
	<input type="hidden" value="<?php echo($_AI['archive_id']); ?>" name="archive_id">
	<input type="hidden" value="<?php echo($_AI['am_alias']); ?>" name="am_alias">
	<span class="btn_b submit" action="<?php echo(Url::U("archive/edit_archive_do")); ?>" to="#formEdit"><?php echo(L("SUBMIT")); ?></span>
	<input class="btn_l" type="reset" value="<?php echo(L("RESET")); ?>" />
	<a class="btn_l" href="<?php echo(Url::U("archive/list_archive?archive_model_id={$_AI['archive_model_id']}")); ?>"><?php echo(L("BACK")); ?></a>
	<label><input type="checkbox" name="build_now" value="1" checked="checked" /> <?php echo(L("BUILD_NOW")); ?></label>
</div>
</form>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="<?php echo(__PUBLIC__); ?>js/uploadify/uploadify.js"></script>
<script src="<?php echo(__PUBLIC__); ?>js/editor/ckeditor.js"></script>
<script src="<?php echo(__PUBLIC__); ?>js/dialog/artdialog.js"></script>
<script>
$(document).ready(function() {
	var editor_option = {
		filebrowserBrowseUrl : '<?php echo(Url::U("finder/browse?typeset=all&type={$_AI['am_alias']}")); ?>',
		filebrowserImageBrowseUrl : '<?php echo(Url::U("finder/browse?typeset=image&type={$_AI['am_alias']}")); ?>',
		filebrowserUploadUrl : '<?php echo(Url::U("upload/upload_file?typeset=all&upload_type={$_AI['am_alias']}&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}")); ?>',
		filebrowserImageUploadUrl : '<?php echo(Url::U("upload/upload_file?typeset=image&upload_type={$_AI['am_alias']}&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}")); ?>'
	};
	$('.editor').each(function(){
		CKEDITOR.replace(this, editor_option);
	});
	var editor_option_paging = {
		filebrowserBrowseUrl : '<?php echo(Url::U("finder/browse?typeset=all&type={$_AI['am_alias']}")); ?>',
		filebrowserImageBrowseUrl : '<?php echo(Url::U("finder/browse?typeset=image&type={$_AI['am_alias']}")); ?>',
		filebrowserUploadUrl : '<?php echo(Url::U("upload/upload_file?typeset=all&upload_type={$_AI['am_alias']}&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}")); ?>',
		filebrowserImageUploadUrl : '<?php echo(Url::U("upload/upload_file?typeset=image&upload_type={$_AI['am_alias']}&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}")); ?>',
		extraPlugins : 'uwapaging'
	};
	$('.editor_paging').each(function(){
		CKEDITOR.replace(this, editor_option_paging);
	});

	$('#formEdit').submit(function() {
		if('' == $("input[name='archive_channel_id']").val() || 0 == $("input[name='archive_channel_id']").val()) {
			alert("<?php echo(L("CHOOSE_CHANNEL")); ?>");
			return false;
		}
	});
});

var type_desc_all = '<?php echo(L("FILE")); ?>', file_type_exts_all = '<?php echo($_OU['all']); ?>',
	type_desc_image = '<?php echo(L("IMAGE")); ?>', file_type_exts_image = '<?php echo($_OU['img']); ?>',
	form_data = {'<?php echo session_name(); ?>' : '<?php echo session_id(); ?>', 'timeKey' : '<?php echo($_TK["timeKey"]); ?>', 'token' : '<?php echo($_TK["token"]); ?>'},
	uploadify_swf = '<?php echo(__PUBLIC__); ?>js/uploadify/uploadify.swf',
	uploader_all = '<?php echo(Url::U("upload/upload_file?typeset=all&upload_type={$_AI['am_alias']}")); ?>',
	uploader_image = '<?php echo(Url::U("upload/upload_file?typeset=image&upload_type={$_AI['am_alias']}&watermark=yes")); ?>',
	uploader_image_thumb = '<?php echo(Url::U("upload/upload_file?typeset=image&upload_type={$_AI['am_alias']}&watermark=yes&thumb=yes")); ?>',
	uploader_image_thumb_both = '<?php echo(Url::U("upload/upload_file?typeset=image&upload_type={$_AI['am_alias']}&watermark=yes&thumb=both")); ?>';

var finder_browse_url_all = '<?php echo(Url::U("finder/browse?typeset=all&type={$_AI['am_alias']}")); ?>',
	finder_browse_url_image = '<?php echo(Url::U("finder/browse?typeset=image&type={$_AI['am_alias']}")); ?>',
	finder_browse_url_file = '<?php echo(Url::U("finder/browse?typeset=file&type={$_AI['am_alias']}")); ?>';

var url_get_linkage_select = '<?php echo(Url::U("ajax/get_linkage_select")); ?>';

var url_choose_template_file = '<?php echo(Url::U("template/choose_template_file")); ?>',
	l_choose_template = '<?php echo(L("CHOOSE_TEMPLATE")); ?>';

var url_choose_archive = '<?php echo(Url::U("archive/choose_archive")); ?>',
	l_choose_archive = '<?php echo(L("CHOOSE_ARCHIVE")); ?>';

var url_get_channel_select = '<?php echo(Url::U("ajax/get_channel_select")); ?>';
</script>
<script src="/tpl/rz/admin/js/c.js"></script>
<script src="/tpl/rz/admin/js/cal.js"></script>
<script src="/tpl/rz/admin/js/u.js"></script>
<script src="/tpl/rz/admin/js/f.js"></script>
<script src="/tpl/rz/admin/js/l.js"></script>
<script src="/tpl/rz/admin/js/c_t.js"></script>
<script src="/tpl/rz/admin/js/c_a.js"></script>
<script src="/tpl/rz/admin/js/g_ac.js"></script>
</body>
</html>