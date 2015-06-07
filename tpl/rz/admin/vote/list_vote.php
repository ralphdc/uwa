<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}js/dialog/artdialog.css" />
</head>
<body>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@VOTE_LIST-}</strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="vote_id"></th>
				<th scope="col">{-:@ID-}</th>
				<th scope="col">{-:@NAME-}</th>
				<th scope="col">{-:@TIME_LIMIT-}</th>
				<th scope="col" width="90">{-:@STATUS-}</th>
				<th scope="col">{-:@MANAGE-}</th>
			</tr>
			{-foreach:$_VL,$v-}
			<tr>
				<td><input name="vote_id[{-:$v['vote_id']-}]" type="checkbox" value="{-:$v['vote_id']-}"></td>
				<td>{-:$v['vote_id']-}</td>
				<td>{-:$v['v_name']-}</td>
				<td>
				{-if:0 == $v['v_time_limit']-}
					{-:@NOT_LIMIT-}
				{-elseif:1 == $v['v_time_limit']-}
					{-:$v['v_start_time']|date~'Y-m-d',@me-} ~ {-:$v['v_end_time']|date~'Y-m-d',@me-}
				{-:/if-}
				</td>
				<td>
				{-if:1 == $v['v_status']-}
					<span class="status"><b class="on">{-:@ON-}</b><a href="{-url:vote/toggle_vote_status_do?vote_id={$v['vote_id']}&v_status=0&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@TOGGLE-}</a></span>
				{-else:-}
					<span class="status"><b class="off">{-:@OFF-}</b><a href="{-url:vote/toggle_vote_status_do?vote_id={$v['vote_id']}&v_status=1&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@TOGGLE-}</a></span>
				{-:/if-}
				</td>
				<td><a target="_blank" href="{-url:home@vote/show_vote_result?vote_id={$v['vote_id']}-}">{-:@VIEW-}</a> | <a href="{-url:vote/edit_vote?vote_id={$v['vote_id']}-}">{-:@EDIT-}</a> | <a href="{-url:vote/delete_vote_do?vote_id={$v['vote_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();" >{-:@DELETE-}</a>
					<a class="btn_l" href="{-url:vote/build_js_do?vote_id={$v['vote_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@UPDATE_JS-}</a>
					<span class="btn_l" onclick="javascript:get_vote_code({-:$v['vote_id']-});" >{-:@GET_CODE-}</span></td>
			</tr>
			{-:/foreach-}
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<a class="btn_l" href="{-url:vote/add_vote-}">{-:@ADD_VOTE-}</a>
	<span class="btn_l submit" action="{-url:vote/delete_vote_do-}" to="#formList">{-:@DELETE_SELECTED-}</span>
	<span class="btn_l submit" action="{-url:vote/build_js_do-}" to="#formList">{-:@UPDATE_JS-}</span>
	<span class="btn_l submit" action="{-url:vote/clear_vote_record_do-}" to="#formList">{-:@CLEAR_VOTE_RECORD-}</span>
</div><!--/#operation-->
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script>
function get_vote_code(id) {
	var content = "<span>{-:@HTML_CODE-}</span>";
		content += "<code style=\"font-family:'Courier New'; display:block\" class=\"fs_14 bg_gry_d fc_wht p_10 br_5\">";
		content += "&lt;uwa:vote id=&quot;"+ id +"&quot;&gt;";
		content += "</code>";
		content += "<span>{-:@JS_CODE-}</span>";
		content += "<code style=\"font-family:'Courier New'; display:block\" class=\"fs_14 bg_gry_d fc_wht p_10 br_5\">";
		content += "&lt;script type=&quot;text/javascript&quot;<br />";
		content += "&nbsp;&nbsp;&nbsp;&nbsp;src=&quot;{-php:echo '{';-}-:*__APP__-}runtime/js/~vote"+ id +".js&quot;&gt;<br />";
		content += "&lt;/script&gt;";
		content += "</code>";
	dialog({
		content:content,
		id:'ab_d',
		title:'{-:@GET_CODE-}'
	}).showModal();
}
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>