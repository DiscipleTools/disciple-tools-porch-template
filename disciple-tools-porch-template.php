<?php
/**
 * Plugin Name: Disciple Tools - Porch Template
 * Plugin URI: https://github.com/DiscipleTools/disciple-tools-porch-template
 * Description: This front porch facilitates the open source location grid public site.
 * Text Domain: disciple-tools-porch-template
 * Domain Path: /languages
 * Version:  0.1
 * Author URI: https://github.com/DiscipleTools
 * GitHub Plugin URI: https://github.com/DiscipleTools/disciple-tools-porch-template
 * Requires at least: 4.7.0
 * (Requires 4.7+ because of the integration of the REST API at 4.7 and the security requirements of this milestone version.)
 * Tested up to: 5.6
 *
 * @package Disciple_Tools
 * @link    https://github.com/DiscipleTools
 * @license GPL-2.0 or later
 *          https://www.gnu.org/licenses/gpl-2.0.html
 */

/***********************************************************************************************************************
/***********************************************************************************************************************
 * REFACTOR THIS PLUGIN!
 * This entire template plugin can be converted to your project by finding and replacing the follow strings throughout
 * the plugin folder. Accomplish the @todo tasks below.
 *
 * (full url of your github repo location)
 * @example https://github.com/YourGithubAccount/your-project-name
 * (user account and repo name on Github)
 * @example ACCOUNT-REPO-SLUG = YourGithubAccount/your-project-name
 * (repo name of your project on Github)
 * @example REPO-SLUG = your-project-name
 *
 * @todo Rename file name in the root folder called [ disciple-tools-porch-template.php ] to your repo slug name, i.e. [ REPO-SLUG ].php.
 *
 * @todo find/replace string [ DiscipleTools/disciple-tools-porch-template ] with your [ ACCOUNT-REPO-SLUG ]
 *
 * Find and Replace the following strings with your custom strings.
 * @todo find/replace string [ Porch Template ] with [ Your Project Name ]
 * @todo find/replace string [ Disciple_Tools_Porch_Template ] with [ Your_Project_Name ]
 * @todo find/replace string [ disciple-tools-porch-template ] with [ your-project-name ]
 * @todo find/replace string [ dt_porch_template ] with [ your_project_name ]
***********************************************************************************************************************/


if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Gets the instance of the `DT_Porch_Template` class.
 *
 * @since  0.1
 * @access public
 * @return object|bool
 */
function dt_porch_template() {
    $dt_porch_template_required_dt_theme_version = '1.8.1';
    $wp_theme = wp_get_theme();
    $version = $wp_theme->version;

    /*
     * Check if the Disciple.Tools theme is loaded and is the latest required version
     */
    $is_theme_dt = strpos( $wp_theme->get_template(), "disciple-tools-theme" ) !== false || $wp_theme->name === "Disciple Tools";
    if ( $is_theme_dt && version_compare( $version, $dt_porch_template_required_dt_theme_version, "<" ) ) {
        add_action( 'admin_notices', 'dt_porch_template_hook_admin_notice' );
        add_action( 'wp_ajax_dismissed_notice_handler', 'dt_hook_ajax_notice_handler' );
        return false;
    }
    if ( !$is_theme_dt ){
        return false;
    }
    /**
     * Load useful function from the theme
     */
    if ( !defined( 'DT_FUNCTIONS_READY' ) ){
        require_once get_template_directory() . '/dt-core/global-functions.php';
    }

    return DT_Porch_Template::instance();
}
add_action( 'after_setup_theme', 'dt_porch_template', 20 );

/**
 * Singleton class for setting up the plugin.
 *
 * @since  0.1
 * @access public
 */
class DT_Porch_Template {

