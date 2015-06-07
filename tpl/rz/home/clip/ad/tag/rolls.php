<div id="scroll" class="scroll_img">
	<ul>
		{-foreach:$_ASI['ad'],$ad-}
		<li><a href="{-:$_ASI['ad']['a_link']-}"><img alt=""
				src="{-if:!empty($ad['a_file'])-}{-:$ad['a_file']-}{-else:-}{-:*__APP__-}u/site/no_thumb.png{-:/if-}" /></a></li>
		{-:/foreach-}
	</ul>
</div>
<div class="scroll_btn">
	<a class="btn" id="backward" href="javascript:void(0)"><i
		class="icon_left"></i></a> <a class="btn" id="forward"
		href="javascript:void(0)"><i class="icon_right"></i></a>
</div>