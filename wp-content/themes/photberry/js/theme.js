/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/
"use strict";

var photberry_window = jQuery(window),
	photberry_nav = jQuery('.photberry_nav'),
	photberry_menu = jQuery('.photberry_menu');

jQuery(document).ready(function () {
	if (jQuery('.photberry_mobile_header').hasClass('show_by_click')) {
		jQuery('.photberry_mobile_header_inner').slideUp(1);
	}
	jQuery('.photberry_mobile_header_inner').find('.sub-menu').slideUp(1);
	setTimeout("jQuery('.photberry_mobile_header_loading').removeClass('photberry_mobile_header_loading')",100);
	if (jQuery('.photberry_404_content_wrapper').size() > 0) {
		jQuery('html').addClass('photberry_transparent_header');
	}

	if (jQuery('.photberry_element_countdown').size() > 0) {
		jQuery('html').addClass('photberry_transparent_header');
		jQuery('time').countDown({
			with_separators: false
		});
	}
    photberry_countdown();

    jQuery('.photberry_nav a').each(function () {
        if (jQuery(this).attr('href') == '#') {
            jQuery(this).attr('href', 'javascript:void(0)');
        }
		if (jQuery(this).parent('li').hasClass('menu-item-has-children')) {
			jQuery(this).addClass('open_sub_menu').attr('href', 'javascript:void(0)');
		}

    });

    if (jQuery('#wpadminbar').size() > 0) {
        jQuery('html').addClass('has_admin_bar');
    }

    var photberry_js_bg_color = jQuery('.photberry_js_bg_color'),
        photberry_js_bg_image = jQuery('.photberry_js_bg_image'),
        photberry_js_color = jQuery('.photberry_js_color'),
        photberry_js_font_size = jQuery('.photberry_js_font_size'),
        photberry_js_height = jQuery('.photberry_js_height');

    if (jQuery(photberry_js_bg_color).size() > 0) {
        jQuery(photberry_js_bg_color).each(function () {
            jQuery(this).css('background-color', jQuery(this).attr('data-bgcolor'));
        });
    }

    if (jQuery(photberry_js_bg_image).size() > 0) {
        jQuery(photberry_js_bg_image).each(function () {
            jQuery(this).css('background-image', 'url(' + jQuery(this).attr('data-src') + ')');
        });
    }

    if (jQuery(photberry_js_color).size() > 0) {
        jQuery(photberry_js_color).each(function () {
            jQuery(this).css('color', jQuery(this).attr('data-color'));
        });
    }

    if (jQuery(photberry_js_font_size).size() > 0) {
        jQuery(photberry_js_font_size).each(function(){
            var font_size = jQuery(this).attr('data-font-size');

            jQuery(this).css({'font-size': font_size, 'line-height': font_size});
        });
    }

    if (jQuery(photberry_js_height).size() > 0) {
        jQuery(photberry_js_height).each(function(){
            var block_height = jQuery(this).attr('data-height');

            jQuery(this).height(block_height);
        });
    }

	//Swipebox
    if (jQuery('.swipebox').size() > 0) {
        jQuery('html').addClass('photberry_swipe_box');
        jQuery('.swipebox').swipebox({
			afterOpen: function() {
				var $swipeboxContainer = jQuery("#swipebox-container"),
					$selectorClose = jQuery("#swipebox-close"),
					clickAction = "touchend click";

				$selectorClose.unbind(clickAction);

				$selectorClose.bind(clickAction, function(event){
					event.preventDefault();
					event.stopPropagation();
					jQuery.swipebox.close();
				});
			}
		});
    }

    if (jQuery('.photberry_testimonials_carousel').size() > 0) {
        jQuery(".photberry_testimonials_carousel").each(function () {
            var autoplay = jQuery(this).attr('data-autoplay'),
                speed = parseInt(jQuery(this).attr('data-speed')),
				pause = jQuery(this).attr('data-pause'),
				infinite = jQuery(this).attr('data-infinite');
			if (autoplay == 'yes') {
				autoplay = true;
			} else {
				autoplay = false;
			}
			if (pause == 'yes') {
				pause = true;
			} else {
				pause = false;
			}
			if (infinite == 'yes') {
				infinite = true;
			} else {
				infinite = false;
			}

            jQuery(this).on("initialized.owl.carousel", function (e) {
                jQuery(this).css("opacity", "1");
            });
            jQuery(this).owlCarousel(
                {
                    items: 3,
                    autoHeight: true,
                    center: true,
                    lazyLoad: true,
                    loop: infinite,
                    autoplay: autoplay,
                    autoplayTimeout: speed,
                    autoplayHoverPause: pause,
                    navigation: false,
					responsive: {
                        // breakpoint from 0 up
                        0: {
                            items: 1
                        },
						760: {
							items: 2
						},
                        960: {
                            items: 3
                        }
                    }
                }
            );
        });
    }

    if (jQuery('.photberry_albums_carousel').size() > 0) {
        jQuery(".photberry_albums_carousel").each(function () {
            var autoplay = jQuery(this).attr('data-autoplay'),
				items_padding = parseInt(jQuery(this).attr('data-setpad')),
				on_screen = parseInt(jQuery(this).attr('data-onscreen')),
                speed = parseInt(jQuery(this).attr('data-speed')),
				pause = jQuery(this).attr('data-pause'),
				infinite = jQuery(this).attr('data-infinite');
			if (autoplay == 'yes') {
				autoplay = true;
			} else {
				autoplay = false;
			}
			if (pause == 'yes') {
				pause = true;
			} else {
				pause = false;
			}
			if (infinite == 'yes') {
				infinite = true;
			} else {
				infinite = false;
			}

            jQuery(this).on("initialized.owl.carousel", function (e) {
                jQuery(this).css("opacity", "1");
            });
            jQuery(this).owlCarousel(
                {
                    items: on_screen,
                    autoHeight: true,
                    center: true,
                    lazyLoad: true,
                    loop: infinite,
                    autoplay: autoplay,
                    autoplayTimeout: speed,
                    autoplayHoverPause: pause,
                    navigation: false,
					nav: false,
					dots: false,
					margin: items_padding,
					responsive: {
                        // breakpoint from 0 up
                        0: {
                            items: 1
                        },
						760: {
							items: 2
						},
                        960: {
                            items: 3
                        },
						1200: {
                            items: on_screen
                        }
                    }
                }
            );
        });
    }
	// Isotope Activation
    if (jQuery('.photberry_isotope_trigger').size() > 0 && jQuery('.elementor-editor-active').size() < 1) {
		jQuery('.photberry_isotope_trigger').each(function(){
			if (jQuery(this).hasClass('is_masonry')) {
				jQuery(this).isotope({
					layoutMode: 'masonry'
				});
			} else if (jQuery(this).hasClass('is_packery')) {
				jQuery(this).isotope({
					layoutMode: 'packery'
				});
			} else {
				jQuery(this).isotope({
					layoutMode: 'fitRows'
				});
			}
		});
    }

	//	Menu
	photberry_nav.on('mousewheel', function(event) {
		if (photberry_nav.hasClass('overflowed')) {
			event.preventDefault();
			if (photberry_nav.find('.now_is_opened').size() > 0) {
				var current_menu = jQuery('.now_is_opened:not(.sub_is_opened)');
			} else {
				var current_menu = jQuery('.photberry_menu');
			}
			var ground_value = photberry_nav.height() - current_menu.height(),
				menu_step = 100,
				current_step = parseInt(current_menu.css('top')),
				new_step = 0;
			if (event.deltaY > 0) {
				//Scroll Up (Move Menu Down)
				new_step = current_step + menu_step;
			}
			if (event.deltaY < 0) {
				//Scroll Down (Move Menu Up)
				new_step = current_step - menu_step;
			}
			if (new_step <= 0) {
				photberry_nav.addClass('overflowed_top');
			}
			if (new_step >= 0) {
				new_step = 0;
				photberry_nav.removeClass('overflowed_top');
				photberry_nav.addClass('overflowed_bottom');
			}
			if (new_step < ground_value) {
				new_step = ground_value;
				photberry_nav.addClass('overflowed_top');
				photberry_nav.removeClass('overflowed_bottom');
			}
			current_menu.css('top', new_step + 'px');
		}
	});

	var current_menu_touch = 0;

	photberry_nav.on('touchmove', function(event) {
		if (photberry_nav.hasClass('overflowed')) {
			var current_touch = event.originalEvent.touches[0].pageY,
				move_value = 0;
			if (current_menu_touch != 0) {
				if (current_touch > current_menu_touch) {
					var move_value = current_menu_touch - current_touch;
				}
				if (current_touch < current_menu_touch) {
					var move_value = current_menu_touch - current_touch;
				}
			}
			current_menu_touch = current_touch;

			event.preventDefault();
			if (photberry_nav.find('.now_is_opened').size() > 0) {
				var current_menu = jQuery('.now_is_opened:not(.sub_is_opened)');
			} else {
				var current_menu = jQuery('.photberry_menu');
			}

			var ground_value = photberry_nav.height() - current_menu.height(),
				menu_step = move_value,
				current_step = parseInt(current_menu.css('top')),
				new_step = current_step - menu_step;

			if (new_step >= 0) {
				new_step = 0;
				photberry_nav.removeClass('overflowed_top');
				photberry_nav.addClass('overflowed_bottom');
			}
			if (new_step < ground_value) {
				new_step = ground_value;
				photberry_nav.addClass('overflowed_top');
				photberry_nav.removeClass('overflowed_bottom');
			}
			current_menu.css('top', new_step + 'px');
		}
	});
	photberry_nav.on('touchend', function(event) {
		current_menu_touch = 0;
	});

	photberry_theme_setup();

	if (jQuery('.photberry_flickr_widget_wrapper').size() > 0) {
		photberry_flickr_widget();
	}

	// Filter
    jQuery('.photberry_grid_filter li').eq(0).find('a').click();

    jQuery('.photberry_grid_filter li a').on('click', function(){
        jQuery('.photberry_grid_filter li a').removeClass('is-checked');
        jQuery('.photberry_grid_filter li').removeClass('is-checked');
        jQuery(this).addClass('is-checked');
        jQuery(this).parent().addClass('is-checked');
        var filterSelector = jQuery(this).attr('data-category');

        jQuery('.photberry_isotope_trigger').isotope({
            filter: filterSelector
        });
        setTimeout("jQuery('.photberry_grid_filter li a.is-checked').click();", 500);
        return false;
    });


	// Custom Select
	// jQuery('.photberry_tiny').find('select').not( ".tmcp-select" ).each(function(){
	// 	var $this = jQuery(this),
	// 		numberOfOptions = $this.children('option').length,
    //         thisWidth = $this.width() + parseInt($this.css('padding-left'),10) + parseInt($this.css('padding-right'),10),
	// 		this_val = $this.val();

	// 	$this.addClass('select-hidden');
	// 	$this.wrap('<div class="photberry_select_wrapper" style = "min-width: '+ thisWidth +'px"></div>');
	// 	$this.after('<div class="photberry_select"></div>');

	// 	var $styledSelect = $this.next('div.photberry_select');
    //     if (this_val == '') {
    //         $styledSelect.text($this.children('option').eq(0).text());
    //     } else {
    //         $styledSelect.text($this.children('option[value="'+ this_val +'"]').text());
    //     }

	// 	var $list = jQuery('<ul />', {
	// 		'class': 'select-options'
	// 	}).insertAfter($styledSelect);

	// 	for (var i = 0; i < numberOfOptions; i++) {
	// 		jQuery('<li />', {
	// 			text: $this.children('option').eq(i).text(),
	// 			rel: $this.children('option').eq(i).val()
	// 		}).appendTo($list);
	// 	}

	// 	var $listItems = $list.children('li');

	// 	$styledSelect.click(function(e) {
	// 		e.stopPropagation();
    //         var $this_list = jQuery(this).next('ul.select-options'),
    //             max_height = photberry_window.height()/2;

	// 		jQuery('div.photberry_select.active').not(this).each(function(){
    //             var $this_list = jQuery(this).next('ul.select-options');
	// 			jQuery(this).removeClass('active').next('ul.select-options').hide();
    //             $this_list.removeClass('long_select').css('max-height', 'none');
	// 		});

    //         if ($this_list.height() > max_height && !jQuery(this).hasClass('active')) {
    //             $this_list.addClass('long_select');
    //             $this_list.css('max-height', max_height+'px');
    //         } else {
    //             $this_list.removeClass('long_select').css('max-height', 'none');
    //         }
	// 		jQuery(this).toggleClass('active').next('ul.select-options').toggle();

	// 	});

	// 	$listItems.click(function(e) {
	// 		e.stopPropagation();
	// 		$styledSelect.text(jQuery(this).text()).removeClass('active');
	// 		$this.val(jQuery(this).attr('rel'));
    //         $this.trigger('change');
	// 		$list.hide().removeClass('long_select').css('max-height', 'none');
	// 	});

	// 	jQuery(document).click(function() {
	// 		$styledSelect.removeClass('active');
	// 		$list.hide().removeClass('long_select').css('max-height', 'none');
	// 	});
	// });

});

