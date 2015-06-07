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
	<dt><span><a href="{-url:option/edit_option_site-}">{-:@SITE-}</a></span><span><a href="{-url:option/edit_option_core-}">{-:@CORE-}</a></span><span><a href="{-url:option/edit_option_index-}">{-:@INDEX-}</a></span><span><a href="{-url:option/edit_option_performance-}">{-:@PERFORMANCE-}</a></span><span><a href="{-url:option/edit_option_upload-}">{-:@UPLOAD-}</a></span><span><a href="{-url:option/edit_option_image-}">{-:@IMAGE-}</a></span><span><a href="{-url:option/edit_option_member-}">{-:@MEMBER-}</a></span><strong>{-:@INTERACTION-}</strong><span><a href="{-url:option/edit_custom_option-}">{-:@CUSTOM_OPTION-}</a></span></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@REVIEW_SWITCH-} [interaction/review_switch]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="interaction[review_switch]"{-if:0==$_O['interaction']['review_switch']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
					<label><input type="radio" value="1" name="interaction[review_switch]"{-if:1==$_O['interaction']['review_switch']-} checked="checked"{-:/if-}> {-:@MEMBER_ON-}</label>
					<label><input type="radio" value="2" name="interaction[review_switch]"{-if:2==$_O['interaction']['review_switch']-} checked="checked"{-:/if-}> {-:@ALL_ON-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@REVIEW_SWITCH_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@SEARCH_SWITCH-} [interaction/search_switch]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="interaction[search_switch]"{-if:0==$_O['interaction']['search_switch']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
					<label><input type="radio" value="1" name="interaction[search_switch]"{-if:1==$_O['interaction']['search_switch']-} checked="checked"{-:/if-}> {-:@ON-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@SEARCH_SWITCH_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@FEEDBACK_CHECK-} [interaction/feedback_check]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="interaction[feedback_check]"{-if:0==$_O['interaction']['feedback_check']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
					<label><input type="radio" value="1" name="interaction[feedback_check]"{-if:1==$_O['interaction']['feedback_check']-} checked="checked"{-:/if-}> {-:@ON-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@FEEDBACK_CHECK_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@FEEDBACK_INTERVAL-} [interaction/feedback_interval]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['interaction']['feedback_interval']-}" name="interaction[feedback_interval]" maxlength="10" size="4">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@FEEDBACK_INTERVAL_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@SEARCH_INTERVAL-} [interaction/search_interval]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['interaction']['search_interval']-}" name="interaction[search_interval]" maxlength="10" size="4">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@SEARCH_INTERVAL_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@CAPTCHA-} [interaction/captcha]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="interaction[captcha]"{-if:0==$_O['interaction']['captcha']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
					<label><input type="radio" value="1" name="interaction[captcha]"{-if:1==$_O['interaction']['captcha']-} checked="checked"{-:/if-}> {-:@ON-}</label>
					<img src="{-url:common/captcha_img?name=test-}" />
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@CAPTCHA_SWITCH_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@MANAGE_CAPTCHA-} [interaction/manage_captcha]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="interaction[manage_captcha]"{-if:0==$_O['interaction']['manage_captcha']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
					<label><input type="radio" value="1" name="interaction[manage_captcha]"{-if:1==$_O['interaction']['manage_captcha']-} checked="checked"{-:/if-}> {-:@ON-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@MANAGE_CAPTCHA_SWITCH_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@REPORT_SWITCH-} [interaction/report_switch]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="interaction[report_switch]"{-if:0==$_O['interaction']['report_switch']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
					<label><input type="radio" value="1" name="interaction[report_switch]"{-if:1==$_O['interaction']['report_switch']-} checked="checked"{-:/if-}> {-:@ON-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@REPORT_SWITCH_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@AUTO_REPORT-} [interaction/auto_report]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="interaction[auto_report]"{-if:0==$_O['interaction']['auto_report']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
					<label><input type="radio" value="1" name="interaction[auto_report]"{-if:1==$_O['interaction']['auto_report']-} checked="checked"{-:/if-}> {-:@VERIFY-}</label>
					<label><input type="radio" value="2" name="interaction[auto_report]"{-if:2==$_O['interaction']['auto_report']-} checked="checked"{-:/if-}> {-:@FILTER-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@AUTO_REPORT_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@FILTER_WORDS-} [interaction/filter_words]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" name="interaction[filter_words]" style="width:360px;height:120px;">{-:$_O['interaction']['filter_words']-}</textarea>
				</td>
				<td class="inputTip">
					{-:@FILTER_WORDS_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@FILTER_REPLACE-} [interaction/filter_replace]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_O['interaction']['filter_replace']-}" name="interaction[filter_replace]" maxlength="10" size="4">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@FILTER_REPLACE_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@ALLOW_TAGS-} [interaction/allow_tags]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" name="interaction[allow_tags]" style="width:360px;height:120px;">{-:$_O['interaction']['allow_tags']-}</textarea>
				</td>
				<td class="inputTip">
					{-:@ALLOW_TAGS_TIP-}
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_b submit" action="{-url:option/edit_option_interaction_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script>
var l_option_not_saved_tip = '{-:@OPTION_NOT_SAVED_TIP-}';
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/o.js"></script>
</body>
</html>