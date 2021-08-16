<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

if ( ! defined( 'PORCH_LANDING_ROOT' ) ) {
    define( 'PORCH_LANDING_ROOT', 'l' ); // Alphanumeric key. Use underscores not hyphens. No special characters.
}
if ( ! defined( 'PORCH_LANDING_TYPE' ) ) {
    define( 'PORCH_LANDING_TYPE', 'page' ); // Alphanumeric key. Use underscores not hyphens. No special characters. Must be less than 20 characters
}
if ( ! defined( 'PORCH_LANDING_META_KEY' ) ) {
    define( 'PORCH_LANDING_META_KEY', PORCH_LANDING_ROOT . '_' . PORCH_LANDING_TYPE . '_magic_key' ); // Alphanumeric key. Use underscores not hyphens. No special characters. Must be less than 20 characters
}
if ( ! defined( 'PORCH_LANDING_POST_TYPE' ) ) {
    define( 'PORCH_LANDING_POST_TYPE', 'landing' ); // Alphanumeric key. Use underscores not hyphens. No special characters. Must be less than 20 characters
}
if ( ! defined( 'PORCH_LANDING_POST_TYPE_SINGLE' ) ) {
    define( 'PORCH_LANDING_POST_TYPE_SINGLE', 'Landing' ); // Alphanumeric key. Use underscores not hyphens. No special characters. Must be less than 20 characters
}
if ( ! defined( 'PORCH_LANDING_POST_TYPE_PLURAL' ) ) {
    define( 'PORCH_LANDING_POST_TYPE_PLURAL', 'Landings' ); // Alphanumeric key. Use underscores not hyphens. No special characters. Must be less than 20 characters
}

$required_files = scandir( plugin_dir_path( __FILE__ ) );
// load all non-admin files
foreach ($required_files as $file) {
    if ( substr( $file, -4, '4' ) === '.php' && 'loader.php' !== $file ) {
        require_once( trailingslashit( plugin_dir_path( __FILE__ ) ) . $file );
    }
}
// load admin files only if in admin
if ( is_admin() ) {
    $required_admin_files = scandir( plugin_dir_path( __FILE__ ) . '/admin' );
    foreach ( $required_admin_files as $file ) {
        if ( substr( $file, -4, '4' ) === '.php' ) {
            require_once( trailingslashit( plugin_dir_path( __FILE__ ) ) . '/admin/' . $file );
        }
    }
}
