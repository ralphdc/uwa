<?php /* PFA Template Cache File. Create Time:2015-06-06 16:24:01 */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="/tpl/rz/admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="/tpl/rz/admin/css/mf.css" />
<link rel="stylesheet" type="text/css" href="<?php echo(__PUBLIC__); ?>js/calendar/calendar.css" />
<script src="<?php echo(__PUBLIC__); ?>js/calendar/calendar.js"></script>
<script src="<?php echo(__PUBLIC__); ?>js/calendar/lang/<?php echo(ACookie::get("lang")); ?>.js"></script>
</head>

<body>
<form id="formEdit" action="" method="post">
<dl class="abox">
	<dt><strong><?php echo(L("EDIT_AD")); ?></strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle"><?php echo(L("AD_SPACE")); ?></td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<?php echo($_AI['as_name']); ?>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("AD_SPACE_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("TYPE")); ?></td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<?php if('code' == $_AI['as_type']) :  ?><?php echo(L("CODE")); ?><?php endif; ?>
					<?php if('text' == $_AI['as_type']) :  ?><?php echo(L("TEXT")); ?><?php endif; ?>
					<?php if('image' == $_AI['as_type']) :  ?><?php echo(L("IMAGE")); ?><?php endif; ?>
					<?php if('flash' == $_AI['as_type']) :  ?><?php echo(L("FLASH")); ?><?php endif; ?>
					<?php if('slide' == $_AI['as_type']) :  ?><?php echo(L("SLIDE")); ?><?php endif; ?>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry"><?php echo(L("AS_TYPE_TIP")); ?></span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("NAME")); ?></td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_AI['a_name']); ?>" name="a_name" maxlength="96" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry"><?php echo(L("AD_NAME_TIP")); ?></span>
				</td>
			</tr>
			<tr <?php if('code' == $_AI['as_type'] or 'text' == $_AI['as_type']) :  ?> style="display:none"<?php endif; ?>>
				<td colspan="2" class="inputArea">
					<strong><?php echo(L("FILE")); ?></strong><br />
					<input id="a_file" class="i" type="text" value="<?php echo($_AI['a_file']); ?>" name="a_file" maxlength="255" size="50">
					<input id="a_file_uploader" to="#a_file" btntext="<?php echo(L("UPLOAD")); ?>" typeset='all' class="uploader" type="file" />
					<span id="a_file_finder" to="#a_file" preview="#a_file_preview" typeset='all' class="btn_l finder"><?php echo(L("BROWSE_SERVER")); ?></span>
				</td>
			</tr>
			<tr id="a_content">
				<td colspan="2" class="inputArea">
					<strong><?php echo(L("CONTENT")); ?></strong> <span class="fc_gry"><?php echo(L("AD_CONTENT_TIP")); ?></span><br />
					<textarea class="i <?php if('code' != $_AI['as_type']) :  ?>editor<?php endif; ?>" name="a_content" style="width:450px;height:120px;"><?php echo($_AI['a_content']); ?></textarea>
				</td>
			</tr>
			<?php if('code' != $_AI['as_type']) :  ?><tr>
				<td class="inputTitle"><?php echo(L("LINK")); ?></td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_AI['a_link']); ?>" name="a_link" id="a_link" maxlength="96" size="50">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry"><?php echo(L("AD_LINK_TIP")); ?></span>
				</td>
			</tr><?php endif; ?>
			<tr>
				<td class="inputTitle"><?php echo(L("TIME_LIMIT")); ?></td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="a_time_limit"<?php if(0 == $_AI['a_time_limit']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("NOT_LIMIT")); ?></label>
					<label><input type="radio" value="1" name="a_time_limit"<?php if(1 == $_AI['a_time_limit']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("VALIDITY_PERIOD")); ?></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry"><?php echo(L("AD_TIME_LIMIT_TIP")); ?></span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("VALIDITY_PERIOD")); ?></td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="i calendar" type="text" value="<?php echo(date(C('APP.TIME_FORMAT'), $_AI['a_start_time'])); ?>" format="<?php echo(C("APP.TIME_FORMAT")); ?>" id="a_start_time" name="a_start_time" maxlength="20" size="20"> ~
					<input class="i calendar" type="text" value="<?php echo(date(C('APP.TIME_FORMAT'), $_AI['a_end_time'])); ?>" format="<?php echo(C("APP.TIME_FORMAT")); ?>" id="a_end_time" name="a_end_time" maxlength="20" size="20">
				</td>
				<td class="inputTip">
					<?php echo(L("AD_VALIDITY_PERIOD_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("DISPLAY_ORDER")); ?></td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_AI['a_display_order']); ?>" name="a_display_order" maxlength="20" size="10">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry"><?php echo(L("AD_DISPLAY_ORDER_TIP")); ?></span>
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
	<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
	<input type="hidden" value="<?php echo($_AI['ad_id']); ?>" name="ad_id">
	<span class="btn_b submit" action="<?php echo(Url::U("ad/edit_ad_do")); ?>" to="#formEdit"><?php echo(L("SUBMIT")); ?></span>
	<input class="btn_l" type="reset" value="<?php echo(L("RESET")); ?>" />
	<a class="btn_l" href="<?php echo(Url::U("ad/list_ad")); ?>"><?php echo(L("BACK")); ?></a>
</div>
</form>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="<?php echo(__PUBLIC__); ?>js/uploadify/uploadify.js"></script>
<script src="<?php echo(__PUBLIC__); ?>js/editor/ckeditor.js"></script>
<script>
$(document).ready(function() {
	var editor_option = {
		filebrowserBrowseUrl : '<?php echo(Url::U("finder/browse?typeset=all&type=ad")); ?>',
		filebrowserImageBrowseUrl : '<?php echo(Url::U("finder/browse?typeset=image&type=ad")); ?>',
		filebrowserUploadUrl : '<?php echo(Url::U("upload/upload_file?typeset=all&upload_type=ad&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}")); ?>',
		filebrowserImageUploadUrl : '<?php echo(Url::U("upload/upload_file?typeset=image&upload_type=ad&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}")); ?>',
		toolbar : 'uwa_simple',
		width : 690, height : 90
	};
	$('.editor').each(function(){
		CKEDITOR.replace(this, editor_option);
	});
});

var type_desc_all = '<?php echo(L("FILE")); ?>', file_type_exts_all = '<?php echo($_OU['all']); ?>',
	type_desc_image = '<?php echo(L("IMAGE")); ?>', file_type_exts_image = '<?php echo($_OU['img']); ?>',
	form_data = {'<?php echo session_name(); ?>' : '<?php echo session_id(); ?>', 'timeKey' : '<?php echo($_TK["timeKey"]); ?>', 'token' : '<?php echo($_TK["token"]); ?>'},
	uploadify_swf = '<?php echo(__PUBLIC__); ?>js/uploadify/uploadify.swf',
	uploader_all = '<?php echo(Url::U("upload/upload_file?typeset=all&upload_type=ad")); ?>',
	uploader_image = '<?php echo(Url::U("upload/upload_file?typeset=image&upload_type=ad")); ?>',
	uploader_image_thumb = '<?php echo(Url::U("upload/upload_file?typeset=image&upload_type=ad&thumb=yes")); ?>',
	uploader_image_thumb_both = '<?php echo(Url::U("upload/upload_file?typeset=image&upload_type=ad&thumb=both")); ?>';

var finder_browse_url_all = '<?php echo(Url::U("finder/browse?typeset=all&type=ad")); ?>',
	finder_browse_url_image = '<?php echo(Url::U("finder/browse?typeset=image&type=ad")); ?>',
	finder_browse_url_file = '<?php echo(Url::U("finder/browse?typeset=file&type=ad")); ?>';
</script>
<script src="/tpl/rz/admin/js/c.js"></script>
<script src="/tpl/rz/admin/js/cal.js"></script>
<script src="/tpl/rz/admin/js/u.js"></script>
<script src="/tpl/rz/admin/js/f.js"></script>
</body>
</html>