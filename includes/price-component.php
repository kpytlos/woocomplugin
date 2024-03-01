<?php

function display_price($price) {
    if ($price) {
      $formatted_price = wc_price($price); // Format price using WooCommerce function
      $output = '<p class="product-price">' . $formatted_price . '</p>';
      return $output;
    } else {
      // Handle cases where price is unavailable (optional)
      return ''; // Or a placeholder message
    }
  }