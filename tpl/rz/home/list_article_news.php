<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:$_V['ac_name']-} - {-:$_SITE['name']-}</title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}home/css/rz.css" />
<meta name="keywords" content="{-:$_V['ac_keywords']-},{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_V['ac_description']-}" />
</head>

<body>
{-include:header-}
<div class="banner dynamic">
	<uwa:ad id="17">
</div>
<div class="crumbs"><a href="#">首页</a> > 最新资讯</div>
<div class="banner dynamic">
	<img src="images/page_banner3.jpg" alt="锐志" />
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
				<li class="pic">
					<img class="a" src="{-:$item['a_thumb']-}" width="314" height="162"/>
					<h3><a class="fs_14" href="{-:$item['a_url']-}">{-:$item['a_title']-}</a> </h3>
					<em>{-:@PUBLISH_DATE-}: {-:$item['a_edit_time']|date~'m-d',@me-}</em>
				</li>
			{-else:-}
				<li class="fs_14{-if:4 == $k%5-} part{-:/if-}">
					[<a href="{-:$item['ac_url']-}">{-:$item['ac_name']-}</a>] <a class="fc_gry_d" href="{-:$item['a_url']-}">{-:$item['a_title']|AString::utf8_substr~@me,60-}</a>
					<span class="fc_gry">{-:$item['a_edit_time']|date~'m-d',@me-}</span>
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