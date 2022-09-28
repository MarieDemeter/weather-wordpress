let weather_new_widget = document.querySelector(".cnalps-weather-new-widget");
console.log(weather_new_widget);

fetch("https://www.weatherwp.com/api/common/publicWeatherForLocation.php?city=" + weather_new_widget.getAttribute('data-city') + "&country=" + weather_new_widget.getAttribute('data-country') + "&language=french")
    .then(response => response.json())
    .then(data_API => {
        let html = '<div class="weather-title" style="text-align:center; background-color:#F5F5F5; border-radius:15px; padding:15px; margin:15px;"><img src="' + data_API.icon + '" alt="icon météo"><h4>' + data_API.status_message + '<br>' + data_API.temp + '° <br> </h4><p>' + data_API.description + ' </p></div>';
        weather_new_widget.innerHTML = html;
    })
    .catch(error => alert("Erreur : " + error));

