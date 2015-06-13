<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:$_V['ac_name']-} - {-:$_SITE['name']-}</title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}home/css/rz.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}home/css/c.css" />
<meta name="keywords" content="{-:$_V['ac_keywords']-},{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_V['ac_description']-}" />
</head>

<body>
{-include:header-}
<div class="banner dynamic">
	<uwa:ad id="17">
</div>

<div class="center">
	<div class="main">
        <div class="crumbs"><a href="#">首页</a> > 最新资讯</div>
        
        <div class="list">
        	<h2>最新资讯</h2>
            <div class="dynamic_box">
                <ol>
                
                	{-foreach:$_L,$k,$item-}
        			{-if:$k < 3-}
        				<li>
        					<p><a href="{-:$item['a_url']-}"><img class="a" src="{-:$item['a_thumb']-}" /></a></p>
        					<h3><a href="{-:$item['a_url']-}">{-:$item['a_title']-}</a> </h3>
        					<p class="a_publish_date ta_r fc_gry fs_12 fw_n">{-:@PUBLISH_DATE-}: {-:$item['a_edit_time']|date~'m-d',@me-}</p>
        					<p>{-:@CHANNEL-}: <a href="{-:$item['ac_url']-}">{-:$item['ac_name']-}</a>
        					{-:@VIEW-}: <span class="fc_gry">{-:$item['a_view_count']-}</span>
        					<p class="a_description fc_gry">{-:$item['a_description']-}</p>
        					<a class="more" href="{-:$item['a_url']-}">更多详情 >></a>
        				</li>
        			{-else:-}
        				<li>
        					[<a href="{-:$item['ac_url']-}">{-:$item['ac_name']-}</a>] <a class="fc_gry_d" href="{-:$item['a_url']-}">{-:$item['a_title']|AString::utf8_substr~@me,60-}</a>
        					<span class="fc_gry">{-:$item['a_edit_time']|date~'m-d',@me-}</span>
        					<a class="more" href="{-:$item['a_url']-}">更多详情 >></a>
        				</li>
        			{-:/if-}
        			{-:/foreach-}
                
                
                </ol>
                {-include:clip/paging-}
            </div>
        </div>
        	
    </div>
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