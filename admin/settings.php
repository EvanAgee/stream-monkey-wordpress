<?php
if ( !class_exists('StreamMonkeyWordpress_Admin' ) ):
  class StreamMonkeyWordpress_Admin {

    private $settings_api;

    function __construct() {
      $this->settings_api = new WeDevs_Settings_API;

      add_action( 'admin_init', array($this, 'admin_init') );
      add_action( 'admin_menu', array($this, 'admin_menu') );
    }

    function admin_init() {
      //set the settings
      $this->settings_api->set_sections( $this->get_settings_sections() );
      $this->settings_api->set_fields( $this->get_settings_fields() );

      //initialize settings
      $this->settings_api->admin_init();
    }

    function admin_menu() {
      add_menu_page(
        'streamMonkeyWordpress',
        'Stream Monkey',
        'manage_options',
        'streamMonkeyWordpress_plugin',
        array($this, 'plugin_page'),
        'dashicons-format-video',
        50
      );
    }

    function get_settings_sections() {
      $sections = array(
        array(
          'id'    => 'stream_monkey',
          'title' => __( 'Channel &amp; Category Settings', 'wedevs' )
        )
      );
      return $sections;
    }

    /**
    * Returns all the settings fields
    *
    * @return array settings fields
    */
    function get_settings_fields() {
      $settings_fields = array(
        'stream_monkey' => array(
          array(
            'name'              => 'streammonkey_api_base',
            'label'             => __( 'API Base URL', 'wedevs' ),
            'desc'              => __( 'The base URL of the Stream Monkey API <br><small style="color: #c10000;">(You probably don\'t need to change this)</small>', 'wedevs' ),
            'placeholder'       => __( 'https://player.streammonkey.com/feeds/channels/', 'wedevs' ),
            'type'              => 'text',
            'default'           => 'https://player.streammonkey.com/feeds/channels/',
            'sanitize_callback' => 'sanitize_text_field'
          ),
          array(
            'name'              => 'streammonkey_channel_id',
            'label'             => __( 'Channel ID', 'wedevs' ),
            'desc'              => __( 'The ID of the channel you\'re displaying.', 'wedevs' ),
            'placeholder'       => __( 'XXXXXXX', 'wedevs' ),
            'type'              => 'text',
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field'
          ),
          array(
            'name'        => 'html',
            'desc'        => __( '<hr>', 'wedevs' ),
            'type'        => 'html'
          ),
          array(
            'name'              => 'streammonkey_recent_messages_id',
            'label'             => __( 'Recent Messages<br> Category ID', 'wedevs' ),
            'desc'              => __( 'The ID of the category you\'re using to catalog your message archives', 'wedevs' ),
            'placeholder'       => __( 'XXXXXXX', 'wedevs' ),
            'type'              => 'text',
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field'
          ),
          array(
            'name'              => 'streammonkey_series_id',
            'label'             => __( 'Series<br> Category ID', 'wedevs' ),
            'desc'              => __( 'The ID of the category you\'re using to catalog your series', 'wedevs' ),
            'placeholder'       => __( 'XXXXXXX', 'wedevs' ),
            'type'              => 'text',
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field'
          ),
          array(
            'name'              => 'streammonkey_series_id',
            'label'             => __( 'Series<br> Category ID', 'wedevs' ),
            'desc'              => __( 'The ID of the category you\'re using to catalog your series', 'wedevs' ),
            'placeholder'       => __( 'XXXXXXX', 'wedevs' ),
            'type'              => 'text',
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field'
          ),
        )
      );

      return $settings_fields;
    }

    function plugin_page() {
      require_once plugin_dir_path( __FILE__ ) . '../templates/admin.php';
    }
  }

  new StreamMonkeyWordpress_Admin();
endif;