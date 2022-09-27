<?php

/**
 * Plugin Name: My geolocator
 */

class Geolocator
{
    public function __construct()
    {
        add_shortcode('CNAlpsGeolocate', array($this, 'cnalps_register_geolocate_shortcode'));
    }

    /**
     * Minimalistic geolocator Shortcode
     *
     * @param array $atts Shortcode attributes. Default empty.
     * @return string Shortcode output.
     */
    function cnalps_register_geolocate_shortcode($atts = [])
    {
        // normalize attribute keys, lowercase
        $atts = array_change_key_case((array) $atts, CASE_LOWER);
        $latitude = $atts['latitude'];
        $longitude = $atts['longitude'];
        $zoom = $atts['zoom'];
        $id = $atts['id'];

        return '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.8.0/leaflet.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.8.0/leaflet.js"></script>
        
        <div id="'.$id.'" style="width: 300px; height: 300px;"></div>
        <script>
            let map'.$id.' = L.map(\''.$id.'\').setView([' . $latitude . ', ' . $longitude . '], '.$zoom.');
        
            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution: \'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors\'
            }).addTo(map'.$id.');
        
            L.marker(['.$latitude.','.$longitude.']).addTo(map'.$id.')
                .bindPopup(\'La Tour de Crest\')
                .openPopup();
        </script>';
    }
}

$geolocator = new Geolocator();
