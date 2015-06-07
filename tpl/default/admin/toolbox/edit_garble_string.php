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
	<dt><strong>{-:@GARBLE_STRING-}</strong></dt>
	<dd>
		<div class="tabCntnt">
			<div class="mainTips">
			{-:@GARBLE_STRING_USEAGE_TIP-}
			</div>
			<table id="main_params" class="formTable">
				<tr>
					<td class="inputArea">
						<label><strong>{-:@GARBLE_MAX_DISTANCE-}</strong>: <input class="i required" type="text" value="{-:$_O['max_distance']-}" name="max_distance" maxlength="10" size="4" /> <span class="fc_gry"><span class="fc_r">*</span> {-:@GARBLE_MAX_DISTANCE_TIP-}</span></label>
					</td>
				</tr>
				<tr>
					<td class="inputArea">
						<label><strong>{-:@GARBLE_STYLE_NAME_LENGTH-}</strong>: <input class="i required" type="text" value="{-:$_O['style_name_length']-}" name="style_name_length" maxlength="10" size="4" /> <span class="fc_gry"><span class="fc_r">*</span> {-:@GARBLE_STYLE_NAME_LENGTH_TIP-}</span></label>
					</td>
				</tr>
				<tr>
					<td class="inputArea">
						<label><strong>{-:@GARBLE_FONT_COLOR-}</strong>: <input class="i required" type="text" value="{-:$_O['font_color']-}" name="font_color" maxlength="10" size="8" /> <span class="fc_gry"><span class="fc_r">*</span> {-:@GARBLE_FONT_COLOR_TIP-}</span></label>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@GARBLE_TAG-} <span class="fc_gry fw_n"><span class="fc_r">*</span> {-:@GARBLE_TAG_TIP-}</span></td>
				</tr>
				<tr>
					<td class="inputArea">
						<textarea class="i required" name="tag" style="width:480px;height:40px;">{-:$_O['tag']-}</textarea>
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@GARBLE_STRING-} <span class="fc_gry fw_n"><span class="fc_r">*</span> {-:@GARBLE_STRING_TIP-}</span></td>
				</tr>
				<tr>
					<td class="inputArea">
						<textarea class="i required" name="string" style="width:480px;height:120px;">{-:$_O['string']-}</textarea>
					</td>
				</tr>
			</table>
		</div><!--/.tabCntnt-->
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_b submit" action="{-url:toolbox/edit_garble_string_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>