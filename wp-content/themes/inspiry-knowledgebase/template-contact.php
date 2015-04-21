<?php
/*
*	Template Name: Contact Template
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

                            ?>
                        </article>
                        <?php
                    endwhile;
                endif;
                ?>




                    <form id="contact-form" class="row" action="<?php echo admin_url( 'admin-ajax.php' ); ?>" method="post" >

                        <div class="span2">
                            <label for="name"><?php _e( 'Your Name', 'framework') ?> <span>*</span> </label>
                        </div>
                        <div class="span6">
                            <input type="text" name="name" id="name" class="required input-xlarge"  value="" title="<?php _e( '* Please provide your name', 'framework') ?>">
                        </div>

                        <div class="span2">
                            <label for="email"><?php _e( 'Your Email', 'framework') ?> <span>*</span></label>
                        </div>
                        <div class="span6">
                            <input type="text" name="email" id="email" class="email required input-xlarge"  value="" title="<?php _e( '* Please provide a valid email address', 'framework') ?>">
                        </div>

                        <div class="span2">
                            <label for="reason"><?php _e( 'Subject', 'framework') ?> </label>
                        </div>
                        <div class="span6">
                            <input type="text" name="reason" id="reason" class="input-xlarge"  value="">
                        </div>

                        <div class="span2">
                            <label for="message"><?php _e( 'Your Message', 'framework') ?> <span>*</span> </label>
                        </div>
                        <div class="span6">
                            <textarea name="message" id="message" class="required span6" rows="6" title="<?php _e( '* Please enter your message', 'framework') ?>"></textarea>
                            <input type="hidden" name="action" value="send_message" />
                            <input type="hidden" name="nonce" value="<?php echo wp_create_nonce( 'send_message_nonce' ); ?>"/>
                        </div>

                        <div class="span6 offset2 bm30">
                            <input type="submit" name="submit" value="<?php _e( 'Send Message', 'framework') ?>" class="btn btn-inverse">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/loading.gif" id="contact-loader" alt="Loading...">
                        </div>

                        <div class="span6 offset2 error-container"></div>
                        <div class="span8 offset2" id="message-sent"></div>

                    </form>

            </div>
            <!-- end of page content -->

            <?php get_sidebar('contact'); ?>

        </div>
    </div>
</div>
<!-- End of Page Container -->


<?php get_footer(); ?>

