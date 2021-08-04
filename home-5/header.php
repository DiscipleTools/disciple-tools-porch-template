<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>css/line-icons.css">
<link rel="stylesheet" href="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>css/owl.carousel.css">
<link rel="stylesheet" href="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>css/owl.theme.css">
<link rel="stylesheet" href="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>css/nivo-lightbox.css">
<link rel="stylesheet" href="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>css/magnific-popup.css">
<link rel="stylesheet" href="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>css/animate.css">
<link rel="stylesheet" href="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>css/menu_sideslide.css">
<link rel="stylesheet" href="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>css/main.css">
<link rel="stylesheet" href="<?php echo trailingslashit( esc_url( plugin_dir_url( __FILE__ ) ) ) ?>css/responsive.css">
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
</script>