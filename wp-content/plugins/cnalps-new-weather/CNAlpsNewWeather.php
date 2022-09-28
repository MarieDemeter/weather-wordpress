<?php

/**
 * Plugin Name: My new weather
 */


class CNAlpsnewWeather extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'my_new_weather',
            __('My new Weather', 'text_domain'),
            array(
                'customize_selective_refresh' => true,
            )
        );
        add_action('wp_footer',array($this,'my_plugin_assets'));
    }

    function my_plugin_assets() {
        wp_register_script( 'my_new_weather', plugins_url( 'script.js' , __FILE__ ) );
        wp_enqueue_script( 'my_new_weather' );
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
        
        // WordPress core before_widget hook (always include )
        echo $before_widget;

        // Display the widget
        echo '<div class="widget-text wp_widget_plugin_box cnalps-weather-new-widget" data-city="'.$city.'" data-country="'.$country.'"></div>';

        // WordPress core after_widget hook (always include )
        echo $after_widget;
    }
}

// Register the widget
function my_register_new_custom_widget()
{
    register_widget('CNAlpsnewWeather');
}
add_action('widgets_init', 'my_register_new_custom_widget');
