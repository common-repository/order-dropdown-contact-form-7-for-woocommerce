<?php 
/**
* Plugin Name: Order Dropdown Contact Form 7 For Woocommerce
* Description: WooCommerce Order Dropdown List.
* Version: 1.0
* Copyright: 2022
* Text Domain: order-dropdown-contact-form-7-for-woocommerce
*/


if (!defined('ABSPATH')) {
    die('-1');
}

// define for base name
define('ODWFCF7_BASE_NAME', plugin_basename(__FILE__));

// define for plugin file
define('odwfcf7_plugin_file', __FILE__);

// define for plugin dir path

if (!defined('ODWFCF7_PLUGIN_DIR')) {
    define('ODWFCF7_PLUGIN_DIR', plugin_dir_path(__FILE__));
}
if (!defined('ODWFCF7_PLUGIN_URL')) {
  define('ODWFCF7_PLUGIN_URL',plugins_url('', __FILE__));
}
// Include function files
include_once(ODWFCF7_PLUGIN_DIR.'includes/frontend.php');
include_once(ODWFCF7_PLUGIN_DIR.'includes/admin.php');

function ODWFCF7_load_script_style(){
    wp_enqueue_style( 'jquery-orderdropdown-style', ODWFCF7_PLUGIN_URL. '/public/css/design.css', '', '3.0' );
}
add_action( 'wp_enqueue_scripts', 'ODWFCF7_load_script_style' );

?>