<?php

/**
 * Plugin Name:       My Contact Form
 * Plugin URI:        https://abdulmajid.xyz
 * Description:       Easy contact form for form builder and it's a testing purpose.
 * Version:           1.0
 * Author:            Abdul Majid
 * Author URI:        https://abdulmajid.xyz
 * License:           GPL v2
 * Text Domain:       my-contact
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

final class My_Contact {

    /**
     * Plugin version
     * @var string
     */
    const version = '1.0';

    /**
     * Class constructor
     * run functions in the class and initialize hooks
     */
    private function __construct() {
        $this->define_constants();
        register_activation_hook( __FILE__, [ $this, 'activation' ] );
        add_action( 'plugin_loaded', [ $this, 'init_plugin' ] );
    }

    /**
     * Initialize Plugin class
     * 
     * @return \My_Contact
     */
    public static function init() {
        $instance = false;
        if ( ! $instance ) {
            $instance = new self();
        }
        
        return $instance;
    }

    /**
     * Define the required plugin contants
     * @return void
     */
    public function define_constants() {
        define( 'MY_CONTACT_VERSION', self::version );
        define( 'MY_CONTACT_FILE', __FILE__ );
        define( 'MY_CONTACT_PATH', __DIR__ );
        define( 'MY_CONTACT_URL', plugins_url( '', MY_CONTACT_FILE ) );
        define( 'MY_CONTACT_ASSETS', MY_CONTACT_URL . '/aasets' );
    }

    /**
     * Set activation values
     * @return void
     */
    public function activation() {
        $installed = get_option( 'my_contact_installed' );
        if ( ! $installed ) {
            update_option( 'my_contact_installed', time() );
        }
        update_option( 'my_contact_version', MY_CONTACT_VERSION );
    }

    /**
     * Initialize plugin functionality
     * @return void
     */
    public function init_plugin() {
        echo "<script>alert('I am from My Contact Plugin');</script>";
    }
}

/**
 * Create object of Main plugin class
 * 
 * @return \My_Contact
 */
function my_contact() {
    My_Contact::init();
}

/**
 * call plugin function
 */
my_contact();