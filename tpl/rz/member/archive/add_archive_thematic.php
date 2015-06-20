<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@PUBLISH-} {-:$_AI['am_name']-} - {-:$_SITE['name']-}</title>
<meta name="keywords" content="{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_SITE['description']-}" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/m.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/a_t.css" />
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}js/dialog/artdialog.css" />
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}js/calendar/calendar.css" />
<script src="{-:*__PUBLIC__-}js/calendar/calendar.js"></script>
<script src="{-:*__PUBLIC__-}js/calendar/lang/zh-cn.js"></script>
</head>

<body>
{-include:../header-}
<div class="m w_960">
	<div class="w_190 f_l">
{-include:../sidebar_content-}
	</div><!--/.w_190-->
	<div class="w_10 h_10 o_h f_l">&nbsp;</div>
	<div class="w_760 f_l">
		<dl class="atab_1 adiv">
			<dt><strong class="on">{-:@PUBLISH-} {-:$_AI['am_name']-}</strong></dt>
			<dd class="p_20">
				<form id="formAdd" action="{-url:archive/add_archive_do-}" method="post" enctype="multipart/form-data"><table class="formTable">
					<tr>
						<td class="inputTitle">{-:@TITLE-}</td>
						<td class="inputTitle">{-:@COST_POINTS-}</td>
					</tr>
					<tr>
						<td class="inputArea">
							<input class="required i" type="text" value="" name="a_title" maxlength="255" size="50"><span class="fc_r">*</span>
						</td>
						<td class="inputArea">
							<input class="required i" type="text" value="0" name="a_cost_points" maxlength="8" size="4"> {-:@POINTS-}
						</td>
					</tr>
					<tr>
						<td class="inputTitle">{-:@CHANNEL-}</td>
						<td></td>
					</tr>
					<tr>
						<td colspan="2" class="inputArea">
							<input id="archive_channel_id" type="hidden" value="{-:$_AI['archive_channel_id']-}" name="archive_channel_id" />
							<span id="archive_channel_id_channel_select" class="channel_select" to='#archive_channel_id' archive_model_id="{-:$_AI['archive_model_id']-}"></span>
						</td>
					</tr>
					<tr>
						<td class="inputTitle">{-:@THUMB-}</td>
						<td class=""></td>
					</tr>
					<tr>
					{-if:$_OU['switch']-}
						<td colspan="2" class="inputArea">
							<input id="a_thumb_uploader" class="i" type="file" value="" name="a_thumb_uploader" maxlength="255" size="50" />
						</td>
					{-else:-}
						<td class="inputArea">
							<input class="i" type="text" value="" name="a_thumb" maxlength="255" size="50" placeholder="http://" />
						</td>
						<td class="inputTip">
							{-:@A_THUMB_URL_TIP-}
						</td>
					{-:/if-}
					</tr>
					<tr>
						<td class="inputTitle">{-:@KEYWORDS-}</td>
						<td class=""></td>
					</tr>
					<tr>
						<td class="inputArea">
							<input class="i" type="text" value="" name="a_keywords" maxlength="255" size="50">
						</td>
						<td class="inputTip">
							{-:@A_KEYWORDS_TIP-}
						</td>
					</tr>
					<tr>
						<td class="inputTitle">{-:@DESCRIPTION-}</td>
						<td class=""></td>
					</tr>
					<tr>
						<td class="inputArea">
							<textarea class="i" name="a_description" style="width:360px;height:60px;"></textarea>
						</td>
						<td class="inputTip">
							{-:@A_DESCRIPTION_TIP-}
						</td>
					</tr>
					<tr>
						<td colspan="2" class="inputTitle">{-:@THEMATIC_NODE-} <span class="btn_l" id="add_thematic_node">{-:@ADD-}</span></td>
					</tr>
					<tr>
						<td colspan="2" class="inputArea">
							<ul id='thematic_node_set'>
							</ul>
						</td>
					</tr>
					{-:$_FI-}
					{-if:$_G['interaction']['captcha']-}
					<tr>
						<td class="inputTitle">{-:@CAPTCHA-}</td>
						<td></td>
					</tr>
					<tr>
						<td colspan="2" class="inputArea">
						<label>
							<input type="text" name="vcode" autocomplete="off" value="" class="required i v_code_input" size="5" maxlength="5" />
							<img src="{-url:common/captcha_img?name=vcode-}" onclick="this.src += '&' + Math.random();" style="cursor:pointer;" />
							<span class="fc_gry">{-:@CAPTCHA_TIP-}</span>
						</label>
						</td>
					</tr>{-:/if-}
					<tr>
						<td colspan="2" class="inputArea fw_n fc_gry">
							<strong>[{-:@UPLOAD_TIP-}]</strong>
							<ul>
								{-foreach:$_OU['upload_tip'],$tip-}<li>{-:$tip-}</li>{-:/foreach-}
							</ul>
						</td>
					</tr>
					<tr>
						<td colspan="2" class="operation">
						<label>
							<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
							<input name="token" type="hidden" value="{-:$_TK['token']-}">
							<input name="archive_model_id" type="hidden" value="{-:$_AI['archive_model_id']-}">
							<input type="submit" class="btn_b" value="{-:@SUBMIT-}" />
							<input class="btn_l" type="reset" value="{-:@RESET-}" />
						</label>
						</td>
					</tr>
				</table></form>
			</dd>
		</dl>
	</div><!--/.w_760-->
	<div class="c"></div>
