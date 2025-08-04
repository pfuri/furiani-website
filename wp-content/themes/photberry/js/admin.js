/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/
"use strict";

function photberry_reactivate_sortable() {
    jQuery('.photberry_text_table_rows').sortable(
        {
            handle: '.photberry_text_table_row_move',
        }
    );
}

function photberry_rwmb_and_customizer_condition() {
    jQuery("[data-dependency-id]").each(function (index) {
        var photberry_target = jQuery(this).attr('data-dependency-id');
        var photberry_needed_val = jQuery(this).attr('data-dependency-val');
        var photberry_needed_val_array = new Array();
        var photberry_array_just_ok = false;

        if(photberry_needed_val.indexOf(',') + 1) {
            // Work with array value
            photberry_needed_val = photberry_needed_val.replace(/\s+/g,'');
            photberry_needed_val_array = photberry_needed_val.split(",");

            var photberry_this = jQuery(this);

            photberry_needed_val_array.forEach(function(item, i, photberry_arr) {
                if (photberry_this.hasClass('photberry_dependency_customizer')) {
                    if (photberry_array_just_ok !== true) {
                        if (jQuery('#customize-control-' + photberry_target).find('select').val() == item) {
                            photberry_array_just_ok = true;
                        }
                    }
                }
                else {
                    if (photberry_array_just_ok !== true) {
                        if (jQuery('#' + photberry_target).val() == item) {
                            photberry_array_just_ok = true;
                        }
                    }
                }
            });

            if (jQuery(this).hasClass('photberry_dependency_customizer')) {
                var photberry_target_status = jQuery('#customize-control-' + photberry_target).find('select').val();
                var photberry_dependency_elem_cont = jQuery(this).parents('.customize-control');
            } else {
                var photberry_target_status = jQuery('#' + photberry_target).val();
                var photberry_dependency_elem_cont = jQuery(this).parents('.rwmb-field');
            }

            if (photberry_array_just_ok == true) {
                photberry_dependency_elem_cont.show('fast');
            } else {
                photberry_dependency_elem_cont.hide('fast');
            }
        } else {
            // Just one value
            if (jQuery(this).hasClass('photberry_dependency_customizer')) {
                var photberry_target_status = jQuery('#customize-control-' + photberry_target).find('select').val();
                var photberry_dependency_elem_cont = jQuery(this).parents('.customize-control');
            } else {
                var photberry_target_status = jQuery('#' + photberry_target).val();
                var photberry_dependency_elem_cont = jQuery(this).parents('.rwmb-field');
            }

            if (photberry_needed_val == photberry_target_status) {
                photberry_dependency_elem_cont.show('fast');
            } else {
                photberry_dependency_elem_cont.hide('fast');
            }
        }
    });
}

function photberry_hide_unnecessary_options() {
        if (jQuery('.photberry_this_template_file').size() < 1) {
            var photberry_this_template_file = 'pm_temp_333';
        }
        if (jQuery('.photberry_this_template_file').size() > 0) {
            photberry_this_template_file = jQuery('.photberry_this_template_file').val();
        }
        jQuery("[data-show-on-template-file]").each(function (index) {
            var photberry_unnecessary_target = jQuery(this).attr('data-show-on-template-file');
            if (photberry_unnecessary_target.indexOf(',') > -1) {
                var photberry_unnecessary_target_array = photberry_unnecessary_target.split(',');
                var photberry_rwmb_del_status = 'not find';
                jQuery.each(photberry_unnecessary_target_array, function (i, val) {
                    if (photberry_this_template_file == val.trim()) {
                        photberry_rwmb_del_status = 'find';
                    }
                });
                if (photberry_rwmb_del_status == 'not find') {
                    jQuery(this).parents('.rwmb-field').remove();
                }
            } else {
                if (photberry_this_template_file !== photberry_unnecessary_target) {
                    jQuery(this).parents('.rwmb-field').remove();
                }
            }
        });
        
        jQuery("[data-hide-on-template-file]").each(function (index) {
            var photberry_unnecessary_target = jQuery(this).attr('data-hide-on-template-file');
            if (photberry_unnecessary_target.indexOf(',') > -1) {
                var photberry_unnecessary_target_array = photberry_unnecessary_target.split(',');
                var photberry_rwmb_del_status = 'not find';
                jQuery.each(photberry_unnecessary_target_array, function (i, val) {
                    if (photberry_this_template_file == val.trim()) {
                        photberry_rwmb_del_status = 'find';
                    }
                });
                if (photberry_rwmb_del_status == 'find') {
                    jQuery(this).parents('.rwmb-field').remove();
                }
            } else {
                if (photberry_this_template_file == photberry_unnecessary_target) {
                    jQuery(this).parents('.rwmb-field').remove();
                }
            }
        });
}

jQuery(document).on('change', '#post-format-selector-0', function(){
	palmbay_onchange_post_formats2(jQuery(this).val());
});

function palmbay_onchange_post_formats2(val) {
    jQuery('#image-post-format-settings, #video-post-format-settings, #audio-past-format-settings, #quote-post-format-settings, #link-post-format-settings, #gallery-post-format-settings').hide('fast');
	
	if (val == 'gallery') {
		jQuery('#gallery-post-format-settings').show('fast');
	}
	if (val == 'link') {
		jQuery('#link-post-format-settings').show('fast');
	}
	if (val == 'image') {
		jQuery('#image-post-format-settings').show('fast');
	}
	if (val == 'quote') {
		jQuery('#quote-post-format-settings').show('fast');
	}
	if (val == 'standard') {
        jQuery('#image-post-format-settings, #video-post-format-settings, #audio-past-format-settings, #quote-post-format-settings, #link-post-format-settings, #gallery-post-format-settings').hide('fast');
	}
	if (val == 'video') {
		jQuery('#video-post-format-settings').show('fast');
	}
	if (val == 'audio') {
		jQuery('#audio-past-format-settings').show('fast');
	}
}

