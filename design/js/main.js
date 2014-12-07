var fancybox={
	init:function() {
		$(".fancyvideo").fancybox({
			fitToView	: false,
			width		: '100%',
			height		: '100%',
			autoSize	: false,
			closeClick	: false,
			openEffect	: 'none',
			padding     : '0',
			closeEffect	: 'none'
		});
	}
};

var slider={
	init:function() {
		$('#slider-top').superslides({
			hashchange: true,
			play: 5000
		});
	}
};

var scrollMenu={
	init:function() {
		$('a[href*=#]:not([href=#])').click(function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
				if (target.length) {
					$('html,body').animate({
						scrollTop: target.offset().top
					}, 1000);
				return false;
				}
			}
		});

		$(window).bind('scroll', function() {
			if ($(window).scrollTop() > 50) {
				$('.navbar').addClass('navbar-white');
			}
			else {
				$('.navbar').removeClass('navbar-white');
			}
		});
	}
};

var fancybox2={
	init:function() {
		console.log('mierda');
		$('.fancybox-media').fancybox({
			type:'iframe'
		});
		
	}
};