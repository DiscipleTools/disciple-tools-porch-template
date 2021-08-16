<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.


class DT_Porch_Template_Landing_Enqueue
{
    public static function load_scripts() {
        wp_enqueue_style( 'porch-style-css', trailingslashit( plugin_dir_url( __FILE__ ) ) . 'css/landing.css', array(), filemtime( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'css/landing.css' ), 'all' );
        wp_register_script( 'porch-site-js', trailingslashit( plugin_dir_url( __FILE__ ) ) . 'js/landing.js', [ 'jquery' ], filemtime( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'js/landing.js' ) );
        wp_enqueue_script( 'porch-site-js' );
    }

    public static function load_allowed_scripts() {
        return [
            'jquery',
            'jquery-ui',
            'porch-site-js'
        ];
    }

    public static function load_allowed_styles() {
        return [
            'jquery-ui-site-css',
            'porch-style-css',
            'animate-css',
            'themeisle-gutenberg-animation-style',
            'genesis-blocks-style-css',
        ];
    }
}