jQuery(window).load(function(){
	photberry_theme_setup();
	if (jQuery('.photberry_preview_customizer_nl').size() > 0) {
		setTimeout("jQuery('.photberry_preview_customizer_nl').removeClass('photberry_preview_customizer_nl')", 1200);
	}
});

jQuery(window).resize(function(){
	photberry_theme_setup();
});

jQuery('.photberry_main_header').on("click", '.open_sub_menu', function () {
	jQuery(this).parent('li').addClass('keep_this_li');
	jQuery(this).parent('li').parent('ul').addClass('sub_is_opened');
	photberry_nav.find('ul').css('top', '0px');
	jQuery(this).parent('li').children('ul.sub-menu').addClass('now_is_opened');

	if (photberry_nav.find('.now_is_opened').size() > 0) {
		var current_menu = jQuery('.now_is_opened:not(.sub_is_opened)');
	} else {
		var current_menu = jQuery('.photberry_menu');
	}
	if (current_menu.height() > photberry_nav.height()) {
		photberry_nav.addClass('overflowed');
		photberry_nav.removeClass('overflowed_top');
		photberry_nav.addClass('overflowed_bottom');
	} else {
		photberry_nav.removeClass('overflowed');
		photberry_nav.removeClass('overflowed_top');
		photberry_nav.removeClass('overflowed_bottom');
	}
});
jQuery(document).on("click", '.photberry_menu_back', function () {
	jQuery(this).parent('li').parent('ul').parent('li').removeClass('keep_this_li');
	jQuery(this).parent('li').parent('ul').parent('li').parent('ul').removeClass('sub_is_opened');
	photberry_nav.find('ul').css('top', '0px');
	jQuery(this).parent('li').parent('ul').parent('li').children('ul.sub-menu').removeClass('now_is_opened');

	if (photberry_nav.find('.now_is_opened').size() > 0) {
		var current_menu = jQuery('.now_is_opened:not(.sub_is_opened)');
	} else {
		var current_menu = jQuery('.photberry_menu');
	}
	if (current_menu.height() > photberry_nav.height()) {
		photberry_nav.addClass('overflowed');
		photberry_nav.removeClass('overflowed_top');
		photberry_nav.addClass('overflowed_bottom');
	} else {
		photberry_nav.removeClass('overflowed');
		photberry_nav.removeClass('overflowed_top');
		photberry_nav.removeClass('overflowed_bottom');
	}
});

