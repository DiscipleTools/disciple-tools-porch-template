<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

/**
 * Class Disciple_Tools_Porch_Template_Public_Porch_Profile
 */
class Disciple_Tools_Porch_Template_User_Page extends DT_Magic_Url_Base {

    public $page_title = 'Private User Page';
    public $root = "private_app";
    public $type = 'user';
    public $post_type = 'user';

    private static $_instance = null;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    } // End instance()

    public function __construct() {
        parent::__construct();

        add_action( 'rest_api_init', [ $this, 'add_endpoints' ] );

        /**
         * tests if other URL
         */
        $url = dt_get_url_path();
        if ( strpos( $url, $this->root . '/' . $this->type ) === false ) {
            return;
        }
        /**
         * tests magic link parts are registered and have valid elements
         */
        if ( !$this->check_parts_match( false ) ){
            return;
        }

        // require login access
        if ( ! is_user_logged_in() ) {
            wp_safe_redirect( dt_custom_login_url( 'login' ) );
        }


        // load if valid url
        add_action( 'dt_blank_body', [ $this, 'body' ] ); // body for no post key

        add_filter( 'dt_magic_url_base_allowed_css', [ $this, 'dt_magic_url_base_allowed_css'], 10, 1 );
        add_filter( 'dt_magic_url_base_allowed_js', [ $this, 'dt_magic_url_base_allowed_js'], 10, 1 );
        add_action( 'wp_enqueue_scripts', [ $this, 'wp_enqueue_scripts' ], 99 );
    }

    public function dt_magic_url_base_allowed_css( $allowed_css ) {
        return [
            'porch-user-style-css',
            'jquery-ui-site-css',
            'foundations-css',
        ];
    }

    public function dt_magic_url_base_allowed_js( $allowed_js ) {
        return [
            'jquery',
            'jquery-ui',
            'foundations-js',
            'porch-user-site-js',
        ];
    }

    public function wp_enqueue_scripts() {

        // styles
        wp_enqueue_style( 'foundations-css', 'https://cdn.jsdelivr.net/npm/foundation-sites@6.6.3/dist/css/foundation.min.css', array(), '6.6.3', 'all' );
        add_filter( 'style_loader_tag', function( $html, $handle ) {
            if ( 'foundations-css' === $handle ) {
                return str_replace( "media='all'", "media='all' integrity='sha256-ogmFxjqiTMnZhxCqVmcqTvjfe1Y/ec4WaRj/aQPvn+I=' crossorigin='anonymous'", $html );
            }
            return $html;
        }, 10, 2 );
        wp_enqueue_style( 'porch-user-style-css', trailingslashit( plugin_dir_url( __FILE__ ) ) . 'css/style.css', array('foundations-css'), filemtime( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'css/style.css' ), 'all' );

        // javascript
        wp_register_script( 'foundations-js', 'https://cdn.jsdelivr.net/npm/foundation-sites@6.6.3/dist/js/foundation.min.js', ['jquery'], '6.6.3' );
        wp_enqueue_script( 'foundations-js' );
        add_filter( 'style_loader_tag', function( $html, $handle ) {
            if ( 'foundations-js' === $handle ) {
                return str_replace( "media='all'", "media='all' integrity='sha256-pRF3zifJRA9jXGv++b06qwtSqX1byFQOLjqa2PTEb2o=' crossorigin='anonymous'", $html );
            }
            return $html;
        }, 10, 2 );

        wp_enqueue_script( 'porch-user-site-js', trailingslashit( plugin_dir_url( __FILE__ ) ) . 'js/site.js', ['jquery'], filemtime( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'js/site.js' ) );
    }

    public function footer_javascript(){
        ?>
        <script>
            let jsObject = [<?php echo json_encode([
                'map_key' => DT_Mapbox_API::get_key(),
                'root' => esc_url_raw( rest_url() ),
                'nonce' => wp_create_nonce( 'wp_rest' ),
                'parts' => $this->parts,
                'translations' => [
                    'add' => __( 'Add Magic', 'disciple_tools' ),
                ],
            ]) ?>][0]
        </script>
        <?php
        return true;
    }

    public function body(){
        require_once('user-page-template.php');
    }

    /**
     * Register REST Endpoints
     * @link https://github.com/DiscipleTools/disciple-tools-theme/wiki/Site-to-Site-Link for outside of wordpress authentication
     */
    public function add_endpoints() {
        $namespace = $this->root . '/v1';
        register_rest_route(
            $namespace, '/'.$this->type, [
                [
                    'methods'  => "POST",
                    'callback' => [ $this, 'endpoint' ],
                    'permission_callback' => '__return_true',
                ],
            ]
        );
    }

    public function endpoint( WP_REST_Request $request ) {

        $params = $request->get_params();

        if ( ! isset( $params['parts'], $params['action'] ) ) {
            return new WP_Error( __METHOD__, "Missing parameters", [ 'status' => 400 ] );
        }

        $params = dt_recursive_sanitize_array( $params );

        return $params;
    }

}
Disciple_Tools_Porch_Template_User_Page::instance();
