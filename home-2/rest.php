<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

class DT_Porch_Template_Home_1_Rest {
    private static $_instance = null;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    } // End instance()

    public function __construct() {
        add_action( 'rest_api_init', [ $this, 'add_api_routes' ] );
    }

    public function add_api_routes() {
        $namespace = PORCH_ROOT . '/v1';
        register_rest_route(
            $namespace, '/' . PORCH_TYPE, [
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
DT_Porch_Template_Home_1_Rest::instance();