    private static $_instance = null;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct() {

        /***************************************************************************************************************
        /***************************************************************************************************************
         * @todo STEP 1: CHOOSE HOME PAGE STYLE
         * 8 starter sites are listed below. Uncomment the loader file to show the site style. Choose only 1 at a time.
         *
         * @todo STEP 2: ONCE A STYLE IS SELECTED, REMOVE ADDITIONAL LINES AND DELETE CORRESPONDING FOLDERS
         * @todo STEP 3: EDIT THE BODY CONTENT OF THE SELECTED STYLE IN THE `body.php` file.
         **************************************************************************************************************/
//        require_once( 'home-1/loader.php'); /* Pray4Movement */
//        require_once( 'home-2/loader.php' ); /* Simple, Big images, White and Image */
//        require_once( 'home-3/loader.php'); /* Parallax, White/Green, thin sections, sticky top nav */
        require_once( 'home-4/loader.php' ); /* Large sections, white/light blue, */
//        require_once( 'home-5/loader.php'); /* White/blue/grey, big sections, hover effects/animations */
//        require_once( 'home-6/loader.php'); /* greeen/white, simple, bold */
//        require_once( 'home-7/loader.php');
//        require_once( 'home-8/loader.php'); /* single image, full screen */



        /***************************************************************************************************************
        /***************************************************************************************************************
         * @todo ADDITIONAL STEP: SELECT LOGGED IN PAGE STYLE
         * This page style allows a person to register to the site, and get a custom profile page, without giving
         * them access to disciple tools. This page is recommended to be used with the custom login plugin so that
         * a registered role can be applied.
         *
         * @use Use this to give a partner a dashboard on the project without giving them access to the entire DT system.
         * @use Allows you to collect data from a user without giving them full Disciple Tools access.
         *
         * Remove all of these if a logged in page is not required.
         **************************************************************************************************************/
        require_once( 'logged-in-1/loader.php' );


        /***************************************************************************************************************
        /***************************************************************************************************************
         * @todo ADDITIONAL STEP: CONFIGURE REQUIRED PLUGINS
         * The `config-required-plugins.php` file triggers a recommendation in the admin area to also require other plugins
         * when this plugin is enabled. One key plugin is the `disciple-tools-custom-login' plugin to help with the
         * logged in user experience.
         **************************************************************************************************************/
        if ( is_admin() ) {
            require_once( 'support/required-plugins/class-tgm-plugin-activation.php' );
            require_once( 'support/required-plugins/config-required-plugins.php' );
        }


        if ( is_admin() ){
            add_filter( 'plugin_row_meta', [ $this, 'plugin_description_links' ], 10, 4 ); // admin plugin page description
        }
        $this->i18n();
    }

    /**
     * Filters the array of row meta for each/specific plugin in the Plugins list table.
     * Appends additional links below each/specific plugin on the plugins page.
     */
    public function plugin_description_links( $links_array, $plugin_file_name, $plugin_data, $status ) {
        if ( strpos( $plugin_file_name, basename( __FILE__ ) ) ) {

            // You can still use `array_unshift()` to add links at the beginning.
            $links_array[] = '<a href="https://disciple.tools">Disciple.Tools Community</a>'; // @todo replace with your links.
        }

        return $links_array;
    }

    /**
     * Method that runs only when the plugin is activated.
     *
     * @since  0.1
     * @access public
     * @return void
     */
    public static function activation() {
        // add elements here that need to fire on activation
    }

    /**
     * Method that runs only when the plugin is deactivated.
     *
     * @since  0.1
     * @access public
     * @return void
     */
    public static function deactivation() {
        // add functions here that need to happen on deactivation
    }

    /**
     * Loads the translation files.
     *
     * @since  0.1
     * @access public
     * @return void
     */
    public function i18n() {
        $domain = 'disciple-tools-porch-template';
        load_plugin_textdomain( $domain, false, trailingslashit( dirname( plugin_basename( __FILE__ ) ) ). 'support/languages' );
    }

    /**
     * Magic method to output a string if trying to use the object as a string.
     *
     * @since  0.1
     * @access public
     * @return string
     */
    public function __toString() {
        return 'disciple-tools-porch-template';
    }

    /**
     * Magic method to keep the object from being cloned.
     *
     * @since  0.1
     * @access public
     * @return void
     */
    public function __clone() {
        _doing_it_wrong( __FUNCTION__, 'Whoah, partner!', '0.1' );
    }

    /**
     * Magic method to keep the object from being unserialized.
     *
     * @since  0.1
     * @access public
     * @return void
     */
    public function __wakeup() {
        _doing_it_wrong( __FUNCTION__, 'Whoah, partner!', '0.1' );
    }

    /**
     * Magic method to prevent a fatal error when calling a method that doesn't exist.
     *
     * @param string $method
     * @param array $args
     * @return null
     * @since  0.1
     * @access public
     */
    public function __call( $method = '', $args = array() ) {
        _doing_it_wrong( "dt_porch_template::" . esc_html( $method ), 'Method does not exist.', '0.1' );
        unset( $method, $args );
        return null;
    }
}


