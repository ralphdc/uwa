<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:$_V['ac_name']-} - {-:$_SITE['name']-}</title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}home/css/c.css" />
<meta name="keywords" content="{-:$_V['ac_keywords']-},{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_V['ac_description']-}" />
</head>

<body>
{-include:header-}
<div class="position m w_960"><span>{-:@POSITION-}</span>{-include:clip/current_position-}</div>
<div class="h_10 o_h"></div>
<div class="m w_960">
	<div class="w_650 f_l">
		<div class="w_300 f_l">
			<div id="slide">
			<object type="application/x-shockwave-flash" data="{-:*__PUBLIC__-}flash/slide.swf?xml=
<data>
	<channel>
	<uwa:a_list row="5" flag="s">
		<item>
			<link>{-:$item['a_url']|str_replace~'&','^',@me-}</link>
			<image>{-:$item['a_thumb']-}</image>
			<title>{-:$item['a_title']-}</title>
		</item>
	</uwa:a_list>
	</channel>
	<config>
		<autoPlayTime>5</autoPlayTime>
		<titleBgColor>0x000000</titleBgColor>
		<titleTextColor>0xffffff</titleTextColor>
		<titleBgAlpha>0.4</titleBgAlpha>
		<btnSetMargin>5 5 auto auto</btnSetMargin>
		<btnAlpha>.5</btnAlpha>
		<btnTextColor>0xffffff</btnTextColor>
		<btnDefaultColor>0x000000</btnDefaultColor>
		<btnHoverColor>0x0066ff</btnHoverColor>
		<btnFocusColor>0x0066ff</btnFocusColor>
		<changImageMode>hover</changImageMode>
		<transform>breatheBlur</transform>
		<isShowAbout>false</isShowAbout>
	</config>
</data>"
width="300" height="180" id="archive_slide" wmode="transparent">
<param name="wmode" value="transparent">
<param name="movie" value="{-:*__PUBLIC__-}flash/slide.swf?xml=
<data>
	<channel>
	<uwa:a_list row="5" flag="s">
		<item>
			<link>{-:$item['a_url']|str_replace~'&','^',@me-}</link>
			<image>{-:$item['a_thumb']-}</image>
			<title>{-:$item['a_title']-}</title>
		</item>
	</uwa:a_list>
	</channel>
	<config>
		<autoPlayTime>5</autoPlayTime>
		<titleBgColor>0x000000</titleBgColor>
		<titleTextColor>0xffffff</titleTextColor>
		<titleBgAlpha>0.4</titleBgAlpha>
		<btnSetMargin>5 5 auto auto</btnSetMargin>
		<btnAlpha>.5</btnAlpha>
		<btnTextColor>0xffffff</btnTextColor>
		<btnDefaultColor>0x000000</btnDefaultColor>
		<btnHoverColor>0x0066ff</btnHoverColor>
		<btnFocusColor>0x0066ff</btnFocusColor>
		<changImageMode>hover</changImageMode>
		<transform>breatheBlur</transform>
		<isShowAbout>false</isShowAbout>
	</config>
</data>" />
			</object>
			</div><!--/#slide-->
			<div class="h_10 o_h"></div>
			<dl class="adl">
				<dt><strong>{-:@SPECIAL_COMMEND-}</strong></dt>
				<dd>
				<ul class="aul">
				<uwa:a_list flag="a" row="3">
					<li>[<a class="fc_gry_d" href="{-:$item['ac_url']-}">{-:$item['ac_name']-}</a>] <a class="fc_gry_d" href="{-:$item['a_url']-}">{-:$item['a_title']-}</a></li>
				</uwa:a_list>
				</ul>
				</dd>
			</dl>
		</div><!--/.w_300-->
		<div class="w_10 h_10 o_h f_l">&nbsp;</div>
		<div class="w_340 f_l">
			<div class="adiv">
				<div id="big_news">
				<uwa:a_list flag="h" row="1" titlelen="40">
					<h2 class="ta_c lh_40"><a class="fs_16 fw_b fc_r lh_40" href="{-:$item['a_url']-}">{-:$item['a_title']-}</a></h2>
					<p><a class="fs_12 fc_gry lh_20 td_n" href="{-:$item['a_url']-}">{-:$item['a_description']|AString::utf8_substr~@me,80,1-}</a></p>
				</uwa:a_list>
				</div><!--/#big_news-->
				<ul class="fs_14 aul p_10 bg_wht">
				<uwa:a_list orderby="a_edit_time" order="desc" row="7">
					<li>[<a class="fc_gry_d" href="{-:$item['ac_url']-}">{-:$item['ac_name']-}</a>] <a class="fc_gry_d" href="{-:$item['a_url']-}">{-:$item['a_title']-}</a></li>
				</uwa:a_list>
				</ul>
			</div>
		</div><!--/.w_340-->
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
	</div><!--/.w_300-->
	<div class="c"></div>
