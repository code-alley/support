/*-----------------------------------------------------------------------------------*/
/*	Admin side JS
 /*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function() {


    /*-----------------------------------------------------------------------------------*/
    /*	To Control Metaboxes based on post format
     /*-----------------------------------------------------------------------------------*/
    var video_meta_box = jQuery('#video-meta-box');


    var videoTrigger = jQuery('#post-format-video');

    var group = jQuery('#post-formats-select input');

    if(videoTrigger.is(':checked'))
    {
        hideAllExcept(video_meta_box);
    }
    else
    {
        hideAll();
    }

    group.change( function() {

        if( jQuery(this).val() == 'video')
        {
            hideAllExcept(video_meta_box);
        }
        else
        {
            hideAll();
        }

    });

    function hideAllExcept(required_meta_box) {
        hideAll();
        required_meta_box.show();
    }

    function hideAll() {
        video_meta_box.hide();
    }

});