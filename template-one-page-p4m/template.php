<?php

$content = Disciple_Tools_Porch_Template_One_Page_P4M::get_content_array();

?>
<script>
    document.body.id = 'top'
</script>

<!-- header
================================================== -->
<header class="s-header">

    <div class="header-logo">
        <a class="site-logo" href="/">
            <?php echo esc_html( $content['title'] ?? '' ) ?>
        </a>
    </div> <!-- end header-logo -->
    <nav class="header-nav">

        <a href="#0" class="header-nav__close" title="close"><span>Close</span></a>

        <div class="header-nav__content">
            <h3><?php echo esc_html( $content['title'] ?? '' ) ?></h3>

            <ul class="header-nav__list">
                <li class="current"><a class="smoothscroll" href="#home" title="home">Home</a></li>
                <li><a class="smoothscroll" href="#about" title="about">About</a></li>
                <li><a class="smoothscroll" href="#values" title="our-plan">Values</a></li>
                <li><a class="smoothscroll" href="#contact" title="contact">Join Us</a></li>
                <?php if ( $content['sample_section'] ?? 'yes' === 'yes' ) : ?>
                    <li><a class="smoothscroll" href="#works" title="works">Samples</a></li>
                <?php endif; ?>

            </ul>

            <p><?php echo esc_html( $content['title'] ?? '' ) ?> serves as a connection point for anyone with a passion to see a disciple-making movement in
                <?php echo esc_html( $content['location'] ?? '' ) ?>. Join our email prayer guide, follow us on social media, or join us for a
                prayer-walk. Above all pray with us to see spiritual life poured out on our state.</p>

            <ul class="header-nav__social">
                <?php if ( ! empty( $content['facebook_url'] ?? '' ) ) : ?>
                    <li>
                        <a href="<?php echo esc_html( $content['facebook_url'] ?? '' ) ?>" target="_blank" rel="noreferrer noopener"><i class="fab fa-facebook"></i></a>
                    </li>
                <?php endif; ?>
                <?php if ( ! empty( $content['twitter_url'] ?? '' ) ) : ?>
                    <li>
                        <a href="<?php echo esc_html( $content['twitter_url'] ?? '' ) ?>" target="_blank" rel="noreferrer noopener"><i class="fab fa-twitter"></i></a>
                    </li>
                <?php endif; ?>
                <?php if ( ! empty( $content['instagram_url'] ?? '' ) ) : ?>
                    <li>
                        <a href="<?php echo esc_html( $content['instagram_url'] ?? '' ) ?>" target="_blank" rel="noreferrer noopener"><i class="fab fa-instagram"></i></a>
                    </li>
                <?php endif; ?>
            </ul>

            <p>
                <a class="" href="/login" title="login" style="display: block;
                    color: #ffffff;
                    position: relative;
                    font-size: 1.6rem;">
                    Login
                </a>
            </p>

        </div> <!-- end header-nav__content -->

    </nav>

    <a class="header-menu-toggle" href="#0">
        <span class="header-menu-icon"></span>
    </a>

</header> <!-- end s-header -->


<!-- home
================================================== -->

