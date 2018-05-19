<?php
/**
 * Register custom REST API routes.
 */
add_action( 'rest_api_init', function () {
	// Register routes
	register_rest_route( 'sites', '/v1', array(
		'methods'  => 'GET',
		'callback' => 'rest_get_sites',
		'args' => array('city')
	) );
	register_rest_route( 'inspect', '/v1', array(
		'methods'  => 'GET',
		'callback' => 'rest_inspect_website',
		'args' => array('url', 'elements', 'width', 'height')
	) );
	register_rest_route( 'validateurl', '/v1', array(
		'methods'  => 'GET',
		'callback' => 'rest_validate_domain',
		'args' => array('url')
	) );
});

function rest_get_sites(WP_REST_Request $request) {
	$output = $cache = array();
	$meta = wp_upload_dir();
	$city = $request->get_param('city');
	$posts = get_posts(array(
		'posts_per_page' => 99999,
		'category_name' => $city
	));
	foreach($posts as $post) {
		setup_postdata($post);
		$categories = get_the_category($post->ID);
		$cities = trim(array_reduce($categories, function ($string, $category) {
			$string .= $category->slug . ' ';
			return $string;
		}, ''));
		$image_url = get_field('figure', $post->ID);
		$image_path = str_replace($meta['baseurl'], $meta['basedir'], $image_url);
		$cache[$image_path] = $cache[$image_path]
			? $cache[$image_path]
			: 'data:image/png;base64, ' . base64_encode(file_get_contents($image_path));
		$row = array(
			'domain' => get_field('domain', $post->ID) . '&id=' . $post->ID,
			'cities' => $cities,
			'url' => get_field('url', $post->ID),
			'elements' => _cleanupElements(get_field('elements', $post->ID)),
			'figure' => $cache[$image_path],
			'figure_hash' => md5($image_path)
		);
		$output[] = $row;
	}
	return $output;
}

function rest_inspect_website(WP_REST_Request $request) {
	$endpoint = '/inspect';
	$host = getenv('API_HOST') ? getenv('API_HOST') : 'http://nodejs:3030';
	$website = $request->get_param('url');
	$width = $request->get_param('width') ? $request->get_param('width') : 1920;
	$height = $request->get_param('height') ? $request->get_param('height') : 6000;
	$elements = $request->get_param('elements') ? $request->get_param('elements') : '';
	$selector = urlencode($elements);
	$url = $host . $endpoint . '/' . $website . '?deviceHeight=' . $height . '&deviceWidth=' . $width . '&selector=' . $selector;
	$response = wp_remote_get($url, array('timeout' => 30));
	if ( is_array( $response ) && $response['response']['code'] == 200 ) {
  		return json_decode($response['body']);
	} else {
		return new WP_Error( 'rest_get_elements', 'issue loading this website', array( 'status' => 500 ) );
	}
}

function rest_validate_domain(WP_REST_Request $request) {
	$url = urldecode($request->get_param('url'));
	$response['valid'] = false;
	$response['url'] = $url;
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_NOBODY, true);
	$result = curl_exec($curl);
	if ($result !== false) {
	  	$statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	  	if ($statusCode == 404 || $statusCode == 500) {
	    	$response['valid'] = false;
		} else {
			$response['valid'] = true;
		}
	} else {
	  $response['valid'] = false;
	}
	return $response;
}

function _cleanupElements($elements) {
	$elements = str_replace(array("\n", ",,"), array(",", ","), $elements);
	$elements = trim(trim($elements, ","));
	return $elements;
}
