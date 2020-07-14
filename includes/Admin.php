<?php

namespace My_Contact;

class Admin {
    public function __construct() {
        add_action( 'admin_menu', [ $this, 'menu_setup'] );
        add_action( 'admin_menu', [ $this, 'enqueue_styles' ] );
    }

    public function menu_setup() {
        $parent_slug = 'my-contact';
        $capability = 'manage_options';
        add_menu_page( 'My contact', 'My contact', $capability, $parent_slug, [ $this, 'main_menu' ], 'dashicons-buddicons-pm', 25 );
        add_submenu_page( $parent_slug, 'Messages', 'Messages', $capability, $parent_slug, [ $this, 'main_menu' ] );
        add_submenu_page( $parent_slug, 'Configuration', 'Configuration', $capability, 'my-contact-configuration', [ $this, 'configuration_menu' ] );
    }

    public function main_menu() {
        global $wpdb;
        $all_contact = $wpdb->get_results(
            "SELECT * FROM {$wpdb->prefix}my_contact_messages"
        );
        require_once __DIR__ . '/views/all-contact.php';
    }

    public function configuration_menu() {
        echo 'Mail configuration page';
    }

    public function enqueue_styles() {
        wp_enqueue_style( 'my_contact_bootstrap_css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css', 'Bootstrap' );
    }
}