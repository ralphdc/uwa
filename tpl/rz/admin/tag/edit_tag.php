<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}js/dialog/artdialog.css" />
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}js/calendar/calendar.css" />
<script src="{-:*__PUBLIC__-}js/calendar/calendar.js"></script>
<script src="{-:*__PUBLIC__-}js/calendar/lang/zh-cn.js"></script>
</head>
<body>
<form id="formAdd" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@EDIT_TAG-}</strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@NAME-}</td>
			</tr>
			<tr>
				<td class="inputArea">
					{-:$_TI['t_name']-}
					<span class="fc_gry"><span class="fc_r">*</span> <span class="fc_gry">{-:@T_NAME_TIP-}</span></span>
				</td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><strong>{-:@KEYWORDS-}</strong>: <input class="i" type="text" value="{-:$_TI['t_keywords']-}" name="t_keywords" maxlength="255" size="50"></label> <span class="fc_gry">{-:@T_KEYWORDS_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@DESCRIPTION-}</td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" name="t_description" style="width:360px;height:60px;" placeholder="{-:@T_DESCRIPTION_TIP-}">{-:$_TI['t_description']-}</textarea>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@RELATED_CONTENT-} <span class="btn_l choose_archive" to_id="t_related_archive">{-:@CHOOSE_ARCHIVE-}</span></td>
			</tr>
			<tr>
				<td class="inputArea">
					<div class="archive_set" to_id="t_related_archive">
					<uwa:a_list titlelen="20" aid="$_TI.t_related_archive">
						<span class="bg_wht br_b br_3 p_0_2 fc_b fw_b" aid="{-:$item['archive_id']-}"><a href="{-:$item['a_url']-}" target="_blank">{-:$item['a_title']-}</a><b class="a p_0_5">╳</b></span>
					</uwa:a_list>
					</div>
					<input id="t_related_archive" type="hidden" name="t_related_archive" value="{-:$_TI['t_related_archive']-}" />
				</td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><strong>{-:@VIEW_COUNT-}</strong>: <input class="i" type="text" value="{-:$_TI['t_view_count']-}" name="t_view_count" maxlength="10" size="5"></label>
					<label><strong>{-:@ADD_TIME-}</strong>: <input class="i calendar" type="text" value="{-:$_TI['t_add_time']|date~C('APP.TIME_FORMAT'),@me-}" format="{-:#APP.TIME_FORMAT-}" id="t_add_time" name="t_add_time" maxlength="255" size="20"></label>
					<label><strong>{-:@UPDATE_TIME-}</strong>: <input class="i calendar" type="text" value="{-:$_TI['t_update_time']|date~C('APP.TIME_FORMAT'),@me-}" format="{-:#APP.TIME_FORMAT-}" id="t_update_time" name="t_update_time" maxlength="255" size="20"></label>
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<input name="tag_id" type="hidden" value="{-:$_TI['tag_id']-}">
	<span class="btn_b submit" action="{-url:tag/edit_tag_do-}" to="#formAdd">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:tag/list_tag-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script>
var url_choose_archive = '{-url:archive/choose_archive-}',
	l_choose_archive = '{-:@CHOOSE_ARCHIVE-}';
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/cal.js"></script>
<script src="{-:*__THEME__-}admin/js/c_a.js"></script>
</body>
</html>