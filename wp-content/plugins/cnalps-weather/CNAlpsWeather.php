<?php

/**
 * Plugin Name: My weather
 */


add_action("wp_footer", "print_Weather");


function print_Weather()
{
    echo "<div class='cnalps-weather-widget'>
            <div class='weather-title'>Météo à Crest</div>
        </div>";
}
