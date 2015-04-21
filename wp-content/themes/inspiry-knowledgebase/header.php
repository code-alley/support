<!doctype html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
        <!-- META TAGS -->
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?php wp_title( '|', true, 'right' ); ?></title>

        <?php
        $favicon = get_option('theme_favicon');
        if( !empty($favicon) )
        {
            ?>
            <link rel="shortcut icon" href="<?php echo $favicon; ?>" />
            <?php
        }
        ?>


        <!-- Google Web Fonts-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>

        <!-- Style Sheet-->
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>"/>

        <!-- Pingback URL -->
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

        <!-- RSS -->
        <link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'rss2_url' ); ?>" />
        <link rel="alternate" type="application/atom+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'atom_url' ); ?>" />

        <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>


        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->


        <?php
        // Google Analytics From Theme Options
        echo stripslashes(get_option('theme_google_analytics'));
        ?>

        <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>


        <!-- Start of Header -->
        <div class="header-wrapper">
            <header>
                <div class="container">


                    <?php
                    $logo_path = get_option('theme_sitelogo');

                    if(!empty($logo_path))
                    {
                        ?>
                        <div class="logo-container">
                            <!-- Website Logo -->
                            <a href="<?php echo home_url(); ?>"  title="<?php bloginfo( 'name' ); ?>">
                                <img src="<?php echo $logo_path; ?>" alt="<?php  bloginfo( 'name' ); ?>">
                            </a>
                            <span class="tag-line"><?php bloginfo( 'description' ); ?></span>
                        </div>
                        <?php
                    }
                    else{
                        ?>
                        <h2 class="logo-heading">
                            <a href="<?php echo home_url(); ?>"  title="<?php bloginfo( 'name' ); ?>">
                                <?php  bloginfo( 'name' ); ?>
                            </a>
                        </h2>
                        <span class="tag-line"><?php bloginfo( 'description' ); ?></span>
                        <?php
                    }
                    ?>


                    <!-- Start of Main Navigation -->
                    <nav class="main-nav">
                        <?php
                        wp_nav_menu( array(
                            'theme_location' => 'main-menu',
                            'container' => 'div',
                            'menu_class' => 'clearfix'
                        ));
                        ?>
                    </nav>
                    <!-- End of Main Navigation -->

                </div>
            </header>
        </div>
        <!-- End of Header -->

        <!-- Start of Search Wrapper -->
        <div class="search-area-wrapper">
            <div class="search-area container">
                <?php
                    $theme_search_title = stripslashes(get_option('theme_search_title'));
                    $theme_search_text = stripslashes(get_option('theme_search_text'));
                ?>
                <h3 class="search-header"><?php echo $theme_search_title; ?></h3>
                <p class="search-tag-line"><?php echo $theme_search_text; ?></p>

                <form id="search-form" class="search-form clearfix" method="get" action="<?php echo home_url('/'); ?>" autocomplete="off">
                    <input class="search-term required" type="text" id="s" name="s" placeholder="<?php _e('Type your search terms here','framework');?>" title="<?php _e('* Please enter a search term!','framework');?>" />
                    <input class="search-btn" type="submit" value="Search" />
                    <div id="search-error-container"></div>
                </form>
            </div>
        </div>
        <!-- End of Search Wrapper -->
