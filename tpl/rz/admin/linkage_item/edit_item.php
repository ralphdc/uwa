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
	<dt><strong>{-:@EDIT_LINKAGE_ITEM-}</strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td>{-:@PARENT_ITEM-}</td>
				<td class="inputTitle">{-:@LINKAGE-}</td>
			</tr>
			<tr>
				<td class="inputTip">
					<select name="li_parent_id">
						<option value="0"{-if:0==$_LII['li_parent_id']-} selected="selected"{-:/if-}>{-:@TOP_ITEM-}</option>
						{-:$_LILStr-}
					</select>
				</td>
				<td class="inputArea">
					{-:$_LII['l_name']-} | {-:$_LII['l_alias']-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@NAME-}</td>
				<td class="inputTitle">{-:@DISPLAY_ORDER-}</td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="i" type="text" value="{-:$_LII['li_name']-}" name="li_name" maxlength="32" size="16">
				</td>
				<td class="inputArea">
					<input class="i" type="text" value="{-:$_LII['li_display_order']-}" name="li_display_order" maxlength="10" size="4">
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<input type="hidden" value="{-:$_LII['linkage_item_id']-}" name="linkage_item_id">
	<span class="btn_b submit" action="{-url:linkage_item/edit_item_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:linkage_item/list_item?li_parent_id={$_LII['li_parent_id']}-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>