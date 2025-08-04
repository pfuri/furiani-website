/*
 * Grid Gallery
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/
"use strict";
var $photberry_container = jQuery('.photberry_grid_inner'),
	photberry_grid_array = [],
	$photberry_grid_gallery_array = jQuery('.photberry_grid_gallery_array'),
	$photberry_grid_wrapper = jQuery('.photberry_grid_wrapper');

$photberry_grid_wrapper.each(function() {
	var $this_obj = jQuery(this);
	photberry_grid_array["photberry_grid_" + $this_obj.attr('data-uniqid')] = {};
	var this_array = photberry_grid_array["photberry_grid_" + $this_obj.attr('data-uniqid')];
	this_array.id = jQuery(this).attr('data-uniqid');
	this_array.showed = 0;
	this_array.items = [];
	
	var this_items_array = this_array.items;
	if ($this_obj.find('.photberry_grid_gallery_array').length) {
		$this_obj.find('.photberry_grid_gallery_array').each(function() {
			jQuery(this).find('.photberry_grid_array_item').each(function() {
				var $this = jQuery(this),
					photberry_grid_item = {};
				photberry_grid_item.slide_type = $this.attr('data-type');
				photberry_grid_item.img = $this.attr('data-img');
				photberry_grid_item.thmb = $this.attr('data-thmb');
				photberry_grid_item.title = $this.attr('data-title');
				photberry_grid_item.alt = $this.attr('data-alt');
				photberry_grid_item.counter = $this.attr('data-counter');
				this_items_array.push(photberry_grid_item);
			});
			jQuery(this).remove();
		});
	}
	
	this_array.obj = jQuery('.photberry_grid_'+this_array.id);
	
	this_array.init = function () {
		var this_obj = this;
		this.obj.find('.grid_load_more').on("click", function () {
			this_obj.loadmore.call(this_obj);
		});
		this.setup.call(this);
		this.preloader.call(this);
	}
	
	this_array.preloader = function() {
		var this_obj = this,
			$this_dom = this.obj;
		if ($this_dom.find('.load_anim_grid:first').size() > 0) {
			(function (img, src) {
				img.src = src;
				img.onload = function () {
					$this_dom.find('.load_anim_grid:first').removeClass('load_anim_grid').removeClass('anim_el2').removeClass('anim_el').animate({
						'z-index': '15'
					}, 200, function() {
						$this_dom.find('.photberry_grid_inner').isotope('layout');
						this_obj.setup.call(this_obj);
						this_obj.preloader.call(this_obj);
					});
				};
			}(new Image(), $this_dom.find('.load_anim_grid:first').find('img').attr('src')));
		} else {
			this_obj.setup.call(this_obj);
		}
	}
	
	this_array.setup = function() {
		var this_obj = this,
			$this_dom = this.obj;
		if ($this_dom.find('.photberry_js_bg_color').length) {
			$this_dom.find('.photberry_js_bg_color').each(function () {
				jQuery(this).css('background-color', jQuery(this).attr('data-bgcolor'));
			});
		}
		var side_padding = Math.floor(parseInt($this_dom.find('.photberry_grid_inner').attr('data-pad'))/2,10);
		if (photberry_window.width() < 1200 && side_padding > 20) {
			side_padding = side_padding/2;
		}
		if (photberry_window.width() < 760 && side_padding > 10) {
			side_padding = 10;
		}
		if (jQuery('.photberry_single_gallery_grid').length) {
			$this_dom.find('.photberry_grid_inner').css('margin', side_padding+'px').css('margin-bottom', '0px');
			jQuery('.photberry_single_gallery_grid').css('padding-bottom', side_padding+'px');
		} else {
			$this_dom.find('.photberry_grid_inner').css('margin', side_padding+'px').css('margin-top', -1*side_padding+'px');
		}
		if ($this_dom.find('.photberry_grid_inner').hasClass('side_paddings_on')) {
			$this_dom.find('.photberry_grid_inner').css('margin-left', -1*side_padding+'px').css('margin-right', -1*side_padding+'px');
		}
		$this_dom.find('.grid-item-inner').css({
			'margin-left' : side_padding+'px',
			'margin-top' : side_padding+'px',
			'margin-right' : side_padding+'px',
			'margin-bottom' : side_padding+'px'
		});
		/*$this_dom.find('.grid-item').each(function(){
			if (jQuery(this).hasClass('anim_el2')) {
				jQuery(this).removeClass('anim_el2');
			}
		});*/
		$this_dom.find('.photberry_grid_inner').isotope('layout');
		setTimeout("jQuery('.photberry_grid_inner').isotope('layout')",1000);
	}
							   
	this_array.loadmore = function() {
		var this_obj = this,
			$this_dom = this.obj,
			photberry_what_to_append = '',		
			photberry_grid_post_per_page = $this_dom.attr('data-perload'),
			photberry_uniqid = this.id,
			photberry_allposts = this.items.length,
			photberry_count = $this_dom.find('.grid-item').size(),
			photberry_ins_container = $this_dom.find('.photberry_grid_inner'),
			photberry_load_more_button = $this_dom.find('.grid_load_more');
	
		if (this.showed >= photberry_allposts) {
			photberry_load_more_button.slideUp(300);
		} else {
			var photberry_now_step = this.showed + parseInt(photberry_grid_post_per_page) - 1;
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
			for (var i = this.showed; i <= photberry_limit; i++) {
				var photberry_thishref = this.items[i].img,
				photberry_what_to_append = photberry_what_to_append +'\
                <div class="grid-item element anim_el anim_el2 load_anim_grid grid_b2p">\
                    <div class="grid-item-inner">\
                        <a href="' + photberry_thishref +'" class="swipebox" rel="grid_gallery'+ this.id +'" data-elementor-open-lightbox="no">\
                            <img src="'+ this.items[i].thmb +'" alt="' + this.items[i].alt + '" class="grid_thmb"/>\
                            <div class="grid-item-content">\
                                <h4>'+ this.items[i].title +'</h4>\
                            </div>\
                        </a>\
                        <div class="photberry-img-preloader"></div>\
                    </div>\
				</div>';
				photberry_count++;

				this.showed++;
			}

			var $photberry_newItems = jQuery(photberry_what_to_append);

			if (photberry_ins_container.data('isotope') && jQuery('.elementor-editor-active').size() < 1) {
				photberry_ins_container.isotope('insert', $photberry_newItems, function() {
					photberry_ins_container.find('.photberry_grid_inner').ready(function() {
						photberry_ins_container.isotope('layout');
						this_obj.setup.call(this_obj);
					});
				});
			}
			this_obj.setup.call(this_obj);
			this_obj.preloader.call(this_obj);
		}
		jQuery('.photberry_grid_inner').isotope("layout");
		setTimeout(function () {jQuery('.gallery_grid').isotope("layout");}, 1500);
	}
});

jQuery(document).ready(function(){
	$photberry_grid_wrapper.each(function() {
		var $this_obj = jQuery(this),
			this_obj = photberry_grid_array["photberry_grid_" + $this_obj.attr('data-uniqid')];
		this_obj.init.call(this_obj);
	});
});

jQuery(window).load(function () {
	$photberry_grid_wrapper.each(function() {
		var $this_obj = jQuery(this),
			this_obj = photberry_grid_array["photberry_grid_" + $this_obj.attr('data-uniqid')];
		this_obj.setup.call(this_obj);
	});
});
jQuery(window).resize(function () {
	$photberry_grid_wrapper.each(function() {
		var $this_obj = jQuery(this),
			this_obj = photberry_grid_array["photberry_grid_" + $this_obj.attr('data-uniqid')];
		this_obj.setup.call(this_obj);
	});
});