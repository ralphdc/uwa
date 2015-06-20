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

<div class="banner product">
	<uwa:ad id="11">
</div>

<div class="center">
	<div class="main">
	
        <div class="crumbs"><a href="#">首页</a> > 产品展示</div>
        <div class="list">
        	<h2>产品中心</h2>
           	<div class="product_box">
           	
           	<div class="f_left grid2">
                <div class="product_nav">
                {-foreach:$categorys,$k,$c-}
                    <a {-if:$k==0-} class="active pk" {-else:-} class="pk" {-:/if-} href="javascript:void(0)"  data-number="parent{-:$c['pcategory_id']-}">{-:$c['pcategory_title']-}</a>
                     {-if:count($c['ccategory'])>0-}
                        <ul>
                         {-foreach:$c['ccategory'],$kc,$child-}
                            <li><a href="/?c=product&a=show_channel&pcategory={-:$c['pcategory_id']-}&ccategory={-:$child['ccategory_id']-}" data-number="child{-:$child['ccategory_id']-}">=>{-:$child['ccategory_title']-}</a></li>
                         {-:/foreach-}
                        </ul>
                     {-:/if-}
                {-:/foreach-}
                </div>
                </div>
                
                
                <div class="f_right grid8 product_list">
                <ul>
                {-foreach:$_SPL,$sp-}
                    <li><a href="/?c=product&a=show_product&pcategory={-:$sp['product_parent']-}&ccategory={-:$sp['product_child']-}&product_id={-:$sp['product_id']-}"><img src="{-:$sp['product_img']-}" width="214" height="214" /></a><a href="/?c=product&a=show_product&pcategory={-:$sp['product_parent']-}&ccategory={-:$sp['product_child']-}&product_id={-:$sp['product_id']-}">{-:$sp['product_title']-}</a></li>
                {-:/foreach-}
                </ul>
                {-include:clip/paging-}
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

    var parent = '{-:$parent_category_value-}';
	   var current = '{-:$child_category_value-}';
		$('.product_nav a').each(function(){
			if($(this).attr('data-number') == 'parent'+parent){
				$(this).addClass('active');
				$(this).next('ul').slideDown();
			}

			

			
			$(this).next('ul').find('a').each(function(){
				if($(this).attr('data-number') == 'child'+current){
					$(this).css({'color':'#FF0000'});
				}

				
				
			})
		})
				
	
});
</script>
</body>
</html>