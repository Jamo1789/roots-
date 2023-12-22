<?php

function university_post_types() {

  // Staff Post Type
  register_post_type('staff', array(
    'show_in_rest' => true,
    'supports' => array('title', 'editor'),
    'public' => true,
    'labels' => array(
      'name' => 'staff',
      'add_new_item' => 'Add New Staff',
      'edit_item' => 'Edit Staff',
      'all_items' => 'All Staff',
      'singular_name' => 'Staff'
    ),
    'menu_icon' => 'dashicons-admin-users'
  ));
}

add_action('init', 'university_post_types');