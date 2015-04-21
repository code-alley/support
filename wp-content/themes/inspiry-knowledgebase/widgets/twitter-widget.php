<?php
/**
 * File Name: twitter-widget.php
 */

class Twitter_Widget extends WP_Widget {

    function Twitter_Widget(){
        $widget_ops = array( 'classname' => 'Twitter_Widget', 'description' => __('This widget displays latest tweets from your twitter account.', 'framework'));
        $this->WP_Widget( 'twitter_widget', __('Knowledge Base - Latest Tweets', 'framework'), $widget_ops );
    }

    function widget($args,  $instance) {

        extract($args);

        $title = apply_filters('widget_title', $instance['title']);

        if ( empty($title) )
        {
            $title = false;
        }

        $twitter_user =  $instance['twitter_user'];
        $tweets_count =  absint($instance['tweets_count']);

        $consumer_key           = $instance['consumer_key'];
        $consumer_secret        = $instance['consumer_secret'];
        $access_token           = $instance['access_token'];
        $access_token_secret    = $instance['access_token_secret'];

        echo $before_widget;

        if($title):
            echo $before_title;
            echo $title;
            echo $after_title;
        endif;

        /* Twitter API Version 1.1 Based Code */
        $transName = 'theme_tweets';
        $cacheTime = 10;

        if(false === ($twitterData = get_transient($transName) ) ){
            require_once 'twitteroauth/twitteroauth.php';

            $twitterConnection = new TwitterOAuth(
                $consumer_key,          // Consumer Key
                $consumer_secret,       // Consumer secret
                $access_token,          // Access token
                $access_token_secret    // Access token secret
            );

            $twitterData = $twitterConnection->get(
                'statuses/user_timeline',
                array(
                    'screen_name'     => $twitter_user,
                    'count'           => $tweets_count,
                    'exclude_replies' => true
                )
            );

            if($twitterConnection->http_code != 200)
            {
                $twitterData = get_transient($transName);
            }
            // Save our new transient.
            set_transient($transName, $twitterData, 60 * $cacheTime);
        }

        if(!empty($twitterData) || !isset($twitterData['error'])){

            $i=0;
            $hyperlinks = true;
            $encode_utf8 = true;
            $twitter_users = true;
            $update = true;

            echo '<div id="twitter_update_list"><ul>';
            foreach($twitterData as $item){
                $msg = $item->text;

                if($encode_utf8) $msg = utf8_encode($msg);

                $msg = $this->encode_tweet($msg);

                echo '<li class="twitter-item">';
                if ($hyperlinks) {    $msg = $this->hyperlinks($msg); }
                if ($twitter_users)  { $msg = $this->twitter_users($msg); }
                echo $msg . '<br>';
                if($update) {
                    $time = strtotime($item->created_at);

                    if ( ( abs( time() - $time) ) < 86400 )
                        $h_time = sprintf( __('%s ago','framework'), human_time_diff( $time ) );
                    else
                        $h_time = date(__('jS M Y','framework'), $time);

                    echo sprintf( __('%s', 'framework'),'<span class="twitter-timestamp">' . $h_time . '</span>' );
                }
                echo '</li>';
                $i++;
                if ( $i >= $tweets_count ) break;
            }
            echo '</ul></div>';
        }

        echo $after_widget;

    }


