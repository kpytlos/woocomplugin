<?php

add_shortcode( 'related_products_yolo', 'get_related_products_shortcode' );

function get_related_products_shortcode( $atts ) {
    // Initialize output variable
    $output = '';

    // Get current product information
    $current_product = wc_get_product();

    // Check if a product is found
    if ( $current_product ) {
        $product_category_ids = wp_get_post_terms( $current_product->get_id(), 'product_cat', array( 'fields' => 'ids' ) );

        // Define arguments for related products query
        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'post__not_in' => array( $current_product->get_id() ), // Exclude current product
            'posts_per_page' => 4, // Adjust as needed
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'term_id',
                    'operator' => 'IN',
                    'terms' => $product_category_ids,
                )
            )
        );

        // Query related products
        $related_products = new WP_Query( $args );

        // Check if products are found
        if ( $related_products->have_posts() ) {
            $output .= '<div class="related-container">';
            $output .= '<div class="product-container">'; // Concatenating the opening div

            // Loop through products and display them
            while ( $related_products->have_posts() ) {
                $related_products->the_post();
                $product = wc_get_product(); // Get current product object inside the loop

                // Call the display_product function and append its output to $output
                $output .= single_product_display( $product );
            }

            $output .= '</div>'; // Closing product container div
            $output .= '</div>'; // Closing related container div
        }

        wp_reset_postdata();
    } else {
        $output = '<p>No related products found.</p>';
    }

    return $output;
}
