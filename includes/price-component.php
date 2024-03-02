<?php

function display_price($price_text, $has_single_price) {
    if ($price_text) {
      // Format price with Euro symbol
      $formatted_price = number_format($price_text) . '€';
  
      if ($has_single_price) {
        // Single price: remove "From" prefix
        return '<p class="product-price">' . $formatted_price . '</p>';
      } else {
        // Multiple prices: include "From" prefix
        return '<p class="product-price">From ' . $formatted_price . '</p>';
      }
    } else {
      // Handle cases where price is unavailable (optional)
      return ''; // Or a placeholder message
    }
  }
  