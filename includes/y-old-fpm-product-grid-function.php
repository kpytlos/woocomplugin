<?php

//This one was the first version

// Define function to get all WooCommerce products
/* get_all_woocommerce_products() {
    // Create an instance of WC_Product_Query
    $args = array(
        'limit' => -1, // Get all products
    );
    $products_query = new WC_Product_Query( $args );

    // Get products
    $products = $products_query->get_products();

    // Check if products exist
    if ( $products ) {
        // Start product container
        $output = '<div class="product-container">';

        // Loop through each product
        foreach ( $products as $product ) {
            // Get product data
            $product_title = $product->get_name();
            $product_price = $product->get_price();
            $product_image = $product->get_image(); // By default, get the thumbnail image

            // Build HTML markup for each product
            $output .= '<div class="product">';
            $output .= '<p><b>Title:</b> ' . $product_title . '</p>';
            $output .= '<p><b>Price:</b> ' . wc_price( $product_price ) . '</p>'; // Format price
            $output .= '<p><b>Image:</b> ' . $product_image . '</p>';
            $output .= '</div>';
        }

        // End product container
        $output .= '</div>';

        // Return the HTML output
        return $output;
    } else {
        // No products found
        return 'No products found.';
    }
}

// Call the function to display all products using a shortcode
add_shortcode( 'get_all_products_plugin', 'get_all_woocommerce_products' );*/


// NEEEEEEEEEEWWWWWW


// Define function to get all WooCommerce products
/*function get_all_woocommerce_products( $selected_category = '' ) {
  // Create an instance of WC_Product_Query
  $args = array(
    'limit' => -1, // Get all products
  );
  $products_query = new WC_Product_Query($args);

  // Get products
  $products = $products_query->get_products();

  // Check if products exist
  if ($products) {
    // Start product container
    $output = '<div class="product-container">';

    // Loop through each product
    foreach ($products as $product) {
      // Get product data
      $product_title = $product->get_name();
      $product_price = $product->get_price();
      $product_image = $product->get_image(); // By default, get the thumbnail image

      // Build HTML markup for each product
      $output .= '<div class="product">';
      $output .= '<p><b>Title:</b> ' . $product_title . '</p>';
      $output .= '<p><b>Price:</b> ' . wc_price($product_price) . '</p>'; // Format price
      $output .= '<p><b>Image:</b> ' . $product_image . '</p>';
      $output .= '</div>';
    }

    // End product container
    $output .= '</div>';

    // Return the HTML output
    return $output;
  } else {
    // No products found
    return 'No products found.';
  }
}

// **New: Register a hook to listen for product filter changes**
add_action( 'product_filter_changed', 'get_all_woocommerce_products_on_filter_change' );

// **New: Function to update and display products based on filter selection**
function get_all_woocommerce_products_on_filter_change( $selected_category = '' ) {
  global $args; // Access the global product query arguments

  $args = array(
    'limit' => -1, // Get all products
  );

  if ( !empty( $selected_category ) ) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => 'product_cat',
        'field' => 'slug',
        'terms' => $selected_category,
      ),
    );
  }

  // Call the existing function to display filtered products
  echo get_all_woocommerce_products();
}*/


// try with integration

/*function get_all_woocommerce_products( $category_slug = '' ) {
  // Create an instance of WC_Product_Query
  $args = array(
    'limit' => -1, // Get all products
  );

  // Check if category slug is provided
  if ( !empty( $category_slug ) ) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => 'product_cat',
        'field' => 'slug',
        'terms' => $category_slug,
      ),
    );
  }

  $products_query = new WC_Product_Query($args);

  // Get products
  $products = $products_query->get_products();

  // Check if products exist
  if ($products) {
    // Start product container
    $output = '<div class="product-container">';

    // Loop through each product
    foreach ($products as $product) {
      // Get product data
      $product_title = $product->get_name();
      $product_price = $product->get_price();
      $product_image = $product->get_image(); // By default, get the thumbnail image

      // Build HTML markup for each product
      $output .= '<div class="product">';
      $output .= '<p><b>Title:</b> ' . $product_title . '</p>';
      $output .= '<p><b>Price:</b> ' . wc_price($product_price) . '</p>'; // Format price
      $output .= '<p><b>Image:</b> ' . $product_image . '</p>';
      $output .= '</div>';
    }

    // End product container
    $output .= '</div>';

    // Return the HTML output
    return $output;
  } else {
    // No products found
    return 'No products found.';
  }
}*/


//NEEEWWW works interesting just the filter no

