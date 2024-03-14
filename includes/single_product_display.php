<?php

include_once('price-component.php');

function single_product_display($product) {
    $product_title = $product->get_name(); // Get the product title
    $product_price = $product->get_price(); // Get the product price
    $product_image = $product->get_image(); // Get the product image (default is thumbnail)
    $product_link = get_permalink($product->get_id());

    // Check for single price
    $has_single_price = is_a($product, 'WC_Product_Simple'); // Check if product is a simple product

    $output = '<div class="product-box">';
    $output .= '<a href="' . $product_link . '" class="product-info-link">';
    $output .= '<div class="product-image-wrapper">';
    $output .= str_replace('<img ', '<img class="product-image" ', $product_image);
    $output .= '<div class="details-button">See details</div>'; // Add the "See details" button
    $output .= '</div>';
    $output .= '<h6>' . $product_title . '</h6>'; 
    $output .= display_price($product_price, $has_single_price); // Display the product price
    // ... add more information or interactive elements if needed
    $output .= '</a>'; // Close anchor tag
    $output .= '</div>'; // End the individual product element

    return $output;
}
