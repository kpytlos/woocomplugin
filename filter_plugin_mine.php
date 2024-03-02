<?php
// Define Plugin Path
$plugin_path = plugin_dir_path( __FILE__ ); // Get the absolute path to the plugin's directory

// Include Required Files
require_once( $plugin_path . 'includes/category-retrieval-display.php' ); // Include functions for categories
require_once( $plugin_path . 'includes/product-filtering-retrieval.php' ); // Include functions for product filtering
require_once( $plugin_path . 'includes/product-display-grid.php' ); // Include function for product display
require_once( $plugin_path . 'includes/price-component.php' ); 

//Main Function for Shortcode
function get_all_woocommerce_products_shortcode($atts) {
  $categories = get_product_categories(); // Get all product categories excluding empty ones
  $selected_category = isset($_GET['product_cat']) ? $_GET['product_cat'] : ''; // Check if a category is selected from the URL
  $output = ''; // Initialize empty string for output
  $output .= display_product_categories($categories); // Call function to display category list with links
  $products_query = filter_products_by_category($selected_category); // Create a WC_Product_Query object with category filter if applicable
  $products = get_filtered_products($products_query); // Retrieve filtered products based on the query
  $output .= display_products($products); // Call function to display filtered product listings

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
    plugin_dir_url(__FILE__) . 'assets/product-grid.css',
    array(),
    '1.0.0'
  );

  wp_enqueue_style(
    'product-details-button',
    plugin_dir_url(__FILE__) . 'assets/product-details-button.css',
    array(),
    '1.0.0'
  );
}
add_action('wp_enqueue_scripts', 'enqueue_plugin_styles');