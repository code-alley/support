<?php
/**
 * File Name: theme_comment.php
 *
 * Theme Custom Comment Template
 *
 */


function theme_comment($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
            ?>
        <li class="pingback">
            <p><?php _e( 'Pingback:', 'framework' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'framework' ), ' ' ); ?></p>
        </li>
        <?php
            break;
        default :
            ?>

                        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                            <article id="comment-<?php comment_ID(); ?>">

                                <a href="<?php comment_author_url(); ?>">
                                    <?php echo get_avatar( $comment, 60 ); ?>
                                </a>

                                <div class="comment-meta">

                                    <h5 class="author">
                                        <?php printf( __('%s', 'framework'), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
                                        <?php comment_reply_link( array_merge( array('before' => ' - '), array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                                    </h5>

                                    <p class="date">
                                        <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                                            <time datetime="<?php comment_time( 'c' ); ?>">
                                                <?php printf( __( '%1$s at %2$s', 'framework' ), get_comment_date(), get_comment_time() ); ?>
                                            </time>
                                        </a>
                                    </p>

                                </div><!-- end .comment-meta -->

                                <div class="comment-body">

                                    <?php if ( $comment->comment_approved == '0' ) : ?>
                                    <p><em><?php _e('Your comment is awaiting moderation.', 'framework'); ?></em></p>
                                    <?php endif; ?>

                                    <?php comment_text(); ?>

                                    <?php edit_comment_link( __( 'Edit', 'framework' ), ' ' ); ?>

                                </div><!-- end of comment-body -->

                            </article><!-- end of comment -->

                <?php
            break;
    endswitch;

}

?>