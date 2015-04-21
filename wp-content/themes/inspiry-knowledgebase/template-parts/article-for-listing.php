<article id="post-<?php the_ID(); ?>" <?php post_class("clearfix"); ?>>

    <header class="clearfix">

        <h3 class="post-title">
            <?php
            $format = get_post_format();
            if( false === $format ) {
                $format = 'standard';
            }
            ?>
            <a href="<?php the_permalink(); ?>">
                <?php
                inspiry_post_format_icon( $format );
                the_title();
                ?>
            </a>
        </h3>

        <div class="post-meta clearfix">
            <span class="date"><i class="fa fa-calendar-o"></i><?php the_time('d M, Y'); ?></span>
            <span class="category"><i class="fa fa-folder-open-o"></i><?php the_category(', '); ?></span>

            <?php if ( comments_open() ){ ?>
            <span class="comments"><i class="fa fa-comments-o"></i><?php comments_popup_link(__('0 Comments', 'framework'), __('1 Comment', 'framework'), __('% Comments', 'framework')); ?></span>
            <?php } ?>

            <?php if($post->post_type == 'post'):?>
            <span class="like-count"><i class="fa fa-thumbs-o-up"></i><?php echo get_total_likes($post->ID); ?></span>
            <?php endif; ?>
        </div><!-- end of post meta -->

    </header>
    <?php

    get_template_part( 'formats/' . $format );

    the_excerpt();
    ?>
</article>