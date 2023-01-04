<?php
/**
 * Plugin name: MV slider
 * Plugin URI: https://wordpress.org/plugins/custom-css-js/
 * Description: My plygin´s description
 * Version: 1.0
 * Author: Alexandre Alvarenga
 * Author URI: 
 * License: GPL2
 * Text Domain: 
 * Domain Path: 
 */

//  Para nao ser acessado diretamente
 if(!defined ('ABSPATH')){
    exit;
 }

 if(!class_exists('MV_Slider')){
    class MV_Slider{
        function __construct(){
            $this->define_constants();
        }
        public function define_constants(){
            define('MV_SLIDER_PATH', plugin_dir_path(__FILE__));
            define('MV_SLIDER_URL', plugin_dir_url(__FILE__));
            define('MV_SLIDER_VERSION','1.0.0');
        }
        public static function activate(){
            update_option('rewrite_rules','');
        }
        public static function deactivate(){
            flush_rewrite_rules();
        }
        public static function uninstall(){

        }
    }
 }

 if(class_exists('MV_Slider')){
    register_activation_hook(__FILE__, array('MV_Slider','activate'));
    register_deactivation_hook(__FILE__, array('MV_Slider','deactivate'));
    register_uninstall_hook(__FILE__, array('MV_Slider','uninstall'));
    $mv_slider = new MV_Slider();
 }