<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

/**
 * Class DT_Porch_Template_Menu
 */
class DT_Porch_Template_Landing_Menu {

    public $token = 'dt_porch_template';
    public $title = 'Porch Template';

    private static $_instance = null;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        if ( ! is_admin() ) {
            return;
        }

        add_action( "admin_menu", array( $this, "register_menu" ) );

    } // End __construct()

    /**
     * Loads the subnav page
     * @since 0.1
     */
    public function register_menu() {
        add_submenu_page( 'dt_extensions', $this->title, $this->title, 'manage_dt', $this->token, [ $this, 'content' ] );
    }

    /**
     * Menu stub. Replaced when Disciple Tools Theme fully loads.
     */
    public function extensions_menu() {}

    /**
     * Builds page contents
     * @since 0.1
     */
    public function content() {

        if ( !current_user_can( 'manage_dt' ) ) { // manage dt is a permission that is specific to Disciple Tools and allows admins, strategists and dispatchers into the wp-admin
            wp_die( 'You do not have sufficient permissions to access this page.' );
        }

        if ( isset( $_GET["tab"] ) ) {
            $tab = sanitize_key( wp_unslash( $_GET["tab"] ) );
        } else {
            $tab = 'general';
        }

        $link = 'admin.php?page='.$this->token.'&tab=';

        ?>
        <div class="wrap">
            <h2>Public Porch Template</h2>
            <h2 class="nav-tab-wrapper">
                <a href="<?php echo esc_attr( $link ) . 'general' ?>"
                   class="nav-tab <?php echo esc_html( ( $tab == 'general' || !isset( $tab ) ) ? 'nav-tab-active' : '' ); ?>">General</a>
                <a href="<?php echo esc_attr( $link ) . 'second' ?>" class="nav-tab <?php echo esc_html( ( $tab == 'second' || !isset( $tab ) ) ? 'nav-tab-active' : '' ); ?>">Second</a>
            </h2>

            <?php
            switch ($tab) {
                case "general":
                    $object = new DT_Porch_Template_Landing_Tab_General();
                    $object->content();
                    break;
                case "second":
                    $object = new DT_Porch_Template_Landing_Tab_Second();
                    $object->content();
                    break;
                default:
                    break;
            }
            ?>

        </div><!-- End wrap -->

        <?php
    }
}
DT_Porch_Template_Landing_Menu::instance();


/**
 * Class DT_Porch_Template_Tab_General
 */
class DT_Porch_Template_Landing_Tab_General {
    public function content() {
        ?>
        <div class="wrap">
            <div id="poststuff">
                <div id="post-body" class="metabox-holder columns-2">
                    <div id="post-body-content">
                        <!-- Main Column -->

                        <?php $this->main_column() ?>

                        <!-- End Main Column -->
                    </div><!-- end post-body-content -->
                    <div id="postbox-container-1" class="postbox-container">
                        <!-- Right Column -->

                        <?php $this->right_column() ?>

                        <!-- End Right Column -->
                    </div><!-- postbox-container 1 -->
                    <div id="postbox-container-2" class="postbox-container">
                    </div><!-- postbox-container 2 -->
                </div><!-- post-body meta box container -->
            </div><!--poststuff end -->
        </div><!-- wrap end -->
        <?php
    }

    public function main_column() {

        if ( isset( $_POST['landing_home'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['landing_home'] ) ), 'landing_home'. get_current_user_id() ) && isset( $_POST['selected_home_page'] ) ) {
            dt_write_log( $_POST );
            $id = sanitize_text_field( wp_unslash( $_POST['selected_home_page'] ) );
            update_option( 'dt_porch_landing_page', $id, true );
        }

        $selected = get_option( 'dt_porch_landing_page' );
        $list = get_posts( [ 'post_type' => 'landing', 'post_status' => 'published', 'numberposts' => -1, 'orderby' => 'post_title', 'order' => 'ASC' ] );
        ?>
        <!-- Box -->
        <form method="post">
            <?php wp_nonce_field( 'landing_home'. get_current_user_id(), 'landing_home' ) ?>
        <table class="widefat striped">
            <thead>
                <tr>
                    <th>Home Page</th>
                </tr>
            </thead>
            <tbody>

            <tr>
                <td>
                    <select name="selected_home_page">
                        <option></option>
                        <?php
                        if ( ! empty( $list ) ) {
                            foreach ( $list as $post_object ) {

                                if ( $selected == $post_object->ID ) {
                                    ?>
                                    <option value="<?php echo esc_attr( $post_object->ID ) ?>" selected><?php echo esc_html( $post_object->post_title ) ?></option>
                                    <?php
                                } else {
                                    ?>
                                    <option value="<?php echo esc_attr( $post_object->ID ) ?>"><?php echo esc_html( $post_object->post_title ) ?></option>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </select>

                    <button type="submit" class="button">Update</button>
                </td>
            </tr>
            </tbody>
        </table>
        </form>
        <br>
        <!-- End Box -->
        <?php
    }

    public function right_column() {
        ?>
        <!-- Box -->
        <table class="widefat striped">
            <thead>
                <tr>
                    <th>Information</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    Content
                </td>
            </tr>
            </tbody>
        </table>
        <br>
        <!-- End Box -->
        <?php
    }
}


/**
 * Class DT_Porch_Template_Tab_Second
 */
class DT_Porch_Template_Landing_Tab_Second {
    public function content() {
        ?>
        <div class="wrap">
            <div id="poststuff">
                <div id="post-body" class="metabox-holder columns-2">
                    <div id="post-body-content">
                        <!-- Main Column -->

                        <?php $this->main_column() ?>

                        <!-- End Main Column -->
                    </div><!-- end post-body-content -->
                    <div id="postbox-container-1" class="postbox-container">
                        <!-- Right Column -->

                        <?php $this->right_column() ?>

                        <!-- End Right Column -->
                    </div><!-- postbox-container 1 -->
                    <div id="postbox-container-2" class="postbox-container">
                    </div><!-- postbox-container 2 -->
                </div><!-- post-body meta box container -->
            </div><!--poststuff end -->
        </div><!-- wrap end -->
        <?php
    }

    public function main_column() {
        ?>
        <!-- Box -->
        <table class="widefat striped">
            <thead>
                <tr>
                    <th>Header</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        Content
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <!-- End Box -->
        <?php
    }

    public function right_column() {
        ?>
        <!-- Box -->
        <table class="widefat striped">
            <thead>
                <tr>
                    <th>Information</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    Content
                </td>
            </tr>
            </tbody>
        </table>
        <br>
        <!-- End Box -->
        <?php
    }
}

