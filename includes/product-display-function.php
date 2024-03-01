<?php

function display_products($products) {
  if ($products) {

      $output = '<div class="product-container">'; // Start the product container element

      foreach ($products as $product) {
          // Loop through each product object in the array
          $output .= '<div class="product-box">';

          $product_title = $product->get_name(); // Get the product title
          $product_price = $product->get_price(); // Get the product price
          $product_image = $product->get_image(); // Get the product image (default is thumbnail)
          $product_link = get_permalink($product->get_id());

          $output .= '<a href="' . $product_link . '" class="product-info">';
          $output .= str_replace('<img ', '<img class="product-image" ', $product_image);
          $output .= '<h6>' . $product_title . '</h6>'; 
          $output .= '<p class="product-price">' . wc_price($product_price) . '</p>'; // Price with class
          // ... add more information or interactive elements if needed
          $output .= '</a>'; // Close anchor tag

          $output .= '</div>'; // End the individual product element
      }

      $output .= '</div>'; // End the product container element

      return $output; // Return the generated HTML string
  } else {
      // If no products are found, return a message
      return '<p>No products found in this category.</p>';
  }
}