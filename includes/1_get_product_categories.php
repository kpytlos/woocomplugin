<?php

//It gets all the categories and stores them in a variable categories

function get_product_categories() {
    $categories_all = get_terms(array(
        'taxonomy' => 'product_cat',
        'hide_empty' => true,
    ));

    if (is_wp_error($categories_all)) {
        // Handle error
        // Example: return an empty array
        return array();
    }

    // Add a custom "All" category
    $all_category = new stdClass();
    $all_category->slug = 'all';
    $all_category->name = 'All';
    array_unshift($categories_all, $all_category);

    return $categories_all;
}
