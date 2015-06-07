<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@FLINK-} - {-:$_SITE['name']-}</title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}home/css/c.css" />
<meta name="keywords" content="{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_SITE['description']-}" />
</head>

<body>
{-include:header-}
<div class="position m w_960"><span>{-:@POSITION-}</span>{-include:clip/current_position-}</div>
<div class="h_10 o_h"></div>
<div class="m w_960">
	<dl class="adl">
		<dt><strong>{-:@FLINK-}</strong><span><a href="{-url:home@flink/apply_flink-}">{-:@APPLY_FLINK-}</a></span></dt>
		<dd><ul class="aul_4">
		{-foreach:$_L,$f-}
			<li class="fs_14 part">
				<strong class="bg_gry_d fc_wht p_2_5 br_3">{-:$f['fc_name']-}</strong>
				{-if:1==$f['f_show_type']-}
					<a class="fc_b fs_13" href="{-:$f['f_site_url']-}"><img src="{-:$f['f_site_logo']-}" /></a>
				{-else:-}
					<a class="fc_b fs_13" href="{-:$f['f_site_url']-}">{-:$f['f_site_name']-}</a>
				{-:/if-}
				<span class="br_3 br_gry bg_gry_l fs_11 p_0_2 fc_gry">{-:$f['f_site_url']-}</span>
				<span class="p_2_5 fc_gry">{-:$f['f_site_description']|AString::utf8_substr~@me,36-}</span>
			</li>
		{-:/foreach-}
		</ul>
		{-include:clip/paging-}
		</dd>
	</dl>
</div>
{-include:footer-}
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script>
document.write('<script src="{-url:member@common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:home@common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}home/js/c.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>