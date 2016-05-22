<?php
/**
    Plugin Name: my_plugin
    Plugin URI: https://github.com/velozalet
    Description: mini-shop plugin for WP
    Version: 1.0
    Author: Lutskyi Yaroslav, littus@i.ua
    Author URI: https://github.com/velozalet
*/
//----------------------------------------

//include_once dirname(__FILE__).'/minishop_lib/Minishop.php';
include_once( plugin_dir_path(__FILE__).'minishop_lib/Minishop.php' );  //include Class Minishop()

//Register & include CSS-files/js-files in plugin "my_plugin"
function add_my_admin_scripts() {
    wp_register_style( 'admin-style_css', plugins_url( '/assets/css/admin-style.css', __FILE__ ) );
    wp_register_script('admin-function_js', plugins_url( '/assets/js/admin-function.js', __FILE__ ), array('jquery'));

    wp_enqueue_style('admin-style_css');
    wp_enqueue_script('admin-function_js');
}
add_action('admin_enqueue_scripts', 'add_my_admin_scripts');
//----------------------------------------


if( class_exists('Minishop') ) {
    $Minishop = new Minishop();

    register_activation_hook(__FILE__, array('MiniShop', 'add_role_seller'));
    register_activation_hook(__FILE__, array('MiniShop', 'add_role_buyer'));

    register_deactivation_hook(__FILE__, array('MiniShop', 'remove_custom_roles'));
}


