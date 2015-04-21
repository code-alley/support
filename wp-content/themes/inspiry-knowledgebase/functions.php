<?php

/*-----------------------------------------------------------------------------------*/
/*	Load Text Domain
/*-----------------------------------------------------------------------------------*/	
        load_theme_textdomain( 'framework' );


/*-----------------------------------------------------------------------------------*/
/*	TGM Plugin Activation Class and related code to get the plugins installed and activated
/*-----------------------------------------------------------------------------------*/
        require_once( get_template_directory() . '/tgm/class-tgm-plugin-activation.php' );
        require_once( get_template_directory() . '/tgm/plugins-list.php' );


/*-----------------------------------------------------------------------------------*/
/*	Include Theme Options Framework
/*-----------------------------------------------------------------------------------*/	
		require_once(get_template_directory() . '/admin/admin-functions.php');
		require_once(get_template_directory() . '/admin/admin-interface.php');
		require_once(get_template_directory() . '/admin/theme-settings.php');



/*-----------------------------------------------------------------------------------*/
/*	Include Theme Functions for Various Important Features
/*-----------------------------------------------------------------------------------*/
        require_once(get_template_directory() . '/functions/contact_form_handler.php');
        require_once(get_template_directory() . '/functions/load_theme_styles.php');
        require_once(get_template_directory() . '/functions/load_theme_scripts.php');
        require_once(get_template_directory() . '/functions/theme_comment.php');



/*-----------------------------------------------------------------------------------*/
/*	Add Post Format Support for Image and Video
/*-----------------------------------------------------------------------------------*/
        add_theme_support( 'post-formats', array( 'image', 'video' ) );



/*-----------------------------------------------------------------------------------*/
/*	Add Custom Background
/*-----------------------------------------------------------------------------------*/
		add_theme_support( 'custom-background' );



/*-----------------------------------------------------------------------------------*/
/*	Add Automatic Feed Links Support
/*-----------------------------------------------------------------------------------*/
		add_theme_support( 'automatic-feed-links' );


/*-----------------------------------------------------------------------------------*/
/*	Include Custom Post Type For Services
/*-----------------------------------------------------------------------------------*/
        require_once ( get_template_directory() . '/include/meta-boxes.php' );



/*-----------------------------------------------------------------------------------*/
/*	Include Custom Post Type For Services
/*-----------------------------------------------------------------------------------*/
        require_once ( get_template_directory() . '/include/faq-post-type.php' );



/*-----------------------------------------------------------------------------------*/
//	Widgets
/*-----------------------------------------------------------------------------------*/
        require_once( get_template_directory() . '/widgets/' . 'twitter-widget.php');
        require_once( get_template_directory() . '/widgets/' . 'flickr-widget.php');
        require_once( get_template_directory() . '/widgets/' . 'support-widget.php');
        require_once( get_template_directory() . '/widgets/' . 'quick-links-widget.php');
        require_once( get_template_directory() . '/widgets/' . 'latest-articles-widget.php');
        require_once( get_template_directory() . '/widgets/' . 'featured-articles-widget.php');



/*-----------------------------------------------------------------------------------*/
//	Register Widgets
/*-----------------------------------------------------------------------------------*/
        add_action( 'widgets_init', 'register_theme_widgets' );

        function register_theme_widgets() {
            register_widget( 'Twitter_Widget' );
            register_widget( 'Flickr_Widget' );
            register_widget( 'Support_Widget' );
            register_widget( 'Quick_Links_Widget' );
            register_widget( 'Latest_Articles_Widget' );
            register_widget( 'Featured_Articles_Widget' );
        }



/*-----------------------------------------------------------------------------------*/
//	Shortcodes
/*-----------------------------------------------------------------------------------*/
	    require_once( get_template_directory() . '/include/shortcodes/columns.php' );
		require_once( get_template_directory() . '/include/shortcodes/elements.php' );



/*-----------------------------------------------------------------------------------*/
//	Dynamic CSS
/*-----------------------------------------------------------------------------------*/
	    require_once( get_template_directory() . '/css/dynamic-css.php' );



/*-----------------------------------------------------------------------------------*/
/*	Adding Default Thumbnail Sizes
/*-----------------------------------------------------------------------------------*/
		if( function_exists( 'add_theme_support' ) ) 
		{				
				add_theme_support( 'post-thumbnails' );
								
				// For Post and Pages
				add_image_size( 'std-thumbnail', 770, 9999); // For Standard Post Thumbnails

		}


/*-----------------------------------------------------------------------------------*/
/*	Once Click Demo Install
/*-----------------------------------------------------------------------------------*/
    require_once( get_template_directory() . '/one-click-demo-install/init.php' );


