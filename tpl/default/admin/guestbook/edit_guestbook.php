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
	<dt><strong>{-:@EDIT_GUESTBOOK-}</strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@MEMBER_ID-}</td>
				<td class="inputTitle">{-:@AUTHOR-}</td>
			</tr>
			<tr>
				<td class="inputArea">
					{-:$_GI['member_id']-}
				</td>
				<td class="inputArea">
					{-if:empty($_GI['g_author'])-}
						{-:@GUEST-}
					{-else:-}
						{-:$_GI['g_author']-}
					{-:/if-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@STATUS-}</td>
				<td class="inputTitle">{-:@ADD_TIME-}</td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" name="g_status" {-if:0 == $_GI['g_status']-} checked="checked"{-:/if-} value="0"> {-:@NOT_PASSED-}</label>
					<label><input type="radio" name="g_status" {-if:1 == $_GI['g_status']-} checked="checked"{-:/if-} value="1"> {-:@PASSED-}</label>
					<label><input type="radio" name="g_status" {-if:2 == $_GI['g_status']-} checked="checked"{-:/if-} value="2"> {-:@FILTER-}</label>
				</td>
				<td class="inputArea">
					{-:@TIME-}:{-:$_GI['g_add_time']|date~C('APP.TIME_FORMAT'),@me-} {-:@IP-}:{-:$_GI['g_add_ip']-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@CONTENT-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" name="g_content" style="width:360px;height:120px;">{-:$_GI['g_content']-}</textarea>
				</td>
				<td class="inputTip">
					{-:@G_CONTENT_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@REPLY-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" name="g_reply" style="width:360px;height:80px;">{-:$_GI['g_reply']-}</textarea>
				</td>
				<td class="inputTip">
					{-:@G_REPLY_TIP-}
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<input type="hidden" value="{-:$_GI['guestbook_id']-}" name="guestbook_id">
	<span class="btn_b submit" action="{-url:guestbook/edit_guestbook_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:guestbook/list_guestbook-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>