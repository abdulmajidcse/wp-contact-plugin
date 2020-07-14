<div class="my-contact-message">
    <?php
        if ( isset( $_GET[ 'message' ] ) && $_GET[ 'message' ] == 'success' ) {
            echo "<p style='color: green;'>Message sent successfully!</p>";
        } elseif ( isset( $_GET[ 'message' ] ) && $_GET[ 'message' ] == 'error' ) {
            echo "<p style='color: red;'>Message did not send successfully!</p>";
        }
    ?>
    <form action="" method="POST">
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
            global $wp;
            $form_url = home_url( add_query_arg( array(), $wp->request ) );

            wp_nonce_field( 'my_contact_form_nonce' );
        ?>

        <input type="hidden" name="form_url" value="<?php echo $form_url; ?>">
        
        <p>
            <button type="submit" name="my_contact_message_send">Send</button>
        </p>
    </form>
</div>