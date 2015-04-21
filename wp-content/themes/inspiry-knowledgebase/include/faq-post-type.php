<?php
// FAQ Custom Post Type
function create_faq_post_type() 
{
 
  $labels = array(
		'name' => __( 'FAQs','framework'),
		'singular_name' => __( 'FAQ','framework' ),
		'add_new' => __('Add New','framework'),
		'add_new_item' => __('Add New FAQ','framework'),
		'edit_item' => __('Edit FAQ','framework'),
		'new_item' => __('New FAQ','framework'),
		'view_item' => __('View FAQ','framework'),
		'search_items' => __('Search FAQ','framework'),
		'not_found' =>  __('No FAQs found','framework'),
		'not_found_in_trash' => __('No FAQs found in Trash','framework'), 
		'parent_item_colon' => ''
	  );
  
  $args = array(
    	'labels' => $labels,
    	'public' => true,
    	'publicly_queryable' => true,
    	'show_ui' => true, 
    	'query_var' => true,
        'menu_icon' => 'dashicons-format-chat',
    	'rewrite' => true,
    	'capability_type' => 'post',
    	'hierarchical' => false,
    	'menu_position' => 5,
    	'supports' => array('title','editor'),
		'rewrite' => array( 'slug' => __('faq', 'framework') )
  );  
  
  
  register_post_type('faq',$args);
}

add_action('init', 'create_faq_post_type');


?>