<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:$_V['v_name']-} - {-:@VOTE_RESULT-} - {-:$_SITE['name']-}</title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}home/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}home/css/v.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}home/js/snsshare/snsshare.css" />
<meta name="keywords" content="{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_V['v_name']-}" />
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
			<div class="main_title lh_40"><h2 class="fs_18 fw_b">{-:$_V['v_name']-} - {-:@VOTE_RESULT-}</h2></div><!--/.main_title-->
			<div class="main_info fc_gry_d">
				<span><strong class="fc_gry">{-:@VOTE_VALIDITY_PERIOD-}</strong>
				{-if:0 == $_V['v_time_limit']-}
					{-:@NOT_LIMIT-}
				{-elseif:1 == $_V['v_time_limit']-}
					{-:$_V['v_start_time']|date~'Y-m-d',@me-} ~ {-:$_V['v_end_time']|date~'Y-m-d',@me-}
				{-:/if-}
				</span>
				<span><strong class="fc_gry">{-:@TOTAL_VOTES-}</strong>{-:$_V['v_votes']-}</span>
			</div><!--/.main_info-->
			{-if:!empty($_V['v_description'])-}<div class="main_abstract fc_gry fs_12 br_5">
				{-:$_V['v_description']-}
			</div><!--/.main_abstract-->{-:/if-}
			<div class="main_content">
				<ul class="aul_vote">
				{-foreach:$_V['v_option_set'],$k,$vo-}
					<li>
						<div class="vote_description">{-:$vo['description']-} ({-:$vo['votes']-} {-:@VOTES-} | {-:$vo['percentage']-}%)</div>
						<div class="vote_votes_bar_wppr"><div style="width:{-:$vo['percentage']-}%;" class="vote_votes_bar"></div></div>
					</li>
				{-:/foreach-}
				</ul>
			</div><!--/.main_content-->
			<div class="main_interaction ta_r">
				<span class="a btn"><span class="btn_in_arrow" id="share" onclick="$('#snsshare').toggle()">{-:@SHARE-}</span></span>
			</div><!--/.main_interaction-->
			<div id="snsshare" style="display:none" class="ta_r">
				{-:@SHARE_TO-}:
				<a title="{-:@SHARE_TO_TQQ-}" class="snsshare ss_tqq"></a>
				<a title="{-:@SHARE_TO_QZONE-}" class="snsshare ss_qzone"></a>
				<a title="{-:@SHARE_TO_TSINA-}" class="snsshare ss_tsina"></a>
				<a title="{-:@SHARE_TO_RENREN-}" class="snsshare ss_renren"></a>
				<a title="{-:@SHARE_TO_KAIXIN-}" class="snsshare ss_kaixin"></a>
				<a title="{-:@SHARE_TO_DOUBAN-}" class="snsshare ss_douban"></a>
			</div>
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
<script src="{-:*__THEME__-}home/js/snsshare/snsshare.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>