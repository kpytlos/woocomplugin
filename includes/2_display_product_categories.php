<?php

function display_product_categories($categories) {
  if ($categories) {
      $output = ''; // Initialize an empty string to store the generated HTML
      $output .= '<div class="product-categories-list">'; // Create a container element for the category list
      $output .= '<ul class="categories-yo">'; // Create an unordered list element to hold the individual categories

      
      foreach ($categories as $category) { // Loop through each category object in the provided array
          $active_class = '';// Initialize an empty string for the active class
        $current_category_slug = $category->slug; // Get the current category slug for comparison
        $selected_category = isset($_GET['product_cat']) ? $_GET['product_cat'] : ''; // Check if a category is selected from the URL parameter 
          if (($selected_category && $selected_category === $current_category_slug) || (!$selected_category && $current_category_slug === 'all')) { // Check if the current category matches the selected one or if it's the "All" category
              $active_class = ' class="active"'; // Add the 'active' class to the list item if the category is selected or if it's the "All" category
          }
          $category_link = add_query_arg( // Construct the category link using the current permalink and adding the 'product_cat' parameter with the category slug
              array('product_cat' => $current_category_slug),
              get_permalink()
          );

          $category_link = esc_url($category_link); // Escape the URL for security purposes
          $category_name = esc_html($category->name); // Escape the category name for security purposes (prevent XSS)
          $output .= '<li' . $active_class . '><a href="' . $category_link . '">' . $category_name . '</a></li>'; // Build the list item with the category name and link
      }

      $output .= '</ul>'; // Close the unordered list and the container element
      $output .= '</div>';

      return $output; // Return the generated HTML string
  } else {
      return ''; // If no categories are found, return an empty string
  }
}
