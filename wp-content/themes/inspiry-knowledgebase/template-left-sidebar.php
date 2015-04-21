<?php
/*
*	Template Name: Default Template With Left Sidebar
*/ 

get_header(); ?>

<!-- Start of Page Container -->
<div class="page-container">
    <div class="container">
        <div class="row">

            <?php get_sidebar('page'); ?>

            <!-- start of page content -->
            <div class="span8 page-content">

                <?php

                if ( have_posts() ) :
                    while ( have_posts() ) :
                        the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class("clearfix"); ?>>
                            <h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                            <hr>
                            <?php
                            if ( has_post_thumbnail() )
                            {
                                the_post_thumbnail('std-thumbnail');
                            }

                            the_content();

                            // WordPress Link Pages
                            wp_link_pages(array('before' => '<div class="pages-nav clearfix">', 'after' => '</div>', 'next_or_number' => 'next'));
                            ?>
                        </article>
                        <?php
                    endwhile;
                    comments_template();
                endif;
                ?>

            </div>
            <!-- end of page content -->

        </div>
    </div>
</div>
<!-- End of Page Container -->


<?php get_footer(); ?>