<div class="flash">
<!--flexslider-->
<div class="flexslider">
	<ul class="slides">
	    {-foreach:$_ASI['ad'],$ad-}
    	<li style="background:url({-if:!empty($ad['a_file'])-}{-:$ad['a_file']-}{-else:-}{-:*__APP__-}u/site/no_thumb.png{-:/if-}) 50% 0 no-repeat"></li>
    	{-:/foreach-}
    </ul>
</div>
<!--end flexslider-->
</div>
