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
                        {-foreach:$_L,$k,$item-}
        			{-if:$k < 3-}
        				<li>
        				    <a href="{-:$item['a_url']-}&archive_chennel_id={-:$AC_ID-}"><strong>{-:$item['a_title']-}</strong>{-:$item['a_description']-}...<em>[{-:@PUBLISH_DATE-}: {-:$item['a_edit_time']|date~'m-d',@me-}]</em>
        				</li>
        			{-else:-}
        				<li>
        					[<a href="{-:$item['ac_url']-}&archive_chennel_id={-:$AC_ID-}">{-:$item['ac_name']-}</a>] <a class="fc_gry_d" href="{-:$item['a_url']-}&archive_chennel_id={-:$AC_ID-}">{-:$item['a_title']|AString::utf8_substr~@me,60-}</a>
        					<span class="fc_gry">{-:$item['a_edit_time']|date~'m-d',@me-}</span>
        					<a class="more" href="{-:$item['a_url']-}&archive_chennel_id={-:$AC_ID-}">更多详情 >></a>
        				</li>
        			{-:/if-}
        			{-:/foreach-}
        			
                        </ul>
                        <a href="#">浏览更多动态</a>
                    </div>
                </div>
                <div class="f_right grid8 product_list">
                    <div class="info">
                        <h1 class="fs_18 fw_b">{-:$_V['a_title']-}</h1>
                        <img src="{-:$_V['a_thumb']-}" />
                        {-if:!empty($_V['msg_err'])-}
			             <div class="msg_err">
				        {-:$_V['msg_err']-}
			             </div>
		                  {-else:-}
            			<div class="main_content">
            				{-:$_V['a_a_content']|garble_string~@me-}
            			</div><!--/.main_content-->
			             {-include:clip/paging-}
		                  {-:/if-}
                       <div class="main_extra">
        				<ul class="main_context f_l">
        					<li>{-:@PREV_ARCHIVE-}: {-if:!empty($_V['a_prev'])-}<a href="{-:$_V['a_prev']['a_url']-}">{-:$_V['a_prev']['a_title']-}</a>{-else:-}{-:@NONE-}{-:/if-}</li>
        					<li>{-:@NEXT_ARCHIVE-}: {-if:!empty($_V['a_next'])-}<a href="{-:$_V['a_next']['a_url']-}">{-:$_V['a_next']['a_title']-}</a>{-else:-}{-:@NONE-}{-:/if-}</li>
        				</ul>
				    <div class="c"></div>
			         </div><!--/.main_extra-->
                    </div>
                    
                </div>
                <div class="clear"></div>
            </div>
        </div>
        	
    </div>
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