<section id="home" class="s-home target-section" data-parallax="scroll" data-image-src="<?php echo esc_html( $content['background_image_url'] ?? '' ) ?>" data-natural-width="3000" data-natural-height="2000" data-position-y="top">


    <div class="shadow-overlay"></div>

    <div class="home-content">

        <div class="row home-content__main">
            <h1>
                Praying for a <br>disciple making movement <br>in <?php echo esc_html( $content['location'] ?? '' ) ?>.
            </h1>

            <h2 style="color:white;font-family: 'metropolis-light', 'sans-serif';font-size:3.8rem;margin-top:0;"><span style="color:#cc147f;">-</span> #<?php echo esc_html( $content['title'] ?? '' ) ?></h2>
            <a href="#contact" class="smoothscroll"><button class="">Join Us</button></a>

        </div> <!-- end home-content__main -->

    </div> <!-- end home-content -->

    <ul class="home-sidelinks">
        <li><a class="smoothscroll" href="#about">About<span>who we are</span></a></li>
        <li><a class="smoothscroll" href="#values">Values<span>what we care about</span></a></li>
        <li><a class="smoothscroll" href="#contact">Join Us<span>be a part</span></a></li>
    </ul> <!-- end home-sidelinks -->

    <ul class="home-social">
        <li class="home-social-title">Join Us</li>
        <li>
            <a href="#contact" class="smoothscroll">
                <i class="fab fa-envelope"></i>
                <span class="home-social-text">Email Guide</span>
            </a>
        </li>
        <?php if ( ! empty( $content['facebook_url'] ?? '' ) ) : ?>
        <li><a href="<?php echo esc_html( $content['facebook_url'] ?? '' ) ?>" target="_blank" rel="noreferrer noopener">
                <i class="fab fa-facebook"></i>
                <span class="home-social-text">Facebook</span>
            </a>
        </li>
        <?php endif; ?>
        <?php if ( ! empty( $content['twitter_url'] ?? '' ) ) : ?>
        <li><a href="<?php echo esc_html( $content['twitter_url'] ?? '' ) ?>" target="_blank" rel="noreferrer noopener">
                <i class="fab fa-twitter"></i>
                <span class="home-social-text">Twitter</span>
            </a>
        </li>
        <?php endif; ?>
        <?php if ( ! empty( $content['instagram_url'] ?? '' ) ) : ?>
        <li><a href="<?php echo esc_html( $content['instagram_url'] ?? '' ) ?>" target="_blank" rel="noreferrer noopener">
                <i class="fab fa-instagram"></i>
                <span class="home-social-text">Instagram</span>
            </a>
        </li>
        <li>
            <a href="/login" target="_blank" rel="noreferrer noopener">
                <i class="fab"></i>
                <span class="home-social-text">Login</span>
            </a>
        </li>
        <?php endif; ?>

    </ul> <!-- end home-social -->

    <a href="#about" class="home-scroll smoothscroll">
        <span class="home-scroll__text">Scroll Down</span>
        <span class="home-scroll__icon"></span>
    </a> <!-- end home-scroll -->

</section> <!-- end s-home -->


<!-- about
================================================== -->
<section id="about" class="s-about">

    <div class="row section-header" data-aos="fade-up">
        <div class="col-full">
            <h3 class="subhead">Who We Are</h3>
            <h1 class="display-1">#<?php echo esc_html( $content['title'] ?? '' ) ?> serves as a connection point for anyone with a passion to see a disciple making movement in <?php echo esc_html( $content['location'] ?? '' ) ?>.</h1>
        </div>
    </div> <!-- end section-header -->

    <div class="row" data-aos="fade-up">
        <div class="col-full">
            <p class="lead">
                Join our email prayer guide, follow us on social media, or join us for a prayer-walk.
                Above all, pray with us to see spiritual life poured out on our state.
            </p>
        </div>
    </div> <!-- end about-desc -->

    <div class="row">

        <div class="about-process process block-1-2 block-tab-full">

            <div class="process__vline-left"></div>
            <div class="process__vline-right"></div>

            <div class="col-block process__col" data-item="1" data-aos="fade-up">
                <div class="process__text">
                    <h4>Email Prayer Guide</h4>

                    <p>
                        We offer a regular prayer guide that includes challenges, quotes, and scripture focusing on <?php echo esc_html( $content['location'] ?? '' ) ?> issues. These serve as a help to focus us and help us pray together.
                        <a href="#contact">Join our Prayer Guide</a>
                    </p>
                </div>
            </div>
            <div class="col-block process__col" data-item="2" data-aos="fade-up">
                <div class="process__text">
                    <h4>Social Media</h4>

                    <p>
                        Our same email challenges can also be followed on social media. Join our online prayer
                        warriors.
                        <?php if ( ! empty( $content['facebook_url'] ?? '' ) ) : ?>
                        <a href="<?php echo esc_html( $content['facebook_url'] ?? '' ) ?>" target="_blank" rel="noreferrer noopener">Facebook</a>
                        <?php endif; ?>
                        <?php if ( ! empty( $content['twitter_url'] ?? '' ) ) : ?>
                        , <a href="<?php echo esc_html( $content['twitter_url'] ?? '' ) ?>" target="_blank" rel="noreferrer noopener">Twitter</a>
                        <?php endif; ?>
                        <?php if ( ! empty( $content['instagram_url'] ?? '' ) ) : ?>
                          , and <a href="<?php echo esc_html( $content['instagram_url'] ?? '' ) ?>" target="_blank" rel="noreferrer noopener">Instagram</a>
                        <?php endif; ?>

                    </p>
                </div>
            </div>
            <div class="col-block process__col" data-item="3" data-aos="fade-up">
                <div class="process__text">
                    <h4>Prayer Walks</h4>

                    <p>
                        Prayer walking is key. Our faith is intended to be a light on a hill. Getting out and praying
                        over sections of the city and over the people who are there has born fruit in every nation on
                        the planet. <?php echo esc_html( $content['location'] ?? '' ) ?> is no different. Check out our
                        <a href="<?php echo esc_html( $content['facebook_events_url'] ?? '' ) ?>">Facebook Events</a>
                        page.
                    </p>
                </div>
            </div>
            <div class="col-block process__col" data-item="4" data-aos="fade-up">
                <div class="process__text">
                    <h4>Movement Training</h4>
                    <p>
                        If you have a small group or sunday school that would like training on prayer walking or
                        discipleship training on making disciples who multiply, <a href="#contactform">contact us</a>.
                    </p>
                </div>
            </div>

        </div> <!-- end process -->

    </div> <!-- end about-stats -->

