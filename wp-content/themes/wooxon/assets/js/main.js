/* --------- wooxon Main.js ------------- */
(function ($) {
	"use strict";
	var wooxon = {
		initialised: false,
		mobile: false,
		container : $('#portfolio-item-container'),
		blogContainer : $('#masonry-grid'),
		productsContainer: $('.piko-masonry'),
		init: function () {

			if(!this.initialised) {
				this.initialised = true;
			} else {
				return;
			}
			// Call wooxon Functions
			this.checkMobile();
            this.preLoader(); 
            this.preLoader_slide();
			this.intCurrency();
			this.loadfilter();
			this.initCarousel();
			this.productHeight();
			this.wcQuantityAdjust();
			this.pikoDropdown();
			this.productCountdown();
			this.quickView();
			this.wishlist();
            this.compare();
			this.init_imageZoom();
			this.init_magnificPopup();
			this.init_magnificVideo();
			this.ajax_return();
			this.scrollToTop();			
			this.scrollTo();
			this.vs_init();
			this.categoriesAccordion();
            this.ajaxSearch();
            this.initMasonry();
            this.init_AjaxLoad();
            this.ajaxLogin();
            this.postLove();	
            this.notification();
			if ( $.fn.stick_in_parent) {
				this.parent_content_sticky();
			}
			var self = this;
                self.$window = $(window);
                self.$document = $(document);
                        
			if ( typeof imagesLoaded === 'function' ) {
				imagesLoaded(self.container, function() {
					self.isotopeActivate();
					self.isotopeFilter();
				});
				// Blog Masonry
				imagesLoaded(self.blogContainer, function() {
					self.blogMasonry();
				});
				// Porudcts Masonry
				imagesLoaded(self.productsContainer, function() {
					self.productsMasonry();
				});
			}

		},
                loadfilter: function() {
                    $( '.widget_layered_nav' ).each( function() {
                            var $this = $(this);
                            var plusIcon = wooxon_global_message.global.more;
                            var minusIcon = wooxon_global_message.global.less;                            
                            var openerHTML = '<div class="open-this f_s14 c_s3">'+plusIcon+'</div>';                             
                              
                            if ( $this.find('li:eq(5)').length){
                                 $this.append(openerHTML);
                            }
                            $this.find('ul li:nth-child(n+6)').addClass('dn');
                            $this.find('.open-this').on( 'click', function() {
                                if($(this).parent().hasClass('opened')) {
                                    $(this).html(plusIcon).parent().removeClass('opened').find('> ul .dn').slideUp(200).css('display', 'flex');
                                }else {
                                    $(this).html(minusIcon).parent().addClass('opened').find('> ul .dn').slideDown(200).css('display', 'flex');
                                }
                            });                            
                            
                    });
                    
                },
                intCurrency: function() {
                    $( '.currency-name' ).on( 'click', function() {
                            var currency = $( this ).data( 'currency' );
                            Cookies.set('piko_currency', currency, { expires: 1, path: '/' } );
                            location.reload();
                    });
                },
                // Init slick carousel
                initCarousel: function() {
                    var is_rtl = $('body,html').hasClass('rtl');
                    if ( is_rtl ) { is_rtl: true;
                    }else{ is_rtl: false; }
                    
                    $( '.piko-carousel' ).not( '.slick-initialized' ).slick({rtl: is_rtl });                    
                    $( '.piko-carousel1' ).slick({rtl: is_rtl }); //nested slick 
                },                
                productHeight: function() {
                    $( '.piko-carousel .product' ).each( function() {
                            var $this = $(this);    
                            var $product = $this.outerWidth();                            
                            $( this ).imagesLoaded( function() {
                                    if ( 0 != $this.height() ){
                                        $this.height( $this.height() );
                                    }
                                });
                            
                            
                    });
                },
                preLoader : function() {                    
                    var preloader = wooxon_global_message.preloader == '1' ? true : false;
                    if (!preloader) return this;
                    /* preloader*/
                    setTimeout(function() {
                        $('#site-loading').fadeOut(300).hide();
                    }, 300);
                },
                preLoader_slide : function() {
                    var preloader = wooxon_global_message.preloader == '1' ? true : false;
                    if (!preloader) return this;
                    /* preloader*/
                    
                    if ( wooxon_global_message.preloader_slide === 'slide' ) {
                        $('.site-mask').addClass('fade_in').removeClass('fade_out');
                        $('#site-loading-slide .proggress').addClass('hidden');
                        NProgress.done();
                    }
                },
                // Initialize WC quantity adjust.
                wcQuantityAdjust: function() {
                        $( 'body' ).on( 'click', '.quantity .plus', function( e ) {
                                var $input    = $( this ).parent().parent().find( 'input.input-text' ),
                                        $quantity = parseInt( $input.attr( 'max' ) ),
                                        $step     = parseInt( $input.attr( 'step' ) ),
                                        $val      = parseInt( $input.val() ),
                                        $button = $( this ).parent().parent().next().next();

                                if ( ( $quantity !== '' ) && ( $quantity <= $val + $step ) ) {
                                        $( '.quantity .plus' ).css( 'pointer-events', 'none' );
                                }

                                $input.val( $val + $step );

                                $input.trigger( 'change' );
                        });
                        $( 'body' ).on( 'click', '.quantity .minus', function( e ) {
                                var $input  = $( this ).parent().parent().find( 'input.input-text' ),
                                        $step   = parseInt( $input.attr( 'step' ) ),
                                        $val    = parseInt( $input.val() ) - $step,
                                        $button = $( this ).parent().parent().next();

                                if ( $val < $step ) $val = $step;
                                $input.val( $val );

                                $( '.quantity .plus' ).removeAttr( 'style' );

                                $input.trigger( 'change' );
                        });
                        
                        
                         $('.wc-tabs li a').on( 'click', function(){ //fix slick slider single page
                                var $tab          = $( this );
                                var $tabs_wrapper = $tab.closest( '.wc-tabs-wrapper, .woocommerce-tabs' );
                                $tabs_wrapper.find( $tab.attr( 'href' ) ).addClass('active').siblings('div').removeClass('active');
                        } );
                        
                        if ( $( '.sticky .woocommerce-product-gallery__image' ).length > 0 ) {
                                var img = $( '.sticky .woocommerce-product-gallery__image' );
                                img.zoom({
                                        touch: false
                                });
                        }
                        
                        
                },
		checkMobile: function () {
			/* Mobile Detect*/
			if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test( navigator.userAgent ) ) {
				this.mobile = true;
			} else {
				this.mobile = false;
			}
		},
                pikoDropdown: function(){                   
                    
                     //menu action button
                    $('.header-actions .ul-no > li > a').on( 'click', function(e){
                        if ( $('.piko-dropdown').is(':visible') ) {
                            $(this).closest('li').toggleClass('open').siblings('li').removeClass('open');                           
                        }                        
                        $('body').on( 'click', function(event) {
                            if ( $(event.target).closest('.open').find('.piko-dropdown').length ) return;                           
                            $('.piko-dropdown').closest('.open').removeClass('open');
                        });                        
                    });
                   
                    
                },
                categoriesAccordion: function() {                  
                    
                    $('.filter-trigger').on('click', function() { //filter widgets                      
                        if($(this).hasClass('opened')) {
                            $(this).removeClass('opened').children().removeClass('icon-cross1').addClass('fa fa-sliders');
                            $(this).closest('.woocommerce-toolbar').find('.filter-sidebar').slideUp(200);
                        }else {
                            $(this).addClass('opened').children().addClass('icon-cross1').removeClass('fa fa-sliders');
                            $(this).closest('.woocommerce-toolbar').find('.filter-sidebar').slideDown(200);
                        }
                    });                    
                    
                    //  Categories Accordion
                    $.fn.AccordionCat = function ( options ) {                        
                        var $this = $(this);

                        var plusIcon = '<span class="fa fa-angle-down"></span>';
                        var minusIcon = '<span class="fa fa-angle-up"></span>';
                       
                        $this.addClass('with-accordion');
                        var openerHTML = '<div class="open-this">'+plusIcon+'</div>';

                        $this.find('.product_cat').has('ul').has('li').prepend(openerHTML);
                        $this.find('.cat-parent,.cat-item,.menu-item,.page_item').has('.children, .nav-sublist-dropdown,.sub-menu').has('li').prepend(openerHTML);
                        $this.find('.open-this').on('click', function() {
                            if($(this).parent().hasClass('opened')) {
                                $(this).html(plusIcon).parent().removeClass('opened').find('> ul, > div.nav-sublist-dropdown').slideUp(200);
                            }else {
                                $(this).html(minusIcon).parent().addClass('opened').find('> ul, > div.nav-sublist-dropdown').slideDown(200);
                            }
                        });

                        return this;
                    }
                    
                    $('.product-categories,.widget_categories,.widget_nav_menu,.widget_pages').AccordionCat();                    
                },                
		productCountdown: function () {
			// onsale product and comging soon
                      if($('.countdown-lastest, .count-down-time').length >0){
                          $('.countdown-lastest, .count-down-time').each(function() {
                              var austDay = new Date($(this).data('y'),$(this).data('m') - 1,$(this).data('d'),$(this).data('h'),$(this).data('i'),$(this).data('s'));
                              $(this).countdown({
                                  until: austDay,
                                  layout: '<span class="countdown-row"><span class="countdown-section"><span class="countdown-amount">{dnn}</span><span class="countdown-period">'+wooxon_global_message.global.days+'</span></span><span class="countdown-section"><span class="countdown-amount">{hnn}</span><span class="countdown-period">'+wooxon_global_message.global.hours+'</span></span><span class="countdown-section"><span class="countdown-amount">{mnn}</span><span class="countdown-period">'+wooxon_global_message.global.minutes+'</span></span><span class="countdown-section"><span class="countdown-amount">{snn}</span><span class="countdown-period">'+wooxon_global_message.global.seconds+'</span></span></span>'
                              });
                          });
                      }
		},				
		scrollBtnAppear: function () {
	        if ( $(window).scrollTop() >= 400 ) {
	            $('.scroll-top').addClass('fixed');
	        } else {
	            $('.scroll-top').removeClass('fixed');
	        }
		},
                parent_content_sticky: function () {                    
                    if ( $( '.sidebar-sticky, .sticky .product-details' ).length > 0 ) {
                            $( '.sidebar-sticky, .sticky .product-details' ).stick_in_parent();
                    }
		},
                news_popup: function() {                    
                    if (wooxon_global_message.popup == 0)
                        return this;
                    
                    var setTime = wooxon_global_message.setTime;
                    window.setInterval(function(){
                        var popup_closed = Cookies.set('piko_popup_closed');
                        var news = $('#newsletterModal');

                        $('#newsletterModal .pop-close').on('click', function() {
                           if($('#showagain:checked').val() == 'do-not-show')
                                Cookies.set('piko_popup_closed', 'do-not-show', { expires: 1, path: '/' } 
                            );
                            $('#newsletterModal .mfp-close').trigger('click');
                        })
                        if(popup_closed != 'do-not-show' && $('body').hasClass('open-popup')) {
                            if (news.length) {
                                $.magnificPopup.open({
                                    items: {
                                        src: '#newsletterModal'
                                    },
                                    type: 'inline'
                                });
                            }
                        }
                    }, setTime);                    
                }, 
		scrollToTop: function () {
			$('.scroll-top').on('click', function(e) {
		        $('html, body').animate({
			            'scrollTop': 0
		        }, 1200);
				e.preventDefault();
			});
                        //footer parallux
                        $(window).scroll(function () {
                            if ($(window).scrollTop() > 150) {
                                $(".has-footer-parallax").addClass("fp_show");            
                            } else {
                                $(".has-footer-parallax").removeClass("fp_show");
                            }
                        }); 
		},
		scrollTo: function () {
			$('.scrollto, .woocommerce-review-link').on('click', function(e) {
				var offset = $(this).data('offset'),
					targetId = $(this).attr('href'),
					target = $(targetId),
					targetPos = offset ? ( target.offset().top + offset ) : target.offset().top;

		        $('html, body').animate({
		            'scrollTop': targetPos
		        }, 1200);
		        e.preventDefault();
		    });
		},               
                init_imageZoom : function() {
                        if ( $( '.piko-image-zoom' ).length > 0 ) {
                            var img = $( '.piko-image-zoom' ).each(function(index, el){
                                    $(el).zoom({
                                            touch: false
                                    });
                            });
                        }
                },
                init_magnificPopup:function() {
                        if ( $( '.piko-lightbox-img' ).length > 0 ) {
                                $( '.piko-lightbox-img' ).magnificPopup({                                        
                                        type: 'image',
                                        delegate: 'a',
                                        gallery: {
                                          enabled: true
                                        },
                                        image: {
                                                verticalFit: true
                                        },
                                        mainClass: 'mfp-fade',
                                        removalDelay: 800,
                                        callbacks: {
                                                beforeOpen: function() {
                                                        $( '#site-loading' ).fadeIn(100);
                                                },
                                                open: function() {
                                                       $( '#site-loading' ).fadeOut(100);
                                                },
                                        }
                                });
                        }
                        if ( $( '.piko-lightbox-single' ).length > 0 ) {
                                $( '.piko-lightbox-single' ).magnificPopup({
                                        type: 'image',
                                        image: {
                                                verticalFit: true
                                        },
                                        mainClass: 'mfp-fade',
                                        removalDelay: 800,
                                });
                        } 
                },
                init_magnificVideo : function() {
                        if ( $( '.piko-video' ).length > 0 ) {
                                $( '.piko-embed' ).magnificPopup({
                                        disableOn: 0,
                                        type: 'iframe',                                        
                                        iframe: {
                                            patterns: {
                                                youtube: {
                                                  index: 'youtube.com/',
                                                  id: 'v=',
                                                  src: '//www.youtube.com/embed/%id%?autoplay=1'
                                                },
                                                vimeo: {
                                                  index: 'vimeo.com/',
                                                  id: '/',
                                                  src: '//player.vimeo.com/video/%id%?autoplay=1'
                                                }
                                            },
                                            srcAction: 'iframe_src'
                                        }
                                });

                                $( '.piko-mp4' ).magnificPopup({
                                        disableOn: 0,
                                        type: 'inline',
                                });
                        }
                },
                ajax_return: function() {
                     $( '.return-policy' ).on('click', function(e) {
                        $( '#site-loading' ).fadeIn(100);
                        var data = { action: 'piko_shipping_terms' }

                        $.post( pikoAjax.ajaxurl, data, function( response ) {
                                $.magnificPopup.open({
                                        items: {
                                                src: response
                                        },
                                });
                                $( '#site-loading' ).fadeOut(100);
                            });
                            e.preventDefault();
                            e.stopPropagation();
                    });
                },
                vs_init: function(e) {  //vs update images                
                   
                    $( document.body ).on( 'vs_update_galllery',function(event,data){
                            var data_html = data.html;
                            var productId = data.productId;

                            $( '#product-' + productId + ' .piko-product-imges' ).html( data_html );

                            setTimeout(function() {
                                    wooxon.initCarousel();
                                    wooxon.init_imageZoom();
                            }, 10 );
                    });
            
                    $( '.vs_product_list a' ).on('click', function() {
                            var src = $( this ).data( 'thumb' );
                            if ( src != '' ) {
                                    $( this ).closest( '.product' ).find( 'img.attachment-shop_catalog, img.attachment-shop_single' ).first().attr( 'src', src );
                                    $( this ).closest( '.product' ).find( 'img.attachment-shop_catalog, img.attachment-shop_single' ).first().attr( 'srcset', src );
                            }
                            $(this).parent('li').addClass('open').siblings('li').removeClass('open');
                    });
                },						
		isotopeActivate: function() {
			// Trigger for isotope plugin
			if ( $.fn.isotope ) {
				var container = this.container,
					layoutMode = container.data('layoutmode');

				container.isotope({
                	itemSelector: '.portfolio-item',
                	layoutMode: (layoutMode) ? layoutMode : 'masonry',
                	percentPosition: true,
                	cellsByRow: {
						columnWidth: '.grid-sizer',
						rowHeight: '.grid-sizer'
					}
            	});
			}
		},
		isotopeFilter: function () {
			// Isotope plugin filter handle
			var self = this,
				filterContainer = $('#portfolio-filter');

			filterContainer.find('a').on('click', function(e) {
				var $this = $(this),
					selector = $this.attr('data-filter');

				filterContainer.find('.active').removeClass('active');

				// And filter now
				self.container.isotope({
					filter: selector,
					transitionDuration: '0.8s'
				});
				
				$this.closest('li').addClass('active');
				e.preventDefault();
			});
		},
		blogMasonry: function() {
			// Trigger for isotope plugin
			if ( $.fn.isotope ) {
				var blogContainer = this.blogContainer;

				blogContainer.isotope({
                	itemSelector: '.entry-grid',
                	layoutMode: 'masonry'
            	});
			}
		},
		productsMasonry: function() {
			// Trigger for isotope plugin
			if ( $.fn.isotope ) {
				var productsContainer = this.productsContainer,
					layoutMode = productsContainer.data('layoutmode');

				productsContainer.isotope({
                                    itemSelector: '.product',
                                    layoutMode: (layoutMode) ? layoutMode : 'masonry'
                            });
			}
		},
		isotopeReinit: function (container) {
			// Recall for isotope plugin
			if ( $.fn.isotope ) {
				this.productsContainer.isotope('destroy');
				this.productsMasonry();
			}
		},             
               ajaxSearch: function() {
                   
                var form = $('.piko-ajax-search-form input[type="text"]'),
                    request = false;

                form.keyup(function(e) {

                    var thisForm = $(this).parents('.piko-ajax-search-form'),
                        results = thisForm.find('.piko-ajax-results'),
                        s = thisForm.find('input[type="text"]').val();

                    if(s.length < 1) {
                        results.html('').hide();
                        return;
                    }

                    var cat = form.find( '.chosen-container .chosen-drop li.result-selected').data('option-array-index');

                    request && request.abort();

                    request = $.ajax({
                        url: pikoAjax.ajaxurl,
                        method: 'POST',
                        data: {
                            'action': 'wooxon_ajax_search',
                            's': s,
                            'cat' : cat
                        },
                        dataType: 'json',
                        beforeSend: function() {                            
                            thisForm.addClass('piko-ajax-in-action');
                            thisForm.removeClass('icon-fix');
                            $('.loading').addClass('open').show();
                            results.hide();
                        },
                        complete: function() {
                            thisForm.removeClass('piko-ajax-in-action');
                            $('.loading').removeClass('open').hide();
                        },
                        success: function(response){
                            results.html(response.html).show();
                        },
                        error: function() {                          
                        }
                    });

                    $('body').on('click', function(event) {
                        if ( ! $(event.target).is('.search-form-wrapper') && $(event.target).closest('.search-form-wrapper').length ) return;
                        thisForm.addClass('icon-fix');
                        results.hide();
                    });

                });
                
                var h_s = $( '#header-search-form' );
                var h_m = $( '.main-menu-wrap' );
                $('.search-button').on('click', function(e){
                    if ( h_s.is(':hidden') ) {
                        h_s.fadeIn(100).addClass('showing').removeClass('just-hidden');
                        h_m.hide(); 
                        
                    }
                    e.preventDefault();
                });
                 $('#header-search-form .button').on('click', function(e){
                    h_s.fadeOut(0).removeClass('showing').addClass('just-hidden');
                    h_m.show();
                    e.preventDefault();
                });                
            },
        initMasonry : function() {
		var pikoMasonry = $( '.piko-masonry' );
		var pikoSlick_tab = $( '.piko-tab-slide .piko-carousel article' );
		pikoMasonry.each( function( i, val ) {
                    var $val = $( val );
			var _layout = $( this ).data( 'masonry' );
                        var _filter = _layout.filter;
			if ( _layout !== undefined ) {
				var _selector = _layout.selector,
					_width    = _layout.columnWidth,
					_layout   = _layout.layoutMode;
				$( this ).imagesLoaded( function() {
					$( val ).isotope( {
						layoutMode : _layout,
						itemSelector: _selector,
						percentPosition: true,
						filter: _filter,
						masonry: {
							columnWidth: _width
						}
					} );
				});
				$( val ).parents('div').prev('.piko-filter').find('a').on('click',  function() {
                                         var selector = $( this ).attr('data-filter');
						parent   = $( this ).parents( '.piko-filter' );

					$( val ).isotope({ filter: selector });

					//if already active tab don't run 
					if ( $( this ).hasClass( 'active' ) ) {
						return false;
					}
					parent.find( '.active' ).removeClass( 'active' );
					$( this ).addClass( 'active' );
                                        return false;
				});
			}
		});
                pikoSlick_tab.each( function( i, val ) { //when carousel
                    var _layout_tab = $( this ).data( 'slick-tab' );
                    var _layout_filter = $( this ).closest('.piko-carousel').parents('div').prev('.piko-filter').data( 'tab-ids' );
                    $( this ).closest('.piko-carousel').addClass(_layout_tab);
                    $( this ).closest('.piko-carousel:first-child').addClass('active');
                    $( this ).closest('.piko-carousel').parents('div').prev('.piko-filter').addClass(_layout_filter);

                        $('.'+_layout_filter).find('a').on('click',  function() {
                              var selector = $( this ).attr('data-filter');
                              parent   = $( this ).parents( '.piko-filter' );
                              
                           $(".piko-carousel."+selector).addClass('active').siblings('.piko-carousel').removeClass('active');
                           
                            //if already active tab don't run 
                            if ( $( this ).hasClass( 'active' ) ) {
                                    return false;
                            }
                            parent.find( '.active' ).removeClass( 'active' );
                            $( this ).addClass( 'active' );
                            return false;
                    });            
                    
                });
                
	},             
	init_AjaxLoad : function() { // init ajax product load
		var pikobtn = $( '.pikobtn' );

		pikobtn.each( function( i, val ) {
			var _layout = $( this ).data( 'ajax-load' );

			if ( _layout !== undefined ) {
				var page      = _layout.page,
					container = _layout.container,
					layout    = _layout.layout,
					Loading = false,
					anchor    = $( val ).find( 'a' ),
					next      = $( anchor ).attr( 'href' ),
					i         = 2;

				if ( layout == 'infinite' ) {
                                        var infiniteFrame = function() {
						anchor = $( val ).find( 'a' );
						next   = $( anchor ).attr( 'href' );

						var bottomOffset = $( '.' + container ).offset().top + $( '.' + container ).height() - $( window ).scrollTop();

						if ( bottomOffset < window.innerHeight && bottomOffset > 0 && ! Loading ) {
							if ( ! next )
								return;
							Loading = true;
							$( anchor ).html( '<i class="fa fa-spinner fa-spin"></i>' );

							itemData();
						}
					}

					var infiniteHandler = function() {
						requestAnimationFrame( infiniteFrame );
					};

					$( window ).scroll( infiniteHandler );
					
				} else {
                                        $( val ).find( 'a' ).on('click', function(e) {
                                                e.preventDefault();
                                                anchor = $( val ).find( 'a' );
                                                next   = $( anchor ).attr( 'href' );

                                                $( anchor ).html( '<i class="fa fa-spinner fa-spin"></i>' );

                                                itemData();
                                        });
				}

				var itemData = function() {
					$.get( next + '', function( data ) {
						var content    = $( '.' + container, data ).wrapInner( '' ).html(),
							nextPage = $( '.' + container, data ).find( '.product, .portfolio-item' );

						$( content ).imagesLoaded( function() {
							next = $( anchor, data ).attr( 'href' );
							$( '.' + container ).append( nextPage ).isotope( 'appended', nextPage );
						});

						$( anchor ).text( wooxon_global_message.global.loadmore );

						if ( page > i ) {
							if ( wooxon_global_message.permalink != undefined && wooxon_global_message.permalink == 'plain' ) {
								var link = next.replace( /paged=+[0-9]+/gi, 'paged=' + ( i + 1 ) );
							} else {
								var link = next.replace( /page\/+[0-9]+\//gi, 'page/' + ( i + 1 ) + '/' );
							}

							$( anchor ).attr( 'href', link );
						} else {
							$( anchor ).text( wooxon_global_message.global.shownall );
							$( anchor ).removeAttr( 'href' ).addClass( 'disable' );
						}
						Loading = false;
						i++;
					});
				}
			}
		});

		if ( $( '.yith-wcan' ).length > 0 ) {
			$( 'body .yith-wcan a' ).on('click', function() {
				$( document ).ajaxComplete(function() {
					window.location.reload();
				});
			});
		}
	},
            postLove: function(){
                 $( '.love-button' ).on('click', function(){
                    var post_id = $(this).data('id');
                    jQuery.ajax({
                            url : pikoAjax.ajaxurl,
                            type : 'post',
                            data : {
                                    action : 'wooxon_post_love_add_love',
                                    post_id : post_id
                            },
                            success : function( response ) {
                                    jQuery('#love-count').html( response );
                            }
                    });

                   return false;
                })
            },
            quickView : function() {  // Product quick view
                $('body .quickview').on('click', function(e) {
                        var _this = $( this ),
                                id    = _this.attr( 'data-product-id' ),
                                data  = { action: 'piko_quickview', product: id };

                        $( '#site-loading' ).fadeIn(100);

                        $.post( pikoAjax.ajaxurl, data, function( response ) {
                                $.magnificPopup.open({
                                        markup: '<div class="mfp-close">1</div>',
                                        items: {
                                                src: response,
                                                type: 'inline',
                                        },
                                        mainClass: 'mfp-fade',
                                        removalDelay: 800
                                });
                                $( '#site-loading' ).fadeOut(100);
                                
                                wooxon.initCarousel();
                                wooxon.wcQuantityAdjust();
                                setTimeout(function() {
                                        $('.product-quickview .piko-nav.piko-carousel').slick('unslick');
                                        $('.product-quickview .piko-nav.piko-carousel').slick({
                                            vertical: true,
                                            verticalSwiping: true,                                    
                                        });
                                        if ( typeof imagesLoaded === 'function' ) {
                                            $( '.piko-nav .wp-post-image' ).imagesLoaded( function() {
                                                   $('.product-quickview .piko-nav.slick-slider').trigger('resize');
                                                });
                                        }
                                }, 10 );
                                //update slider form variable
                                 $( document.body ).on( 'vs_update_galllery',function(event,data){
                                        setTimeout(function() {
                                                 $('.product-quickview .piko-nav.piko-carousel').slick('unslick');
                                                $('.product-quickview .piko-nav.piko-carousel').slick({
                                                    vertical: true,
                                                    verticalSwiping: true,                                    
                                                });
                                                if ( typeof imagesLoaded === 'function' ) {
                                                    $( '.piko-nav .wp-post-image' ).imagesLoaded( function() {
                                                           $('.product-quickview .piko-nav.slick-slider').trigger('resize');
                                                        });
                                                }                                                
                                        }, 10 );
                                });                                
                                if ( typeof imagesLoaded === 'function' ) {
                                $( '.wp-post-image' ).imagesLoaded( function() {
                                        var imgHeight = $( '.product-quickview .wp-post-image' ).outerHeight();
                                        $( '.product-quickview .row > div' ).css({
                                                'height': imgHeight
                                        });
                                    });
                            }
                        });
                        e.preventDefault();
                        e.stopPropagation();
                });
            },
            wishlist: function() { // Wishlist minicart
        
                $( '.yith-wcwl-add-button').on('click', function(e){
                    $(this).addClass('loading');
                });
        
        
                if( $('.piko_widget_wishlist').length == 0 ) return;                
                var $dom_storage; /* Dom Handling */
                try {
                    $dom_storage = ( 'sessionStorage' in window && window.sessionStorage !== null );
                    window.sessionStorage.setItem( 'wooxon', 'test' );
                    window.sessionStorage.removeItem( 'wooxon' );
                } catch( err ) {
                    $dom_storage = false;
                }

                /* session create date base expiration on */
                function set_wishlist_timestamp() {
                    if ( $dom_storage ) {
                        sessionStorage.setItem( 'piko_wishlist_created', ( new Date() ).getTime() );
                    }
                }

                /** Set the hash in both session and local dom */
                function set_wishlist_hash( hash ) {
                    if ( $dom_storage ) {
                        localStorage.setItem( 'piko_wishlist_hash', hash );
                        sessionStorage.setItem( 'piko_wishlist_hash', hash );
                    }
                }

                var $fragment_ajax = {
                    url: pikoAjax.ajaxurl,
                    data: {
                        action: 'wooxon_wishlist_fragments'
                    },
                    method: 'get',
                    success: function(data) {
                        setWishlist(data.wishlist);
                        if ( $dom_storage ) {
                            sessionStorage.setItem( 'wooxon_wishlist', data.wishlist );

                            set_wishlist_hash( data.wishlist_hash );

                            if ( data.wishlist_hash ) {
                                set_wishlist_timestamp();
                            }
                        }
                    },
                    complete: function() {
                       wooxon.pikoDropdown();
                    }
                };

                function fragment_ajax_refresh() {
                    $.ajax( $fragment_ajax );
                }

                /* Refresh wishlist after window is loaded */
                jQuery('.wpml-ls-sub-menu .wpml-ls-item a').on('click', function(){
                    var url = jQuery(this).attr('href');
                    sessionStorage.setItem('lang_url', url);
                });
                if (sessionStorage.getItem('lang_url')) {
                    fragment_ajax_refresh();
                    sessionStorage.removeItem('lang_url'); 
                }

                if ( $dom_storage ) { /* wishlits minicart Handling */

                    var wishlist_timeout = null,
                        day_in_ms    = ( 20 * 60 * 60 * 1000 );

                    $( document.body ).on( 'added_to_cart added_to_wishlist removed_from_wishlist', function() {
                        var prev_wishlist_hash = sessionStorage.getItem( 'piko_wishlist_hash' );

                        if ( prev_wishlist_hash === null || prev_wishlist_hash === undefined || prev_wishlist_hash === '' ) {
                            set_wishlist_timestamp();
                        }

                        fragment_ajax_refresh();

                    });

                    try {
                        var wishlist_fragment = sessionStorage.getItem( 'wooxon_wishlist' ),
                            wishlist_hash    = sessionStorage.getItem( 'piko_wishlist_hash' ),
                            cookie_hash  = $.cookie( 'piko_wishlist_hash'),
                            wishlist_created = sessionStorage.getItem( 'piko_wishlist_created' );

                        if ( wishlist_hash === null || wishlist_hash === undefined || wishlist_hash === '' ) {
                            wishlist_hash = '';
                        }

                        if ( cookie_hash === null || cookie_hash === undefined || cookie_hash === '' ) {
                            cookie_hash = '';
                        }

                        if ( wishlist_hash && ( wishlist_created === null || wishlist_created === undefined || wishlist_created === '' ) ) {
                            throw 'No wishlist_created';
                        }

                        if ( wishlist_fragment && wishlist_hash === cookie_hash ) {

                            setWishlist(wishlist_fragment);

                        } else {
                            throw 'No fragment';
                        }

                    } catch( err ) {
                        fragment_ajax_refresh();
                    }

                } else {
                    fragment_ajax_refresh();
                }

                function setWishlist( wishlist ) {
                    $('.piko_widget_wishlist').replaceWith(wishlist);
                }

            },
            compare: function(){
                $('.yith-woocompare-widget').each( function( ) {
                   $(this).find('.button').attr( 'href', wooxon_global_message.compare_url ).removeClass('compare');
                });
                $( '.compare-btn:not(.added)').on('click', function(e){
                        e.preventDefault();

                        var button = $(this),
                                data = {
                                        _yitnonce_ajax: yith_woocompare.nonceadd,
                                        action: yith_woocompare.actionadd,
                                        id: button.data('product_id'),
                                        context: 'frontend'
                                },
                                widget_list = $('.yith-woocompare-widget ul.products-list');
                        $.ajax({
                                type: 'post',
                                url: yith_woocompare.ajaxurl.toString().replace( '%%endpoint%%', yith_woocompare.actionadd ),
                                data: data,
                                dataType: 'json',
                                beforeSend: function() {                            
                                    button.addClass('loading');
                                },
                                complete: function() {
                                    button.removeClass('loading');
                                },
                                success: function(response){				
                                        button.addClass('dn');
                                        button.after('<a class="btn-ac compare-btn added" href="'+wooxon_global_message.compare_url+'"><i class="icon-checkmark"></i></a>');
                                        // add the product in the widget
                                        widget_list.html( response.widget_table );
                                }
                        });
                });
            },            
            notification: function(){
                //add to cart message	
                var notify_html = '';
                $('body').on('click touchend', '.ajax_add_to_cart', function(){               
                    $('.woocommerce-message').remove();
                    
                    if($('body').hasClass('piko-compare')){
                      var notifyImg =  $(this).parents('.product-details').find('img').attr('src');
                      var notifyText = $(this).parents('.product-details').find('img').attr('alt');
                    }else if ($('body').hasClass('woocommerce-wishlist')){
                        $('#yith-wcwl-messages').remove();
                         var notifyImg = $(this).parents('tr').find('img.attachment-woocommerce_thumbnail').attr('src');
                         var notifyText = $(this).parents('tr').find('.product-name').html();
                    }else{
                       var notifyImg = $(this).parents('.product-wrap').find('img.attachment-shop_catalog').attr('src');
                       var notifyText = $(this).parents('.product-wrap').find('.product-title').html(); 
                    }            
                    notify_html = '<div class="woocommerce-message"><div class="notify_w"><img class="notfy_img" src="' + notifyImg + '" alt=""/><div class="notify-text f_s13 lh_2">&quot;' + notifyText + '&quot;' + '&nbsp;' + wooxon_global_message.addcart.success +'</div></div></div>';
                        
                        
                });
                //  ajax cart display notify
                $(document).on('added_to_cart', function(event, data) {
                        if (notify_html != false){
                                $('#content').prepend(notify_html);
                        }
                });

                $('.add_to_cart_button:not(.product_type_variable)').on('click', function() {
                    var $thisbutton = $( this );
                    $thisbutton.prepend( '<i class="fa fa-spinner fa-pulse"></i>' );
                });

                $(document.body).on('added_to_cart', function (event, fragments, $button) {
                    $button = typeof $button === 'undefined' ? false : $button;
                    if (fragments === undefined || fragments["div.widget_shopping_cart_content"] === undefined)
                        return;
                    if ( $button ) {
                         $('.add_to_cart_button').children('.fa-spinner').remove();  
                    }
                 
                });
            },
            notify_action: function(){
                $('.notify_w:not(d_t)').on('click', function(e){
                    e.preventDefault();
                    $('body').toggleClass('open-mini-cart');
                });
            },            
            ajaxLogin: function(){
                  //TOGOLE LOGIN & REGISTER for woopage
                    $('.piko-my-account .piko-togoleform').on('click', function(e){
                        var formId = $(this).attr('href');
                        $(this).closest('.piko-my-account-form').removeClass('show slide');
                        $(formId).addClass('show slide');
                        e.preventDefault();
                    });   
                 //login show hidden
                 $('.button-togole').on('click', function(e){
                    var $this = $(this);
                    var toogleId = $this.attr('data-togole');

                    if ( $('#' + toogleId).is(':hidden') ) {
                        $('.piko-layout-header .showing').removeClass('showing').addClass('just-hidden');
                        $('#' + toogleId).slideDown(300).addClass('showing').removeClass('just-hidden');
                        $('.piko-layout-header .just-hidden').fadeOut(300);
                        $('.button-togole').removeClass('active');
                        $this.addClass('active');
                        if ($this.is('.togole-searchform')) {
                            $('#' + toogleId).find('.search').focus();
                        }
                    }
                    else{
                        $('#' + toogleId).slideUp(300).removeClass('showing').addClass('just-hidden');
                        $this.removeClass('active');
                    }
                    e.preventDefault();
                });

                 // Ajax login
                $('.piko-login-form:not(.piko-woo)').on('submit', function(e){
                    var $this = $(this);
                    if ( $this.hasClass('logging') ) {
                        return false;
                    }
                    if ( !$this.hasClass('piko-woocommerce-login-form') ) { // Don't ajax with WooCommerce login form
                        var user_login = $this.find('input[name=log]').val();
                        var user_pass = $this.find('input[name=pwd]').val();
                        var rememberme = $this.find('input[name=rememberme]').is(':checked') ? 'yes': 'no';
                        var redirect_to = $this.find('input[name=redirect_to]').val();
                        var login_nonce = $this.find('input[name="login-ajax-nonce"]').val();

                        var data = {
                            action: 'wooxon_do_login_via_ajax',
                            user_login: user_login,
                            user_pass: user_pass,
                            rememberme: rememberme,
                            redirect_to: redirect_to,
                            login_nonce: login_nonce
                        };

                        $this.addClass('logging loading');
                        if ( !$('.piko-login-form .piko-loading').length ) {
                            $this.prepend('<div class="piko-loading"><i class="fa fa-spinner fa-spin"></i></div>');
                        }

                        $.post(pikoAjax.ajaxurl, data, function(response){

                            if ( $.trim( response['is_logged_in'] ) == 'yes' ) {
                                $this.replaceWith(response['message']);

                                // Show welcome user on top menu
                                if ( $('#piko-show-account').length ) {
                                    setTimeout(function(){ 
                                        $('#piko-show-account').html(response['html']);
                                    }, 500);
                                }

                                // Reload page
                                location.reload(true);                

                            }
                            else{
                                $this.find('.login-message').remove();
                                $this.append(response['message']);
                            }

                            $this.removeClass('logging loading');

                        });   

                        return false;    
                    }

                });
                //Ajax Register
                $('.piko-register-form:not(.piko-woo)').on('submit', function(e){

                    var $this = $(this);

                    if ( $this.hasClass('registering') ) {
                        return false;
                    }

                    if ( !$this.hasClass('theme-woocommerce-register-form') ) { // Don't ajax with WooCommerce register form
                        var username = $this.find('input[name=username]').val();
                        var email = $this.find('input[name=email]').val();
                        var password = $this.find('input[name=password]').val();
                        var repassword = $this.find('input[name=confirm-password]').val();
                        var agree = $this.find('input[name=agree]').is(':checked') ? 'yes': 'no';
                        var register_nonce = $this.find('input[name="register-ajax-nonce"]').val();

                        var data = {
                            action: 'wooxon_do_register_via_ajax',
                            username: username,
                            email: email,
                            password: password,
                            repassword: repassword,
                            agree: agree,
                            register_nonce: register_nonce
                        };

                        $this.addClass('registering loading');
                        if ( !$('.theme-register-form').length ) {
                            $this.prepend('<div class="piko-loading"><i class="fa fa-spinner fa-spin"></i></div>');
                        }

                        $.post(pikoAjax.ajaxurl, data, function(response){

                            if ( $.trim( response['register_ok'] ) == 'yes' ) {
                                $this.replaceWith(response['message']);

                                // Reload page
                                location.reload(true);
                            }
                            else{
                                $this.find('.register-message').remove();
                                $this.append(response['message']);
                            }

                            $this.removeClass('registering loading');

                        });   

                        return false;
                    }

                });
            }
	};
	// Ready Event
	$(document).ready(function () {
		// Init wooxon
		wooxon.init();
                $('body .yith-wcan a, .price_slider_amount .button, .woocommerce-pagination .page-numbers, .yith-wcan-instock-button, .yith-wcan-list-price-filter .yith-wcan-price-link').on('click', function(){
                        $( document ).ajaxComplete(function() {                                
                             $( this ).imagesLoaded( function() {
                                    $('.piko-masonry').isotope('destroy');
                                       $('.piko-masonry').isotope({
                                                itemSelector: '.product',
                                                layoutMode: 'fitRows'
                                        });
                            });
                            wooxon.quickView();
                            wooxon.compare();
                            wooxon.vs_init();
                        });
                });                
	});
        $(document).ajaxComplete(function() {            
            if ( $( '.notify_w' ).length > 0 ) {
                wooxon.notify_action();
            }
            if ( $( '#order_review' ).length > 0 ) { //fix checkout table border
                $('#order_review .shipping td').attr('colspan',2);
            }           
        });
	$(window).load(function() { // Load Event
		wooxon.preLoader_slide();
		wooxon.scrollBtnAppear();
                wooxon.news_popup();
	});	
	$(window).scroll(function () { // Scroll Event
		wooxon.scrollBtnAppear();
	});      
	$(window).resize(function () { // resize Event
		wooxon.productHeight();
	});      

})(jQuery);