/*-----------------------------------------------------------------------------------*/
/*	Set Home as front page and Blog as Posts Page after demo contents import
/*-----------------------------------------------------------------------------------*/
if( ! function_exists( 'inspiry_settings_after_content_import' ) ) {
    function inspiry_settings_after_content_import() {

        // set homepage as front page and blog page as posts page
        $home_page = get_page_by_title( 'Home' );
        $blog_page   = get_page_by_title( 'Articles List' );

        if ( $home_page || $blog_page ) {
            update_option( 'show_on_front', 'page' );
        }

        if ( $home_page ) {
            update_option( 'page_on_front', $home_page->ID );
        }

        if ( $blog_page ) {
            update_option( 'page_for_posts', $blog_page->ID );
        }

    }
}
add_action( 'radium_importer_after_content_import' , 'inspiry_settings_after_content_import' );



/*-----------------------------------------------------------------------------------*/
/*	Enables Wigitized Sidebars
/*-----------------------------------------------------------------------------------*/
		if ( function_exists('register_sidebar') ){

				// Location: Default Sidebar
				register_sidebar(array('name'=>'Sidebar',
						'before_widget' => '<section class="widget">',
						'after_widget' => '</section>',
						'before_title' => '<h3 class="title">',
						'after_title' => '</h3>'
				));

                // Location: Home Sidebar
                register_sidebar(array('name'=>'Home Sidebar',
                    'before_widget' => '<section class="widget">',
                    'after_widget' => '</section>',
                    'before_title' => '<h3 class="title">',
                    'after_title' => '</h3>'
                ));

                // Location: Page Sidebar
                register_sidebar(array('name'=>'Pages Sidebar',
                    'before_widget' => '<section class="widget">',
                    'after_widget' => '</section>',
                    'before_title' => '<h3 class="title">',
                    'after_title' => '</h3>'
                ));

				// Location: Contact Sidebar
				register_sidebar(array('name'=>'Contact Sidebar',
						'before_widget' => '<section class="widget">',
						'after_widget' => '</section>',
						'before_title' => '<h3 class="title">',
						'after_title' => '</h3>'
				));

                // Location: Footer First Column
                register_sidebar(array('name'=>'Footer First Column',
                    'before_widget' => '<section class="widget">',
                    'after_widget' => '</section>',
                    'before_title' => '<h3 class="title">',
                    'after_title' => '</h3>'
                ));

                // Location: Footer Second Column
                register_sidebar(array('name'=>'Footer Second Column',
                    'before_widget' => '<section class="widget">',
                    'after_widget' => '</section>',
                    'before_title' => '<h3 class="title">',
                    'after_title' => '</h3>'
                ));

                // Location: Footer Third Column
                register_sidebar(array('name'=>'Footer Third Column',
                    'before_widget' => '<section class="widget">',
                    'after_widget' => '</section>',
                    'before_title' => '<h3 class="title">',
                    'after_title' => '</h3>'
                ));

                // Location: Footer Fourth Column
                register_sidebar(array('name'=>'Footer Fourth Column',
                    'before_widget' => '<section class="widget">',
                    'after_widget' => '</section>',
                    'before_title' => '<h3 class="title">',
                    'after_title' => '</h3>'
                ));
		}



/*-----------------------------------------------------------------------------------*/
/*	Creating Menu Places
/*-----------------------------------------------------------------------------------*/
		add_theme_support( 'menus' );
		if ( function_exists( 'register_nav_menus' ) ) {
			  	register_nav_menus(
				  		array(
				  		  'main-menu' => 'Top Menu'
				  		)
			  	);
		}



/*-----------------------------------------------------------------------------------*/
/*	Custom Excerpt Method
/*-----------------------------------------------------------------------------------*/
		function framework_excerpt($len=15, $trim="&hellip;"){
				$limit = $len+1;
			  	$excerpt = explode(' ', get_the_excerpt(), $limit);
			  	$num_words = count($excerpt);
			  	if($num_words >= $len){
			  		$last_item = array_pop($excerpt);
				}
			  	else {
					$trim = "";
				}
			  	$excerpt = implode(" ",$excerpt)."$trim";
			  	echo $excerpt;
	  	}
	  	
	  	function get_framework_excerpt($len=15, $trim="&hellip;"){
	  		$limit = $len+1;
	  		$excerpt = explode(' ', get_the_excerpt(), $limit);
	  		$num_words = count($excerpt);
		  	if($num_words >= $len){
		  			$last_item=array_pop($excerpt);
		  	}
		  	else{
		  		$trim="";
			}
	  		$excerpt = implode(" ",$excerpt)."$trim";
	  		return $excerpt;
	  	}



