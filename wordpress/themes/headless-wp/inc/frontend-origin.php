<?php

/**
 * Placeholder function for determining the frontend origin.
 * @TODO Determine the headless client's URL based on the current environment.
 *
 * @return str Frontend origin URL, i.e., http://localhost:3000.
 */
function get_frontend_origin() {
	return WP_HOME;
}

/**
 * Enqueues scripts and styles.
 */
function my_scripts() {
	// Stylesheet
	wp_enqueue_style( 'styles', get_stylesheet_uri() );
	// Our Js
	wp_register_script( 'scripts', get_template_directory_uri() . '/assets/scripts.js', array( 'jquery' ) );
	wp_localize_script( 'scripts' , 'apiSettings', array(
		'root' => esc_url_raw( rest_url() ),
		'nonce' => wp_create_nonce( 'wp_rest' )
	) );
	wp_enqueue_script(  'scripts'  );
}
add_action( 'wp_enqueue_scripts', 'my_scripts' );


function gatekeeper() {
	if ( !is_user_logged_in() && $_SERVER['SCRIPT_NAME'] != '/wp-login.php') {
		wp_redirect(wp_login_url());
		die();
	}
}
add_action('init', 'gatekeeper');

function wp_canonical_hack_init() {
    remove_action( 'admin_head', 'wp_admin_canonical_url' );
}
add_action('init', 'wp_canonical_hack_init');
