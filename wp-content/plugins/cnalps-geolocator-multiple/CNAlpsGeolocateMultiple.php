<?php

/**
 * Plugin Name: My multiple geolocator
 */

class GeolocatorMultiple
{
    public function __construct()
    {
        add_shortcode('CNAlpsGeolocateMultiple', array($this, 'cnalps_register_geolocate_multiple_shortcode'));
    }

    /**
     * Minimalistic geolocator Shortcode
     *
     * @param array $atts Shortcode attributes. Default empty.
     * @return string Shortcode output.
     */
    function cnalps_register_geolocate_multiple_shortcode($atts = [])
    {
        // normalize attribute keys, lowercase
        $atts = array_change_key_case((array) $atts, CASE_LOWER);
        $src = $atts['src'];
        $id = $atts['id'];

        //https://mocki.io/v1/63970038-d66e-4d8c-a18f-adeb19f7adbe

        return "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.8.0/leaflet.css'>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.8.0/leaflet.js'></script>
        
        <div id='$id'style='width: 300px; height: 300px;'></div>
        <script>
        fetch('$src')
        .then(response => response.json())
        .then(response => {

        let map$id = L.map('$id').fitBounds([
            [response[0].lat, response[0].lon],
            [response[1].lat, response[1].lon],
        ],
        {padding:[50,50]}
        );

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href=\"https://www.openstreetmap.org/copyright\">OpenStreetMap</a> contributors'
        }).addTo(map$id);


        response.forEach(marker => {
            L.marker([marker.lat, marker.lon]).addTo(map$id)
            .bindPopup(marker.title)
            .openPopup();
        });
        
        })
        .catch(error => alert('Erreur : ' + error));
            
        </script>";
    }
}

$geolocatorMultiple = new GeolocatorMultiple();
