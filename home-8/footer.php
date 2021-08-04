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

    /* Add needed classes to body tag */
    document.body.id = 'fullsingle'
    jQuery(document).ready(function(){
        jQuery('body').addClass('page-template-page-fullsingle-me').addClass('me-video')
    })
    jQuery('.fs-me').width('100%').height(window.innerHeight)
</script>
