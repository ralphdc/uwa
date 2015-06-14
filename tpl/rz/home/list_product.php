<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:$_SITE['name']-}</title>

<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}home/css/rz.css" />
<meta name="keywords" content="{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_SITE['description']-}" />
</head>

<body>
{-include:header-}


<div class="center">
	<div class="main">
        <div class="crumbs"><a href="#">首页</a> > 产品展示</div>
        <div class="list">
        	<h2>产品中心</h2>
           	<div class="product_box">
           	
           	<div class="f_left grid2">
                <div class="product_nav">
                {-foreach:$categorys,$k,$c-}
                    <a {-if:$k==0-} class="active pk" {-else:-} class="pk" {-:/if-} href="javascript:void(0)">{-:$c['pcategory_title']-}</a>
                     {-if:count($c['ccategory'])>0-}
                        <ul>
                         {-foreach:$c['ccategory'],$kc,$child-}
                            <li><a>=>{-:$child['ccategory_title']-}</a></li>
                         {-:/foreach-}
                        </ul>
                     {-:/if-}
                {-:/foreach-}
                </div>
                </div>
                
                
                <div class="f_right grid8 product_list">
                <ul>
                    <li><img src="images/iamge1.jpg" /><a href="productinfo.html">产品名字“测试数据仅供参考”</a></li>
                    <li><img src="images/iamge2.jpg" /><a href="productinfo.html">产品名字“测试数据仅供参考”</a></li>
                    <li><img src="images/iamge3.jpg" /><a href="productinfo.html">产品名字“测试数据仅供参考”</a></li>
                    <li><img src="images/iamge4.jpg" /><a href="productinfo.html">产品名字“测试数据仅供参考”</a></li>
                    <li><img src="images/iamge1.jpg" /><a href="productinfo.html">产品名字“测试数据仅供参考”</a></li>
                    <li><img src="images/iamge2.jpg" /><a href="productinfo.html">产品名字“测试数据仅供参考”</a></li>
                    <li><img src="images/iamge3.jpg" /><a href="productinfo.html">产品名字“测试数据仅供参考”</a></li>
                    <li><img src="images/iamge4.jpg" /><a href="productinfo.html">产品名字“测试数据仅供参考”</a></li>
                    <li><img src="images/iamge1.jpg" /><a href="productinfo.html">产品名字“测试数据仅供参考”</a></li>
                    <li><img src="images/iamge2.jpg" /><a href="productinfo.html">产品名字“测试数据仅供参考”</a></li>
                    <li><img src="images/iamge3.jpg" /><a href="productinfo.html">产品名字“测试数据仅供参考”</a></li>
                    <li><img src="images/iamge4.jpg" /><a href="productinfo.html">产品名字“测试数据仅供参考”</a></li>
                </ul>
                <div class="page">
                    <a href="#"><</a>
                    <a href="#">1</a>
                    <a href="#">2</a>...</a>
                    <a href="#">6</a>
                    <a href="#">></a>
                </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        
    </div>
</div>

{-include:footer-}
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="/tpl/rz/home/js/jquery.flexslider-min.js"></script>
<script src="/tpl/rz/home/js/jquery.scrollbox.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	//flash
	$('.flexslider').flexslider({		
	slideshowSpeed: 3000, // 自动播放速度毫秒
	animationSpeed: 600, //滚动效果播放时长
	directionNav: false, //Boolean:  (true/false)是否显示左右控制按钮		
	pauseOnAction: true		
	});

	//热销产品
	$('#scroll').scrollbox({
	  direction: 'h',
	  distance: 176
	});
	$('#backward').click(function () {
	  $('#scroll').trigger('backward');
	});
	$('#forward').click(function () {
	  $('#scroll').trigger('forward');
	});

	$(".pk").click(function(){
		$(".product_nav").find("a").removeClass("active");
		$(".product_nav").find("ul").slideUp();
		$(this).addClass("active");
		$(this).next().slideDown();
    })
	
});
</script>
</body>
</html>