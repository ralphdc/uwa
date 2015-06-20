<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@EDIT-} {-:$_AI['am_name']-} - {-:$_SITE['name']-}</title>
<meta name="keywords" content="{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_SITE['description']-}" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<meta name="HandheldFriendly" content="true">
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}mua/css/mua.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}js/calendar/calendar.css" />
<script src="{-:*__PUBLIC__-}js/calendar/calendar.js"></script>
<script src="{-:*__PUBLIC__-}js/calendar/lang/zh-cn.js"></script>
</head>

<body>
{-include:../header-}

<dl class="adl margin-top-sm">
	<dt><h5><i class="icon icon-plus"></i> {-:@EDIT-} {-:$_AI['am_name']-}</h5><span class="float-right"><a class="btn_l" href="{-url:archive/list_archive?archive_model_id={$_AI['archive_model_id']}-}"><i class="icon icon-list"></i> {-:@LIST-}</a></span></dt>
	<dd>
		<form id="formEdit" class="form" action="{-url:archive/edit_archive_do-}" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label class="control-label">{-:@TITLE-}</label>
				<input required="required" type="text" name="a_title" value="{-:$_AI['a_title']-}" class="control-input" maxlength="255">
			</div>
			<div class="form-group">
				<label class="control-label">{-:@COST_POINTS-}</label>
				<input required="required" type="text" name="a_cost_points" value="{-:$_AI['a_cost_points']-}" class="control-input" maxlength="8">
			</div>
			<div class="form-group">
				<label class="control-label">{-:@CHANNEL-}</label>
				<div>
					<input id="archive_channel_id" type="hidden" value="{-:$_AI['archive_channel_id']-}" name="archive_channel_id" />
					<span id="archive_channel_id_channel_select" class="channel_select" to='#archive_channel_id' archive_model_id="{-:$_AI['archive_model_id']-}"></span>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label">{-:@THUMB-}</label>
			{-if:$_OU['switch']-}
				<input id="a_thumb_uploader" class="control-input" type="file" value="" name="a_thumb_uploader" maxlength="255" size="50" />
			{-else:-}
				<input class="control-input" type="text" value="{-:$_AI['a_thumb']-}" name="a_thumb" maxlength="255" size="50" placeholder="http://" />
				<div class="control-help">{-:@A_THUMB_URL_TIP-}</div>
			{-:/if-}
				<div class="control-help">
				{-if:!empty($_AI['a_thumb'])-}
					<img id="a_thumb_preview" src="{-:$_AI['a_thumb']-}" width="160" />
				{-else:-}
					<img id="a_thumb_preview" src="{-:*__APP__-}u/site/no_thumb.png" width="160" />
				{-:/if-}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label">{-:@KEYWORDS-}</label>
				<input class="control-input" type="text" value="{-:$_AI['a_keywords']-}" name="a_keywords" maxlength="255" size="50" />
				<div class="control-help">{-:@A_KEYWORDS_TIP-}</div>
			</div>
			<div class="form-group">
				<label class="control-label">{-:@DESCRIPTION-}</label>
				<textarea class="control-input" name="a_description" style="height:60px;">{-:$_AI['a_description']-}</textarea>
				<div class="control-help">{-:@A_DESCRIPTION_TIP-}</div>
			</div>
			{-:$_FI-}
			{-if:$_G['interaction']['captcha']-}<div class="grid">
				<div class="row">
					<div class="col-sm-4"><input required="required" type="text" placeholder="{-:@CAPTCHA-}" name="vcode" autocomplete="off" value="" class="required control-input" size="5" maxlength="5"></div>
					<div class="col-sm-8 text-muted"><img src="{-url:common/captcha_img?name=vcode-}" onclick="this.src += '&' + Math.random();" style="cursor:pointer;" /> {-:@CAPTCHA_TIP-}</div>
				</div>
			</div>{-:/if-}
			<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
			<input name="token" type="hidden" value="{-:$_TK['token']-}">
			<input name="archive_id" type="hidden" value="{-:$_AI['archive_id']-}" />
			<input name="archive_model_id" type="hidden" value="{-:$_AI['archive_model_id']-}" />
			<input type="submit" class="btn btn-block" value="{-:@SUBMIT-}" />
			<div class="form-group">
				<label class="control-label">{-:@UPLOAD_TIP-}</label>
				<div class="control-help">{-foreach:$_OU['upload_tip'],$tip-}{-:$tip-}<br />{-:/foreach-}</div>
			</div>
		</form>
	</dd>
</dl>

<uwa:ad id="5">
{-include:../footer-}
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}mua/js/mua.js"></script>
<script src="{-:*__PUBLIC__-}js/uploadify/uploadify.js"></script>
<script src="{-:*__PUBLIC__-}js/editor/ckeditor.js"></script>
<script>
$(document).ready(function() {
	var editor_option = {
		{-if:$_OU['switch']-}filebrowserUploadUrl : '{-url:upload/upload_file?typeset=all&upload_type={$_AI['am_alias']}&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',
		filebrowserImageUploadUrl : '{-url:upload/upload_file?typeset=image&upload_type={$_AI['am_alias']}&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',{-:/if-}
		toolbar : 'uwa_mini'
	};
	$('.editor').each(function(){
		CKEDITOR.replace(this, editor_option);
	});
	var editor_option_paging = {
		{-if:$_OU['switch']-}filebrowserUploadUrl : '{-url:upload/upload_file?typeset=all&upload_type={$_AI['am_alias']}&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',
		filebrowserImageUploadUrl : '{-url:upload/upload_file?typeset=image&upload_type={$_AI['am_alias']}&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',{-:/if-}
		toolbar : 'uwa_mini',
		extraPlugins : 'uwapaging'
	};
	$('.editor_paging').each(function(){
		CKEDITOR.replace(this, editor_option_paging);
	});

	$('#formEdit').submit(function() {
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

var url_get_linkage_select = '{-url:common/get_linkage_select-}';
var url_get_channel_select = '{-url:ajax/get_channel_select-}';

document.write('<script src="{-url:member@common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:home@common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}member/js/c.js"></script>
<script src="{-:*__THEME__-}member/js/u.js"></script>
<script src="{-:*__THEME__-}member/js/cal.js"></script>
<script src="{-:*__THEME__-}member/js/l.js"></script>
<script src="{-:*__THEME__-}member/js/g_ac.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>
