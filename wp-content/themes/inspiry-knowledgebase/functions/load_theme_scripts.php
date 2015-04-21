<?php
/**
 * File Name: load_theme_scripts.php
 * For Loading Required JS Files
 *
 */


if(!function_exists('load_theme_scripts')){

    function load_theme_scripts(){

        if (!is_admin()) {

            // Defining scripts directory url
            $js_script_url = get_template_directory_uri().'/js/';

            // Registering Scripts
            wp_register_script('pretty-photo', $js_script_url.'prettyphoto/jquery.prettyPhoto.js', array('jquery'), '3.1.4', false);
            wp_register_script('easing', $js_script_url.'jquery.easing.1.3.js', array('jquery'), '1.3', false);
            wp_register_script('validate', $js_script_url.'jquery.validate.min.js', array('jquery'), '1.10.0', false);
            wp_register_script('forms', $js_script_url.'jquery.form.js', array('jquery'), '3.18', false);
            wp_register_script('live-search', $js_script_url.'jquery.liveSearch.js', array('jquery'), '2.0', false);

            // Custom Script
            wp_register_script('custom',$js_script_url.'custom.js', array('jquery'), '1.0', true);

            // Enqueue Scripts that are needed on all the pages
            wp_enqueue_script('jquery');
            wp_enqueue_script('easing');
            wp_enqueue_script('pretty-photo');
            wp_enqueue_script('live-search');
            wp_enqueue_script('forms');
            wp_enqueue_script('validate');

            // Responsive Navigation Title Translation
            $localized_array = array(
                'nav_title' => __('Go to...','framework'),
                'home_url' => home_url('/'),
            );
            wp_localize_script( 'custom', 'localized', $localized_array );

            wp_enqueue_script('custom');
        }
    }
}

add_action('wp_enqueue_scripts', 'load_theme_scripts');

/*-----------------------------------------------------------------------------------*/
/*	Register and load admin javascript
/*-----------------------------------------------------------------------------------*/
    if( !function_exists( 'admin_js' ) )
    {
        function admin_js($hook)
        {
            if ($hook == 'post.php' || $hook == 'post-new.php')
            {
                wp_register_script('admin-script', get_template_directory_uri() . '/js/admin.js', 'jquery');
                wp_enqueue_script('admin-script');
            }
        }
        add_action('admin_enqueue_scripts','admin_js',10,1);
    }
?>