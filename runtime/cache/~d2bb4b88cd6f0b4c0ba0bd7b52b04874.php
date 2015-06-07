<?php /* PFA Template Cache File. Create Time:2015-06-06 11:05:46 */ ?>
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
	<dt><span><a href="<?php echo(Url::U("option/edit_option_site")); ?>"><?php echo(L("SITE")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_core")); ?>"><?php echo(L("CORE")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_index")); ?>"><?php echo(L("INDEX")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_performance")); ?>"><?php echo(L("PERFORMANCE")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_upload")); ?>"><?php echo(L("UPLOAD")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_image")); ?>"><?php echo(L("IMAGE")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_member")); ?>"><?php echo(L("MEMBER")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_interaction")); ?>"><?php echo(L("INTERACTION")); ?></a></span><strong><?php echo(L("CUSTOM_OPTION")); ?></strong></dt>
	<dd>
		<div class="mainTips">
			<?php echo(L("CUSTOM_OPTION_TIP")); ?>
			<span class="btn_l" id="add_custom_option"><?php echo(L("ADD_CUSTOM_OPTION")); ?></span>
		</div>
		<table class="formTable">
			<?php if(isset($_CO) and is_array($_CO)) : foreach($_CO as $co) : ?>
			<tr>
				<td class="inputTitle">
					<?php echo($co['o_title']); ?> [<?php echo($co['o_key']); ?>]
					<span class="fc_gry fs_11">HTML<?php echo(L("CODE")); ?>: <?php echo '{'; ?>-:$_G['<?php echo($co['o_key']); ?>']-}</span>
					<a href="<?php echo(Url::U("option/delete_custom_option_do?o_key={$co['o_key']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>" title="<?php echo(L("DELETE_CUSTOM_OPTION")); ?>" class="fw_b fs_16" onclick="javascript:return delete_confirm();" >&times;</a></td>
				<?php if('image' == $co['o_value_type']) :  ?>
				<td rowspan="2" class="inputArea">
					<img height="90" id="<?php echo($co['o_key']); ?>_preview" src="<?php echo($co['o_value']); ?>" />
				</td>
				<?php else : ?>
				<td class=""></td>
				<?php endif; ?>
			</tr>
			<tr>
				<td class="inputArea">
				<?php if('string' == $co['o_value_type']) :  ?>
					<input class="i" type="text" value="<?php echo($co['o_value']); ?>" name="<?php echo($co['o_key']); ?>" maxlength="255" size="50" />
				<?php elseif('number' == $co['o_value_type']) :  ?>
					<input class="i" type="text" value="<?php echo($co['o_value']); ?>" name="<?php echo($co['o_key']); ?>" maxlength="20" size="10" />
				<?php elseif('bool' == $co['o_value_type']) :  ?>
					<label><input type="radio" value="Y" name="<?php echo($co['o_key']); ?>"<?php if('Y' == $co['o_value']) :  ?> checked="checked"<?php endif; ?>/> <?php echo(L("ON")); ?></label>
					<label><input type="radio" value="N" name="<?php echo($co['o_key']); ?>"<?php if('N' == $co['o_value']) :  ?> checked="checked"<?php endif; ?>/> <?php echo(L("OFF")); ?></label>
				<?php elseif('multi_text' == $co['o_value_type']) :  ?>
					<textarea class="i" name="<?php echo($co['o_key']); ?>" style="width:500px;height:60px;"><?php echo($co['o_value']); ?></textarea>
				<?php elseif('html_text' == $co['o_value_type']) :  ?>
					<textarea class="editor_simple" name="<?php echo($co['o_key']); ?>" style="width:580px;height:80px;"><?php echo($co['o_value']); ?></textarea>
				<?php elseif('image' == $co['o_value_type']) :  ?>
					<input id="<?php echo($co['o_key']); ?>" class="i" type="text" value="<?php echo($co['o_value']); ?>" name="<?php echo($co['o_key']); ?>" maxlength="255" size="50">
					<input id="<?php echo($co['o_key']); ?>_uploader" to="#<?php echo($co['o_key']); ?>" preview="#<?php echo($co['o_key']); ?>_preview" btntext="<?php echo(L("UPLOAD")); ?>" typeset='image' class="uploader" type="file" />
					<span id="<?php echo($co['o_key']); ?>_finder" to="#<?php echo($co['o_key']); ?>" preview="#<?php echo($co['o_key']); ?>_preview" typeset='image' class="btn_l finder"><?php echo(L("BROWSE_SERVER")); ?></span><br />
					<span class="fc_gry"><?php echo($co['o_description']); ?></span>
				<?php endif; ?>
				</td>
				<?php if('image' != $co['o_value_type']) :  ?>
				<td class="inputTip">
					<?php echo($co['o_description']); ?>
				</td>
				<?php endif; ?>
			</tr>
			<?php endforeach; endif; ?>
		</table>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
	<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
	<span class="btn_b submit" action="<?php echo(Url::U("option/edit_custom_option_do")); ?>" to="#formEdit"><?php echo(L("SUBMIT")); ?></span>
	<input class="btn_l" type="reset" value="<?php echo(L("RESET")); ?>" />
</div>
</form>
<div id="form_add_custom_option" style="display:none">
<form id="formAdd" action="<?php echo(Url::U("option/add_custom_option_do")); ?>" method="post">
	<table class="formTable">
		<tr>
			<td class="inputArea"><strong><?php echo(L("OPTION_TITLE")); ?></strong></td>
			<td class="inputArea" width="8"></td>
			<td class="inputArea">
				<input class="required i" type="text" value="" name="o_title" maxlength="255" size="30"><span class="fc_r">*</span>
			</td>
		</tr>
		<tr>
			<td><strong><?php echo(L("OPTION_KEY")); ?></strong></td>
			<td></td>
			<td>
				<input class="required i" type="text" value="" name="o_key" maxlength="96" size="30"><span class="fc_r">*</span>
			</td>
		</tr>
		<tr>
			<td class="inputArea"></td>
			<td class="inputArea"></td>
			<td class="inputArea"><span class="fc_gry"><?php echo(L("OPTION_KEY_TIP")); ?></span></td>
		</tr>
		<tr>
			<td class="inputArea"><strong><?php echo(L("OPTION_TYPE")); ?></strong></td>
			<td class="inputArea"></td>
			<td class="inputArea">
				<label><input type="radio" value="string" name="o_value_type" checked="checked"> <?php echo(L("STRING")); ?></label>
				<label><input type="radio" value="number" name="o_value_type"> <?php echo(L("NUMBER")); ?></label>
				<label><input type="radio" value="bool" name="o_value_type"> <?php echo(L("BOOLEAN")); ?></label>
				<label><input type="radio" value="multi_text" name="o_value_type"> <?php echo(L("MUTLI_TEXT")); ?></label>
				<label><input type="radio" value="html_text" name="o_value_type"> <?php echo(L("HTML_TEXT")); ?></label>
				<label><input type="radio" value="image" name="o_value_type"> <?php echo(L("IMAGE")); ?></label>
			</td>
		</tr>
		<tr>
			<td><strong><?php echo(L("OPTION_VALUE")); ?></strong></td>
			<td></td>
			<td>
				<input class="i" type="text" value="" name="o_value" maxlength="255" size="40">
			</td>
		</tr>
		<tr>
			<td class="inputArea"></td>
			<td class="inputArea"></td>
			<td class="inputArea"><span class="fc_gry"><?php echo(L("OPTION_VALUE_TIP")); ?></span></td>
		</tr>
		<tr>
			<td><strong><?php echo(L("OPTION_DESCRIPTION")); ?></strong></td>
			<td></td>
			<td>
				<textarea class="i" name="o_description" style="width:360px;height:40px;"></textarea>
				<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
				<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
			</td>
		</tr>
		<tr>
			<td class="inputArea"></td>
			<td class="inputArea"></td>
			<td class="inputArea"><span class="fc_gry"><?php echo(L("OPTION_DESCRIPTION_TIP")); ?></span></td>
		</tr>
	</table>
</form>
</div>
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
	uploader_image_thumb_both = '<?php echo(Url::U("upload/upload_file?typeset=image&upload_type=site&thumb=both")); ?>';

var finder_browse_url_all = '<?php echo(Url::U("finder/browse?typeset=all&type=site")); ?>',
	finder_browse_url_image = '<?php echo(Url::U("finder/browse?typeset=image&type=site")); ?>',
	finder_browse_url_file = '<?php echo(Url::U("finder/browse?typeset=file&type=site")); ?>';

/* add custom option */
$('#add_custom_option').bind('click', function() {
	dialog({
		title:'<?php echo(L("ADD_CUSTOM_OPTION")); ?>',
		content: document.getElementById('form_add_custom_option'),
		id:'FACO',
		button:[
			{
				value:'<?php echo(L("OK")); ?>',
				callback:function() {
					$('#formAdd').submit();
					return false;
				}
			},
			{
				value:'<?php echo(L("CANCEL")); ?>'
			}
		]
	}).showModal();
});

var l_option_not_saved_tip = '<?php echo(L("OPTION_NOT_SAVED_TIP")); ?>';
</script>
<script src="/tpl/default/admin/js/c.js"></script>
<script src="/tpl/default/admin/js/u.js"></script>
<script src="/tpl/default/admin/js/f.js"></script>
<script src="/tpl/default/admin/js/o.js"></script>
</body>
</html>