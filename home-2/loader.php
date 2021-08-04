<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

/**
 * @todo Configure the title value, root value, type value, and token value. Don't change PORCH_ variable.
 */
if ( ! defined( 'PORCH_TITLE' ) ) {
    define( 'PORCH_TITLE', 'Home 2' ); // Used in tabs and titles, avoid special characters. Spaces are okay.
}
if ( ! defined( 'PORCH_ROOT' ) ) {
    define( 'PORCH_ROOT', 'porch_app' ); // Alphanumeric key. Use underscores not hyphens. No special characters.
}
if ( ! defined( 'PORCH_TYPE' ) ) {
    define( 'PORCH_TYPE', '2' ); // Alphanumeric key. Use underscores not hyphens. No special characters.
}
if ( ! defined( 'PORCH_TOKEN' ) ) {
    define( 'PORCH_TOKEN', 'porch_app_2' ); // Alphanumeric key. Use underscores not hyphens. No special characters. Must be less than 20 characters
}

class DT_Porch_Template_Home_2 extends DT_Magic_Url_Base
{
    public $magic = false;
    public $parts = false;
    public $page_title = PORCH_TITLE;
    public $root = PORCH_ROOT;
    public $type = PORCH_TYPE;
    public static $token = PORCH_TOKEN;

    private static $_instance = null;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    } // End instance()

    public function __construct() {
        parent::__construct();

        $url = dt_get_url_path();
        if ( empty( $url ) && ! dt_is_rest() ) {

            // register url and access
            add_action( "template_redirect", [ $this, 'theme_redirect' ] );
            add_filter( 'dt_blank_access', function (){ return true;
            }, 100, 1 ); // allows non-logged in visit
            add_filter( 'dt_allow_non_login_access', function (){ return true;
            }, 100, 1 );
            add_filter( 'dt_override_header_meta', function (){ return true;
            }, 100, 1 );

            // header content
            add_filter( "dt_blank_title", [ $this, "page_tab_title" ] ); // adds basic title to browser tab
            add_action( 'wp_print_scripts', [ $this, 'print_scripts' ], 1500 ); // authorizes scripts
            add_action( 'wp_print_styles', [ $this, 'print_styles' ], 1500 ); // authorizes styles


            // page content
            add_action( 'dt_blank_head', [ $this, '_header' ] );
            add_action( 'dt_blank_footer', [ $this, '_footer' ] );
            add_action( 'dt_blank_body', [ $this, 'body' ] ); // body for no post key

            add_filter( 'dt_magic_url_base_allowed_css', [ $this, 'dt_magic_url_base_allowed_css' ], 10, 1 );
            add_filter( 'dt_magic_url_base_allowed_js', [ $this, 'dt_magic_url_base_allowed_js' ], 10, 1 );
        }

        if ( dt_is_rest() ) {
            require_once( 'rest.php' );
            add_filter( 'dt_allow_rest_access', [ $this, 'authorize_url' ], 10, 1 );
        }
    }

    public function dt_magic_url_base_allowed_js( $allowed_js ) {
        return [];
    }

    public function dt_magic_url_base_allowed_css( $allowed_css ) {
        return [];
    }

    public function header_javascript(){
        require_once( 'header.php' );
    }

    public function body(){
        require_once( 'body.php' );
    }

    public function footer_javascript(){
        require_once( 'footer.php' );
    }
}
DT_Porch_Template_Home_2::instance();
