<?php

class Pray4Movement_Site_Porch_Admin {
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

        add_filter( 'dt_remove_menu_pages', [ $this, 'add_media_tab' ], 10, 1 );
        add_filter('upload_mimes', [ $this, 'add_additional_mime_types' ], 1, 1);

        if ( '/wp-admin/upload.php' === $_SERVER['REQUEST_URI'] ) {
            $this->p4m_add_media_page_warning();
        }

        add_action( 'admin_menu', [ $this, 'admin_menu' ] );
    }

    public function add_media_tab( $list ) {
        if ( isset( $list['media'] ) ) {
            unset( $list['media'] );
        }
        return $list;
    }
    public function add_additional_mime_types($mime_types){
        $mime_types['svg'] = 'image/svg+xml'; //Adding svg extension
        $mime_types['psd'] = 'image/vnd.adobe.photoshop'; //Adding photoshop files
        $mime_types['pdf'] = 'application/pdf'; //Adding photoshop files
        $mime_types['docx'] = 'application/vnd.openxmlformats-'; //Adding photoshop files
        $mime_types['doc'] = 'application/msword'; //Adding photoshop files
        $mime_types['csv'] = 'text/csv'; //Adding photoshop files
        $mime_types['zip'] = 'application/zip'; //Adding photoshop files
        return $mime_types;
    }

    public function p4m_add_media_page_warning() {
        ?>
        <div class="notice notice-warning is-dismissible">
            <p>SECURITY WARNING: <BR>ALL IMAGES AND MEDIA FILES ADDED HERE ARE PUBLICLY ACCESSIBLE TO THE INTERNET. <BR>DO NOT STORE SENSITIVE FILES!</p>
        </div>
        <?php
    }

    public function admin_menu() {
        add_menu_page( 'Front Porch', 'Front Porch', 'manage_dt', 'landing_page', [ $this, 'landing_admin_page' ], 'dashicons-admin-generic', 70 );
    }

    public function landing_admin_page(){
        $slug = 'landing_page';

        if ( !current_user_can( 'manage_options' ) ) { // manage dt is a permission that is specific to Disciple Tools and allows admins, strategists and dispatchers into the wp-admin
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
            <h2>Pray4Movement Landing Page</h2>
            <h2 class="nav-tab-wrapper">
                <a href="<?php echo esc_attr( $link ) . 'settings' ?>"
                   class="nav-tab <?php echo esc_html( ( $tab == 'settings' || !isset( $tab ) ) ? 'nav-tab-active' : '' ); ?>">Settings
                </a>

            </h2>

            <?php
            switch ($tab) {
                case "settings":
                    $this->settings();
                    break;
                default:
                    break;
            }
            ?>

        </div><!-- End wrap -->
        <?php
    }

    public function settings(){

        $defaults = DT_Posts::get_post_field_settings( 'contacts' );

        $content = get_option('landing_content', [] );
        if ( isset( $_POST['landing_page'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['landing_page'] ) ), 'landing_page'.get_current_user_id() ) ) {

            dt_write_log($_POST);

            if ( isset( $_POST['title'] ) )  {
                $content['title'] = sanitize_text_field( wp_unslash( $_POST['title'] ) );
            }
            if ( isset( $_POST['description'] ) )  {
                $content['description'] = sanitize_text_field( wp_unslash( $_POST['description'] ) );
            }
            if ( isset( $_POST['location'] ) )  {
                $content['location'] = sanitize_text_field( wp_unslash( $_POST['location'] ) );
            }
            if ( isset( $_POST['logo_url'] ) )  {
                $content['logo_url'] = sanitize_text_field( wp_unslash( $_POST['logo_url'] ) );
            }
            if ( isset( $_POST['background_image_url'] ) )  {
                $content['background_image_url'] = sanitize_text_field( wp_unslash( $_POST['background_image_url'] ) );
            }
            if ( isset( $_POST['facebook_url'] ) )  {
                $content['facebook_url'] = sanitize_text_field( wp_unslash( $_POST['facebook_url'] ) );
            }
            if ( isset( $_POST['facebook_events_url'] ) )  {
                $content['facebook_events_url'] = sanitize_text_field( wp_unslash( $_POST['facebook_events_url'] ) );
            }
            if ( isset( $_POST['instagram_url'] ) )  {
                $content['instagram_url'] = sanitize_text_field( wp_unslash( $_POST['instagram_url'] ) );
            }
            if ( isset( $_POST['twitter_url'] ) )  {
                $content['twitter_url'] = sanitize_text_field( wp_unslash( $_POST['twitter_url'] ) );
            }
            if ( isset( $_POST['mailchimp_form_url'] ) )  {
                $content['mailchimp_form_url'] = sanitize_text_field( wp_unslash( $_POST['mailchimp_form_url'] ) );
            }
            if ( isset( $_POST['mailchimp_form_hidden_id'] ) )  {
                $content['mailchimp_form_hidden_id'] = sanitize_text_field( wp_unslash( $_POST['mailchimp_form_hidden_id'] ) );
            }
            if ( isset( $_POST['contact_form'] ) )  {
                $content['contact_form'] = wp_unslash( $_POST['contact_form'] );
            }

            if ( isset( $_POST['samples_section'] ) )  {
                $content['samples_section'] = sanitize_text_field( wp_unslash( $_POST['samples_section'] ) );
            }
            if ( isset( $_POST['stats_population'] ) )  {
                $content['stats_population'] = sanitize_text_field( wp_unslash( $_POST['stats_population'] ) );
            }
            if ( isset( $_POST['stats_cities'] ) )  {
                $content['stats_cities'] = sanitize_text_field( wp_unslash( $_POST['stats_cities'] ) );
            }
            if ( isset( $_POST['stats_trainings'] ) )  {
                $content['stats_trainings'] = sanitize_text_field( wp_unslash( $_POST['stats_trainings'] ) );
            }
            if ( isset( $_POST['stats_churches'] ) )  {
                $content['stats_churches'] = sanitize_text_field( wp_unslash( $_POST['stats_churches'] ) );
            }
            if ( isset( $_POST['google_analytics'] ) )  {
                $content['google_analytics'] = wp_unslash( $_POST['google_analytics'] );
            }

            if ( isset( $_POST['mailchimp_api_key'] ) )  {
                $content['mailchimp_api_key'] = sanitize_text_field( wp_unslash( $_POST['mailchimp_api_key'] ) );
            }
            if ( isset( $_POST['mailchimp_list_id'] ) )  {
                $content['mailchimp_list_id'] = sanitize_text_field( wp_unslash( $_POST['mailchimp_list_id'] ) );
            }
            if ( isset( $_POST['status_for_subscriptions'] ) )  {
                $content['status_for_subscriptions'] = sanitize_text_field( wp_unslash( $_POST['status_for_subscriptions'] ) );
            }
            if ( isset( $_POST['source_for_subscriptions'] ) )  {
                $content['source_for_subscriptions'] = sanitize_text_field( wp_unslash( $_POST['source_for_subscriptions'] ) );
            }
            if ( isset( $_POST['assigned_user_for_followup'] ) )  {
                $content['assigned_user_for_followup'] = sanitize_text_field( wp_unslash( $_POST['assigned_user_for_followup'] ) );
            }

            update_option( 'landing_content', $content, true );
            $content = get_option('landing_content');
        }
        ?>
        <div class="wrap">
            <div id="poststuff">
                <div id="post-body" class="metabox-holder columns-2">
                    <div id="post-body-content">
                        <!-- Main Column -->

                        <!-- Box -->
                        <form method="post">
                            <?php wp_nonce_field('landing_page'.get_current_user_id(), 'landing_page' ) ?>
                            <table class="widefat striped">
                                <thead>
                                <tr>
                                    <th colspan="2">Configuration</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td style="width:150px;">
                                        Title
                                    </td>
                                    <td>
                                        <input type="text" name="title" class="regular-text" value="<?php echo esc_html( $content['title'] ?? '' ) ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:150px;">
                                        Description
                                    </td>
                                    <td>
                                        <input type="text" name="description" class="regular-text" value="<?php echo $content['description'] ?? '' ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:150px;">
                                        Location
                                    </td>
                                    <td>
                                        <input type="text" name="location" class="regular-text" value="<?php echo esc_html( $content['location'] ?? '' ) ?>" /> (i.e. state)
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:150px;">
                                        Logo URL
                                    </td>
                                    <td>
                                        <input type="text" name="logo_url" class="regular-text" value="<?php echo $content['logo_url'] ?? '' ?>" /> (Leave empty to use default logo)
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:150px;">
                                        Background Image URL
                                    </td>
                                    <td>
                                        <input type="text" name="background_image_url" class="regular-text" value="<?php echo $content['background_image_url'] ?? '' ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:150px;">
                                        Facebook URL
                                    </td>
                                    <td>
                                        <input type="text" name="facebook_url" class="regular-text" value="<?php echo $content['facebook_url'] ?? '' ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:150px;">
                                        Facebook Events URL
                                    </td>
                                    <td>
                                        <input type="text" name="facebook_events_url" class="regular-text" value="<?php echo $content['facebook_events_url'] ?? '' ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:150px;">
                                        Instagram URL
                                    </td>
                                    <td>
                                        <input type="text" name="instagram_url" class="regular-text" value="<?php echo $content['instagram_url'] ?? '' ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:150px;">
                                        Twitter URL
                                    </td>
                                    <td>
                                        <input type="text" name="twitter_url" class="regular-text" value="<?php echo $content['twitter_url'] ?? '' ?>" />
                                    </td>
                                </tr>



                                <tr>
                                    <td style="width:150px;">
                                        Population
                                    </td>
                                    <td>
                                        <input type="text" name="stats_population" class="regular-text" value="<?php echo $content['stats_population'] ?? '' ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:150px;">
                                        Cities
                                    </td>
                                    <td>
                                        <input type="text" name="stats_cities" class="regular-text" value="<?php echo $content['stats_cities'] ?? '' ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:150px;">
                                        Trainings Needed
                                    </td>
                                    <td>
                                        <input type="text" name="stats_trainings" class="regular-text" value="<?php echo $content['stats_trainings'] ?? '' ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:150px;">
                                        New Churches Needed
                                    </td>
                                    <td>
                                        <input type="text" name="stats_churches" class="regular-text" value="<?php echo $content['stats_churches'] ?? '' ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:150px;">
                                        Samples Section
                                    </td>
                                    <td>
                                        <select name="samples_section">
                                            <option value="<?php echo $content['samples_section'] ?? '' ?>"><?php echo ucwords( $content['samples_section'] ) ?? '' ?></option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:150px;">
                                        Google Analytics for Header
                                    </td>
                                    <td>
                                        <textarea type="text" name="google_analytics" class="regular-text" ><?php echo $content['google_analytics'] ?? '' ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:150px;">
                                        Mailchimp API Key
                                    </td>
                                    <td>
                                        <input type="text" name="mailchimp_api_key" class="regular-text" value="<?php echo $content['mailchimp_api_key'] ?? '' ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:150px;">
                                        Mailchimp List ID
                                    </td>
                                    <td>
                                        <input type="text" name="mailchimp_list_id" class="regular-text" value="<?php echo $content['mailchimp_list_id'] ?? '' ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:150px;">
                                        Status for Newsletter Subscriptions
                                    </td>
                                    <td>
                                        <select name="status_for_subscriptions" id="status_for_subscriptions">
                                            <?php
                                            foreach ( $defaults['overall_status']['default'] as $index => $item ) {
                                                if ( $content['status_for_subscriptions'] === $index ) {
                                                    ?>
                                                    <option value="<?php echo esc_attr( $index ) ?>" selected ><?php echo esc_html( $item['label'] ) ?></option>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <option value="<?php echo esc_attr( $index ) ?>"><?php echo esc_html( $item['label'] ) ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width:150px;">
                                        Source for Newsletter Subscriptions
                                    </td>
                                    <td>
                                        <select name="source_for_subscriptions" id="source_for_subscriptions">
                                            <?php
                                            foreach ( $defaults['sources']['default'] as $index => $item ) {
                                                if ( $content['source_for_subscriptions'] === $index ) {
                                                    ?>
                                                    <option value="<?php echo esc_attr( $index ) ?>" selected ><?php echo esc_html( $item['label'] ) ?></option>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <option value="<?php echo esc_attr( $index ) ?>"><?php echo esc_html( $item['label'] ) ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:150px;">
                                        Assigned User for Follow-up Leads
                                    </td>
                                    <td>
                                        <?php
                                        $roles = [];
                                        $wp_roles       = wp_roles()->roles;
                                        $selected_value = $content['assigned_user_for_followup'];

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
                                        <select name="assigned_user_for_followup" id="assigned_user_for_followup">
                                            <option disabled>---</option>
                                            <?php foreach ( $potential_user_list as $potential_user ): ?>
                                                <option
                                                    value="<?php echo esc_attr( $potential_user->ID ); ?>" <?php if ( $potential_user->ID == $selected_value || ! $selected_value && $potential_user->ID == $base_user->ID ): ?> selected <?php endif; ?> ><?php echo esc_attr( $potential_user->display_name ); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <button type="submit" class="button">Update</button>
                                    </td>
                                </tr>




                                </tbody>
                            </table>
                            <br>
                            <table class="widefat striped">
                                <thead>
                                <tr>
                                    <th colspan="2">Alternate Confirm</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- Alternate Mailchimp Form-->
                                <tr>
                                    <td style="width:150px;">
                                        Mailchimp Form Override (For GDPR Situations)
                                    </td>
                                    <td>
                                        <textarea type="text" name="contact_form" class="regular-text" ><?php echo $content['contact_form'] ?? '' ?></textarea>
                                    </td>
                                </tr>

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
}
Pray4Movement_Site_Porch_Admin::instance();
