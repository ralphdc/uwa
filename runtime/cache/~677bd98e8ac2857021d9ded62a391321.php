<?php /* PFA Template Cache File. Create Time:2015-06-06 10:21:58 */ ?>
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
	<dt><span><a href="<?php echo(Url::U("option/edit_option_site")); ?>"><?php echo(L("SITE")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_core")); ?>"><?php echo(L("CORE")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_index")); ?>"><?php echo(L("INDEX")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_performance")); ?>"><?php echo(L("PERFORMANCE")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_upload")); ?>"><?php echo(L("UPLOAD")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_option_image")); ?>"><?php echo(L("IMAGE")); ?></a></span><strong><?php echo(L("MEMBER")); ?></strong><span><a href="<?php echo(Url::U("option/edit_option_interaction")); ?>"><?php echo(L("INTERACTION")); ?></a></span><span><a href="<?php echo(Url::U("option/edit_custom_option")); ?>"><?php echo(L("CUSTOM_OPTION")); ?></a></span></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle"><?php echo(L("MEMBER_SWITCH")); ?> [member/switch]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="member[switch]"<?php if(0==$_O['member']['switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("OFF")); ?></label>
					<label><input type="radio" value="1" name="member[switch]"<?php if(1==$_O['member']['switch']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("ON")); ?></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("MEMBER_SWITCH_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("MEMBER_REGISTER")); ?> [member/register]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="member[register]"<?php if(0==$_O['member']['register']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("OFF")); ?></label>
					<label><input type="radio" value="1" name="member[register]"<?php if(1==$_O['member']['register']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("ON")); ?></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("MEMBER_REGISTER_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("MEMBER_NAME_BAN")); ?> [member/name_ban]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" name="member[name_ban]" style="width:360px;height:60px;"><?php echo($_O['member']['name_ban']); ?></textarea>
				</td>
				<td class="inputTip">
					<?php echo(L("MEMBER_NAME_BAN_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("MEMBER_USERID_MIN_LENGTH")); ?> [member/userid_min_length]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['member']['userid_min_length']); ?>" name="member[userid_min_length]" maxlength="20" size="10">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("MEMBER_USERID_MIN_LENGTH_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("MEMBER_PASSWORD_MIN_LENGTH")); ?> [member/password_min_length]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['member']['password_min_length']); ?>" name="member[password_min_length]" maxlength="20" size="10">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("MEMBER_PASSWORD_MIN_LENGTH_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("MEMBER_PASS_TYPE")); ?> [member/pass_type]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="member[pass_type]"<?php if(0==$_O['member']['pass_type']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("AUTO")); ?></label>
					<label><input type="radio" value="1" name="member[pass_type]"<?php if(1==$_O['member']['pass_type']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("MANUAL")); ?></label>
					<label><input type="radio" value="2" name="member[pass_type]"<?php if(2==$_O['member']['pass_type']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("EMAIL")); ?></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("MEMBER_PASS_TYPE_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("VERIFY_EMAIL_VALIDITY")); ?> [member/verify_email_validity]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_O['member']['verify_email_validity']); ?>" name="member[verify_email_validity]" maxlength="20" size="10">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("VERIFY_EMAIL_VALIDITY_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("LOGIN_CREDIT")); ?> [member/login_credit]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input class="required i" type="text" value="<?php echo($_O['member']['login_credit']['m_experience']); ?>" name="member[login_credit][m_experience]" maxlength="4" size="4"> <?php echo(L("EXPERIENCE")); ?></label>
					<label><input class="required i" type="text" value="<?php echo($_O['member']['login_credit']['m_points']); ?>" name="member[login_credit][m_points]" maxlength="4" size="4"> <?php echo(L("POINTS")); ?></label>
				</td>
				<td class="inputArea">
					<table class="listTable">
						<tr>
							<?php if(isset($_MCTL) and is_array($_MCTL)) : foreach($_MCTL as $ct) : ?>
							<th scope="col"><?php echo($ct['mct_name']); ?>[<?php echo($ct['mct_unit']); ?>]</th>
							<?php endforeach; endif; ?>
						</tr>
						<tr>
							<?php if(isset($_MCTL) and is_array($_MCTL)) : foreach($_MCTL as $ct) : ?><td>
								<label><input class="required i" type="text" value="<?php if($_O['member']['login_credit'][$ct['mct_alias']]) :  ?><?php echo($_O['member']['login_credit'][$ct['mct_alias']]); ?><?php else : ?>0<?php endif; ?>" name="member[login_credit][<?php echo($ct['mct_alias']); ?>]" maxlength="4" size="4"></label>
							</td><?php endforeach; endif; ?>
						</tr>
					</table><!--/credit table-->
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("PUBLISH_CREDIT")); ?> [member/publish_credit]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input class="required i" type="text" value="<?php echo($_O['member']['publish_credit']['m_experience']); ?>" name="member[publish_credit][m_experience]" maxlength="4" size="4"> <?php echo(L("EXPERIENCE")); ?></label>
					<label><input class="required i" type="text" value="<?php echo($_O['member']['publish_credit']['m_points']); ?>" name="member[publish_credit][m_points]" maxlength="4" size="4"> <?php echo(L("POINTS")); ?></label>
				</td>
				<td class="inputArea">
					<table class="listTable">
						<tr>
							<?php if(isset($_MCTL) and is_array($_MCTL)) : foreach($_MCTL as $ct) : ?>
							<th scope="col"><?php echo($ct['mct_name']); ?>[<?php echo($ct['mct_unit']); ?>]</th>
							<?php endforeach; endif; ?>
						</tr>
						<tr>
							<?php if(isset($_MCTL) and is_array($_MCTL)) : foreach($_MCTL as $ct) : ?><td>
								<label><input class="required i" type="text" value="<?php if($_O['member']['publish_credit'][$ct['mct_alias']]) :  ?><?php echo($_O['member']['publish_credit'][$ct['mct_alias']]); ?><?php else : ?>0<?php endif; ?>" name="member[publish_credit][<?php echo($ct['mct_alias']); ?>]" maxlength="4" size="4"></label>
							</td><?php endforeach; endif; ?>
						</tr>
					</table><!--/credit table-->
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("REVIEW_CREDIT")); ?> [member/review_credit]</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input class="required i" type="text" value="<?php echo($_O['member']['review_credit']['m_experience']); ?>" name="member[review_credit][m_experience]" maxlength="4" size="4"> <?php echo(L("EXPERIENCE")); ?></label>
					<label><input class="required i" type="text" value="<?php echo($_O['member']['review_credit']['m_points']); ?>" name="member[review_credit][m_points]" maxlength="4" size="4"> <?php echo(L("POINTS")); ?></label>
				</td>
				<td class="inputArea">
					<table class="listTable">
						<tr>
							<?php if(isset($_MCTL) and is_array($_MCTL)) : foreach($_MCTL as $ct) : ?>
							<th scope="col"><?php echo($ct['mct_name']); ?>[<?php echo($ct['mct_unit']); ?>]</th>
							<?php endforeach; endif; ?>
						</tr>
						<tr>
							<?php if(isset($_MCTL) and is_array($_MCTL)) : foreach($_MCTL as $ct) : ?><td>
								<label><input class="required i" type="text" value="<?php if($_O['member']['review_credit'][$ct['mct_alias']]) :  ?><?php echo($_O['member']['review_credit'][$ct['mct_alias']]); ?><?php else : ?>0<?php endif; ?>" name="member[review_credit][<?php echo($ct['mct_alias']); ?>]" maxlength="4" size="4"></label>
							</td><?php endforeach; endif; ?>
						</tr>
					</table><!--/credit table-->
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
	<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
	<span class="btn_b submit" action="<?php echo(Url::U("option/edit_option_member_do")); ?>" to="#formEdit"><?php echo(L("SUBMIT")); ?></span>
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