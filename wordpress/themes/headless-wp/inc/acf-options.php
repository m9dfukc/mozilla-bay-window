<?php
// Enable ACF 5 early access
define('ACF_EARLY_ACCESS', '5');

function my_acf_input_admin_footer() {
?>
<script type="text/javascript">
(function($) {

  function clean(text) {
    var message = text;
    message = message.replace(/\s\s+/g, ' ');
    message = message.replace(/ /g, "\r\n");
    return message.substring(0, 60);
  }
  var $textarea = $('.acf-input textarea');
  var $title = $("#title");
  var message = $title.val();
	$textarea.attr('readonly', true);
  $textarea.text(clean(message));
  $title.on('keyup', function() {
    var message = clean($(this).val());
    $textarea.text(message);
  });
})(jQuery);
</script>
<?php
}
add_action('acf/input/admin_footer', 'my_acf_input_admin_footer');
