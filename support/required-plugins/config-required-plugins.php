<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly
/**
 * Require plugins with the TGM library.
 *
 * This defines the required and suggested plugins.
 */


/**
 * Include the TGM_Plugin_Activation class. This class makes other plugins required for the Disciple_Tools system.
 * @see https://github.com/TGMPA/TGM-Plugin-Activation
 */


/**
 * Register the required plugins for this theme.
 *
// Example of array options:
//
//        array(
//        'name'               => 'REST API Console', // The plugin name.
//        'slug'               => 'rest-api-console', // The plugin slug (typically the folder name).
//        'source'             => dirname( __FILE__ ) . '/lib/plugins/rest-api-console.zip', // The plugin source.
//        'required'           => true, // If false, the plugin is only 'recommended' instead of required.
//        'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
//        'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
//        'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
//        'external_url'       => '', // If set, overrides default API URL and points to an external URL.
//        'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
//        ),
//
 */
add_action( 'tgmpa_register', function () {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        //array( @todo this points to the Wordpress plugin store.
        //    'name'                  => 'Disciple.Tools - Custom Login',
        //    'slug'                  => 'disciple-tools-custom-login',
        //    'required'              => false,
        //    'version'               => '0.1',
        //),
        array(
            'name'                  => 'Genesis Blocks',
            'slug'                  => 'genesis-blocks',
            'required'              => false,
            'version'               => '1.2.5',
        ),
    );

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'id'           => 'dt_porch_template',                 // Unique ID for hashing notices for multiple instances of TGMPA.
    );

    tgmpa( $plugins, $config );
});
