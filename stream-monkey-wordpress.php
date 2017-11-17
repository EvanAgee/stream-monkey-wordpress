<?php
/*
Plugin Name: Stream Monkey
Description: Display your Stream Monkey content on your WordPress site!
Author: Evan Agee
Version: 0.1.0
Author URI: http://evanagee.com
License: GPL2

MWD Plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

MWD Plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with MWD Plugin. If not, see https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html.
*/

defined( 'ABSPATH' ) or die( 'Nothing to see here, move along please...' );
// require_once plugin_dir_path( __FILE__ ) . '/inc/class.rest-api.php';
require_once plugin_dir_path( __FILE__ ) . 'inc/class.settings-api.php';
require_once plugin_dir_path( __FILE__ ) . '/admin/settings.php';

class StreamMonkeyWordpress
{
  public $plugin_name;

	function __construct() {
    $this->plugin_name = plugin_basename( __FILE__ );
    add_action( 'wp_enqueue_scripts', array( $this, 'add_scripts' ) );
    add_filter( "plugin_action_links_$this->plugin_name", array( $this, 'settings_link') );
		add_shortcode( 'streamMonkeyWordpress', array( $this, 'create_shortcode' ) );
	}

	function activate() {
	}

	function deactivate() {
	}

	public function add_scripts() {
    wp_register_script( 'font-awesome', "https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css", null, null);
    wp_register_script( 'matchheight', "https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js", ['jquery'], '', true );
    wp_register_script( 'streamMonkeyWordpress', plugin_dir_url( __FILE__ ) . 'assets/dist/build.js', '', '', true );
	}

	public static function create_shortcode() {
    $settings = get_option( 'stream_monkey' );

    if ( !empty($settings["streammonkey_channel_id"]) &&
         !empty($settings["streammonkey_recent_messages_id"]) &&
         !empty($settings["streammonkey_series_id"])
    ) {
      // Enque scripts/stypes and output our container for the Vue app
      wp_enqueue_style( 'font-awesome' );
      wp_enqueue_script( 'matchheight' );
      wp_enqueue_script( 'streamMonkeyWordpress' );

      $html = '<script type="text/javascript">';
      $html .= 'var streamMonkeySettings = ' . json_encode($settings) . ';';
      $html .= '</script>';
      $html .= "<div id='streamMonkeyWordpress'></div>";
    } else {
      $html = '<p style="color: red;">There was a problem with your Stream Monkey settings. Please update your settings in the admin and refresh this page.</p>';
    }

		return $html;
  }

  public function settings_link( $links ) {
    array_push($links, '<a href="admin.php?page=streamMonkeyWordpress_plugin">Settings</a>');
    return $links;
  }
}

if ( class_exists( 'StreamMonkeyWordpress' ) ) {
  $streamMonkeyWordpress = new StreamMonkeyWordpress();
}

// Plugin activation
register_activation_hook( __FILE__, array($streamMonkeyWordpress, 'activate') );