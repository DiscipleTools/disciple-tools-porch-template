<script src="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>assets/js/jquery.min.js"></script>

<script src="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>assets/js/popper.min.js"></script>
<script src="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>assets/js/slick.min.js"></script>

<script src="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>assets/js/jquery.waypoints.min.js"></script>
<script src="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>assets/js/jquery.easing.1.3.js"></script>

<script src="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>assets/js/main.js"></script>
<script>
    let jsObject = [<?php echo json_encode([
        'theme_uri' => trailingslashit( get_stylesheet_directory_uri() ),
        'root' => esc_url_raw( rest_url() ),
        'nonce' => wp_create_nonce( 'wp_rest' ),
        'parts' => [
            'root' => $this->root,
            'type' => $this->type,
        ],
        'trans' => [
            'add' => __( 'Add Magic', 'disciple_tools' ),
        ],
    ]) ?>][0]

    jQuery(document).ready(function(){
        jQuery('body').data('spy', 'scroll').data('target', '#pb-navbar').data('offset', '200')
    })
</script>