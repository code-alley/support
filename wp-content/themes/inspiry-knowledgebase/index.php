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
                if ( have_posts() ) :
                    while ( have_posts() ) :
                        the_post();
                        get_template_part("template-parts/article-for-listing");
                    endwhile;
                    theme_pagination( $wp_query->max_num_pages);
                else :
                    ?>
                    <h3><?php _e('No Articles Found!', 'framework'); ?></h3>
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