jQuery(document).on("click", '.photberry_menu_toggler', function () {
	jQuery('html').toggleClass('photberry_show_header');
});
jQuery(document).on("click", '.photberry_mobile_menu_toggler', function () {
	jQuery('html').toggleClass('photberry_show_mobile_header');
	jQuery('.photberry_mobile_header_inner').slideToggle(400);
});
jQuery('.photberry_mobile_header').on("click", '.open_sub_menu', function () {
	jQuery(this).parent('li').toggleClass('photberry_mobile_submenu_showed');
	jQuery(this).parent('li').children('ul.sub-menu').toggleClass('photberry_mobile_submenu_showed').slideToggle(400);

});


jQuery('a[href="#"]').on('click', function(event){
    event.preventDefault();
});

function photberry_theme_setup() {
	if (jQuery('section.elementor-section-height-full').size() > 0 && photberry_window.width() < 1200) {
		jQuery('section.elementor-section-height-full').height(photberry_window.height());
	}
	if (jQuery('.photberry_portfolio_packery').size() > 0) {
		photberry_portfolio_packery_setup();
		setTimeout("photberry_portfolio_packery_setup()", 750);
	}
	if (jQuery('.photberry_albums_packery').size() > 0) {
		photberry_albums_packery_setup();
		setTimeout("photberry_albums_packery_setup()", 750);
	}
	if (jQuery('.photberry_owlCarousel').size() > 0) {
		jQuery('.photberry_owlCarousel').each(function () {
			jQuery(this).trigger('refresh.owl.carousel');
		});
	}
	if (jQuery('.photberry_content').size() > 0) {
		var set_min_height = photberry_window.height();
		if (jQuery('footer.photberry_footer').size() > 0) {
			set_min_height = set_min_height - jQuery('footer.photberry_footer').height();
		}
		if (jQuery('#wpadminbar').size() > 0) {
			set_min_height = set_min_height - jQuery('#wpadminbar').height();
		}
		if (jQuery('.photberry_verticaly_page_wrapper').size() > 0) {
			var centered_page_container = jQuery('.photberry_verticaly_page_wrapper'),
				set_centered_top = 0;
			if (set_min_height > centered_page_container.height()) {
				set_centered_top = (set_min_height - centered_page_container.height())/2;
				centered_page_container.css('top', set_centered_top + 'px').addClass('centered_this');
			} else {
				centered_page_container.css('top', '0px').addClass('stick_to_top');;
			}
		}
		jQuery('.photberry_content').css('min-height', set_min_height+'px');
	}

	/* Menu Setup */
	if (!photberry_nav.hasClass('ready')) {
		// First time menu setup
		photberry_nav.addClass('ready');
		photberry_nav.find('ul.sub-menu').prepend('<li class="photberry_li_back"><a href="javascript:void(0)" class="photberry_menu_back">'+ photberry_nav.attr('data-back') +'</a></li>');
	}
	var set_nav_height = jQuery('.photberry_main_header').height() - jQuery('.photberry_logo_cont').height() - parseInt(jQuery('.photberry_logo_cont').css('padding-top'))  - parseInt(jQuery('.photberry_logo_cont').css('padding-bottom')) - jQuery('.photberry_aside_footer').height();
	photberry_nav.height(set_nav_height);
	photberry_nav.find('ul').css('top', '0px');
	if (photberry_nav.find('.now_is_opened').size() > 0) {
		var current_menu = jQuery('.now_is_opened:not(.sub_is_opened)');
	} else {
		var current_menu = jQuery('.photberry_menu');
	}
	if (current_menu.height() > photberry_nav.height()) {
		photberry_nav.addClass('overflowed');
		photberry_nav.removeClass('overflowed_top');
		photberry_nav.addClass('overflowed_bottom');
	} else {
		photberry_nav.removeClass('overflowed');
		photberry_nav.removeClass('overflowed_top');
		photberry_nav.removeClass('overflowed_bottom');
	}

	if (jQuery('.photberry_pf_fullwidth').size() > 0 && jQuery('.photberry_sidebar').size() < 1) {
		var set_width = jQuery('.photberry_site_wrapper').width();
		jQuery('.photberry_pf_fullwidth').each(function() {
			var set_mar = (jQuery('.photberry_container').width() - set_width)/2;
			jQuery(this).width(set_width).css('margin-left', set_mar+'px');
		});
	}

}

