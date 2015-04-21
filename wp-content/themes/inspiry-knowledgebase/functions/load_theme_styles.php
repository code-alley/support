<?php
/**
 * File Name: load_theme_styles.php
 * Function For Loading Required CSS Files
 *
 */

if(!function_exists('load_theme_styles'))
{
    function load_theme_styles()
    {
        if (!is_admin())
        {
            // register styles
            wp_register_style('font-awesome',  get_template_directory_uri() . '/css/font-awesome/css/font-awesome.min.css', array(), '4.3.0', 'all');
            wp_register_style('bootstrap-css',  get_template_directory_uri() . '/css/bootstrap.css', array(), '1.0', 'all');
            wp_register_style('main-css',  get_template_directory_uri() . '/css/main.css', array(), '1.0', 'all');
            wp_register_style('responsive-css',  get_template_directory_uri() . '/css/responsive.css', array(), '1.0', 'all');
            wp_register_style('pretty-photo-css',  get_template_directory_uri() . '/js/prettyphoto/prettyPhoto.css', array(), '3.1.4', 'all');
            wp_register_style('custom-css',  get_template_directory_uri() . '/css/custom.css', array(), '1.0', 'all');

            // Skins
            wp_register_style('blue-skin',  get_template_directory_uri() . '/css/blue-skin.css', array(), '1.0', 'all');
            wp_register_style('green-skin',  get_template_directory_uri() . '/css/green-skin.css', array(), '1.0', 'all');
            wp_register_style('red-skin',  get_template_directory_uri() . '/css/red-skin.css', array(), '1.0', 'all');

            // enqueue font awesome styles
            wp_enqueue_style('font-awesome');

            // enqueue bootstrap styles
            wp_enqueue_style('bootstrap-css');

            // enqueue bootstrap responsive styles
            wp_enqueue_style('responsive-css');

            // enqueue Pretty Photo styles
            wp_enqueue_style('pretty-photo-css');

            // enqueue Main styles
            wp_enqueue_style('main-css');

            /* Theme Skins */
            $theme_skin = get_option('theme_skin');

            if(isset($_GET['skin'])){
                $theme_skin = $_GET['skin'];
            }elseif(isset($_COOKIE['theme_skin'])){
                $theme_skin = $_COOKIE['theme_skin'];
            }

            if(!empty($theme_skin)){
                switch($theme_skin){
                    case 'blue-skin':
                        wp_enqueue_style('blue-skin');
                        break;
                    case 'green-skin':
                        wp_enqueue_style('green-skin');
                        break;
                    case 'red-skin':
                        wp_enqueue_style('red-skin');
                        break;
                }
            }

            // enqueue Custom styles
            wp_enqueue_style('custom-css');

        }
    }
}

add_action('wp_enqueue_scripts', 'load_theme_styles');

?>