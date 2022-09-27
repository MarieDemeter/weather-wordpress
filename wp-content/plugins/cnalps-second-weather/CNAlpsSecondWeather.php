<?php

/**
 * Plugin Name: My second weather
 */


class CNAlpsSecondWeather extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'my_second_weather',
            __('My second Weather', 'text_domain'),
            array(
                'customize_selective_refresh' => true,
            )
        );
    }

    // The widget form (for the backend )
    public function form($instance)
    {

        // Set widget defaults
        $defaults = array(
            'city'    => '',
            'country'     => '',
        );

        // Parse current settings with defaults
        extract(wp_parse_args((array) $instance, $defaults)); ?>

        <?php // Widget Title 
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('city')); ?>"><?php _e('Quelle ville souhaitez-vous choisir ?', 'text_domain'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('city')); ?>" name="<?php echo esc_attr($this->get_field_name('city')); ?>" type="text" value="<?php echo esc_attr($city); ?>" />
        </p>

        <?php // Text Field 
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('country')); ?>"><?php _e('Dans quel pays se trouve cette ville ?', 'text_domain'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('country')); ?>" name="<?php echo esc_attr($this->get_field_name('country')); ?>" type="text" value="<?php echo esc_attr($country); ?>" />
        </p>

<?php }

    // Update widget settings
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['city']    = isset($new_instance['city']) ? wp_strip_all_tags($new_instance['city']) : '';
        $instance['country']     = isset($new_instance['country']) ? wp_strip_all_tags($new_instance['country']) : '';
        return $instance;
    }
    // Display the widget
    public function widget($args, $instance)
    {

        extract($args);

        // Check the widget options
        $city = isset($instance['city']) ? $instance['city'] : '';
        $country = isset($instance['country']) ? $instance['country'] : '';

        $response_API = wp_remote_get("https://www.weatherwp.com/api/common/publicWeatherForLocation.php?city=$city&country=$country&language=french");
        $data_API = json_decode(wp_remote_retrieve_body( $response_API ));
        
        // WordPress core before_widget hook (always include )
        echo $before_widget;

        // Display the widget
        echo '<div class="widget-text wp_widget_plugin_box cnalps-weather-widget">
            <div class="weather-title" style="text-align:center; background-color:#F5F5F5; border-radius:15px; padding:15px; margin:15px;">';

        // Display textarea field
        if ($data_API) {
            echo '<img src="' . $data_API->icon . '" alt="icon météo">';
            echo '<h4>' . $data_API->status_message . '<br>' . $data_API->temp . '° <br> </h4><p>' . $data_API->description . ' </p>';
        }

        echo '</div></div>';

        // WordPress core after_widget hook (always include )
        echo $after_widget;
    }

}


// Register the widget
function my_register_second_custom_widget()
{
    register_widget('CNAlpsSecondWeather');
}
add_action('widgets_init', 'my_register_second_custom_widget');
