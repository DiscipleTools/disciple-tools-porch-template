<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

class DT_Porch_Template_Home_1_Admin {

    public $token = false;

    private static $_instance = null;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function __construct() {
        if ( !is_admin()) {
            return;
        }

        if ( ! current_user_can( 'porch_admin' ) ) {
            return;
        }

        $this->token = DT_Porch_Template_Home_1::$token;

        add_filter( 'dt_remove_menu_pages', [ $this, 'add_media_tab' ], 10, 1 );
        add_filter( 'upload_mimes', [ $this, 'add_additional_mime_types' ], 1, 1 );

        if ( isset( $_SERVER['REQUEST_URI'] ) && '/wp-admin/upload.php' === $_SERVER['REQUEST_URI'] ) {
            $this->add_media_page_warning();
        }

        add_action( 'admin_menu', [ $this, 'admin_menu' ] );
    }

    public function admin_menu() {
        add_menu_page( 'Porch', 'Porch', 'manage_options', $this->token, [ $this, 'landing_admin_page' ], 'dashicons-admin-generic', 5 );
    }

    public function landing_admin_page(){
        $slug = $this->token;

        if ( !current_user_can( 'porch_admin' ) ) { // manage dt is a permission that is specific to Disciple Tools and allows admins, strategists and dispatchers into the wp-admin
            wp_die( esc_attr__( 'You do not have sufficient permissions to access this page.' ) );
        }

        if ( isset( $_GET["tab"] ) ) {
            $tab = sanitize_key( wp_unslash( $_GET["tab"] ) );
        } else {
            $tab = 'settings';
        }

        $link = 'admin.php?page='.$slug.'&tab=';

        ?>
        <div class="wrap">
            <h2>Landing Page</h2>
            <h2 class="nav-tab-wrapper">
                <a href="<?php echo esc_attr( $link ) . 'settings' ?>"
                   class="nav-tab <?php echo esc_html( ( $tab == 'settings' || !isset( $tab ) ) ? 'nav-tab-active' : '' ); ?>">Settings
                </a>
                <a href="<?php echo esc_attr( $link ) . 'body' ?>"
                   class="nav-tab <?php echo esc_html( ( $tab == 'body' ) ? 'nav-tab-active' : '' ); ?>">Body
                </a>

            </h2>

            <?php
            switch ($tab) {
                case "settings":
                    $this->settings();
                    break;
                case "body":
                    $this->body();
                    break;
                default:
                    break;
            }
            ?>

        </div><!-- End wrap -->
        <?php
    }

