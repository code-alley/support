<?php
/**
 * File Name: latest-articles-widget.php
 */

class Latest_Articles_Widget extends WP_Widget {

    function Latest_Articles_Widget(){
        $widget_ops = array( 'classname' => 'Latest_Articles_Widget', 'description' => __('This widget displays latest articles.', 'framework'));
        $this->WP_Widget( 'latest_articles_widget', __('Knowledge Base - Latest Articles', 'framework'), $widget_ops );
    }

    function widget($args,  $instance) {

        extract($args);

        $title = apply_filters('widget_title', $instance['title']);

        if ( empty($title) )
        {
            $title = false;
        }

        $articles_count =  absint($instance['articles_count']);

        echo $before_widget;

        if($title):
            echo $before_title;
            echo $title;
            echo $after_title;
        endif;

        $latest_articles_arguments = array( 'posts_per_page' => $articles_count);

        // Generate List of articles
        list_articles($latest_articles_arguments);

        echo $after_widget;

    }


    function form($instance) {

        $instance = wp_parse_args( (array) $instance, array( 'title'=> __('Latest Articles', 'framework'), 'articles_count' => 4 ) );

        $title = esc_attr($instance['title']);
        $articles_count =  $instance['articles_count'];

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'framework'); ?></label>
            <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" class="widefat" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('articles_count'); ?>"><?php _e('Number of Articles', 'framework'); ?></label>
            <input id="<?php echo $this->get_field_id('articles_count'); ?>" name="<?php echo $this->get_field_name('articles_count'); ?>" type="text" value="<?php echo $articles_count; ?>" class="widefat" />
        </p>
        <?php

    }


    function update($new_instance, $old_instance)
    {
        $instance=$old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['articles_count'] = strip_tags($new_instance['articles_count']);

        return $instance;
    }


}

?>