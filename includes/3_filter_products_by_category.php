<?php

function filter_products_by_category($selected_category) {
  $args = array(// Set up the basic arguments for the product query
      'limit' => -1, // Get all products (no limit)
  );

  if ($selected_category && $selected_category !== 'all') { // If a category is selected and it's not "All"...
      $args['tax_query'] = array( // ...add a tax_query argument to filter by that category
          array(
              'taxonomy' => 'product_cat',  // Target the 'product_cat' taxonomy
              'field' => 'slug',           // Use the category slug for comparison
              'terms' => array($selected_category), // Include the selected category slug
          ),
      );
  }
  return new WC_Product_Query($args); // Return a new WC_Product_Query object based on the constructed arguments
}





