<?php
// Add custom Theme Functions here

add_action('wp_enqueue_scripts', 'my_script_hautvo');

function my_script_hautvo(){
    wp_enqueue_style( 'custom_stylesheet', get_stylesheet_directory_uri() . '/asset/css/style.css' );
}

add_filter('woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text');

function woo_custom_cart_button_text() {
return __('Thêm vào giỏ', 'woocommerce');
}


function fn_info_us(){
    ob_start();
    ?>
    <div class="info_us">
        <ul class="ul_info_us">
            <li>
                <i class="icon-map-pin-fill"></i>
                <p>193 Núi thành, Q.Hải Châu, TP.Đà Nẵng</p>
            </li>
            <li>
            <i class="icon-phone"></i>
                <p>0973.66.99.81</p>
            </li>
            <li>
                <i class="icon-envelop"></i>
                <p>namanstore@gmail.com</p>
            </li>
        </ul>
    </div>
    <?php
    $context = ob_get_contents();
    ob_end_clean();
    return $context;
}
add_shortcode('info_us', 'fn_info_us');

function fn_info_us_header(){
    ob_start();
    ?>
    <div class="info_us_header">
        <ul class="ul_info_us_header">
            <li>
                <i class="icon-map-pin-fill"></i>
                <p>193 Núi thành, Q.Hải Châu, TP.Đà Nẵng</p>
            </li>
            <li>
            <i class="icon-phone"></i>
                <p>0973.66.99.81</p>
            </li>
        </ul>
    </div>
    <?php
    $context = ob_get_contents();
    ob_end_clean();
    return $context;
}
add_shortcode('info_us_header', 'fn_info_us_header');


/**
 * Replace the home link URL
 */
add_filter( 'woocommerce_breadcrumb_home_url', 'woo_custom_breadrumb_home_url' );
function woo_custom_breadrumb_home_url() {
    return 'http://woocommerce.com';
}

/** acf load field huong dan chon size */
function acf_load_field_tut_choice_size( $field ) {
    $arr_tut_size = new wp_query(array(
        'post_type' => 'tut_choice_size',
        'post_status' => 'publish'
    ));    
    $arr_tut_size = $arr_tut_size->posts;
    $res_field = [];
    array_unshift($res_field, '--Hướng dẫn chọn size--');
    foreach ($arr_tut_size as $key => $value) {
        $res_field = $res_field + array( $value->ID => $value->post_title );
    }
    $field['choices'] = $res_field;
    return $field;
}
add_filter('acf/load_field/name=tut_choice_size', 'acf_load_field_tut_choice_size');

function fn_woo_choice_size() {  
    $post_id = get_the_ID();
    $id_choice_size = get_field('tut_choice_size', $post_id);
    $the_content = get_post_field( 'post_content', $id_choice_size);
    if( !empty($id_choice_size) || $id_choice_size != 0 )
    echo '<a class="link_choice_size" href="#popup_choice_size"><i>Hướng dẫn chọn size</i></a>'.do_shortcode('[lightbox id="popup_choice_size" width="1200px" padding="20px"]'. apply_filters('the_content',$the_content) .'[/lightbox]');
}    
add_action( 'woocommerce_single_product_summary', 'fn_woo_choice_size', 25 ); 