/* index */
$(document).ready(function() {
	_M($('#_M0').text(), $('#_M0').attr('url'));
	/* forbidden iframe */
	if(top!=self) {
		top.location=self.location;
	}
	/* resize #main and .sidebar */
	$('#main').css('width', $(window).width() - 200);
	$('#sidebar,#main').css('height', $(window).height() - 120);
	$(window).resize(function() {
		$('#main').css('width', $(window).width() - 200)
		$('#sidebar,#main').css('height', $(window).height() - 120);
	});
});
/* mainMenu */
$('#mainMenu li:first').addClass('current');setPositon();
$('.subMenu').not(':first').hide();
$('#mainMenu li').unbind('click').bind('click', function() {
	if($('#sidebar').is(':hidden')) {
		$('#sidebarSwitch').trigger('click');
	}
	$(this).siblings('li').removeClass('current').end().addClass('current');
	$('.subMenu').hide();
	$('#'+$(this).attr('for')).fadeIn();
	setPositon();
});
/* load subMenu to mainFrame */
$('.subMenu li[url]').bind('click',function() {
	_M($(this).text(), $(this).attr('url'));
});
/* iframeTabs */
$(document).on('click', '#iframeTabs li span', function() {
	setPositon($(this).text());
	$(this).parent().addClass('current').siblings('li').removeClass('current');
	$('#main iframe[tab_id="'+$(this).parent().attr('tab_id')+'"]').show().siblings('iframe').hide();
	$('.subMenu li[url]').removeClass('current');
	$('.subMenu li[url="'+$(this).parent().attr('url')+'"]').addClass('current');
});
/* iframeTabs */
$(document).on('click', '#iframeTabs li b', function() {
	/* retain the last tab */
	if(1 == $('#iframeTabs li').length) {
		return false;
	}
	$('#main iframe[tab_id="'+$(this).parent().attr('tab_id')+'"]').remove();
	$(this).parent().remove();
	$('#main iframe:last').show();
	$('#iframeTabs li:last').addClass('current');
	$('.subMenu li[url]').removeClass('current');
	$('.subMenu li[url="'+$('#iframeTabs li:last').attr('url')+'"]').addClass('current');
});
/*s: shortcut */
$('#shortcutSwitch').hover(
	function() {
		$('#shortcutItems').show();
	},
	function() {
		$('#shortcutItems').hide();
	}
);
$('#_M0,#shortcutItems li').bind('click', function() {
	_M($(this).text(), $(this).attr('url'));
});
/*e: shortcut */
/* go_menu */
function _M(_title, _url) {
	setPositon(_title);
	var _this = false, _width = 0;
	$('#main iframe').each(function() {
		var iframeSrc = this.contentWindow.location.href,
			pathName = this.contentWindow.location.pathname,
			pos = iframeSrc.indexOf(pathName),
			host = iframeSrc.substring(0,pos),
			tab_id = $(this).attr('tab_id');
		if(iframeSrc == _url || iframeSrc == host + _url) {
			$(this).show().siblings('iframe').hide();
			$(".subMenu li[url],#iframeTabs li").removeClass("current");
			$(".subMenu li[url='"+_url+"'],#iframeTabs li[tab_id='"+tab_id+"']").addClass("current");
			_this = true;
			return false;
		}
		else {
			_width += $('#iframeTabs ul li[tab_id="'+tab_id+'"]').width() + 24;
		}
	});
	if(!_this) {
		var tab_id = (new Date()).valueOf();
		$('#iframeTabs ul li').removeClass('current');
		var liStr = '<li tab_id="'+tab_id+'" url="'+_url+'" class="a current"><span>'+_title+'</span> <b class="a p_0_5">╳</b></li>';
		$('#iframeTabs ul').append(liStr);
		$('#main iframe').hide();
		$('#main').append('<iframe tab_id="'+tab_id+'" src="'+_url+'" height="100%" frameborder="0" width="100%"></iframe>');
		_width = _width + $('#iframeTabs li:last').width() + 24;
		var ulWidth = $('#iframeTabs').width();
		if(_width > ulWidth) {
			$('#main iframe:eq(0)').remove();
			$('#iframeTabs li:eq(0)').remove();
		}
		$(".subMenu li[url],#iframeTabs li").removeClass("current");
		$('.subMenu li[url="'+_url+'"],#iframeTabs li[tab_id="'+tab_id+'"]').addClass('current');
	}
}
/*setPosition*/
function setPositon(menuText) {
	document.title = l_manage+' - '+$('#mainMenu li.current').text();
	$('#position').text(l_manage+' » '+$('#mainMenu li.current').text());
	if(menuText) {
		$('#position').text($('#position').text()+' » '+menuText);
	}
}
/* toggle topbar */
var topbarSwitchClickCount = 0;
$(document).on('click', '#topbarSwitch', function(e) {
	if(topbarSwitchClickCount++ %2 == 0) {
		$('#header').css({height : '30px'});
		$('#mainNav').hide();
		$('#sidebar,#main').css({top : '30px', height : $(window).height() - 60});
		$(window).resize(function() {
			$('#sidebar,#main').css({height : $(window).height() - 60});
		});
	}
	else {
		$('#header').css({height : '90px'});
		$('#mainNav').show();
		$('#sidebar,#main').css({top : '90px', height : $(window).height() - 120});
		$(window).resize(function() {
			$('#sidebar,#main').css({height : $(window).height() - 120});
		});
	}
	e.preventDefault();
});
/* toggle sidebar */
var sidebarSwitchClickCount = 0;
$(document).on('click', '#sidebarSwitch', function(e) {
	if(sidebarSwitchClickCount++ %2 == 0) {
		$('#sidebar').hide();
		$('#main').css({left : 0, width : $(window).width()});
		$('#iframeTabs').css({padding : '0 300px 0 0'});
		$(window).resize(function() {
			$('#main').css('width', $(window).width());
		});
	}
	else {
		$('#sidebar').show();
		$('#main').css({left : '200px', width : $(window).width() - 200});
		$('#iframeTabs').css({padding : '0 300px 0 200px'});
		$(window).resize(function() {
			$('#main').css('width', $(window).width() - 200);
		});
	}
	e.preventDefault();
});
/* operation map */
$('#operationMapSwitch').bind('click', function() {
	dialog({
		title:l_operation_map_title,
		content:document.getElementById('operationMap'),
		padding:'6px 3px',
		id:'OM'
	}).showModal();
});
$(document).on('click', '#operationMap li', function(e) {
	dialog({id:'OM'}).close();
	_M($(this).text(), $(this).attr('url'));
});

/* lock screen */
$('#screenLockSwitch').bind('click', function() {
	$.get(url_lock_screen)
	$('#lockTips').html(l_screen_lock_tip);
	$('#screenLock').slideDown();
});
function check_screenlock() {
	var lock_password = $('#lockPassword').val();
	if(lock_password == '') {
		$('#lockTips').html('<span class="fc_r">' + l_input_empty_tip + '</span>');
		return false;
	}
	$.getJSON(url_check_screen_lock+'&'+Math.random(), {lock_password : lock_password}, function(data) {
		if(1 == data.data) {
			$('#lockTips').html('<span class="fc_g">' + data.info + '</span>');
			$('#lockPassword').val('');
			$('#screenLock').slideUp();
		}
		else {
			$('#lockTips').html('<span class="fc_r">' + data.info + '</span>');
		}
	});
}

