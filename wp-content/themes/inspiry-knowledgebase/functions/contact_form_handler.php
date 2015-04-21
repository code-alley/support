<?php
/**
 * File Name: contact_form_handler.php
 *
 * Send message function to process contact form submission
 *
 */


/*-----------------------------------------------------------------------------------*/
/*	 send message function to process contact form submission
/*-----------------------------------------------------------------------------------*/
if( ! function_exists( 'inspiry_send_message' ) ) {
    function inspiry_send_message()
    {
        if (isset($_POST['email'])):

            // verify nonce
            $nonce = $_POST['nonce'];
            if (!wp_verify_nonce($nonce, 'send_message_nonce')) {
                echo json_encode(array(
                    'success' => false,
                    'message' => __('Unverified Nonce!', 'framework')
                ));
                die;
            }

            /* Sanitize and Validate Target email address */
            $address = sanitize_email( get_option('theme_contact_address') );
            $address = is_email($address);
            if (!$address) {
                echo json_encode(array(
                    'success' => false,
                    'message' => __('Target Email address is not properly configured!', 'framework')
                ));
                die;
            }


            $name = sanitize_text_field($_POST['name']);
            $subject = sanitize_text_field($_POST['reason']);
            $message = stripslashes($_POST['message']);
            $email = sanitize_email($_POST['email']);
            $email = is_email($email);

            if (!$email) {
                echo json_encode(array(
                    'success' => false,
                    'message' => __('Provided Email address is invalid!', 'framework')
                ));
                die;
            }

            $e_subject = __('New message sent by', 'framework') . ' ' . $name . ' ' . __('using contact form at', 'framework') . ' ' . get_bloginfo('name');

            $e_body =   __("You have Received a message from: ", 'framework') . $name . "<br/>" .
                        "Subject: " . $subject . "<br/>" .
                        __("Their additional message is as follows.", 'framework') . "<br/>";

            $e_content = wpautop($message) . " <br/>";

            $e_reply = __("You can contact", 'framework') . ' ' . $name . ' ' . __("via email,", 'framework') . ' ' . $email;

            $full_message = $e_body . $e_content . $e_reply;

            $header = 'Content-type: text/html; charset=utf-8' . "\r\n";
            $header = apply_filters("inspiry_contact_mail_header", $header);
            $header .= 'From: ' . $name . " <" . $email . "> \r\n";

            if (wp_mail($address, $e_subject, $full_message, $header)) {
                echo json_encode(array(
                    'success' => true,
                    'message' => __("Message Sent Successfully!", 'framework')
                ));
            } else {
                echo json_encode(array(
                        'success' => false,
                        'message' => __("Server Error: WordPress mail function failed!", 'framework')
                    )
                );
            }

        else:

            echo json_encode(array(
                    'success' => false,
                    'message' => __("Invalid Request !", 'framework')
                )
            );

        endif;

        die;

    }
}

add_action( 'wp_ajax_nopriv_send_message', 'inspiry_send_message' );
add_action( 'wp_ajax_send_message', 'inspiry_send_message' );


?>