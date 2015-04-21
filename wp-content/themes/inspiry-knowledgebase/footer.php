<!-- Start of Footer -->
<footer id="footer-wrapper">
    <div id="footer" class="container">
        <div class="row">

            <div class="span3">
                <?php if ( ! dynamic_sidebar( 'Footer First Column' )) : ?>
                <?php endif; ?>
            </div>

            <div class="span3">
                <?php if ( ! dynamic_sidebar( 'Footer Second Column' )) : ?>
                <?php endif; ?>
            </div>


            <div class="span3">
                <?php if ( ! dynamic_sidebar( 'Footer Third Column' )) : ?>
                <?php endif; ?>
            </div>


            <div class="span3">
                <?php if ( ! dynamic_sidebar( 'Footer Fourth Column' )) : ?>
                <?php endif; ?>
            </div>

        </div>
    </div>
    <!-- end of #footer -->

    <!-- Footer Bottom -->
    <div id="footer-bottom-wrapper">
        <div id="footer-bottom" class="container">
            <div class="row">
                <div class="span6">
                    <p class="copyright">
                        <?php echo stripslashes(get_option('theme_copyright_text')); ?>
                    </p>
                </div>
                <div class="span6">
                    <?php
                    $show_social = get_option('theme_show_social_menu');

                    $sl_facebook = get_option('theme_facebook_link');
                    $sl_twitter = get_option('theme_twitter_link');
                    $sl_rss = get_option('theme_rss_link');

                    $sl_linkedin = get_option('theme_linkedin_link');
                    $sl_stumble = get_option('theme_stumble_link');
                    $sl_google = get_option('theme_google_link');

                    $sl_deviantart = get_option('theme_deviantart_link');
                    $sl_flickr = get_option('theme_flickr_link');
                    $sl_skype = get_option('theme_skype_link');

                    if($show_social == 'true')
                    {
                        ?>
                        <!-- Social Navigation -->
                        <ul class="social-nav clearfix">
                            <?php
                            echo ($sl_linkedin) ? '<li class="linkedin"><a target="_blank" href="'.$sl_linkedin.'"></a></li>' : '';
                            echo ($sl_stumble) ? '<li class="stumble"><a target="_blank" href="'.$sl_stumble.'"></a></li>' : '';
                            echo ($sl_google) ? '<li class="google"><a target="_blank" href="'.$sl_google.'"></a></li>' : '';
                            echo ($sl_deviantart) ? '<li class="deviantart"><a target="_blank" href="'.$sl_deviantart.'"></a></li>' : '';
                            echo ($sl_flickr) ? '<li class="flickr"><a target="_blank" href="'.$sl_flickr.'"></a></li>' : '';
                            echo ($sl_skype) ? '<li class="skype"><a target="_blank" href="skype:'.$sl_skype.'?call"></a></li>' : '';
                            echo ($sl_rss) ? '<li class="rss"><a target="_blank" href="'.$sl_rss.'"></a></li>' : '';
                            echo ($sl_twitter) ? '<li class="twitter"><a target="_blank" href="'.$sl_twitter.'"></a></li>' : '';
                            echo ($sl_facebook) ? '<li class="facebook"><a target="_blank" href="'.$sl_facebook.'"></a></li>' : '';
                            ?>
                        </ul>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Footer Bottom -->

</footer>
<!-- End of Footer -->

<a href="#top" id="scroll-top"></a>

<?php wp_footer(); ?>

</body>
</html>