//theme.js
;window.wooxon = {};
function get_ajax_loading(){
    return jQuery('.wooxon-ajax-loading');
}
function get_message_box(){
    return jQuery('.wooxon-global-message');
}
function get_overlay(){
    return jQuery('.wooxon-overlay');
}
function wooxon_get_container_width(){
    var container_width = jQuery('#page_wrapper > .main > .row').innerWidth() - 30;
    if(jQuery('body').is('.header-layout-3') || jQuery('body').is('.header-layout-4')){
        if(jQuery(window).width() > 992){
            container_width = jQuery(window).width();
        }
    }
    return container_width;
}
function wooxon_generate_rand(){
    return Math.round(new Date().getTime() + (Math.random() * 1000));
}
function addStyleSheet( css ) {
    var head, styleElement;
    head = document.getElementsByTagName('head')[0];
    styleElement = document.createElement('style');
    styleElement.setAttribute('type', 'text/css');
    if (styleElement.styleSheet) {
        styleElement.styleSheet.cssText = css;
    } else {
        styleElement.appendChild(document.createTextNode(css));
    }
    head.appendChild(styleElement);
    return styleElement;
}

// jQuery fn extend
(function(wooxon, $) {

    wooxon = wooxon || {};

    $.extend( wooxon, {
        options : {
            debug : true,
            show_sticky_header : wooxon_global_message.enable_sticky_header == '1' ? true : false,
            default_timer : 20,
            show_ajax_overlay : true,
            infiniteConfig : {
                navSelector  : "div.pagination",
                nextSelector : "div.pagination a.next",
                loading      : {
                    finished: function(){
                        $('.wooxon-infinite-loading').hide();
                    },
                    finishedMsg: "xx",
                    msg: $("<div class='wooxon-infinite-loading'><div></div></div>")
                }
            }
        },
        helpers : {
            is_email : function(email){
                var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            },
            is_cookie_enabled : function(){
                if (navigator.cookieEnabled) return true;
                // set and read cookie
                document.cookie = "cookietest=1";
                var ret = document.cookie.indexOf("cookietest=") != -1;
                // delete cookie
                document.cookie = "cookietest=1; expires=Thu, 01-Jan-1970 00:00:01 GMT";
                return ret;
            },
            is_touch_device : function(){
                return !!('ontouchstart' in window) // works on most browsers
                    || !!('onmsgesturechange' in window); // works on ie10
            },            
        }
    });

}).apply(this, [window.wooxon, jQuery]);


