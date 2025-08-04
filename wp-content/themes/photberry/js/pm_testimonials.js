/*
 * Testimonials Flow
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/
"use strict";

var photberry_ft_array = [],
	$photberry_testimonials_flow = jQuery('.photberry_testimonials_flow');

$photberry_testimonials_flow.each(function() {
	var $this = jQuery(this);
	photberry_ft_array['photberry_ft_'+$this.attr('data-uniqid')] = {};
	var photberry_ft_object = photberry_ft_array['photberry_ft_'+$this.attr('data-uniqid')];
	
	photberry_ft_object.id = $this.attr('data-uniqid');
	photberry_ft_object.obj = $this;
	photberry_ft_object.size = $this.find('.photberry_testimonials_flow_item').length;
	photberry_ft_object.active_slide = 0;
	
	// Core Object Functions
	photberry_ft_object.init = function() {
		
		// Init Counter
		var counter = 1;
		this.obj.find('.photberry_testimonials_flow_item').each(function(){
			jQuery(this).attr('data-count', counter).addClass('photberry_testimonials_flow_slide' + counter);
			counter++;
		});
		this.obj.addClass('module_loaded');
		
		// Init Controls
		var this_object = this;
		this.obj.find('.photberry_testimonials_flow_prev').on('click', function(){		
			this_object.move.call(this_object, -1);
		});
		this.obj.find('.photberry_testimonials_flow_next').on('click', function(){		
			this_object.move.call(this_object, 1);
		});

		// Init Touch Events
		this.obj.on("swiperight", function () {
			this_object.move.call(this_object, -1);
		});
		this.obj.on("swipeleft", function () {
			this_object.move.call(this_object, 1);
		});
		
		this.move.call(this,1);
	}
	
	photberry_ft_object.update = function() {
		if (jQuery('.photberry_ts_flow_current').length) {
			jQuery('.photberry_ts_flow_current').each(function(){
				jQuery(this).parents('.photberry_testimonials_flow_inner').css('min-height', jQuery(this).height()+'px');
			});
		}
	}
	
	photberry_ft_object.move = function(dir) {
		dir = parseInt(dir,10);
		if (dir > 0)
			this.active_slide++;
		if (dir < 0)
			this.active_slide--;
		this.active_slide = this.check.call(this,this.active_slide);
		this.set.call(this,this.active_slide);
	}
	
	photberry_ft_object.check = function(this_val) {
		this_val = parseInt(this_val,10);
		if (this_val < 1) 
			this_val = this.size;
		if (this_val > this.size) 
			this_val = 1;
		return this_val;
	}
	
	photberry_ft_object.set = function(item_id) {
		
		item_id = parseInt(item_id,10);
		
		this.obj.find('.photberry_ts_flow_prev').removeClass('photberry_ts_flow_prev');
		this.obj.find('.photberry_ts_flow_current').removeClass('photberry_ts_flow_current');
		this.obj.find('.photberry_ts_flow_next').removeClass('photberry_ts_flow_next');
		
		var this_prev = item_id - 1,
			this_next = item_id + 1;
		
		this_prev = this.check.call(this,this_prev);
		this_next = this.check.call(this,this_next);
		
		this.obj.find('[data-count='+ this_prev +']').addClass('photberry_ts_flow_prev');
		this.obj.find('[data-count='+ item_id +']').addClass('photberry_ts_flow_current');
		this.obj.find('[data-count='+ this_next +']').addClass('photberry_ts_flow_next');
		
		this.update.call(this);
	}
});

jQuery(document).ready(function(){
	$photberry_testimonials_flow.each(function(){
		var $this = jQuery(this),
			this_object = photberry_ft_array['photberry_ft_'+$this.attr('data-uniqid')];

		this_object.init.call(this_object);
	});
});

jQuery(window).load(function(){
	$photberry_testimonials_flow.each(function(){
		var $this = jQuery(this),
			this_object = photberry_ft_array['photberry_ft_'+$this.attr('data-uniqid')];

		this_object.update.call(this_object);
	});
});

jQuery(window).resize(function(){
	$photberry_testimonials_flow.each(function(){
		var $this = jQuery(this),
			this_object = photberry_ft_array['photberry_ft_'+$this.attr('data-uniqid')];

		this_object.update.call(this_object);
	});
});