<div class="my-contact-message">
    <?php
        if ( isset( $_GET[ 'message' ] ) && $_GET[ 'message' ] == 'success' ) {
            echo "<p style='color: green;'>Message sent successfully!</p>";
        }
    ?>
    <form action="" method="POST">
        <p>
            <label for="">Name</label>
        </p>
        <p>
            <input type="text" name="name">
            <?php if ( $this->has_error( 'name' ) ) { ?> 
                <span style="color: red;"><?php echo $this->get_error( 'name' ); ?></span>
            <?php } ?>
        </p>

        <p>
            <label for="">Email</label>
        </p>
        <p>
            <input type="email" name="email">
            <?php if ( $this->has_error( 'email' ) ) { ?> 
                <span style="color: red;"><?php echo $this->get_error( 'email' ); ?></span>
            <?php } ?>
        </p>

        <p>
            <label for="">Subject</label>
        </p>
        <p>
            <input type="text" name="subject">
            <?php if ( $this->has_error( 'subject' ) ) { ?> 
                <span style="color: red;"><?php echo $this->get_error( 'subject' ); ?></span>
            <?php } ?>
        </p>

        <p>
            <label for="">Message</label>
        </p>
        <p>
            <textarea name="message" id="message" cols="30" rows="10"></textarea>
            <?php if ( $this->has_error( 'message' ) ) { ?> 
                <span style="color: red;"><?php echo $this->get_error( 'message' ); ?></span>
            <?php } ?>
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