// jQuery fn extend
(function(wooxon, $) {
    "use strict";

    wooxon = wooxon || {};

    // Default Extend
        // Post Comment From
    $.extend(wooxon, {
        PostComment : {
             initialize : function(){
                 var self = this;
                 self.events();
                 return self;
             },
            
             events : function(){
                 var self = this;
                 /**
                  * Comment Form
                  */
                 try {
                     $('#commentform').on('submit', function(){
                         if($('#commentform #rating').length > 0 && $('#commentform #rating').val() == ''){
                             alert(wooxon_global_message.global.comment_rating);
                             return false;
                         }
                         if($('#commentform #comment').length > 0 && $('#commentform #comment').val() == ''){
                             alert(wooxon_global_message.global.comment_content);
                             $('#commentform #comment').focus();
                             return false;
                         }
                         if($('#commentform #author').length > 0 &&  $('#commentform #author').val() == ''){
                             alert(wooxon_global_message.global.comment_author);
                             $('#commentform #author').focus();
                             return false;
                         }
                         if($('#commentform #email').length > 0 && !wooxon.helpers.is_email($('#commentform #email').val())){
                             alert(wooxon_global_message.global.comment_email);
                             $('#commentform #email').focus();
                             return false;
                         }                        
                         
                     });
                 } catch (ex) { log_js(ex); }                 
                 return self;
             }
         }        
    });

    // Mega Menu
    $.extend(wooxon, {
        MegaMenu: {
            defaults: {
                menu: $('.mega-menu'),
                hoverIntentConfig : {
                    sensitivity: 2,
                    interval: 0,
                    timeout: 0
                },
                rtl:false
            },

            initialize: function(options) {

                this.$setting = $.extend(this.defaults,options);

                this.$menu = this.$setting.menu;

                this.build()
                    .events();

                return this;
            },

            IsSidebarMenu : function( $menu ){
                return $menu.closest('.mega-menu-sidebar').length;
            },
            IsRightMenu : function( $menu ){
                return false;
            },
            popupWidth : function(){
                var winWidth = $(window).width();

                if (winWidth >= wooxon_get_container_width())
                    return wooxon_get_container_width();
                if (winWidth >= 992)
                    return 940;
                if (winWidth >= 768)
                    return 720;

                return $(window).width() - 30;
            },
            build: function() {
                var self = this;

                self.$menu.each( function() {
                    var $menu = $(this);
                    var is_sidebar_menu = self.IsSidebarMenu( $menu );
                    var is_right_menu = self.IsRightMenu( $menu );

                    if ( is_sidebar_menu ){
                        self._side_menu( self, $menu );
                    }else{
                        self._normal_menu( self, $menu );
                    }
                });

                return self;
            },
            _normal_menu : function( self, $menu ) {
                var $menu_container = $menu.closest('.columns');
                var container_width = self.popupWidth();
                var offset = 0;


                if($(window).width() >= $menu_container.width()){
                    container_width = $menu_container.width();
                }

                if ($menu_container.length) {
                    if (self.$setting.rtl) {
                        offset = ($menu_container.offset().left + $menu_container.width()) - ($menu.offset().left + $menu.width()) + parseInt($menu_container.css('padding-right'));
                    } else {
                        offset = $menu.offset().left - $menu_container.offset().left - parseInt($menu_container.css('padding-left'));
                    }
                    offset = (offset == 1) ? 0 : offset;
                }

                var $menu_items = $menu.find('> li');

                $menu_items.each( function() {
                    var $menu_item = $(this);
                    var $popup = $menu_item.find('> .popup');
                    if ($popup.length > 0) {
                        $popup.css('display', 'block');
                        if ($menu_item.hasClass('wide')) {
                            $popup.css('left', 0);
                            var padding = parseInt($popup.css('padding-left')) + parseInt($popup.css('padding-right')) +
                                parseInt($popup.find('> .inner').css('padding-left')) + parseInt($popup.find('> .inner').css('padding-right'));

                            var row_number = 4;

                            if ($menu_item.hasClass('col-2')) row_number = 2;
                            if ($menu_item.hasClass('col-3')) row_number = 3;
                            if ($menu_item.hasClass('col-4')) row_number = 4;
                            if ($menu_item.hasClass('col-5')) row_number = 5;
                            if ($menu_item.hasClass('col-6')) row_number = 6;

                            if ($(window).width() < 992)
                                row_number = 1;

                            var col_length = 0;
                            $popup.find('> .inner > ul > li').each(function() {
                                var cols = parseInt($(this).attr('data-cols'));
                                if (cols < 1)
                                    cols = 1;

                                if (cols > row_number)
                                    cols = row_number;

                                col_length += cols;
                            });

                            if (col_length > row_number) col_length = row_number;

                            var popup_max_width = $popup.find('.inner').css('max-width');

                            var col_width = container_width / row_number;

                            if (popup_max_width != 'none' && parseInt(popup_max_width) < container_width) {

                                col_width = parseInt(popup_max_width) / row_number;
                            }

                            $popup.find('> .inner > ul > li').each(function() {
                                var cols = parseFloat($(this).attr('data-cols'));
                                if (cols < 1)
                                    cols = 1;

                                if (cols > row_number)
                                    cols = row_number;

                                if ($menu_item.hasClass('pos-center') || $menu_item.hasClass('pos-left') || $menu_item.hasClass('pos-right'))
                                    $(this).css('width', (100 / col_length * cols) + '%');
                                else
                                    $(this).css('width', (100 / row_number * cols) + '%');
                            });

                            if ($menu_item.hasClass('pos-center')) { // position center
                                $popup.find('> .inner > ul').width(col_width * col_length - padding);
                                var left_position = $popup.offset().left - ($(window).width() - col_width * col_length) / 2;
                                $popup.css({
                                    'left': -left_position
                                });
                            } else if ($menu_item.hasClass('pos-left')) { // position left
                                $popup.find('> .inner > ul').width(col_width * col_length - padding);
                                $popup.css({
                                    'left': 0
                                });
                            } else if ($menu_item.hasClass('pos-right')) { // position right
                                $popup.find('> .inner > ul').width(col_width * col_length - padding);
                                $popup.css({
                                    'left': 'auto',
                                    'right': 0
                                });
                            } else { // position justify
                                $popup.find('> .inner > ul').width(container_width - padding);
                                if (self.$setting.rtl) {
                                    $popup.css({
                                        'right': 0,
                                        'left': 'auto'
                                    });
                                    var right_position = ($popup.offset().left + $popup.width()) - ($menu.offset().left + $menu.width()) - offset;
                                    $popup.css({
                                        'right': right_position,
                                        'left': 'auto'
                                    });
                                } else {
                                    $popup.css({
                                        'left': 0,
                                        'right': 'auto'
                                    });
                                    var left_position = $popup.offset().left - $menu.offset().left + offset;
                                    $popup.css({
                                        'left': -left_position,
                                        'right': 'auto'
                                    });
                                }
                            }
                        }
                        if (!($menu.hasClass('effect-down')))
                            $popup.css('display', 'none');

                        $menu_item.hoverIntent(
                            $.extend({}, self.$setting.hoverIntentConfig, {
                                over: function(){
                                    if (!($menu.hasClass('effect-down')))
                                        $menu_items.find('.popup').hide();
                                    $popup.show();
                                },
                                out: function(){
                                    if (!($menu.hasClass('effect-down')))
                                        $popup.hide();
                                }
                            })
                        );
                    }
                });
            },
            _side_menu : function( self, $menu ) {
                var $menu_container = $menu.closest('.container');
                var container_width;
                if ($(window).width() < 992 ){
                    container_width = self.popupWidth();
                }
                else{
                    container_width = self.popupWidth() - 45;
                    if( $menu.closest('body').hasClass('header-layout-3') || $menu.closest('body').hasClass('header-layout-4') ){
                        container_width = container_width - $menu.width() - 40;
                    }
                }

                var is_right_sidebar = self.IsRightMenu($menu);

                var $menu_items = $menu.find('> li');

                $menu_items.each( function() {
                    var $menu_item = $(this);
                    var $popup = $menu_item.find('> .popup');
                    if ($popup.length > 0) {
                        $popup.css('display', 'block');
                        if ($menu_item.hasClass('wide')) {
                            $popup.css('left', 0);
                            var padding = parseInt($popup.css('padding-left')) + parseInt($popup.css('padding-right')) +
                                parseInt($popup.find('> .inner').css('padding-left')) + parseInt($popup.find('> .inner').css('padding-right'));

                            var row_number = 4;

                            if ($menu_item.hasClass('col-2')) row_number = 2;
                            if ($menu_item.hasClass('col-3')) row_number = 3;
                            if ($menu_item.hasClass('col-4')) row_number = 4;
                            if ($menu_item.hasClass('col-5')) row_number = 5;
                            if ($menu_item.hasClass('col-6')) row_number = 6;

                            if ($(window).width() < 992)
                                row_number = 1;

                            var col_length = 0;
                            $popup.find('> .inner > ul > li').each(function() {
                                var cols = parseInt($(this).attr('data-cols'));
                                if (cols < 1)
                                    cols = 1;

                                if (cols > row_number)
                                    cols = row_number;

                                col_length += cols;
                            });

                            if (col_length > row_number) col_length = row_number;

                            var popup_max_width = $popup.find('.inner').css('max-width');
                            var col_width = container_width / row_number;
                            if ('none' !== popup_max_width && popup_max_width < container_width) {
                                col_width = parseInt(popup_max_width) / row_number;
                            }

                            $popup.find('> .inner > ul > li').each(function() {
                                var cols = parseFloat($(this).attr('data-cols'));
                                if (cols < 1)
                                    cols = 1;

                                if (cols > row_number)
                                    cols = row_number;

                                if ($menu_item.hasClass('pos-center') || $menu_item.hasClass('pos-left') || $menu_item.hasClass('pos-right'))
                                    $(this).css('width', (100 / col_length * cols) + '%');
                                else
                                    $(this).css('width', (100 / row_number * cols) + '%');
                            });

                            $popup.find('> .inner > ul').width(col_width * col_length + 1);
                            if (is_right_sidebar) {
                                $popup.css({
                                    'left': 'auto',
                                    'right': $(this).width()
                                });
                            } else {
                                $popup.css({
                                    'left': $(this).width(),
                                    'right': 'auto'
                                });
                            }
                        }
                        if (!($menu.hasClass('subeffect-down')))
                            $popup.css('display', 'none');

                        $menu_item.hoverIntent(
                            $.extend({}, self.$setting.hoverIntentConfig, {
                                over: function(){
                                    if (!($menu.hasClass('subeffect-down')))
                                        $menu_items.find('.popup').hide();
                                    $popup.show();
                                    $popup.parent().addClass('open');
                                },
                                out: function(){
                                    if (!($menu.hasClass('subeffect-down')))
                                        $popup.hide();
                                    $popup.parent().removeClass('open');
                                }
                            })
                        );
                    }
                });
            },
            events: function() {
                var self = this;

                $('.header-toogle-menu-button').on('click', function(){
                    if($(this).hasClass('active')){
                        $('.header-toogle-menu-button').removeClass('active');
                    }else{
                        $('.header-toogle-menu-button').addClass('active');
                    }
                    $('.header-wrapper .mega-menu-sidebar').toggleClass('open-menu');
                });


                $(window).resize( function() {
                    self.build();
                });

                setTimeout(function() {
                    self.build();
                }, 400);

                return self;
            }
        }
    });

    // Accordion Menu
    $.extend(wooxon, {

        AccordionMenu: {

            defaults: {
                menu: $('.accordion-menu')
            },

            initialize: function($menu) {
                this.$menu = ($menu || this.defaults.menu);

                this.events()
                    .build();

                return this;
            },

            build: function() {
                var self = this;

                self.$menu.find('li.menu-item.active').each(function() {
                    if ($(this).find('> .arrow').length)
                        $(this).find('> .arrow').trigger('click');
                });

                return self;
            },

            events: function() {
                var self = this;

                self.$menu.find('.arrow').on('click', function() {
                    var $parent = $(this).parent();
                    $(this).next().stop().slideToggle();
                    if ($parent.hasClass('open')) {
                        $parent.removeClass('open');
                    } else {
                        $parent.addClass('open');
                    }
                });

                $('.toggle-menu-mobile-button, #mobile_menu_wrapper_overlay, .close-menu').on('click', function(e){
                    e.preventDefault();
                    $('body').toggleClass('open-mobile-menu');
                    $('.toggle-menu-mobile-button').toggleClass('remove');
                });
                if($(window).width() > 991){
                    $('.cart-button:not(.piko_widget_wishlist), .close-cart').on('click', function(e){
//                        e.preventDefault();
                        $('body').toggleClass('open-mini-cart');
                    });
                }
                if($(window).width() < 576){
                    $('.mobile-panel').on('click', function(e){
                        $('body').toggleClass('open-m');
                    });
                }
                
                $(window).resize(function(){
                    if($(window).width() > 992){
                        $('body').removeClass('open-mobile-menu');
                    }
                })

                return self;
            }
        }

    });
     // StickyHeader
    $.extend(wooxon, {
        StickyHeader: {

            defaults: {
                header: $('.sticky-menu-header')               
            },

            initialize: function($header) {
                this.$header = ($header || this.defaults.header);
                this.sticky_height = 0;
                this.sticky_offset = 0;
                this.sticky_pos = 0;
                this.headerTopHeight = $( '.header-top' ).outerHeight();
                
                $('#header:not(.vertical)').height($( '.header-top' ).outerHeight() + $( '.header-main' ).outerHeight()); 
                
                if ( $('.header-bottom').is(':visible') ) {
                    $('#header:not(.vertical)').height($( '.header-top' ).outerHeight() + $( '.header-main' ).outerHeight() + $( '.header-bottom' ).outerHeight()); 
                };        
                        
                             

                this.$header = ($header || this.defaults.header);

                if (!wooxon.options.show_sticky_header || !this.$header.length)
                    return this;

                var self = this;

                self.reset()
                    .build()
                    .events();
                return self;
            },

            build: function() {
                var self = this;

                var scroll_top = $(window).scrollTop(),
                    $this_header_sticky = self.$header;

                if(self.$header.css('position') == 'fixed'){
                    $this_header_sticky = self.$header;
                }
                if(self.$header.find('.header-main').css('position') == 'fixed'){
                    $this_header_sticky = self.$header.find('.header-main');
                }
                if(self.$header.find('.main-menu-wrap').css('position') == 'fixed'){
                    $this_header_sticky = self.$header.find('.main-menu-wrap');
                }            

                if (scroll_top > self.headerTopHeight) {
                    self.$header.addClass('active-sticky');
                    $('body .header-wrapper').addClass('sticky-open');
//                    $('.header-layout-6 .sticky-menu-header .columns').addClass('container-fluid');
                    $this_header_sticky.css({
                        'top' : self.adminbar_height
                    });
                }else{
                    self.$header.removeClass('active-sticky');
                    $('body .header-wrapper').removeClass('sticky-open');
//                    $('.header-layout-6 .sticky-menu-header .columns').removeClass('container-fluid');
                    $this_header_sticky.removeAttr('style');
                }

                return self;
            },

            reset: function() {
                var self = this;

                var $admin_bar = $('#wpadminbar');
                var height = 0;
                if ($admin_bar.length) {
                    height = $('#wpadminbar').css('position') == 'fixed' ? $('#wpadminbar').height() : 0;
                }
                self.adminbar_height = height;

                if( self.$header.closest('body').is('.header-layout-3')){
                    self.sticky_pos = self.$header.find('.header-main').height() + self.adminbar_height;
                }else{
                    self.sticky_pos = self.$header.height() + self.adminbar_height;
                }

                self.$header.removeAttr('style');

                return self;
            },

            events: function() {
                var self = this;

                $(window).resize( function() {
                    self.reset()
                        .build();
                });

                $(window).scroll(function() {
                    self.build();
                });

                return self;
            }
        }
    });

}).apply(this, [window.wooxon, jQuery]);

