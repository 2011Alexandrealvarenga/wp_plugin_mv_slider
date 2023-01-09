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

            // adicionar menu
            add_action('admin_menu', array($this, 'add_menu'));

            // chama o post type
            require_once(MV_SLIDER_PATH . 'post-types/class.mv-slider-cpt.php');
            $MV_Slider_Post_Type = new MV_Slider_Post_Type();
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
            unregister_post_type('mv-slider');
        }
        public static function uninstall(){

        }

        // adicionar menu
        public function add_menu(){
            // exibir em outros locais o item/precisa tirar o icone
            // add_plugin_page, menu plugin
            // add_theme_page, menu aparencia
            // add_options_page, menu configurações/settings

            add_menu_page(
                'MV Slider Options',
                'MV Slider',
                'manage_options',
                'mv_slider_admin',
                array($this, 'mv_slider_settings_page'),
                'dashicons-images-alt2'
            );
            add_submenu_page(
                'mv_slider_admin',
                'Manage Slides',
                'Manage Slides',
                'manage_options',
                'edit.php?post_type=mv-slider',
                null,
                null
            );
            add_submenu_page(
                'mv_slider_admin',
                'Add New Slide',
                'Add New Slide',
                'manage_options',
                'post-new.php?post_type=mv-slider',
                null,
                null
            );
        }
        public function mv_slider_settings_page(){
            echo "This is a test page";
        }
    }
 }

 if(class_exists('MV_Slider')){
    register_activation_hook(__FILE__, array('MV_Slider','activate'));
    register_deactivation_hook(__FILE__, array('MV_Slider','deactivate'));
    register_uninstall_hook(__FILE__, array('MV_Slider','uninstall'));
    $mv_slider = new MV_Slider();
 }