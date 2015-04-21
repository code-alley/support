<?php
get_header();
?>

<!-- Start of Page Container -->
<div class="page-container">
    <div class="container">
        <div class="row">

            <!-- start of page content -->
            <div class="span8 main-listing">
                <?php
                $post = $posts[0]; // Hack. Set $post so that the_date() works.
                if (is_category())
                {
                    ?>
                    <h1 class="archive-title"><?php _e('All posts in', 'framework'); ?> <span><?php echo single_cat_title('',false); ?></span></h1>
                    <?php
                }
                elseif( is_tag() )
                {
                    ?>
                    <h1 class="archive-title"><?php _e('All posts tagged ', 'framework'); ?> <span><?php echo ' '.single_tag_title('',false); ?></span></h1>
                    <?php
                }
                elseif (is_day())
                {
                    ?>
                    <h1 class="archive-title"><?php _e('Archive for', 'framework'); ?> <span><?php echo ' '.get_the_date(); ?></span></h1>
                    <?php
                }
                elseif (is_month())
                {
                    ?>
                    <h1 class="archive-title"><?php _e('Archive for', 'framework'); ?> <span><?php echo ' '.get_the_date('F Y'); ?></span></h1>
                    <?php
                }
                elseif (is_year())
                {
                    ?>
                    <h1 class="archive-title"><?php _e('Archive for', 'framework'); ?> <span><?php echo ' '.get_the_date('Y'); ?></span></h1>
                    <?php
                }
                elseif (is_author())
                {
                    $curauth = $wp_query->get_queried_object();
                    ?>
                    <h1 class="archive-title"><?php _e('All posts by', 'framework'); ?> <span><?php echo ' '.$curauth->display_name; ?></span></h1>
                    <?php
                }
                elseif (isset($_GET['paged']) && !empty($_GET['paged']))
                {
                    ?>
                    <h1 class="archive-title"><?php _e('Archives', 'framework'); ?></h1>
                    <?php
                }



                if ( have_posts() ) :
                    while ( have_posts() ) :
                        the_post();
                        get_template_part("template-parts/article-for-listing");
                    endwhile;
                    theme_pagination( $wp_query->max_num_pages);
                else :
                    ?>
                    <h3><?php _e('No Result Found!', 'framework'); ?></h3>
                    <?php
                endif;
                ?>
            </div>
            <!-- end of page content -->

            <?php get_sidebar(); ?>

        </div>
    </div>
</div>
<!-- End of Page Container -->

<?php get_footer(); ?>