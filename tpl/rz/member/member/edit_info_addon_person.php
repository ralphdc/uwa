<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@EDIT_INFO_ADDON-} - {-:$_SITE['name']-}</title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/m.css" />
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}js/calendar/calendar.css" />
<script src="{-:*__PUBLIC__-}js/calendar/calendar.js"></script>
<script src="{-:*__PUBLIC__-}js/calendar/lang/zh-cn.js"></script>
<meta name="keywords" content="{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_SITE['description']-}" />
</head>

<body>
{-include:../header-}
<div class="m w_960">
	<div class="w_190 f_l">
{-include:../sidebar-}
	</div><!--/.w_190-->
	<div class="w_10 h_10 o_h f_l">&nbsp;</div>
	<div class="w_760 f_l">
		<dl class="atab_1 adiv">
			<dt><strong><a href="{-url:member/edit_info_base-}">{-:@BASE_INFO-}</a></strong><strong class="on">{-:@ADDON_INFO-}</strong></dt>
			<dd class="p_20">
				<form id="edit_info_addon" action="{-url:member/edit_info_addon_do-}" method="post"><table class="formTable">
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
<script>
$(document).ready(function() {
	var editor_option = {
		toolbar : 'uwa_simple'
	};
	$('.editor').each(function(){
		CKEDITOR.replace(this, editor_option);
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

var url_get_linkage_select = '{-url:common/get_linkage_select-}';

document.write('<script src="{-url:common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}member/js/c.js"></script>
<script src="{-:*__THEME__-}member/js/u.js"></script>
<script src="{-:*__THEME__-}member/js/cal.js"></script>
<script src="{-:*__THEME__-}member/js/l.js"></script>
<script src="{-:*__THEME__-}member/js/m.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>