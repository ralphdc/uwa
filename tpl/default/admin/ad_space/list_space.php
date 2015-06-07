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
	<dt><strong>{-:@AD_SPACE_LIST-}</strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="ad_space_id"></th>
				<th scope="col">{-:@ID-}</th>
				<th scope="col">{-:@NAME-}</th>
				<th scope="col">{-:@SIZE-}</th>
				<th scope="col">{-:@TYPE-}</th>
				<th scope="col" width="90">{-:@STATUS-}</th>
				<th scope="col">{-:@MANAGE-}</th>
			</tr>
			{-foreach:$_ASL,$as-}
			<tr>
				<td><input name="ad_space_id[{-:$as['ad_space_id']-}]" type="checkbox" value="{-:$as['ad_space_id']-}"></td>
				<td>{-:$as['ad_space_id']-}</td>
				<td>{-:$as['as_name']-}</td>
				<td>{-:$as['as_width']-} &times; {-:$as['as_height']-}</td>
				<td>{-if:'code' == $as['as_type']-}{-:@CODE-}{-elseif:'text' == $as['as_type']-}{-:@TEXT-}{-elseif:'image' == $as['as_type']-}{-:@IMAGE-}{-elseif:'flash' == $as['as_type']-}{-:@FLASH-}{-elseif:'slide' == $as['as_type']-}{-:@SLIDE-}{-:/if-}</td>
				<td>
				{-if:1 == $as['as_status']-}
					<span class="status"><b class="on">{-:@ON-}</b><a href="{-url:ad_space/toggle_space_status_do?ad_space_id={$as['ad_space_id']}&as_status=0&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@TOGGLE-}</a></span>
				{-else:-}
					<span class="status"><b class="off">{-:@OFF-}</b><a href="{-url:ad_space/toggle_space_status_do?ad_space_id={$as['ad_space_id']}&as_status=1&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@TOGGLE-}</a></span>
				{-:/if-}
				</td>
				<td><a href="{-url:ad/list_ad?ad_space_id={$as['ad_space_id']}-}">{-:@AD_LIST-}</a> | <a href="{-url:ad/add_ad?ad_space_id={$as['ad_space_id']}-}">{-:@ADD_AD-}</a> | <a href="{-url:ad_space/edit_space?ad_space_id={$as['ad_space_id']}-}">{-:@EDIT-}</a> | <a href="{-url:ad_space/delete_space_do?ad_space_id={$as['ad_space_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();" >{-:@DELETE-}</a>
					<a class="btn_l" href="{-url:ad_space/build_js_do?ad_space_id={$as['ad_space_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@UPDATE_JS-}</a>
					<span class="btn_l" onclick="javascript:get_ad_code({-:$as['ad_space_id']-});" >{-:@GET_CODE-}</span>
				</td>
			</tr>
			{-:/foreach-}
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<a class="btn_l" href="{-url:ad_space/add_space-}">{-:@ADD_AD_SPACE-}</a>
	<span class="btn_l submit" action="{-url:ad_space/delete_space_do-}" to="#formList">{-:@DELETE_SELECTED-}</span>
	<span class="btn_l submit" action="{-url:ad_space/build_js_do-}" to="#formList">{-:@UPDATE_JS-}</span>
	<a class="btn_l" href="{-url:ad/list_ad-}">{-:@AD_LIST-}</a>
</div><!--/#operation-->
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script>
function get_ad_code(id) {
	var content = "<span>{-:@HTML_CODE-}</span>";
		content += "<code style=\"font-family:'Courier New'; display:block\" class=\"fs_14 bg_gry_d fc_wht p_10 br_5\">";
		content += "&lt;uwa:ad id=&quot;"+ id +"&quot;&gt;";
		content += "</code>";
		content += "<span>{-:@JS_CODE-}</span>";
		content += "<code style=\"font-family:'Courier New'; display:block\" class=\"fs_14 bg_gry_d fc_wht p_10 br_5\">";
		content += "&lt;script type=&quot;text/javascript&quot;<br />";
		content += "&nbsp;&nbsp;&nbsp;&nbsp;src=&quot;{-php:echo '{';-}-:*__APP__-}runtime/js/~ad"+ id +".js&quot;&gt;<br />";
		content += "&lt;/script&gt;";
		content += "</code>";
	dialog({
		content:content,
		id:'ab_d',
		title:'{-:@GET_CODE-}',
		padding:'10px'
	}).showModal();
}
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>