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

        // WordPress core before_widget hook (always include )
        echo $before_widget;

        // Display the widget
        echo '<div class="widget-text wp_widget_plugin_box cnalps-weather-widget">
            <div class="weather-title">Météo à ';

        // Display textarea field
        if ($city) {
            echo $city;
        }

        // Display text field
        /*
        if ($country) {
            echo '<p>' . $country . '</p>';
        }*/

        echo '</div>';

        // WordPress core after_widget hook (always include )
        echo $after_widget;
    }
}


// Register the widget
function my_register_custom_widget()
{
    register_widget('CNAlpsWeather');
}
add_action('widgets_init', 'my_register_custom_widget');
