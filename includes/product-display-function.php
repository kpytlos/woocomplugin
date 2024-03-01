<?php
/**
 * Function to display product listings with title, price, and image.
 *
 * @param array $products An array of product objects.
 *
 * @return string The HTML markup for the product list.
 */
function display_products($products) {
  if ($products) {
    // Check if any products are present in the provided array

    $output = '<div class="product-container">'; // Start the product container element

    foreach ($products as $product) {
      // Loop through each product object in the array

      $product_title = $product->get_name(); // Get the product title
      $product_price = $product->get_price(); // Get the product price
      $product_image = $product->get_image(); // Get the product image (default is thumbnail)

      $output .= '<div class="product">'; // Start the individual product element
      $output .= '<p><b>Title:</b> ' . $product_title . '</p>'; // Display product title
      $output .= '<p><b>Price:</b> ' . wc_price($product_price) . '</p>'; // Display formatted product price using WooCommerce function
      $output .= '<p><b>Image:</b> ' . $product_image . '</p>'; // Display product image URL

      $output .= '</div>'; // End the individual product element
    }

    $output .= '</div>'; // End the product container element

    return $output; // Return the generated HTML string
  } else {
    // If no products are found, return a message
    return '<p>No products found in this category.</p>';
  }
}

