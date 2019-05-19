<?php
/**
 * The header template file
 *
 * @file           header.php
 * @package        Impulse Press
 * @author         Two Impulse
 * @copyright      2014 Two Impulse
 * @license        license.txt
 * @version        Release: 1.3
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width">
    <title><?php wp_title('&#124;', true, 'right'); ?></title>
    <?php if (impulse_press_options('custom_favicon') !== '') { ?>
        <link rel="icon" type="image/png" href="<?php echo impulse_press_options('custom_favicon'); ?>"/>
    <?php } else { ?>
        <link rel="shortcut icon" href="<?php echo impulse_press_directory_uri(); ?>/favicon.png"/>
    <?php }  ?>

    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo impulse_press_directory_uri(); ?>/js/html5shiv.js"></script>
    <script src="<?php echo impulse_press_directory_uri(); ?>/js/respond.min.js"></script>
    <![endif]-->
    <?php wp_head();?>
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_uri(); ?>"/>

     <?php echo impulse_press_options('tracking_header'); ?>

</head>

<body <?php body_class(); ?>>

<div id="wrap">
    <!-- Navbar -->
    <div class="navbar-wrapper">
            <div class="navbar navbar-default <?php echo (impulse_press_options('disable_fixed_navbar', '0') == '1') ? 'navbar-fixed-top' : 'navbar-static-top' ?>">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                            <span class="fa fa-bars"></span>
                        </button>


                        <!--TODO - Add option for logo -->
                        <?php if (impulse_press_options('custom_logo') !== '') { ?>
                            <div id="logo">
                                <a href="<?php echo esc_url( home_url() ); ?>/" title="<?php bloginfo('name'); ?>"  rel="home">
                                    <img src="<?php echo impulse_press_options('custom_logo'); ?>" alt="<?php bloginfo('name'); ?>"/>
                                </a>
                            </div>
                        <?php } else { ?>
                        <a class="navbar-brand" href="<?php echo esc_url( home_url() ); ?>/" title="<?php bloginfo('name'); ?>"
                            rel="homepage"><?php bloginfo('name') ?></a>
                        <?php }  ?>

                    </div>
                    <div class="navbar-collapse collapse">
                        <?php
                            $walker = has_nav_menu( 'top-menu' ) ? new wp_bootstrap_navwalker() : new IP_Bootstrap_Page_Walker();
                            $args = array(
                                'theme_location' => 'top-menu',
                                'depth' => 2,
                                'container' => false,
                                'menu_class' => 'nav navbar-nav',
                                'fallback_cb' => 'impulse_press_page_menu',
                                'walker' => $walker,
                            );
                            wp_nav_menu($args);
                        ?>
                        
                        <div class="navbar-search">
                            <?php
                                if( impulse_press_options('enable_disable_search','1') == '1')
                                        get_search_form();
                             ?>
                        </div>
                        <div class="social-icons-top">
                            <?php
                                if( impulse_press_options('enable_social','1') == '1')   {
                                    impulse_press_opt_display_social_links();
                                }
                             ?>
                        </div>

                        


                    </div>

                </div>
            </div><!-- Navbar -->
       </div>

