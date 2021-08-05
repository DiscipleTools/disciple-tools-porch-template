<?php
/**
 * Post Type Template
 */

if ( !defined( 'ABSPATH' )) {
    exit;
} // Exit if accessed directly.


/**
 * DT_Porch_Template_Landing_Post_Type Class
 * All functionality pertaining to project update post types in DT_Porch_Template_Landing_Post_Type.
 *
 * @package  Disciple_Tools
 * @since    0.1.0
 */
class DT_Porch_Template_Landing_Post_Type
{

    public $post_type;
    public $singular;
    public $plural;
    public $args;
    public $taxonomies;
    private static $_instance = null;
    public static function instance() {
        if (is_null( self::$_instance )) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Disciple_Tools_Prayer_Post_Type constructor.
     *
     * @param string $post_type
     * @param string $singular
     * @param string $plural
     * @param array $args
     * @param array $taxonomies
     */
    public function __construct( $post_type = 'landing', $singular = 'Landing Page', $plural = 'Landing Pages', $args = [], $taxonomies = []) {
        $this->post_type = $post_type;
        $this->singular = $singular;
        $this->plural = $plural;
        $this->args = $args;
        $this->taxonomies = $taxonomies;

        add_action( 'init', [ $this, 'register_post_type' ] );
        add_action( 'transition_post_status', [ $this, 'transition_post' ], 10, 3 );

        if ( is_admin() ){
            add_filter( 'manage_'.$this->post_type.'_posts_columns', [ $this, 'set_custom_edit_columns' ] );
            add_action( 'manage_'.$this->post_type.'_posts_custom_column', [ $this, 'custom_column' ], 10, 2 );
        }

    } // End __construct()

    /**
     * Register the post type.
     *
     * @access public
     * @return void
     */
    public function register_post_type() {
        register_post_type($this->post_type, /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
            // let's now add all the options for this post type
            array(
                'labels' => array(
                    'name' => $this->plural, /* This is the Title of the Group */
                    'singular_name' => $this->singular, /* This is the individual type */
                    'all_items' => 'All '.$this->plural, /* the all items menu item */
                    'add_new' => 'Add New', /* The add new menu item */
                    'add_new_item' => 'Add New '.$this->singular, /* Add New Display Title */
                    'edit' => 'Edit', /* Edit Dialog */
                    'edit_item' => 'Edit '.$this->singular, /* Edit Display Title */
                    'new_item' => 'New '.$this->singular, /* New Display Title */
                    'view_item' => 'View '.$this->singular, /* View Display Title */
                    'search_items' => 'Search '.$this->plural, /* Search Custom Type Title */
                    'not_found' => 'Nothing found in the Database.', /* This displays if there are no entries yet */
                    'not_found_in_trash' => 'Nothing found in Trash', /* This displays if there is nothing in the trash */
                    'parent_item_colon' => ''
                ), /* end of arrays */
                'description' => $this->singular, /* Custom Type Description */
                'public' => true,
                'publicly_queryable' => false,
                'exclude_from_search' => true,
                'show_ui' => true,
                'query_var' => false,
                'show_in_nav_menus' => true,
                'menu_position' => 5, /* this is what order you want it to appear in on the left hand side menu */
                'menu_icon' => 'dashicons-book', /* the icon for the custom post type menu. uses built-in dashicons (CSS class name) */
                'rewrite' => false, /* you can specify its url slug */
                'has_archive' => false, /* you can rename the slug here */
                'capabilities' => [
                    'create_posts'        => 'create_'.$this->post_type,
                    'edit_post'           => 'edit_'.$this->post_type, // needed for bulk edit
                    'read_post'           => 'read_'.$this->post_type,
                    'delete_post'         => 'delete_'.$this->post_type, // delete individual post
                    'delete_others_posts' => 'delete_others_'.$this->post_type.'s',
                    'delete_posts'        => 'delete_'.$this->post_type.'s', // bulk delete posts
                    'edit_posts'          => 'edit'.$this->post_type.'s', //menu link in WP Admin
                    'edit_others_posts'   => 'edit_others_'.$this->post_type.'s',
                    'publish_posts'       => 'publish_'.$this->post_type.'s',
                    'read_private_posts'  => 'read_private_'.$this->post_type.'s',
                ],
                'capability_type' => $this->post_type,
                'hierarchical' => true,
                'show_in_rest' => true,
                'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' )
            ) /* end of options */
        ); /* end of register post type */
    } // End register_post_type()


    public function transition_post( $new_status, $old_status, $post ) {
        if ( 'publish' == $new_status && $post->post_type == 'landing' ) {

            $post_id = $post->ID;
            $slug = trim( strtolower( $post->post_title ) );
            $slug = str_replace( ' ', '-', $slug );
            $slug = str_replace( '"', '', $slug );
            $slug = str_replace( '&', '', $slug );
            $slug = str_replace( "'", '', $slug );
            $slug = str_replace( ",", '', $slug );
            $slug = str_replace( ":", '', $slug );
            $slug = str_replace( ";", '', $slug );
            $slug = str_replace( ".", '', $slug );
            $slug = str_replace( "/", '', $slug );
            $slug = urlencode( $slug );

            $current_public_key = get_post_meta( $post_id, 'l_p_magic_key', true );
            if ( $slug !== $current_public_key ) {
                update_post_meta( $post_id, 'l_p_magic_key', $slug );
                global $wpdb;
                $wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET guid = %s WHERE ID = %s;", trailingslashit( site_url() ) . 'l/p/' . $slug, $post_id ) );
            }
        }
    }

    // Add the custom columns to the book post type:

    function set_custom_edit_columns( $columns) {
        unset( $columns['author'] );
        $columns['url'] = 'URL';

        return $columns;
    }

// Add the data to the custom columns for the book post type:

    function custom_column( $column, $post_id ) {
        switch ( $column ) {
            case 'url' :
                $public_key = get_post_meta( $post_id, 'l_p_magic_key', true );
                echo '<a href="' . trailingslashit( site_url() ) . 'l/p/' . $public_key . '">'. trailingslashit( site_url() ) . 'l/p/' . $public_key .'</a>';
                break;

        }
    }
} // End Class
DT_Porch_Template_Landing_Post_Type::instance();
