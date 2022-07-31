<?php
/**
 * Plugin Name: Beplus Sticky Language Fluentu
 * Description: Sticky Header Languages for Fluentu site
 * Version: 1.0
 * Author: Beplus
 */

 if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

 // The BSL_FLUENTU Search plugin version.
define( 'BSL_FLUENTU_VERSION', '1.0' );
define( 'BSL_FLUENTU_PLUGIN_URL', plugin_dir_url(__FILE__) );
define( 'BSL_FLUENTU_PATH', plugin_dir_path( __FILE__ ) );


//Backend
require_once BSL_FLUENTU_PATH . 'backend/settings.php';

//Front-end
{
  /**
   * Proper way to enqueue scripts and styles
  */
  function fluentu_sticky_language_scripts() {

      //Only show on single blog
      if(is_singular('post')){

        //Get data
        $genaral = get_option('fluentu_options');
        $langs = get_option('fluentu_langs_options');
        $list_langs = array();
        foreach ($langs as $key => $lang) {
          $lang['icon'] = wp_get_attachment_image_url($lang['icon'],'full ');
          $list_langs[] = $lang;
        }
        $data_fluentu = array(
          'genaral' => $genaral,
          'langs' => $list_langs
        );

        //Show if enable
        if($genaral['fluentu_field_enable'] && !empty($list_langs)){
          wp_enqueue_script( 'fluentu-main', BSL_FLUENTU_PLUGIN_URL . 'assets/js/main.js', array('jquery'), BSL_FLUENTU_VERSION , true );
          wp_enqueue_style( 'fluentu-main', BSL_FLUENTU_PLUGIN_URL . 'assets/css/main.css', array(), BSL_FLUENTU_VERSION , false );
          wp_localize_script('fluentu-main','settings' , $data_fluentu );
        }

      }
  }
  add_action( 'wp_enqueue_scripts', 'fluentu_sticky_language_scripts' );
}
