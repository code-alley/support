<?php
/**
 * File Name: flickr-widget.php
 */

/*	Flickr Widget Helping Methods */
function image_from_description($data)
{
    preg_match_all('/<img src="([^"]*)"([^>]*)>/i', $data, $matches);
    return $matches[1][0];
}

function select_image($img, $size)
{
    $img = explode('/', $img);
    $filename = array_pop($img);

    // The sizes listed here are the ones Flickr provides by default.  Pass the array index in the

    // 0 for square, 1 for thumb, 2 for small, etc.
    $s = array(
        '_s.', // square
        '_t.', // thumb
        '_m.', // small
        '.',   // medium
        '_b.'  // large
    );

    $img[] = preg_replace('/(_(s|t|m|b))?\./i', $s[$size], $filename);
    return implode('/', $img);
}


function get_flickr($settings) {

    if (!function_exists('MagpieRSS')) {
        // Check if another plugin is using RSS, may not work
        include_once (ABSPATH . WPINC . '/class-simplepie.php');
        error_reporting(E_ERROR);
    }

    if(!isset($settings['items']) || empty($settings['items'])){

        $settings['items'] = 9;
    }

    // get the feeds
    if ($settings['type'] == "user") { $rss_url = 'http://api.flickr.com/services/feeds/photos_public.gne?id=' . $settings['id'] . '&tags=' . $settings['tags'] . '&per_page='.$settings['items'].'&format=rss_200'; }
    elseif ($settings['type'] == "favorite") { $rss_url = 'http://api.flickr.com/services/feeds/photos_faves.gne?id=' . $settings['id'] . '&format=rss_200'; }
    elseif ($settings['type'] == "set") { $rss_url = 'http://api.flickr.com/services/feeds/photoset.gne?set=' . $settings['set'] . '&nsid=' . $settings['id'] . '&format=rss_200'; }
    elseif ($settings['type'] == "group") { $rss_url = 'http://api.flickr.com/services/feeds/groups_pool.gne?id=' . $settings['id'] . '&format=rss_200'; }
    elseif ($settings['type'] == "public" || $settings['type'] == "community") { $rss_url = 'http://api.flickr.com/services/feeds/photos_public.gne?tags=' . $settings['tags'] . '&format=rss_200'; }
    else {
        print '<strong>'.__('No "type" parameter has been setup. Check your settings, or provide the parameter as an argument.', 'framework').'</strong>';
        die();
    }
    # get rss file

    $feed = new SimplePie($rss_url);
    $photos_arr = array();

    foreach ($feed->get_items() as $key => $item)
    {
        $enclosure = $item->get_enclosure();
        $img = image_from_description($item->get_description());
        $thumb_url = select_image($img, 0);
        $large_url = select_image($img, 4);

        $photos_arr[] = array(
            'title' => $enclosure->get_title(),
            'thumb_url' => $thumb_url,
            'url' => $large_url,
        );

        $current = intval($key+1);

        if($current == $settings['items'])
        {
            break;
        }
    }

    return $photos_arr;
}

/*-----------------------------------------------------------------------------------*/
/*	Flickr Widget Class
/*-----------------------------------------------------------------------------------*/

class Flickr_Widget extends WP_Widget {

    function Flickr_Widget() {
        $widget_ops = array( 'classname' => 'Flickr_Widget', 'description' => __('Display Photos From Flickr', 'framework') );
        $this->WP_Widget( 'flickr_widget', __('Knowledge Base - Flickr Photos', 'framework'), $widget_ops);
    }

    function form($instance) {

        $instance = wp_parse_args( (array) $instance, array('title' => __('Flickr Photos', 'framework'), 'number' => 9, 'flickr_id' => '52617155@N08') );

        $title = esc_attr($instance['title']);
        $flickr_id = $instance['flickr_id'];
        $number = absint($instance['number']);

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','framework');?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('flickr_id'); ?>"><?php _e('Flickr ID','framework');?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('flickr_id'); ?>" name="<?php echo $this->get_field_name('flickr_id'); ?>" type="text" value="<?php echo $flickr_id; ?>" />
            <span class="example"><?php _e('Example','framework');?>:52617155@N08</span>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of Photos','framework');?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
        </p>
        <?php
    }

    function update($new_instance, $old_instance)
    {
        $instance=$old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['flickr_id']=$new_instance['flickr_id'];
        $instance['number']=$new_instance['number'];

        return $instance;
    }

    function widget($args, $instance)
    {
        extract($args);

        $title = apply_filters('widget_title', $instance['title']);

        if ( empty($title) ) $title = false;

        $flickr_id = $instance['flickr_id'];
        $number = absint( $instance['number'] );

        echo $before_widget;

        if($title):
            echo $before_title;
            echo $title;
            echo $after_title;
        endif;

        if (!empty($flickr_id)) {
            $photos_arr = get_flickr(array('type' => 'user', 'id' => $flickr_id, 'items' => $number));
            if(!empty($photos_arr)) {
                echo '<div class="flickr-photos">';
                foreach($photos_arr as $photo) {
                    echo '<a href="'.$photo['url'].'" title="'.$photo['title'].'" class="pretty-photo"><img src="'.$photo['thumb_url'].'" alt="'.$photo['title'].'"/></a>';
                }
                echo '</div>';
            }
        }

        echo $after_widget;
    }

}

?>