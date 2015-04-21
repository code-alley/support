<?php get_header(); ?>

<!-- Start of Page Container -->
<div class="page-container">
    <div class="container">
        <div class="row">

            <!-- start of page content -->
            <div class="span8 page-content">

                    <?php
                    if(is_singular('post'))
                        theme_breadcrumb();

                    if ( have_posts() ) :
                        while ( have_posts() ) :
                            the_post();

                            // fetch existing likes to display
                            $existing_likes = get_total_likes($post->ID);

                            ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class("clearfix"); ?>>
                            <h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

                            <div class="post-meta clearfix">
                                <span class="date"><i class="fa fa-calendar-o"></i><?php the_time('d M, Y'); ?></span>
                                <span class="category"><i class="fa fa-folder-open-o"></i><?php the_category(', '); ?></span>
                                <?php if ( comments_open() ){ ?>
                                <span class="comments"><i class="fa fa-comments-o"></i><?php comments_popup_link(__('0 Comments', 'framework'), __('1 Comment', 'framework'), __('% Comments', 'framework')); ?></span>
                                <?php } ?>
                                <span class="like-count"><i class="fa fa-thumbs-o-up"></i><?php echo $existing_likes; ?></a></span>
                            </div><!-- end of post meta -->

                            <?php
                            $format = get_post_format();
                            if( false === $format ) { $format = 'standard'; }
                            get_template_part( 'formats/' . $format );

                                the_content();

                                ?>
                            </article>

                            <?php
                            // check if current visitor already voted for this post
                            $extra_class = "";
                            if(already_liked($post->ID))
                            {
                                $extra_class = "already-voted";
                            }
                            ?>
                            <div class="like-btn">

                                <form id="like-it-form" action="<?php echo site_url(); ?>/wp-admin/admin-ajax.php" method="post" >
                                    <span class="like-it <?php echo $extra_class; ?>"><i class="fa fa-thumbs-o-up"></i><?php echo $existing_likes; ?></span>
                                    <input type="hidden" name="post_id" value="<?php echo $post->ID; ?>" />
                                    <input type="hidden" name="action" value="like_it" />
                                </form>
                                <span class="tags"><?php the_tags('<strong>'.__('Tags:','framework').'&nbsp;&nbsp;</strong>',', ',''); ?></span>
                            </div>
                            <?php

                            // WordPress Link Pages
                            wp_link_pages(array('before' => '<div class="pages-nav clearfix">', 'after' => '</div>', 'next_or_number' => 'next'));

                            ?>
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