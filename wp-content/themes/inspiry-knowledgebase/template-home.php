<?php
/*
*   Template Name: Home Template
*/
get_header();

?>

<!-- Start of Page Container -->
<div class="page-container">
    <div class="container">
        <div class="row">

            <!-- start of page content -->
            <div class="span8 page-content">

                <!-- Basic Home Page Template -->
                <?php get_template_part("template-parts/basic-home-template"); ?>

            </div>
            <!-- end of page content -->

            <?php get_sidebar('home'); ?>
        </div>
    </div>
</div>
<!-- End of Page Container -->


<?php get_footer(); ?>