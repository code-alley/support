<?php get_header(); ?>

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
                                <h1 class="post-title"><?php the_title(); ?></h1>
                                <hr>
                                <?php the_content(); ?>
                            </article>
                            <?php
                        endwhile;
                        comments_template();
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