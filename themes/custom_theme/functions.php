<?php



function project_files() {
    
    wp_enqueue_style('bootstrap.min', get_stylesheet_directory_uri() . '/css_5/bootstrap.min.css');
    wp_enqueue_script('bootstrap.min', get_stylesheet_directory_uri() . '/js_5/bootstrap.min.js');

    // Enqueue your custom CSS file
    wp_enqueue_style('custom-css', get_stylesheet_directory_uri() . '/customCSS.css');
}
add_action('wp_enqueue_scripts', 'project_files', 1);

function register_my_menus() {
    register_nav_menus(
        array(
            'header-menu' => __('Header Menu'),
            // You can define additional menu locations here
        )
    );
}
add_action('init', 'register_my_menus');

function enqueue_custom_scripts() {
    // Enqueue your custom JavaScript file
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/js/custom.js');
}

// Hook the function to the 'wp_enqueue_scripts' action
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');



function display_custom_page_data() {
    if (is_page(7)) {
        echo "<h1>yolonalle</h1>";
    }
}

// Execute the function on template_redirect
add_action('template_include', 'display_custom_page_data');


