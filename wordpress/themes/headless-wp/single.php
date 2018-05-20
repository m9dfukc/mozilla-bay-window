<?php
/**
 * The template for displaying all single posts
 */
get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<div class="inner">
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
			echo nl2br(get_field('message'));
			endwhile; // End of the loop.
			?>
		</div>
	</div><!-- #primary -->
</div><!-- .wrap -->
<script type="text/javascript">
var $ = jQuery;

function animate() {
	var displayHeight = $("#primary").height();
	var totalHeight = $(".inner").height();
	var lineHeight = 105;
	if (totalHeight > displayHeight) {
		var diff = totalHeight - displayHeight;
		var steps = Math.ceil(diff / lineHeight);
		for(let i=0; i <= steps; i++) {
			var time = i == 0 ? 850 : i * 100 + 850;
			$(".inner")
				.delay(time)
				.queue(function (next) {
					var position = -1 * i * lineHeight;
	    		$(this).css('top', position);
	    		next();
	  		});
		}
		setTimeout( animate, steps * 200 + 6000);
	}
}
animate();
</script>
<?php get_footer();
