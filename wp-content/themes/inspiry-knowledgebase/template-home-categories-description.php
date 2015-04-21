<?php
/*
*   Template Name: Home with Categories Description
*/
get_header();

?>

<!-- Start of Page Container -->
<div class="page-container">
    <div class="container">
        <div class="row">

            <!-- start of page content -->
            <div class="span8 page-content">

                <?php
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

                <div class="row home-category-list-area">
                    <div class="span8">
                        <h2><?php _e('Categories','framework'); ?></h2>
                    </div>
                </div>

                <div class="row-fluid top-cats">

                    <?php

                    $selected_categories = get_option('theme_selected_cats');

                    $cat_count = count($selected_categories);
                    if(is_array($selected_categories) && ($cat_count > 0))
                    {
                        $category_count = 0;
                        foreach ($selected_categories as $selected_cat_id )
                        {
                            $category_count++;
                            $cat_obj = get_category($selected_cat_id);

                            echo '<section class="span4">';
                                echo '<h4 class="category"><a href="'.get_category_link( $cat_obj->term_id ) .'">'.$cat_obj->name.'</a></h4>';
                                echo '<div class="category-description">';
                                    echo '<p>'.$cat_obj->category_description.'</p>';
                                echo '</div>';
                            echo '</section>';

                            if((($category_count%3)==0) && ($category_count < $cat_count)){
                                echo '</div><div class="row-fluid top-cats">';
                            }
                        }
                    }
                    ?>

                </div>



            </div>
            <!-- end of page content -->

            <?php get_sidebar('home'); ?>
        </div>
    </div>
</div>
<!-- End of Page Container -->


<?php get_footer(); ?>