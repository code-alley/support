<?php
/**
 * File Name: featured-articles-widget.php
 */

class Featured_Articles_Widget extends WP_Widget {

    function Featured_Articles_Widget(){
        $widget_ops = array( 'classname' => 'Featured_Articles_Widget', 'description' => __('This widget displays featured articles.', 'framework'));
        $this->WP_Widget( 'featured_articles_widget', __('Knowledge Base - Featured Articles', 'framework'), $widget_ops );
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

        $featured_articles_arguments = array( 'posts_per_page' => $articles_count);

        // Add Feature Tag in Arguments
        $feature_tag = get_option('theme_feature_tag');
        if( !empty($feature_tag) )
        {
            $selected_tag = get_term_by('name', $feature_tag , 'post_tag');
            if($selected_tag){
                $featured_articles_arguments['tag'] = $selected_tag->slug;
            }
        }

        // Generate List of articles
        list_articles($featured_articles_arguments);

        echo $after_widget;

    }


    function form($instance) {

        $instance = wp_parse_args( (array) $instance, array( 'title'=> __('Featured Articles', 'framework'), 'articles_count' => 4 ) );

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