<?php
/**
 * Roles
 */

if ( !defined( 'ABSPATH' )) {
    exit;
} // Exit if accessed directly.


/**
 * Disciple_Tools_Porch_Template_Landing_Roles Class
 * All functionality pertaining to project update post types in Disciple_Tools_Porch_Template_Landing_Roles.
 *
 * @package  Disciple_Tools
 * @since    0.1.0
 */
class Disciple_Tools_Porch_Template_Landing_Roles
{

    private static $_instance = null;
    public static function instance() {
        if (is_null( self::$_instance )) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        add_filter( 'dt_set_roles_and_permissions', [ $this, 'dt_set_roles_and_permissions' ], 50, 1 );
        add_filter( 'dt_allow_rest_access', [ $this, 'dt_allow_rest_access'] ); // allows access
    }

    public function dt_set_roles_and_permissions( $expected_roles ){
        if ( !isset( $expected_roles["porch_admin"] ) ){
            $expected_roles["porch_admin"] = [
                "label" => __( 'Porch Admin', 'disciple_tools' ),
                "description" => "Administrates porch public pages",
                "permissions" => [
                    'wp_api_allowed_user' => true,
                    'read' => true,
                ]
            ];
        }
        return $expected_roles;
    }

    public function dt_allow_rest_access( $authorized ) {
        if ( isset( $_SERVER['REQUEST_URI'] ) && strpos( sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ), 'wp/v2' ) !== false && user_can( get_current_user_id(), 'wp_api_allowed_user' ) ) {
            $authorized = true;
        }
        return $authorized;
    }

} // End Class
Disciple_Tools_Porch_Template_Landing_Roles::instance();
