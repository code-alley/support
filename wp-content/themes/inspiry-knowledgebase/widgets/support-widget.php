<?php
/**
 * File Name: support-widget.php
 */

class Support_Widget extends WP_Widget {

    function Support_Widget(){
        $widget_ops = array( 'classname' => 'Support_Widget', 'description' => __('This widget displays information related to further support options.', 'framework'));
        $this->WP_Widget( 'support_widget', __('Knowledge Base - Support Widget', 'framework'), $widget_ops );
    }

    function widget($args,  $instance) {

        extract($args);

        $title = apply_filters('widget_title', $instance['title']);

        if ( empty($title) )
        {
            $title = false;
        }

        $support_text =  $instance['support_text'];

        echo $before_widget;

        echo '<div class="support-widget">';

        if($title):
            echo $before_title;
            echo $title;
            echo $after_title;
        endif;

        echo '<p class="intro">'.$support_text.'</p>';

        echo '</div>';

        echo $after_widget;
    }


    function form($instance) {

        $instance = wp_parse_args( (array) $instance, array( 'title'=> __('Support', 'framework'), 'support_text' => __('Need more support? If you did not found an answer, contact us for further help.', 'framework') ) );

        $title = esc_attr($instance['title']);
        $support_text =  esc_textarea($instance['support_text']);

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'framework'); ?></label>
            <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" class="widefat" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('support_text'); ?>"><?php _e('Support Text', 'framework'); ?></label>
            <textarea id="<?php echo $this->get_field_id('support_text'); ?>" name="<?php echo $this->get_field_name('support_text'); ?>" cols="10" rows="5" class="widefat"><?php echo $support_text; ?></textarea>
        </p>
        <?php

    }


    function update($new_instance, $old_instance)
    {
        $instance=$old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['support_text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['support_text']) ) );

        return $instance;
    }


}

?>