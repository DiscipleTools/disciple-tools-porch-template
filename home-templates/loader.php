<?php

function load_home_template( $number ) {
    if ( $number < 9 && $number > 0 ) {
        require_once('template-home-'.$number.'/loader.php');
    }
}