</div>
<div class="h_10 o_h"></div>
<div class="m w_960">
	<div class="w_650 f_l">
		<dl class="adl">
		<dt><strong>{-:@PICTURE_NEWS-}</strong><span><b id="prev" class="a"></b><b id="next" class="a"></b></span></dt>
		<dd>
			<div id="marquee"><ul class="aul_marquee">
				<uwa:a_list flag='p' row="8">
				<li>
					<a class="fc_gry_d" href="{-:$item['a_url']-}">
					<img class="a" src="{-:$item['a_thumb']-}" />
					<span>{-:$item['a_title']|AString::utf8_substr~@me,36-}</span></a>
				</li>
				</uwa:a_list>
			</ul></div>
		</dd>
		</dl><!--/.hot_list-->
	</div><!--/.w_650-->
	<div class="w_10 h_10 o_h f_l">&nbsp;</div>
	<div class="w_300 f_l">
	<uwa:ad id="1">
	</div><!--/.w_300-->
	<div class="c"></div>
</div>
<div class="h_10 o_h"></div>
<div class="m w_960">
	<div class="w_650 f_l">
		<uwa:ac_list>
		<div class="f_l w_320">
			<dl class="adl">
				<dt><strong>{-:$channel['ac_name']-}</strong><span><a href="{-:$channel['ac_url']-}">{-:@MORE-}</a></span></dt>
				<dd>
				<ul class="aul">
					<uwa:a_list issub='yes' row="5">
					<li><a href="{-:$item['a_url']-}">{-:$item['a_title']-}</a></li>
					</uwa:a_list>
				</ul>
				</dd>
			</dl>
		</div>
		{-if:0==$key%2-}<div class="w_10 h_10 o_h f_l">&nbsp;</div>{-else:-}<div class="c"></div><div class="h_10 o_h"></div>{-:/if-}
		</uwa:ac_list>
		<div class="c"></div><div class="h_10 o_h"></div>
		<div>
			<uwa:ad id="2">
		</div>
	</div><!--/.w_650-->
	<div class="w_10 h_10 o_h f_l">&nbsp;</div>
	<div class="w_300 f_l">
		<dl class="atab">
		<dt><strong>{-:@HOT_1-}</strong><strong>{-:@HOT_7-}</strong><strong>{-:@HOT_30-}</strong></dt>
		<dd class="p_10 bg_wht">
			<ul class="tabCntnt aul_hot">
				<uwa:a_list orderby="a_view_count" days="1" order="desc" row="10">
				<li><a class="fc_gry_d" href="{-:$item['a_url']-}">{-:$item['a_title']-}</a></li>
				</uwa:a_list>
			</ul>
			<ul class="tabCntnt aul_hot">
				<uwa:a_list orderby="a_view_count" days="7" order="desc" row="10">
				<li><a class="fc_gry_d" href="{-:$item['a_url']-}">{-:$item['a_title']-}</a></li>
				</uwa:a_list>
			</ul>
			<ul class="tabCntnt aul_hot">
				<uwa:a_list orderby="a_view_count" days="30" order="desc" row="10">
				<li><a class="fc_gry_d" href="{-:$item['a_url']-}">{-:$item['a_title']-}</a></li>
				</uwa:a_list>
			</ul>
		</dd>
		</dl><!--/.atab-->
	</div><!--/.w_300-->
	<div class="c"></div>
</div>
{-include:footer-}
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script>
document.write('<script src="{-url:member@common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:home@common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}home/js/jcarousellite.js"></script>
<script src="{-:*__THEME__-}home/js/c.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>