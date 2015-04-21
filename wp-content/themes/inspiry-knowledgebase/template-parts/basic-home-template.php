<?php
/**
 * File Name: basic-home-template.php
 */

/*---------------------------------------------------------------------*/
// Generate Default Page Contents for Home Page
/*---------------------------------------------------------------------*/
if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();
        ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class("clearfix"); ?>>
        <?php
        the_content();
        ?>
    </article>
    <?php
    endwhile;
endif;
/*---------------------------------------------------------------------*/
// end of default loop
/*---------------------------------------------------------------------*/
?>



<div class="row separator">
    <section class="span4 articles-list">
        <?php
        /*---------------------------------------------------------------------*/
        // Generate Featured Articles List for Home Page
        /*---------------------------------------------------------------------*/
        $feature_tag = get_option('theme_feature_tag');
        $featured_articles_title = get_option('theme_featured_articles_title');

        $number_of_articles = get_option('theme_number_of_articles');
        $number_of_articles = empty($number_of_articles)?5:intval($number_of_articles);

        $featured_articles_arguments = array('posts_per_page' => $number_of_articles);

        if( !empty($feature_tag) )
        {
            $selected_tag = get_term_by('name', $feature_tag , 'post_tag');
            if($selected_tag){
                $featured_articles_arguments['tag'] = $selected_tag->slug;
            }
        }

        if( empty($featured_articles_title) )
        {
            $featured_articles_title = __("Featured Articles", "framework");
        }

        // Generate Title for Articles
        echo "<h3>".$featured_articles_title."</h3>";

        // Generate List of articles
        list_articles($featured_articles_arguments);
        ?>
    </section>




    <section class="span4 articles-list">
        <?php
        /*---------------------------------------------------------------------*/
        // Generate Latest Articles List for Home Page
        /*---------------------------------------------------------------------*/
        $latest_articles_title = get_option('theme_latest_articles_title');
        $latest_articles_arguments = array('posts_per_page' => $number_of_articles);

        if( empty($latest_articles_title) )
        {
            $latest_articles_title = __("Latest Articles", "framework");
        }

        // Generate Title for Articles
        echo "<h3>".$latest_articles_title."</h3>";

        // Generate List of articles
        list_articles($latest_articles_arguments);
        ?>
    </section>
</div>