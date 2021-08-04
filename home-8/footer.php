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
    document.body.id = 'fullsingle'

    jQuery(document).ready(function(){
        jQuery('body').addClass('page-template-page-fullsingle-me')
    })
</script>