</section> <!-- end s-about -->

<!-- stats
================================================== -->
<section id="stats" class="s-stats">

    <div class="row stats block-1-4 block-m-1-2 block-mob-full" data-aos="fade-up">

        <div class="col-block stats__col ">
            <div class="stats__static"><?php echo esc_html( $content['stats_population'] ?? '0' ) ?></div>
            <h5>Million</h5>
        </div>
        <div class="col-block stats__col">
            <div class="stats__count"><?php echo esc_html( $content['stats_cities'] ?? '0' ) ?></div>
            <h5>Cities</h5>
        </div>
        <div class="col-block stats__col">
            <div class="stats__count"><?php echo esc_html( $content['stats_trainings'] ?? '0' ) ?></div>
            <h5>New Trainings Needed</h5>
        </div>
        <div class="col-block stats__col">
            <div class="stats__count"><?php echo esc_html( $content['stats_churches'] ?? '0' ) ?></div>
            <h5>New Churches Needed</h5>
        </div>

    </div> <!-- end stats -->

</section> <!-- end s-stats -->

<!-- values
================================================== -->
<section id="values" class="s-services light-gray">

    <div class="row section-header" data-aos="fade-up">
        <div class="col-full">
            <h3 class="subhead">What We Care About</h3>
            <h1 class="display-1">We know that every disciple making movement in history has begun with
                Extraordinary Prayer.</h1>
        </div>
    </div> <!-- end section-header -->

    <div class="row" data-aos="fade-up">
        <div class="col-full">
            <p class="lead">
                “You do not have because you do not ask God.” – James 4:2<br>
                “The story of every great Christian achievement is the history of answered prayer.” – E.M. Bounds
            </p>
        </div>
    </div> <!-- end about-desc -->

    <div class="row services-list block-1-3 block-m-1-2 block-tab-full">

        <div class="col-block service-item " data-aos="fade-up">
            <div class="service-icon service-icon--brand-identity">
                <i class="icon-tv"></i>
            </div>
            <div class="service-text">
                <h3 class="h4">Loving</h3>
                <p>#<?php echo esc_html( $content['title'] ?? '' ) ?> loves God, loves people, and helps Christians fulfill the Great Commission by
                    mobilizing prayer.
                </p>
            </div>
        </div>

        <div class="col-block service-item" data-aos="fade-up">
            <div class="service-icon  service-icon--illustration">
                <i class="icon-group"></i>
            </div>
            <div class="service-text">
                <h3 class="h4">Strategic</h3>
                <p>#<?php echo esc_html( $content['title'] ?? '' ) ?> promotes strategic prayer for movement, knowing that ( based upon research )
                    extraordinary prayer is found at the root of all modern movements.
                </p>
            </div>
        </div>

        <div class="col-block service-item" data-aos="fade-up">
            <div class="service-icon service-icon--mobile-dev">
                <i class="icon-tv"></i>
            </div>
            <div class="service-text">
                <h3 class="h4">Safe</h3>
                <p>#<?php echo esc_html( $content['title'] ?? '' ) ?> will never ask for money or market to you on behalf of others. The resources and
                    events we may mention will always be for the benefit and connection of the community.
                </p>
            </div>
        </div>

        <div class="col-block service-item" data-aos="fade-up">
            <div class="service-icon service-icon--mobile-dev">
                <i class="icon-lego-block"></i>
            </div>
            <div class="service-text">
                <h3 class="h4">Open</h3>
                <p>#<?php echo esc_html( $content['title'] ?? '' ) ?> welcomes collaboration of <strong>all</strong> Christians.
                </p>
            </div>
        </div>

        <div class="col-block service-item" data-aos="fade-up">
            <div class="service-icon service-icon--mobile-dev">
                <i class="icon-lego-block"></i>
            </div>
            <div class="service-text">
                <h3 class="h4">Multiplying</h3>
                <p>#<?php echo esc_html( $content['title'] ?? '' ) ?> cares that obedient disciples of Jesus Christ make more obedient disciples. Obeying
                    all that Jesus commanded includes making disciples who make disciples.
                </p>
            </div>
        </div>

        <div class="col-block service-item" data-aos="fade-up">
            <div class="service-icon  service-icon--ui-design">
                <i class="icon-window"></i>
            </div>
            <div class="service-text">
                <h3 class="h4">Expectant</h3>
                <p>#<?php echo esc_html( $content['title'] ?? '' ) ?> strives to neither under- nor over-estimate man’s role in disciple multiplication
                    movements. God declared prayer as the vehicle for seeking and receiving his kingdom in the place we live.
                </p>
            </div>
        </div>

        <div class="col-block service-item" data-aos="fade-up">
            <div class="service-icon  service-icon--web-design">
                <i class="icon-earth"></i>
            </div>
            <div class="service-text">
                <h3 class="h4">Mobilizing</h3>
                <p>#<?php echo esc_html( $content['title'] ?? '' ) ?> asks everyone to not only pray but also to mobilize prayer through relationships
                    and opportunities God provides.
                </p>
            </div>
        </div>

        <div class="col-block service-item" data-aos="fade-up">
            <div class="service-icon service-icon--ui-design">
                <i class="icon-window"></i>
            </div>
            <div class="service-text">
                <h3 class="h4">Brief</h3>
                <p>#<?php echo esc_html( $content['title'] ?? '' ) ?> is super brief, usually 1-to-3 lines long. We aim to provoke directed prayer, not
                    monologue.
                </p>
            </div>
        </div>

        <div class="col-block service-item" data-aos="fade-up">
            <div class="service-icon service-icon--mobile-dev">
                <i class="icon-tv"></i>
            </div>
            <div class="service-text">
                <h3 class="h4">Not Political</h3>
                <p>#<?php echo esc_html( $content['title'] ?? '' ) ?> is not a political agenda, rather an effort for sinners who have found forgiveness
                    in Christ to share this Good News with others.
                </p>
            </div>
        </div>

    </div> <!-- end services-list -->

