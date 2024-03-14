<?php

function get_filtered_products($products_query) {
  return $products_query->get_products(); // Call the get_products() method of the WC_Product_Query object to retrieve the filtered products based on the query parameters.
}

function render_product_list($products) {
  if ($products) {
      $output = '<div class="product-container">'; // Start the product container element

      foreach ($products as $product) {
          // Call the display_product function and append its output to $output
          $output .= single_product_display($product);
      }

      $output .= '</div>'; // End the product container element

      return $output;
  } else {
      return '<p>No products found in this category.</p>'; // Return a message if no products are found
  }
}