function photberry_ajax_query_posts(photberry_ajax_query_posts_this, photberry_ajax_query_posts_first_load) {
    var photberry_return_to = photberry_ajax_query_posts_this.attr('data-return-to');
    var photberry_ajax_query_posts_data_args = photberry_ajax_query_posts_this.data('args');
    photberry_ajax_query_posts_this.removeClass('photberry_ajax_query_posts').addClass('photberry_ajax_query_posts_disabled');
    if (photberry_ajax_query_posts_first_load == true) {
        var photberry_ajax_query_posts_per_page = parseInt(photberry_ajax_query_posts_data_args['posts_first_load'], 10);
        var photberry_ajax_query_posts_per_page_old = photberry_ajax_query_posts_data_args['posts_per_page'];
        photberry_ajax_query_posts_data_args['posts_per_page'] = photberry_ajax_query_posts_per_page;
        jQuery('.photberry_ajax_query_posts_active_preloader').addClass('first_load');
    } else {
        photberry_ajax_query_posts_per_page = parseInt(photberry_ajax_query_posts_data_args['posts_per_page'], 10);
    }

	jQuery.post(photberry_ajaxurl.url, {
        action: 'photberry_ajax_query_posts',
        photberry_ajax_query_posts: '' + JSON.stringify(photberry_ajax_query_posts_data_args) + ''
    }).done(function (data) {
        if (jQuery('.'+photberry_return_to).hasClass('photberry_isotope_trigger')) {
            var grid_cont = jQuery('.photberry_isotope_trigger');

            grid_cont.isotope('insert', jQuery(data), function(){
                grid_cont.ready(function(){
                    grid_cont.isotope('reLayout');
                });
            });

            grid_cont.imagesLoaded().progress( function() {
                grid_cont.isotope("layout");
            });

            setTimeout("jQuery('.photberry_isotope_trigger').find('.photberry_load').removeClass('photberry_load')", 500);

        } else {
            jQuery('.' + photberry_return_to).append(data);
            setTimeout(function(){
                var photberry_return_to = photberry_ajax_query_posts_this.attr('data-return-to');

                jQuery('.' + photberry_return_to).find('.photberry_load').removeClass('photberry_load');
            }, 500);

        }

        if (photberry_ajax_query_posts_first_load == true) {
            photberry_ajax_query_posts_data_args['posts_per_page'] = photberry_ajax_query_posts_per_page_old;
        }

        if (typeof photberry_ajax_query_posts_data_args['row_counter'] !== "undefined") {
            if (photberry_ajax_query_posts_first_load == true) {
                photberry_ajax_query_posts_data_args['row_counter'] = parseInt(photberry_ajax_query_posts_data_args['row_counter'], 10) + parseInt(photberry_ajax_query_posts_data_args['rows_first_load'], 10);
            } else {
                photberry_ajax_query_posts_data_args['row_counter'] = parseInt(photberry_ajax_query_posts_data_args['row_counter'], 10) + parseInt(photberry_ajax_query_posts_data_args['rows_per_click'], 10);
            }
        }
        photberry_ajax_query_posts_data_args['offset'] = parseInt(photberry_ajax_query_posts_data_args['offset'], 10) + photberry_ajax_query_posts_per_page;
        photberry_ajax_query_posts_data_args['posts_counter'] = parseInt(photberry_ajax_query_posts_data_args['posts_counter'], 10) + photberry_ajax_query_posts_per_page;

        photberry_ajax_query_posts_this.attr('data-args', JSON.stringify(photberry_ajax_query_posts_data_args));
        photberry_ajax_query_posts_this.addClass('photberry_ajax_query_posts').removeClass('photberry_ajax_query_posts_disabled');
        if (photberry_ajax_query_posts_data_args['ajax_callback_function']) {
            window[photberry_ajax_query_posts_data_args['ajax_callback_function']]();
        }
        var all_posts_this = jQuery('.' + photberry_return_to).find('input[name="count_posts"]'),
            last_post_this = jQuery('.' + photberry_return_to).find('input[name="posts_counter"]'),
            all_posts = parseInt(all_posts_this.attr('value'), 10),
            last_post = parseInt(last_post_this.attr('value'), 10);

        all_posts_this.remove();
        last_post_this.remove();

        if (last_post > all_posts) {
            photberry_ajax_query_posts_this.fadeOut();
			photberry_ajax_query_posts_this.parent('.photberry_load_more_button_wrapper').addClass('all_posts_loaded');
        }
    });
}
if (jQuery('.photberry_ajax_query_posts').size() > 0) {
    jQuery('.photberry_ajax_query_posts').each(function () {
		var $this = jQuery(this);
		if ($this.hasClass('photberry_ajax_isotope')) {
			var $container = jQuery('.' + $this.attr('data-return-to'));
			if ($container.data('isotope')) {
				photberry_ajax_query_posts(jQuery(this), true);
			} else {
				$this.addClass('wait4react');
				photberry_ajax_query_rerun();
			}
		} else {
        	photberry_ajax_query_posts(jQuery(this), true);
		}
    });

    jQuery(document).on("click", ".photberry_ajax_query_posts", function () {
        photberry_ajax_query_posts(jQuery(this), false);
    });
}

