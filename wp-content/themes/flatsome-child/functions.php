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