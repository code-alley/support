<?php
/**
 * File Name: article-for-widget.php
 */
$format = get_post_format();
if( false === $format ) { $format = 'standard'; }
?>
<li class="article-entry <?php echo $format; ?>">
    <h4>
        <a href="<?php the_permalink(); ?>">
            <?php
            inspiry_post_format_icon( $format );
            the_title();
            ?>
        </a>
    </h4>
    <span class="article-meta"><?php the_time('d M, Y'); ?> <?php _e('in','framework'); ?> <?php the_category(', '); ?></span>
    <span class="like-count"><i class="fa fa-thumbs-o-up"></i><?php echo get_total_likes($post->ID); ?></span>
</li>
