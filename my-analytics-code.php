<?php
/**
 *
 * Plugin Name:       My Analytics Code
 * Plugin URI: 	      http://wp.labnul.com/plugin/my-analytics-code/
 * Description:       My Analytics Code is a simple plugin to include Analytics tracking. Start <a href="options-general.php?page=my-anaytics-code">Analytic Settings</a>.
 * Version:           1.0.0
 * Author:            Aby Rafa
 * Author URI:        http://wp.labnul.com/
 * Text Domain:       my-anaytics-code
 * Domain Path		  /languages
 * License:           GPL-2.0+
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.txt
 *
 */

/*
My Analytics Code is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

My Analytics Code is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with My Analytics Code. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

if (is_admin()) add_action('admin_menu', 'my_anaytics_code_menu');
else add_action('init', 'my_analytics_code_check_login');

function my_analytics_code_check_login() {
	if(!is_user_logged_in() or is_user_logged_in() and get_option('my_analytics_code_login') == null){
		if(get_option('my_analytics_code_position') == "header") add_action('wp_head','my_analytics_code');
		if(get_option('my_analytics_code_position') == "footer") add_action('wp_footer','my_analytics_code', 1000);
	}
}

function my_analytics_code() {
		echo get_option('my_analytics_code_script');
}

function my_anaytics_code_menu() {
	add_options_page("My Anaytics Page","My Anaytics Code","manage_options","my-anaytics-code","my_anaytics_code_wrap");
	add_action( 'admin_init', 'my_anaytics_code_reg' );
}

function my_anaytics_code_reg() {
	register_setting( 'my-anaytics-code-abyrafa', 'my_analytics_code_script' );
	register_setting( 'my-anaytics-code-abyrafa', 'my_analytics_code_position' );
	register_setting( 'my-anaytics-code-abyrafa', 'my_analytics_code_login' );
}

function my_anaytics_code_wrap() { ?>
<div class="wrap">
	<h1>My Analytics Code</h1>
	<form method="post" action="options.php">
	<?php
		settings_fields( 'my-anaytics-code-abyrafa' );
		do_settings_sections( 'my-anaytics-code-abyrafa' );
	?>
		<div id="dashboard-widgets-wrap">
			<div id="dashboard-widgets" class="metabox-holder">
				<div id="postbox-container-2" class="postbox-container">
					<div id="side-sortables" class="meta-box-sortables">
						<div id="dashboard_primary" class="postbox ">
							<h2 class="hndle"><span>About Plugin:</span></h2>
							<div class="inside">
								<div class="rss-widget">
									<div style="float:left; margin-right:25px;">
										<p><img src="<?php echo plugins_url("images/home.jpg", __FILE__); ?>" /> <a href="http://wp.labnul.com/plugin/my-anaytics-code/" target="_blank">Plugin Homepage</a></p>
									</div>
									<div style="clear:left;"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="postbox-container-1" class="postbox-container">
					<div id="side-sortables" class="meta-box-sortables">
						<div id="dashboard_primary" class="postbox ">
							<h2 class="hndle"><span>Tracking Script</span></h2>
							<div class="inside">
								<div class="rss-widget"><br />											
									<textarea id="my_analytics_code_script" name="my_analytics_code_script" class="large-text code" rows="9"><?php echo esc_textarea(get_option('my_analytics_code_script')); ?></textarea>
									<input name="my_analytics_code_login" type="checkbox" value="1" <?php checked(1, get_option('my_analytics_code_login'),true); if(false===get_option('my_analytics_code_login')) echo "checked"; ?>/> Do not track my own visits while logging in.
								</div>
							</div><br />
							<h2 class="hndle"><span>Analytics Placement</span></h2>
							<div class="inside">
								<div class="rss-widget">												
									<p><input id="my_analytics_code_position" type="radio" name="my_analytics_code_position" value="header" <?php if (get_option('my_analytics_code_position') == "header") echo "checked"; if(false === get_option('my_analytics_code_position')) echo "checked"; ?>> Include within <code>&lt;head&gt;</code> tag.</p>										
									<p><input id="my_analytics_code_position" type="radio" name="my_analytics_code_position" value="footer" <?php if (get_option('my_analytics_code_position') == "footer") echo "checked"; ?>> Include before closing <code>&lt;/body&gt;</code> tag.</p>
									<?php submit_button(); ?>									
								</div>
							</div>							
						</div>
					</div>							
				</div>						
			</div>
		</div>            
	</form>
</div>
<?php } ?>
