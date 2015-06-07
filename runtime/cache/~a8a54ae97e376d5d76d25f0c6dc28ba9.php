<?php /* PFA Template Cache File. Create Time:2015-06-06 01:22:51 */ ?>

var member_id = '<?php echo(ACookie::get("member_id")); ?>';
var member_userid = '<?php echo(ACookie::get("m_userid")); ?>';
var member_username = '<?php echo(ACookie::get("m_username")); ?>';
var member_info = '<?php echo(L("HELLO")); ?>';

<?php if(ACookie::get('member_id')) :  ?> member_info += ', '+member_username+' | <a href="<?php echo(Url::U("member/index")); ?>"><?php echo(L("MEMBER_CENTER")); ?></a> | <a href="<?php echo(Url::U("member_favorite/list_favorite")); ?>"><?php echo(L("FAVORITE")); ?></a> | <a href="<?php echo(Url::U("member_notify/list_notify")); ?>"><?php echo(L("NOTIFY")); ?> <?php if(0 < $_MNC) :  ?><span class="fw_b fc_wht bg_b p_0_2 br_5"><?php echo($_MNC); ?></span><?php endif; ?></a>  | <a href="<?php echo(Url::U("member/logout_do")); ?>"><?php echo(L("LOGOUT")); ?></a>';
<?php else : ?> member_info += ', <?php echo(L("GUEST")); ?> | <a href="<?php echo(Url::U("member/login")); ?>"><?php echo(L("LOGIN")); ?></a> | <a href="<?php echo(Url::U("member/register")); ?>"><?php echo(L("REGISTER")); ?></a>';
<?php endif; ?> $('#uwa_member').html(member_info);
