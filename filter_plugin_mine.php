<?php
/**
* Plugin Name: custom shop
* Description: Test.
* Version: 1
* Author: Chris
**/


// Define Plugin Path
$plugin_path = plugin_dir_path( __FILE__ ); // Get the absolute path to the plugin's directory

// Include Required Files
require_once( $plugin_path . 'includes/1_get_product_categories.php' );
require_once( $plugin_path . 'includes/2_display_product_categories.php' ); // Include functions for categories
require_once( $plugin_path . 'includes/3_filter_products_by_category.php' ); // Include functions for product filtering
require_once( $plugin_path . 'includes/render_product_display_list.php' ); // Include function for product display
require_once( $plugin_path . 'includes/price-component.php' ); 
require_once( $plugin_path . 'includes/related-products-component.php' ); 
require_once( $plugin_path . 'includes/single_product_display.php' );  

//Main Function for Shortcode
function get_all_woocommerce_products_shortcode($atts) {
  $categories = get_product_categories(); // Get all product categories excluding empty ones
  $selected_category = isset($_GET['product_cat']) ? $_GET['product_cat'] : ''; // Check if a category is selected from the URL
  $output = ''; // Initialize empty string for output
  $output .= display_product_categories($categories); // Call function to display category list with links
  $products_query = filter_products_by_category($selected_category); // Create a WC_Product_Query object with category filter if applicable
  $products = get_filtered_products($products_query); // Retrieve filtered products based on the query
  $output .= render_product_list($products); // Call function to display filtered product listings

  return $output; // Return the complete HTML output string
}
//Register Shortcode
add_shortcode('all_products_mypluginlast', 'get_all_woocommerce_products_shortcode');


// Enqueue plugin styles
function enqueue_plugin_styles() {
  wp_enqueue_style(
    'myplugin-category-filter-styles',
    plugin_dir_url(__FILE__) . 'assets/category-filter.css',
    array(),
    '1.2.3'
  );

  wp_enqueue_style(
    'myplugin-product-grid-styles',
    plugin_dir_url(__FILE__) . 'assets/product-display-grid.css',
    array(),
    '1.0.0'
  );

  wp_enqueue_style(
    'product-details-button',
    plugin_dir_url(__FILE__) . 'assets/product-details-button.css',
    array(),
    '1.0.0'
  );

  wp_enqueue_style(
    'related-products-component',
    plugin_dir_url(__FILE__) . 'assets/related-products-component.css',
    array(),
    '1.0.0'
  );


}
add_action('wp_enqueue_scripts', 'enqueue_plugin_styles');
