<?php
/**
 * Function to create a WC_Product_Query object with category filter if applicable.
 *
 * @param string $selected_category The slug of the selected category (optional).
 *
 * @return WC_Product_Query The product query object.
 */
function filter_products_by_category($selected_category) {
  // Set up the basic arguments for the product query
  $args = array(
      'limit' => -1, // Get all products (no limit)
  );

  // If a category is selected and it's not "All"...
  if ($selected_category && $selected_category !== 'all') {
      // ...add a tax_query argument to filter by that category
      $args['tax_query'] = array(
          array(
              'taxonomy' => 'product_cat',  // Target the 'product_cat' taxonomy
              'field' => 'slug',           // Use the category slug for comparison
              'terms' => array($selected_category), // Include the selected category slug
          ),
      );
  }

  // Return a new WC_Product_Query object based on the constructed arguments
  return new WC_Product_Query($args);
}

function get_filtered_products($products_query) {
  // Call the get_products() method of the WC_Product_Query object
  // to retrieve the filtered products based on the query parameters.
  return $products_query->get_products();
}



