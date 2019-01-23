<?php
/**
 * Sets up the WordPress Environment.
 *
 * @package WordPress
 */
require_once( dirname( dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) ) . '/wp-load.php' );

header( 'Content-Type: application/x-javascript; charset=utf-8' );

echo UixProducts::theme_list();