var menuscroll,
		skroller;
(function ($, window, _) {
	'use strict';
    
	var $doc = $(document),
			win = $(window),
			body = $('body');
	
	var SITE = SITE || {};
	
	SITE = {
		init: function() {
			var self = this,
					obj;
			
			for (obj in self) {
				if ( self.hasOwnProperty(obj)) {
					var _method =  self[obj];
					if ( _method.selector !== undefined && _method.init !== undefined ) {
						if ( $(_method.selector).length > 0 ) {
							_method.init();
						}
					}
				}
			}
		},
		responsiveNav: {
			selector: '#wrapper',
			init: function() {
				var base = this,
					container = $(base.selector),
					toggle = $('.mobile-toggle', '.header'),
					cc = $('.click-capture', '#content-container'),
					target = $('#mobile-menu'),
					parents = target.find('.thb-mobile-menu>li>a'),
					span = target.find('.thb-mobile-menu li>span'),
					quick_search = $('.quick_search'),
					header_social = $('.social_header');
				
				toggle.on('click', function() {
					container.toggleClass('open-menu');
					return false;
				});
				
				cc.add(target.find('.close')).on('click', function() {
					container.removeClass('open-menu');
					parents.find('.sub-menu').hide();
					
					return false;
				});
				
				span.on('click', function(){
					var that = $(this),
							link = that.prev('a'),
							parents = target.find('a');
					
					if (!that.parents('.sub-menu').length) {
						parents.filter('.active').not(link).removeClass('active').parent('li').find('.sub-menu').eq(0).slideUp();
					}

					if (link.hasClass('active')) {
						
						link.removeClass('active').parent('li:eq(0)').find('.sub-menu').eq(0).slideUp('200', function() {
							setTimeout(function () {
								window.menuscroll.refresh();
							}, 10);
						});
					} else {
						link.addClass('active').parent('li:eq(0)').find('.sub-menu').eq(0).slideDown('200', function() {
							setTimeout(function () {
								window.menuscroll.refresh();
							}, 10);
						});
					}
					
					return false;
				});
				
				quick_search.on('click', function(e) {
					if(e.target.classList.contains('quick_search') || e.target.classList.contains('search_icon')) {
						quick_search.toggleClass('active');
						e.stopPropagation();
					}
					return false;
				});
				header_social.on('click', 'i', function() {
					header_social.toggleClass('active');
					return false;
				});
			}
		},
		categoryMenu: {
			selector: '.full-menu',
			init: function() {
				var base = this,
					container = $(base.selector),
					children = container.find('.menu-item-has-children');
				
				children.each(function() {
					var _this = $(this),
						menu = _this.find('>.sub-menu,>.thb_mega_menu_holder'),
						tabs = _this.find('.thb_mega_menu li'),
						contents = _this.find('.category-children>.row');
					
					tabs.first().addClass('active');	
					_this.hoverIntent(
						function() {
							TweenLite.to(menu, 0.5, {autoAlpha: 1, ease: Quart.easeOut, onStart: function() { menu.css('display', 'block'); }});
						},
						function() {
							TweenLite.to(menu, 0.5, {autoAlpha: 0, ease: Quart.easeOut, onComplete: function() { menu.css('display', 'none'); }});
						}
					);
					tabs.on('hover', function() {
						var _li = $(this),
							n = _li.index();
						tabs.removeClass('active');
						_li.addClass('active');
						contents.hide();
						contents.filter(':nth-child('+(n+1)+')').show();
					});
				});
				
				container.each(function() {
					var _this = $(this),
							parent = _this.parents('.header');
							
					var resizeMegaMenu = _.debounce(function(){
						_this.find('.thb_mega_menu_holder').css({
							'width' : function() {
								return parent.hasClass('fixed') ? win.outerWidth() : parent.outerWidth();
							},
							'left'	: function() { 
								return parent.hasClass('style4') ? ( -1 * ( parent.find('.full-menu-container').offset().left - parent.find('.nav_holder').offset().left ) ) : 
									(parent.hasClass('boxed') ? 0 : parent.offset().left);
							}
						});
					}, 30);
					win.resize(resizeMegaMenu).trigger('resize');
				});
			}
		},
		fixedHeader: {
			selector: '.header.fixed',
			init: function() {
				var base = this,
						container = $(base.selector),
						single = body.hasClass('single-post');
				
				win.scroll(function(){
					base.scroll(container, single);
				}).trigger('scroll');

			},
			scroll: function (container, single) {
				var animationOffset = 400,
						wOffset = win.scrollTop(),
						stick = 'header--slide',
						unstick = 'header--unslide';
						
				if (wOffset > animationOffset) {
					if (container.hasClass(unstick)) {
						container.removeClass(unstick);
					}
					if (!container.hasClass(stick)) {
						setTimeout(function () {
							container.addClass(stick);
						}, 10);
					}
				} else if ((wOffset < animationOffset && (wOffset > 0))) {
					if(container.hasClass(stick)) {
						container.removeClass(stick);
						container.addClass(unstick);
					}
				} else {
					container.removeClass(stick);
					container.removeClass(unstick);
				}
			}
			
		},
		fullHeightContent: {
			selector: '.full-height-content',
			init: function() {
				var base = this,
					container = $(base.selector);
				
				base.control(container);
				
				win.resize(_.debounce(function(){
					base.control(container);
				}, 50));
				
			},
			control: function(container) {
				var h = $('.header'),
						a = $('#wpadminbar'),
						ah = (a ? a.outerHeight() : 0);

				container.each(function() {
					var _this = $(this),
						height = win.height() - h.outerHeight() - ah;
						
					_this.css('min-height',height);
					
				});
			}
		},
		carousel: {
			selector: '.slick',
			init: function(el) {
				var base = this,
					container = el ? el : $(base.selector);
				
				container.each(function() {
					var that = $(this),
						columns = that.data('columns'),
						navigation = (that.data('navigation') === true ? true : false),
						autoplay = (that.data('autoplay') === false ? false : true),
						pagination = (that.data('pagination') === true ? true : false),
						center = (that.data('center') ? that.data('center') : false),
						infinite = (that.data('infinite') ? that.data('infinite') : true),
						vertical = (that.data('vertical') ? that.data('vertical') : false),
						asNavFor = that.data('asnavfor'),
						rtl = body.hasClass('rtl');
					
					var args = {
						dots: pagination,
						arrows: navigation,
						infinite: infinite,
						speed: 1000,
						centerMode: center,
						slidesToShow: columns,
						slidesToScroll: 1,
						rtl: rtl,
						autoplay: autoplay,
						centerPadding: '50px',
						autoplaySpeed: 4000,
						pauseOnHover: true,
						vertical: vertical,
						verticalSwiping: vertical,
						accessibility: false,
						focusOnSelect: true,
						prevArrow: '<button type="button" class="slick-nav slick-prev">'+themeajax.left_arrow+'</button>',
						nextArrow: '<button type="button" class="slick-nav slick-next">'+themeajax.right_arrow+'</button>',
						responsive: [
							{
								breakpoint: 1025,
								settings: {
									slidesToShow: (columns < 3 ? columns : 3),
									centerPadding: '40px'
								}
							},
							{
								breakpoint: 780,
								settings: {
									slidesToShow: (columns < 2 ? columns : 2),
									centerPadding: '30px'
								}
							},
							{
								breakpoint: 640,
								settings: {
									slidesToShow: 1,
									centerPadding: '15px'
								}
							}
						]
					};
					if (asNavFor && $(asNavFor).is(':visible')) {
						args.asNavFor = asNavFor;	
					}
					if (that.hasClass('product-images') || that.data('fade')) {
						args.fade = true;
					}
					that.slick(args);
					
				});
			}
		},
		masonry: {
			selector: '.masonry',
			init: function() {
				var base = this,
				container = $(base.selector);
								
				container.each(function() {
					var that = $(this),
						el = that.children('.item'),
						org = [],
						page = 1;
					
					TweenLite.set(el, {opacity: 0, y:100});
					that.imagesLoaded(function() {
						that.isotope({
							itemSelector : '.item',
							transitionDuration : 0,
							masonry: {
								columnWidth: '.grid-sizer'
							}
						}).isotope( 'once', 'layoutComplete', function(i,l) {
							org = _.map(l, 'element');
						});
						that.isotope('layout');
						win.scroll(_.debounce(function(){
							if (that.is(':in-viewport')) {
								TweenMax.staggerTo(org, 1, { y: 0, opacity:1, ease: Quart.easeOut}, 0.25);
							}
						}, 50)).trigger('scroll');

					});
				});
			}
		},
		commentToggle: {
			selector: '.comment-button',
			init: function() {
				var base = this,
					container = $(base.selector),
					list = container.next('.commentlist_container');
				
				container.on('click', function() {
					if (container.hasClass('toggled')) {
						container.removeClass("toggled");
					} else {
						container.addClass("toggled");
					}
					return false;
				});
			},
			open: function() {
				var base = this,
					container = $(base.selector);
					
				container.addClass("toggled");
			}
		},
		shareArticleDetail: {
			selector: '.share-article, .share-article-loop',
			init: function() {
				var base = this,
					container = $(base.selector),
					social = container.find('.social');
				
				social.data('pin-no-hover', true);
				social.on('click', function() {
					var left = (screen.width/2)-(640/2),
							top = (screen.height/2)-(440/2)-100;
					window.open($(this).attr('href'), 'mywin', 'left='+left+',top='+top+',width=640,height=440,toolbar=0');
					return false;
				});
				container.find('.comment').on('click', function() {
					var comments = $(this).parents('.post-detail-row').find('#comments');
					if (comments.length) {
							var ah = $('#wpadminbar').outerHeight(),
									pos = comments.offset().top - 100 - ah;
						
						TweenMax.to(window, win.height() / 500, {
							scrollTo:{y:pos}, 
							ease:Quart.easeOut, 
							onComplete: function() {
								SITE.commentToggle.open();
								SITE.fixedPosition.init();
							}	
						});
						return false;
					} else {
						window.location = $(this).attr('href');
						return false;	
					}
				});
			}
		},
		skrollr: {
			selector: 'body',
			init: function() {
				var main = $('div[role="main"]');
				
				main.imagesLoaded({ background: true }, function() {
					window.skroller = skrollr.init({
						forceHeight: false,
						easing: 'outCubic',
						mobileCheck: function() {
							return false;
						}
					});
				});
			}
		},
		custom_scroll: {
			selector: '.custom_scroll',
			init: function() {
				var base = this,
					container = $(base.selector);
				
				container.each(function() {
					var _this = $(this);
					
					var newScroll = new IScroll('#'+_this.attr('id'), {
						scrollbars: true,
						mouseWheel: true,
						click: true,
						interactiveScrollbars: true,
						shrinkScrollbars: 'scale',
						fadeScrollbars: true
					});
					if (_this.attr('id') === 'menu-scroll') {
						window.menuscroll = newScroll;	
					}
					_this.on('touchmove', function (e) { e.preventDefault(); });
				});		 
				
			}
		},
		magnificImage: {
			selector: '[rel="mfp"], [rel="magnific"]',
			init: function() {
				var base = this,
						container = $(base.selector),
						stype;
				
				container.each(function() {
					if ($(this).hasClass('video')) {
						stype = 'iframe';
					} else {
						stype = 'image';
					}
					$(this).magnificPopup({
						type: stype,
						closeOnContentClick: true,
						fixedContentPos: true,
						closeBtnInside: false,
						closeMarkup: '<button title="%title%" class="mfp-close"><span>×</span> '+themeajax.l10n.close+'</button>',
						mainClass: 'mfp',
						removalDelay: 250,
						image: {
							verticalFit: true,
							titleSrc: function(item) {
								return item.el.attr('title');
							}
						}
					});
				});
	
			}
		},
		magnificInline: {
			selector: '[rel="inline"]',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				container.each(function() {
					var eclass = ($(this).data('class') ? $(this).data('class') : '');

					$(this).magnificPopup({
						type:'inline',
						midClick: true,
						mainClass: 'mfp ' + eclass,
						removalDelay: 250,
						alignTop: true,
						closeBtnInside: true,
						closeMarkup: '<button title="%title%" class="mfp-close"><span>×</span> '+themeajax.l10n.close+'</button>'
					});
				});
	
			}
		},
		magnificGallery: {
			selector: '[rel="gallery"]',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				container.each(function() {
					$(this).magnificPopup({
						delegate: 'a',
						type: 'image',
						closeOnContentClick: true,
						fixedContentPos: true,
						mainClass: 'mfp',
						removalDelay: 250,
						closeBtnInside: false,
						overflowY: 'scroll',
						closeMarkup: '<button title="%title%" class="mfp-close"><span>×</span> '+themeajax.l10n.close+'</button>',
						gallery: {
							enabled: true,
							navigateByImgClick: false,
							preload: [0,1] // Will preload 0 - before current, and 1 after the current image
						},
						image: {
							verticalFit: false,
							titleSrc: function(item) {
								return item.el.attr('title');
							}
						}
					});
				});
				
			}
		},
		lightboxGallery: {
			selector: '.gallery-link',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				container.each(function() {
					var _this = $(this),
						eclass = ($(this).data('class') ? $(this).data('class') : ''),
						items = [],
						target = $( _this.attr('href') );
						
					target.find('.post-gallery-content').each(function() {
						items.push({
							src: $(this) 
						});
					});
					
					_this.on('click', function() {
						$.magnificPopup.open({
							midClick: true,
							mainClass: 'mfp ' + eclass,
							alignTop: true,
							closeBtnInside: true,
							items: items,
							overflowY: 'hidden',
							gallery: {
								enabled: true
							},
							closeMarkup: '<button title="%title%" class="mfp-close"></button>',
							callbacks: {
								open: function() {
									$(".lightbox-close").on('click',function(){
										$.magnificPopup.instance.close();
										return false;           
									});
									$(".arrow.prev").on('click',function(){
										$.magnificPopup.instance.prev();
										return false;           
									});
									
									$(".arrow.next").on('click',function(){
										$.magnificPopup.instance.next();
										return false;
									});
								},
								close: function() {
									$(".arrow.prev").off('click');
									
									$(".arrow.next").off('click');
								}
							}
						});
						return false;
					});
					
				});
	
			}
		},
		overlay: {
			selector: '.panr',
			init: function(el) {
				var base = this,
					container = $(base.selector),
					target = el ? el.find(base.selector) : container;

				target.each(function() {
					var _this = $(this),
							img = _this.find('img');
					
					img.panr({ moveTarget: _this, scaleDuration: 1, sensitivity: 20, scaleTo: 1.1, panDuration: 2 });
				});
			}
		},
		atvImg: {
			selector: '.atvImg',
			init: function() {
				var base = this,
						container = $(base.selector);

				atvImg();
			}
		},
		articleScroll: {
			selector: '#infinite-article',
			pagetitle: $('#page-title'),
			org_post_url: window.location.href,
			org_post_title: document.title,
			init: function() {
				var base = this,
						container = $(base.selector),
						on = container.data('infinite'),
						org = container.find('.post-detail:first-child'),
						id = org.data('id'),
						tempid = id,
						thb_loading = false,
						footer = $('#footer').outerHeight() + $('#subfooter').outerHeight();
					
				var scrollLocation = _.debounce(function(){
						base.location_change();
					}, 10);
					
				var scrollAjax = _.debounce(function(){
					if (win.scrollTop() >= ($doc.height() - win.height() - footer - 200) && thb_loading === false) {
						container.addClass('thb-loading');
		
						if (id === tempid) {
							$.ajax( themeajax.url, {
								method : 'POST',
								data : {
									action : 'thb_infinite_ajax',
									post_id : tempid
								},
								beforeSend: function() {
									id = null;
									thb_loading = true;
								},
								success : function(data) {
									thb_loading = false;
									var d = $.parseHTML(data),
											ads = $(d).find('.adsbygoogle'),
											tweets = $(d).find('.twitter-tweet, .twitter-timeline');

									container.removeClass('thb-loading');
									
									if (d) {
										id = $(d).find('.post-detail').data('id');
										tempid = id;
										
										$(d).appendTo(container).hide().imagesLoaded(function() {
											$(d).show();
											SITE.carousel.init($(d).find('.slick'));
											SITE.fixedPosition.init($(d).find('.fixed-me'));
											window.skroller.refresh();
											SITE.shareArticleDetail.init();
											SITE.lightboxGallery.init();
											SITE.selectionShare.init();
											SITE.animation.init();
										});
										if (typeof window.twttr !== 'undefined') {
											twttr.widgets.load(
											  document.getElementById("infinite-article")
											);
										} else if (tweets.length && (typeof window.twttr === 'undefined')) {
											window.twttr = (function(d, s, id) {
												var js, fjs = d.getElementsByTagName(s)[0],
												  t = window.twttr || {};
												if (d.getElementById(id)) { return t; }
												js = d.createElement(s);
												js.id = id;
												js.src = "https://platform.twitter.com/widgets.js";
												fjs.parentNode.insertBefore(js, fjs);
												
												t._e = [];
												t.ready = function(f) {
												  t._e.push(f);
												};
												return t;
											}(document, "script", "twitter-wjs"));
										}
										if (typeof window.addthis !== 'undefined') {
											addthis.toolbox();	
										}
										if (typeof window.atnt !== 'undefined') {
											window.atnt();
										}
										if (typeof window.adsbygoogle !== 'undefined' && ads.length) {
											ads.each(function() {
												(adsbygoogle = window.adsbygoogle || []).push({});
											});
										}
										if (typeof (FB) !== 'undefined') {
											FB.init({ status: true, cookie: true, xfbml: true });
										}
										$(document.body).trigger('thb_after_infinite_load');
									} else {
										id = null;	
									}
								}
							});
						}
					}
				}, 50);
				
				if (on === 'on') {
					win.scroll(scrollLocation);
					win.scroll(scrollAjax);
				} else {
					win.scroll(function(){
							base.borderWidth($('.post-detail-row').offset().top, $('.post-detail-row').outerHeight(true));
					});
				}
			},
			location_change: function() {
				var base = this,
						container = $(base.selector);
					
				var windowTop           = win.scrollTop(),
						windowBottom        = windowTop + win.height(),
						windowSize          = windowBottom - windowTop,
						setsInView          = [],
						pageChangeThreshold = 0.5,
						post_title,
						post_url;
					
				$('.post-detail-row').each( function() {
					var _row = $(this),
							post = _row.find('.post-detail'),
							id				= post.data( 'id' ),
							setTop			= _row.offset().top,
							setHeight		= _row.outerHeight(true),
							setBottom		= 0,
							tmp_post_url	= post.data('url'),
							tmp_post_title	= post.find('.post-title h1').text();
					
					// Determine position of bottom of set by adding its height to the scroll position of its top.
					setBottom = setTop + setHeight;
					
					if ( setTop < windowTop && setBottom > windowBottom ) { // top of set is above window, bottom is below
						setsInView.push({'id': id, 'top': setTop, 'bottom': setBottom, 'post_url': tmp_post_url, 'post_title': tmp_post_title, 'alength' : setHeight });
					}
					else if( setTop > windowTop && setTop < windowBottom ) { // top of set is between top (gt) and bottom (lt)
						setsInView.push({'id': id, 'top': setTop, 'bottom': setBottom, 'post_url': tmp_post_url, 'post_title': tmp_post_title, 'alength' : setHeight });
					}
					else if( setBottom > windowTop && setBottom < windowBottom ) { // bottom of set is between top (gt) and bottom (lt)
						setsInView.push({'id': id, 'top': setTop, 'bottom': setBottom, 'post_url': tmp_post_url, 'post_title': tmp_post_title, 'alength' : setHeight });
					}
				});
				
				// Parse number of sets found in view in an attempt to update the URL to match the set that comprises the majority of the window
				if ( 0 === setsInView.length ) {
					post_url = base.org_post_url;
					post_title = base.org_post_title;
				} else if ( 1 === setsInView.length ) {
					var setData = setsInView.pop();
					
					post_url = setData.post_url;
					post_title = setData.post_title;
					
					base.borderWidth(setData.top, setData.alength);
				} else {
					post_url = setsInView[0].post_url;
					post_title = setsInView[0].post_title;
					base.borderWidth(setsInView[0].top, setsInView[0].alength);
				}
				
				base.updateURL(post_url, post_title);
			},
			updateURL : function(post_url, post_title) {
				if( window.location.href !== post_url ) {
		
					if ( post_url !== '' ) {
						history.replaceState( null, null, post_url );
						document.title = post_title;
						this.pagetitle.html(post_title);
					}
					this.updateGA(post_url);
				}
			},
			updateGA: function(post_url) {
				if( typeof _gaq !== 'undefined' ) {
					_gaq.push(['_trackPageview', post_url]);
				} else if ( typeof ga !== 'undefined' ) {
					var reg = /.+?\:\/\/.+?(\/.+?)(?:#|\?|$)/,
							pathname = reg.exec( post_url )[1];
							
					ga('send', 'pageview', pathname );
				}
				if ( typeof window.reinvigorate !== 'undefined' && typeof window.reinvigorate.ajax_track !== 'undefined' ) {
					reinvigorate.ajax_track(post_url);
				}
				if ( typeof googletag !== 'undefined' ) {
					googletag.pubads().refresh();	
				}
			},
			borderWidth : function(top, setHeight) {
				var windowTop = win.scrollTop(),
						perc = (windowTop - top + ($('.header.fixed').outerHeight() + $('#wpadminbar').outerHeight())) / setHeight;

				$('.progress', '.header').css({ width: perc*100 + '%' });
			}
		},
		videoPlaylist: {
			selector: '.video_playlist',
			init: function() {
				var base = this,
				container = $(base.selector);
								
				container.each(function() {
					var _this = $(this),
							video_area = _this.find('.video-side'),
							links = _this.find('.video_play');
					
					links.on('click', function() {
						var _that = $(this),
								url = _that.data('video-url'),
								id = _that.data('post-id');
								
						if (_that.hasClass('video-active')) {
							return false;	
						}
						_this.find('.video_play').removeClass('video-active');
						_this.find('.video_play[data-video-url="'+url+'"]').addClass('video-active');
						video_area.addClass('thb-loading');
						
						$.post( themeajax.url, {
							action: 'thb-parse-embed',
							post_ID: id,
							shortcode : '[embed]'+url+'[/embed]'
						}, function(d){
							if (d.success) {
								video_area.html(d.data.body);
							}
							video_area.removeClass('thb-loading');
						});
						return false;
					});
				});
			}
		},
		postGridAjaxify: {
			selector: '.ajaxify-pagination',
			init: function() {
				var base = this,
						container = $(base.selector),
						_this = container;
				
				// Initialized
				_this.data('initialized', true);
				// Prepare our Variables
				var History = window.History,
						document = window.document;
			
				// Check to see if History.js is enabled for our Browser
				if ( !History.enabled ) { 
					return false; 
				}

				var contentNode = _this.get(0),
						/* Application Generic Variables */
						$body = $(document.body),
						rootUrl = History.getRootUrl();
		
				// Ensure Content
				if ( _this.length === 0 ) { _this = $body; }
		
				// HTML Helper
				var documentHtml = function(html){
					// Prepare
					// replaces doctype, html head body tags with div
					var result = String(html).replace(/<\!DOCTYPE[^>]*>/i, '')
												.replace(/<(html|head|body|title|script)([\s\>])/gi,'<div id="document-$1"$2')
												.replace(/<\/(html|head|body|title|script)\>/gi,'</div>');
					// Return
					return result;
				};
		
				// Ajaxify Helper
				$.fn.ajaxify = _.debounce(function(){
					// Prepare
					var $_this = $(this);
					
					// Ajaxify
					$_this.find('.page-numbers').on('click',function(e){

						// Prepare
						var $_this	= $(this),
								url = $_this.attr('href'),
								title = $_this.attr('title') || null;
		
						// Continue as normal for cmd clicks etc
						if ( e.which === 2 || e.metaKey ) { return true; }
		
						// Ajaxify this link
						History.pushState(null,title,url);
						e.preventDefault();
						return false;
					});
					// Chain
					return $_this;
				}, 50);
		
				// Ajaxify our Internal Links
				_this.ajaxify();
				
				// Hook into State Changes
				$(window).bind('statechange',function(){
					// Prepare Variables
					var State = History.getState(),
							url = State.url,
							relativeUrl = url.replace(rootUrl,''),
							a = $('#wpadminbar'),
							ah = (a ? a.outerHeight() : 0);
							
					// Start Fade Out
					// Animating to opacity to 0 still keeps the element's height intact
					// Which prevents that annoying pop bang issue when loading in new content
					// Let's add some cool animation here
		
					_this.addClass('thb-loading');
					jQuery('html, body').animate({
						scrollTop: _this.offset().top - ah - 30
					}, 800);
		
		
					// Ajax Request the Traditional Page
					$.ajax({
						url: url,
						success: function(data, textStatus, jqXHR){
							// Prepare
							var $data = $(documentHtml(data)),
									$dataBody = $data.find(base.selector),
									contentHtml = $dataBody.html() || $data.html();

							if ( !contentHtml ) {
								document.location.href = url;
								return false;
							}
							// Update the content
							_this.stop(true,true);
							_this.html(contentHtml)
									.ajaxify()
									.animate({'opacity': 1}, 500, 'linear', function() {
										_this.removeClass('thb-loading');
									}); 
							
							
							// Update the title
							document.title = $data.find('#document-title:first').text();			
		
							// Inform Google Analytics of the change
							if ( typeof window.pageTracker !== 'undefined' ) { 
								window.pageTracker._trackPageview(relativeUrl); 
							}
		
							// Inform ReInvigorate of a state change
							if ( typeof window.reinvigorate !== 'undefined' && typeof window.reinvigorate.ajax_track !== 'undefined' ) {
								reinvigorate.ajax_track(url);// ^ we use the full url here as that is what reinvigorate supports
							}
						},
						error: function(jqXHR, textStatus, errorThrown){
							document.location.href = url;
							return false;
						}
		
					}); // end ajax
		
				}); // end onStateChange
			}
		},
		selectionShare: {
			selector: '.thb-selectionSharer',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				$('.post-content *').thbSelectionSharer();
			}
		},
		writeFirst: {
			selector: '.write_first',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				container.on('click', function() {
					var pos = $('.woocommerce-tabs').offset().top - $('#wpadminbar').outerHeight() - $('.header.fixed').outerHeight();
					$('.reviews_tab a').trigger('click');
					TweenMax.to(window, win.height() / 500, {scrollTo:{y:pos}, ease:Quart.easeOut});
					return false;
				});
			}
		},
		contact: {
			selector: '.contact_map',
			init: function() {
				var base = this,
					container = $(base.selector);
				
				container.each(function() {
					var _this = $(this),
						mapzoom = _this.data('map-zoom'),
						mapstyle = _this.data('map-style'),
						mapType = _this.data('map-type'),
						panControl = _this.data('pan-control'),
						zoomControl = _this.data('zoom-control'),
						mapTypeControl = _this.data('maptype-control'),
						scaleControl = _this.data('scale-control'),
						streetViewControl = _this.data('streetview-control'),
						locations = _this.find('.thb-location'),
						once;
						
					var bounds = new google.maps.LatLngBounds();
					
					var mapOptions = {
						center: {
							lat: -34.397,
							lng: 150.644
						},
						styles: mapstyle,
						zoom: mapzoom,
						draggable: !("ontouchend" in document),
						scrollwheel: false,
						panControl: panControl,
						zoomControl: zoomControl,
						mapTypeControl: mapTypeControl,
						scaleControl: scaleControl,
						streetViewControl: streetViewControl,
						mapTypeId: mapType
					};

					var map = new google.maps.Map(_this[0], mapOptions);
					
					map.addListener('tilesloaded', function() {
						if (!once) {
							locations.each(function(i) {
								var location = $(this),
										options = location.data('option'),
										lat = options.latitude,
										long = options.longitude,
										latlng = new google.maps.LatLng(lat, long),
										marker = options.marker_image,
										marker_size = options.marker_size,
										retina = options.retina_marker,
										title = options.marker_title,
										desc = options.marker_description,
										pinimageLoad = new Image();
								
								bounds.extend(latlng);
								
								pinimageLoad.src = marker;
								
								$(pinimageLoad).on('load', function(){
									base.setMarkers(i, locations.length, map, lat, long, marker, marker_size, title, desc, retina);
								});
									once = true;
							});
							
							if(mapzoom > 0) {
								map.setCenter(bounds.getCenter());
								map.setZoom(mapzoom);
							} else {
								map.setCenter(bounds.getCenter());
								map.fitBounds(bounds);
							}
						}
					});
					
					win.on('resize', _.debounce(function(){
						map.setCenter(bounds.getCenter());
					}, 50) );
				});
			},
			setMarkers: function(i, count, map, lat, long, marker, marker_size, title, desc, retina) {
				
				function showPin (i) {

					var markerExt = marker.toLowerCase().split('.');
							markerExt = markerExt[markerExt.length - 1];
					
					if($.inArray(markerExt, ['svg']) || retina ) {
						 marker = new google.maps.MarkerImage(marker, null, null, null, new google.maps.Size(marker_size[0]/2, marker_size[1]/2));
					}
					var g_marker = new google.maps.Marker({
								position: new google.maps.LatLng(lat,long),
								map: map,
								animation: google.maps.Animation.DROP,
								icon: marker,
								optimized: false
							}),
							contentString = '<h3>'+title+'</h3>'+'<div>'+desc+'</div>';
					
					// info windows 
					var infowindow = new google.maps.InfoWindow({
							content: contentString
					});
					
					g_marker.addListener('click', function() {
				    infowindow.open(map, g_marker);
				  });
				}
				setTimeout(showPin, i * 250, i);
			}
		},
		fixedPosition: {
			selector: '.fixed-me',
			init: function(el) {
				var base = this,
					container = el ? el : $(base.selector),
					a = $('#wpadminbar'),
					ah = (a ? a.outerHeight() : 0);
				
				container.each(function() {
					var _this = $(this),
							off = $('.header.fixed').outerHeight() + 20;
					
					_this.after('<div class="sticky-content-spacer"/>');
					_this.stick_in_parent({
						offset_top: off + ah,
						spacer: '.sticky-content-spacer'
					});
						
				});
				
				win.resize(_.debounce(function(){
					$(document.body).trigger("sticky_kit:recalc");
				}, 10));
				win.scroll(_.debounce(function(){
					$(document.body).trigger("sticky_kit:recalc");
				}, 50));
			}
		},
		animation: {
			selector: '.animation',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				base.control(container);
				
				win.scroll(function(){
					base.control(container);
				});
			},
			control: function(element) {
				var t = -1;

				element.filter(':in-viewport').each(function () {
					var that = $(this);
						t++;
					
					setTimeout(function () {
						that.addClass("animate");
					}, 200 * t);
					
				});
			}
		},
		newsletter: {
			selector: '.newsletter-form',
			init: function() {
				var base = this,
					container = $(base.selector);
				
				container.submit(function() {	
					container.next('.result').load(body.data('themeurl')+'/inc/subscribe_save.php', {email: container.find('.widget_subscribe').val()},
					function() {
						$(this).fadeIn(200).delay(3000).fadeOut(200);
					});
					return false;
				});
			}
		},
		toTop: {
			selector: '#scroll_totop',
			init: function() {
				var base = this,
					container = $(base.selector);
				
				container.on('click', function(){
					TweenMax.to(window, 1, {scrollTo:{y:0}, ease:Quart.easeOut});
					return false;
				});
				win.scroll(_.debounce(function(){
					base.control();
				}, 50));
			},
			control: function() {
				var base = this,
					container = $(base.selector);
					
				if (win.scrollTop() > 300) {
					TweenMax.to(container, 0.2, { autoAlpha:1, ease: Quart.easeOut });
				} else {
					TweenMax.to(container, 0.2, { autoAlpha:0, ease: Quart.easeOut });
				}
			}
		},
		quantity: {
			selector: '.quantity',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				// Quantity buttons
				$( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<input type="button" value="+" class="plus" />' ).prepend( '<input type="button" value="-" class="minus" />' );
			
				$doc.on( 'click', '.plus, .minus', function() {
			
					// Get values
					var $qty		= $( this ).closest( '.quantity' ).find( '.qty' ),
						currentVal	= parseFloat( $qty.val() ),
						max			= parseFloat( $qty.attr( 'max' ) ),
						min			= parseFloat( $qty.attr( 'min' ) ),
						step		= $qty.attr( 'step' );
			
					// Format values
					if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) { currentVal = 0; }
					if ( max === '' || max === 'NaN' ) { max = ''; }
					if ( min === '' || min === 'NaN' ) { min = 0; }
					if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) { step = 1; }
			
					// Change the value
					if ( $( this ).is( '.plus' ) ) {
			
						if ( max && ( max === currentVal || currentVal > max ) ) {
							$qty.val( max );
						} else {
							$qty.val( currentVal + parseFloat( step ) );
						}
			
					} else {
			
						if ( min && ( min === currentVal || currentVal < min ) ) {
							$qty.val( min );
						} else if ( currentVal > 0 ) {
							$qty.val( currentVal - parseFloat( step ) );
						}
			
					}
			
					// Trigger change event
					$qty.trigger( 'change' );
			
				});
			}	
		},
		updateCart: {
			selector: '.quick_cart',
			init: function() {
				var base = this,
					container = $(base.selector);
				body.bind('added_to_cart', SITE.updateCart.update_cart_dropdown);
			},
			update_cart_dropdown: function(event) {
				if (body.hasClass('woocommerce-cart')) {
					location.reload();	
				} else {
					$('.quick_cart').trigger('click');
				}
			}
		},
		shop: {
			selector: '.products .product',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				container.each(function() {
					var that = $(this);
					
					that
					.find('.add_to_cart_button').on('click', function() {
						if ($(this).data('added-text') !== '') {
							$(this).text($(this).data('added-text'));
						}
						
					});
					
				}); // each
	
			}
		},
		variations: {
			selector: '.variations_form input[name=variation_id]',
			init: function() {
				var base = this,
					container = $(base.selector),
					org = $('.single-price.single_variation').html();
				
				container.on('change', function() {
					var that = $(this),
						val = that.val(),
						phtml,
						images = $('#product-images');

					setTimeout(function(){
						if (val) {
							phtml = that.parents('.variations_form').find('.single_variation span.price').html();
						} else {
							phtml = org;	
						}
						$('.price.single_variation').html(phtml);
					}, 100);
					
					if ($('.variations_form').length) {
						var variations = [],
								values;
						
						$('.variations_form').find('select').each(function(){
							variations.push(this.value);
						});
						values = variations.join(",");
						if ($('.variations_form').find('select').length) {
							var v = ($('.variations_form select option:selected').val()),
									i = images.find('figure[data-variation*="'+values+'"]').data('slick-index');

							if (v) {
								images.slick('slickGoTo', i);
							}
						}
					}
				});
			}
		},
		reviews: {
			selector: '#respond',
			init: function() {
				var base = this,
						container = $(base.selector);

				container.on( 'click', 'p.stars a', function(){
					var that = $(this);
					
					setTimeout(function(){ that.prevAll().addClass('active'); }, 10);
				});
			}
		},
		login_register: {
			selector: '#customer_login',
			init: function() {
				
				var create = $('#create-account'),
						login = $('#login-account');
				
				
				create.on('click', function() {
						TweenMax.fromTo($('.login-container'), 0.2, {opacity:1, display:'block', y: 0}, {opacity:0,display:'none', y: 50, onComplete: function() { 
								TweenMax.fromTo($('.register-container'), 0.2, {opacity:0, display:'none', y:50}, {opacity:1,display:'block', y: 0});
							}
						});
						return false;
				});
				
				login.on('click', function() {
						TweenMax.fromTo($('.register-container'), 0.2, {opacity:1, display:'block', y: 0}, {opacity:0,display:'none', y: 50,
							onComplete: function() { 
								TweenMax.fromTo($('.login-container'), 0.2, {opacity:0, display:'none', y: 50}, {opacity:1,display:'block', y: 0});
							}	
						});
						
						return false;
				});
			}
		}
	};
	
	$doc.ready(function() {
		SITE.init();
	});

})(jQuery, this, _);