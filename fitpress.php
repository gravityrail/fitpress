<?php
/*
Plugin Name: FitPress
Version: 0.1-alpha
Description: Publish your FitBit statistics on your WordPress blog
Author: Daniel Walmsley
Author URI: http://danwalmsley.com
Plugin URI: http://github.com/gravityrail/wp-fitpress-plugin
Text Domain: fitpress
Domain Path: /languages
*/

Class FitPress {
	// singleton class pattern:
	protected static $instance = NULL;
	public static function get_instance() {
		NULL === self::$instance and self::$instance = new self;
		return self::$instance;
	}

	function __construct() {
		// hook activation and deactivation for the plugin
		add_action('init', array($this, 'init'));
	}

	function init() {
		add_action('admin_enqueue_scripts', array($this, 'fitpress_init_styles'));
		add_action('admin_menu', array($this, 'fitpress_settings_page'));
		add_action('admin_init', array($this, 'fitpress_register_settings'));
		add_action('show_user_profile', array($this, 'fitpress_linked_accounts'));
		add_action('admin_post_fitpress_auth', array($this, 'fitpress_auth'));
		add_action('admin_post_fitpress_auth_callback', array($this, 'fitpress_auth_callback'));
	}

	/**
	 * CSS and javascript
	 **/

	function fitpress_init_styles() {
		wp_enqueue_style('fitpress-style', plugin_dir_url( __FILE__ ) . 'fitpress.css', array());
	}

	/**
	 * User profile buttons
	 **/

	function fitpress_linked_accounts() {
		// get the current user:
		global $current_user;
		get_currentuserinfo();
		$user_id = $current_user->ID;
		// get the wpoa_identity records:
		global $wpdb;
		$usermeta_table = $wpdb->usermeta;
		$query_string = "SELECT meta_value FROM $usermeta_table WHERE $user_id = $usermeta_table.user_id AND $usermeta_table.meta_key = 'fitpress_identity' limit 1";
		$oauth_id = $wpdb->get_var($query_string);
		// list the wpoa_identity records:
		echo "<div id='fitpress-linked-accounts'>";
		echo "<h3>FitBit Account</h3>";
		if ( ! $oauth_id ) {
			echo "<p>You have not linked your FitBit account.</p>";
			echo $this->fitpress_login_button();
		} else {
			echo "<p>Linked with ID {$oauth_id}";
		}
		echo "</div>";
	}

	//redirect out to FitBit API
	function fitpress_auth() {
		include 'PHPoAuthLib/src/OAuth/bootstrap.php';
		include 'fitbitphp/lib/Fitbit/Api.php';
		$redirect_url = admin_url('admin-post.php?action=fitpress_auth_callback');
		$api = new \Fitbit\Api(get_option('fitpress_api_id'), get_option('fitpress_api_secret'), $redirect_url);
		$api->initSession();
	}

	function fitpress_auth_callback() {

	}

	function fitpress_login_button() {
		$url = admin_url('admin-post.php?action=fitpress_auth');

		// generates and returns a login button for FitPress:
		$html = "";
		$html .= "<a id='fitpress-login-fitbit' class='fitpress-login-button' href='{$url}'>";
		$html .= "Link my FitBit account";
		$html .= "</a>";
		return $html;
	
	}

	/**
	 * Plugin settings
	 **/

	// registers all settings that have been defined at the top of the plugin:
	function fitpress_register_settings() {
		register_setting('fitpress_settings', 'fitpress_api_id');
		register_setting('fitpress_settings', 'fitpress_api_secret');
		register_setting('fitpress_settings', 'fitpress_token_override');
	}

	// add the main settings page:
	function fitpress_settings_page() {
		add_options_page( 'FitPress Options', 'FitPress', 'manage_options', 'FitPress', array($this, 'fitpress_settings_page_content') );
	}

	// render the main settings page content:
	function fitpress_settings_page_content() {
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		$blog_url = rtrim(site_url(), "/") . "/";
		include 'fitpress-settings.php';
	}
}

FitPress::get_instance();
?>