
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
		<ul class="nav nav-offcanvas" data-nav="{multiple:true}">
			<li class="nav-header"><div id="uwa_member"></div></li>
			<li class="nav-divider"></li>
			<li class="nav-header">{-:@CONTENT_CENTER-}</li>
			<li class="nav-parent open">
				<a href="#" title="{-:@ARCHIVE-}"><i class="icon icon-archive"></i> {-:@ARCHIVE-}</a>
				<ul class="nav-sub">
				{-foreach:$_AML,$item-}
					<li{-if:($_GCAP == 'member@archive/list_archive?archive_model_id=' . $item['archive_model_id'])-} class="active"{-:/if-}>
						<a href="{-url:archive/add_archive?archive_model_id={$item['archive_model_id']}-}" class="float-right">{-:@PUBLISH-}</a>
						<a href="{-url:archive/list_archive?archive_model_id={$item['archive_model_id']}-}">{-:$item['am_name']-}</a>
					</li>
				{-:/foreach-}
				</ul>
			</li>
		{-if:!empty($_CML)-}
			<li class="nav-parent open">
				<a href="#" title="{-:@OTHER_CONTENT-}"><i class="icon icon-puzzle-piece"></i> {-:@OTHER_CONTENT-}</a>
				<ul class="nav-sub">
				{-foreach:$_CML,$item-}
					<li{-if:($_GCAP == 'member@custom_model/list_content?custom_model_id=' . $item['custom_model_id'])-} class="active"{-:/if-}>
						<a href="{-url:custom_model/add_content?custom_model_id={$item['custom_model_id']}-}" class="float-right">{-:@PUBLISH-}</a>
						<a href="{-url:custom_model/list_content?custom_model_id={$item['custom_model_id']}-}">{-:$item['cm_name']-}</a> 
					</li>
				{-:/foreach-}
				</ul>
			</li>
		{-:/if-}
			<li class="nav-parent{-if:in_array($_GCAP, array('member@member_favorite/list_favorite', 'member@upload/list_upload'))-} open{-:/if-}">
				<a href="#" title="{-:@RESOURCE-}"><i class="icon icon-star"></i> {-:@RESOURCE-}</a>
				<ul class="nav-sub">
					<li{-if:$_GCAP == 'member@member_favorite/list_favorite'-} class="active"{-:/if-}><a href="{-url:member_favorite/list_favorite-}">{-:@FAVORITE-}</a></li>
					<li{-if:$_GCAP == 'member@upload/list_upload'-} class="active"{-:/if-}><a href="{-url:upload/list_upload-}">{-:@UPLOAD-}</a></li>
				</ul>
			</li>
			<li class="nav-header">{-:@CREDIT-}</li>
			<li{-if:$_GCAP == 'member@member_credit/credit_exchange'-} class="active"{-:/if-}><a href="{-url:member@member_credit/credit_exchange-}"><i class="icon icon-retweet"></i> {-:@CREDIT_EXCHANGE-}</a></li>
			<li{-if:$_GCAP == 'member@member_credit_order/list_credit_order'-} class="active"{-:/if-}><a href="{-url:member_credit_order/list_credit_order-}"><i class="icon icon-money"></i> {-:@CREDIT_ORDER-}</a></li>
			<li class="nav-header">{-:@MEMBER_CENTER-}</li>
			<li{-if:$_GCAP == 'member@member_notify/list_notify'-} class="active"{-:/if-}><a href="{-url:member_notify/list_notify-}"><i class="icon icon-envelope"></i> {-:@NOTIFY-}</a></li>
			<li class="nav-parent{-if:in_array($_GCAP, array('member@member/edit_info_base', 'member@member/edit_info_addon'))-} open{-:/if-}">
				<a href="#" title="{-:@SETTING-}"><i class="icon icon-gear"></i> {-:@SETTING-}</a>
				<ul class="nav-sub">
					<li{-if:$_GCAP == 'member@member/edit_info_base'-} class="active"{-:/if-}><a href="{-url:member/edit_info_base-}">{-:@BASE_INFO-}</a></li>
					<li{-if:$_GCAP == 'member@member/edit_info_addon'-} class="active"{-:/if-}><a href="{-url:member/edit_info_addon-}">{-:@ADDON_INFO-}</a></li>
				</ul>
			</li>
		</ul>
	</div>
</div>