function photberry_onchange_post_formats() {
    var photberry_post_format = jQuery('#post-formats-select input:checked').val();

    jQuery('#image-post-format-settings, #video-post-format-settings, #audio-past-format-settings, #quote-post-format-settings, #link-post-format-settings, #gallery-post-format-settings').hide('fast');

    if (photberry_post_format == 'standard') {
        jQuery('#image-post-format-settings, #video-post-format-settings, #audio-past-format-settings, #quote-post-format-settings, #link-post-format-settings, #gallery-post-format-settings').hide('fast');
    }
	
	if (photberry_post_format == 'gallery') {
        jQuery('#gallery-post-format-settings').show('fast');
    }

    if (photberry_post_format == 'image') {
        jQuery('#image-post-format-settings').show('fast');
    }

    if (photberry_post_format == 'video') {
        jQuery('#video-post-format-settings').show('fast');
    }

    if (photberry_post_format == 'audio') {
        jQuery('#audio-past-format-settings').show('fast');
    }

    if (photberry_post_format == 'quote') {
        jQuery('#quote-post-format-settings').show('fast');
    }

    if (photberry_post_format == 'link') {
        jQuery('#link-post-format-settings').show('fast');
    }
	
	if (jQuery('#post-formats-select').length < 1) {
		// Body Class
		if (jQuery('body').hasClass('post-type-gallery')) {
			jQuery('#gallery-post-format-settings').show('fast');
			setTimeout("jQuery('#gallery-post-format-settings').show('fast')",100);
		} else if (jQuery('body').hasClass('post-type-image')) {
			jQuery('#image-post-format-settings').show('fast');
			setTimeout("jQuery('#image-post-format-settings').show('fast')",100);
		} else if (jQuery('body').hasClass('post-type-video')) {
			jQuery('#video-post-format-settings').show('fast');
			setTimeout("jQuery('#video-post-format-settings').show('fast')",100);
		} else if (jQuery('body').hasClass('post-type-audio')) {
			jQuery('#audio-past-format-settings').show('fast');
			setTimeout("jQuery('#audio-post-format-settings').show('fast')",100);
		} else if (jQuery('body').hasClass('post-type-quote')) {
			jQuery('#quote-post-format-settings').show('fast');
			setTimeout("jQuery('#quote-post-format-settings').show('fast')",100);
		} else if (jQuery('body').hasClass('post-type-link')) {
			jQuery('#link-post-format-settings').show('fast');
			setTimeout("jQuery('#link-post-format-settings').show('fast')",100);
		} else {
			jQuery('#image-post-format-settings, #video-post-format-settings, #audio-past-format-settings, #quote-post-format-settings, #link-post-format-settings, #gallery-post-format-settings').hide('fast');
		}
	}
}

jQuery(document).ready(function () {
    if (jQuery('#page_template').size() > 0 && jQuery('#page_template').val() !== 'default') {
        jQuery('body').addClass(jQuery('#page_template').val().split('.')[0]);
    }

    jQuery("[data-dependency-id]").parents('.rwmb-field').hide();
	
    photberry_rwmb_and_customizer_condition();
    photberry_hide_unnecessary_options();

    jQuery('.rwmb-select, .customize-control-select select').change(function () {
        photberry_rwmb_and_customizer_condition();
    });

    jQuery('#post-formats-select input').on("click", function () {
        photberry_onchange_post_formats();
    });
    
    jQuery('.photberry_reset_all_settings').on("click", function () {
	    if (confirm("Are you sure? All settings will be reset to default state.")) {
            jQuery.post(ajaxurl, {
	            action: 'photberry_reset_all_settings'
	        }, function (response) {
	            alert(response);
	        });
		}
	});

    jQuery(document).on("click", '.photberry_text_table_add_row', function () {
        var photberry_text_table_data_storage_name = jQuery(this).parents('.widget-content').find('.photberry_text_table_data_storage_name').val();
        var photberry_text_table_name_text = jQuery(this).parents('.widget-content').find('.photberry_text_table_name_text').val();
        var photberry_text_table_value_text = jQuery(this).parents('.widget-content').find('.photberry_text_table_value_text').val();

        jQuery(this).parents('.widget-content').find('.photberry_text_table_rows').append('<div class="photberry_text_table_row photberry_dn"><div class="photberry_50_dib"><label>' + photberry_text_table_name_text + ':</label><input class="widefat" type="text" name="' + photberry_text_table_data_storage_name + '[][name]" value=""></div><div class="photberry_50_dib"><label>' + photberry_text_table_value_text + ':</label><textarea class="widefat" type="text" name="' + photberry_text_table_data_storage_name + '[][value]"></textarea></div><div class="photberry_text_table_row_remove"><i class="pm-fa pm-fa-trash"></i></div><div class="photberry_text_table_row_move"><i class="pm-fa pm-fa-arrows"></i></div></div>');
        jQuery('.photberry_dn').slideDown("fast").removeClass('photberry_dn');
    });

    jQuery(document).on("click", '.photberry_text_table_row_remove', function () {
        jQuery(this).parents('.photberry_text_table_row').slideUp("normal", function () {
            jQuery(this).remove();
        });
    });

    jQuery(document).on("click", '.widget-control-save', function () {
        setTimeout(function () {
            photberry_reactivate_sortable()
        }, 1000);
        setTimeout(function () {
            photberry_reactivate_sortable()
        }, 2000);
        setTimeout(function () {
            photberry_reactivate_sortable()
        }, 3000);
    });

    photberry_reactivate_sortable();
});

jQuery(window).on('load', function () {
	photberry_onchange_post_formats();
});
