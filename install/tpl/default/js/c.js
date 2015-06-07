/* .a, .i hover and focus class toggle */
$(document).on('mouseenter', 'a, .a, .i', function(){
		$(this).addClass('hover');
	})
	.on('mouseleave', 'a, .a, .i', function(){
		$(this).removeClass('hover');})
	.on('focus', '.i', function(){
		$(this).addClass('focus');})
	.on('blur', '.i', function(){
		$(this).removeClass('focus');});

/* submit form */
$('.required').keyup(function() {
	$(this).removeClass('warning');
	if('' == this.value) {
		$(this).addClass('warning');
	}
	check_next_step();
});
$('form').submit(function(){
	$(this).find('.required').trigger('keyup');
	var numWarnings = $('.warning', this).length;
	if(numWarnings){
		$(this).find('.warning').first().focus();
		return false;
	}
});