</div>
{-include:../footer-}
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/uploadify/uploadify.js"></script>
<script src="{-:*__PUBLIC__-}js/editor/ckeditor.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script>
$(document).ready(function() {
	var editor_option = {
		{-if:$_OU['switch']-}filebrowserUploadUrl : '{-url:upload/upload_file?typeset=all&upload_type={$_AI['am_alias']}&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',
		filebrowserImageUploadUrl : '{-url:upload/upload_file?typeset=image&upload_type={$_AI['am_alias']}&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',{-:/if-}
		toolbar : 'uwa_simple'
	};
	$('.editor').each(function(){
		CKEDITOR.replace(this, editor_option);
	});
	var editor_option_paging = {
		{-if:$_OU['switch']-}filebrowserUploadUrl : '{-url:upload/upload_file?typeset=all&upload_type={$_AI['am_alias']}&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',
		filebrowserImageUploadUrl : '{-url:upload/upload_file?typeset=image&upload_type={$_AI['am_alias']}&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',{-:/if-}
		toolbar : 'uwa_simple',
		extraPlugins : 'uwapaging'
	};
	$('.editor_paging').each(function(){
		CKEDITOR.replace(this, editor_option_paging);
	});

	$('#formAdd').submit(function() {
		if('' == $("input[name='archive_channel_id']").val() || 0 == $("input[name='archive_channel_id']").val()) {
			alert("{-:@CHOOSE_CHANNEL-}");
			return false;
		}
	});
});

var type_desc_all = '{-:@FILE-}', file_type_exts_all = '{-:$_OU['all']-}',
	type_desc_image = '{-:@IMAGE-}', file_type_exts_image = '{-:$_OU['img']-}',
	form_data = {'{-php:echo session_name();-}' : '{-php:echo session_id();-}', 'timeKey' : '{-:$_TK["timeKey"]-}', 'token' : '{-:$_TK["token"]-}'},
	uploadify_swf = '{-:*__PUBLIC__-}js/uploadify/uploadify.swf',
	uploader_all = '{-url:upload/upload_file?typeset=all&upload_type={$_AI['am_alias']}-}',
	uploader_image = '{-url:upload/upload_file?typeset=image&upload_type={$_AI['am_alias']}&watermark=yes-}',
	uploader_image_thumb = '{-url:upload/upload_file?typeset=image&upload_type={$_AI['am_alias']}&watermark=yes&thumb=yes-}',
	uploader_image_thumb_both = '{-url:upload/upload_file?typeset=image&upload_type={$_AI['am_alias']}&watermark=yes&thumb=both-}';

var url_choose_archive = '{-url:archive/choose_archive-}',
	l_choose_archive = '{-:@CHOOSE_ARCHIVE-}';

var l_node_name = '{-:@NODE_NAME-}',
	l_node_alias = '{-:@NODE_ALIAS-}',
	l_node_archive_set = '{-:@NODE_ARCHIVE_SET-}',
	l_choose_archive = '{-:@CHOOSE_ARCHIVE-}',
	l_delete_node = '{-:@DELETE_NODE-}';

var url_get_linkage_select = '{-url:common/get_linkage_select-}';
var url_get_channel_select = '{-url:ajax/get_channel_select-}';

document.write('<script src="{-url:common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}member/js/c.js"></script>
<script src="{-:*__THEME__-}member/js/u.js"></script>
<script src="{-:*__THEME__-}member/js/cal.js"></script>
<script src="{-:*__THEME__-}member/js/l.js"></script>
<script src="{-:*__THEME__-}member/js/m.js"></script>
<script src="{-:*__THEME__-}member/js/c_a.js"></script>
<script src="{-:*__THEME__-}member/js/a_t.js"></script>
<script src="{-:*__THEME__-}member/js/g_ac.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>