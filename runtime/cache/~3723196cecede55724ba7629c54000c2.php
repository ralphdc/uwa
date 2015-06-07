<?php /* PFA Template Cache File. Create Time:2015-06-06 10:21:58 */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="/tpl/default/admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="/tpl/default/admin/css/mf.css" />
</head>
<body>
<form id="formEdit" action="" method="post">
<dl class="abox">
	<dt><span><a href="<?php echo(Url::U("option/edit_option_site")); ?>"><?php echo(L("SITE")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_core")); ?>"><?php echo(L("CORE")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_index")); ?>"><?php echo(L("INDEX")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_performance")); ?>"><?php echo(L("PERFORMANCE")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_upload")); ?>"><?php echo(L("UPLOAD")); ?></a></span><strong><?php echo(L("IMAGE")); ?></strong><span><a href="<?php echo(Url::U("option/edit_option_member")); ?>"><?php echo(L("MEMBER")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_interaction")); ?>"><?php echo(L("INTERACTION")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_custom_option")); ?>"><?php echo(L("CUSTOM_OPTION")); ?></a></span></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle"><?php echo(L("THUMB_PREFIX")); ?> [image/thumb_prefix]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['image']['thumb_prefix']); ?>" name="image[thumb_prefix]" maxlength="96" size="20">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("THUMB_PREFIX_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("THUMB_WIDTH")); ?> [image/thumb_width]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['image']['thumb_width']); ?>" name="image[thumb_width]" maxlength="20" size="10">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("THUMB_WIDTH_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("THUMB_HEIGHT")); ?> [image/thumb_height]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['image']['thumb_height']); ?>" name="image[thumb_height]" maxlength="20" size="10">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("THUMB_HEIGHT_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("THUMB_PROPORTIONAL")); ?> [image/thumb_proportional]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="image[thumb_proportional]"<?php if(0==$_O['image']['thumb_proportional']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("OFF")); ?></label>
					<label><input type="radio" value="1" name="image[thumb_proportional]"<?php if(1==$_O['image']['thumb_proportional']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("ON")); ?></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("THUMB_PROPORTIONAL_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("WATERMARK")); ?> [image/watermark]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="image[watermark]"<?php if(0==$_O['image']['watermark']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("OFF")); ?></label>
					<label><input type="radio" value="1" name="image[watermark]"<?php if(1==$_O['image']['watermark']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("ON")); ?></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("WATERMARK_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("WATERMARK_TYPE")); ?> [image/watermark_type]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="image[watermark_type]"<?php if(0==$_O['image']['watermark_type']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("IMAGE_MARK")); ?></label>
					<label><input type="radio" value="1" name="image[watermark_type]"<?php if(1==$_O['image']['watermark_type']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("TEXT_MARK")); ?></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("WATERMARK_TYPE_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("WATERMARK_IMAGE")); ?> [image/watermark_image]
					<span class="fc_gry fw_n"><span class="fc_r">*</span> <?php echo(L("WATERMARK_IMAGE_TIP")); ?></span></td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="watermark_image" class="required i" type="text" value="<?php echo($_O['image']['watermark_image']); ?>" name="image[watermark_image]" maxlength="255" size="50">
					<input id="watermark_image_uploader" to="#watermark_image" preview="#watermark_image_preview" btntext="<?php echo(L("UPLOAD")); ?>" typeset='image' class="uploader" type="file" />
					<span id="watermark_image_finder" to="#watermark_image" preview="#watermark_image_preview" typeset='image' class="btn_l finder"><?php echo(L("BROWSE_SERVER")); ?></span>
				</td>
				<td class="inputTip">
					<img id="watermark_image_preview" src="<?php echo($_O['image']['watermark_image']); ?>" />
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("WATERMARK_TEXT")); ?> [image/watermark_text]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['image']['watermark_text']); ?>" name="image[watermark_text]" maxlength="50" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("WATERMARK_TEXT_TIP")); ?>
				</td>
			</tr>

			<tr>
				<td class="inputTitle"><?php echo(L("WATERMARK_TEXT_FONT")); ?> [image/watermark_text_font]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['image']['watermark_text_font']); ?>" name="image[watermark_text_font]" maxlength="50" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("WATERMARK_TEXT_FONT_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("WATERMARK_TEXT_SIZE")); ?> [image/watermark_text_size]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['image']['watermark_text_size']); ?>" name="image[watermark_text_size]" maxlength="2" size="2">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("WATERMARK_TEXT_SIZE_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("WATERMARK_TEXT_COLOR")); ?> [image/watermark_text_color]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					# <input class="required i" type="text" value="<?php echo($_O['image']['watermark_text_color']); ?>" name="image[watermark_text_color]" maxlength="6" size="6">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("WATERMARK_TEXT_COLOR_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("WATERMARK_POSITION")); ?> [image/watermark_position]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<table class="listTable" style="width:280px">
						<tr>
							<td colspan="3">
					<label><input type="radio" value="0" <?php if(0==$_O['image']['watermark_position']) :  ?> checked="checked"<?php endif; ?> name="image[watermark_position]"> <?php echo(L("RANDOM")); ?></label>
							</td>
						</tr>
						<tr>
							<td>
					<label><input type="radio" value="1" <?php if(1==$_O['image']['watermark_position']) :  ?> checked="checked"<?php endif; ?> name="image[watermark_position]"> <?php echo(L("TOP_LEFT")); ?></label>
							</td>
							<td>
					<label><input type="radio" value="2" <?php if(2==$_O['image']['watermark_position']) :  ?> checked="checked"<?php endif; ?> name="image[watermark_position]"> <?php echo(L("TOP_CENTER")); ?></label>
							</td>
							<td>
					<label><input type="radio" value="3" <?php if(3==$_O['image']['watermark_position']) :  ?> checked="checked"<?php endif; ?> name="image[watermark_position]"> <?php echo(L("TOP_RIGHT")); ?></label>
							</td>
						</tr>
						<tr>
							<td>
					<label><input type="radio" value="4" <?php if(4==$_O['image']['watermark_position']) :  ?> checked="checked"<?php endif; ?> name="image[watermark_position]"> <?php echo(L("MIDDLE_LEFT")); ?></label>
							</td>
							<td>
					<label><input type="radio" value="5" <?php if(5==$_O['image']['watermark_position']) :  ?> checked="checked"<?php endif; ?> name="image[watermark_position]"> <?php echo(L("MIDDLE_CENTER")); ?></label>
							</td>
							<td>
					<label><input type="radio" value="6" <?php if(6==$_O['image']['watermark_position']) :  ?> checked="checked"<?php endif; ?> name="image[watermark_position]"> <?php echo(L("MIDDLE_RIGHT")); ?></label>
							</td>
						</tr>
						<tr>
							<td>
					<label><input type="radio" value="7" <?php if(7==$_O['image']['watermark_position']) :  ?> checked="checked"<?php endif; ?> name="image[watermark_position]"> <?php echo(L("BOTTOM_LEFT")); ?></label>
							</td>
							<td>
					<label><input type="radio" value="8" <?php if(8==$_O['image']['watermark_position']) :  ?> checked="checked"<?php endif; ?> name="image[watermark_position]"> <?php echo(L("BOTTOM_CENTER")); ?></label>
							</td>
							<td>
					<label><input type="radio" value="9" <?php if(9==$_O['image']['watermark_position']) :  ?> checked="checked"<?php endif; ?> name="image[watermark_position]"> <?php echo(L("BOTTOM_RIGHT")); ?></label>
							</td>
						</tr>
					</table>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("WATERMARK_POSITION_TIP")); ?>
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
	<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
	<span class="btn_b submit" action="<?php echo(Url::U("option/edit_option_image_do")); ?>" to="#formEdit"><?php echo(L("SUBMIT")); ?></span>
	<input class="btn_l" type="reset" value="<?php echo(L("RESET")); ?>" />
</div>
</form>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="<?php echo(__PUBLIC__); ?>js/uploadify/uploadify.js"></script>
<script>
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

var l_option_not_saved_tip = '<?php echo(L("OPTION_NOT_SAVED_TIP")); ?>';
</script>
<script src="/tpl/default/admin/js/c.js"></script>
<script src="/tpl/default/admin/js/u.js"></script>
<script src="/tpl/default/admin/js/f.js"></script>
<script src="/tpl/default/admin/js/o.js"></script>
</body>
</html>