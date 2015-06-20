<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}js/calendar/calendar.css" />
<script src="{-:*__PUBLIC__-}js/calendar/calendar.js"></script>
<script src="{-:*__PUBLIC__-}js/calendar/lang/zh-cn.js"></script>
</head>

<body>
<form id="formAdd" action="" method="post">
<dl class="atab">
	<dt><strong>{-:@GENERAL-}</strong><strong>{-:@CREDIT-}</strong></dt>
	<dd>
		<div class="tabCntnt">
			<table class="formTable">
				<tr>
					<td class="inputTitle">{-:@MODEL-}</td>
					<td class="inputTitle">{-:@LEVEL-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						{-:$_MI['mm_name']-}
						<span class="fc_gry">{-:@MEMBER_MODEL_TIP-}</span>
					</td>
					<td class="inputArea">
						<select name="member_level_id">
						{-foreach:$_MLL,$l-}
							<option value="{-:$l['member_level_id']-}"{-if:$l['member_level_id']==$_MI['mm_default_level']-} selected="selected"{-:/if-}>{-:$l['ml_name']-}</option>
						{-:/foreach-}
						</select>
						<span class="fc_gry">{-:@MEMBER_LEVEL_TIP-}</span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@USERID-}</td>
					<td class="inputTitle">{-:@PASSWORD-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="" name="m_userid" maxlength="96" size="30">
						<span class="fc_r">*</span> <span class="fc_gry">{-:@M_USERID_TIP-}</span>
					</td>
					<td class="inputArea">
						<input class="required i" type="password" value="" name="m_password" maxlength="96" size="30">
						<span class="fc_r">*</span> <span class="fc_gry">{-:@M_PASSWORD_TIP-}</span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@USERNAME-}</td>
					<td class="inputTitle">{-:@EMAIL-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="" name="m_username" maxlength="96" size="30">
						<span class="fc_r">*</span> <span class="fc_gry">{-:@M_USENAME_TIP-}</span>
					</td>
					<td class="inputArea">
						<input class="required i" type="text" value="" name="m_email" maxlength="96" size="30">
						<span class="fc_r">*</span> <span class="fc_gry">{-:@M_EMAIL_TIP-}</span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@STATUS-}</td>
					<td class="inputTitle">{-:@POINTS-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<label><input type="radio" value="0" name="m_status"> {-:@NOT_PASSED-}</label>
						<label><input type="radio" value="1" name="m_status" checked="checked"> {-:@PASSED-}</label>
						<label><input type="radio" value="2" name="m_status"> {-:@FORBIDDEN-}</label>
						<span class="fc_gry">{-:@M_STATUS_TIP-}</span>
					</td>
					<td class="inputArea">
						<input class="required i" type="text" value="0" name="m_points" maxlength="20" size="10">
						<span class="fc_r">*</span> <span class="fc_gry">{-:@M_POINTS_TIP-}</span>
					</td>
				</tr>
				{-:$_FI-}
				<tr>
					<td class="inputTitle">{-:@REG_TIME-}</td>
					<td class="inputTitle">{-:@REG_IP-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="i calendar" type="text" value="{-php:echo date(C('APP.TIME_FORMAT'));-}" format="{-:#APP.TIME_FORMAT-}" id="m_reg_time" name="m_reg_time" maxlength="20" size="20">
						<span class="fc_gry">{-:@M_REG_TIME_TIP-}</span>
					</td>
					<td class="inputArea">
						<input class="i" type="text" value="{-php:echo AServer::get_ip();-}" name="m_reg_ip" maxlength="20" size="15">
						<span class="fc_gry">{-:@M_REG_IP_TIP-}</span>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@LOGIN_TIME-}</td>
					<td class="inputTitle">{-:@LOGIN_IP-}</td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="i calendar" type="text" value="{-php:echo date(C('APP.TIME_FORMAT'));-}" format="{-:#APP.TIME_FORMAT-}" id="m_login_time" name="m_login_time" maxlength="20" size="20">
						<span class="fc_gry">{-:@M_LOGIN_TIME_TIP-}</span>
					</td>
					<td class="inputArea">
						<input class="i" type="text" value="{-php:echo AServer::get_ip();-}" name="m_login_ip" maxlength="20" size="15">
						<span class="fc_gry">{-:@M_LOGIN_IP_TIP-}</span>
					</td>
				</tr>
			</table>
		</div>
		<div class="tabCntnt">
			<table class="formTable">
			{-foreach:$_MCTL,$ct-}
				<tr>
					<td class="inputTitle">{-:$ct['mct_name']-}</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2" class="inputArea">
						<input class="required i" type="text" value="0" name="{-:$ct['mct_alias']-}" maxlength="20" size="10">
						{-:$ct['mct_unit']-}
					</td>
				</tr>
			{-:/foreach-}
			</table>
		</div>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<input type="hidden" value="{-:$_MI['member_model_id']-}" name="member_model_id">
	<span class="btn_b submit" action="{-url:member/add_member_do-}" to="#formAdd">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:member/list_member?member_model_id={$_MI['member_model_id']}-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/uploadify/uploadify.js"></script>
<script src="{-:*__PUBLIC__-}js/editor/ckeditor.js"></script>
<script>
$(document).ready(function() {
	var editor_option = {
		filebrowserBrowseUrl : '{-url:finder/browse?typeset=all&type=member-}',
		filebrowserImageBrowseUrl : '{-url:finder/browse?typeset=image&type=member-}',
		filebrowserUploadUrl : '{-url:upload/upload_file?typeset=all&upload_type=member&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',
		filebrowserImageUploadUrl : '{-url:upload/upload_file?typeset=image&upload_type=member&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}'
	};
	$('.editor').each(function(){
		CKEDITOR.replace(this, editor_option);
	});
	var editor_option_paging = {
		filebrowserBrowseUrl : '{-url:finder/browse?typeset=all&type=member-}',
		filebrowserImageBrowseUrl : '{-url:finder/browse?typeset=image&type=member-}',
		filebrowserUploadUrl : '{-url:upload/upload_file?typeset=all&upload_type=member&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',
		filebrowserImageUploadUrl : '{-url:upload/upload_file?typeset=image&upload_type=member&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',
		extraPlugins : 'uwapaging'
	};
	$('.editor_paging').each(function(){
		CKEDITOR.replace(this, editor_option_paging);
	});
});

var type_desc_all = '{-:@FILE-}', file_type_exts_all = '{-:$_OU['all']-}',
	type_desc_image = '{-:@IMAGE-}', file_type_exts_image = '{-:$_OU['img']-}',
	form_data = {'{-php:echo session_name();-}' : '{-php:echo session_id();-}', 'timeKey' : '{-:$_TK["timeKey"]-}', 'token' : '{-:$_TK["token"]-}'},
	uploadify_swf = '{-:*__PUBLIC__-}js/uploadify/uploadify.swf',
	uploader_all = '{-url:upload/upload_file?typeset=all&upload_type=member-}',
	uploader_image = '{-url:upload/upload_file?typeset=image&upload_type=member-}',
	uploader_image_thumb = '{-url:upload/upload_file?typeset=image&upload_type=member&thumb=yes-}',
	uploader_image_thumb_both = '{-url:upload/upload_file?typeset=image&upload_type=member&thumb=both-}';

var finder_browse_url_all = '{-url:finder/browse?typeset=all&type=member-}',
	finder_browse_url_image = '{-url:finder/browse?typeset=image&type=member-}',
	finder_browse_url_file = '{-url:finder/browse?typeset=file&type=member-}';

var url_get_linkage_select = '{-url:ajax/get_linkage_select-}';
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/cal.js"></script>
<script src="{-:*__THEME__-}admin/js/u.js"></script>
<script src="{-:*__THEME__-}admin/js/f.js"></script>
<script src="{-:*__THEME__-}admin/js/l.js"></script>
</body>
</html>