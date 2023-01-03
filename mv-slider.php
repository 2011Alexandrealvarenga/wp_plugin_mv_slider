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
        function __construct()
        {
            
        }
    }
 }

 if(class_exists('MV_Slider')){
    $mv_slider = new MV_Slider();
 }