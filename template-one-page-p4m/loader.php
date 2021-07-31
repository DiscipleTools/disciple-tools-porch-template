<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.



require_once( 'home.php' );
if ( is_admin() ) {
    require_once( 'admin/admin-customizer.php' );
}