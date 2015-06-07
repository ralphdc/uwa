
<div id="header">
	<div id="topbar" class="m w_960">
		<div id="uwa_member"></div><!--/#uwa_member-->
		<div id="nav_topbar">
			<a href="{-url:home@search/search-}" target="_blank">{-:@ADVANCED_SEARCH-}</a> | <a href="{-url:home@tag/index-}" target="_blank">{-:@TAG-}</a>
		</div><!--/#nav_topbar-->
	</div>
	<div class="m w_960">
		<h1><a href="{-:$_SITE['host']-}"><img src="{-:$_SITE['logo']-}" alt="{-:$_SITE['name']-}" /></a></h1>
	</div>
</div><!--/#header-->

<div id="nav_main">
	<div class="m w_960">
		<dl class="menu w_760 f_l">
		<uwa:menu alias="main">
			<dt class="a{-if:get_url($_GCAP) == $m['url']-} on{-:/if-}"><a href="{-:$m['url']-}" title="{-:$m['m_tip']-}" target="{-:$m['m_target']-}">{-:$m['m_name']-}</a></dt>
			{-if:!empty($m['m_sub_menu'])-}<dd class="fs_13 fw_n"><ul>
		{-foreach:$m['m_sub_menu'],$ms-}
					<li class="a"><a href="{-:$ms['url']-}" title="{-:$ms['m_tip']-}" target="{-:$ms['m_target']-}">{-:$ms['m_name']-}</a></li>
		{-:/foreach-}
			</ul></dd>{-:/if-}
		</uwa:menu>
		</dl><!--/.menu-->
		<div class="search_box f_r">
		<form method="post" action="{-url:home@search/search_do-}">
			<input type="text" name="keyword" value="" class="required"><input type="submit" class="search_btn a" value="{-:@SEARCH-}" />
		</form>
		</div><!--/.search_box-->
	</div>
</div><!--/#nav_main-->
<div class="h_10 o_h"></div>
