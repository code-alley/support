<?php

$embed_code = get_post_meta($post->ID, 'embed_code', true);

if(!empty($embed_code))
{
    ?>
    <div class="post-video">
        <div class="video-wrapper">
            <?php echo stripslashes(htmlspecialchars_decode($embed_code)); ?>
        </div>
    </div>
    <?php
}

?>