/*-----------------------------------------------------------------------------------*/
/*	Content Width
/*-----------------------------------------------------------------------------------*/
    if ( ! isset( $content_width ) ) $content_width = 770;



/*-----------------------------------------------------------------------------------*/
/*	Editor Styles
/*-----------------------------------------------------------------------------------*/
    add_editor_style('/css/custom-editor-style.css');



/*-----------------------------------------------------------------------------------*/
//	Theme Pagination Method
/*-----------------------------------------------------------------------------------*/
	
	function theme_pagination($pages = ''){
		global $paged;
		$paged = get_query_var( 'paged' );
		
		if(empty($paged))$paged = 1;
		
		$prev = $paged - 1;							
		$next = $paged + 1;	
		$range = 2; // only change it to show more links
		$showitems = ($range * 2)+1;
		
		if($pages == '')
		{	
				global $wp_query;
				$pages = $wp_query->max_num_pages;
				if(!$pages)
				{
						$pages = 1;
				}
		}
		
		
		if(1 != $pages){
				echo "<div id='pagination'>";
				echo ($paged > 2 && $paged > $range+1 && $showitems < $pages)? "<a href='".get_pagenum_link(1)."' class='btn'>&laquo; ".__('First', 'framework')."</a> ":"";
				echo ($paged > 1 && $showitems < $pages)? "<a href='".get_pagenum_link($prev)."' class='btn' >&laquo; ". __('Previous', 'framework')."</a> ":"";
				
					
				for ($i=1; $i <= $pages; $i++){
						if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
								echo ($paged == $i)? "<a href='".get_pagenum_link($i)."' class='btn active' >".$i."</a> ":"<a href='".get_pagenum_link($i)."' class='btn'>".$i."</a> ";
						}
				}
				
				echo ($paged < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($next)."' class='btn' >". __('Next', 'framework') ." &raquo;</a> " :"";
				echo ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($pages)."' class='btn' >". __('Last', 'framework') ." &raquo;</a> ":"";
				echo "</div>";
				}
	}


/*-----------------------------------------------------------------------------------*/
//	Theme Breadcrumb
/*-----------------------------------------------------------------------------------*/

    function theme_breadcrumb() {

            echo '<ul class="breadcrumb">';

            if ( !is_front_page() )
            {
                echo '<li>';
                echo '<a href="'.home_url().'">'.get_bloginfo('name').'</a>';
                echo '<span class="divider">/</span></li>';
            }

            if ( is_category() || is_singular('post') ) {
                $category = get_the_category();
                $ID = $category[0]->cat_ID;
                echo '<li>';
                echo get_category_parents($ID, TRUE, ' <span class="divider">/</span></li><li>', FALSE );
            }

            if(is_singular('post') || is_page())
            {
                echo '<li class="active">';
                the_title();
                echo '</li>';
            }

            if(is_tag()){
                echo '<li>';
                _e('Tag: ','framework');
                echo single_tag_title('',FALSE);
                echo '</li>';
            }

            if(is_404()){
                echo '<li>';
                _e('404 - Page not Found','framework');
                echo '</li>';

            }

            if(is_search()){
                echo '<li>';
                _e('Search','framework');
                echo '</li>';
            }

            if(is_year()){
                echo '</li>';
                echo get_the_time('Y');
                echo '</li>';
            }

            echo "</ul>";

    }



/*-----------------------------------------------------------------------------------*/
//	Like Button AJAX request Handler
/*-----------------------------------------------------------------------------------*/

add_action('wp_ajax_nopriv_like_it', 'like_it');
add_action('wp_ajax_like_it', 'like_it');

function like_it(){

    if(isset($_POST['post_id'])){

        $ip = $_SERVER['REMOTE_ADDR'];
        $post_id = intval($_POST['post_id']);

        $voted_IP = get_post_meta($post_id, "voted_IP",true);

        if(!is_array($voted_IP))
            $voted_IP = array();

        if(!in_array($ip, $voted_IP)){

            $existing_likes = get_post_meta($post_id, "likes_count", true);
            if(empty($existing_likes)){
                $existing_likes = 1;
            }else{
                $existing_likes = intval($existing_likes) + 1;
            }

            if(update_post_meta($post_id,"likes_count", $existing_likes ))
            {
                $voted_IP[] = $ip;
                update_post_meta($post_id,'voted_IP', $voted_IP);
                echo $existing_likes;
            }
            else
            {
                _e('Action failed due to some server issue!', 'framework');
            }
        }
        else
        {
            _e('Already Liked!', 'framework');
        }
    }
    else
    {
        _e('Invalid Parameters!', 'framework');
    }
    die;
}



