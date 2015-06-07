<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
</head>
<body>
<dl class="atab">
	<dt><strong>{-:@ARCHIVE_FLAG_LIST-}</strong><strong>{-:@ADD_FLAG-}</strong></dt>
	<dd>
		<div class="tabCntnt">
			<form id="formList" action="" method="post">
			<table class="listTable">
				<tr>
					<th scope="col" width="18"><input type="checkbox" class="select_all" to="af_alias"></th>
					<th scope="col" width="70">{-:@DISPLAY_ORDER-}</th>
					<th scope="col">{-:@ALIAS-}</th>
					<th scope="col">{-:@NAME-}</th>
				</tr>
				{-foreach:$_AFL,$af-}<tr>
					<td><input name="af_alias[{-:$af['af_alias']-}]" type="checkbox" value="{-:$af['af_alias']-}"></td>
					<td><input type="text" class="i required" size="6" maxlength="10" name="af_display_order[{-:$af['af_alias']-}]" value="{-:$af['af_display_order']-}"></td>
					<td>{-:$af['af_alias']-}</td>
					<td><input type="text" class="i required" size="20" maxlength="64" name="af_name[{-:$af['af_alias']-}]" value="{-:$af['af_name']-}"></td>
				</tr>{-:/foreach-}
			</table>
			<div id="operation">
				<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
				<input name="token" type="hidden" value="{-:$_TK['token']-}">
				<span class="btn_l submit" action="{-url:archive_flag/update_flag_do-}" to="#formList">{-:@UPDATE_SELECTED-}</span>
				<span class="btn_l submit" action="{-url:archive_flag/delete_flag_do-}" to="#formList">{-:@DELETE_SELECTED-}</span>
				<input class="btn_l" type="reset" value="{-:@RESET-}" />
			</div><!--/#operation-->
			</form>
		</div><!--/.tabCntnt-->
		<div class="tabCntnt">
			<form id="formAdd" action="" method="post">
			<table class="formTable">
				<tr>
					<td class="inputTitle">{-:@ALIAS-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="" name="af_alias" maxlength="10" size="6">
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@AF_ALIAS_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@NAME-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="" name="af_name" maxlength="64" size="30">
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@AF_NAME_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@DISPLAY_ORDER-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="50" name="af_display_order" maxlength="10" size="6">
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@AF_DISPLAY_ORDER_TIP-}
					</td>
				</tr>
			</table>
			<div id="operation">
				<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
				<input name="token" type="hidden" value="{-:$_TK['token']-}">
				<span class="btn_b submit" action="{-url:archive_flag/add_flag_do-}" to="#formAdd">{-:@SUBMIT-}</span>
				<input class="btn_l" type="reset" value="{-:@RESET-}" />
			</div>
			</form>
		</div><!--/.tabCntnt-->
	</dd>
</dl><!--/.atab-->
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>