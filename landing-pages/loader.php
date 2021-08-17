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

// load required files
require_once( 'roles-and-permissions.php' );
require_once( 'landing-post-type.php' );
require_once( 'rest.php' );
require_once( 'enqueue.php' );
// load admin files only if in admin
if ( is_admin() ) {
    $required_admin_files = scandir( plugin_dir_path( __FILE__ ) . '/admin' );
    foreach ( $required_admin_files as $file ) {
        if ( substr( $file, -4, '4' ) === '.php' ) {
            require_once( trailingslashit( plugin_dir_path( __FILE__ ) ) . '/admin/' . $file );
        }
    }
}

class DT_Porch_Template_Landing extends DT_Magic_Url_Base
{
    public $page_title = PORCH_LANDING_POST_TYPE_SINGLE;
    public $root = PORCH_LANDING_ROOT;
    public $type = PORCH_LANDING_TYPE;
    public $post_type = PORCH_LANDING_POST_TYPE;
    public $meta_key = PORCH_LANDING_META_KEY;

    private static $_instance = null;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    } // End instance()

    public function __construct() {
        parent::__construct();

        /**
         * tests if other URL
         */
        $url = dt_get_url_path();
        $length = strlen( $this->root . '/' . $this->type );
        if ( substr( $url, 0, $length ) !== $this->root . '/' . $this->type ) {
            return;
        }
        /**
         * tests magic link parts are registered and have valid elements
         */
        if ( !$this->check_parts_match( false ) ){
            return;
        }



        // load if valid url
        add_action( 'dt_blank_body', [ $this, 'body' ] ); // body for no post key

        add_filter( 'dt_magic_url_base_allowed_css', [ $this, 'dt_magic_url_base_allowed_css' ], 10, 1 );
        add_filter( 'dt_magic_url_base_allowed_js', [ $this, 'dt_magic_url_base_allowed_js' ], 10, 1 );
        add_action( 'wp_enqueue_scripts', [ $this, 'wp_enqueue_scripts' ], 99 );
    }

    public function dt_magic_url_base_allowed_js( $allowed_js ) {
        return DT_Porch_Template_Landing_Enqueue::load_allowed_scripts();
    }

    public function dt_magic_url_base_allowed_css( $allowed_css ) {
        return DT_Porch_Template_Landing_Enqueue::load_allowed_styles();
    }

    public function wp_enqueue_scripts() {
        DT_Porch_Template_Landing_Enqueue::load_scripts();
    }

    public function body(){
        require_once( 'body.php' );
    }

    public function footer_javascript(){
        require_once( 'footer.php' );
    }

    public function header_javascript(){
        require_once( 'header.php' );
    }
}
DT_Porch_Template_Landing::instance();
