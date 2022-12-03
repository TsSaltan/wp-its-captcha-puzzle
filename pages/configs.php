<?php global $captchaPuzzle; ?>
<div class="wrap">
	<h2><?php echo get_admin_page_title() ?></h2>
	<form action="options.php" method="POST">
		<?php
			settings_fields(WPCaptchaPuzzleConfigurer::CONFIG_SECTION);
			do_settings_sections(WPCaptchaPuzzleConfigurer::CONFIG_PAGE);
			submit_button();
		?>
	</form>

	<form action="options.php" method="POST">
		<p>You can register at <a href="https://dev.tssaltan.top/login" target="_blank">dev.tssaltan.top</a> and generate API keys on your own. Or click at button for generating keys automatically.</p>
		<input type="hidden" name="action" value="generate_its_keys">
		<?php
			submit_button('Generate API keys', 'default');
		?>
	</form>

	<?php if($captchaPuzzle->isInstalled()): ?>
	<form action="options.php" method="POST">
		<input type="hidden" name="action" value="testing_its_keys">
		<?php
			submit_button('Testing API keys', 'default');
		?>
	</form>
	<?php endif; ?>
</div>
	