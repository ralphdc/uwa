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
	<dt><strong>{-:@MEMBER_CREDIT_TYPE_LIST-}</strong><strong>{-:@ADD_CREDIT_TYPE-}</strong></dt>
	<dd>
		<div class="tabCntnt">
			<form id="formList" action="" method="post">
			<table class="listTable">
				<tr>
					<th scope="col" width="18"><input type="checkbox" class="select_all" to="member_credit_type_id"></th>
					<th scope="col">{-:@ALIAS-}</th>
					<th scope="col">{-:@NAME-}</th>
					<th scope="col">{-:@UNIT-}</th>
					<th scope="col">{-:@DEFAULT-}</th>
					<th scope="col">{-:@EXCHANGE-}</th>
					<th scope="col">{-:@RATIO-}</th>
				</tr>
				{-foreach:$_MCTL,$mct-}
				<tr>
					<td><input name="member_credit_type_id[{-:$mct['member_credit_type_id']-}]" type="checkbox" value="{-:$mct['member_credit_type_id']-}"></td>
					<td>{-:$mct['mct_alias']-}</td>
					<td><input type="text" class="required i" size="10" maxlength="96" name="mct_name[{-:$mct['member_credit_type_id']-}]" value="{-:$mct['mct_name']-}"></td>
					<td><input type="text" class="required i" size="6" maxlength="96" name="mct_unit[{-:$mct['member_credit_type_id']-}]" value="{-:$mct['mct_unit']-}"></td>
					<td><input type="text" class="required i" size="6" maxlength="96" name="mct_default[{-:$mct['member_credit_type_id']-}]" value="{-:$mct['mct_default']-}"></td>
					<td>
						<label><input type="radio" name="mct_exchange[{-:$mct['member_credit_type_id']-}]" {-if:1 == $mct['mct_exchange']-} checked="checked"{-:/if-} value="1"> {-:@ON-}</label>
						<label><input type="radio" name="mct_exchange[{-:$mct['member_credit_type_id']-}]" {-if:0 == $mct['mct_exchange']-} checked="checked"{-:/if-} value="0"> {-:@OFF-}</label>
					</td>
					<td><input type="text" class="required i" size="6" maxlength="96" name="mct_ratio[{-:$mct['member_credit_type_id']-}]" value="{-:$mct['mct_ratio']-}"></td>
				</tr>
				{-:/foreach-}
			</table>
			<div id="operation">
				<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
				<input name="token" type="hidden" value="{-:$_TK['token']-}">
				<span class="btn_l submit" action="{-url:member_credit_type/update_credit_type_do-}" to="#formList">{-:@UPDATE_SELECTED-}</span>
				<span class="btn_l submit" action="{-url:member_credit_type/delete_credit_type_do-}" to="#formList">{-:@DELETE_SELECTED-}</span>
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
						<input class="required i" type="text" value="" name="mct_alias" maxlength="64" size="30">
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@MCT_ALIAS_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@NAME-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="" name="mct_name" maxlength="64" size="30">
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@MCT_NAME_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@UNIT-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="" name="mct_unit" maxlength="20" size="10">
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@MCT_UNIT_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@DEFAULT-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="required i" type="text" value="0" name="mct_default" maxlength="20" size="10">
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@MCT_DEFAULT_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@EXCHANGE-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<label><input type="radio" name="mct_exchange" value="1"> {-:@ON-}</label>
						<label><input type="radio" name="mct_exchange" checked="checked" value="0"> {-:@OFF-}</label>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@MCT_EXCHANGE_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@RATIO-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="i" type="text" value="1" name="mct_ratio" maxlength="20" size="10">
					</td>
					<td class="inputTip">
						{-:@MCT_RATIO_TIP-}
					</td>
				</tr>
			</table>
			<div id="operation">
				<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
				<input name="token" type="hidden" value="{-:$_TK['token']-}">
				<span class="btn_b submit" action="{-url:member_credit_type/add_credit_type_do-}" to="#formAdd">{-:@SUBMIT-}</span>
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