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
	<dt><strong>{-:@EDIT_LINKAGE-}</strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@NAME-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_LI['l_name']-}" name="l_name" maxlength="96" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@L_NAME_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@ALIAS-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_LI['l_alias']-}" name="l_alias" maxlength="96" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@L_ALIAS_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@DESCRIPTION-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" name="l_description" style="width:360px;height:60px;">{-:$_LI['l_description']-}</textarea>
				</td>
				<td class="inputTip">
					<span class="fc_gry">{-:@L_DESCRIPTION_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@TYPE-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					{-if:0 == $_LI['l_type']-}
						{-:@SYSTEM-}
					{-elseif:1 == $_LI['l_type']-}
						{-:@CUSTOM-}
					{-:/if-}
				</td>
				<td class="inputArea">
					<span class="fc_gry">{-:@L_TYPE_TIP-}</span>
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<input name="linkage_id" type="hidden" value="{-:$_LI['linkage_id']-}">
	<span class="btn_b submit" action="{-url:linkage/edit_linkage_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:linkage/list_linkage-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>