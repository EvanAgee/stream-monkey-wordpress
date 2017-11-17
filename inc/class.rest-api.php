<?php

class StreamMonkey_Wordpress_REST_Server extends WP_REST_Controller {

  //The namespace and version for the REST SERVER
  var $my_namespace = 'streammonkey/v';
  var $my_version   = '1';

  public function register_routes() {
    $namespace = $this->my_namespace . $this->my_version;
    $base      = 'settings';
    register_rest_route( $namespace, '/' . $base, array(
      array(
        'methods'         => WP_REST_Server::READABLE,
        'callback'        => array( $this, 'get_settings' ),
        'permission_callback'   => false
      )
    )
    );
  }

  public function get_settings( WP_REST_Request $request ) {
    $settings = get_option( 'stream_monkey' );
    return $settings;
  }

  // Register our REST Server
  public function hook_rest_server(){
    add_action( 'rest_api_init', array( $this, 'register_routes' ) );
  }
}

$StreamMonkey_Wordpress_REST_Server = new StreamMonkey_Wordpress_REST_Server();
$StreamMonkey_Wordpress_REST_Server->hook_rest_server();