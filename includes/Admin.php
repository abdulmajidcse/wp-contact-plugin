<?php

namespace My_Contact;

class Admin {
    public function __construct() {
        add_action( 'admin_menu', [ $this, 'menu_setup'] );
    }

    public function menu_setup() {
        $parent_slug = 'my-contact';
        $capability = 'manage_options';
        add_menu_page( 'My contact', 'My contact', $capability, $parent_slug, [ $this, 'main_menu' ], 'dashicons-buddicons-pm', 25 );
        add_submenu_page( $parent_slug, 'Messages', 'Messages', $capability, $parent_slug, [ $this, 'main_menu' ] );
        add_submenu_page( $parent_slug, 'Configuration', 'Configuration', $capability, 'my-contact-configuration', [ $this, 'configuration_menu' ] );
    }

    public function main_menu() { ?>
        <div class="main-menu">
            <h2>My contact</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam expedita vero veniam vitae reiciendis recusandae assumenda illum architecto ducimus, modi explicabo laboriosam eius fugit esse asperiores autem doloribus incidunt! Cupiditate?</p>
            <input type="text">
        </div>
    <?php }

    public function configuration_menu() {
        echo 'Mail configuration page';
    }
}