</section> <!-- end s-services -->

<!-- contact
================================================== -->
<section id="contact" class="s-contact">

    <div class="row section-header" data-aos="fade-up">
        <div class="col-full">
            <h3 class="subhead subhead--light">Join Us</h3>
            <h1 class="display-1 display-1--light">(1) Get our email prayer guide</h1>

            <?php if ( isset( $content['contact_form'] ) && ! empty( $content['contact_form'] ) ) : ?>
                <?php echo $content['contact_form']; ?>
            <?php else : ?>
                <form id="newsletter-form" action="">
                    <div id="section-name" class="section">
                        <label for="name" class="input-label label-name">First Name *
                            <input type="text" id="newsletter-fname" name="name" class="input-text input-name" value="" required="required" ></label>
                        <span id="name-error" class="form-error">You're first name is required.</span>
                    </div>

                    <div id="section-name" class="section">
                        <label for="name" class="input-label label-name">Last Name *
                            <input type="text" id="newsletter-lname" name="lname" class="input-text input-name" value="" required="required" ></label>
                        <span id="lname-error" class="form-error">You're last name is required.</span>
                    </div>

                    <div id="section-email" class="section">
                        <label for="email" class="input-label label-email">Email *
                            <input type="email" id="newsletter-email" name="email" class="input-text input-email" value="" >
                            <input type="email" id="newsletter-e2" name="email2" class="input-text email" value="" required="required" >
                        </label>
                        <span id="email-error" class="form-error">You're email is required.</span>
                    </div>

                    <div class="section" id="submit-button-container">
                        <span style="color:red" class="form-submit-error"></span>
                        <button type="button" class="submit-button ignore" id="submit-button-newsletter" disabled>Submit</button> <span class="loading-spinner"></span>
                    </div>

                </form>
            <?php endif; ?>

        </div>
    </div> <!-- end section-header -->

    <div class="row section-header" data-aos="fade-up">
        <div class="col-full">
            <h1 class="display-1 display-1--light">(2) Follow on social media</h1>
            <p>
                <?php if ( ! empty( $content['facebook_url'] ?? '' ) ) : ?>
                <button type="button" onclick="location.href = '<?php echo esc_html( $content['facebook_url'] ?? '' ) ?>'"><i class="fab fa-facebook"></i> Facebook</button>
                <?php endif; ?>
                <?php if ( ! empty( $content['twitter_url'] ?? '' ) ) : ?>
                <button type="button" onclick="location.href = '<?php echo esc_html( $content['twitter_url'] ?? '' ) ?>'"><i class="fab fa-twitter"></i> Twitter</button>
                <?php endif; ?>
                <?php if ( ! empty( $content['instagram_url'] ?? '' ) ) : ?>
                <button type="button" onclick="location.href = '<?php echo esc_html( $content['instagram_url'] ?? '' ) ?>'"><i class="fab fa-instagram"></i> Instagram</button>
                <?php endif; ?>

            </p>

        </div>

    </div> <!-- end section-header -->

    <span id="contactform" name="contactform"></span>

    <div class="row section-header" data-aos="fade-up">
        <div class="col-full">

            <h1 class="display-1 display-1--light">(3) Contact Us</h1>

            <form id="contact-form" action="">

                <div id="section-name" class="section">
                    <label for="name" class="input-label label-name">Name *
                    <input type="text" id="contact-name" name="name" class="input-text input-name" value="" required="required" ></label>
                    <span id="contact-name-error" class="form-error">You're name is required.</span>
                </div>

                <div id="section-email" class="section">
                    <label for="email" class="input-label label-email">Email *
                        <input type="email" id="contact-email" name="email" class="input-text input-email" value="" >
                        <input type="email" id="contact-e2" name="email2" class="input-text email" value="" required="required" >
                    </label>
                    <span id="contact-email-error" class="form-error">You're email is required.</span>
                </div>

                <div id="section-phone" class="section">
                    <label for="phone" class="input-label">Phone *
                    <input type="tel" id="contact-phone" name="phone" class="input-text input-phone" value="" required="required" ></label>
                    <span id="contact-phone-error" class="form-error">You're phone is required.</span>
                </div>

                <div id="section-permission" class="section">
                    <label for="phone" class="input-label">Comment
                        <textarea id="contact-comment" name="comment" class="input-text" value=""></textarea>
                    </label>
                </div>

                <div class="section" id="submit-button-container">
                    <span style="color:red" class="form-submit-error"></span>
                    <button type="button" class="submit-button ignore" id="submit-button-contact" disabled>Submit</button> <span class="loading-spinner"></span>
                </div>

            </form>

        </div>
    </div> <!-- end section-header -->

    <div class="row">

    </div> <!-- end row -->
