<?php
if(isset($_GET['livesearch'])):

    // if livesearch is used then generate results in list only
    echo '<ul id="live-search-results" class="clearfix">';

    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();

            $format = get_post_format();
            if( false === $format ) { $format = 'standard'; }
            if($post->post_type == 'faq'){ $format = 'faq'; }
            if($post->post_type == 'topic'){ $format = 'topic'; }
            if($post->post_type == 'reply'){ $format = 'reply'; }
            if($post->post_type == 'forum'){ $format = 'forum'; }

            ?>
            <li class="search-result <?php echo $format; ?>">
                <a href="<?php the_permalink(); ?>">
                    <?php
                    inspiry_post_format_icon( $format );
                    the_title();
                    ?>
                </a>
                <?php if($post->post_type == 'post'):?>
                    <span class="like-count"><i class="fa fa-thumbs-o-up"></i><?php echo get_total_likes($post->ID); ?></span>
                <?php endif; ?>
            </li>
            <?php
        endwhile;
    else :
        ?>
        <li class="no-result"><?php _e('No Results Found!', 'framework'); ?></li>
        <?php
    endif;

    echo '</ul>';   // end of list

// else generate full page markup
else:
get_header();
?>

<!-- Start of Page Container -->
<div class="page-container">
    <div class="container">
        <div class="row">

            <!-- start of page content -->
            <div class="span8 main-listing">
                <h1 class="search-title"><?php _e('Search Results for', 'framework'); ?> <span><?php the_search_query(); ?></span></h1>
                <?php
                if ( have_posts() ) :
                    while ( have_posts() ) :
                        the_post();
                        get_template_part("template-parts/article-for-listing");
                    endwhile;
                    theme_pagination( $wp_query->max_num_pages);
                else :
                    ?>
                    <h4><?php _e('No Result Found!', 'framework'); ?></h4>
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

<?php
get_footer();
endif;
?>