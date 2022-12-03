<div class="wrap">
	<h2><?php echo get_admin_page_title() ?></h2>
	<form action="options.php" method="POST">
		Automatically generating keys
		<input type="hidden" name="action" value="generate_keys">
		<?php
			submit_button();
		?>
	</form>

	<form action="options.php" method="POST">
		<?php
			settings_fields(WPCaptchaPuzzleConfigurer::CONFIG_SECTION);
			do_settings_sections(WPCaptchaPuzzleConfigurer::CONFIG_PAGE);
			submit_button();
		?>
	</form>
</div>
	