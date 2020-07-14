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
        if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' && isset( $_POST[ 'my_contact_message_send' ] ) ) {
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
            
            $name = isset( $_POST[ 'name' ] ) ? sanitize_text_field( $_POST[ 'name' ] ) : '';
            $email = isset( $_POST[ 'email' ] ) ? sanitize_text_field( $_POST[ 'email' ] ) : '';
            $subject = isset( $_POST[ 'subject' ] ) ? sanitize_text_field( $_POST[ 'subject' ] ) : '';
            $message = isset( $_POST[ 'message' ] ) ? sanitize_textarea_field( $_POST[ 'message' ] ) : '';

            if ( empty( $name ) ) {
                die( var_dump( new \WP_Error( 'no-name', 'You must provide a name' ) ) );
            }
            // insert data
            global $wpdb;
            $table_name = "{$wpdb->prefix}my_contact_messages";
            $data = [
                'name'    => $_POST[ 'name' ],
                'email'   => $_POST[ 'email' ],
                'subject' => $_POST[ 'subject' ],
                'message' => $_POST[ 'message' ],
            ];
            $message_insert = $wpdb->insert(
                $table_name,
                $data
            );
            if ( message_insert ) {
                $redirect_to = $_POST[ 'form_url' ] . '?message=success';
            } else {
                $redirect_to = $_POST[ 'form_url' ] . '?message=error';
            }
            wp_redirect( $redirect_to );
            exit;
        } else {
            wp_die( 'Are you chating?' );
        }
    }
}