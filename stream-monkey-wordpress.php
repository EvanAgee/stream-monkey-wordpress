<?php
/**
 * @package MWD Plugin
 * @version 0.1
 */
/*
Plugin Name: Stream Monkey
Description: Display your Stream Monkey content on your WordPress site!
Author: Evan Agee
Version: 0.1.0
Author URI: http://evanagee.com
License:     GPL2
 
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

class StreamMonkeyWordpress
{
	function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'add_scripts' ) );
		add_shortcode( 'streamMonkeyWordpress', array( $this, 'create_shortcode' ) );
	}

	function activate() {
	}

	function deactivate() {
	}

	public function add_scripts() {
    wp_enqueue_style( 'font-awesome', "https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css", null, null);
    wp_enqueue_script( 'matchheight', "https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js", ['jquery'], '', true );
    wp_enqueue_script( 'streamMonkeyWordpress', plugin_dir_url( __FILE__ ) . 'assets/dist/build.js', '', '', true );
	}

	public static function create_shortcode() {
		// Output our container for the Vue app
		return "<div id='streamMonkeyWordpress'></div>";
	}
}

if ( class_exists( 'StreamMonkeyWordpress' ) ) {
	$streamMonkeyWordpress = new StreamMonkeyWordpress();
}

// Plugin activation
register_activation_hook( __FILE__, array($streamMonkeyWordpress, 'activate') );