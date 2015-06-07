<div class="header">
	<div class="main">
		<img class="f_left" src="{-:$_SITE['logo']-}"
			alt="{-:$_SITE['name']-}" />
		<div class="f_right help">
			<p class="f_gray">全国统一服务热线: 0755-82797719</p>
			<p class="f_blue">诚信经营 · 细心服务 · 专业产品</p>
		</div>
		<div class="clear"></div>
	</div>
</div>

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
	</div>
</div><!--/#nav_main-->

