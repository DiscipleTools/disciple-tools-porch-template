<script src="<?php echo esc_url( trailingslashit( plugin_dir_url( __FILE__ ) ) ) ?>js/plugins.js"></script>
<script src="<?php echo esc_url( trailingslashit( plugin_dir_url( __FILE__ ) ) ) ?>js/main.js"></script>
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
