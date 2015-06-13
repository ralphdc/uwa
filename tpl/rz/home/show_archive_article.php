<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:$_V['a_title']-} - {-:$_V['ac_name']-} - {-:$_SITE['name']-}</title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}home/css/rz.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}home/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}home/js/snsshare/snsshare.css" />
<meta name="keywords" content="{-:$_V['a_keywords']-},{-:$_V['ac_keywords']-},{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_V['a_description']-}" />
</head>

<body>
{-include:header-}
<div class="position m w_960"><span>{-:@POSITION-}</span>{-include:clip/current_position-}</div>
<div class="h_10 o_h"></div>
<div class="center">
	<div class="main">
        <div class="crumbs"><a href="#">首页</a> > 最新资讯</div>
        
        <div class="list">
        	<h2>最新资讯</h2>
            <div class="dynamic_box">
                <div class="f_left grid2">
                    <div class="dynamic_nav">
                        <ul>
                        	<li><a href="#"><strong>热烈祝贺网站成功升级！</strong>网站更新了更新了更新了更新了更新了更新了更新了更新了...<em>[May 20, 2014 ]</em></li>
                            <li><a href="#"><strong>热烈祝贺网站成功升级！</strong>网站更新了更新了更新了更新了更新了更新了更新了更新了...<em>[May 20, 2014 ]</em></li>
                        </ul>
                        <a href="#">浏览更多动态</a>
                    </div>
                </div>
                <div class="f_right grid8">
                    <div class="info">
                        <h1>EPE 珍珠棉凭其超强性能 稳享包装行业专宠</h1>
                        <img src="images/image6.jpg" />                        
                        <p>EPE 珍珠棉是一种新型环保的包装材料。它由低密度聚乙烯脂经物理发泡产生无数的独立气泡构成。该产品克服了普通发泡胶易碎、变形、恢复性差的缺点，并具有良好的缓冲防震性能，其产品弹性良好，质地柔软，防潮防水，抗静电，隔音、保温、可塑性能佳、韧性强、可循环再造、环保、抗撞力强，亦具有很好的抗化学性能。是传统包装材料的理想替代品。</p>
                        <p>当前在珠江三角洲地区，EPE珍珠棉发泡材料生产已较为发达，该材料在各行各业中的使用已较为普遍，我司从事生产珍珠棉行业多年，其一直秉承品质第一、客户第一的经营理念，其产品优越性能也越来越被业内认识和接受，因此EPE珍珠棉的使用将被不断扩大和创新，它正以它独特的优越性能开辟着多功能环保循环再造的全新包装时代!</p>
                        <p>由于 EPE 珍珠棉环保且可反复回收利用，被业内称为永不衰退的材料。随着产品不断的开发应用， EPE 珍珠棉在包装和填充用料方面得到了越来越广泛的应用。</p>
                        <p>EPE珍珠棉可应用于电子电器、仪器仪表、电脑、音响、医疗器械、工控机箱、灯饰、工艺品、玻璃、陶瓷、家电、喷涂、家俱、酒类及礼品包装、五金制品、玩具、瓜果、皮鞋的内包装、日用品等多种产品的包装。在加入防静电剂和阻燃剂后，更能彰显其卓越的性能，并且能够根据客户要求将其制成各种型状，使包装更加多样化和美观，这更加显示了EPE珍珠棉的优越性和多样性。</p>
                        <p>佳昊实业有限公司承诺：带领全体员工贯彻执行本质量手册、实现本公司质量方针和质量目标，确保向顾客提供最佳产品。公司把信誉、产品质量、服务质量、交货及时和顾客满意，放在一切工作的首位，一切工作都是为了满足顾客要求，确保顾客满意而进行，以优质的产品服务满足顾客的合理要求和期望，持续改进，成为顾客忠实的伙伴。</p>
                        <div class="info_page">
                        	<a href="#">上一则</a> <a href="#">下一侧</a>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        	
    </div>
