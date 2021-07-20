<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.


class Disciple_Tools_Porch_Template_Enqueue
{
    public static function load_scripts() {
        wp_enqueue_style( 'porch-style-css', trailingslashit( plugin_dir_url( __FILE__ ) ) . 'style.css', array(), filemtime( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'style.css' ), 'all' );
        wp_enqueue_style( 'foundations-css', 'https://cdn.jsdelivr.net/npm/foundation-sites@6.6.3/dist/css/foundation.min.css', array(), '6.6.3', 'all' );
        add_filter( 'style_loader_tag', function( $html, $handle ) {
            if ( 'foundations-css' === $handle ) {
                return str_replace( "media='all'", "media='all' integrity='sha256-ogmFxjqiTMnZhxCqVmcqTvjfe1Y/ec4WaRj/aQPvn+I=' crossorigin='anonymous'", $html );
            }
            return $html;
        }, 10, 2 );

        wp_register_script( 'porch-site-js', 'https://cdn.jsdelivr.net/npm/foundation-sites@6.6.3/dist/js/foundation.min.js', ['jquery'], '6.6.3' );
        wp_enqueue_script( 'porch-site-js' );

        wp_register_script( 'foundations-js', 'https://cdn.jsdelivr.net/npm/foundation-sites@6.6.3/dist/js/foundation.min.js', ['jquery'], '6.6.3' );
        wp_enqueue_script( 'foundations-js' );
        add_filter( 'style_loader_tag', function( $html, $handle ) {
            if ( 'foundations-js' === $handle ) {
                return str_replace( "media='all'", "media='all' integrity='sha256-pRF3zifJRA9jXGv++b06qwtSqX1byFQOLjqa2PTEb2o=' crossorigin='anonymous'", $html );
            }
            return $html;
        }, 10, 2 );
    }
}