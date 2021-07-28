<?php
if ( !defined( 'ABSPATH' )) {
    exit;
} // Exit if accessed directly.


/**
 * Disciple_Tools_Porch_Template_Landing_Roles Class
 *
 * @package  Disciple_Tools
 * @since    0.1.0
 */
class Disciple_Tools_Porch_Template_Landing_Roles
{
    // needs to match post-type.php
    public $post_type = 'landing';

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
        add_action( 'admin_head', [ $this, 'hide_menu' ] );
        add_action( 'admin_menu', [ $this, 'hide_customizer' ], 99 );
    }

    public function dt_set_roles_and_permissions( $expected_roles ){
        if ( !isset( $expected_roles["porch_admin"] ) ){
            $expected_roles["porch_admin"] = [
                "label" => __( 'Porch Admin', 'disciple_tools' ),
                "description" => "Administrates porch public pages",
                "permissions" => [
                    // rest access for blocks editor
                    'wp_api_allowed_user' => true,

                    // wp-admin dashboard access
                    'read' => true,

                    // landing page access
                    'create_'.$this->post_type => true,
                    'edit_'.$this->post_type => true,
                    'read_'.$this->post_type => true,
                    'delete_'.$this->post_type => true,
                    'delete_others_'.$this->post_type.'s',
                    'delete_'.$this->post_type.'s' => true,
                    'edit'.$this->post_type.'s' => true,
                    'edit_others_'.$this->post_type.'s' => true,
                    'publish_'.$this->post_type.'s' => true,
                    'read_private_'.$this->post_type.'s' => true,

                    // edit theme menu
//                    'edit_theme_options' => true,

                    'edit_files' => true,
                    'upload_files' => true,
                ]
            ];


        }
        return $expected_roles;
    }

    public function hide_menu() {
        if ( current_user_can('porch_admin' ) && ! current_user_can('manage_dt' ) ) {
//            remove_submenu_page( 'themes.php', 'themes.php' ); // hide the theme selection submenu
//            remove_submenu_page( 'themes.php', 'widgets.php' ); // hide the widgets submenu
        }
    }
    public function hide_customizer() {
        if ( current_user_can('porch_admin' ) && ! current_user_can('manage_dt' ) ) {
            global $submenu;
            if ( isset( $submenu[ 'themes.php' ] ) ) {
                foreach ( $submenu[ 'themes.php' ] as $index => $menu_item ) {
                    if ( in_array( 'customize', $menu_item ) ) {
                        unset( $submenu[ 'themes.php' ][ $index ] );
                    }
                }
            }
        }
    }

    public function dt_allow_rest_access( $authorized ) {
        if ( isset( $_SERVER['REQUEST_URI'] ) && strpos( sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ), 'wp/v2' ) !== false && user_can( get_current_user_id(), 'wp_api_allowed_user' ) ) {
            $authorized = true;
        }
        return $authorized;
    }

} // End Class
Disciple_Tools_Porch_Template_Landing_Roles::instance();
