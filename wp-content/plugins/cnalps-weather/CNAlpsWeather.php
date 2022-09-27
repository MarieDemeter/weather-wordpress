<?php

/**
 * Plugin Name: My weather
 */


class CNAlpsWeather
{
    // déclaration d'une propriété



    // déclaration des méthodes

    public function __construct()
    {
        add_shortcode("my_weather", [$this, "print_weather"]);
    }


    function print_weather()
    {
        echo "<div class='cnalps-weather-widget'>
                <div class='weather-title'>Météo à Crest</div>
            </div>";
    }
}

$cnalpsWeather = new CNAlpsWeather();
