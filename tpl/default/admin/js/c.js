/* common */
var is_uploading = false;

/* .a, .i hover and focus class toggle */
$(document).on('mouseenter', 'a, .a, .i', function() {
		$(this).addClass('hover');
	})
	.on('mouseleave', 'a, .a, .i', function() {
		$(this).removeClass('hover');
	})
	.on('focus', '.i', function() {
		$(this).addClass('focus');
	})
	.on('blur', '.i', function() {
		$(this).removeClass('focus');
	});
/* .t toggle */
$('.subMenu dd').hide();
$('.subMenu dt:first-child').next().show();
$(document).on('click', '.t dt', function() {
	$(this).next().slideToggle(200);
});
/* atab */
$('.atab strong:first-child').addClass('atabOn');
$('.atab dd .tabCntnt').not(':first-child').hide();
$('.atab strong').unbind('click').bind('click', function() {
	$(this).siblings('strong').removeClass('atabOn').end().addClass('atabOn');
	var index = $('.atab strong').index($(this));
	$('.atab dd .tabCntnt').eq(index).siblings('.atab dd .tabCntnt').hide().end().fadeIn();
});
$(document).ready(function() {
	/* set acbox position */
	$('.acbox').css('left', ($(window).width() - $('.acbox').width()) / 2)
		.css('top', ($(window).height() - $('.acbox').height()) / 2 - 40);
	/* vertical align */
	$(window).resize(function() {
		$('.acbox').css('left', ($(window).width() - $('.acbox').width()) / 2)
			.css('top', ($(window).height() - $('.acbox').height()) / 2 - 40);
	});
});
/* submit form */
$('.required').keyup(function() {
	$(this).removeClass('warning');
	if('' == this.value) {
		$(this).addClass('warning');
	}
});
$('form').submit(function() {
	$(this).find('.required').trigger('keyup');
	var numWarnings = $('.warning', this).length;
	if(numWarnings) {
		$(this).find('.warning').first().focus();
		// alert($(this).find('.warning').first().attr('name'));
		return false;
	}
	if(is_uploading) {
		alert('正在上传附件');
		return false;
	}
	$(window).off('beforeunload');
});
/* select all */
$('.select_all').bind('click', function() {
	var flag = $(this).prop('checked');
	$('input[name^="' + $(this).attr('to') + '"]').prop('checked', flag);
});
/* toggle tr */
$('.toggle_tr').click(function() {
	$('[p_id='+$(this).attr('toggle_tr_id')+'] .toggle_tr').trigger('click');
	$('[p_id='+$(this).attr('toggle_tr_id')+']').toggle();
});
/* delete confirm */
function delete_confirm() {
	if(confirm('真的要删除吗？')) {
		return true;
	}
	else {
		return false;
	}
}
/* .submit to=form id, action=form action */
$('.submit').bind('click', function() {
	$($(this).attr('to')).attr('action', $(this).attr('action'));
	$($(this).attr('to')).submit();
});

function byte_format(size, dec) {
	var a = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'],
		pos = 0;
	while(size >= 1024) {
		size /= 1024;
		pos++;
	}
	return Math.round(size*100)/100 + ' ' + a[pos];
}

/* add refresh botton */
if(top!=self) {
	$('body').prepend('<div id="uwa_totop"></div>');
	$('body').append('<div id="refresh_button"><div id="totop_button"><a class="mi mi_24 mi_24_totop" href="#uwa_totop"></a></div><i class="a mi mi_24 mi_24_refresh" onclick="location.reload();"></i></div><div id="tobottom_button"><a class="mi mi_24 mi_24_tobottom" href="#uwa_tobottom"></a></div>');
	$('body').append('<div id="uwa_tobottom"></div>');
}
