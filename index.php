<?php

include("alteraVariaveisGetBusca.php");


/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define( 'WP_USE_THEMES', true );

if(isset($_GET['post_type']) and $_GET['post_type']=='product'){
    $_GET['shop_view']='list_view';
}

/** Loads the WordPress Environment and Template */
require __DIR__ . '/wp-blog-header.php';
