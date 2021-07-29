<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

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