<?php
// Add child parent and child theme styles
add_action( 'wp_enqueue_scripts', 'enqueue_assets' );

function enqueue_assets() {
   wp_enqueue_style( 'parent-styles', get_template_directory_uri().'/style.css' );
   wp_enqueue_style( 'child-styles', get_stylesheet_directory_uri().'/assets/css/frontend.css' );
   wp_enqueue_script('child-scripts', get_stylesheet_directory_uri().'/assets/js/scripts.js' );
}

// Add css for gutenberg blocks inside backend
add_action( 'enqueue_block_editor_assets', 'twentytwenty_child_block_editor_styles', 99 );

function twentytwenty_child_block_editor_styles() {
	wp_enqueue_style( 'twentytwenty-child-block-editor-styles', get_stylesheet_directory_uri().'/assets/css/gutenberg.css' );
}

// Remove state for Woocommerce calculator on cart page
add_filter( 'woocommerce_shipping_calculator_enable_state', '__return_false' );

// Remove the sorting dropdown from Woocommerce
remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_catalog_ordering', 30 );

// Remove the result count from WooCommerce
remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );


add_filter( 'woocommerce_order_button_text', 'misha_custom_button_text' );
function misha_custom_button_text( $button_text ) {
   $options = get_option( 'wmsc_options' );
   return $options['t_next'];
}


add_filter( 'load_textdomain_mofile', 'load_custom_plugin_translation_file', 10, 2 );
/*
 * Replace 'textdomain' with your plugin's textdomain. e.g. 'woocommerce'. 
 * File to be named, for example, yourtranslationfile-en_GB.mo
 * File to be placed, for example, wp-content/lanaguages/textdomain/yourtranslationfile-en_GB.mo
 */
function load_custom_plugin_translation_file( $mofile, $domain ) {
   if ( 'woocommerce' === $domain) {
      $locale = get_locale();
      if ( $locale = 'ru_RU' ) {
         $mofile = get_stylesheet_directory() . '/languages/woocommerce-' . $locale . '.mo';
      }
   }
   return $mofile;
}

// function remove_shipping_calc_on_cart( $show_shipping ) {
//    if( is_cart() ) {
//        return false;
//    }
//    return $show_shipping;
// }
// add_filter( 'woocommerce_cart_ready_to_calc_shipping', 'remove_shipping_calc_on_cart', 99 );

// Это нужно что бы отключить подсчет доставки везде кроме checkout, что бы доставка почты России не пересчитывалась каждый раз после добавления товаров в корзину
add_filter( 'woocommerce_product_needs_shipping', 'filter_woocommerce_product_needs_shipping', 99 );

function filter_woocommerce_product_needs_shipping( $condition ){
   if( !is_checkout() ) {
       return false;
   }
	return $condition;
}

add_action( 'woocommerce_proceed_to_checkout', 'woocommerce_before_cart_totals_html' );

function woocommerce_before_cart_totals_html() {
   echo '<div style="padding: 0 0 10px 10px; font-size: 16px;">' . __( 'Enter your address to view shipping options.', 'woocommerce' ) . '</div>';
}

?>