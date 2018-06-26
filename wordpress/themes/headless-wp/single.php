<?php
/**
 * The template for displaying all single posts
 */
get_header(); ?>

<script type="text/javascript">
	<?php
	while ( have_posts() ) : the_post();
	$message = get_field('message');
	$message = str_replace(array("\r\n"), ' ', $message);
	$message = preg_replace('!\s+!', ' ', $message);
	echo "window.message='$message';\n";
	endwhile;
	?>
	var lines = window.message.split(' ') || [];
  var length = lines.length;
  lines.forEach((value) => {
    if (value.length > 5) length += 1
    else if (value.length > 10) length += 2
    else if (value.length > 15) length += 3
    else if (value.length > 20) length += 4
  });
  if (length > 5) {
		setTimeout(function() {
			jQuery(".Header nav a").hide();
			jQuery(".Header nav a.scroller").show();
		}, 800);
	}
</script>


<div class="wrap">
	<div id="primary" class="content-area">
		<div id="root"></div>
	</div>
</div>
<?php get_footer();
