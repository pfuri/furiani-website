/*
 * Packery Gallery
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/
"use strict";
var $photberry_container = jQuery('.photberry_packery_inner'),
	photberry_packery_array = [],
	$photberry_packery_gallery_array = jQuery('.photberry_packery_gallery_array'),
	$photberry_packery_wrapper = jQuery('.photberry_packery_wrapper');

$photberry_packery_wrapper.each(function() {
	var $this_obj = jQuery(this);
	photberry_packery_array["photberry_packery_" + $this_obj.attr('data-uniqid')] = {};
	var this_array = photberry_packery_array["photberry_packery_" + $this_obj.attr('data-uniqid')];
	this_array.id = jQuery(this).attr('data-uniqid');
	this_array.showed = 0;
	this_array.items = [];
	
	var this_items_array = this_array.items;
	if ($this_obj.find('.photberry_packery_gallery_array').length) {
		$this_obj.find('.photberry_packery_gallery_array').each(function() {
			jQuery(this).find('.photberry_packery_array_item').each(function(){
				var $this = jQuery(this),
					photberry_packery_item = {};
				photberry_packery_item.slide_type = $this.attr('data-type');
				photberry_packery_item.img = $this.attr('data-img');
				photberry_packery_item.thmb = $this.attr('data-thmb');
				photberry_packery_item.title = $this.attr('data-title');
				photberry_packery_item.alt = $this.attr('data-alt');
				photberry_packery_item.overlay = $this.attr('data-overlay');
				photberry_packery_item.counter = $this.attr('data-counter');
				this_items_array.push(photberry_packery_item);
			});
			jQuery(this).remove();
		});
	}

	this_array.obj = jQuery('.photberry_packery_'+this_array.id);
	
	this_array.init = function () {
		var this_obj = this;
		this.obj.find('.packery_load_more').on("click", function () {
			this_obj.loadmore.call(this_obj);
		});
		this.setup.call(this);
		this.preloader.call(this);
	}
	
	this_array.preloader = function() {
		var this_obj = this,
			$this_dom = this.obj;
		if ($this_dom.find('.load_anim:first').size() > 0) {
			(function (img, src) {
				img.src = src;
				img.onload = function () {
					$this_dom.find('.load_anim:first').removeClass('load_anim').removeClass('anim_el').animate({
						'z-index': '15'
					}, 200, function() {
						$this_dom.find('.photberry_packery_inner').isotope('layout');
						this_obj.setup.call(this_obj);
						this_obj.preloader.call(this_obj);
					});
				};
			}(new Image(), $this_dom.find('.load_anim:first').find('.packery-item-inner').attr('data-src')));
		} else {
			this_obj.setup.call(this_obj);
		}
	}
	
	this_array.setup = function() {
		var this_obj = this,
			$this_dom = this.obj;
		
		$this_dom.find('.photberry_packery_inner').each(function() {
			var side_padding = Math.floor(parseInt(jQuery(this).attr('data-pad'))/2);
			jQuery(this).parent('.photberry_packery_wrapper').css('padding', side_padding+'px');
			if (photberry_window.width() < 1200 && side_padding > 20) {
				side_padding = side_padding/2;
			}
			if (photberry_window.width() < 760 && side_padding > 10) {
				side_padding = 10;
			}
			if (photberry_window.width() > 760) {
				var	small_item = Math.floor((jQuery(this).width())/4),
					large_item = small_item*2;
			} else {
				var	small_item = Math.floor(jQuery(this).width()),
					large_item = small_item;
			}
			if (jQuery(this).hasClass('side_paddings_on')) {
				jQuery(this).css('margin-left', -1*side_padding+'px').css('margin-right', -1*side_padding+'px');
				jQuery(this).parent('.photberry_packery_wrapper').css('padding-left','0px').css('padding-right','0px');
			}
			jQuery(this).find('.packery-item').each(function(){
				if (jQuery(this).hasClass('anim_el2')) {
					jQuery(this).removeClass('anim_el2');
				}
				var set_item_width = small_item,
					set_item_height = small_item;					
				if (jQuery(this).hasClass('packery-item1') || jQuery(this).hasClass('packery-item7')) {
					set_item_width = large_item,
					set_item_height = large_item;
				}
				if (jQuery(this).hasClass('packery-item4') || jQuery(this).hasClass('packery-item8')) {
					set_item_width = large_item,
					set_item_height = small_item;
				}
				jQuery(this).find('.packery-item-inner').css({
					'margin-left' : side_padding+'px',
					'margin-top' : side_padding+'px',
					'margin-right' : side_padding+'px',
					'margin-bottom' : side_padding+'px',
					'width' : (set_item_width-side_padding*2)+'px',
					'height' : (set_item_height-side_padding*2)+'px'
				});
				jQuery(this).css({
					'width' : set_item_width+'px',
					'height' : set_item_height+'px'
				});
				if (jQuery(this).hasClass('anim_el2')) {
					jQuery(this).removeClass('anim_el2');
				}				
			});

			jQuery('.photberry_packery_inner').isotope('layout');
			setTimeout("jQuery('.photberry_packery_inner').isotope('layout')",1000);
		});
		
	}
							   
	this_array.loadmore = function() {
		var this_obj = this,
			$this_dom = this.obj,
			photberry_what_to_append = '',		
			photberry_packery_post_per_page = $this_dom.attr('data-perload'),
			photberry_uniqid = this.id,
			photberry_allposts = this.items.length,
			photberry_overlay = $this_dom.find('.photberry_packery_inner').attr('data-overlay'),
			photberry_count = $this_dom.find('.packery-item').size(),
			photberry_ins_container = $this_dom.find('.photberry_packery_inner'),
			photberry_load_more_button = $this_dom.find('.packery_load_more');
		var current_count = parseInt($this_dom.find('.packery-item:last').attr('data-count'));
		
		if (this.showed >= photberry_allposts) {
			photberry_load_more_button.slideUp(300);
		} else {
			var photberry_now_step = this.showed + parseInt(photberry_packery_post_per_page) - 1;
			if ((photberry_now_step + 1) < photberry_allposts) {
				var photberry_limit = photberry_now_step;
			} else {
				var photberry_limit = photberry_allposts - 1;
				photberry_load_more_button.slideUp(300);
			}
			
			var photberry_swipebox_class = '';
			if (jQuery('.photberry_single_gallery_wrapper ').size() > 0) {
				photberry_swipebox_class = 'swipebox';
			}
			for (var i = this_obj.showed; i <= photberry_limit; i++) {
				current_count ++;
				if (current_count > 8) {
					current_count = 1;
				}
				var photberry_thishref = this_obj.items[i].img,
				photberry_what_to_append = photberry_what_to_append +'\
                <div class="packery-item packery-item'+ current_count +' element anim_el anim_el2 load_anim packery_b2p" data-count="'+ current_count +'">\
                    <div class="packery-item-inner" data-src="'+ this_obj.items[i].thmb +'" style="background-image: url('+ this_obj.items[i].thmb +');">\
                        <a href="' + photberry_thishref +'" class="swipebox" rel="packery_gallery'+ this.id +'" data-elementor-open-lightbox="no">\
                            <div class="packery-item-content">\
                                <h4>'+ this_obj.items[i].title +'</h4>\
                            </div>\
                        </a>\
                        <div class="photberry-img-preloader"></div>\
                    </div>\
				</div>';

				photberry_count++;
				this_obj.showed++;
			}

			var $photberry_newItems = jQuery(photberry_what_to_append);

			if (photberry_ins_container.data('isotope') && jQuery('.elementor-editor-active').size() < 1) {
				photberry_ins_container.isotope('insert', $photberry_newItems, function() {
					photberry_ins_container.find('.photberry_packery_inner').ready(function() {
						photberry_ins_container.isotope('layout');
						photberry_setup_packery();
					});
				});
			} else {
				reinsert_items_2_isotope(photberry_ins_container, $photberry_newItems, 'packery');
			}
			this_obj.setup.call(this_obj);
			this_obj.preloader.call(this_obj);
		}
		jQuery('.photberry_packery_inner').isotope("layout");
		setTimeout(function () {jQuery('.gallery_packery').isotope("layout");}, 1500);
	}
});

jQuery(document).ready(function(){
	$photberry_packery_wrapper.each(function() {
		var $this_obj = jQuery(this),
			this_obj = photberry_packery_array["photberry_packery_" + $this_obj.attr('data-uniqid')];
		this_obj.init.call(this_obj);
	});
});

jQuery(window).load(function () {
	$photberry_packery_wrapper.each(function() {
		var $this_obj = jQuery(this),
			this_obj = photberry_packery_array["photberry_packery_" + $this_obj.attr('data-uniqid')];
		this_obj.setup.call(this_obj);
	});
});
jQuery(window).resize(function () {
	$photberry_packery_wrapper.each(function() {
		var $this_obj = jQuery(this),
			this_obj = photberry_packery_array["photberry_packery_" + $this_obj.attr('data-uniqid')];
		this_obj.setup.call(this_obj);
	});
});