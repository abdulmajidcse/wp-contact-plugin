<?php

namespace My_Contact;

use My_Contact\Traits\Form_Error;

class Frontend {
    use Form_Error;
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
            // sanitize fields
            $name = isset( $_POST[ 'name' ] ) ? sanitize_text_field( $_POST[ 'name' ] ) : '';
            $email = isset( $_POST[ 'email' ] ) ? sanitize_text_field( $_POST[ 'email' ] ) : '';
            $subject = isset( $_POST[ 'subject' ] ) ? sanitize_text_field( $_POST[ 'subject' ] ) : '';
            $message = isset( $_POST[ 'message' ] ) ? sanitize_textarea_field( $_POST[ 'message' ] ) : '';

            if ( empty( $name ) ) {
                $this->errors[ 'name' ] = 'You must provide a name!';
            }

            if ( empty( $email ) ) {
                $this->errors[ 'email' ] = 'You must provide an email!';
            }

            if ( empty( $subject ) ) {
                $this->errors[ 'subject' ] = 'You must provide a subject!';
            }

            if ( empty( $message ) ) {
                $this->errors[ 'message' ] = 'You must write your message!';
            }

            if ( ! empty( $this->errors ) ) {
                return;
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
            if ( $message_insert ) {
                $redirect_to = sanitize_text_field( $_POST[ 'form_url' ] ) . '?message=success';
            }
            wp_redirect( $redirect_to );
            exit;

        } else {
            wp_die( 'Are you chating?' );
        }
    }
}