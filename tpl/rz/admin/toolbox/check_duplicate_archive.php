<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
</head>
<body>
<dl class="abox">
	<dt><strong>{-:@CHECK_DUPLICATE_ARCHIVE-}</strong></dt>
	<dd>
		<div class="tabCntnt"><!--BUILD_ARCHIVE-->
	<form id="formCheck" action="" method="post">
			<table class="listTable">
				<tr>
					<th scope="col" width="20%"></th>
					<th scope="col">{-:@OPTION-}</th>
				</tr>
				<tr>
					<td align="right">{-:@ARCHIVE_MODEL-}</td>
					<td><select name="archive_model_id">
						{-foreach:$_AML,$am-}
							<option value="{-:$am['archive_model_id']-}">{-:$am['am_name']-}</option>
						{-:/foreach-}
					</select></td>
				</tr>
				<tr>
					<td align="right">{-:@PAGE_SIZE-}</td>
					<td><input name="page_size" class="i" type="text" value="100" size="5" /></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
						<input name="token" type="hidden" value="{-:$_TK['token']-}">
						<input name="action" type="hidden" value="check" />
						<span class="btn_b submit" action="{-url:toolbox/check_duplicate_archive-}" to="#formCheck">{-:@CHECK-}</span>
					</td>
				</tr>
			</table>
	</form>
		</div>
	</dd>
</dl><!--/.abox-->
{-if:!empty($_DAL)-}<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@DUPLICATE_ARCHIVE_LIST-}</strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="a_title"></th>
				<th scope="col">{-:@COUNT-}</th>
				<th scope="col">{-:@TITLE-}</th>
				<th scope="col">{-:@VIEW-}</th>
			</tr>
			{-foreach:$_DAL,$a-}
			<tr>
				<td>
					<input name="a_title[]" type="checkbox" value="{-:$a['a_title']|urlencode~@me-}">
				</td>
				<td>{-:$a['dac']-}</td>
				<td>
					{-:$a['a_title']-}
				</td>
				<td>
					<a href="{-url:home@search/search_do?keyword={$a['a_title']}-}" target="_blank">{-:@VIEW-}</a>
				</td>
			</tr>
			{-:/foreach-}
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_l submit" action="{-url:toolbox/delete_duplicate_archive_do-}" to="#formList">{-:@DELETE_SELECTED-}</span>
	<label><input name="retain" class="i" type="radio" value="oldest" checked="checked" /> {-:@RETAIN_OLDEST-}</label>
	<label><input name="retain" class="i" type="radio" value="latest" /> {-:@RETAIN_LATEST-}</label>
</div><!--/#operation-->
</form>{-:/if-}
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>