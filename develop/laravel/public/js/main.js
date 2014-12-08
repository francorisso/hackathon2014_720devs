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
		$('.fancybox-media').fancybox({
			type:'iframe'
		});
		
	}
};

var ListView = {
	init: function(){
		//masonry layout
		var container = document.querySelector('#grid');
		$(".item").each(function(){
			$(this).css('width',$(this).outerWidth()+'px');
		});
		imagesLoaded( container, function() {
			var msnry = new Masonry( container, {
				itemSelector: '.item'
			});	
		});

		//add to my boards
		$('.board-add').fancybox({
			type: 'iframe'
		});
	}
};

var LoadComponents = {
	boards: function(callback){
		$.getJSON( domain + '/boards',{},function(res){
			html = "";
			for(var i=0; i<res.length; i++){
				html += '<li><a href="'+ res[i].permalink +'">'+ res[i].name +'</a></li>'
			}
			$('#component-boards .dropdown-menu').html( html );
		});

		if(typeof callback != "undefined"){
			callback();
		}
	},

	topics: function(callback){
		$.getJSON( domain + '/topics',{},function(res){
			html = "";
			for(var i=0; i<res.length; i++){
				html += '<span class="tag">\
					<a href="'+ res[i].permalink +'">'+ res[i].name +'</a>\
					<a class="glyphicon glyphicon-remove" href="#"></a>\
				</span>';
			}
			$('#component-topics').html( html );
		});

		if(typeof callback != "undefined"){
			callback();
		}
	},
}