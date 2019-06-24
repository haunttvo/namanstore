<?php
function wpdocs_register_my_custom_menu_page(){
    add_menu_page(
        __( 'Custom Menu Title', 'textdomain' ),
        'custom menu',
        'manage_options',
        'custompage',
        'sync_data_kioviet'
    );
}
function sync_data_kioviet(){
    echo 123;
}
add_action( 'admin_menu', 'wpdocs_register_my_custom_menu_page' );