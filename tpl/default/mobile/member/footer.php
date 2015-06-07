
<div id="footer" class="text-center">
	<ul class="subnav subnav-line">
	<uwa:menu alias="footer">
		<li{-if:get_url($_GCAP) == $ms['url']-} class="active"{-:/if-}>
			<a href="{-:$m['url_o']-}" title="{-:$m['m_tip']-}">{-:$m['m_name']-}</a>
		</li>
	</uwa:menu>
		<li><a href="{-url:home@common/toggle_ua?ua=pc-}">{-:@PC_VERSION-}</a></li>
		<li><a class="btn border-circle icon icon-arrow-up" data-smooth-scroll href="#top"></a></li>
	</ul>
	{-:$_SITE['copyright']-}
	<small class="text-muted">Powered by <strong><a class="text-muted" href="{-:*SOFT_AUTHOR_URL-}" target="_blank">{-:*SOFT_NAME-}</a></strong> {-:*SOFT_CODENAME-}</small>
</div>
