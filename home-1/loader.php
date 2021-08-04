<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

/**
 * @todo Configure the title value, root value, type value, and token value. Don't change PORCH_ variable.
 */
if ( ! defined( 'PORCH_TITLE' ) ) {
    define( 'PORCH_TITLE', 'Home 1' ); // Used in tabs and titles, avoid special characters. Spaces are okay.
}
if ( ! defined( 'PORCH_ROOT' ) ) {
    define( 'PORCH_ROOT', 'porch_app' ); // Alphanumeric key. Use underscores not hyphens. No special characters.
}
if ( ! defined( 'PORCH_TYPE' ) ) {
    define( 'PORCH_TYPE', '1' ); // Alphanumeric key. Use underscores not hyphens. No special characters.
}
if ( ! defined( 'PORCH_TOKEN' ) ) {
    define( 'PORCH_TOKEN', 'porch_app_1' ); // Alphanumeric key. Use underscores not hyphens. No special characters. Must be less than 20 characters
}

class DT_Porch_Template_Home_1 extends DT_Magic_Url_Base
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

        // setup rest
        $url = dt_get_url_path();
        if ( empty( $url ) && ! dt_is_rest() ) {

            // register url and access
            add_action( "template_redirect", [ $this, 'theme_redirect' ] );
            add_filter( 'dt_blank_access', function (){ return true;
            }, 100, 1 ); // allows non-logged in visit
            add_filter( 'dt_allow_non_login_access', function (){ return true;
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

            add_action( 'init', [ 'DT_Porch_Template_Home_1_Storage', 'register_post_type' ] );
        }

        if ( dt_is_rest() ) {
            require_once( 'rest.php' );
            add_filter( 'dt_allow_rest_access', [ $this, 'authorize_url' ], 10, 1 );
        }

        if ( is_admin() ) {
            require_once( 'admin/admin-customizer.php' );
            add_action( 'init', [ 'DT_Porch_Template_Home_1_Storage', 'register_post_type' ] );
            add_filter( 'dt_set_roles_and_permissions', [ $this, 'dt_set_roles_and_permissions' ], 50, 1 );
        }
    }

    public function dt_magic_url_base_allowed_js( $allowed_js ) {
        return [ 'jquery', 'jquery-ui' ];
    }

    public function dt_magic_url_base_allowed_css( $allowed_css ) {
        return [ 'jquery-ui-site-css' ];
    }

    public function header_javascript(){
        require_once( 'header.php' );
    }

    public function body(){
        echo DT_Porch_Template_Home_1_Storage::get_body(); // @phpcs:ignore
    }

    public function footer_javascript(){
        require_once( 'footer.php' );
    }

    public function dt_set_roles_and_permissions( $expected_roles) {
        if ( !isset( $expected_roles["porch_admin"] )) {
            $expected_roles["porch_admin"] = [
                "label" => __( 'Porch Admin', 'disciple-tools-porch-template' ),
                "description" => "Administrates public porch",
                "permissions" => [
                    'read' => true,
                    'porch_admin' => true,
                    'edit_files' => true,
                    'upload_files' => true,
                ]
            ];
        }
        return $expected_roles;
    }
}
DT_Porch_Template_Home_1::instance();


class DT_Porch_Template_Home_1_Storage {

    public static $post_type = PORCH_TOKEN;
    public static $settings_token = PORCH_TOKEN . '_settings';
    public static $body_token = PORCH_TOKEN . '_body';

    public static $settings_version = 1;

    public static function register_post_type() {
        $args = array(
            'public'    => false
        );
        register_post_type( PORCH_TOKEN, $args );
    }

    public static function get_settings_defaults() {
        return [
            'version' => self::$settings_version,
            'title' => [
                'key' => 'title',
                'label' => 'Title',
                'type' => 'text',
                'default' => '',
                'value' => '',
            ],
            'description' => [
                'key' => 'description',
                'label' => 'Description',
                'type' => 'text',
                'default' => '',
                'value' => '',
            ],
            'google_analytics' => [
                'key' => 'google_analytics',
                'label' => 'Google Analytics',
                'type' => 'text',
                'default' => '',
                'value' => '',
            ],
            'contact_form' => [
                'key' => 'contact_form',
                'label' => 'Website Lead Form',
                'type' => 'text',
                'default' => '',
                'value' => '',
            ],
            'assigned_to' => [
                'key' => 'assigned_to',
                'label' => 'Assign to',
                'type' => 'user_list',
                'default' => '',
                'value' => '',
            ],
        ];
    }

    public static function match_settings() {
        $settings = [];
        $old_settings = self::get_settings();
        $default_settings = self::get_settings_defaults();
        foreach ( $default_settings as $value ) {
            $settings[$value['key']] = $value;
        }
        foreach ( $old_settings as $value ) {
            if ( isset( $settings[$value['key']] ) ) {
                $settings[$value['key']] = $value;
            }
        }
        return $settings;
    }

    public static function get_settings() : array {
        $post_id = self::get_settings_post_id();
        $post_meta = get_post_meta( $post_id, 'content', true );
        if ( false === $post_meta || ! is_array( $post_meta ) ) {
            $post_meta = self::update_settings( self::get_settings_defaults() );
        }

        return is_array( $post_meta ) ? $post_meta : self::get_settings_defaults();
    }

    public static function get_settings_post_id() {
        $post = get_page_by_title( self::$settings_token, ARRAY_A, self::$post_type );
        if ( empty( $post ) ) {
            $args = [
                'post_title' => self::$settings_token,
                'post_type' => self::$post_type
            ];
            $post_id = wp_insert_post( $args );
        } else {
            $post_id = $post['ID'];
        }
        return $post_id;
    }

    public static function update_settings( array $content ) {
        $post_id = self::get_settings_post_id();
        update_post_meta( $post_id, 'content', $content );
        return get_post_meta( $post_id, 'content', true );
    }

    public static function get_body() {
        $post_id = self::get_body_post_id();
        $post_meta = get_post_meta( $post_id, 'content', true );
        if ( false === $post_meta ) {
            $post_meta = self::insert_starter_content();
        }
        return $post_meta;
    }

    public static function get_body_post_id() {
        $post = get_page_by_title( self::$body_token, ARRAY_A, self::$post_type );
        if ( empty( $post ) ) {
            $args = [
                'post_title' => self::$body_token,
                'post_type' => self::$post_type
            ];
            $post_id = wp_insert_post( $args );
        } else {
            $post_id = $post['ID'];
        }
        return $post_id;
    }

    public static function insert_starter_content(){
        $html = file_get_contents( plugin_dir_path( __FILE__ ) . 'body.php' );
        $url = trailingslashit( plugin_dir_url( __FILE__ ) );
        $html = str_replace( '<?php echo esc_url( trailingslashit( plugin_dir_url( __FILE__ ) ) ) ?>', $url, $html );
        return self::update_body( $html );
    }

    public static function update_body( $content ) {
        $post_id = self::get_body_post_id();
        update_post_meta( $post_id, 'content', $content );
        return get_post_meta( $post_id, 'content', true );
    }
}
