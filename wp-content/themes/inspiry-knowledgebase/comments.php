<section id="comments">

	<?php if ( post_password_required() ): ?>

		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view comments.', 'framework' ); ?></p>

		</section><!-- end of comments -->

	<?php return; endif; ?>

	<?php if ( have_comments() ): ?>

		<h3 id="comments-title">
            <?php comments_number(__('No Comment','framework'), __('One Comment','framework'), __('(%) Comments','framework') );?>
		</h3>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'theme_comment' ) ); ?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ): ?>
		
			<nav class="pagination comments-pagination">
				<?php paginate_comments_links(); ?>
			</nav>
			
		<?php endif; ?>

	<?php endif; ?>

	<?php if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ): ?>
	
		<p class="nocomments"><?php _e( 'Comments are closed.', 'framework' ); ?></p>
		
	<?php endif; ?>

	<?php //comment_form(); ?>

    <?php
    /*-----------------------------------------------------------------------------------*/
    /*	Comment Form
    /*-----------------------------------------------------------------------------------*/

    if ( comments_open() ) : ?>

    <div id="respond">

        <h3><?php comment_form_title( __('Leave a Reply', 'framework'), __('Leave a Reply to %s', 'framework') ); ?></h3>

        <div class="cancel-comment-reply">
            <?php cancel_comment_reply_link(); ?>
        </div>

        <?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
        <p><?php printf(__('You must be %1$slogged in%2$s to post a comment.', 'framework'), '<a href="'.get_option('siteurl').'/wp-login.php?redirect_to='.urlencode(get_permalink()).'">', '</a>') ?></p>
        <?php else : ?>

        <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

            <?php if ( is_user_logged_in() ) : ?>

            <p><?php printf(__('Logged in as %1$s. %2$sLog out &raquo;%3$s', 'framework'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>', '<a href="'.(function_exists('wp_logout_url') ? wp_logout_url(get_permalink()) : get_option('siteurl').'/wp-login.php?action=logout" title="').'" title="'.__('Log out of this account', 'framework').'">', '</a>') ?></p>

            <?php else : ?>

                <p class="comment-notes"><?php _e('Your email address will not be published. Required fields are marked','framework'); ?> <span class="required">*</span></p>

                <div>
                    <label for="author"><?php _e('Name', 'framework') ?> <?php if ($req) _e("*", 'framework'); ?></label>
                    <input class="span4" type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" />
                </div>

                <div>
                    <label for="email"><?php _e('Email', 'framework') ?> <?php if ($req) _e("*", 'framework'); ?></label>
                    <input class="span4" type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" />
                </div>

                <div>
                    <label for="url"><?php _e('Website', 'framework') ?></label>
                    <input class="span4" type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
                </div>

            <?php endif; ?>

            <div>
                <label for="comment"><?php _e('Comment', 'framework') ?></label>
                <textarea class="span8" name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea>
            </div>

            <!-- <p class="allowed-tags">#<?php /*_e('You can use these HTML tags and attributes','framework'); */ ?> <small><code><?php /* echo allowed_tags(); */ ?></code></small></p> -->

            <div>
                <input class="btn" name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'framework') ?>" />
                <?php comment_id_fields(); ?>
            </div>

            <?php do_action('comment_form', $post->ID); ?>

        </form>

        <?php endif; // If registration required and not logged in ?>
    </div>

    <?php endif; // if comments open ?>

</section><!-- end of comments -->