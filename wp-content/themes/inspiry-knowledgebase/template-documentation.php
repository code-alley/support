<?php
/*
*   Template Name: Documentation
*/
get_header();

?>

<!-- Start of Page Container -->
<div class="page-container">
    <div class="container">
        <div class="row">

            <!-- start of page content -->
            <div class="span12 page-content">

                <!-- Basic Home Page Template --> 



                <div class="row home-listing-area">
                    <div class="span8">
                        <h1><?php _e('Documentation','framework'); ?></h1>
                    </div>
                </div>
                <div class="row separator">
                    <?php

                    $number_of_cat_articles = get_option('theme_number_articles_for_cat');
                    $number_of_cat_articles = empty($number_of_cat_articles)?5:intval($number_of_cat_articles);

                    $selected_categories = get_option('theme_selected_cats');                    
                    $cat_count = count($selected_categories);
                    if(is_array($selected_categories) && ($cat_count > 0))
                    {
                        $category_count = 0;
                        $selected_categories = array(43, 44, 45);
                        foreach ($selected_categories as $selected_cat_id )
                        {
                            $category_count++;
                            $cat_obj = get_category($selected_cat_id);
                            echo '<section class="span4 articles-list">';
                            echo '<h3><a href="'.get_category_link( $cat_obj->term_id ) .'">'.$cat_obj->name.'</a> <span>('.$cat_obj->count.')</span></h3>';

                            $sub_categories_args = array(
                                                        'orderby' => 'name',
                                                        'order' => 'ASC',
                                                        'parent' => $cat_obj->term_id
                                                        );
                            $sub_categories = get_categories($sub_categories_args);
                            $categories_not_in = array();
                            if ( $sub_categories ) :
                                echo '<ul class="sub-categories">';
                                foreach($sub_categories as $sub_category) {
                                    echo '<li class="category-entry"><h4><a href="' . get_category_link( $sub_category->term_id ) . '" title="' . sprintf( __( 'View all posts in %s', 'framework' ), $sub_category->name ) . '" ' . '>' . '<i class="fa fa-folder-open-o"></i>' . $sub_category->name.'</a>';
                                    echo '<span class="cat-count">(' . $sub_category->count.')</span>';
                                    echo '</h4></li>';
                                    $categories_not_in[] = $sub_category->term_id;
                                }
                                echo '</ul>';
                            endif;

                            list_articles(array(
                                            'cat' => $cat_obj->term_id,
                                            'posts_per_page' => $number_of_cat_articles,
                                            'category__not_in' => $categories_not_in
                                        ));

                            echo '</section>';

                            if((($category_count%3)==0) && ($category_count < $cat_count)){
                                echo '</div><div class="row separator">';
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