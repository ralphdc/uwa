<?php /* PFA Template Cache File. Create Time:2015-06-06 10:21:48 */ ?>
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
	<dt><strong><?php echo(L("SITE")); ?></strong><span><a href="<?php echo(Url::U("option/edit_option_core")); ?>"><?php echo(L("CORE")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_index")); ?>"><?php echo(L("INDEX")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_performance")); ?>"><?php echo(L("PERFORMANCE")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_upload")); ?>"><?php echo(L("UPLOAD")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_image")); ?>"><?php echo(L("IMAGE")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_member")); ?>"><?php echo(L("MEMBER")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_interaction")); ?>"><?php echo(L("INTERACTION")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_custom_option")); ?>"><?php echo(L("CUSTOM_OPTION")); ?></a></span></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle"><?php echo(L("SITE_NAME")); ?> [site/name]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['site']['name']); ?>" name="site[name]" maxlength="255" size="50">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("SITE_NAME_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("SITE_HOST")); ?> [site/host]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['site']['host']); ?>" name="site[host]" maxlength="255" size="50">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("SITE_HOST_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("SITE_LOGO")); ?> [site/logo]</td>
				<td rowspan="2" class="inputArea">
					<img id="site_logo_preview" src="<?php echo($_O['site']['logo']); ?>" />
				</td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="site_logo" class="required i" type="text" value="<?php echo($_O['site']['logo']); ?>" name="site[logo]" maxlength="255" size="50">
					<input id="site_logo_uploader" to="#site_logo" preview="#site_logo_preview" btntext="<?php echo(L("UPLOAD")); ?>" typeset='image' class="uploader" type="file" />
					<span id="site_logo_finder" to="#site_logo" preview="#site_logo_preview" typeset='image' class="btn_l finder"><?php echo(L("BROWSE_SERVER")); ?></span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("SITE_LOGO_MOBILE")); ?> [site/logo_mobile]</td>
				<td rowspan="2" class="inputArea">
					<img id="site_logo_mobile_preview" src="<?php echo($_O['site']['logo_mobile']); ?>" />
				</td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="site_logo_mobile" class="required i" type="text" value="<?php echo($_O['site']['logo_mobile']); ?>" name="site[logo_mobile]" maxlength="255" size="50">
					<input id="site_logo_mobile_uploader" to="#site_logo_mobile" preview="#site_logo_mobile_preview" btntext="<?php echo(L("UPLOAD")); ?>" typeset='image' class="uploader" type="file" />
					<span id="site_logo_mobile_finder" to="#site_logo_mobile" preview="#site_logo_mobile_preview" typeset='image' class="btn_l finder"><?php echo(L("BROWSE_SERVER")); ?></span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("SITE_LANGUAGE")); ?> [site/language]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<select name="site[language]">
					<?php if(isset($_LANGSET) and is_array($_LANGSET)) : foreach($_LANGSET as $lang) : ?>
						<option value="<?php echo($lang['alias']); ?>"<?php if($lang['alias']==$_O['site']['language']) :  ?> selected="selected"<?php endif; ?>><?php echo($lang['name']); ?></option>
					<?php endforeach; endif; ?>
					</select>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("SITE_LANGUAGE_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("LANG_DETECT")); ?> [site/lang_detect]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="site[lang_detect]"<?php if(0==$_O['site']['lang_detect']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("OFF")); ?></label>
					<label><input type="radio" value="1" name="site[lang_detect]"<?php if(1==$_O['site']['lang_detect']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("ON")); ?></label>
				</td>
				<td class="inputTip">
					<?php echo(L("LANG_DETECT_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("SITE_THEME")); ?> [site/theme]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<select name="site[theme]">
					<?php if(isset($_TPL) and is_array($_TPL)) : foreach($_TPL as $tpl) : ?>
						<option value="<?php echo($tpl['alias']); ?>"<?php if($tpl['alias']==$_O['site']['theme']) :  ?> selected="selected"<?php endif; ?>><?php echo($tpl['name']); ?></option>
					<?php endforeach; endif; ?>
					</select>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("SITE_THEME_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("MOBILE_VERSION")); ?> [site/mobile_version]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="site[mobile_version]"<?php if(0==$_O['site']['mobile_version']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("OFF")); ?></label>
					<label><input type="radio" value="1" name="site[mobile_version]"<?php if(1==$_O['site']['mobile_version']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("ON")); ?></label>
				</td>
				<td class="inputTip">
					<?php echo(L("MOBILE_VERSION_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("TPL_PROTECTION")); ?> [site/tpl_protection]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="site[tpl_protection]"<?php if(0==$_O['site']['tpl_protection']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("OFF")); ?></label>
					<label><input type="radio" value="1" name="site[tpl_protection]"<?php if(1==$_O['site']['tpl_protection']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("ON")); ?></label>
				</td>
				<td class="inputTip">
					<?php echo(L("TPL_PROTECTION_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("SITE_TIMEZONE")); ?> [site/timezone]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<select name="site[timezone]">
					<?php if(isset($_TZL) and is_array($_TZL)) : foreach($_TZL as $k => $v) : ?>
						<option value="<?php echo($k); ?>"<?php if($k==$_O['site']['timezone']) :  ?> selected="selected"<?php endif; ?>><?php echo($v); ?></option>
					<?php endforeach; endif; ?>
					</select>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("SITE_TIMEZONE_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("SITE_TIME_FORMAT")); ?> [site/time_format]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['site']['time_format']); ?>" name="site[time_format]" maxlength="50" size="20">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("SITE_TIME_FORMAT_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("SITE_KEYWORDS")); ?> [site/keywords]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" name="site[keywords]" style="width:360px;height:40px;"><?php echo($_O['site']['keywords']); ?></textarea>
				</td>
				<td class="inputTip">
					<?php echo(L("SITE_KEYWORDS_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("SITE_DESCRIPTION")); ?> [site/description]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" name="site[description]" style="width:360px;height:60px;"><?php echo($_O['site']['description']); ?></textarea>
				</td>
				<td class="inputTip">
					<?php echo(L("SITE_DESCRIPTION_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("SITE_COPYRIGHT")); ?> [site/copyright]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="editor_simple" name="site[copyright]"><?php echo(htmlspecialchars($_O['site']['copyright'])); ?></textarea>
				</td>
				<td class="inputTip">
					<?php echo(L("SITE_COPYRIGHT_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("SITE_STAT_CODE")); ?> [site/stat_code]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" name="site[stat_code]" style="width:360px;height:60px;"><?php echo($_O['site']['stat_code']); ?></textarea>
				</td>
				<td class="inputTip">
					<?php echo(L("SITE_STAT_CODE_TIP")); ?>
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
	<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
	<span class="btn_b submit" action="<?php echo(Url::U("option/edit_option_site_do")); ?>" to="#formEdit"><?php echo(L("SUBMIT")); ?></span>
	<input class="btn_l" type="reset" value="<?php echo(L("RESET")); ?>" />
</div>
</form>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="<?php echo(__PUBLIC__); ?>js/uploadify/uploadify.js"></script>
<script src="<?php echo(__PUBLIC__); ?>js/editor/ckeditor.js"></script>
<script src="<?php echo(__PUBLIC__); ?>js/dialog/artdialog.js"></script>
<script>
$(document).ready(function() {
	var editor_option_simple = {
		filebrowserBrowseUrl : '<?php echo(Url::U("finder/browse?typeset=all&type=site")); ?>',
		filebrowserImageBrowseUrl : '<?php echo(Url::U("finder/browse?typeset=image&type=site")); ?>',
		filebrowserUploadUrl : '<?php echo(Url::U("upload/upload_file?typeset=all&upload_type=site&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}")); ?>',
		filebrowserImageUploadUrl : '<?php echo(Url::U("upload/upload_file?typeset=image&upload_type=site&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}")); ?>',
		toolbar : 'uwa_simple',
		width : 640, height : 90
	};
	$('.editor_simple').each(function(){
		CKEDITOR.replace(this, editor_option_simple);
	});
});

var type_desc_all = '<?php echo(L("FILE")); ?>', file_type_exts_all = '<?php echo($_OU['all']); ?>',
	type_desc_image = '<?php echo(L("IMAGE")); ?>', file_type_exts_image = '<?php echo($_OU['img']); ?>',
	form_data = {'<?php echo session_name(); ?>' : '<?php echo session_id(); ?>', 'timeKey' : '<?php echo($_TK["timeKey"]); ?>', 'token' : '<?php echo($_TK["token"]); ?>'},
	uploadify_swf = '<?php echo(__PUBLIC__); ?>js/uploadify/uploadify.swf',
	uploader_all = '<?php echo(Url::U("upload/upload_file?typeset=all&upload_type=site")); ?>',
	uploader_image = '<?php echo(Url::U("upload/upload_file?typeset=image&upload_type=site")); ?>',
	uploader_image_thumb = '<?php echo(Url::U("upload/upload_file?typeset=image&upload_type=site&thumb=yes")); ?>',
	uploader_image_thumb_both = '<?php echo(Url::U("upload/upload_file?typeset=image&upload_type=member&thumb=both")); ?>';

var finder_browse_url_all = '<?php echo(Url::U("finder/browse?typeset=all&type=site")); ?>',
	finder_browse_url_image = '<?php echo(Url::U("finder/browse?typeset=image&type=site")); ?>',
	finder_browse_url_file = '<?php echo(Url::U("finder/browse?typeset=file&type=site")); ?>';

var l_option_not_saved_tip = '<?php echo(L("OPTION_NOT_SAVED_TIP")); ?>';
</script>
<script src="/tpl/default/admin/js/c.js"></script>
<script src="/tpl/default/admin/js/u.js"></script>
<script src="/tpl/default/admin/js/f.js"></script>
<script src="/tpl/default/admin/js/o.js"></script>
</body>
</html>