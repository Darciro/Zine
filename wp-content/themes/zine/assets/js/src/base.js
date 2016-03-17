(function ($) {

	var app = {
		init: function () {
			console.info('Init');

			app.toggleShareModal();
			/*app.menuToggler();
			 app.toggleMultmediaNews();
			 app.showButtonGotToTop();
			 app.instaFeed();
			 app.responsiveUtils();
			 app.goToElement();*/
		},

		menuToggler: function(){
			$('body').on('click', function (e) {
				$('#header').removeClass('menu-active');
			});

			$('#menu-toggler').on('click', function(e){
				e.stopPropagation();
				$('#header').toggleClass('menu-active');
			});

			$('#header.menu-active').on('click', function(e){
				e.stopPropagation();
			});
		},

		toggleMultmediaNews: function(){
			$('.gallery--heading a').on('click', function(e){
				e.preventDefault();
				$('.gallery--heading a, .gallery--item').removeClass('active');
				$(this).addClass('active');
				var target = $(this).data('target');
				$('#' + target).addClass('active');
			});
		},

		showButtonGotToTop: function(){
			if( $(window).width() < 980 ){
				$(window).scroll(function () {
					if($(this).scrollTop() != 0) {
						$('#back_to_top').show('slow');
					} else {
						$('#back_to_top').hide('slow');
					}
				});

				$('#back_to_top').click(function(){
					$('html, body').animate({scrollTop:0}, 'slow');
					return false;
				});
			}

			$('.back-to-top').click(function(e){
				e.preventDefault();
				$('html, body').animate({scrollTop:0}, 'slow');
				return false;
			});
		},

		instaFeed: function () {
			if( $('#instafeed').length ){
				var feed = new Instafeed({
					get: 'tagged',
					tagName: 'brasilorganico',
					limit: 4,
					clientId: 'ee133eac92384cb3b8e84e73814a0151'
				});
				feed.run();
			}

			if( $('#instafeed-internal').length ){
				var feed = new Instafeed({
					target: 'instafeed-internal',
					template: '<div class="col-xs-6 col-sm-4 col-md-4"><a href="{{link}}"><img src="{{image}}" class="img-responsive" /></a></div>',
					get: 'tagged',
					tagName: 'brasilorganico',
					limit: 3,
					clientId: 'ee133eac92384cb3b8e84e73814a0151'
				});
				feed.run();
			}

			// console.log(feed);
		},

		responsiveUtils: function() {
			function checkWidth () {
				var windowWidth = $(window).width();
				return windowWidth;
			}

			function implementResponsive () {
				// Remove slider
				$('.map .cycle-slideshow').cycle('destroy');

				setTimeout( function () {
					$('.map img.tips--image.cycle-sentinel.cycle-slide').addClass('hidden');
				}, 500 )
			}

			$( window ).resize(function() {
				implementResponsive();
			});

			if( $(window).width() < 768 ){
				implementResponsive();
			}
		},

		toggleShareModal: function() {
			$('a.share-link').on('click', function(event) {
				event.preventDefault();
				var url = $(this).attr('href');
				showModal(url);
			});

			function showModal(url){
				window.open(url, "shareWindow", "width=600, height=400");
				return false;
			}
		},

		goToElement: function(){
			$('#what-is-nav li a').on('click', function(e){
				e.preventDefault();
				var target = $(this).attr('href');
				console.log( target );
				$('html, body').animate({ scrollTop: ( $(target).offset().top -20 ) }, 'slow');
				return false;

			})
		}

	};

	$(document).ready(function () {
		app.init();
	});
})(jQuery);