/*-----------------------------------------------------------------------------------*/
//  Already Liked or Not
/*-----------------------------------------------------------------------------------*/
function already_liked($post_id)
{
    $ip = $_SERVER['REMOTE_ADDR'];
    $voted_IP = get_post_meta(intval($post_id), "voted_IP", true);

    if(!empty($voted_IP) && is_array($voted_IP))
    {
        return in_array($ip, $voted_IP);
    }
    return false;
}



/*-----------------------------------------------------------------------------------*/
//  Get Total Likes
/*-----------------------------------------------------------------------------------*/
function get_total_likes($post_id)
{
    $existing_likes = get_post_meta($post_id, "likes_count", true);

    if(empty($existing_likes)){
        $existing_likes = 0;
    }else{
        $existing_likes = intval($existing_likes);
    }

    return $existing_likes;
}



/*-----------------------------------------------------------------------------------*/
//	Redirect User to Theme Options Page after Theme Activation
/*-----------------------------------------------------------------------------------*/
    global $pagenow;
    if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' )
    {
        wp_redirect( admin_url( 'admin.php?page=siteoptions' ) );
        exit;
    }



/*-----------------------------------------------------------------------------------*/
/*	Remove rel attribute from the category list
/*-----------------------------------------------------------------------------------*/
    function remove_category_list_rel($output)
	{
        $output = str_replace(' rel="tag"', '', $output);
        $output = str_replace(' rel="category"', '', $output);
		$output = str_replace(' rel="category tag"', '', $output);
		return $output;
	}
	add_filter('wp_list_categories', 'remove_category_list_rel');
	add_filter('the_category', 'remove_category_list_rel');



/*-----------------------------------------------------------------------------------*/
/*	Custom Excerpt Length
/*-----------------------------------------------------------------------------------*/
    function custom_excerpt_length( $length )
    {
        return 50;
    }
    add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );



/*-----------------------------------------------------------------------------------*/
/*	Read More Link
/*-----------------------------------------------------------------------------------*/
    function new_excerpt_more($more) {
        global $post;
        return ' . . . <a class="readmore-link" href="'. get_permalink($post->ID) . '">'.__("Read more","framework").'</a>';
    }
    add_filter('excerpt_more', 'new_excerpt_more');



/*-----------------------------------------------------------------------------------*/
/*	Read More Link
/*-----------------------------------------------------------------------------------*/
function list_articles($query_arg){

    $articles_list = new WP_Query( $query_arg );

    if ( $articles_list->have_posts() ) :
        echo '<ul class="articles">';
        while ( $articles_list->have_posts() ) :
            $articles_list->the_post();
            get_template_part("template-parts/article-for-widget");
        endwhile;
        echo '</ul>';
    else :
        ?>
        <p><?php _e('No Articles Found!', 'framework'); ?></p>
        <?php
    endif;
}

/*-----------------------------------------------------------------------------------*/
/*	Skin Related Code For Demo
/*-----------------------------------------------------------------------------------*/
if(isset($_GET['skin'])){
    $theme_skin = $_GET['skin'];
    setcookie('theme_skin',$theme_skin, time() + 600 );
}



/*-----------------------------------------------------------------------------------*/
/*	Include bbPress in Search Results
/*-----------------------------------------------------------------------------------*/
add_filter( 'bbp_register_forum_post_type', 'bbp_register_search');
add_filter( 'bbp_register_topic_post_type', 'bbp_register_search');
add_filter( 'bbp_register_reply_post_type', 'bbp_register_search');

function bbp_register_search($post_type){
    $post_type['exclude_from_search'] = false;
    return $post_type;
}


/*-----------------------------------------------------------------------------------*/
/*	Display icon based on post format
/*-----------------------------------------------------------------------------------*/
function inspiry_post_format_icon( $format ) {
    switch ( $format ):
        case 'image':
        case 'gallery':
            echo '<i class="fa fa-picture-o"></i>';
            break;

        case 'video':
            echo '<i class="fa fa-film"></i>';
            break;

        case 'faq':
            echo '<i class="fa fa-question-circle"></i>';
            break;

        case 'reply':
            echo '<i class="fa fa-comment"></i>';
            break;

        case 'topic':
            echo '<i class="fa fa-comment-o"></i>';
            break;

        case 'forum':
            echo '<i class="fa fa-th-list"></i>';
            break;

        default:
            echo '<i class="fa fa-pencil-square-o"></i>';
            break;

    endswitch;
}


?>