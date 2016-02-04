<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon.ico">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php /* jQuery */ ?>
    <script src="//code.jquery.com/jquery.js"></script>
    <?php echo '<script>window.jQuery || document.write(\'<script src="'.get_bloginfo('template_directory').'/assets/js/jquery.min.js"><\/script>\')</script>'."\n"; ?>
    <?php wp_head(); ?>
	<link href="<?php echo get_template_directory_uri(); ?>/assets/css/style.min.css" rel="stylesheet" media="screen">
</head>
<body <?php body_class(); ?>>
    <div class="container">
        <div class="row">
            <div id="sidebar" class="col-sm-3">
                <div id="logo-brand">
                    <a href="<?php bloginfo('url'); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="<?php bloginfo('name'); ?>">
                    </a>
                </div>
                <div id="primary-menu">
                    <?php
                        wp_nav_menu( 
                            array(
                                'menu'              => 'primary',
                                'theme_location'    => 'primary',
                                'depth'             => 2,
                                'container'         => '',
                                'container_class'   => '',
                                'container_id'      => '',
                            )
                        );
                    ?>
                </div>
                <?php if ( is_active_sidebar( 'widget-sidebar' ) ) : ?>
                <ul id="widget-sidebar">
                    <?php dynamic_sidebar( 'widget-sidebar' ); ?>
                </ul>
                <?php endif; ?>
            </div>