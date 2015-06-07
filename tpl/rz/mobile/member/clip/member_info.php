
var member_id = '{-:+member_id-}';
var member_userid = '{-:+m_userid-}';
var member_username = '{-:+m_username-}';
var member_info = '{-:@HELLO-}';

{-if:ACookie::get('member_id')-}
member_info += ', '+member_username+' | <a href="{-url:member/index-}">{-:@MEMBER_CENTER-}</a> | <a href="{-url:member/logout_do-}">{-:@LOGOUT-}</a>';
{-else:-}
member_info += ', {-:@GUEST-} | <a href="{-url:member/login-}">{-:@LOGIN-}</a> | <a href="{-url:member/register-}">{-:@REGISTER-}</a>';
{-:/if-}
$('#uwa_member').html(member_info);
