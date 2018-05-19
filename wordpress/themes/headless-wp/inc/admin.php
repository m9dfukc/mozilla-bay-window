<?php
/**
 * By default, in Add/Edit Post, WordPress moves checked categories to the top of the list, and unchecked to the bottom.
 * When you have subcategories that you want to keep below their parents at all times, this makes no sense.
 * This function removes that automatic reordering so the categories widget retains its order regardless of checked state.
 * Thanks to https://stackoverflow.com/a/12586404
 */
function taxonomy_checklist_checked_ontop_filter ( $args ) {
	$args['checked_ontop'] = false;
	return $args;
}
add_filter( 'wp_terms_checklist_args', 'taxonomy_checklist_checked_ontop_filter' );


function remove_logo() {
	?>
		<style type="text/css">
    		.login h1 a {
				background: url(data:image/jpeg;base64,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)
				no-repeat
    			left center !important;
				width: 300px !important;
				margin: 0 0 20px 28px !important;
				padding: 0 !important;
			}
		</style>
	<?php
}
add_action( 'login_enqueue_scripts', 'remove_logo' );

function my_admin_style() {
	?>
	    <style type="text/css">
			@font-face {
			  font-family: BickertonDisplay;
			  src: url("<?php echo get_template_directory_uri(); ?>/assets/180502-BickertonDisplay-Regular.otf") format("opentype");
			}

			#category-1 { display: none!important; }

   		#wp-admin-bar-open-website {
	   		display: none;
   		}
		  .post-php #wp-admin-bar-open-website {
	    	display: block;
	    }
			.acf-postbox #message {
				width: 460px;
			}
			.acf-postbox #message textarea{
				font-size: 160px;
				line-height: 1em;
				font-family: BickertonDisplay;
			}
	    </style>
  <?php
}
add_action('admin_enqueue_scripts', 'my_admin_style');

add_action('admin_bar_menu', 'add_toolbar_items', 100);
function add_toolbar_items($admin_bar) {
	global $post;
	$admin_bar->add_menu( array(
        'id'     => 'show-posts',
        'title'  => 'All Posts',
        'href'   => '/wp-admin/edit.php'
    ));
	if (function_exists('get_field')) {
	    $admin_bar->add_menu( array(
	        'id'     => 'open-website',
	        'title'  => 'Open Website',
	        'href'   => get_field('url', $post->ID),
			'meta'  => array(
				'target' => '_blank'
			)
	    ));
	}
	$admin_bar->remove_node('wp-logo');
	$admin_bar->remove_node('customize');
	$admin_bar->remove_node('site-name');
	$admin_bar->remove_node('comments');
	$admin_bar->remove_node('search');
}

function my_acf_enqueue_scripts() {
	wp_register_script( 'acfjs', get_template_directory_uri() . '/assets/admin.js', array( 'jquery', 'alphanum') );
	wp_localize_script( 'acfjs' , 'apiSettings', array(
		'root' => esc_url_raw( rest_url() ),
		'nonce' => wp_create_nonce( 'wp_rest' )
	) );
	wp_enqueue_script( 'acfjs' );
}
add_action('acf/input/admin_enqueue_scripts', 'my_acf_enqueue_scripts');


function set_default_categories($post_id) {
	// If this is a revision, get real post ID
	if ( $parent_id = wp_is_post_revision( $post_id ) )	$post_id = $parent_id;
	$all_cat = get_categories(array('hide_empty' => 0));

	if (isset($_POST['post_category'])) {
		$post_cat = $_POST['post_category'];
		if (
			( count($post_cat) == 1 && $post_cat[0] == 0 ) ||
			( count($post_cat) == 2 && $post_cat[0] == 0 && $post_cat[1] == 1 ) ||
			( count($post_cat) == (count($all_cat) + 1) && in_array(0, $post_cat) && in_array(1, $post_cat))
	  ) {
			$ids = array();
			foreach ($all_cat as $categories) {
				if ($categories->cat_ID != 1) $ids[] = $categories->cat_ID;
			}
			wp_set_post_categories($post_id, $ids);
		}
	}
}
add_action( 'save_post', 'set_default_categories' );
