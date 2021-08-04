<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.


class DT_Porch_Template_Home_5 extends DT_Magic_Url_Base
{
    public $magic = false;
    public $parts = false;
    public $page_title = 'Home 5';
    public $root = 'porch_app';
    public $type = '5';
    public static $token = 'porch_app_5';

    private static $_instance = null;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    } // End instance()

    public function __construct() {
        parent::__construct();

        add_action( 'rest_api_init', [ $this, 'add_api_routes' ] );
        add_filter( 'dt_allow_rest_access', [ $this, 'authorize_url' ], 10, 1 );

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
        }
    }

    public function dt_magic_url_base_allowed_js( $allowed_js ) {
        return [];
    }

    public function dt_magic_url_base_allowed_css( $allowed_css ) {
        return [];
    }

    public function theme_redirect() {
        $path = get_theme_file_path( 'template-blank.php' );
        include( $path );
        die();
    }

    public function header_javascript(){
        ?>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>css/line-icons.css">
        <link rel="stylesheet" href="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>css/owl.carousel.css">
        <link rel="stylesheet" href="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>css/owl.theme.css">
        <link rel="stylesheet" href="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>css/nivo-lightbox.css">
        <link rel="stylesheet" href="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>css/magnific-popup.css">
        <link rel="stylesheet" href="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>css/animate.css">
        <link rel="stylesheet" href="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>css/menu_sideslide.css">
        <link rel="stylesheet" href="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>css/main.css">
        <link rel="stylesheet" href="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>css/responsive.css">
        <script>
            let jsObject = [<?php echo json_encode([
                'theme_uri' => trailingslashit( get_stylesheet_directory_uri() ),
                'root' => esc_url_raw( rest_url() ),
                'nonce' => wp_create_nonce( 'wp_rest' ),
                'parts' => [
                    'root' => $this->root,
                    'type' => $this->type,
                ],
                'trans' => [
                    'add' => __( 'Add Magic', 'disciple_tools' ),
                ],
            ]) ?>][0]
        </script>
        <?php
        return true;
    }

    public function footer_javascript(){
        ?>
        <!-- jQuery first, then Tether, then Bootstrap JS. -->
        <script src="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>js/jquery-min.js"></script>
        <script src="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>js/tether.min.js"></script>
        <script src="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>js/bootstrap.min.js"></script>
        <script src="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>js/classie.js"></script>
        <script src="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>js/mixitup.min.js"></script>
        <script src="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>js/nivo-lightbox.js"></script>
        <script src="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>js/owl.carousel.min.js"></script>
        <script src="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>js/jquery.stellar.min.js"></script>
        <script src="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>js/jquery.nav.js"></script>
        <script src="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>js/smooth-scroll.js"></script>
        <script src="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>js/smooth-on-scroll.js"></script>
        <script src="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>js/wow.js"></script>
        <script src="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>js/menu.js"></script>
        <script src="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>js/jquery.vide.js"></script>
        <script src="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>js/jquery.counterup.min.js"></script>
        <script src="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>js/jquery.magnific-popup.min.js"></script>
        <script src="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>js/waypoints.min.js"></script>
        <script src="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>js/form-validator.min.js"></script>
        <script src="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>js/contact-form-script.js"></script>
        <script src="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>js/main.js"></script>
        <?php
    }

    public function body(){
        require_once( 'template.php' );
    }

    public function add_api_routes() {
        $namespace = $this->root . '/v1';
        register_rest_route(
            $namespace, '/' . $this->type, [
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
        $action = sanitize_text_field( wp_unslash( $params['action'] ) );

        switch ( $action ) {
            case 'followup':
                return $this->save_contact_lead( $params['data'] );
            case 'newsletter':
                return $this->save_newsletter( $params['data'] );

            default:
                return new WP_Error( __METHOD__, "Missing valid action", [ 'status' => 400 ] );
        }
    }

    public function save_newsletter( $data ) {
        $content = get_option( 'landing_content' );

        $data = dt_recursive_sanitize_array( $data );
        $email = $data['email'] ?? '';
        $fname = $data['fname'] ?? '';
        $lname = $data['lname'] ?? '';

        if ( empty( $email ) && empty( $phone ) ){
            return new WP_Error( __METHOD__, 'Must have either phone number or email address to create record.', [ 'status' => 400 ] );
        }

        //API KEY and LIST ID here
        $apiKey = $content['mailchimp_api_key'];
        $listId = $content['mailchimp_list_id'];

        $memberId = md5( strtolower( $email ) );
        $dataCenter = substr( $apiKey, strpos( $apiKey, '-' ) +1 );
        $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listId . '/members/' . $memberId;

        $json = json_encode([
            'email_address' => $email,
            'status'        => 'subscribed', // "subscribed","unsubscribed","cleaned","pending"
            'merge_fields'  => [
                'FNAME'     => $fname,
                'LNAME'     => $lname,
            ]
        ]);

        $ch = curl_init( $url );

        curl_setopt( $ch, CURLOPT_USERPWD, 'user:' . $apiKey );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, [ 'Content-Type: application/json' ] );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
        curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'PUT' );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $json );
        $result = curl_exec( $ch );


        $httpCode = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
        curl_close( $ch );

        return $result;
    }

    public function save_contact_lead( $data ) {
        $content = get_option( 'landing_content' );
        $fields = [];

        $data = dt_recursive_sanitize_array( $data );
        $email = $data['email'] ?? '';
        $phone = $data['phone'] ?? '';
        $name = $data['name'] ?? '';
        $comment = $data['comment'] ?? '';

        if ( empty( $email ) && empty( $phone ) ){
            return new WP_Error( __METHOD__, 'Must have either phone number or email address to create record.', [ 'status' => 400 ] );
        }

        if ( ! empty( $lname ) ) {
            $full_name = $name . ' ' . $lname;
        } else {
            $full_name = $name;
        }

        $fields['title'] = $full_name;
        if ( ! empty( $email ) ) {
            $fields['contact_email'] = [
                [ "value" => $email ]
            ];
        }
        if ( ! empty( $phone ) ) {
            $fields['contact_phone'] = [
                [ "value" => $phone ]
            ];
        }
        $fields['type'] = 'access';

        if ( isset( $content['assigned_user_for_followup'] ) && ! empty( $content['assigned_user_for_followup'] ) ) {
            $fields['assigned_to'] = $content['assigned_user_for_followup'];
        }

        if ( isset( $content['status_for_subscriptions'] ) && ! empty( $content['status_for_subscriptions'] ) ) {
            $fields['overall_status'] = $content['status_for_subscriptions'];
        }

        if ( isset( $content['source_for_subscriptions'] ) && ! empty( $content['source_for_subscriptions'] ) ) {
            $fields['sources'] = [
                "values" => [
                    [ "value" => $content['source_for_subscriptions'] ],
                ]
            ];
        }


        $fields['notes'] = [];
        // geolocate IP address
        if ( DT_Ipstack_API::get_key() ) {
            $result = DT_Ipstack_API::geocode_current_visitor();
            // @todo geocode ip address
            $fields['notes'][] = serialize( $result );
        } else {

            $fields['notes'][] = DT_Ipstack_API::get_real_ip_address();
        }

        $fields['notes'][] = $comment;

        $contact = DT_Posts::create_post( 'contacts', $fields, true, false );
        if ( ! is_wp_error( $contact ) ) {
            $contact_id = $contact['ID'];
        } else {
            return new WP_Error( __METHOD__, 'Could not create DT record.', [ 'status' => 400, 'error_data' => $contact ] );
        }


        return $data;
    }
}
DT_Porch_Template_Home_5::instance();