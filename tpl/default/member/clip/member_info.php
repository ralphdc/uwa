
var member_id = '{-:+member_id-}';
var member_userid = '{-:+m_userid-}';
var member_username = '{-:+m_username-}';
var member_info = '{-:@HELLO-}';

{-if:ACookie::get('member_id')-}
member_info += ', '+member_username+' | <a href="{-url:member/index-}">{-:@MEMBER_CENTER-}</a> | <a href="{-url:member_favorite/list_favorite-}">{-:@FAVORITE-}</a> | <a href="{-url:member_notify/list_notify-}">{-:@NOTIFY-} {-if:0 < $_MNC-}<span class="fw_b fc_wht bg_b p_0_2 br_5">{-:$_MNC-}</span>{-:/if-}</a>  | <a href="{-url:member/logout_do-}">{-:@LOGOUT-}</a>';
{-else:-}
member_info += ', {-:@GUEST-} | <a href="{-url:member/login-}">{-:@LOGIN-}</a> | <a href="{-url:member/register-}">{-:@REGISTER-}</a>';
{-:/if-}
$('#uwa_member').html(member_info);
