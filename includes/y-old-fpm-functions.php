<?php
/*
 * Add my new menu to the Admin Control Panel
 */
// Hook the 'admin_menu' action hook, run the function named 'mfp_Add_My_Admin_Link()'
add_action( 'admin_menu', 'mfp_Add_My_Admin_Link' );
// Add a new top level menu link to the ACP
function mfp_Add_My_Admin_Link()
{
      add_menu_page(
        'My First Page', // Title of the page
        'My First Plugin', // Text to show on the menu link
        'manage_options', // Capability requirement to see the link
        'includes/fpm-first-acp-page.php' // The 'slug' - file to display when clicking the link
    );
}
//Yooo

/*add_action( 'woocommerce_before_shop_loop', 'wk_custom_product_filter_by_category' );

function wk_custom_product_filter_by_category() {
    global $wp_query;
    $product_categories = get_terms( array(
        'taxonomy' => 'product_cat',
        'hide_empty' => true,
    ) );
    ?>
    <div class="category_filter_form_container">
    <form id="category_filter_form" method="get">
        <a href="<?php echo esc_url( remove_query_arg( 'product_category' ) ); ?>" class="category-link <?php echo !isset($_GET['product_category']) ? 'selected' : ''; ?>">All</a>
        <input type="hidden" name="post_type" value="product" /> <?php foreach( $product_categories as $category ) : ?>
            <a href="<?php echo esc_url( add_query_arg( array( 'product_category' => $category->slug ) ) ); ?>" class="category-link <?php echo isset($_GET['product_category']) && $_GET['product_category'] === $category->slug ? 'selected' : ''; ?>"><?php echo esc_html( $category->name ); ?></a>
            <?php endforeach; ?>
            </form>
            </div>
    <?php
}

add_filter( 'pre_get_posts', 'wk_custom_product_filter_query_by_category' );

function wk_custom_product_filter_query_by_category( $query ) {
    if( ! is_admin() && $query->is_main_query() && is_shop() && isset( $_GET['product_category'] ) && ! empty( $_GET['product_category'] ) ) {
        $product_category = sanitize_text_field( $_GET['product_category'] );
        $tax_query = array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $product_category,
            ),
        );
        $query->set( 'tax_query', $tax_query );
    }
    return $query;
}*/



// NEEEEEEEWWWWW this is working in case

/*function product_filter_shortcode() {
  ob_start(); // Start output buffering

  // Get product categories
  $product_categories = get_terms(array(
    'taxonomy' => 'product_cat',
    'hide_empty' => true,
  ));

  // Check if any categories exist
  if ($product_categories) {
    echo '<div class="category_filter_form_container">';
    echo '<form id="category_filter_form" method="get">';
    
    // All category link
    echo '<a href="' . esc_url( remove_query_arg('product_category') ) . '" class="category-link ' . (!isset($_GET['product_category']) ? 'selected' : '') . '">All</a>';

    // Hidden input for post type
    echo '<input type="hidden" name="post_type" value="product" />';

    // Loop through categories and display links
    foreach ($product_categories as $category) {
      $selected_class = (isset($_GET['product_category']) && $_GET['product_category'] === $category->slug) ? 'selected' : '';
      echo '<a href="' . esc_url(add_query_arg(array('product_category' => $category->slug))) . '" class="category-link ' . $selected_class . '">' . esc_html($category->name) . '</a>';
    }

    echo '</form>';
    echo '</div>';
  }

  $output = ob_get_contents(); // Get the buffered output
  ob_end_clean(); // Clean the buffer

  return $output;
}

// Register the shortcode
add_shortcode('product_filter_plugin', 'product_filter_shortcode');*/


// Second try working too

// **1. Register the shortcode**
/*add_shortcode( 'get_all_filtered_products', 'get_all_woocommerce_products' );

function product_filter_shortcode() {
  ob_start(); // Start output buffering

  // Get product categories
  $product_categories = get_terms(array(
    'taxonomy' => 'product_cat',
    'hide_empty' => true,
  ));

  // Check if any categories exist
  if ($product_categories) {
    echo '<div class="category_filter_form_container">';
    echo '<form id="category_filter_form" method="get">';

    // All category link
    echo '<a href="' . esc_url( remove_query_arg('product_category') ) . '" class="category-link ' . (!isset($_GET['product_category']) ? 'selected' : '') . '">All</a>';

    // Hidden input for post type
    echo '<input type="hidden" name="post_type" value="product" />';

    // Loop through categories and display links
    foreach ($product_categories as $category) {
      $selected_class = (isset($_GET['product_category']) && $_GET['product_category'] === $category->slug) ? 'selected' : '';
      echo '<a href="' . esc_url(add_query_arg(array('product_category' => $category->slug))) . '" class="category-link ' . $selected_class . '">' . esc_html($category->name) . '</a>';
    }

    echo '</form>';
    echo '</div>';
  }

  $output = ob_get_contents(); // Get the buffered output
  ob_end_clean(); // Clean the buffer

  return $output;
}

// **2. Trigger product filter changed event on form submission**
add_action( 'wp_ajax_nopriv_category_filter_form', 'trigger_product_filter_changed' );

// **3. Function to trigger the event with the selected category**
function trigger_product_filter_changed() {
  $selected_category = isset( $_GET['product_category'] ) ? sanitize_text_field( $_GET['product_category'] ) : '';
  do_action( 'product_filter_changed', $selected_category ); // Pass selected category as argument
}*/



// another with JS


/*function product_filter_shortcode() {
    ob_start(); // Start output buffering

    // Get product categories
    $product_categories = get_terms(array(
        'taxonomy' => 'product_cat',
        'hide_empty' => true,
    ));

    // Check if any categories exist
    if ($product_categories) {
        echo '<div class="category_filter_form_container">';
        echo '<form id="category_filter_form" method="get">';

        // All category link
        echo '<a href="' . esc_url(remove_query_arg('product_category')) . '" class="category-link ' . (!isset($_GET['product_category']) ? 'selected' : '') . '">All</a>';

        // Loop through categories and display links
        foreach ($product_categories as $category) {
            $selected_class = (isset($_GET['product_category']) && $_GET['product_category'] === $category->slug) ? 'selected' : '';
            echo '<a href="' . esc_url(add_query_arg(array('product_category' => $category->slug))) . '" class="category-link ' . $selected_class . '">' . esc_html($category->name) . '</a>';
        }

        echo '</form>';
        echo '</div>';
    }

    ?>
    <script>
    jQuery(document).ready(function($) {
        // Load products based on selected category
        function loadProducts(category) {
            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'POST',
                data: {
                    action: 'get_products_by_category', // AJAX action hook
                    category: category // Selected category
                },
                success: function(response) {
                    $('.product-container').html(response); // Replace products with AJAX response
                }
            });
        }

        // Initial load: load all products
        loadProducts('');

        // Listen for clicks on category links
        $('#category_filter_form .category-link').on('click', function(e) {
            e.preventDefault(); // Prevent default link behavior

            var category = $(this).attr('href').split('product_category=')[1]; // Get selected category

            // Load products based on selected category
            loadProducts(category);
        });
    });
    </script>
    <?php

    $output = ob_get_clean(); // Get the buffered output and clean the buffer

    return $output;
}*/




