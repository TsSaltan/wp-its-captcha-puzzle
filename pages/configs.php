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
		<p><?php printf(__('You can register at %s and generate API keys on your own. Or click at button for generating keys automatically.', 'captchapuzzle'), '<a href="https://dev.tssaltan.top/login" target="_blank">dev.tssaltan.top</a>'); ?></p>
		<input type="hidden" name="action" value="generate_its_keys">
		<?php
			submit_button(__('Generate API keys', 'captchapuzzle'), 'default');
		?>
	</form>

	<?php if($captchaPuzzle->isInstalled()): ?>
	<form action="options.php" method="POST">
		<p><?php echo __('Testing your current API keys.', 'captchapuzzle'); ?></p>
		<?php if(isset($_GET['testing-results']) && isset($_GET['testing-results']['public'])): ?>
		<p>
			<strong><?php echo __('Public key', 'captchapuzzle'); ?>:
			<?php if($_GET['testing-results']['public'] == 'ok'): ?>
				<span style="color: darkgreen"><?php echo __('correct', 'captchapuzzle'); ?></span>
			<?php else: ?>
				<span style="color: darkred"><?php echo __('incorrect', 'captchapuzzle'); ?></span>
			<?php endif; ?>
			</strong> 
		</p>
		<?php endif; ?>

		<?php if(isset($_GET['testing-results']) && isset($_GET['testing-results']['private'])): ?>
		<p>
			<strong><?php echo __('Private key', 'captchapuzzle'); ?>:
			<?php if($_GET['testing-results']['private'] == 'ok'): ?>
				<span style="color: darkgreen"><?php echo __('correct', 'captchapuzzle'); ?></span>
			<?php else: ?>
				<span style="color: darkred"><?php echo __('incorrect', 'captchapuzzle'); ?></span>
			<?php endif; ?>
			</strong>
		</p>
		<?php endif; ?>
		<input type="hidden" name="action" value="testing_its_keys">
		<?php
			submit_button(__('Testing API keys', 'captchapuzzle'), 'default');
		?>
	</form>
	<?php endif; ?>
</div>
	