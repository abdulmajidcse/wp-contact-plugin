<?php

namespace My_Contact;

class Frontend {
    
    /**
     * Class constructor
     * Loaded frontend hooks
     * 
     * @return void
     */
    public function __construct() {
        add_shortcode( 'my_contact_message', [ $this, 'render_shortcode' ] );
        if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
            $this->form_handler();
        }
    }

    public function render_shortcode( $atts, $content = '' ) {
        ob_start();
        require_once __DIR__ . '/views/contact-form.php';
        return ob_get_clean();
    }

    public function form_handler() {
        if ( isset( $_POST[ 'my_contact_message_send' ] ) && wp_verify_nonce( $_POST['_wpnonce'], 'my_contact_form_nonce' ) ) {
            $redirect_to = $_POST[ 'form_url' ] . '?message=true';
            wp_redirect( $redirect_to );
            exit;
        } else {
            wp_die( 'Are you chating?' );
        }
    }
}