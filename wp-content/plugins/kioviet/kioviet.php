<?php
/*
 * Plugin Name: đồng bộ kioviet
Plugin URI: https://haunguyen.com/
Description: sync data kioviet
Version: 1.0
Author: haunttvo
Author URI: https://haunguyen.com/
License: GPL
 * */

use Automattic\WooCommerce\Client;

session_start();
function wpdocs_register_my_custom_menu_page(){
    add_menu_page('Kioviet', 'Kioviet', 'manage_options', 'kioviet', 'sync_data_kioviet');
    add_submenu_page( 'kioviet', 'My Custom Page', 'Đồng bộ thuộc tính',
        'manage_options', 'sync-attr', 'sync_cagegories');
//    add_submenu_page( 'my-top-level-slug', 'My Custom Submenu Page', 'My Custom Submenu Page',
//        'manage_options', 'my-secondary-slug');
}
function sync_data_kioviet(){
    try{
        if( !empty($_SESSION['token_kioviet']) ){
            $data_product = get_data_product($_GET['page_size']);
            $result = [];
            $total = $data_product['total'];
            $page_size = $data_product['pageSize'];
            $pg = ceil($total/$page_size);
            foreach ($data_product['data'] as $element){
                $result[$element['masterProductId']][$element['masterProductId']][] = $element;
            }
            require_once 'template/index.php';
        }else{
            get_token();
        }
    }catch (Exception $e){
        print_r($e);
    }
}
function sync_cagegories(){
    try{
        if( !empty($_SESSION['token_kioviet']) ){
            get_list_categories();
            require_once 'template/categories.php';
        }else{
            get_token();
        }
    }catch (Exception $e){
        print_r($e);
    }
}

add_action( 'admin_menu', 'wpdocs_register_my_custom_menu_page' );

function qg_enqueue(){
    wp_enqueue_script('mainjs',plugin_dir_url(__FILE__).'inc/js/main.js', array());
    wp_enqueue_style('kiovietcss', plugin_dir_url(__FILE__).'inc/css/main.css');
}
add_action('admin_enqueue_scripts', 'qg_enqueue');


add_action( 'wp_ajax_sync_data_ajax', 'sync_data_ajax' );
add_action( 'wp_ajax_nopriv_sync_data_ajax', 'sync_data_ajax' );
function sync_data_ajax() {
    $page_size = $_POST['page_size'];
    $arrID = $_POST['arrID'];
    query_sync_data_by_productID($page_size, $arrID);
    die();
}

function query_sync_data_by_productID($pagesize, $arrID){
    global $post, $woocommerce, $product;
    $woocommerce = new Client(
        site_url(),
        CONSUMERKEY_WOO,
        CONSUMERSCRET_WOO,
        [
            'version' => 'wc/v3',
        ]
    );
    $data = get_data_product($pagesize)['data'];
    $result = [];
    $a = array_filter($data, function($items) use($arrID) {
        if( in_array($items['id'], $arrID) || in_array($items['masterProductId'], $arrID)){
            return $items;
        }
    });
    foreach ($a as $e){
        $result[$e['masterProductId']][] = $e;
    };
    foreach ($result as $key => $el){
        if(empty($key)){
            foreach ($el as $k => $v){
                $data = [
                    'name' => $v['name'],
                    'type' => 'simple',
                    'regular_price' =>  strval($v['basePrice'])
                ];
                $woocommerce->post('products', $data);
            }
        }
    }
    echo 'success';

    die();
}


function get_token(){
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://id.kiotviet.vn/connect/token",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "client_id=fefe0f2f-b817-41ca-9c7b-894af95ba468&client_secret=7B14D044ECB95369E11241D1172AAA7125B7532E&grant_type=client_credentials&scopes=PublicApi.Access",
        CURLOPT_HTTPHEADER => array(
            "Accept: */*",
            "Cache-Control: no-cache",
            "Connection: keep-alive",
            "Content-Type: application/x-www-form-urlencoded",
            "Host: id.kiotviet.vn",
            "accept-encoding: gzip, deflate",
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $_SESSION['token_kioviet'] = json_decode($response, true)['access_token'];
}
function get_data_product($page_size = 1){
    $curl = curl_init();
    $page_size = intval($page_size);
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://public.kiotapi.com/Products?format=json&currentItem={$page_size}&pageSize=100&orderBy=id&orderDirection=desc",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Accept: */*",
            "Authorization: Bearer {$_SESSION['token_kioviet']}",
            "Cache-Control: no-cache",
            "Connection: keep-alive",
            "Host: public.kiotapi.com",
            "Retailer: namanstore",
            "accept-encoding: gzip, deflate",
            "cache-control: no-cache",
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    return json_decode($response, true);
}

function get_list_categories(){
    init_curl_get_api_kioviet();
}

function init_curl_get_api_kioviet($params = '', $methods = 'GET'){
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://public.kiotapi.com/categories?format=json&includeRemoveIds=true&pageSize=100&currentItem=0&orderBy=categoryName&orderDirection=desc&hierachicalData=true&lastModifiedFrom=%222018-08-01%22",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Accept: */*",
            "Authorization: Bearer {$_SESSION['token_kioviet']}",
            "Cache-Control: no-cache",
            "Connection: keep-alive",
            "Host: public.kiotapi.com",
            "Retailer: namanstore",
            "accept-encoding: gzip, deflate",
            "cache-control: no-cache",
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    return json_decode($response, true);
}
