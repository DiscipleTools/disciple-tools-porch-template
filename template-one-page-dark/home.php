<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

class Disciple_Tools_Porch_Template_Home
{
    public $root = "p4m_app";
    public $type = 'home';

    private static $_instance = null;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    } // End instance()

    public function __construct() {
        /**
         * Loads the REST url and gives authorization for non-logged in visitors.
         */
        add_action( 'rest_api_init', [ $this, 'add_api_routes' ] );
        add_filter( 'dt_allow_rest_access', [ $this, 'authorize_url' ], 10, 1 );

        /**
         * Grabs an empty url at the root of the site and loads the black template.
         */
        $url = dt_get_url_path();
        if ( empty( $url ) && ! dt_is_rest() ) {
            add_action( "template_redirect", [ $this, 'theme_redirect' ] );
            add_filter( 'dt_blank_access', function(){ return true;
            } );
            add_filter( 'dt_allow_non_login_access', function(){ return true;
            }, 100, 1 );

            add_filter( "dt_blank_title", [ $this, "_browser_tab_title" ] );
            add_action( 'dt_blank_head', [ $this, '_header' ] );
            add_action( 'dt_blank_footer', [ $this, '_footer' ] );
            add_action( 'dt_blank_body', [ $this, 'body' ] ); // body for no post key

            // load page elements
            add_action( 'wp_print_scripts', [ $this, '_print_scripts' ], 1500 );
            add_action( 'wp_print_styles', [ $this, '_print_styles' ], 1500 );

            add_action( 'wp_enqueue_scripts', [ $this, 'scripts' ], 99 );
        }
    }

    public function _browser_tab_title( $title ){
        $content = get_option( 'landing_content' );
        return $content['title'] ?? '';
    }

    public function theme_redirect() {
        $path = get_theme_file_path( 'template-blank.php' );
        include( $path );
        die();
    }

    public function _header(){
        ?>
        <?php echo esc_html( $content['google_analytics'] ?? '' ) ?>

        <!--- basic page needs
        ================================================== -->
        <meta charset="utf-8">
        <title><?php echo esc_html( $content['title'] ?? '' ) ?></title>
        <meta name="description" content="<?php echo esc_html( $content['description'] ?? '' ) ?>">
        <meta name="author" content="<?php echo esc_html( $content['title'] ?? '' ) ?>">
        <meta name="author" content="<?php echo esc_html( $content['title'] ?? '' ) ?>">

        <!-- mobile specific metas
        ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSS
        ================================================== -->
        <link rel="stylesheet" href="<?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>css/base.css">
        <link rel="stylesheet" href="<?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>css/vendor.css">
        <link rel="stylesheet" href="<?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>css/main.css">

        <!-- script
        ================================================== -->
        <script src="<?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>js/modernizr.js"></script>
        <script src="<?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>js/pace.min.js"></script>

        <!-- favicons
        ================================================== -->
        <link rel="shortcut icon" href="<?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>favicon.png" type="image/x-icon">
        <link rel="icon" href="<?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>favicon.png" type="image/x-icon">

        <style>
            .header-logo {
                z-index: 501;
                display: inline-block;
                margin: 0;
                padding: 0;
                position: absolute;
                left: 110px;
                top: 50%;
                -webkit-transform: translateY(-50%);
                -ms-transform: translateY(-50%);
                transform: translateY(-50%);
            }
            .header-logo a {
                display: block;
                padding: 0;
                outline: 0;
                border: none;
                -webkit-transition: all .3s ease-in-out;
                transition: all .3s ease-in-out;
                background-image: url(<?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>images/p4m-logo.png);
                background-repeat: no-repeat;
                background-size: 50px;
                background-position: left center;
                padding-left: 60px;
                font-size: 3em;
                font-weight: 900;
                color: #fff;
                font-family: 'times new roman';
            }
            @media only screen and (max-width: 1000px) {
                .header-logo a {
                    font-size: 1em;
                }
            }
        </style>
        <?php
        wp_head();
        $this->header_style();
        $this->header_javascript();
    }

    public function header_javascript(){
        ?>
        <script>
            let jsObject = [<?php echo json_encode([
                'map_key' => DT_Mapbox_API::get_key(),
                'mirror_url' => dt_get_location_grid_mirror( true ),
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

            jQuery(document).ready(function(){
                clearInterval(window.fiveMinuteTimer)
            })
        </script>
        <?php
        return true;
    }

    public function scripts() {}

    public function _print_scripts(){
        // @link /disciple-tools-theme/dt-assets/functions/enqueue-scripts.php

        $allowed_js = apply_filters( 'public_porch_allowed_js', [
            'jquery',
            //            'lodash',
            //            'site-js',
            //            'shared-functions',
            //            'mapbox-gl',
            //            'mapbox-cookie',
            //            'mapbox-search-widget',
            //            'google-search-widget',
            //            'jquery-cookie',
            //            'jquery-touch-punch',
        ] );

        global $wp_scripts;

        if ( isset( $wp_scripts ) ){
            foreach ( $wp_scripts->queue as $key => $item ){
                if ( ! in_array( $item, $allowed_js ) ){
                    unset( $wp_scripts->queue[$key] );
                }
            }
        }
        unset( $wp_scripts->registered['mapbox-search-widget']->extra['group'] );
    }

    public function _print_styles(){
        // @link /disciple-tools-theme/dt-assets/functions/enqueue-scripts.php
        $allowed_css = apply_filters( 'public_porch_allowed_css', [
            'foundation-css',
            'jquery-ui-site-css',
            //            'site-css',
            //            'mapbox-gl-css',
        ] );

        global $wp_styles;
        if ( isset( $wp_styles ) ) {
            foreach ($wp_styles->queue as $key => $item) {
                if ( !in_array( $item, $allowed_css )) {
                    unset( $wp_styles->queue[$key] );
                }
            }
        }
    }

    public function header_style(){}

    public function body(){
        require_once( 'template.php' );
    }

    public function _footer(){
        wp_footer();
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

    public function authorize_url( $authorized ){
        if ( isset( $_SERVER['REQUEST_URI'] ) && strpos( sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ), $this->root . '/v1/'.$this->type ) !== false ) {
            $authorized = true;
        }
        return $authorized;
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

        dt_write_log( $result );

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
Disciple_Tools_Porch_Template_Home::instance();
