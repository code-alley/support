<?php
/*
*  Template Name: FAQs Template
*/

get_header(); ?>

<!-- Start of Page Container -->
<div class="page-container">
    <div class="container">
        <div class="row">

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
                endif;


                // Custom Query for FAQs
                $faq_query = new WP_Query(array(
                    'post_type' => 'faq',
                    'posts_per_page' => -1
                ));

                if ( $faq_query->have_posts() ) :
                    ?>
                        <div class="faqs clearfix">
                            <?php
                            while ( $faq_query->have_posts() ) :
                                $faq_query->the_post();
                                ?>
                                <article class="faq-item">
                                    <span class="faq-icon"></span>
                                    <h3 class="faq-question">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    <div class="faq-answer">
                                        <?php the_content(); ?>
                                    </div>
                                </article>
                                <?php
                            endwhile;
                            ?>
                        </div>
                    <?php
                endif;
                ?>

            </div>
            <!-- end of page content -->

            <?php get_sidebar('page'); ?>

        </div>
    </div>
</div>
<!-- End of Page Container -->


<?php get_footer(); ?>

