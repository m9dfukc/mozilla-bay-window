<?php

function rename_default_category( $category ) {
  wp_update_term(1, 'category', array(
    'name' => $category,
    'slug' => strtolower($category),
    'description' => ''
  ));
}

function create_category( $category ) {
  if (file_exists (ABSPATH.'/wp-admin/includes/taxonomy.php')) {
    require_once (ABSPATH.'/wp-admin/includes/taxonomy.php');
    if ( ! category_exists( $category ) ) {
      wp_create_category( $category );
    }
  }
}

function plugin_activation( $plugin ) {
  if( ! function_exists('activate_plugin') ) {
    require_once ABSPATH . 'wp-admin/includes/plugin.php';
  }
  if( ! is_plugin_active( $plugin ) ) {
    activate_plugin( $plugin );
  }
}

// Activate acf plugin and delete default posts on theme activation
function setup_theme() {
  // delete the default comment, post and page
  wp_delete_comment( 1 );
  wp_delete_post( 1, TRUE );
  wp_delete_post( 2, TRUE );
  // activate acf && custom post order
  plugin_activation( 'advanced-custom-fields/acf.php' );
  plugin_activation( 'intuitive-custom-post-order/intuitive-custom-post-order.php' );
  // create our default categories
  create_category('Evening');
  create_category('Daytime');
}
add_action( 'after_setup_theme', 'setup_theme' );
