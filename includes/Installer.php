<?php

namespace My_Contact;

class Installer {
    
    /**
     * Class constructor
     * Load functions this classes
     * 
     * @return void
     */
    public function __construct() {
        $this->add_version();
        $this->create_tables();
    }

    /**
     * store installed time and plugin version
     * @return void
     */
    public function add_version() {
        $installed = get_option( 'my_contact_installed' );
        if ( ! $installed ) {
            update_option( 'my_contact_installed', time() );
        }
        update_option( 'my_contact_version', MY_CONTACT_VERSION );
    }

    /**
     * Create db tables
     * @return void
     */
    public function create_tables() {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}my_contact_messages` ( 
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , 
            `name` VARCHAR(100) NOT NULL , 
            `email` VARCHAR(100) NOT NULL , 
            `subject` VARCHAR(255) NOT NULL , 
            `message` VARCHAR(255) NOT NULL , 
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
            PRIMARY KEY (`id`)) $charset_collate";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }
}