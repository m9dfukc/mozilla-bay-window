<?php
// Theme setup
require_once( 'inc/setup.php' );

// CORS handling
require_once( 'inc/cors.php' );

// Frontend origin
require_once( 'inc/frontend-origin.php' );

// Activate Basic Auth
require_once( 'inc/basic-auth.php' );

// ACF commands
require_once( 'inc/class-acf-commands.php' );

// Admin modifications
require_once( 'inc/admin.php' );

// Add Menus
require_once( 'inc/menus.php' );

// Add Headless Settings area
require_once( 'inc/acf-options.php' );

// Add custom API endpoints
require_once( 'inc/api-routes.php' );
