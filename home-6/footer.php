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
            'add' => __( 'Add Magic', 'disciple-tools-porch-template' ),
        ],
    ]) ?>][0]

    document.body.id = "page-top"
</script>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="<?php echo esc_url( trailingslashit( plugin_dir_url( __FILE__ ) ) ) ?>js/scripts.js"></script>
