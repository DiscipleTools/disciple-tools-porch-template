<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

class Disciple_Tools_Porch_Template_Home extends DT_Magic_Url_Base
{
    public $magic = false;
    public $parts = false;
    public $page_title = 'Home';
    public $root = "porch_app";
    public $type = 'home';

    private static $_instance = null;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    } // End instance()

    public function __construct() {
        parent::__construct();

        $url = dt_get_url_path();
        if ( empty( $url ) && ! dt_is_rest() ) {

            /**
             * Section loads a number of actions/filters that Magic Link Base fails to load
             * because the home page is a non-standard root use of magic link. The parsing tests of
             * the url fail, but are re-added here.
             */



            // register url and access
            add_action( "template_redirect", [ $this, 'theme_redirect' ] );
            add_filter( 'dt_blank_access', function (){ return true;}, 100, 1 ); // allows non-logged in visit
            add_filter( 'dt_allow_non_login_access', function (){ return true; }, 100, 1 );

            // header content
            add_filter( "dt_blank_title", [ $this, "page_tab_title" ] ); // adds basic title to browser tab
            add_action( 'wp_print_scripts', [ $this, 'print_scripts' ], 1500 ); // authorizes scripts
            add_action( 'wp_print_styles', [ $this, 'print_styles' ], 1500 ); // authorizes styles


            // page content
            add_action( 'dt_blank_head', [ $this, '_header' ] );
            add_action( 'dt_blank_footer', [ $this, '_footer' ] );
            add_action( 'dt_blank_body', [ $this, 'body' ] ); // body for no post key

            require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'framework/enqueue.php');
            add_filter( 'dt_magic_url_base_allowed_css', [ $this, 'dt_magic_url_base_allowed_css'], 10, 1 );
            add_filter( 'dt_magic_url_base_allowed_js', [ $this, 'dt_magic_url_base_allowed_js'], 10, 1 );
            add_action( 'wp_enqueue_scripts', [ $this, 'wp_enqueue_scripts' ], 99 );
        }
    }

    public function dt_magic_url_base_allowed_js( $allowed_js ) {
        return Disciple_Tools_Porch_Template_Enqueue::load_allowed_scripts();
    }

    public function dt_magic_url_base_allowed_css( $allowed_css ) {
        return Disciple_Tools_Porch_Template_Enqueue::load_allowed_styles();
    }

    public function wp_enqueue_scripts() {
        Disciple_Tools_Porch_Template_Enqueue::load_scripts();
    }

    public function theme_redirect() {
        $path = get_theme_file_path( 'template-blank.php' );
        include( $path );
        die();
    }

    public function body(){
        // nav
        require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'framework/nav.php');
        // body
        $my_postid = get_option('dt_porch_landing_page');
        $post_status = get_post_status( $my_postid );
        if ( 'publish' === $post_status ) {
            $content_post = get_post($my_postid);
            $content = $content_post->post_content;
            $content = apply_filters('the_content', $content);
            $content = str_replace(']]>', ']]&gt;', $content);
            echo $content;
        }
    }

    public function footer_javascript(){
        ?>
        <script>
            let jsObject = [<?php echo json_encode([
                'map_key' => DT_Mapbox_API::get_key(),
                'root' => esc_url_raw( rest_url() ),
                'nonce' => wp_create_nonce( 'wp_rest' ),
                'parts' => $this->parts,
                'translations' => [
                    'add' => __( 'Add Magic', 'disciple_tools' ),
                ],
            ]) ?>][0]

            jQuery(document).ready(function(){
                clearInterval(window.fiveMinuteTimer)
                jQuery(document).foundation(); /* important. required when not loading site-js */
            })
        </script>
        <?php
        return true;
    }


}
Disciple_Tools_Porch_Template_Home::instance();
