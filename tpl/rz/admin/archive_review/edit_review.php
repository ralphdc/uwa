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
	<dt><strong>{-:@EDIT_REVIEW-}</strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@MEMBER_ID-}</td>
				<td class="inputTitle">{-:@AUTHOR-}</td>
			</tr>
			<tr>
				<td class="inputArea">
					{-:$_ARI['member_id']-}
				</td>
				<td class="inputArea">
					{-if:empty($_ARI['ar_author'])-}
						{-:@GUEST-}
					{-else:-}
						{-:$_ARI['ar_author']-}
					{-:/if-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@ARCHIVE-}</td>
				<td class="inputTitle">{-:@ADD_TIME-}</td>
			</tr>
			<tr>
				<td class="inputArea">
					[{-:$_ARI['archive_id']-}] {-:$_ARI['a_title']-}
				</td>
				<td class="inputArea">
					{-:@TIME-}:{-:$_ARI['ar_add_time']|date~C('APP.TIME_FORMAT'),@me-} {-:@IP-}:{-:$_ARI['ar_add_ip']-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@STATUS-}</td>
				<td class="inputTitle">{-:@COUNT-}</td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" name="ar_status" {-if:0 == $_ARI['ar_status']-} checked="checked"{-:/if-} value="0"> {-:@NOT_PASSED-}</label>
					<label><input type="radio" name="ar_status" {-if:1 == $_ARI['ar_status']-} checked="checked"{-:/if-} value="1"> {-:@PASSED-}</label>
					<label><input type="radio" name="ar_status" {-if:2 == $_ARI['ar_status']-} checked="checked"{-:/if-} value="2"> {-:@FILTER-}</label>
				</td>
				<td class="inputArea">
					<label>{-:@SUPPORT-}: <input class="required i" type="text" value="{-:$_ARI['ar_support_count']-}" name="ar_support_count" maxlength="20" size="10"></label>
					<label>{-:@OPPOSE-}: <input class="required i" type="text" value="{-:$_ARI['ar_oppose_count']-}" name="ar_oppose_count" maxlength="20" size="10"></label>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@CONTENT-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" name="ar_content" style="width:360px;height:60px;">{-:$_ARI['ar_content']-}</textarea>
				</td>
				<td class="inputTip">
					{-:@AR_CONTENT_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@REPLY-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" name="ar_reply" style="width:360px;height:60px;">{-:$_ARI['ar_reply']-}</textarea>
				</td>
				<td class="inputTip">
					{-:@AR_REPLY_TIP-}
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<input type="hidden" value="{-:$_ARI['archive_review_id']-}" name="archive_review_id">
	<span class="btn_b submit" action="{-url:archive_review/edit_review_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:archive_review/list_review-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>