function photberry_ajax_query_rerun() {
	if (jQuery('.photberry_ajax_query_posts.wait4react').length) {
		jQuery('.photberry_ajax_query_posts.wait4react').each(function(){
			var $this = jQuery(this),
				$container = jQuery('.' + $this.attr('data-return-to'));
			$this.removeClass('wait4react');
			if ($container.data('isotope')) {
				photberry_ajax_query_posts($this, true);
			} else {
				$this.addClass('wait4react');
				setTimeout("photberry_ajax_query_rerun()", 500);
			}
		});
	}
}

function photberry_countdown() {
    jQuery('.photberry_countdown').each(function(){
        var pm_year = jQuery(this).attr('data-year'),
            pm_month = jQuery(this).attr('data-month'),
            pm_day = jQuery(this).attr('data-day'),
            austDay = new Date(pm_year, pm_month - 1, pm_day);

        jQuery(this).countdown({
            until: austDay,
            padZeroes: true
        });
    });
}

// PM Flicker Widget
function photberry_flickr_widget () {
	jQuery('.photberry_flickr_widget_wrapper').each(function () {
		var flickrid = jQuery(this).attr('data-flickrid'),
			widget_id = jQuery(this).attr('data-widget_id'),
			widget_number = jQuery(this).attr('data-widget_number');

		jQuery(this).addClass('photberry_flickr_widget_wrapper'+flickrid);

		jQuery.getJSON("https://api.flickr.com/services/feeds/photos_public.gne?id="+widget_id+"&lang=en-us&format=json&jsoncallback=?", function(data){
			jQuery.each(data.items, function(i,item){
				if(i<widget_number){
					jQuery("<img/>").attr("src", item.media.m).appendTo(".photberry_flickr_widget_wrapper"+flickrid).wrap("<div class=\'photberry_flickr_badge_image\'><a href=\'" + item.link + "\' target=\'_blank\' title=\'Flickr\'></a></div>");
				}
			});
		});
	});
}

