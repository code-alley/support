<?php
/**
 * File Name: meta-boxes.php
 */


/*-----------------------------------------------------------------------------------*/
/*	Video Metabox
/*-----------------------------------------------------------------------------------*/
add_action( 'add_meta_boxes', 'video_meta_box_add' );

function video_meta_box_add()
{
    add_meta_box( 'video-meta-box', __('Video Settings', 'framework'), 'video_meta_box', 'post', 'normal', 'high' );
}

function video_meta_box( $post )
{
    $values = get_post_custom( $post->ID );

    $embed_code = isset( $values['embed_code'] ) ? esc_attr( $values['embed_code'][0] ) : '';

    wp_nonce_field( 'video_meta_box_nonce', 'meta_box_nonce' );
    ?>
<table style="width:100%;">
    <tr style="border-top:1px solid #eeeeee;">
        <td style="width:25%; vertical-align:top;">
            <label for="embed_code"><strong><?php _e('Embed Code','framework');?></strong></label>
            <span style="color:#999; display:block;"><?php _e('If you are not using self hosted videos then please provide the video embed code and remove the the width and height attributes.','framework'); ?></span>
        </td>
        <td style="width:75%;">
            <textarea name="embed_code" id="embed_code" cols="30" rows="10" style="width:75%; margin-right:4%; " ><?php echo $embed_code; ?></textarea>
        </td>
    </tr>
</table>
<?php
}


add_action( 'save_post', 'video_meta_box_save' );

function video_meta_box_save( $post_id ) {

    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'video_meta_box_nonce' ) ) return;

    if( !current_user_can( 'edit_post' ) ) return;

    $allowed = array(
        'a' => array(
            'href' => array()
        )
    );

    if( isset( $_POST['embed_code'] ) )
        update_post_meta( $post_id, 'embed_code', esc_attr( $_POST['embed_code'] ) );

}




?>