</div>
<div class="m w_960">
	<div class="w_650 f_l">
		<div>
			<uwa:ad id="2">
		</div>
		<div class="h_10 o_h"></div>
		<div class="adiv p_20">
			<div class="main_title lh_40"><h2 class="fs_18 fw_b">{-:$_V['a_title']-}</h2></div><!--/.main_title-->
			<div class="main_info fc_gry_d">
				<span><strong class="fc_gry">{-:@CHANNEL-}</strong><a href="{-:$_V['ac_url']-}">{-:$_V['ac_name']-}</a></span>
				{-if:$_V['a_a_source']-}<span><strong class="fc_gry">{-:@SOURCE-}</strong>{-:$_V['a_a_source']-}</span>{-:/if-}
				{-if:$_V['a_a_author']-}<span><strong class="fc_gry">{-:@AUTHOR-}</strong>{-:$_V['a_a_author']-}</span>{-:/if-}
				<span><strong class="fc_gry">{-:@TIME-}</strong>{-:$_V['a_edit_time']|date~'Y-m-d',@me-}</span>
				<span><strong class="fc_gry">{-:@VIEW-}</strong>
					<script src="{-url:home@archive/get_count?type=view&archive_id={$_V['archive_id']}-}"></script>
				</span>
			</div><!--/.main_info-->
			{-if:$_V['a_keywords'] or $_V['a_description']-}<div class="main_abstract fc_gry fs_12 br_5">
				{-if:$_V['a_keywords']-}<p><strong class="fc_gry_d">{-:@KEYWORDS-}</strong> {-:$_V['a_keywords']|keywords_to_tag~@me-}</p>{-:/if-}
				{-if:$_V['a_description']-}<p><strong class="fc_gry_d">{-:@ABSTRACT-}</strong> {-:$_V['a_description']-}</p>{-:/if-}
			</div><!--/.main_abstract-->{-:/if-}
		{-if:!empty($_V['msg_err'])-}
			<div class="msg_err">
				{-:$_V['msg_err']-}
			</div>
		{-else:-}
			<div class="main_content">
				<div style="float:right;margin:0 0 10px 10px;">
					<uwa:ad id="3">
				</div>
				{-:$_V['a_a_content']|garble_string~@me-}
			</div><!--/.main_content-->
			{-include:clip/paging-}
		{-:/if-}
			<div class="main_interaction ta_c">
				<span id="a_support" class="a btn"><span class="btn_in_love"><span id="a_support_count"><script src="{-url:home@archive/get_count?type=support&archive_id={$_V['archive_id']}-}"></script></span><span id="a_support_tip">{-:@SUPPORT-}</span></span></span><!--/#a_support-->
				<span id="a_oppose" class="a btn"><span class="btn_in_love"><span id="a_oppose_tip">{-:@OPPOSE-}</span><span id="a_oppose_count"><script src="{-url:home@archive/get_count?type=oppose&archive_id={$_V['archive_id']}-}"></script></span></span></span><!--/#a_oppose-->
				{-if:$_G['interaction']['report_switch']-}<span class="a btn"><span class="btn_in_times"><a href="{-url:home@report/add_report?r_item_type=archive&r_item_id={$_V['archive_id']}-}">{-:@REPORT-}</a></span></span>{-:/if-}
				<span class="a btn"><span class="btn_in_plus"><a href="{-url:member@member_favorite/add_favorite_do?archive_id={$_V['archive_id']}-}">{-:@FAVORITE-}</a></span></span>
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
			{-if:!empty($_V['a_related'])-}<dl class="main_related">
				<dt><strong>{-:@RELATED_CONTENT-}</strong></dt>
				<dd><ul class="aul">
				<uwa:a_list aid="$_V.a_related" row="5">
					<li><span class="fc_gry">{-:$item['ac_name']-}</span> <a class="fc_gry_d" href="{-:$item['a_url']-}">{-:$item['a_title']-}</a></li>
				</uwa:a_list>
				</ul></dd>
			</dl>{-:/if-}
			<div class="main_extra">
				<ul class="main_context f_l">
					<li>{-:@PREV_ARCHIVE-}: {-if:!empty($_V['a_prev'])-}<a href="{-:$_V['a_prev']['a_url']-}">{-:$_V['a_prev']['a_title']-}</a>{-else:-}{-:@NONE-}{-:/if-}</li>
					<li>{-:@NEXT_ARCHIVE-}: {-if:!empty($_V['a_next'])-}<a href="{-:$_V['a_next']['a_url']-}">{-:$_V['a_next']['a_title']-}</a>{-else:-}{-:@NONE-}{-:/if-}</li>
				</ul>
				<div class="c"></div>
			</div><!--/.main_extra-->
		</div><!--/.adiv-->
		<div class="h_10 o_h"></div>
		<iframe id="uwa_review" src="{-url:home@archive_review/list_review?type=clip&archive_id={$_V['archive_id']}-}" width="100%" height="auto" scrolling="no" frameborder="0"></iframe>
	</div><!--/.w_650-->
	<div class="w_10 h_10 o_h f_l">&nbsp;</div>
	<div class="w_300 f_l">
		<ul class="aul_1">
			{-foreach:$_V['ac_sibling'],$k,$item-}
			<li class="a{-if:$AC_ID == $item['archive_channel_id']-} on{-:/if-}"><a href="{-:$item['ac_url']-}">{-:$item['ac_name']-}</a></li>
			{-:/foreach-}
		</ul>
		<div class="h_10 o_h"></div>
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
/*s: support */
var url_support = '{-url:home@archive/get_count?type=do_support&archive_id={$_V['archive_id']}-}';
$('#a_support').click(function() {
	$.getJSON(url_support, function(data) {
		if(data.data == 1) {
			$('#a_support_count').text(parseInt($('#a_support_count').text()) + 1);
		}
		$('#a_support,#a_oppose').removeClass('a').unbind();
		$('#a_support_tip').text(data.info);
	});
});
/*e: support */
/*s: oppose */
var url_oppose = '{-url:home@archive/get_count?type=do_oppose&archive_id={$_V['archive_id']}-}';
$('#a_oppose').click(function() {
	$.getJSON(url_oppose, function(data) {
		if(data.data == 1) {
			$('#a_oppose_count').text(parseInt($('#a_oppose_count').text()) + 1);
		}
		$('#a_support,#a_oppose').removeClass('a').unbind();
		$('#a_oppose_tip').text(data.info);
	});
});
/*e: oppose */

document.write('<script src="{-url:member@common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:home@common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}home/js/c.js"></script>
<script src="{-:*__THEME__-}home/js/snsshare/snsshare.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>