    function form($instance) {

        $instance = wp_parse_args( (array) $instance, array( 'title'=> __('Latest Tweets', 'framework'), 'twitter_user' => '960development', 'tweets_count' => 2, 'consumer_key' => '', 'consumer_secret' => '', 'access_token' => '', 'access_token_secret' => '' ) );

        $title= esc_attr($instance['title']);
        $twitter_user =  $instance['twitter_user'];
        $tweets_count =  $instance['tweets_count'];

        $consumer_key           = $instance['consumer_key'];
        $consumer_secret        = $instance['consumer_secret'];
        $access_token           = $instance['access_token'];
        $access_token_secret    = $instance['access_token_secret'];

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'framework'); ?></label>
            <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" class="widefat" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('twitter_user'); ?>"><?php _e('Twitter Username', 'framework'); ?></label>
            <input id="<?php echo $this->get_field_id('twitter_user'); ?>" name="<?php echo $this->get_field_name('twitter_user'); ?>" type="text" value="<?php echo $twitter_user; ?>" class="widefat" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('tweets_count'); ?>"><?php _e('Number of tweets', 'framework'); ?></label>
            <input id="<?php echo $this->get_field_id('tweets_count'); ?>" name="<?php echo $this->get_field_name('tweets_count'); ?>" type="text" value="<?php echo $tweets_count; ?>" class="widefat" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('consumer_key'); ?>"><?php _e('Consumer Key', 'framework'); ?></label>
            <input id="<?php echo $this->get_field_id('consumer_key'); ?>" name="<?php echo $this->get_field_name('consumer_key'); ?>" type="text" value="<?php echo $consumer_key; ?>" class="widefat" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('consumer_secret'); ?>"><?php _e('Consumer Secret', 'framework'); ?></label>
            <input id="<?php echo $this->get_field_id('consumer_secret'); ?>" name="<?php echo $this->get_field_name('consumer_secret'); ?>" type="text" value="<?php echo $consumer_secret; ?>" class="widefat" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('access_token'); ?>"><?php _e('Access Token', 'framework'); ?></label>
            <input id="<?php echo $this->get_field_id('access_token'); ?>" name="<?php echo $this->get_field_name('access_token'); ?>" type="text" value="<?php echo $access_token; ?>" class="widefat" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('access_token_secret'); ?>"><?php _e('Access Token Secret', 'framework'); ?></label>
            <input id="<?php echo $this->get_field_id('access_token_secret'); ?>" name="<?php echo $this->get_field_name('access_token_secret'); ?>" type="text" value="<?php echo $access_token_secret; ?>" class="widefat" />
        </p>
        <?php

    }

    function update($new_instance, $old_instance)
    {
        $instance=$old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['twitter_user'] = strip_tags($new_instance['twitter_user']);
        $instance['tweets_count'] = strip_tags($new_instance['tweets_count']);

        $instance['consumer_key']           = strip_tags($new_instance['consumer_key']);
        $instance['consumer_secret']        = strip_tags($new_instance['consumer_secret']);
        $instance['access_token']           = strip_tags($new_instance['access_token']);
        $instance['access_token_secret']    = strip_tags($new_instance['access_token_secret']);

        return $instance;
    }

    /**
     * Find links and create the hyperlinks
     */
    private function hyperlinks($text) {
        $text = preg_replace('/\b([a-zA-Z]+:\/\/[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"$1\" class=\"twitter-link\">$1</a>", $text);
        $text = preg_replace('/\b(?<!:\/\/)(www\.[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"http://$1\" class=\"twitter-link\">$1</a>", $text);
        // match name@address
        $text = preg_replace("/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i","<a href=\"mailto://$1\" class=\"twitter-link\">$1</a>", $text);
        //mach #trendingtopics. Props to Michael Voigt
        $text = preg_replace('/([\.|\,|\:|\¡|\¿|\>|\{|\(]?)#{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/#search?q=$2\" class=\"twitter-link\">#$2</a>$3 ", $text);
        return $text;
    }

    /**
     * Find twitter usernames and link to them
     */
    private function twitter_users($text) {
        $text = preg_replace('/([\.|\,|\:|\¡|\¿|\>|\{|\(]?)@{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/$2\" class=\"twitter-user\">@$2</a>$3 ", $text);
        return $text;
    }

    /**
     * Encode single quotes in your tweets
     */
    private function encode_tweet($text) {
        $text = mb_convert_encoding( $text, "HTML-ENTITIES", "UTF-8");
        return $text;
    }
}

?>