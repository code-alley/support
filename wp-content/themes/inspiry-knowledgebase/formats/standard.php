<?php
if ( has_post_thumbnail() )
{
    if(is_single())
    {
        $image_id = get_post_thumbnail_id();
        $image_url = wp_get_attachment_url($image_id);
        echo '<a class="pretty-photo" href="'.$image_url.'" title="'.get_the_title().'" >';
        the_post_thumbnail('std-thumbnail');
        echo '</a>';
    }
    else
    {
        echo '<a href="'.get_permalink().'" title="'.get_the_title().'" >';
        the_post_thumbnail('std-thumbnail');
        echo '</a>';
    }
}
?>