(function(wooxon, $) {
    "use strict";
    function wooxon_init(){

        if (typeof wooxon.DefaultExtend !== 'undefined') {
            wooxon.DefaultExtend.initialize();
        }
        // Post Comment
        if (typeof wooxon.PostComment !== 'undefined') {
            wooxon.PostComment.initialize();
        }

        // Mega Menu
        if (typeof wooxon.MegaMenu !== 'undefined') {
            wooxon.MegaMenu.initialize();
        }

        // Mega Menu
        if (typeof wooxon.AccordionMenu !== 'undefined') {
            wooxon.AccordionMenu.initialize();
        }

        // Sticky Header
        if (typeof wooxon.StickyHeader !== 'undefined') {
            wooxon.StickyHeader.initialize();
        } 

        $('.slick-slider').trigger('resize');
        setTimeout(function(){
            $('.slick-slider').trigger('resize');
        },200);

    }
    $(document).ready(function() {
        wooxon_init();
        $(window).on('vc_reload', function() {
            wooxon_init();
        });
    });

}).apply(this, [window.wooxon, jQuery]);

(function($) {
    'use strict';
    $(document).ready(function(){
        // fix header cart       
        $('.header-bottom').each(function(e){ //fixed ajax result          
            var width_col = ($('.header-bottom .row > .col-lg-3').outerWidth()) - ('15');           
            $(this).find('.container .piko-ajax-results-wrapper').css('left', '-'+width_col+'px');            
        });
        if(wooxon.helpers.is_touch_device()){           
            $('.products .product_link').each(function(){
                $(this).closest('.product_images_wrapper').addClass('is_touch_devices');
            })
        };       
        
    });
    
})(jQuery);