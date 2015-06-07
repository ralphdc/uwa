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
	<dt><strong>{-:@FLINK_CATEGORY_LIST-}</strong><strong>{-:@ADD_CATEGORY-}</strong></dt>
	<dd>
		<div class="tabCntnt">
			<form id="formList" action="" method="post">
			<table class="listTable">
				<tr>
					<th scope="col" width="18"><input type="checkbox" class="select_all" to="flink_category_id"></th>
					<th scope="col">{-:@NAME-}</th>
					<th scope="col">{-:@DISPLAY_ORDER-}</th>
				</tr>
				{-foreach:$_FCL,$fc-}
				<tr>
					<td><input name="flink_category_id[{-:$fc['flink_category_id']-}]" type="checkbox" value="{-:$fc['flink_category_id']-}"></td>
					<td><input type="text" class="required i" size="10" maxlength="96" name="fc_name[{-:$fc['flink_category_id']-}]" value="{-:$fc['fc_name']-}"></td>
					<td><input type="text" class="required i" size="6" maxlength="10" name="fc_display_order[{-:$fc['flink_category_id']-}]" value="{-:$fc['fc_display_order']-}"></td>
				</tr>
				{-:/foreach-}
			</table>
			<div id="operation">
				<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
				<input name="token" type="hidden" value="{-:$_TK['token']-}">
				<span class="btn_l submit" action="{-url:flink_category/update_category_do-}" to="#formList">{-:@UPDATE_SELECTED-}</span>
				<span class="btn_l submit" action="{-url:flink_category/delete_category_do-}" to="#formList">{-:@DELETE_SELECTED-}</span>
				<input class="btn_l" type="reset" value="{-:@RESET-}" />
				<a class="btn_l" href="{-url:flink/list_flink-}">{-:@FLINK_LIST-}</a>
			</div><!--/#operation-->
			</form>
		</div><!--/.tabCntnt-->
		<div class="tabCntnt">
			<form id="formAdd" action="" method="post">
			<table class="formTable">
				<tr>
					<td class="inputTitle">{-:@NAME-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="" name="fc_name" maxlength="64" size="30">
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@FC_NAME_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@DISPLAY_ORDER-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="50" name="fc_display_order" maxlength="10" size="6">
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@FC_DISPLAY_ORDER_TIP-}
					</td>
				</tr>
			</table><!--/.tabCntnt-->
			<div id="operation">
				<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
				<input name="token" type="hidden" value="{-:$_TK['token']-}">
				<span class="btn_b submit" action="{-url:flink_category/add_category_do-}" to="#formAdd">{-:@SUBMIT-}</span>
				<input class="btn_l" type="reset" value="{-:@RESET-}" />
			</div>
			</form>
		</div>
	</dd>
</dl><!--/.atab-->
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>