// Register activation hook.
register_activation_hook( __FILE__, [ 'DT_Porch_Template', 'activation' ] );
register_deactivation_hook( __FILE__, [ 'DT_Porch_Template', 'deactivation' ] );


if ( ! function_exists( 'dt_porch_template_hook_admin_notice' ) ) {
    function dt_porch_template_hook_admin_notice() {
        global $dt_porch_template_required_dt_theme_version;
        $wp_theme = wp_get_theme();
        $current_version = $wp_theme->version;
        $message = "'Disciple Tools - Porch Template' plugin requires 'Disciple Tools' theme to work. Please activate 'Disciple Tools' theme or make sure it is latest version.";
        if ( $wp_theme->get_template() === "disciple-tools-theme" ){
            $message .= ' ' . sprintf( esc_html( 'Current Disciple Tools version: %1$s, required version: %2$s' ), esc_html( $current_version ), esc_html( $dt_porch_template_required_dt_theme_version ) );
        }
        // Check if it's been dismissed...
        if ( ! get_option( 'dismissed-disciple-tools-porch-template', false ) ) { ?>
            <div class="notice notice-error notice-disciple-tools-porch-template is-dismissible" data-notice="disciple-tools-porch-template">
                <p><?php echo esc_html( $message );?></p>
            </div>
            <script>
                jQuery(function($) {
                    $( document ).on( 'click', '.notice-disciple-tools-porch-template .notice-dismiss', function () {
                        $.ajax( ajaxurl, {
                            type: 'POST',
                            data: {
                                action: 'dismissed_notice_handler',
                                type: 'disciple-tools-porch-template',
                                security: '<?php echo esc_html( wp_create_nonce( 'wp_rest_dismiss' ) ) ?>'
                            }
                        })
                    });
                });
            </script>
        <?php }
    }
}

/**
 * AJAX handler to store the state of dismissible notices.
 */
if ( ! function_exists( "dt_hook_ajax_notice_handler" )){
    function dt_hook_ajax_notice_handler(){
        check_ajax_referer( 'wp_rest_dismiss', 'security' );
        if ( isset( $_POST["type"] ) ){
            $type = sanitize_text_field( wp_unslash( $_POST["type"] ) );
            update_option( 'dismissed-' . $type, true );
        }
    }
}

/**
 * Plugin Releases and updates
 * @todo Uncomment and change the url if you want to support remote plugin updating with new versions of your plugin
 * To remove: delete the section of code below and delete the file called version-control.json in the plugin root
 *
 * This section runs the remote plugin updating service, so you can issue distributed updates to your plugin
 *
 * @note See the instructions for version updating to understand the steps involved.
 * @link https://github.com/DiscipleTools/disciple-tools-porch-template/wiki/Configuring-Remote-Updating-System
 *
 * @todo Enable this section with your own hosted file
 * @todo An example of this file can be found in (version-control.json)
 * @todo Github is a good option for delivering static json.
 */
/**
 * Check for plugin updates even when the active theme is not Disciple.Tools
 *
 * Below is the publicly hosted .json file that carries the version information. This file can be hosted
 * anywhere as long as it is publicly accessible. You can download the version file listed below and use it as
 * a template.
 * Also, see the instructions for version updating to understand the steps involved.
 * @see https://github.com/DiscipleTools/disciple-tools-version-control/wiki/How-to-Update-the-Starter-Plugin
 */
//add_action( 'plugins_loaded', function (){
//    if ( is_admin() ){
//        // Check for plugin updates
//        if ( ! class_exists( 'Puc_v4_Factory' ) ) {
//            if ( file_exists( get_template_directory() . '/dt-core/libraries/plugin-update-checker/plugin-update-checker.php' )){
//                require( get_template_directory() . '/dt-core/libraries/plugin-update-checker/plugin-update-checker.php' );
//            }
//        }
//        if ( class_exists( 'Puc_v4_Factory' ) ){
//            Puc_v4_Factory::buildUpdateChecker(
//                'https://raw.githubusercontent.com/DiscipleTools/disciple-tools-porch-template/master/version-control.json',
//                __FILE__,
//                'disciple-tools-porch-template'
//            );
//
//        }
//    }
//} );



