;(function($, window, document, undefined) {

	var main = {
		w: $(window),
		d: $(document),
		init: function(){

			this.global.init();
			this.header.init();
			this.sidebar.init();
			this.pageheader.init();
			this.lightbox.init();
			this.adverts.init();
			
		},

		global: {
			init: function(){
				
				// if( $.fn.owlCarousel ) {
				// 	$('.owl-carousel').owlCarousel({
				// 	    loop: true,
				// 	    nav: true,
				// 	    navText: false,
				// 	    center: true
				// 	});
				// }

				$('.print-btn').on('click', function(e) {
					e.preventDefault();
					window.print();
				});

				main.d.on('click', '.scroll-to-btn', function(e){
					var btn = $(this),
						href = btn.attr('href'),
						location = $(href);

		 			if( location.length ) {
		 				e.preventDefault();
		 				$('html, body').animate({scrollTop: location.offset().top - 200});
			 		}
				});

				$('.login-btn').on('click', function(e){
					e.preventDefault();

					var btn = $(this);

					main.lightbox.load({
						url: btn.attr('href'),
						data: {
							ajax_action: 'content'
						}
					});
				});

				$('.redirect-dropdown').on('change', function(e){
					e.preventDefault();
					window.location.href = $(this).val();
				});

				$('a[href^=http]:not([href*="' + window.location.host +'"])').attr('target', '_blank');
			}
		},

		body: {
			element: $('body')
		},

		html: {
			element: $('html')
		},
		
		header: {
			element: $('#header'),
			init: function(){
				var element = this.element,
					menubtn = $('.menu-btn, .close-btn', element);

				menubtn.on('click', function(e){
					e.preventDefault();
					main.html.element.toggleClass('navigation-open');
				});

				$('.menu-item-has-dropdown > a', element).on('click', function(){
					var btn = $(this),
						item = btn.parent();
					item.toggleClass('show-dropdown');

					if( item.hasClass('show-dropdown') ) {
						btn.text("Close");
					} else {
						btn.text("More");
					}
				});

				main.body.element.waypoint(function(direction){
					main.body.element.toggleClass('header-sticky', direction === 'down');
				}, {
					offset: -element.height()
				});

				this.search.init();
				
			},
			search: {
				element: $('#header .search-form'),
				init: function(){
					var element = this.element,
						btn = $('.search-btn', element),
						field = $('.field', element);

					btn.on('click', function(e){
						var html = main.html.element;
						if(!html.hasClass('search-open')) {
							e.preventDefault();
							html.addClass('search-open');
							field.focus();
						}
					});

					field.on('blur', function(){
						var html = main.html.element;
						setTimeout(function(){
							html.removeClass('search-open');
						}, 100);
					});
				}
			}
		},

		sidebar:{
			element: $('#sidebar'),

			init: function(){
				var element = this.element;

				if( !element.length ) return;

				this.container = element.parent();
				this.inner = $('> .inner', element);
				
				main.w.on('load resize', main.sidebar.waypoints);

			},
			waypoints: function(){

				var element = main.sidebar.element,
					container = main.sidebar.container,
					inner = main.sidebar.inner,
					header = main.header.element,
					containerHeight = container.height(),
					innerHeight = inner.height(),
					innerOffset = inner.offset(),
					headerHeight = header.height() + parseInt(header.css('top')),
					windowHeight = main.w.height();

					//console.log(inner.height(), container.height())

				if( containerHeight - innerHeight > 0) {
					//console.log(innerOffset.top + innerHeight, windowHeight);
					if(innerOffset.top + innerHeight > windowHeight) {
						inner.waypoint(function(direction){
							element.toggleClass('sticky-bottom', direction === 'down');
						},{
							offset: 'bottom-in-view'
						});

						container.waypoint( function(direction) {
							element.toggleClass('sticky-very-bottom', direction === 'down');
						}, {
							offset: 'bottom-in-view'
						});
					} else {

						container.waypoint(function(direction){
							element.toggleClass('sticky-top', direction === 'down');
						});

						container.waypoint( function(direction) {
							element.toggleClass('sticky-very-bottom', direction === 'down');
						}, {
							offset: -containerHeight
						});
					}
					
				}
			}
		},

		pageheader: {
			element: $('#page-header'),
			init: function(){
				var element = this.element;

				if(!element.length) return false;

				$('.dropdown-btn', element).on('click', function(){
					var btn = $(this);
					
					element.toggleClass('dropdown-open');

					var text = element.hasClass('dropdown-open') ? "Close" : "View Sections";

					btn.text(text);
				});
			}
		},

		frontpage: {
			element: $('#front-page'),
			init: function(){
				var element = this.element;

				if(!element.length) return false;
				
				

			},
			
		},


		adverts: {
			element: $('.advert'),
			init: function(){

				var element = this.element;

				if(!element.length || !ADTECH) return false;

				ADTECH.config.page = {
		            protocol: 'http',
		            server: 'adserver.adtech.de',
		            network: '1331',
		            responsiveCheckTimeout: 150
		        };

				element.each(function(){
					var advert = $(this),
						placementid = advert.data('placement-id'),
						keywords = advert.data('keywords');

					if( placementid ) {
						ADTECH.config.placements[placementid] = { 
							params: {
								target: '_blank',
								key: keywords
							},
							responsive: {
								useresponsive: true, 
								bounds: [
									// {
									// 	id: 5661899, 
									// 	min: 0,
									// 	max: 749
									// },
									{
									   id: placementid,
				                        min: 750,
				                        max: 9999
				                    }
								]
							}
						};

						ADTECH.enqueueAd(placementid);
					}
				});

				ADTECH.executeQueue();
			}
		},

		lightbox: {
			element: $('#lightbox'),
			init: function(){

				var lightbox = this,
					element = lightbox.element;

				if( !element.length ) return false;

				var content = lightbox.content = $('.lightbox-content', element),
					preloader = lightbox.preloader = $('.lightbox-preloader', element),
					overlay = lightbox.overlay = $('.lightbox-overlay', element),
					closebtn = lightbox.closebtn = $('.close-btn', element);

				overlay.on('click', lightbox.close);

				closebtn.on('click', lightbox.close);
			},
			open: function(url){
				var lightbox = main.lightbox;

				lightbox.load({
					url: url
				});
			},
			load: function(options, callback){

				var lightbox = main.lightbox,
					element = lightbox.element;

				element.addClass('visible preloader-visible');

				$.ajax(options).done(function(data){
					if(data) {
						lightbox.loaded(data);
						if(callback) callback(data);
					} else {
						lightbox.close();
					}
				}).fail(function(){
					lightbox.close();
				});
			},
			loaded: function(data){
				var lightbox = main.lightbox,
					element = lightbox.element,
					content = lightbox.content,
					preloader = lightbox.preloader;

				content.html(data);

				element.addClass('content-visible').removeClass('preloader-visible');

				setTimeout(function(){
					lightbox.ready();
				}, 500);
			},

			ready: function(){

			},

			close: function(){
				var lightbox = main.lightbox,
					element = lightbox.element,
					content = lightbox.content;

				element.removeClass('visible content-visible');
				content.empty();
			}
		},

		accordion: {
			element: $('.accordion'),
			init: function() {
				var element = this.element;

				if(!element.length) return false;

				var btns = $('.btn', element),
					items = $('.item', element);

				btns.on('click', function(e) {
					e.preventDefault();
					var btn = $(this),
						item = btn.parent(),
						open = ( item.hasClass('current') ) ? true : false;

					items.removeClass('current');
					if( !open ) {
						item.addClass('current');
					}
				});		
			}
		},

		template: {
			parse: function (template, data) {
				return template.replace(/\{([\w\.]*)\}/g, function(str, key) {
					var keys = key.split("."), v = data[keys.shift()];
					for (var i = 0, l = keys.length; i < l; i++) v = v[keys[i]];
					return (typeof v !== "undefined" && v !== null) ? v : "";
				});
			}
		},

		url: {
			parameters: {

				get: function(url, key){
					if(key) {
					   	var params = main.url.parameters.get(url);

					   	return params[key];
		     			
					} else {
			            var values = [], parameter,
			                parameters = url.slice(url.indexOf('?') + 1).split('&');

			            for(var i = 0; i < parameters.length; i++) {
			                parameter = parameters[i].split('=');
			                values.push(parameter[0]);
			                values[parameter[0]] = parameter[1];
			            }
			            return values;
			        }
		        },

		        set: function(url, key, value){
			        var regex = new RegExp('(\\?|\\&)'+key+'=.*?(?=(&|$))'),
			               qstring = /\?.+$/;

		            if (regex.test(url)){
		                url = url.replace(regex, '$1'+key+'='+value);
		            } else if (qstring.test(url)) {
		                url = url + '&'+key+'='+value;
		            } else {
		                url =  url + '?'+key+'='+value;
		            }

		            return url;     
		        
		        }
	        }
        }
	};

	window.main = main;

	$(function(){
		window.main.init();
	});

})(jQuery, window, document);

