<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@MEMBER_CENTER-} - {-:$_SITE['name']-}</title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/m.css" />
<meta name="keywords" content="{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_SITE['description']-}" />
</head>

<body>
{-include:../header-}
<div class="m w_960">
	<div class="w_190 f_l">
{-include:../sidebar-}
	</div><!--/.w_190-->
	<div class="w_10 h_10 o_h f_l">&nbsp;</div>
	<div class="w_760 f_l">
		<div class="adiv p_20">
			<div>
				<span class="fs_16 fw_b">{-:$_MI['m_username']-}</span> <span class="fs_12 fc_gry">[{-:$_MI['m_userid']-}]</span>
				{-:@STATUS-}: {-if:2==$_MI['m_status']-}<span class="fs_12 fc_wht p_0_2 bg_r">{-:@FORBIDDEN-}</span>{-elseif:1==$_MI['m_status']-}<span class="fs_12 fc_wht p_0_2 bg_g">{-:@PASSED-}</span>{-elseif:0==$_MI['m_status']-}<span class="fs_12 fc_wht p_0_2 bg_gry">{-:@NOT_PASSED-}</span>{-:/if-}
			</div>
			<div class="member_info">
				{-:@MEMBER_TYPE-}: <span class="fw_b">{-:$_MI['mm_name']-}</span>
				{-:@MEMBER_LEVEL-}: <span class="fw_b">{-:$_MI['ml_name']-}</span>
				{-:@EXPERIENCE-}: <span class="fw_b">{-:$_MI['m_experience']-}</span>
				{-:@POINTS-}: <span class="fw_b">{-:$_MI['m_points']-}</span>
			</div><!--/.member_info-->
		</div>
		<div class="h_10 o_h"></div>
		<div class="w_500 f_l">
			<dl class="adl">
				<dt><strong>{-:@MY_ARCHIVE-}</strong></dt>
				<dd>
					<ul class="aul">
					{-foreach:$_AL,$item-}
						<li>[<a class="fc_gry_d" target="_blank" href="{-:$item['ac_url']-}">{-:$item['ac_name']-}</a>] <a class="fc_gry_d" target="_blank" href="{-url:home@archive/show_archive?archive_id={$item['archive_id']}-}">{-:$item['a_title']-}</a> <span class="fc_gry">{-:$item['a_edit_time']|date~'Y-m-d',@me-}</span></li>
					{-:/foreach-}
					</ul>
				</dd>
			</dl>
		</div><!--/.w_500-->
		<div class="w_10 h_10 o_h f_l">&nbsp;</div>
		<div class="w_250 f_l">
			<dl class="adl">
				<dt><strong>{-:@CREDIT-}</strong></dt>
				<dd>
					<ul>
					{-foreach:$_MCTL,$ct-}
						<li>{-:$ct['mct_name']-}: <span class="fw_b fc_g">{-:$_MI[$ct['mct_alias']]-}</span> {-:$ct['mct_unit']-}</li>
					{-:/foreach-}
					</ul>
				</dd>
			</dl>
		</div><!--/.w_250-->
	</div><!--/.w_760-->
	<div class="c"></div>
</div>
{-include:../footer-}
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script>
document.write('<script src="{-url:common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}member/js/c.js"></script>
<script src="{-:*__THEME__-}member/js/m.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>