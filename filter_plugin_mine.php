<?php
/*
Plugin Name: My First Plugin
Description: This is my first plugin! It makes a new admin menu link!
Author: Your Name
*/

// Define plugin path
/*$plugin_path = plugin_dir_path( __FILE__ );

// Include functions file with try-catch block
try {
  require_once $plugin_path . 'includes/fpm-functions.php';
} catch (Exception $e) {
  error_log("Error including fpm-functions.php: " . $e->getMessage());
  // Display a user-friendly error message if you want to
  wp_die("Error: Could not load plugin functions.");
}

// Include product grid function with try-catch block
try {
  require_once $plugin_path . 'includes/fpm-product-grid-function.php';
} catch (Exception $e) {
  error_log("Error including fpm-product-grid-function.php: " . $e->getMessage());
  // Display a user-friendly error message if you want to
  wp_die("Error: Could not load product grid function.");
}*/

//THE WORKING ONEEEEEEEE <----------

/*
Plugin Name: My First Plugin
Description: Displays product categories with links and filters product listings based on the selected category.
Version: 1.5
Author: Chris
*/

// Define Plugin Path
$plugin_path = plugin_dir_path( __FILE__ ); // Get the absolute path to the plugin's directory

// Include Required Files
require_once( $plugin_path . 'includes/category-retrieval-display.php' ); // Include functions for categories
require_once( $plugin_path . 'includes/product-filtering-retrieval.php' ); // Include functions for product filtering
require_once( $plugin_path . 'includes/product-display-function.php' ); // Include function for product display

//Main Function for Shortcode
function get_all_woocommerce_products_shortcode($atts) {
    
  //Retrieve Product Categories
  $categories = get_product_categories(); // Get all product categories excluding empty ones

  //Get Selected Category (if any)
  $selected_category = isset($_GET['product_cat']) ? $_GET['product_cat'] : ''; // Check if a category is selected from the URL

  //Build Output String
  $output = ''; // Initialize empty string for output

  //Display Product Categories
  $output .= display_product_categories($categories); // Call function to display category list with links

  //Filter Products Based on Category
  $products_query = filter_products_by_category($selected_category); // Create a WC_Product_Query object with category filter if applicable

  //Get Filtered Products
  $products = get_filtered_products($products_query); // Retrieve filtered products based on the query

  //Display Product Listings
  $output .= display_products($products); // Call function to display filtered product listings

  //Return Output
  return $output; // Return the complete HTML output string
}
//Register Shortcode
add_shortcode('all_products_mypluginlast', 'get_all_woocommerce_products_shortcode');



// Enqueue plugin styles
function enqueue_plugin_styles() {
  wp_enqueue_style(
      'myplugin-category-filter-styles', 
      plugin_dir_url( __FILE__ ) . 'assets/category-filter.css', // Adjust path based on your folder structure
      array(), 
      '1.2.3' // Version for cache-busting
  );
}
add_action('wp_enqueue_scripts', 'enqueue_plugin_styles');