<?php
add_action('init','of_options');

if (!function_exists('of_options')) 
{
		
	function of_options()
	{

		/*
		*	Theme Shortname
		*/
		$themename = "theme";
		$shortname = "theme";

		/*
		*	Populate the options array
		*/
		global $tt_options;
		
		$tt_options = get_option('of_options');

		/*
		*	Access the WordPress Pages via an Array
		*/
		$tt_pages = array();
		
		$tt_pages_obj = get_pages('sort_column=post_parent,menu_order');    
		
		foreach ($tt_pages_obj as $tt_page) 
		{
			$tt_pages[$tt_page->ID] = $tt_page->post_name; 
		}
		
		$tt_pages_tmp = array_unshift($tt_pages, "Select a page:" ); 


		/*
		*	Access the WordPress Categories via an Array
		*/
		$tt_categories = array();
		$tt_categories_obj = get_categories('hide_empty=0');
		foreach ($tt_categories_obj as $tt_cat) 
		{
			$tt_categories[$tt_cat->term_id] = $tt_cat->name;
		}
		$categories_tmp = array_unshift($tt_categories, "Select a category:");



        /*
		*	Access the WordPress Tags via an Array
		*/
        $tags_array = array();
        $tags_objects = get_tags('hide_empty=0');
        foreach ($tags_objects as $tag_inst)
        {
            $tags_array[$tag_inst->term_id] = $tag_inst->name;
        }
        $tags_tmp = array_unshift($tags_array, __('Select a Tag','framework'));



		/*
		*	Numbers Array
		*/
		$numbers_array = array("1","2","3","4","5","6","7","8","9","10");



		/*
		*	Sample Advanced Array - The actual value differs from what the user sees
		*/
		$sample_advanced_array = array("image" => "The Image","post" => "The Post"); 



		/*
		*	Folder Paths for "type" => "images"
		*/
		$sampleurl =  get_template_directory_uri() . '/admin/images/sample-layouts/';




/*-----------------------------------------------------------------------------------*/
/* Create The Custom Theme Options Panel
/*-----------------------------------------------------------------------------------*/
$options = array(); // do not delete this line - sky will fall



/* Option Page - Header Options */
$options[] = array( "name" => __('Header','framework'),
            "id" => $shortname."_header_heading",
			"type" => "heading");
			

$options[] = array( "name" => __('Logo','framework'),
			"desc" => __('Upload logo for your Website.','framework'),
			"id" => $shortname."_sitelogo",
			"std" => "",
			"type" => "upload");
			
			
$options[] = array( "name" => __('Favicon','framework'),
			"desc" => __('Upload a 16px by 16px PNG image that will represent your website favicon.','framework'),
			"id" => $shortname."_favicon",
			"std" => "",
			"type" => "upload");

$options[] = array( "name" => __('Tracking Code','framework'),
			"desc" => __('Paste Google Analytics (or other) tracking code here.','framework'),
			"id" => $shortname."_google_analytics",
			"std" => "",
			"type" => "textarea");



/* Option Page - Search Area */
$options[] = array( "name" => __('Homepage','framework'),
            "id" => $shortname."_homepage_heading",
            "type" => "heading");

$options[] = array( "name" => __('Featured Articles Title','framework'),
            "desc" => "",
            "id" => $shortname."_featured_articles_title",
            "std" => __("Featured Articles", "framework"),
            "type" => "text");

$options[] = array( "name" => __('Choose a tag for homepage featured articles.','framework'),
            "desc" => __('Homepage featured articles sections will display articles based on selected tag.','framework'),
            "id" => $shortname."_feature_tag",
            "std" => "0",
            "type" => "select",
            "options" => $tags_array );

$options[] = array( "name" => __('Latest Articles Title','framework'),
            "desc" => "",
            "id" => $shortname."_latest_articles_title",
            "std" => __("Latest Articles", "framework"),
            "type" => "text");

$options[] = array( "name" => __('Number of articles to display','framework'),
            "desc" => __('Number of articles to display for latest and featured section on homepage.','framework'),
            "id" => $shortname."_number_of_articles",
            "std" => "4",
            "type" => "select",
            "options" => $numbers_array);

// Categories For Homepage Select Categories Option
$categories_for_select = array();
$categories_objects = get_categories('hide_empty=0&orderby=count&order=desc');
foreach ($categories_objects as $category_obj)
{
    $categories_for_select[$category_obj->term_id] = $category_obj->name.'('.$category_obj->count.')';
}

$options[] = array( "name" => __('Select Categories','framework'),
            "desc" => __('Select categories that you want to display on homepage.','framework'),
            "id" => $shortname."_selected_cats",
            "type" => "multicheck",
            "options" => $categories_for_select );

$options[] = array( "name" => __('Number of articles to display for each category','framework'),
            "desc" => __('Number of articles to display for each category on Homepage Template with Category and Article List.','framework'),
            "id" => $shortname."_number_articles_for_cat",
            "std" => "4",
            "type" => "select",
            "options" => $numbers_array);

/* Option Page - Search Area */
$options[] = array( "name" => __('Search Area','framework'),
    "id" => $shortname."_search_heading",
    "type" => "heading");

$options[] = array( "name" => __('Search Area Title','framework'),
    "desc" => __("Provide the search area title text here.",'framework'),
    "id" => $shortname."_search_title",
    "std" => __("Have a Question?", "framework"),
    "type" => "text");

$options[] = array( "name" => __('Text Below Title','framework'),
    "desc" => __("This text will appear below search area main title.",'framework'),
    "id" => $shortname."_search_text",
    "std" => __("If you have any question you can ask below or enter what you are looking for!", "framework"),
    "type" => "textarea");



/* Option Page - Styling */
$options[] = array( "name" => __('Styling','framework'),
            "id" => $shortname."_styling_heading",
			"type" => "heading");

$options[] = array( "name" => __('Body Background','framework'),
			"desc" => "",
			"id" => $shortname."_background_callout",
			"std" => "This theme uses WordPress standard way to change background image or background color of body. Please visit <strong>Appearance >> Background</strong> page to change body background.",
			"type" => "info");

$options[] = array( "name" => __('Color Skin','framework'),
            "desc" => __('Choose one of the available color skins.','framework'),
            "id" => $shortname."_skin",
            "std" => "default",
            "type" => "radio",
            "options" => array(
                            'default'=>'Default Skin',
                            'blue-skin'=>'Blue Skin',
                            'green-skin'=>'Green Skin',
                            'red-skin'=>'Red Skin'
                            ));

$options[] = array( "name" => __('Body Text Color','framework'),
			"desc" => __('Choose a Body Text Color. Base Theme Color is #6f7579','framework'),
			"id" => $shortname."_body_text_color",
			"std" => "#6f7579",
			"type" => "color");

$options[] = array( "name" => __('Headings Color','framework'),
			"desc" => __('Choose a Color for h1, h2, h3, h4, h5 and h6 tags. Base Theme Color is #3b4348','framework'),
			"id" => $shortname."_body_headings_color",
			"std" => "#3b4348",
			"type" => "color");

$options[] = array( "name" => __('Link Color','framework'),
			"desc" => __('Choose a Link Color. Base Theme Color is #3b4348','framework'),
			"id" => $shortname."_link_color",
			"std" => "#3b4348",
			"type" => "color");

$options[] = array( "name" => __('Link Hover Color','framework'),
            "desc" => __('Choose a Link Hover Color. Base Theme Color is #395996','framework'),
            "id" => $shortname."_link_hover_color",
            "std" => "#395996",
            "type" => "color");

$options[] = array( "name" => __('Quick CSS','framework'),
			"desc" => __('Just want to do some quick CSS changes? Enter them here, they will be applied to the theme. If you need to change major portions of the theme please use the "css/custom.css" file.','framework'),
			"id" => $shortname."_quick_css",
			"std" => "",
			"type" => "textarea");
			
			


/* Option Page - Contact */
$options[] = array( "name" => __('Contact','framework'),
            "id" => $shortname."_contact_heading",
			"type" => "heading");


$options[] = array( "name" => __('Contact Email','framework'),
			"desc" => __("Enter target email address that will receive messages from contact form.",'framework'),
			"id" => $shortname."_contact_address",
			"std" => "",
			"type" => "text");



/* Option Page - Social Navigation */
$options[] = array( "name" => __('Social Navigation','framework'),
    "id" => $shortname."_social_heading",
    "type" => "heading");

$options[] = array( "name" => __('Do you want to show social navigation in footer ?','framework'),
    "desc" => __('Yes','framework'),
    "id" => $shortname."_show_social_menu",
    "std" => "true",
    "type" => "checkbox");

$options[] = array( "name" => __('Facebook','framework'),
    "desc" => __('Provide Facebook link to display its icon in footer social navigation.','framework'),
    "id" => $shortname."_facebook_link",
    "std" => "",
    "type" => "text");

$options[] = array( "name" => __('Twitter','framework'),
    "desc" => __('Provide Twitter link to display its icon in footer social navigation.','framework'),
    "id" => $shortname."_twitter_link",
    "std" => "",
    "type" => "text");

$options[] = array( "name" => __('RSS','framework'),
    "desc" => __('Provide RSS link to display its icon in footer social navigation.','framework'),
    "id" => $shortname."_rss_link",
    "std" => "",
    "type" => "text");

$options[] = array( "name" => __('LinkedIn','framework'),
    "desc" => __('Provide LinkedIn link to display its icon in footer social navigation.','framework'),
    "id" => $shortname."_linkedin_link",
    "std" => "",
    "type" => "text");

$options[] = array( "name" => __('StumbleUpon','framework'),
    "desc" => __('Provide StumbleUpon link to display its icon in footer social navigation.','framework'),
    "id" => $shortname."_stumble_link",
    "std" => "",
    "type" => "text");

$options[] = array( "name" => __('Google','framework'),
    "desc" => __('Provide Google link to display its icon in footer social navigation.','framework'),
    "id" => $shortname."_google_link",
    "std" => "",
    "type" => "text");

$options[] = array( "name" => __('Deviant Art','framework'),
    "desc" => __('Provide Deviant Art link to display its icon in footer social navigation.','framework'),
    "id" => $shortname."_deviantart_link",
    "std" => "",
    "type" => "text");

$options[] = array( "name" => __('Flickr','framework'),
    "desc" => __('Provide Flickr link to display its icon in footer social navigation.','framework'),
    "id" => $shortname."_flickr_link",
    "std" => "",
    "type" => "text");

$options[] = array( "name" => __('Skype ID','framework'),
    "desc" => __('Provide Your Skype ID to display its icon in footer social navigation.','framework'),
    "id" => $shortname."_skype_link",
    "std" => "",
    "type" => "text");

/* Option Page - Footer */
$options[] = array( "name" => __('Footer','framework'),
            "id" => $shortname."_footer_heading",
			"type" => "heading");
			
$options[] = array( "name" => __('Copyright Text','framework'),
			"desc" => __("Enter Footer Copyright Text here.",'framework'),
			"id" => $shortname."_copyright_text",
			"std" => "Copyright &copy; 2013. All Rights Reserved by KnowledgeBase.",
			"type" => "textarea");



update_option('of_template',$options); 					  
update_option('of_themename',$themename);   
update_option('of_shortname',$shortname);

}
}

?>