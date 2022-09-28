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
        <link rel='stylesheet' href='/wp-content/plugins/cnalps-geolocator-multiple/Leaflet.markercluster-1.4.1/dist/MarkerCluster.Default.css'>
        <script src='/wp-content/plugins/cnalps-geolocator-multiple/Leaflet.markercluster-1.4.1/dist/leaflet.markercluster.js'></script>
        
        <div id='$id'style='width: 300px; height: 300px;'></div>
        <script>
        fetch('$src')
        .then(response => response.json())
        .then(response => {

        let map$id = L.map('$id');

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href=\"https://www.openstreetmap.org/copyright\">OpenStreetMap</a> contributors'
        }).addTo(map$id);


        let markers = L.markerClusterGroup();
        let markers_bounds = [];
        response.forEach(marker => {
            markers.addLayer(L.marker([marker.lat, marker.lon]).addTo(map$id)
            .bindPopup(marker.title)
            .openPopup());
            markers_bounds.push([marker.lat, marker.lon]);
        });

        map$id.addLayer(markers).fitBounds(markers_bounds,
        {padding:[50,50]}
        );

        })
        .catch(error => alert('Erreur : ' + error));
            
        </script>";
    }
}

$geolocatorMultiple = new GeolocatorMultiple();
