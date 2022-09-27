<?php

/**
 * Plugin Name: My weather
 */


class CNAlpsWeather extends WP_Widget
{
    // déclaration des méthodes
    /*
    public function __construct()
    {
        add_shortcode("my_weather", [$this, "print_weather"]);
    }
    */

    public function __construct()
    {
        parent::__construct(
            'my_weather',
            __('My Weather', 'text_domain'),
            array(
                'customize_selective_refresh' => true,
            )
        );
    }
    /*
    function print_weather()
    {
        echo "<div class='cnalps-weather-widget'>
                <div class='weather-city'>Météo à Crest</div>
            </div>";
    }*/

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
        $city     = isset($instance['city']) ? $instance['city'] : '';
        $country = isset($instance['country']) ? $instance['country'] : '';

        $data_API = $this->CallAPI($city, $country);
        
        // WordPress core before_widget hook (always include )
        echo $before_widget;

        // Display the widget
        echo '<div class="widget-text wp_widget_plugin_box cnalps-weather-widget">
            <div class="weather-title" style="text-align:center; background-color:#E8E8E8; border-radius:15px; padding:15px; margin:15px;">';

        // Display textarea field
        if ($data_API) {
            echo '<img src="' . $data_API->icon . '" alt="icon météo">';
            echo '<h4>' . $data_API->status_message . '<br>' . $data_API->temp . '° <br> </h4><p>' . $data_API->description . ' </p>';
        }

        echo '</div>';

        // WordPress core after_widget hook (always include )
        echo $after_widget;
    }

    function CallAPI($city, $country)
    {
        $curl = curl_init("https://www.weatherwp.com/api/common/publicWeatherForLocation.php?city=$city&country=$country&language=french");

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);

        curl_close($curl);
        return json_decode($result);
    }
}


// Register the widget
function my_register_custom_widget()
{
    register_widget('CNAlpsWeather');
}
add_action('widgets_init', 'my_register_custom_widget');
