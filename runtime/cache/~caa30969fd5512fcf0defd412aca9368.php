<?php /* PFA Template Cache File. Create Time:2015-06-06 11:05:45 */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="/tpl/default/admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="/tpl/default/admin/css/mf.css" />
</head>
<body>
<form id="formEdit" action="" method="post">
<dl class="abox">
	<dt><span><a href="<?php echo(Url::U("option/edit_option_site")); ?>"><?php echo(L("SITE")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_core")); ?>"><?php echo(L("CORE")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_index")); ?>"><?php echo(L("INDEX")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_performance")); ?>"><?php echo(L("PERFORMANCE")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_upload")); ?>"><?php echo(L("UPLOAD")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_image")); ?>"><?php echo(L("IMAGE")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_member")); ?>"><?php echo(L("MEMBER")); ?></a></span><strong><?php echo(L("INTERACTION")); ?></strong><span><a href="<?php echo(Url::U("option/edit_custom_option")); ?>"><?php echo(L("CUSTOM_OPTION")); ?></a></span></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle"><?php echo(L("REVIEW_SWITCH")); ?> [interaction/review_switch]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="interaction[review_switch]"<?php if(0==$_O['interaction']['review_switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("OFF")); ?></label>
					<label><input type="radio" value="1" name="interaction[review_switch]"<?php if(1==$_O['interaction']['review_switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("MEMBER_ON")); ?></label>
					<label><input type="radio" value="2" name="interaction[review_switch]"<?php if(2==$_O['interaction']['review_switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("ALL_ON")); ?></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("REVIEW_SWITCH_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("SEARCH_SWITCH")); ?> [interaction/search_switch]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="interaction[search_switch]"<?php if(0==$_O['interaction']['search_switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("OFF")); ?></label>
					<label><input type="radio" value="1" name="interaction[search_switch]"<?php if(1==$_O['interaction']['search_switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("ON")); ?></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("SEARCH_SWITCH_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("FEEDBACK_CHECK")); ?> [interaction/feedback_check]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="interaction[feedback_check]"<?php if(0==$_O['interaction']['feedback_check']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("OFF")); ?></label>
					<label><input type="radio" value="1" name="interaction[feedback_check]"<?php if(1==$_O['interaction']['feedback_check']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("ON")); ?></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("FEEDBACK_CHECK_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("FEEDBACK_INTERVAL")); ?> [interaction/feedback_interval]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['interaction']['feedback_interval']); ?>" name="interaction[feedback_interval]" maxlength="10" size="4">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("FEEDBACK_INTERVAL_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("SEARCH_INTERVAL")); ?> [interaction/search_interval]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['interaction']['search_interval']); ?>" name="interaction[search_interval]" maxlength="10" size="4">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("SEARCH_INTERVAL_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("CAPTCHA")); ?> [interaction/captcha]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="interaction[captcha]"<?php if(0==$_O['interaction']['captcha']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("OFF")); ?></label>
					<label><input type="radio" value="1" name="interaction[captcha]"<?php if(1==$_O['interaction']['captcha']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("ON")); ?></label>
					<img src="<?php echo(Url::U("common/captcha_img?name=test")); ?>" />
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("CAPTCHA_SWITCH_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("MANAGE_CAPTCHA")); ?> [interaction/manage_captcha]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="interaction[manage_captcha]"<?php if(0==$_O['interaction']['manage_captcha']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("OFF")); ?></label>
					<label><input type="radio" value="1" name="interaction[manage_captcha]"<?php if(1==$_O['interaction']['manage_captcha']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("ON")); ?></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("MANAGE_CAPTCHA_SWITCH_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("REPORT_SWITCH")); ?> [interaction/report_switch]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="interaction[report_switch]"<?php if(0==$_O['interaction']['report_switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("OFF")); ?></label>
					<label><input type="radio" value="1" name="interaction[report_switch]"<?php if(1==$_O['interaction']['report_switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("ON")); ?></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("REPORT_SWITCH_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("AUTO_REPORT")); ?> [interaction/auto_report]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="interaction[auto_report]"<?php if(0==$_O['interaction']['auto_report']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("OFF")); ?></label>
					<label><input type="radio" value="1" name="interaction[auto_report]"<?php if(1==$_O['interaction']['auto_report']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("VERIFY")); ?></label>
					<label><input type="radio" value="2" name="interaction[auto_report]"<?php if(2==$_O['interaction']['auto_report']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("FILTER")); ?></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("AUTO_REPORT_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("FILTER_WORDS")); ?> [interaction/filter_words]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" name="interaction[filter_words]" style="width:360px;height:120px;"><?php echo($_O['interaction']['filter_words']); ?></textarea>
				</td>
				<td class="inputTip">
					<?php echo(L("FILTER_WORDS_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("FILTER_REPLACE")); ?> [interaction/filter_replace]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['interaction']['filter_replace']); ?>" name="interaction[filter_replace]" maxlength="10" size="4">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("FILTER_REPLACE_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("ALLOW_TAGS")); ?> [interaction/allow_tags]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" name="interaction[allow_tags]" style="width:360px;height:120px;"><?php echo($_O['interaction']['allow_tags']); ?></textarea>
				</td>
				<td class="inputTip">
					<?php echo(L("ALLOW_TAGS_TIP")); ?>
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
	<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
	<span class="btn_b submit" action="<?php echo(Url::U("option/edit_option_interaction_do")); ?>" to="#formEdit"><?php echo(L("SUBMIT")); ?></span>
	<input class="btn_l" type="reset" value="<?php echo(L("RESET")); ?>" />
</div>
</form>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script>
var l_option_not_saved_tip = '<?php echo(L("OPTION_NOT_SAVED_TIP")); ?>';
</script>
<script src="/tpl/default/admin/js/c.js"></script>
<script src="/tpl/default/admin/js/o.js"></script>
</body>
</html>