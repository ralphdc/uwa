<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
</head>
<body>
<form id="formEdit" action="" method="post">
<dl class="abox">
	<dt><span><a href="{-url:option/edit_option_site-}">{-:@SITE-}</a></span><span><a href="{-url:option/edit_option_core-}">{-:@CORE-}</a></span><span><a href="{-url:option/edit_option_index-}">{-:@INDEX-}</a></span><span><a href="{-url:option/edit_option_performance-}">{-:@PERFORMANCE-}</a></span><span><a href="{-url:option/edit_option_upload-}">{-:@UPLOAD-}</a></span><strong>{-:@IMAGE-}</strong><span><a href="{-url:option/edit_option_member-}">{-:@MEMBER-}</a></span><span><a href="{-url:option/edit_option_interaction-}">{-:@INTERACTION-}</a></span><span><a href="{-url:option/edit_custom_option-}">{-:@CUSTOM_OPTION-}</a></span></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@THUMB_PREFIX-} [image/thumb_prefix]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['image']['thumb_prefix']-}" name="image[thumb_prefix]" maxlength="96" size="20">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@THUMB_PREFIX_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@THUMB_WIDTH-} [image/thumb_width]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['image']['thumb_width']-}" name="image[thumb_width]" maxlength="20" size="10">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@THUMB_WIDTH_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@THUMB_HEIGHT-} [image/thumb_height]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['image']['thumb_height']-}" name="image[thumb_height]" maxlength="20" size="10">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@THUMB_HEIGHT_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@THUMB_PROPORTIONAL-} [image/thumb_proportional]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="image[thumb_proportional]"{-if:0==$_O['image']['thumb_proportional']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
					<label><input type="radio" value="1" name="image[thumb_proportional]"{-if:1==$_O['image']['thumb_proportional']-} checked="checked"{-:/if-}> {-:@ON-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@THUMB_PROPORTIONAL_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@WATERMARK-} [image/watermark]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="image[watermark]"{-if:0==$_O['image']['watermark']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
					<label><input type="radio" value="1" name="image[watermark]"{-if:1==$_O['image']['watermark']-} checked="checked"{-:/if-}> {-:@ON-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@WATERMARK_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@WATERMARK_TYPE-} [image/watermark_type]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="image[watermark_type]"{-if:0==$_O['image']['watermark_type']-} checked="checked"{-:/if-}> {-:@IMAGE_MARK-}</label>
					<label><input type="radio" value="1" name="image[watermark_type]"{-if:1==$_O['image']['watermark_type']-} checked="checked"{-:/if-}> {-:@TEXT_MARK-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@WATERMARK_TYPE_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@WATERMARK_IMAGE-} [image/watermark_image]
					<span class="fc_gry fw_n"><span class="fc_r">*</span> {-:@WATERMARK_IMAGE_TIP-}</span></td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="watermark_image" class="required i" type="text" value="{-:$_O['image']['watermark_image']-}" name="image[watermark_image]" maxlength="255" size="50">
					<input id="watermark_image_uploader" to="#watermark_image" preview="#watermark_image_preview" btntext="{-:@UPLOAD-}" typeset='image' class="uploader" type="file" />
					<span id="watermark_image_finder" to="#watermark_image" preview="#watermark_image_preview" typeset='image' class="btn_l finder">{-:@BROWSE_SERVER-}</span>
				</td>
				<td class="inputTip">
					<img id="watermark_image_preview" src="{-:$_O['image']['watermark_image']-}" />
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@WATERMARK_TEXT-} [image/watermark_text]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['image']['watermark_text']-}" name="image[watermark_text]" maxlength="50" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@WATERMARK_TEXT_TIP-}
				</td>
			</tr>

			<tr>
				<td class="inputTitle">{-:@WATERMARK_TEXT_FONT-} [image/watermark_text_font]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['image']['watermark_text_font']-}" name="image[watermark_text_font]" maxlength="50" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@WATERMARK_TEXT_FONT_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@WATERMARK_TEXT_SIZE-} [image/watermark_text_size]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['image']['watermark_text_size']-}" name="image[watermark_text_size]" maxlength="2" size="2">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@WATERMARK_TEXT_SIZE_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@WATERMARK_TEXT_COLOR-} [image/watermark_text_color]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					# <input class="required i" type="text" value="{-:$_O['image']['watermark_text_color']-}" name="image[watermark_text_color]" maxlength="6" size="6">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@WATERMARK_TEXT_COLOR_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@WATERMARK_POSITION-} [image/watermark_position]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<table class="listTable" style="width:280px">
						<tr>
							<td colspan="3">
					<label><input type="radio" value="0" {-if:0==$_O['image']['watermark_position']-} checked="checked"{-:/if-} name="image[watermark_position]"> {-:@RANDOM-}</label>
							</td>
						</tr>
						<tr>
							<td>
					<label><input type="radio" value="1" {-if:1==$_O['image']['watermark_position']-} checked="checked"{-:/if-} name="image[watermark_position]"> {-:@TOP_LEFT-}</label>
							</td>
							<td>
					<label><input type="radio" value="2" {-if:2==$_O['image']['watermark_position']-} checked="checked"{-:/if-} name="image[watermark_position]"> {-:@TOP_CENTER-}</label>
							</td>
							<td>
					<label><input type="radio" value="3" {-if:3==$_O['image']['watermark_position']-} checked="checked"{-:/if-} name="image[watermark_position]"> {-:@TOP_RIGHT-}</label>
							</td>
						</tr>
						<tr>
							<td>
					<label><input type="radio" value="4" {-if:4==$_O['image']['watermark_position']-} checked="checked"{-:/if-} name="image[watermark_position]"> {-:@MIDDLE_LEFT-}</label>
							</td>
							<td>
					<label><input type="radio" value="5" {-if:5==$_O['image']['watermark_position']-} checked="checked"{-:/if-} name="image[watermark_position]"> {-:@MIDDLE_CENTER-}</label>
							</td>
							<td>
					<label><input type="radio" value="6" {-if:6==$_O['image']['watermark_position']-} checked="checked"{-:/if-} name="image[watermark_position]"> {-:@MIDDLE_RIGHT-}</label>
							</td>
						</tr>
						<tr>
							<td>
					<label><input type="radio" value="7" {-if:7==$_O['image']['watermark_position']-} checked="checked"{-:/if-} name="image[watermark_position]"> {-:@BOTTOM_LEFT-}</label>
							</td>
							<td>
					<label><input type="radio" value="8" {-if:8==$_O['image']['watermark_position']-} checked="checked"{-:/if-} name="image[watermark_position]"> {-:@BOTTOM_CENTER-}</label>
							</td>
							<td>
					<label><input type="radio" value="9" {-if:9==$_O['image']['watermark_position']-} checked="checked"{-:/if-} name="image[watermark_position]"> {-:@BOTTOM_RIGHT-}</label>
							</td>
						</tr>
					</table>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@WATERMARK_POSITION_TIP-}
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_b submit" action="{-url:option/edit_option_image_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/uploadify/uploadify.js"></script>
<script>
var type_desc_all = '{-:@FILE-}', file_type_exts_all = '{-:$_OU['all']-}',
	type_desc_image = '{-:@IMAGE-}', file_type_exts_image = '{-:$_OU['img']-}',
	form_data = {'{-php:echo session_name();-}' : '{-php:echo session_id();-}', 'timeKey' : '{-:$_TK["timeKey"]-}', 'token' : '{-:$_TK["token"]-}'},
	uploadify_swf = '{-:*__PUBLIC__-}js/uploadify/uploadify.swf',
	uploader_all = '{-url:upload/upload_file?typeset=all&upload_type=site-}',
	uploader_image = '{-url:upload/upload_file?typeset=image&upload_type=site-}',
	uploader_image_thumb = '{-url:upload/upload_file?typeset=image&upload_type=site&thumb=yes-}',
	uploader_image_thumb_both = '{-url:upload/upload_file?typeset=image&upload_type=site&thumb=both-}';

var finder_browse_url_all = '{-url:finder/browse?typeset=all&type=site-}',
	finder_browse_url_image = '{-url:finder/browse?typeset=image&type=site-}',
	finder_browse_url_file = '{-url:finder/browse?typeset=file&type=site-}';

var l_option_not_saved_tip = '{-:@OPTION_NOT_SAVED_TIP-}';
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/u.js"></script>
<script src="{-:*__THEME__-}admin/js/f.js"></script>
<script src="{-:*__THEME__-}admin/js/o.js"></script>
</body>
</html>