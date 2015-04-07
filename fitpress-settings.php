<div class='wrap fitpress-settings'>
	<h2>FitPress Settings</h2>

	<form method='post' action='options.php'>
		<?php settings_fields('fitpress_settings'); ?>
		<?php do_settings_sections('fitpress_settings'); ?>

		<h3>FitPress API Credentials</h3>
		<div class='form-padding'>
		<table class='form-table'>
			<tr valign='top'>
			<th scope='row'>Client consumer key:</th>
			<td>
				<input type='text' name='fitpress_api_id' value='<?php echo get_option('fitpress_api_id'); ?>' />
			</td>
			</tr>
			 
			<tr valign='top'>
			<th scope='row'>Client consumer Secret:</th>
			<td>
				<input type='text' name='fitpress_api_secret' value='<?php echo get_option('fitpress_api_secret'); ?>' />
			</td>
			</tr>

			<tr valign='top'>
			<th scope='row'>Debug access token:</th>
			<td>
				<input type='text' name='fitpress_token_override' value='<?php echo get_option('fitpress_token_override'); ?>' />
			</td>
			</tr>
		</table> <!-- .form-table -->
		<p>
			<strong>Instructions:</strong>
			<ol>
				<li>Register as a FitBit Developer at <a href='https://dev.fitbit.com/' target="_blank">dev.fitbit.com</a>.</li>
				<li>Click "Register a new app"</li>
				<li>Enter the basic description, plus your site's homepage URL (<?php echo $blog_url; ?>) for the new App's Redirect URI. Don't forget the trailing slash!</li>
				<li>Paste your Client Key/Secret provided by FitBit into the fields above, then click the Save all settings button.</li>
			</ol>
		</p>
		<?php submit_button('Save all settings'); ?>
	</form>
</div> 