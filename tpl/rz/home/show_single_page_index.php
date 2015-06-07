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


<uwa:ad id="10">
<div class="center">
	<div class="main">
	  <div>
             {-:$_V['sp_content']-}
      </div>
       <div class="outer">
        	<div class="title"><h2>热销产品</h2><span>诚信经营 · 细心服务 · 专业产品</span><a href="#">[More]</a></div>
            <div class="inner">
               <uwa:ad id="12">
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
	
});
</script>

<script>
document.write('<script src="{-url:member@common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:home@common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}home/js/jcarousellite.js"></script>
<script src="{-:*__THEME__-}home/js/c.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>