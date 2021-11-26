<?php

require_once('vendor/autoload.php');

function redirect_buildings() {
    if ( is_home() ) {
        wp_redirect( '/buildings');
        exit();
    }
}
add_action( 'template_redirect', 'redirect_buildings' );

theme();
