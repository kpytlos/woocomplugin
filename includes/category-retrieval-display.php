<?php

function get_product_categories() {
  $categories = get_terms(array(
      'taxonomy' => 'product_cat',
      'hide_empty' => true,
  ));

  // Add a custom "All" category
  $all_category = new stdClass();
  $all_category->slug = 'all';
  $all_category->name = 'All';
  array_unshift($categories, $all_category);

  return $categories;
}

function display_product_categories($categories) {
  if ($categories) {
      $output = ''; // Initialize an empty string to store the generated HTML

      // Create a container element for the category list
      $output .= '<div class="product-categories">';

      // Create an unordered list element to hold the individual categories
      $output .= '<ul class="categories-yo">';

      // Loop through each category object in the provided array
      foreach ($categories as $category) {
          // Initialize an empty string for the active class
          $active_class = '';

          // Get the current category slug for comparison
          $current_category_slug = $category->slug;

          // Check if a category is selected from the URL parameter
          $selected_category = isset($_GET['product_cat']) ? $_GET['product_cat'] : '';

          // Check if the current category matches the selected one or if it's the "All" category
          if (($selected_category && $selected_category === $current_category_slug) || (!$selected_category && $current_category_slug === 'all')) {
              // Add the 'active' class to the list item if the category is selected or if it's the "All" category
              $active_class = ' class="active"';
          }

          // Construct the category link using the current permalink and adding the 'product_cat' parameter with the category slug
          $category_link = add_query_arg(
              array('product_cat' => $current_category_slug),
              get_permalink()
          );

          // Escape the URL for security purposes
          $category_link = esc_url($category_link);

          // Escape the category name for security purposes (prevent XSS)
          $category_name = esc_html($category->name);

          // Build the list item with the category name and link
          $output .= '<li' . $active_class . '><a href="' . $category_link . '">' . $category_name . '</a></li>';
      }

      // Close the unordered list and the container element
      $output .= '</ul>';
      $output .= '</div>';

      // Return the generated HTML string
      return $output;
  } else {
      // If no categories are found, return an empty string
      return '';
  }
}
