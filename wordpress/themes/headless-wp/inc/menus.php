<?php
// Remove Menus From Admin panel
function remove_menus() {
	remove_menu_page( 'edit.php?post_type=page' ); // Pages
	remove_menu_page( 'edit-comments.php' ); // Comments
	remove_menu_page( 'themes.php' ); // Appearance
	remove_menu_page( 'tools.php' ); //Tools
	remove_menu_page( 'options-permalink.php' ); // Permalinks
	remove_menu_page( 'options-discussion.php' ); // Discussion
	remove_menu_page( 'options-reading.php' ); // Reading
	remove_menu_page( 'edit.php?post_type=acf-field-group' ); // Reading
}
// add_action( 'admin_menu', 'remove_menus' );
