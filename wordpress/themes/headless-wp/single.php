<?php
/**
 * The template for displaying all single posts
 */
get_header(); ?>

<div class="wrap">
	<div id="loader-wrapper">
		<div id="loader"></div>
		<div id="error-msg">
			<b>Something went wrong!</b><br>
			<span class="msg"></span>
		</div>
		<div class="loader-section section-left"></div>
		<div class="loader-section section-right"></div>
	</div>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
			/* Start the Loop */
			$data = array();
            $meta = wp_upload_dir();
			while ( have_posts() ) : the_post();
                $image_url = get_field('figure');
                $image_path = str_replace($meta['baseurl'], $meta['basedir'], $image_url);
                $image_blob = 'data:image/png;base64, ' . base64_encode(file_get_contents($image_path));
				$url = get_field('url');
				$elements = explode(PHP_EOL, trim(get_field('elements')));
				foreach ($elements as $key => $value) {
					$elements[$key] = trim(trim($value, ","));
				}
				$elements = trim(implode(",", $elements), ",");
                $data = array(
					'elements' => urlencode($elements),
                    'url' => $url,
                    'figure' => $image_blob
                );
			endwhile; // End of the loop.
			?>
			<script type="text/javascript">
				let data = <?= json_encode($data) ?>;
				data.image = new Image();
				data.image.src = data.figure;
			</script>
			<div id="canvas"></div>
			<div id="website">
				<div class="screenshot"></div>
				<div class="elements"></div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
