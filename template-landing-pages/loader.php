<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

$required_files = scandir( plugin_dir_path( __FILE__ ) );
if ( !empty( $required_files ) ) {
    // load all non-admin files
    foreach ($required_files as $file) {
        if ( substr( $file, -4, '4' ) === '.php' && substr( $file, 0, '6' ) !== 'admin-' && 'loader.php' !== $file ) {
            require_once( trailingslashit( plugin_dir_path( __FILE__ ) ) . $file );
        }
    }
    // load admin files only if in admin
    foreach ($required_files as $file) {
        if ( substr( $file, -4, '4' ) === '.php' && substr( $file, 0, '6' ) === 'admin-' && 'loader.php' !== $file ) {
            if ( is_admin() ) {
                require_once(trailingslashit(plugin_dir_path(__FILE__)) . $file);
            }
        }
    }
}

// load additional utilities
