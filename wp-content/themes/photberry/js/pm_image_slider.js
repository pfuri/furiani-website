/*
 * Images Slider
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/
"use strict";
var photberry_slider_object = {};
var $photberry_slider_wrapper = jQuery('.photberry_slider_wrapper'),
	photberry_slider_cur_count = jQuery('.photberry_slide_counter_current');

if ($photberry_slider_wrapper.hasClass('photberry_media_slider_wrapper')) {
	photberry_slider_object.type = 'media';
} else {
	photberry_slider_object.type = 'image';
}
photberry_slider_object.id = $photberry_slider_wrapper.attr('data-id');
photberry_slider_object.obj = $photberry_slider_wrapper;
photberry_slider_object.active_slide = 0;
photberry_slider_object.options = {
	autoplay: $photberry_slider_wrapper.attr('data-autoplay'),
	speed: $photberry_slider_wrapper.attr('data-interval'),
	thumbs: $photberry_slider_wrapper.attr('data-thumbs'),
	max: $photberry_slider_wrapper.find('.photberry_slider_slide').length,
}
photberry_slider_object.interval = setInterval("photberry_slider_object.move.call(photberry_slider_object,1)", photberry_slider_object.options.speed);

photberry_slider_object.init = function() {
	this.setup(this,'');
	if (this.active_slide == 0) 
		this.goto.call(this,1);

	// Touch and Click Events
	this.obj.on("swipeleft", function () {
		photberry_slider_object.move.call(photberry_slider_object,1);
	});
	this.obj.on("swipeup", function () {
		photberry_slider_object.move.call(photberry_slider_object,1);
	});
	this.obj.on("swiperight", function () {
		photberry_slider_object.move.call(photberry_slider_object,-1);
	});
	this.obj.on("swipedown", function () {
		photberry_slider_object.move.call(photberry_slider_object,-1);
	});

	jQuery('.photberry_slider_thumb').on('click',function(){
		photberry_slider_object.goto.call(photberry_slider_object, jQuery(this).attr('data-count'));
	});
	jQuery('.photberry_slider_btn_prev').on('click', function(){
		photberry_slider_object.move.call(photberry_slider_object,-1);
	});
	jQuery('.photberry_slider_btn_next').on('click', function(){
		photberry_slider_object.move.call(photberry_slider_object,1);
	});

	if (this.options.thumbs == 'on') {
		// Work with Thumbs
		var thumbs_top = 0,
			thumbs_obj = jQuery('.photberry_slider_thumbs_inner'),
			thumbs_obj_parent = jQuery('.photberry_slider_thumbs'),
			thumbs_max_val = thumbs_obj_parent.height() - thumbs_obj.height(),
			thumbs_step = -200,
			deltaY = 0;

		thumbs_obj.on('mousewheel', function (event) {		
			thumbs_obj = jQuery('.photberry_slider_thumbs_inner');
			thumbs_obj_parent = jQuery('.photberry_slider_thumbs');
			thumbs_max_val = thumbs_obj_parent.height() - thumbs_obj.height();
			deltaY = event.originalEvent.deltaY;
			if (thumbs_obj.height() > thumbs_obj_parent.height()) {
				thumbs_obj.removeClass('centered_thumbs');
				var this_top = parseInt(thumbs_obj.css('top'),10);
				if (deltaY > 0) {
					if (deltaY < 50) deltaY = 50;
					if ((this_top - deltaY) > thumbs_max_val) {
						thumbs_obj.css('top', this_top - deltaY + 'px');
					} else {
						thumbs_obj.css('top', thumbs_max_val + 'px');
					}
				}
				if (deltaY < 0) {
					if (deltaY > -50) deltaY = -50;
					if (this_top - deltaY < 0) {
						thumbs_obj.css('top', this_top - deltaY + 'px');
					} else {
						thumbs_obj.css('top', '0px');
					}
				}
				event.preventDefault();
			} else {
				thumbs_obj.addClass('centered_thumbs');
				jQuery('.photberry_slider_thumbs_inner').css('top', '50%');
			}
		});

		var this_thumbs_touch = 0;

		thumbs_obj.on('touchmove', function(event) {
			thumbs_obj = jQuery('.photberry_slider_thumbs_inner');
			thumbs_obj_parent = jQuery('.photberry_slider_thumbs');
			thumbs_max_val = thumbs_obj_parent.height() - thumbs_obj.height();
			if (thumbs_obj.height() > thumbs_obj_parent.height()) {
				event.preventDefault();

				var this_touch = event.originalEvent.touches[0].pageY,
					move_value = 0;
				if (this_thumbs_touch != 0) {
					if (this_touch > this_thumbs_touch) {
						var move_value = this_thumbs_touch - this_touch;
					}
					if (this_touch < this_thumbs_touch) {
						var move_value = this_thumbs_touch - this_touch;
					}
				}
				this_thumbs_touch = this_touch;

				var max_val = thumbs_max_val,
					this_step = parseInt(thumbs_obj.css('top'),10),
					new_step = this_step - move_value;

				if (new_step >= 0) {
					new_step = 0;
				}
				if (new_step < max_val) {
					new_step = max_val;
				}
				thumbs_obj.css('top', new_step + 'px');			
			} else {
				thumbs_obj.addClass('centered_thumbs');
				jQuery('.photberry_slider_thumbs_inner').css('top', '50%');
			}
		});
		thumbs_obj.on('touchend', function(event) {
			this_thumbs_touch = 0;
		});
	}

	// Window Events
	jQuery(window).on('load', function(){
		photberry_slider_object.obj.removeClass('photberry_module_loading');
		photberry_slider_object.setup.call(photberry_slider_object,'');
	});
	jQuery(window).on('resize', function(){
		photberry_slider_object.setup.call(photberry_slider_object,'');
	});
}

photberry_slider_object.setup = function(action) {
	switch (action) {
		case 'vframe':
			var $v_frame = this.obj.find('iframe'),
				w_check = this.obj.width(),
				h_check = this.obj.height(),
				prop_x = 16,
				prop_y = 9,
				coef = w_check/prop_x,
				h_coef = h_check/coef;
			
			$v_frame.removeClass('photberry_h_rule').removeClass('photberry_w_rule');
			if (this.obj.hasClass('video_fit') || photberry_window.width() < 1200) {
				$v_frame.height(h_check).width(w_check);
			} else {
				if (h_coef > prop_y) {
					var w_set = prop_x*h_check/prop_y;
					$v_frame.height(h_check+prop_y*10).width(w_set+prop_x*10).addClass('photberry_h_rule');
				} else {
					var h_set = prop_y*w_check/prop_x;
					$v_frame.width(w_check+prop_x*10).height(h_set+prop_y*10).addClass('photberry_w_rule');
				}				
			}
			break;

		default:
			if (this.options.thumbs == 'on') {
				var	$photberry_slider_thumbs = this.obj.find('.photberry_slider_thumbs'),
					$photberry_slider_thumbs_inner = $photberry_slider_thumbs.find('.photberry_slider_thumbs_inner');

				$photberry_slider_thumbs_inner.removeClass('centered_thumbs');
				if ($photberry_slider_thumbs_inner.height() < $photberry_slider_thumbs.height()) {
					$photberry_slider_thumbs_inner.addClass('centered_thumbs');
				}
			}
			
			if (this.obj.hasClass('photberry_single_gallery_slider')) {
				var this_height = photberry_window.height();
				if (jQuery('#wpadminbar').length) {
					this_height = this_height - jQuery('#wpadminbar').height();
				}
				this.obj.height(this_height);
			} else if (this.obj.hasClass('auto_height')) {
				var $this_column_wrap = this.obj.parents('.elementor-column-wrap'),
					this_height = this.obj.parents('section.elementor-element').children('.elementor-container').height() - parseInt($this_column_wrap.css('padding-top'),10) - parseInt($this_column_wrap.css('padding-bottom'),10);
				this.obj.height(this_height);
			}
			if (this.obj.hasClass('video_playing')) {
				this.setup.call(this,'vframe');
			}
	}
}

photberry_slider_object.move = function(dir) {
	if (dir > 0)
		this.active_slide++;
	if (dir < 0)
		this.active_slide--;
	if (this.active_slide < 1) 
		this.active_slide = this.options.max;
	if (this.active_slide > this.options.max) 
		this.active_slide = 1;

	this.update.call(this,this.active_slide);
}

photberry_slider_object.update = function(active) {
	this.obj.removeClass('video_playing');
	clearInterval(this.interval);
	
	var photberry_slides = this.obj.find('.photberry_slider_slide'),
		this_active = this.obj.find('[data-count='+ active +']');
	
	photberry_slides.removeClass('active');
	this_active.addClass('active');

	photberry_slides.find('iframe').remove();
	photberry_slides.find('div').remove();

	var counter_text = this.active_slide;
	if (counter_text < 10) 
		counter_text = '0'+counter_text;
	photberry_slider_cur_count.text(counter_text);

	if (this.type == 'media' && !this_active.hasClass('photberry_image_slide')) {
		this.obj.addClass('video_playing');
		if (this_active.attr('data-type') == 'youtube') {
			this.addYT.call(this, this_active);
		} else {
			this.addVimeo.call(this, this_active);
		}
	}

	if (this.options.autoplay == 'on' && !this.obj.hasClass('video_playing')) {
		photberry_slider_object.interval = setInterval("photberry_slider_object.move.call(photberry_slider_object,1)", photberry_slider_object.options.speed);
	}
}

photberry_slider_object.goto = function(slide) {
	this.active_slide = slide;

	if (this.active_slide < 1) 
		this.active_slide = this.options.max;
	if (this.active_slide > this.options.max)
		this.active_slide = 1;

	this.update.call(this,this.active_slide);
}

photberry_slider_object.addYT = function(slide) {
	if (slide == -1) {
		slide = this.obj.find('[data-count='+ this.active_slide +']');
	}
	var player;
	slide.append('<div id="player"></div>');

	if (jQuery('body').find('.photberry_youtube_api').length){
		player = new YT.Player('player', {
			height: '1600',
			width: '900',
			playerVars: { 'rel': 0, 'disablekb': 1 },
			videoId: slide.attr('data-src'),
			events: {
				'onReady': onPlayerReady,
				'onStateChange': onPlayerStateChange
			}
		});
		this.setup.call(this,'vframe');
	} else {
		setTimeout("photberry_slider_object.addYT.call(photberry_slider_object, -1)", 300);
	}
}

photberry_slider_object.addVimeo = function(slide) {
	console.log(slide);
	slide.append('<div id="vimeo_player"></div>');
	var $this = this;
	var vimeo_options = {
		id: slide.attr('data-src'),
		width: '1600',
		loop: false,
		autoplay: true
	};
	var v_player = new Vimeo.Player('vimeo_player', vimeo_options);
	this.setup.call(this,'vframe');
	v_player.on('play', function() {});
	v_player.on('ended', function() {
		$this.obj.removeClass('video_playing');
		if ($this.options.autoplay == 'on') {
			$this.move.call($this,1);
		}
	});
	v_player.on('loaded', function() {
		$this.setup.call($this,'vframe');
	});
}

jQuery(document.documentElement).keyup(function (event) {
	if ((event.keyCode == 37 || event.keyCode == 38)) {
		event.preventDefault();
		photberry_slider_object.move.call(photberry_slider_object,-1);
	}
	if ((event.keyCode == 39 || event.keyCode == 40)) {
		event.preventDefault();
		photberry_slider_object.move.call(photberry_slider_object,1);
	}
});

jQuery(document).ready(function(){
	photberry_slider_object.init.apply(photberry_slider_object);
});

/* 
 * Youtube Iframe API 
 * https://developers.google.com/youtube/iframe_api_reference?hl=en
*/

var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

function onYouTubeIframeAPIReady() {
	jQuery('body').append('<div class="photberry_youtube_api"/>');
}
function onPlayerReady(event) {
	event.target.playVideo();
}
function onPlayerStateChange(event) {
	var yt_cut_state = event.data;
	if (yt_cut_state == 0) {
		// Video Ended
		photberry_slider_object.obj.removeClass('video_playing');
		if (photberry_slider_object.options.autoplay == 'on') {
			photberry_slider_object.move.call(photberry_slider_object,1);
		}
	}
	if (yt_cut_state == 1) {
		// Video Played
	}
}