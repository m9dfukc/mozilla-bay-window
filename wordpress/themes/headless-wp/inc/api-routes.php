<?php
/**
 * Register custom REST API routes.
 */
add_action( 'rest_api_init', function () {
	// Register routes
	register_rest_route( 'messages', '/v1', array(
		'methods'  => 'GET',
		'callback' => 'rest_get_messages'
	) );
});

function rest_get_messages(WP_REST_Request $request) {
	$output = $cache = array();
	$posts = get_posts(array(
		'posts_per_page' => 99999
	));
	foreach($posts as $post) {
		setup_postdata($post);
		$categories = get_the_category($post->ID);
		$terms = array_map(function ($category) {
			return $category->slug;
		}, $categories);
		$message = get_field('message', $post->ID);
		$message = str_replace(array("\r\n"), ' ', $message);
		$message = preg_replace('!\s+!', ' ', $message);
		$row = array(
			'id' => $post->ID,
			'title' => $post->post_title,
			'message' => $message,
			'periods' => $terms
		);
		$output[] = $row;
	}
	return $output;
}
