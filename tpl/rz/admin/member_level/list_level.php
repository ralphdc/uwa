<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
</head>
<body>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@MEMBER_LEVEL_LIST-}</strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="member_level_id"></th>
				<th scope="col">{-:@NAME-}</th>
				<th scope="col">{-:@RANK-}</th>
				<th scope="col">{-:@MIN_EXPERIENCE-}</th>
				<th scope="col">{-:@LEVEL_TYPE-}</th>
				<th scope="col">{-:@MANAGE-}</th>
			</tr>
			{-foreach:$_MLL,$ml-}
			<tr>
				<td><input name="member_level_id[{-:$ml['member_level_id']-}]" type="checkbox" value="{-:$ml['member_level_id']-}"></td>
				<td><input type="text" class="required i" size="10" maxlength="96" name="ml_name[{-:$ml['member_level_id']-}]" value="{-:$ml['ml_name']-}"></td>
				<td><input type="text" class="required i" size="6" maxlength="10" name="ml_rank[{-:$ml['member_level_id']-}]" value="{-:$ml['ml_rank']-}"></td>
				<td><input type="text" class="required i" size="10" maxlength="96" name="ml_min_experience[{-:$ml['member_level_id']-}]" value="{-:$ml['ml_min_experience']-}"></td>
				<td>
					<label><input type="radio" name="ml_type[{-:$ml['member_level_id']-}]"{-if:0 == $ml['ml_type']-} checked="checked"{-:/if-} value="0"> {-:@SYSTEM-}</label>
					<label><input type="radio" name="ml_type[{-:$ml['member_level_id']-}]"{-if:1 == $ml['ml_type']-} checked="checked"{-:/if-} value="1"> {-:@CUSTOM-}</label>
				</td>
				<td><a href="{-url:member_level/edit_level?member_level_id={$ml['member_level_id']}-}">{-:@EDIT-}</a> | <a href="{-url:member_level/delete_level_do?member_level_id={$ml['member_level_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();" >{-:@DELETE-}</a></td>
			</tr>
			{-:/foreach-}
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<a class="btn_l" href="{-url:member_level/add_level-}">{-:@ADD_LEVEL-}</a>
	<span class="btn_l submit" action="{-url:member_level/update_level_do-}" to="#formList">{-:@UPDATE_SELECTED-}</span>
	<span class="btn_l submit" action="{-url:member_level/delete_level_do-}" to="#formList">{-:@DELETE_SELECTED-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
</div><!--/#operation-->
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>