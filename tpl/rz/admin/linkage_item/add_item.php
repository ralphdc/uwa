<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
</head>
<body>
<form id="formAdd" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@ADD_LINKAGE_ITEM-}</strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td>{-:@PARENT_ITEM-}</td>
				<td class="inputTitle">{-:@LINKAGE-}</td>
			</tr>
			<tr>
				<td class="inputTip">
					<select name="li_parent_id">
						<option value="0"{-if:0==$_V['li_parent_id']-} selected="selected"{-:/if-}>{-:@TOP_ITEM-}</option>
						{-:$_LILStr-}
					</select>
				</td>
				<td class="inputArea">
					<input name="l_alias" type="hidden" value="{-:$_V['l_alias']-}">
					{-:$_V['l_name']-} | {-:$_V['l_alias']-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@NAME-}</td>
				<td class="inputTitle">{-:@DISPLAY_ORDER-}</td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea name="li_name_list" class="i required" style="width:180px;height:90px;"></textarea>
					<span class="fc_gry"><span class="fc_r">*</span> {-:@ADD_LINKAGE_ITEM_NAME_TIP-}</span>
				</td>
				<td class="inputArea">
					<input class="i required" type="text" value="0" name="li_display_order" maxlength="10" size="4">
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_b submit" action="{-url:linkage_item/add_item_do-}" to="#formAdd">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:linkage_item/list_item?li_parent_id={$_LII['linkage_item_id']}-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>