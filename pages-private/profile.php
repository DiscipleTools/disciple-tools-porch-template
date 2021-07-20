<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

/**
 * Class Disciple_Tools_Porch_Template_Public_Porch_Profile
 */
class Disciple_Tools_Porch_Template_Profile extends DT_Magic_Url_Base {

    public $page_title = 'Profile';
    public $root = "porch";
    public $type = 'profile';
    public $post_type = 'user';

    public $allowed_scripts = [ 'foundations-js' ];
    public $allowed_styles = [ 'foundations-css', 'porch-style-css' ];

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

        add_action( 'wp_enqueue_scripts', [ $this, 'scripts' ], 99 );
    }

    public function scripts(){
        require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'framework/enqueue.php');
        Disciple_Tools_Porch_Template_Enqueue::load_scripts();
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

            jQuery(document).ready(function(){
                jQuery(document).foundation();

                clearInterval(window.fiveMinuteTimer)

                window.get_user_app()
            })

            window.get_user_app = () => {
                jQuery.ajax({
                    type: "POST",
                    data: JSON.stringify({ action: 'something', parts: jsObject.parts }),
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    url: jsObject.root + jsObject.parts.root + '/v1/' + jsObject.parts.type,
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('X-WP-Nonce', jsObject.nonce )
                    }
                })
                    .done(function(data){
                        console.log( data )
                    })
                    .fail(function(e) {
                        console.log(e)
                        jQuery('#error').html(e)
                    })
            }


        </script>
        <?php
        return true;
    }

    public function body(){
        // nav
        require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'framework/nav.php');
        // body
        require_once('profile-template.php');
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
Disciple_Tools_Porch_Template_Profile::instance();