function photberry_portfolio_grid_setup() {
	jQuery('.photberry_portfolio_grid').each(function(){
		var setPad = parseInt(jQuery(this).attr('data-setPad'))/2;
		jQuery(this).css('margin', setPad+'px').css('margin-top', -1*setPad+'px');
		jQuery(this).find('.photberry_portfolio_grid_item .photberry_inner_cont').css({
			'margin-left' : setPad+'px',
			'margin-top' : setPad+'px',
			'margin-right' : setPad+'px',
			'margin-bottom' : setPad+'px'
		});
	});
}

function photberry_albums_grid_setup() {
	jQuery('.photberry_albums_grid').each(function(){
		var setPad = parseInt(jQuery(this).attr('data-setPad'))/2;
		jQuery(this).css('margin', setPad+'px').css('margin-top', -1*setPad+'px');
		jQuery(this).parent('.photberry_front_end_display').find('.photberry_load_more_button_wrapper').css('padding-bottom', setPad*2+'px');
		jQuery(this).find('.photberry_albums_grid_item .photberry_inner_cont').css({
			'margin-left' : setPad+'px',
			'margin-top' : setPad+'px',
			'margin-right' : setPad+'px',
			'margin-bottom' : setPad+'px'
		});
	});
}

/* Packery Portfolio */
function photberry_animatePostsPackery() {
	if (jQuery('.load_anim:first').size() > 0) {
		(function (img, src) {
			img.src = src;
			img.onload = function () {
				jQuery('.load_anim:first').find('.packery-item-inner').css('background-image', 'url(' + jQuery('.load_anim:first').find('.packery-item-inner').attr('data-src') + ')');
				jQuery('.load_anim:first').removeClass('load_anim').removeClass('anim_el').animate({
					'z-index': '15'
				}, 200, function() {
					photberry_animatePostsPackery();
				});
			};
		}(new Image(), jQuery('.load_anim:first').find('.packery-item-inner').attr('data-src')));
	}
}
function photberry_index_packery() {
	if (jQuery('.wait4index:first').size() > 0) {
		var packery_container = jQuery('.wait4index:first').parent('.is_packery');
		if (packery_container.find('.indexed').size() > 0) {
			var set_index = packery_container.find('.indexed:last').attr('data-count');
		} else {
			var set_index = 0;
		}
		set_index++;
		if (set_index > 8) {
			set_index = 1;
		}
		jQuery('.wait4index:first').attr('data-count', set_index).addClass('packery-item'+set_index).removeClass('wait4index').addClass('indexed');
		photberry_index_packery();
	}
}
function photberry_portfolio_packery_setup() {
	photberry_index_packery();
	jQuery('.photberry_portfolio_packery').each(function(){
		var setPad = Math.floor(parseInt(jQuery(this).attr('data-setPad'))/2);
		jQuery(this).parent('.photberry_portfolio_packery_wrapper').css('padding', setPad+'px');
		if (photberry_window.width() < 1200 && setPad > 20) {
			setPad = setPad/2;
		}
		if (photberry_window.width() < 760 && setPad > 10) {
			setPad = 10;
		}

		jQuery(this).parents('.photberry_front_end_display').find('.photberry_load_more_button_wrapper').css('padding-bottom', setPad*2+'px');

		var	norm_size = Math.floor((jQuery(this).width())/4),
			double_size = norm_size*2;

		jQuery(this).find('.packery-item').each(function(){
			if (jQuery(this).hasClass('anim_el2')) {
				jQuery(this).removeClass('anim_el2');
			}
			var set_w = norm_size,
				set_h = norm_size;
			if (jQuery(this).hasClass('packery-item1') || jQuery(this).hasClass('packery-item7')) {
				set_w = double_size,
				set_h = double_size;
			}
			if (jQuery(this).hasClass('packery-item4') || jQuery(this).hasClass('packery-item8')) {
				set_w = double_size,
				set_h = norm_size;
			}
			if (photberry_window.width() < 760) {
				set_w = photberry_window.width() - setPad*2;
				set_h = photberry_window.width() - setPad*2;
			}
			jQuery(this).find('.packery-item-inner').css({
				'margin-left' : setPad+'px',
				'margin-top' : setPad+'px',
				'margin-right' : setPad+'px',
				'margin-bottom' : setPad+'px',
				'width' : (set_w-setPad*2)+'px',
				'height' : (set_h-setPad*2)+'px'
			});
			jQuery(this).css({
				'width' : set_w+'px',
				'height' : set_h+'px'
			});
			if (jQuery(this).hasClass('anim_el2')) {
				jQuery(this).removeClass('anim_el2');
			}
		});

		jQuery('.photberry_portfolio_packery').isotope('layout');
		setTimeout("jQuery('.photberry_portfolio_packery').isotope('layout')",1000);
	});
	photberry_animatePostsPackery();
}

