<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:$_V['sp_title']-} - {-:$_SITE['name']-}</title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}home/css/rz.css" />
<meta name="keywords" content="{-:$_V['sp_keywords']-},{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_V['sp_description']-}" />
</head>

<body>
{-include:header-}
<div class="banner intr">
	<uwa:ad id="15">
</div>

<div class="center">
	<div class="main">
        <div class="crumbs"><a href="#">首页</a> > 应用介绍</div>
        <div class="list">
		<h2>应用介绍</h2>
            <div class="about_text">
                <div>
                    {-:$_V['sp_content']-}
                </div>
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