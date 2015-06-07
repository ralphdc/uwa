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
	<dt><strong>{-:@EDIT_AD_SPACE-}</strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@NAME-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_ASI['as_name']-}" name="as_name" maxlength="64" size="30">
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
					<input class="required i" type="text" value="{-:$_ASI['as_width']-}" name="as_width" maxlength="10" size="6"> &times; <input class="required i" type="text" value="{-:$_ASI['as_height']-}" name="as_height" maxlength="10" size="6">
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
					<label><input type="radio" value="code" name="as_type" {-if:'code' == $_ASI['as_type']-} checked="checked"{-:/if-}> {-:@CODE-}</label>
					<label><input type="radio" value="text" name="as_type" {-if:'text' == $_ASI['as_type']-} checked="checked"{-:/if-}> {-:@TEXT-}</label>
					<label><input type="radio" value="image" name="as_type" {-if:'image' == $_ASI['as_type']-} checked="checked"{-:/if-}> {-:@IMAGE-}</label>
					<label><input type="radio" value="flash" name="as_type" {-if:'flash' == $_ASI['as_type']-} checked="checked"{-:/if-}> {-:@FLASH-}</label>
					<label><input type="radio" value="slide" name="as_type" {-if:'slide' == $_ASI['as_type']-} checked="checked"{-:/if-}> {-:@SLIDE-}</label>
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
					<label><input type="radio" name="as_status" value="1"{-if:1==$_ASI['as_status']-} checked="checked"{-:/if-}> {-:@ON-}</label>
					<label><input type="radio" name="as_status" value="0"{-if:0==$_ASI['as_status']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
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
					<textarea class="i" name="as_default" style="width:360px;height:80px;">{-:$_ASI['as_default']-}</textarea>
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
	<input type="hidden" value="{-:$_ASI['ad_space_id']-}" name="ad_space_id">
	<span class="btn_b submit" action="{-url:ad_space/edit_space_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:ad_space/list_space-}">{-:@BACK-}</a>
</div>
</form>
<dl class="abox">
	<dt><strong>{-:@CODE-}</strong></dt>
	<dd>
		<span>HTML{-:@CODE-}</span>
		<code style="font-family:'Courier New'; display:block" class="fs_14 bg_gry_d fc_wht p_10 br_5">
	&lt;uwa:ad id=&quot;{-:$_ASI['ad_space_id']-}&quot;&gt;
		</code>
		<span>JS{-:@CODE-}</span>
		<code style="font-family:'Courier New'; display:block" class="fs_14 bg_gry_d fc_wht p_10 br_5">
	&lt;script type=&quot;text/javascript&quot; src=&quot;{-php:echo '{';-}-:*__APP__-}runtime/js/~ad{-:$_ASI['ad_space_id']-}.js&quot;&gt;&lt;/script&gt;
		</code>
	</dd>
</dl><!--/.abox-->
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>