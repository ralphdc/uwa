/* common */
var is_uploading = false;

/*s: .a, .i hover and focus class toggle */
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
/*e: .a, .i hover and focus class toggle */

/*s: .t toggle */
$('.subMenu dd').hide();
$('.subMenu dt:first-child').next().show();
$(document).on('click', '.t dt', function() {
	$(this).next().slideToggle();
});
/*e: .t toggle */

/*s: atab */
$('.atab strong:first-child').addClass('atabOn');
$('.atab dd .tabCntnt').not(':first-child').hide();
$('.atab strong').unbind('click').bind('click', function() {
	$(this).siblings('strong').removeClass('atabOn').end().addClass('atabOn');
	var index = $('.atab strong').index($(this));
	$('.atab dd .tabCntnt').eq(index).siblings('.atab dd .tabCntnt').hide().end().fadeIn();
});
/*e: atab */

/*s: submit form */
$('.required').keyup(function() {
	$(this).removeClass('warning');
	if ('' == this.value) {
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
});
/*e: submit form */

/*s: delete confirm */
function delete_confirm() {
	if(confirm('真的要删除吗？')) {
		return true;
	}
	else {
		return false;
	}
}
/*e: delete confirm */

/*s: menu */
$('.menu dt').mouseenter(function() {
	var p = $(this).position();
	$(this).siblings('dd').hide();
	$(this).next('dd').css({left:p.left}).show();
});
$('.menu dd').mouseleave(function() {
	$(this).hide();
});
/*e: menu */

/*s: .submit to=form id, action=form action */
$('.submit').bind('click', function() {
	$($(this).attr('to')).attr('action', $(this).attr('action'));
	$($(this).attr('to')).submit();
});
/*e: .submit to=form id, action=form action */

/*s: .main_content append logo */
$('.main_content').append('<span class="logo_tiny"></span><div class="c"></div>');
/*e: .submit to=form id, action=form action */

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

function byte_format(size, dec) {
	var a = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'],
		pos = 0;
	while(size >= 1024) {
		size /= 1024;
		pos++;
	}
	return Math.round(size*100)/100 + ' ' + a[pos];
}