</section>
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

<?php if ( $content['sample_section'] ?? 'yes' === 'yes' ) : ?>
<!-- works
================================================== -->
<section id="works" class="s-works">

    <div class="row section-header" data-aos="fade-up">
        <div class="col-full">
            <h3 class="subhead">Samples</h3>
            <h1 class="display-1">These are some examples of the encouragements we'll send you.</h1>
        </div>
    </div> <!-- end section-header -->

    <div class="row masonry-wrap">
        <div class="masonry">

            <div class="masonry__brick" data-aos="fade-up">
                <div class="item-folio">

                    <div class="item-folio__thumb">
                        <a href="<?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>images/g-dmm1.jpg" class="thumb-link" title="Movement" data-size="800x800">
                            <img src="<?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>images/dmm1.jpg" srcset="<?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>images/dmm1.jpg 1x, <?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>images/g-dmm1.jpg 2x" alt="">
                        </a>
                    </div>

                    <div class="item-folio__text">
                        <h3 class="item-folio__title">
                            Path to growth
                        </h3>
                        <p class="item-folio__cat">
                            Movement principles
                        </p>
                    </div>

                    <a href="https://www.behance.net/" class="item-folio__project-link" title="Project link">
                        Link
                    </a>

                    <div class="item-folio__caption">
                        <p>The great challenge that faces spiritual movement is not complexity of thought, but obedient action.</p>
                    </div>

                </div> <!-- end item-folio -->
            </div> <!-- end masonry__brick -->

            <div class="masonry__brick" data-aos="fade-up">
                <div class="item-folio">

                    <div class="item-folio__thumb">
                        <a href="<?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>images/g-pray.jpg" class="thumb-link" title="Pray" data-size="800x800">
                            <img src="<?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>images/pray.jpg" srcset="<?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>images/pray.jpg 1x, <?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>images/g-pray.jpg 2x" alt="">
                        </a>
                    </div>

                    <div class="item-folio__text">
                        <h3 class="item-folio__title">
                            See where the kingdom isn't
                        </h3>
                        <p class="item-folio__cat">
                            Compassion
                        </p>
                    </div>

                    <a href="https://www.behance.net/" class="item-folio__project-link" title="Project link">
                        Link
                    </a>

                    <span class="item-folio__caption">
                            <p>Have eyes to see where the kingdom is not yet.</p>
                        </span>

                </div> <!-- end item-folio -->
            </div> <!-- end masonry__brick -->

            <div class="masonry__brick" data-aos="fade-up">
                <div class="item-folio">

                    <div class="item-folio__thumb">
                        <a href="<?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>images/g-quote1.jpg" class="thumb-link" title="Woodcraft" data-size="800x800">
                            <img src="<?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>images/quote1.jpg" srcset="<?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>images/quote1.jpg 1x, <?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>images/g-quote1.jpg 2x" alt="">
                        </a>
                    </div>

                    <div class="item-folio__text">
                        <h3 class="item-folio__title">
                            Heart of Prayer
                        </h3>
                        <p class="item-folio__cat">
                            Prayer
                        </p>
                    </div>

                    <a href="https://www.behance.net/" class="item-folio__project-link" title="Project link">
                        Link
                    </a>

                    <span class="item-folio__caption">
                            <p>Revision what prayer is.</p>
                        </span>

                </div> <!-- end item-folio -->
            </div> <!-- end masonry__brick -->

            <div class="masonry__brick" data-aos="fade-up">
                <div class="item-folio">

                    <div class="item-folio__thumb">
                        <a href="<?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>images/g-scripture.jpg" class="thumb-link" title="Liberty" data-size="800x800">
                            <img src="<?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>images/scripture1.jpg" srcset="<?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>images/scripture1.jpg 1x, <?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>images/g-scripture.jpg 2x" alt="">
                        </a>
                    </div>

                    <div class="item-folio__text">
                        <h3 class="item-folio__title">
                            The Word has Power
                        </h3>
                        <p class="item-folio__cat">
                            Scripture
                        </p>
                    </div>

                    <a href="https://www.behance.net/" class="item-folio__project-link" title="Project link">
                        Link
                    </a>

                    <span class="item-folio__caption">
                            <p>Pray Continually</p>
                        </span>

                </div> <!-- end item-folio -->
            </div> <!-- end masonry__brick -->


            <div class="masonry__brick" data-aos="fade-up">
                <div class="item-folio">

                    <div class="item-folio__thumb">
                        <a href="<?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>images/g-quote4.jpg" class="thumb-link" title="Fuji" data-size="800x800">
                            <img src="<?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>images/quote4.jpg" srcset="<?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>images/quote4.jpg 1x, <?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>images/g-quote4.jpg 2x" alt="">
                        </a>
                    </div>

                    <div class="item-folio__text">
                        <h3 class="item-folio__title">
                            Extraordinary Prayer
                        </h3>
                        <p class="item-folio__cat">
                            Prayer
                        </p>
                    </div>

                    <a href="https://www.behance.net/" class="item-folio__project-link" title="Project link">
                        Link
                    </a>

                    <span class="item-folio__caption">
                            <p>The primary means of revival that everyone agrees on is extraordinary prayer.</p>
                        </span>

                </div> <!-- end item-folio -->
            </div> <!-- end masonry__brick -->

            <div class="masonry__brick" data-aos="fade-up">
                <div class="item-folio">

                    <div class="item-folio__thumb">
                        <a href="<?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>images/g-quote3.jpg" class="thumb-link" title="Shutterbug" data-size="800x800">
                            <img src="<?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>images/quote3.jpg" srcset="<?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>images/quote3.jpg 1x, <?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>images/g-quote3.jpg 2x" alt="">
                        </a>
                    </div>

                    <div class="item-folio__text">
                        <h3 class="item-folio__title">
                            Jesus Commanded More
                        </h3>
                        <p class="item-folio__cat">
                            Vision
                        </p>
                    </div>

                    <a href="https://www.behance.net/" class="item-folio__project-link" title="Project link">
                        Link
                    </a>

                    <span class="item-folio__caption">
                            <p>Jesus commanded much more.</p>
                        </span>

                </div> <!-- end item-folio -->
            </div> <!-- end masonry__brick -->

        </div> <!-- end masonry -->
    </div> <!-- end masonry-wrap -->

    <div class="testimonials-wrap" data-aos="fade-up">

        <div class="row">
            <div class="col-full testimonials-header">
                <h2 class="h1">What Prayer Warriors Are Saying</h2>
            </div>
        </div>

        <div class="row testimonials">

            <div class="col-full testimonials__slider">

                <div class="testimonials__slide">
                    <img src="<?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>images/user-02.jpg" alt="Author image" class="testimonials__avatar">
                    <p>If we never pray for movement in <?php echo esc_html( $content['location'] ?? '' ) ?>, do we have the right to complain when it isn't happening?</p>
                    <div class="testimonials__author">
                        Dave ~
                        <span>Pastor</span>
                    </div>
                </div> <!-- end testimonials__slide -->

                <div class="testimonials__slide">
                    <img src="<?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>images/user-01.jpg" alt="Author image" class="testimonials__avatar">
                    <p>The American church needs to catch up with the prayer commitment, passion, and priority of the church in Asia and Africa.</p>
                    <div class="testimonials__author">
                        Chris ~
                        <span>Worker, North America</span>
                    </div>
                </div> <!-- end testimonials__slide -->

                <div class="testimonials__slide">
                    <img src="<?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>images/keller.jpg" alt="Author image" class="testimonials__avatar">
                    <p>The primary means of revival, that everyone agrees on, is extra-ordinary prayer.</p>
                    <div class="testimonials__author">
                        Tim Keller
                        <span>Pastor</span>
                    </div>
                </div> <!-- end testimonials__slide -->



            </div> <!-- end testimonials__slider -->

        </div> <!-- end testimonials -->

    </div> <!-- end testimonials-wrap -->

</section> <!-- end s-works -->

<?php endif; ?>


<!-- Footer -->
<section id="footer" class="s-contact">
    <div class="row">
        <div class="col-full cl-copyright">
                <span><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright ©<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://zume.community" target="_blank" rel="noopener noreferrer">Zúme.Community</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></span>
        </div>
    </div>

    <div class="cl-go-top">
        <a class="smoothscroll" title="Back to Top" href="#top"><i class="icon-arrow-up" aria-hidden="true"></i></a>
    </div>

</section> <!-- end s-contact -->


<!-- photoswipe background
================================================== -->
<div aria-hidden="true" class="pswp" role="dialog" tabindex="-1">

    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap">

        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                <button class="pswp__button pswp__button--share" title="Share"></button>
                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>
            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>

    </div>

</div> <!-- end photoSwipe background -->


<!-- preloader
================================================== -->
<div id="preloader">
    <div id="loader">
    </div>
</div>
<!-- /wp:html -->

<!-- Java Script
================================================== -->
<script src="<?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>js/jquery-3.2.1.min.js"></script>
<script src="<?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>js/plugins.js"></script>
<script src="<?php echo trailingslashit( plugin_dir_url( __FILE__ ) ) ?>js/main.js"></script>