// Step 1: Display the Filter
/*function display_category_filter() {
    // Get all product categories
    $product_categories = get_terms(array(
        'taxonomy' => 'product_cat',
        'hide_empty' => true,
    ));

    // Display the filter HTML
    if ($product_categories) {
        echo '<div class="category-filter">';
        echo '<select id="category-select">';
        echo '<option value="">All Categories</option>'; // Option for all categories
        foreach ($product_categories as $category) {
            echo '<option value="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</option>';
        }
        echo '</select>';
        echo '</div>';
    }
}

// Step 2: Handle Category Selection with JavaScript
function handle_category_selection() {
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var categorySelect = document.getElementById('category-select');
            if (categorySelect) {
                categorySelect.addEventListener('change', function () {
                    var selectedCategory = this.value;
                    // Reload the page with the selected category as a query parameter
                    window.location.href = '<?php echo esc_url(home_url('/')); ?>?product_category=' + selectedCategory;
                });
            }
        });
    </script>
    <?php
}

// Step 3: Update the Shortcode Function to Accept Category Parameter
function get_all_woocommerce_products_shortcode($atts) {
    $category = isset($_GET['product_category']) ? sanitize_text_field($_GET['product_category']) : '';

    // Create an instance of WC_Product_Query
    $args = array(
        'limit' => -1, // Get all products
    );

    // If a category is specified, add it to the query arguments
    if (!empty($category)) {
        $args['category'] = $category;
    }

    $products_query = new WC_Product_Query($args);

    // Get products
    $products = $products_query->get_products();

    // Check if products exist
    if ($products) {
        // Start product container
        $output = '<div class="product-container">';

        // Loop through each product
        foreach ($products as $product) {
            // Get product data
            $product_title = $product->get_name();
            $product_price = $product->get_price();
            $product_image = $product->get_image(); // By default, get the thumbnail image

            // Build HTML markup for each product
            $output .= '<div class="product">';
            $output .= '<p><b>Title:</b> ' . $product_title . '</p>';
            $output .= '<p><b>Price:</b> ' . wc_price($product_price) . '</p>'; // Format price
            $output .= '<p><b>Image:</b> ' . $product_image . '</p>';
            $output .= '</div>';
        }

        // End product container
        $output .= '</div>';

        // Return the HTML output
        return $output;
    } else {
        // No products found
        return 'No products found.';
    }
}

// Register the shortcode for displaying all products
add_shortcode('all_products_plugin', 'get_all_woocommerce_products_shortcode');

// Add the filter and JavaScript to the top of the page
add_action('wp_head', 'display_category_filter');
add_action('wp_footer', 'handle_category_selection');*/


// another NEEEEW THE PERFECT ONE!!

/*function get_all_woocommerce_products_shortcode($atts) {
  // Get all product categories
  $product_categories = get_terms(array(
    'taxonomy' => 'product_cat',
    'hide_empty' => true,
  ));

  // Start building the output
  $output = '';

  // Display the product categories
  if ($product_categories) {
    $output .= '<div class="product-categories">';
    $output .= '<ul>';
    foreach ($product_categories as $category) {
      $active_class = ''; // Initialize active class for styling

      // Check if the current category is selected
      $current_category_slug = $category->slug;
      $selected_category = isset($_GET['product_cat']) ? $_GET['product_cat'] : '';

      if ($selected_category && $selected_category === $current_category_slug) {
        $active_class = ' class="active"'; // Set active class if selected
      }

      // Construct the category link using the current page URL
      $category_link = add_query_arg(
        array('product_cat' => $current_category_slug),
        get_permalink() // Use current page URL
      );

      $output .= '<li' . $active_class . '><a href="' . esc_url($category_link) . '">' . esc_html($category->name) . '</a></li>';
    }
    $output .= '</ul>';
    $output .= '</div>';
  }

  // Create an instance of WC_Product_Query with category filter
  $args = array(
    'limit' => -1, // Get all products
  );

  // Check if a category is selected
  $selected_category = isset($_GET['product_cat']) ? $_GET['product_cat'] : '';

  if ($selected_category) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => 'product_cat',
        'field' => 'slug',
        'terms' => array($selected_category),
      ),
    );
  }

  $products_query = new WC_Product_Query($args);

  // Get products
  $products = $products_query->get_products();

  // Check if products exist
  if ($products) {
    // Start product container
    $output .= '<div class="product-container">';

    // Loop through each product
    foreach ($products as $product) {
      // Get product data
      $product_title = $product->get_name();
      $product_price = $product->get_price();
      $product_image = $product->get_image(); // By default, get the thumbnail image

      // Build HTML markup for each product
      $output .= '<div class="product">';
      $output .= '<p><b>Title:</b> ' . $product_title . '</p>';
      $output .= '<p><b>Price:</b> ' . wc_price($product_price) . '</p>'; // Format price
      $output .= '<p><b>Image:</b> ' . $product_image . '</p>';
      $output .= '</div>';
    }

    // End product container
    $output .= '</div>';
  } else {
    // No products found
    $output .= '<p>No products found in this category.</p>';
  }

  // Return the output
  return $output;
}

// Register the shortcode for displaying all products
add_shortcode('all_products_myplugin3', 'get_all_woocommerce_products_shortcode');*/

//Now try with scalability




