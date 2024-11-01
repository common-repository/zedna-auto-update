<?php
/*
Plugin Name: Zedna Auto Update
Description: Allow automatic update for Core, Plugins, Themes, Translations and send a notification about that
Text Domain: zedna-auto-update
Domain Path: /languages
Author: Radek Mezulanik
Author URI: https://cz.linkedin.com/in/radekmezulanik
Version: 1.0
License: GPL3
*/

if ( ! defined( 'ABSPATH' ) )
	exit;

function zedna_auto_update_menu() {
	add_options_page('Zedna Auto Update Settings', 'Zedna Auto Update', 'administrator', 'zedna-auto-update-settings', 'zedna_auto_update_settings_page');
}
add_action('admin_menu', 'zedna_auto_update_menu');

function zedna_auto_update_settings_page() {
	$update_core = (get_option('zedna_update_core') != '') ? get_option('zedna_update_core') : true;
	$update_plugins = (get_option('zedna_update_plugins') != '') ? get_option('zedna_update_plugins') : true;
	$update_themes = (get_option('zedna_update_themes') != '') ? get_option('zedna_update_themes') : true;
	$update_translation = (get_option('zedna_update_translation') != '') ? get_option('zedna_update_translation') : true;
	$send_email = (get_option('zedna_update_send_email') != '') ? get_option('zedna_update_send_email') : true;
?>
<div class="wrap">
<h2><?php _e('Zedna Auto Update Settings', 'zedna-auto-update'); ?></h2>
<p><?php _e('Set automatic updates to prevent vulnerabilities from forgotten updates. Check what you want to update:', 'zedna-auto-update'); ?></p>
<form method="post" action="options.php">
    <?php settings_fields( 'zedna-auto-update-settings' ); ?>
    <?php do_settings_sections( 'zedna-auto-update-settings' ); ?>
    <table class="form-table">
		<tr valign="top">
        <th scope="row"><?php _e('Core', 'zedna-auto-update'); ?></th>
        <td>
				<input name="zedna_update_core" type="checkbox" value="1" <?php checked( '1', get_option( 'zedna_update_core' ) ); ?> />
				</td>
				</tr>
				<tr valign="top">
        <th scope="row"><?php _e('Plugins', 'zedna-auto-update'); ?></th>
        <td>
				<input name="zedna_update_plugins" type="checkbox" value="1" <?php checked( '1', get_option( 'zedna_update_plugins' ) ); ?> />
				</td>
				</tr>
				<tr valign="top">
        <th scope="row"><?php _e('Themes', 'zedna-auto-update'); ?></th>
        <td>
				<input name="zedna_update_themes" type="checkbox" value="1" <?php checked( '1', get_option( 'zedna_update_themes' ) ); ?> />
				</td>
				</tr>
				<tr valign="top">
        <th scope="row"><?php _e('Translations', 'zedna-auto-update'); ?></th>
        <td>
				<input name="zedna_update_translation" type="checkbox" value="1" <?php checked( '1', get_option( 'zedna_update_translation' ) ); ?> />
				</td>
				</tr>
				<tr valign="top">
        <td>
				
				</td>
				</tr>
				<tr valign="top">
        <th scope="row"><?php _e('Send notification email', 'zedna-auto-update'); ?></th>
        <td>
				<input name="zedna_update_send_email" type="checkbox" value="1" <?php checked( '1', get_option( 'zedna_update_send_email' ) ); ?> />
				</td>
        </tr>
    </table>
    <?php submit_button(); ?>
</form>
<p><?php print __('If you like this plugin, please donate us for faster upgrade','wp-image-lazy-load');?></p>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
	<input type="hidden" name="cmd" value="_s-xclick">
	<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
	<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit"
		alt="PayPal - The safer, easier way to pay online!">
	<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</div>
<?php }

function zedna_auto_update_settings() {
	register_setting( 'zedna-auto-update-settings', 'zedna_update_core' );
	register_setting( 'zedna-auto-update-settings', 'zedna_update_plugins' );
	register_setting( 'zedna-auto-update-settings', 'zedna_update_themes' );
	register_setting( 'zedna-auto-update-settings', 'zedna_update_translation' );
	register_setting( 'zedna-auto-update-settings', 'zedna_update_send_email' );
}
add_action( 'admin_init', 'zedna_auto_update_settings' );

function zedna_auto_update_deactivation() {
    delete_option( 'zedna_update_core' );
    delete_option( 'zedna_update_plugins' );
		delete_option( 'zedna_update_themes' );
		delete_option( 'zedna_update_translation' );
		delete_option( 'zedna_update_send_email' );
}
register_deactivation_hook( __FILE__, 'zedna_auto_update_deactivation' );

class zedna_auto_update_languages {
    public static function loadTextDomain() {
				load_plugin_textdomain( 'zedna-auto-update', false, basename( dirname( __FILE__ ) ) . '/languages' ); 
    }
}
add_action('plugins_loaded', array('zedna_auto_update_languages', 'loadTextDomain'));

function zedna_auto_update() {
	if(get_option( 'zedna_update_core')):
		add_filter( 'auto_update_core', '__return_true' ); //Enable all WordPress updates
		add_filter( 'allow_dev_auto_core_updates', '__return_true' );   // Enable development updates
		add_filter( 'allow_minor_auto_core_updates', '__return_true' ); // Enable minor updates
		add_filter( 'allow_major_auto_core_updates', '__return_true' ); // Enable minor updates
	endif;

	if(get_option( 'zedna_update_themes')):
		add_filter( 'auto_update_theme', '__return_true' ); // Updates Themes
	endif;

	if(get_option( 'zedna_update_plugins')):
		add_filter( 'auto_update_plugin', '__return_true' );    // Updates Plugins
	endif;

	if(get_option( 'zedna_update_translation')):
		add_filter( 'auto_update_translation', '__return_true' );   // Updates Translations
	endif;

	// Enable update emails
	if(get_option( 'zedna_update_send_email')):
		add_filter( 'auto_core_update_send_email', '__return_true' );
	endif;
}
add_action( 'wp_loaded', 'zedna_auto_update', 10);