    public function settings(){

        $settings = DT_Porch_Template_Home_1_Storage::get_settings();
        $current_version = DT_Porch_Template_Home_1_Storage::$settings_version;
        if ( $settings['version'] !== $current_version ) {
            $settings = DT_Porch_Template_Home_1_Storage::match_settings();
        }

        if ( isset( $_POST['landing_page'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['landing_page'] ) ), 'landing_page'.get_current_user_id() ) ) {

            dt_write_log( $_POST );

            foreach ( $settings as $index => $value ) {
                if ( 'version' === $index ) {
                    continue;
                }
                if ( isset( $_POST[$value['key']] ) ) {

                    $settings[$value['key']]['value'] = sanitize_text_field( wp_unslash( $_POST[$value['key']] ) );
                }
            }

            $settings = DT_Porch_Template_Home_1_Storage::update_settings( $settings );
        }
        ?>
        <div class="wrap">
            <div id="poststuff">
                <div id="post-body" class="metabox-holder columns-2">
                    <div id="post-body-content">
                        <!-- Box -->
                        <form method="post">
                            <?php wp_nonce_field( 'landing_page'.get_current_user_id(), 'landing_page' ) ?>
                            <table class="widefat striped">
                                <thead>
                                <tr>
                                    <th colspan="2">Configuration</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ( $settings as $key => $value ) {
                                    if ( 'version' === $key ) {
                                        continue;
                                    }

                                    switch ( $value['type'] ) {
                                        case 'text':
                                            ?>
                                            <tr>
                                                <td style="width:150px;">
                                                    <?php echo esc_html( $value['label'] ) ?>
                                                </td>
                                                <td>
                                                    <input type="text" name="<?php echo esc_attr( $value['key'] ) ?>" class="regular-text" value="<?php echo esc_html( $value['value'] ) ?>" />
                                                </td>
                                            </tr>
                                            <?php
                                            break;
                                        case 'user_list':
                                            ?>
                                            <tr>
                                                <td style="width:150px;">
                                                    <?php echo esc_html( $value['label'] ) ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $roles = [];
                                                    $wp_roles       = wp_roles()->roles;
                                                    $selected_value = $settings[$value['key']];

                                                    foreach ( $wp_roles as $role_name => $role_obj ) {
                                                        if ( ! empty( $role_obj['capabilities']['access_contacts'] ) ) {
                                                            $roles[] = $role_name;
                                                        }
                                                    }

                                                    $potential_user_list = get_users(
                                                        [
                                                            'order'    => 'ASC',
                                                            'orderby'  => 'display_name',
                                                            'role__in' => $roles,
                                                        ]
                                                    );

                                                    $base_user           = dt_get_base_user();

                                                    ?>
                                                    <select name="<?php echo esc_attr( $value['key'] ) ?>" id="<?php echo esc_attr( $value['key'] ) ?>">
                                                        <option disabled>---</option>
                                                        <?php foreach ( $potential_user_list as $potential_user ): ?>
                                                            <option
                                                                value="<?php echo esc_attr( $potential_user->ID ); ?>" <?php if ( $potential_user->ID == $selected_value || ! $selected_value && $potential_user->ID == $base_user->ID ): ?> selected <?php endif; ?> ><?php echo esc_attr( $potential_user->display_name ); ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <?php
                                            break;
                                    }
                                }
                                ?>
                                <tr>
                                    <td colspan="2">
                                        <button type="submit" class="button">Update</button>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </form>
                        <!-- End Box -->
                        <!-- End Main Column -->
                    </div><!-- end post-body-content -->
                    <div id="postbox-container-1" class="postbox-container">
                        <!-- Right Column -->
                        <!-- End Right Column -->
                    </div><!-- postbox-container 1 -->
                    <div id="postbox-container-2" class="postbox-container">
                    </div><!-- postbox-container 2 -->
                </div><!-- post-body meta box container -->
            </div><!--poststuff end -->
        </div><!-- wrap end -->
        <?php
    }

    public function body(){
        $content = DT_Porch_Template_Home_1_Storage::get_body();
        if ( isset( $_POST['post_content'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['post_content'] ) ), 'post_content'.get_current_user_id() ) && isset( $_POST['body_field'] ) ) {
            if ( isset( $_POST['reset_template'] ) ) {
                $content = DT_Porch_Template_Home_1_Storage::insert_starter_content();
            } else {
                $body = $_POST['body_field']; // @phpcs:ignore
                $content = DT_Porch_Template_Home_1_Storage::update_body( $body );
            }
        }
        ?>
        <form method="post">
            <?php wp_nonce_field( 'post_content'.get_current_user_id(), 'post_content' ) ?>
            <div class="wrap">
                <div id="poststuff">
                    <div id="post-body" class="metabox-holder columns-1">
                        <div id="post-body-content">
                            <table class="widefat striped">
                                <thead>
                                <tr>
                                    <th>Body HTML <button type="submit" class="button" name="reset_template" value="true" style="float:right;">Reset</button> <button type="submit" class="button" style="float:right;">Update</button></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <textarea type="text" name="body_field" id="body_field" style="width:100%; height:600px;" ><?php echo $content; // @phpcs:ignore ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="submit" class="button"  style="float:right;">Update</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <script>
            jQuery(document).ready(function($){
                jQuery('#body_field').height( window.innerHeight - 300 )
            })
        </script>
        <?php
    }

    public function add_media_tab( $list ) {
        if ( isset( $list['media'] ) ) {
            unset( $list['media'] );
        }
        return $list;
    }
    public function add_additional_mime_types( $mime_types){
        $mime_types['svg'] = 'image/svg+xml'; //Adding svg extension
        $mime_types['psd'] = 'image/vnd.adobe.photoshop'; //Adding photoshop files
        $mime_types['pdf'] = 'application/pdf'; //Adding photoshop files
        $mime_types['docx'] = 'application/vnd.openxmlformats-'; //Adding photoshop files
        $mime_types['doc'] = 'application/msword'; //Adding photoshop files
        $mime_types['csv'] = 'text/csv'; //Adding photoshop files
        $mime_types['zip'] = 'application/zip'; //Adding photoshop files
        return $mime_types;
    }

    public function add_media_page_warning() {
        ?>
        <div class="notice notice-warning is-dismissible">
            <p>SECURITY WARNING: <BR>ALL IMAGES AND MEDIA FILES ADDED HERE ARE PUBLICLY ACCESSIBLE TO THE INTERNET. <BR>DO NOT STORE SENSITIVE FILES!</p>
        </div>
        <?php
    }
}
DT_Porch_Template_Home_1_Admin::instance();
