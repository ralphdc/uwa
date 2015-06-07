
<div id="top"></div>
<nav id="topNavBar" class="navbar" data-sticky>
	<ul class="navbar-nav">
		<li><a href="{-:*__APP__-}"><img src="{-:$_SITE['logo_mobile']-}" alt="{-:$_SITE['name']-}" /></a></li>
{-foreach:$_CP,$k,$cp-}
	{-if:0!=$k-}
		{-if:$k+1==count($_CP)-}
			<li><a href="#">{-:$cp['name']|AString::utf8_substr~@me,12,1-}</a></li>
		{-else:-}
			<li><a href="{-:$cp['url']-}"><strong>{-:$cp['name']-}</strong></a></li>
		{-:/if-}
	{-:/if-}
{-:/foreach-}
	</ul>
	<div class="navbar-flip">
		<a class="navbar-toggle navbar-toggle-alt" href="#" data-toggle="{target:'#searchBox'}"></a>
		<a class="navbar-toggle" href="#menuMain" data-offcanvas></a>
	</div>
</nav>
<div id="searchBox" class="panel hide">
	<div class="panel-body">
		<form class="form form-inline clearfix" method="post" action="{-url:home@search/search_do-}">
			<div class="form-group float-left">
				<div class="input-icon">
					<i class="icon icon-search"></i>
					<input required="required" type="text" name="keyword" size="20" placeholder="{-:@KEYWORDS-}" class="control-input required" />
				</div>
			</div>
			<button class="btn btn-default float-right" type="submit">{-:@SEARCH-}</button>
		</form>
	</div>
	<div class="panel-footer"><a href="{-url:home@search/search-}" target="_blank">{-:@ADVANCED_SEARCH-}</a> | <a href="{-url:home@tag/index-}" target="_blank">{-:@TAG-}</a></div>
</div>
<div id="menuMain" class="offcanvas">
	<div class="offcanvas-bar offcanvas-bar-flip">
		<ul class="nav nav-offcanvas" data-nav>
			<li class="nav-header"><div id="uwa_member"></div></li>
			<li class="nav-divider"></li>
		<uwa:menu alias="main">
		{-if:!empty($m['m_sub_menu'])-}
			<li class="nav-parent {-if:get_url($_GCAP) == $m['url']-} active{-:/if-}">
				<a href="#" title="{-:$m['m_tip']-}">{-:$m['m_name']-}</a>
				<ul class="nav-sub">
			{-foreach:$m['m_sub_menu'],$ms-}
					<li {-if:get_url($_GCAP) == $ms['url']-} class="active"{-:/if-}><a href="{-:$ms['url_o']-}" title="{-:$ms['m_tip']-}">{-:$ms['m_name']-}</a></li>
			{-:/foreach-}
				</ul>
			</li>
		{-else:-}
			<li {-if:get_url($_GCAP) == $m['url']-} class="active"{-:/if-}><a href="{-:$m['url_o']-}" title="{-:$m['m_tip']-}">{-:$m['m_name']-}<div>{-:$m['m_tip']-}</div></a></li>
		{-:/if-}
		</uwa:menu>
		</ul>
	</div>
</div>

