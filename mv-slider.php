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

            require_once(MV_SLIDER_PATH . 'class.mv-slider-settings.php');
            $MV_Slider_Settings = new MV_Slider_Settings();

            // shortcode
            require_once(MV_SLIDER_PATH . 'shortcodes/class.mv-slider-shortcode.php');
            $MV_Slider_Shortcode = new MV_Slider_Shortcode();

            add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ), 999 );
            

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
            // verificacao se tem permissao
            if(!current_user_can('manage_options')){
                return;
            }

            // mensagem de sucesso
            if(isset($_GET['settings-updated'])){
                add_settings_error('mv_slider_options','mv_slider_message','Settings Saved','success');
            }
            settings_errors('mv_slider_options');
            
            require(MV_SLIDER_PATH .'views/settings-page.php');
        }
        public function register_scripts(){
            wp_register_script( 'mv-slider-main-jq', MV_SLIDER_URL . 'vendor/flexslider/jquery.flexslider-min.js', array( 'jquery' ), MV_SLIDER_VERSION, true );
            wp_register_script( 'mv-slider-options-js', MV_SLIDER_URL . 'vendor/flexslider/flexslider.js', array( 'jquery' ), MV_SLIDER_VERSION, true );
            wp_register_style( 'mv-slider-main-css', MV_SLIDER_URL . 'vendor/flexslider/flexslider.css', array(), MV_SLIDER_VERSION, 'all' );
            wp_register_style( 'mv-slider-style-css', MV_SLIDER_URL . 'assets/css/frontend.css', array(), MV_SLIDER_VERSION, 'all' );
        }
    }
 }

 if(class_exists('MV_Slider')){
    register_activation_hook(__FILE__, array('MV_Slider','activate'));
    register_deactivation_hook(__FILE__, array('MV_Slider','deactivate'));
    register_uninstall_hook(__FILE__, array('MV_Slider','uninstall'));
    $mv_slider = new MV_Slider();
 }