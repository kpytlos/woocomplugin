<?php
/*include_once('price-component.php');

// Define shortcode function to display related products based on category
function related_products_shortcode($atts) {
    // Extract shortcode attributes, if any
    $atts = shortcode_atts(array(
        'count' => 6, // Default number of related products to display
    ), $atts, 'related_products');

    $product_id = get_the_ID();
    $categories = wp_get_post_terms($product_id, 'product_cat');

    // If product belongs to multiple categories, get the first one
    $category_id = !empty($categories) ? $categories[0]->term_id : 0;

    // Query for related products based on the category
    $related_products_args = array(
        'post_type' => 'product',
        'posts_per_page' => $atts['count'],
        'post_status' => 'publish',
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $category_id,
            ),
        ),
        'orderby' => 'rand', // Show random related products
        'exclude' => $product_id, // Exclude the current product
    );

    $related_products_query = new WP_Query($related_products_args);

    // Generate HTML for related products
    $output = '<div class="related-product-container">'; // Start the product container element
    if ($related_products_query->have_posts()) {
        while ($related_products_query->have_posts()) {
            $related_products_query->the_post();
            global $product;
            // Generate HTML for each related product
            $output .= '<div class="related-product-box">';
            $product_link = get_permalink($product->get_id());
            
            $output .= '<a href="' . $product_link . '" class="related-product-info-link">';
            $output .= '<div class="product-image-wrapper">';
            $output .= str_replace('<img ', '<img class="product-image" ', $product->get_image());
            $output .= '</div>';
            $output .= '<div class="details-button">See details</div>'; // Add the "See details" button
            $output .= '<h6>' . $product->get_name() . '</h6>'; 
            $output .= display_price($product->get_price(), is_a($product, 'WC_Product_Simple')); // Display the product price
            $output .= '</a>'; // Close anchor tag
            $output .= '</div>'; // End the individual product element
        }
        wp_reset_postdata(); // Reset post data
    } else {
        $output .= '<p>No related products found.</p>';
    }
    $output .= '</div>'; // End the product container element
    

    return $output;
}

// Register the shortcode
add_shortcode('related_products_321', 'related_products_shortcode');*/

// Define shortcode function to display related products based on category
function related_products_shortcode($atts) {
    // Extract shortcode attributes, if any
    $atts = shortcode_atts(array(
        'count' => 6, // Default number of related products to display
        'category' => '', // Default category
    ), $atts, 'related_products');

    // Get the category slug from the shortcode attribute
    $category_slug = sanitize_title($atts['category']);

    // Retrieve products filtered by category
    $products_query = filter_products_by_category($category_slug);

    // Get filtered products
    $products = get_filtered_products($products_query);

    // Generate HTML for related products
    $output = '<div class="related-product-container">'; // Start the product container element
    if ($products) {
        foreach ($products as $product) {
            // Generate HTML for each related product
            $product_link = get_permalink($product->get_id());
            $output .= '<div class="related-product-box">';
            $output .= '<a href="' . $product_link . '" class="related-product-info-link">';
            $output .= '<div class="product-image-wrapper">';
            $output .= str_replace('<img ', '<img class="product-image" ', $product->get_image());
            $output .= '</div>';
            $output .= '<div class="details-button">See details</div>'; // Add the "See details" button
            $output .= '<h6>' . $product->get_name() . '</h6>'; 
            $output .= display_price($product->get_price(), is_a($product, 'WC_Product_Simple')); // Display the product price
            $output .= '</a>'; // Close anchor tag
            $output .= '</div>'; // End the individual product element
        }
    } else {
        $output .= '<p>No related products found.</p>';
    }
    $output .= '</div>'; // End the product container element

    return $output;
}


// Register the shortcode
add_shortcode('related_products_321', 'related_products_shortcode');





