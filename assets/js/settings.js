jQuery(document).ready(function($) {

    // load color picker
    jQuery('.sp-color-picker').wpColorPicker();

    // keep value
    jQuery('input[type="checkbox"]').on('change', function(e) {
        if( jQuery(this).prop('checked') )
        {
            jQuery(this).next().val(1);
        } else {
            jQuery(this).next().val(0);
        }
    });

    // on click engagement (popup_feedback)
    jQuery('input#popup_feedback').on('click', function(e) {
        if( jQuery(this).prop('checked') )
        {
            jQuery('.details.popup_feedback').removeClass('hidden');
        } else {
            jQuery('.details.popup_feedback').addClass('hidden');
        }
    });

    // on click engagement (popup_satisfaction)
    jQuery('input#popup_satisfaction').on('click', function(e) {
        if( jQuery(this).prop('checked') )
        {
            jQuery('.details.popup_satisfaction').removeClass('hidden');
        } else {
            jQuery('.details.popup_satisfaction').addClass('hidden');
        }
    });

});