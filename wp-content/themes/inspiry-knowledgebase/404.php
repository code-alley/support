<?php get_header(); ?>

<!-- Start of Page Container -->
<div class="page-container">
    <div class="container">
        <div class="row">

            <!-- start of page content -->
            <div class="span12 page-content">

                <article class="page-404">
                    <h1 class="title-404"><?php _e("404", 'framework'); ?></h1>
                    <h2><?php _e("Page Not Found", 'framework'); ?></h2>
                    <h3><?php _e('The page you are looking for is not here!', 'framework'); ?></h3>
                    <p><?php _e('Please try search for what you are looking for!', 'framework'); ?></p>
                </article>

            </div>
            <!-- end of page content -->

        </div>
    </div>
</div>
<!-- End of Page Container -->

<?php get_footer(); ?>