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
    ?>

        <div class="my-contact-message">
            <form action="http://localhost/wordpress/check-message" method="POST">
                <p>
                    <label for="">Name</label>
                </p>
                <p>
                    <input type="text" name="name" required>
                </p>

                <p>
                    <label for="">Email</label>
                </p>
                <p>
                    <input type="email" name="email" required>
                </p>

                <p>
                    <label for="">Subject</label>
                </p>
                <p>
                    <input type="text" name="subject" required>
                </p>

                <p>
                    <label for="">Message</label>
                </p>
                <p>
                    <textarea name="message" id="message" cols="30" rows="10"></textarea>
                </p>

                <?php
                    wp_nonce_field( 'my_contact_form_nonce' );
                ?>
                
                <p>
                    <button type="submit" name="my_contact_message_send">Send</button>
                </p>
            </form>
        </div>

    <?php
        return ob_get_clean();
    }

    public function form_handler() {
        if ( isset( $_POST['my_contact_message_send'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'my_contact_form_nonce' ) ) {
            die( var_dump( $_POST ) );
            wp_redirect( 'http://localhost/'.$_POST['_wp_http_referer'] );
            exit;
        } else {
            wp_die( 'Are you chating?' );
        }
    }
}