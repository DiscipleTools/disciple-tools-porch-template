
<!-- CSS
================================================== -->
<link rel="stylesheet" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __FILE__ ) ) ) ?>css/base.css">
<link rel="stylesheet" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __FILE__ ) ) ) ?>css/vendor.css">
<link rel="stylesheet" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __FILE__ ) ) ) ?>css/main.css">

<!-- script
================================================== -->
<script src="<?php echo esc_url( trailingslashit( plugin_dir_url( __FILE__ ) ) ) ?>js/modernizr.js"></script>
<script src="<?php echo esc_url( trailingslashit( plugin_dir_url( __FILE__ ) ) ) ?>js/pace.min.js"></script>

<!-- favicons
================================================== -->
<link rel="shortcut icon" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __FILE__ ) ) ) ?>images/favicon.png" type="image/x-icon">
<link rel="icon" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __FILE__ ) ) ) ?>images/favicon.png" type="image/x-icon">
<script>
    let jsObject = [<?php echo json_encode([
        'theme_uri' => trailingslashit( get_stylesheet_directory_uri() ),
        'root' => esc_url_raw( rest_url() ),
        'nonce' => wp_create_nonce( 'wp_rest' ),
        'parts' => [
            'root' => $this->root,
            'type' => $this->type,
        ],
    ]) ?>][0]
</script>

<style>
    #contact-email {display:none;}
    #newsletter-email {display:none;}
    .form-error {
        display:none;
    }
    .input-label {
        font-family: sans-serif;
        font-size: 1.4rem;
        font-weight: normal;
        color: white;
        display: block;
    }

    input.input-text {
        display: block;
        padding: .5rem;
        border: 0;
        background-color: white;
        outline: none;
        color: #151515;
        font-family: metropolis-semibold, sans-serif;
        font-size: 1.5rem;
        line-height: 3rem;
        width: 50% !important;
        max-width: 100%;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }

    textarea.input-text {
        display: block;
        padding: .5rem;
        border: 0;
        background-color: white;
        outline: none;
        color: #151515;
        font-family: metropolis-semibold, sans-serif;
        font-size: 1.5rem;
        line-height: 3rem;
        width: 50% !important;
        max-width: 100%;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }

    body {
        background-color: rgb(17, 17, 17) !important;
    }

    .form-error {
        color: red;
    }

    /* begin spinner */
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
    .loading-spinner.active {
        border-radius: 50%;
        width: 24px;
        height: 24px;
        border: 0.25rem solid #919191;
        border-top-color: black;
        animation: spin 1s infinite linear;
        display: inline-block;
    }
    /* end spinner */

    .section {
        padding-top: 10px;
    }
</style>
