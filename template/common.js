$(document).ready(function() {
	$("div.statusmsg").slideDown("fast");
	$("div.statusmsg div.close").click(function() {
		$(this).parents("div.statusmsg").stop().slideUp("fast");
	});
	$('.refreshcaptcha').click(function() {
		$('img.captcha').each(function() {
			var o = $(this);
			o.hide('fast');
			var s = this.src.toString();
			this.src = '#';
			var idx = s.indexOf('?');
			var h = s;
			if (idx != -1) {
				h = s.substr(0, idx);
			}
			this.src = h + '?t=' + (new Date()).getTime();
			o.show('fast');
		});
		$('input.captcha').val('');
		return false;
	});

});