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


<div class="menu">
    <div class="main">
    	<div class="f_left nav">
    	    <uwa:menu alias="main">
        	<a href="{-:$m['url']-}" title="{-:$m['m_tip']-}" target="{-:$m['m_target']-}" class="{-if:get_url($_GCAP) == $m['url']-} active{-:/if-}">{-:$m['m_name']-}</a>
        	</uwa:menu>
        </div>
        <div class="f_right search">
        	<input type="button" value="" /><input type="text" value="" />
        </div>
        <div class="clear"></div>
    </div>
</div>