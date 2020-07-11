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

    private function __construct() {
        # code ...
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