/* Packery Albums */
function photberry_albums_packery_setup() {
	photberry_index_packery();
	jQuery('.photberry_albums_packery').each(function(){
		var setPad = Math.floor(parseInt(jQuery(this).attr('data-setPad'))/2);
		jQuery(this).parent('.photberry_albums_packery_wrapper').css('padding', setPad+'px');
		if (photberry_window.width() < 1200 && setPad > 20) {
			setPad = setPad/2;
		}
		if (photberry_window.width() < 760 && setPad > 10) {
			setPad = 10;
		}

		jQuery(this).parents('.photberry_front_end_display').find('.photberry_load_more_button_wrapper').css('padding-bottom', setPad*2+'px');

		var	norm_size = Math.floor((jQuery(this).width())/4),
			double_size = norm_size*2;

		jQuery(this).find('.packery-item').each(function(){
			if (jQuery(this).hasClass('anim_el2')) {
				jQuery(this).removeClass('anim_el2');
			}
			var set_w = norm_size,
				set_h = norm_size;
			if (jQuery(this).hasClass('packery-item1') || jQuery(this).hasClass('packery-item7')) {
				set_w = double_size,
				set_h = double_size;
			}
			if (jQuery(this).hasClass('packery-item4') || jQuery(this).hasClass('packery-item8')) {
				set_w = double_size,
				set_h = norm_size;
			}
			if (photberry_window.width() < 760) {
				set_w = photberry_window.width() - setPad*2;
				set_h = photberry_window.width() - setPad*2;
			}
			jQuery(this).find('.packery-item-inner').css({
				'margin-left' : setPad+'px',
				'margin-top' : setPad+'px',
				'margin-right' : setPad+'px',
				'margin-bottom' : setPad+'px',
				'width' : (set_w-setPad*2)+'px',
				'height' : (set_h-setPad*2)+'px'
			});
			jQuery(this).css({
				'width' : set_w+'px',
				'height' : set_h+'px'
			});
			if (jQuery(this).hasClass('anim_el2')) {
				jQuery(this).removeClass('anim_el2');
			}
		});

		jQuery('.photberry_albums_packery').isotope('layout');
		setTimeout("jQuery('.photberry_albums_packery').isotope('layout')",1000);
	});
	photberry_animatePostsPackery();
}

jQuery(document).on("click", "#swipebox-container .slide.current img", function (e) {
	jQuery('#swipebox-next').click();
	e.stopPropagation();
});

jQuery(document).on("click", "#swipebox-container", function (e) {
	jQuery('#swipebox-close').click();
});
