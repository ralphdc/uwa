<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:$_V['t_name']-} - {-:@TAG-} - {-:$_SITE['name']-}</title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}home/css/c.css" />
<meta name="keywords" content="{-:$_V['t_keywords']-}" />
<meta name="description" content="{-:$_V['t_description']-}" />
</head>

<body>
{-include:header-}
<div class="position m w_960"><span>{-:@POSITION-}</span>{-include:clip/current_position-}</div>
<div class="h_10 o_h"></div>
<div class="m w_960">
	<div class="w_650 f_l">
		<div>
			<uwa:ad id="2">
		</div>
		<div class="h_10 o_h"></div>
		<div class="adiv p_20">
			<div class="main_title lh_40"><h2 class="fs_18 fw_b">{-:@TAG-} - {-:$_V['t_name']-}</h2></div><!--/.main_title-->
			<div class="main_info fc_gry_d">
				<span><strong class="fc_gry">{-:@ARCHIVE_COUNT-}</strong>{-:$_V['t_archive_count']-}</span>
				<span><strong class="fc_gry">{-:@VIEW_COUNT-}</strong>
					<script src="{-url:home@tag/get_count?type=view&tag_id={$_V['tag_id']}-}"></script></span>
				<span><strong class="fc_gry">{-:@ADD_TIME-}</strong>{-:$_V['t_add_time']|date~'Y-m-d',@me-}</span>
				<span><strong class="fc_gry">{-:@UPDATE_TIME-}</strong>{-:$_V['t_update_time']|date~'Y-m-d',@me-}</span>
			</div><!--/.main_info-->
			<ul class="aul_2">
			{-foreach:$_L,$k,$item-}
			{-if:$k < 1-}
				<li class="pic">
					<p class="a_thumb"><a href="{-:$item['a_url']-}"><img class="a" src="{-:$item['a_thumb']-}" /></a></p>
					<h3><a class="fs_14" href="{-:$item['a_url']-}">{-:$item['a_title']-}</a> </h3>
					<p class="a_publish_date ta_r fc_gry fs_12 fw_n">{-:@PUBLISH_DATE-}: {-:$item['a_edit_time']|date~'m-d',@me-}</p>
					<p class="a_info fs_12">{-:@CHANNEL-}: <a href="{-:$item['ac_url']-}">{-:$item['ac_name']-}</a>
					{-:@VIEW-}: <span class="fc_gry">{-:$item['a_view_count']-}</span>
					<p class="a_description fc_gry">{-:$item['a_description']-}</p>
				</li>
			{-else:-}
				<li class="fs_14{-if:4 == $k%5-} part{-:/if-}">
					[<a href="{-:$item['ac_url']-}">{-:$item['ac_name']-}</a>] <a class="fc_gry_d" href="{-:$item['a_url']-}">{-:$item['a_title']|AString::utf8_substr~@me,60-}</a>
					<span class="fc_gry">{-:$item['a_edit_time']|date~'m-d',@me-}</span>
				</li>
			{-:/if-}
			{-:/foreach-}
			</ul>
			{-include:clip/paging-}
		</div><!--/.adiv-->
	</div><!--/.w_650-->
	<div class="w_10 h_10 o_h f_l">&nbsp;</div>
	<div class="w_300 f_l">
		<dl class="adl">
			<dt><strong>{-:@COMMEND-}</strong></dt>
			<dd><ul class="aul">
			<uwa:a_list flag="c" row="10">
				<li><a class="fc_gry_d" href="{-:$item['a_url']-}">{-:$item['a_title']-}</a></li>
			</uwa:a_list>
			</ul></dd>
		</dl>
		<div class="h_10 o_h"></div>
		<dl class="adl">
			<dt><strong>{-:@PICTURE_NEWS-}</strong></dt>
			<dd><ul class="aul">
			<uwa:a_list flag="p" row="10">
			{-if:0==$k-}
				<li class="pic">
					<a class="fc_gry_d" href="{-:$item['a_url']-}">
					<img class="a" src="{-:$item['a_thumb']-}" alt="{-:$item['a_title']-}" />
					<span>{-:$item['a_title']-}</span>
					<p class="fc_gry fs_12">{-:$item['a_description']-}</p>
					</a>
				</li>
			{-else:-}
				<li><a class="fc_gry_d" href="{-:$item['a_url']-}">{-:$item['a_title']-}</a></li>
			{-:/if-}
			</uwa:a_list>
			</ul></dd>
		</dl>
		<div class="h_10 o_h"></div>
		<dl class="adl">
			<dt><strong>{-:@HOT-}</strong></dt>
			<dd><ul class="aul_hot">
			<uwa:a_list orderby="a_view_count" order="desc" row="10">
				<li><a class="fc_gry_d" href="{-:$item['a_url']-}">{-:$item['a_title']-}</a></li>
			</uwa:a_list>
			</ul></dd>
		</dl>
		<div class="h_10 o_h"></div>
		<div>
			<uwa:ad id="1">
		</div>
		<div class="h_10 o_h"></div>
	</div><!--/.w_300-->
	<div class="c"></div>
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