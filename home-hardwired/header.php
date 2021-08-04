<?php
//$content = DT_Porch_Template_Home_1_Storage::get_settings();
?>


<!-- mobile specific metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1">

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
<script>
    jQuery(document).ready(function(){
        // This is a form delay to discourage robots
        let counter = 5;
        let myInterval = setInterval(function () {
            let button = jQuery('.submit-button')

            button.html( 'Available in ' + counter)
            --counter;

            if ( counter === 0 ) {
                clearInterval(myInterval);
                button.html( 'Submit' ).prop('disabled', false)
            }

        }, 1000);

        /* NEWSLETTER */
        let submit_button_newsletter = jQuery('#submit-button-newsletter')
        submit_button_newsletter.on('click', function(){
            let spinner = jQuery('.loading-spinner')
            spinner.addClass('active')
            submit_button_newsletter.prop('disabled', true)

            let honey = jQuery('#email').val()
            if ( honey ) {
                submit_button_newsletter.html('Shame, shame, shame. We know your name ... ROBOT!').prop('disabled', true )
                spinner.removeClass('active')
                return;
            }

            let fname_input = jQuery('#newsletter-fname')
            let fname = fname_input.val()
            if ( ! fname ) {
                jQuery('#name-error').show()
                submit_button_newsletter.removeClass('loading')
                fname_input.focus(function(){
                    jQuery('#name-error').hide()
                })
                submit_button_newsletter.prop('disabled', false)
                spinner.removeClass('active')
                return;
            }

            let lname_input = jQuery('#newsletter-lname')
            let lname = fname_input.val()
            if ( ! fname ) {
                jQuery('#name-error').show()
                submit_button_newsletter.removeClass('loading')
                lname_input.focus(function(){
                    jQuery('#name-error').hide()
                })
                submit_button_newsletter.prop('disabled', false)
                spinner.removeClass('active')
                return;
            }

            let email_input = jQuery('#newsletter-e2')
            let email = email_input.val()
            if ( ! email ) {
                jQuery('#email-error').show()
                submit_button_newsletter.removeClass('loading')
                email_input.focus(function(){
                    jQuery('#email-error').hide()
                })
                submit_button_newsletter.prop('disabled', false)
                spinner.removeClass('active')
                return;
            }

            let form_data = {
                fname: fname,
                lname: lname,
                email: email,
                permission: permission
            }

            jQuery.ajax({
                type: "POST",
                data: JSON.stringify({ action: 'newsletter', parts: jsObject.parts, data: form_data }),
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                url: jsObject.root + jsObject.parts.root + '/v1/' + jsObject.parts.type,
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-WP-Nonce', jsObject.nonce )
                }
            })
                .done(function(response){
                    jQuery('.loading-spinner').removeClass('active')
                    console.log(response)

                })
                .fail(function(e) {
                    console.log(e)
                    jQuery('#error').html(e)
                })
        })

        /* CONTACT FORM */
        let submit_button_contact = jQuery('#submit-button-contact')
        submit_button_contact.on('click', function(){
            let spinner = jQuery('.loading-spinner')
            spinner.addClass('active')
            submit_button_contact.prop('disabled', true)

            let honey = jQuery('#contact-email').val()
            if ( honey ) {
                submit_button_contact.html('Shame, shame, shame. We know your name ... ROBOT!').prop('disabled', true )
                spinner.removeClass('active')
                return;
            }

            let name_input = jQuery('#contact-name')
            let name = name_input.val()
            if ( ! name ) {
                jQuery('#name-error').show()
                submit_button_contact.removeClass('loading')
                name_input.focus(function(){
                    jQuery('#name-error').hide()
                })
                submit_button_contact.prop('disabled', false)
                spinner.removeClass('active')
                return;
            }

            let email_input = jQuery('#contact-e2')
            let email = email_input.val()
            if ( ! email ) {
                jQuery('#email-error').show()
                submit_button_contact.removeClass('loading')
                email_input.focus(function(){
                    jQuery('#email-error').hide()
                })
                submit_button_contact.prop('disabled', false)
                spinner.removeClass('active')
                return;
            }

            let phone_input = jQuery('#contact-phone')
            let phone = phone_input.val()
            if ( ! phone ) {
                jQuery('#phone-error').show()
                submit_button_contact.removeClass('loading')
                email_input.focus(function(){
                    jQuery('#phone-error').hide()
                })
                submit_button_contact.prop('disabled', false)
                spinner.removeClass('active')
                return;
            }

            let comment = jQuery('#contact-comment').html()

            let form_data = {
                name: name,
                email: email,
                phone: phone,
                comment: comment
            }

            jQuery.ajax({
                type: "POST",
                data: JSON.stringify({ action: 'followup', parts: jsObject.parts, data: form_data }),
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                url: jsObject.root + jsObject.parts.root + '/v1/' + jsObject.parts.type,
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-WP-Nonce', jsObject.nonce )
                }
            })
                .done(function(response){
                    jQuery('.loading-spinner').removeClass('active')
                    console.log(response)

                })
                .fail(function(e) {
                    console.log(e)
                    jQuery('#error').html(e)
                })
        })

    })
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
