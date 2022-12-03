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
		<p><?php echo __('You can register at'); ?> <a href="https://dev.tssaltan.top/login" target="_blank">dev.tssaltan.top</a> <?php echo __('and generate API keys on your own. Or click at button for generating keys automatically.'); ?></p>
		<input type="hidden" name="action" value="generate_its_keys">
		<?php
			submit_button(__('Generate API keys'), 'default');
		?>
	</form>

	<?php if($captchaPuzzle->isInstalled()): ?>
	<form action="options.php" method="POST">
		<p><?php echo __('Testing your current API keys.'); ?></p>
		<?php if(isset($_GET['testing-results']) && isset($_GET['testing-results']['public'])): ?>
		<p>
			<strong><?php echo __('Public key'); ?>:
			<?php if($_GET['testing-results']['public'] == 'ok'): ?>
				<span style="color: darkgreen"><?php echo __('correct'); ?></span>
			<?php else: ?>
				<span style="color: darkred"><?php echo __('incorrect'); ?></span>
			<?php endif; ?>
			</strong> 
		</p>
		<?php endif; ?>

		<?php if(isset($_GET['testing-results']) && isset($_GET['testing-results']['private'])): ?>
		<p>
			<strong><?php echo __('Private key'); ?>:
			<?php if($_GET['testing-results']['private'] == 'ok'): ?>
				<span style="color: darkgreen"><?php echo __('correct'); ?></span>
			<?php else: ?>
				<span style="color: darkred"><?php echo __('incorrect'); ?></span>
			<?php endif; ?>
			</strong>
		</p>
		<?php endif; ?>
		<input type="hidden" name="action" value="testing_its_keys">
		<?php
			submit_button(__('Testing API keys'), 'default');
		?>
	</form>
	<?php endif; ?>
</div>
	