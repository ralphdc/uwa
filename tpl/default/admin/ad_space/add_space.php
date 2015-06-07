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
	<dt><strong>{-:@ADD_AD_SPACE-}</strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@NAME-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="" name="as_name" maxlength="64" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@AS_NAME_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@SIZE-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="0" name="as_width" maxlength="10" size="6"> &times; <input class="required i" type="text" value="0" name="as_height" maxlength="10" size="6">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@AS_SIZE_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@TYPE-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="code" name="as_type" checked="checked"> {-:@CODE-}</label>
					<label><input type="radio" value="text" name="as_type"> {-:@TEXT-}</label>
					<label><input type="radio" value="image" name="as_type"> {-:@IMAGE-}</label>
					<label><input type="radio" value="flash" name="as_type"> {-:@FLASH-}</label>
					<label><input type="radio" value="slide" name="as_type"> {-:@SLIDE-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@AS_TYPE_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@STATUS-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" name="as_status" checked="checked" value="1"> {-:@ON-}</label>
					<label><input type="radio" name="as_status" value="0"> {-:@OFF-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@AS_STATUS_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@DEFAULT-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" name="as_default" style="width:360px;height:80px;"></textarea>
				</td>
				<td class="inputTip">
					{-:@AS_DEFAULT_TIP-}
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_b submit" action="{-url:ad_space/add_space_do-}" to="#formAdd">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:ad_space/list_space-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>