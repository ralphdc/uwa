<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:$_V['sp_title']-} - {-:$_SITE['name']-}</title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}home/css/c.css" />
<meta name="keywords" content="{-:$_V['sp_keywords']-},{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_V['sp_description']-}" />
</head>

<body>
{-include:header-}
<div class="position m w_960"><span>{-:@POSITION-}</span>{-include:clip/current_position-}</div>
<div class="h_10 o_h"></div>
<div id="main" class="m w_960">
	<div class="w_190 f_l">
		<ul class="aul_1">
		<uwa:sp_list row="10">
			<li class="a{-if:$_V['single_page_id'] == $item['single_page_id']-} on{-:/if-}"><a href="{-:$item['sp_url']-}">{-:$item['sp_title']-}</a></li>
		</uwa:sp_list>
		</ul>
		<div class="hr_l"></div>
	</div><!--/.w_190-->
	<div class="w_10 h_10 o_h f_l">&nbsp;</div>
	<div class="w_760 f_l">
		<div class="adiv p_20">
			<div class="main_title"><h2 class="fs_18 fw_b">{-:$_V['sp_title']-}</h2></div><!--/.main_title-->
			<div class="main_info fc_gry">
				<span><strong class="fc_gry_d">{-:@TIME-}</strong>{-:$_V['sp_edit_time']|date~'Y-m-d',@me-}</span>
				{-if:$_V['sp_keywords']-}<span><strong class="fc_gry_d">{-:@KEYWORDS-}</strong>{-:$_V['sp_keywords']-}</span>{-:/if-}
			</div><!--/.main_info-->
			{-if:$_V['sp_description']-}<div class="main_abstract fc_gry fs_12 br_5">
				<p><strong class="fc_gry_d">{-:@ABSTRACT-}</strong> {-:$_V['sp_description']-}</p>
			</div><!--/.main_abstract-->{-:/if-}
			<div class="main_content">
				{-:$_V['sp_content']-}
			</div><!--/.main_content-->
		</div>
	</div><!--/.w_760-->
	<div class="c"></div>
</div><!--/#main-->
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