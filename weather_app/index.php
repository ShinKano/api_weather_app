<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
 

    <style>
        body {
            background-color: #fcfcfc;
            color: rgb(81, 68, 161);
        }
        h1, h3 {
            font-weight: 100;
        }

        .container {
            padding: 30px;
            height: auto;
            width: 60%;
            margin: 0px auto;
        }
        .icon img {
            width: 100%;
            margin-bottom: 40px;
        }

        @media screen and (min-width:860px) {
            .icon img {
            width: 56%;
            margin-bottom: 30px;
            }
        }

        .flex-parent {
            display: flex;
        }
        .title-text {
            width: 16%;
        }
    
    
    </style>
    <title>GetWeather</title>
</head>
<body>
    <div class="container">
        <div class="weather"></div>
        <div class="icon"></div>
        <div class="flex-parent">
            <div class="title-text"><h3><i class="fas fa-temperature-low"></i></h3></div>
            <div class="temperature"></div>
        </div>
        <div class="flex-parent">
            <div class="title-text"><h3><i class="fas fa-tint"></i></h3></div>
            <div class="humidity"></div>
        </div>
        <div class="flex-parent">
            <div class="title-text"><h3><i class="fas fa-umbrella"></i></h3></div>
            <div class="precipProbability"></div>
        </div>
        
    </div>

    


<script src="https://kit.fontawesome.com/75e40396bd.js"></script>
<script>
    
let latitude;
let longitude;
let currentDate;

const divWeather = document.querySelector('.weather');
const divIcon = document.querySelector('.icon');
const divTemperature = document.querySelector('.temperature');
const divHumidity = document.querySelector('.humidity');
const divPrecipProbability = document.querySelector('.precipProbability');

window.onload = function() {
    navigator.geolocation.getCurrentPosition(getCurrentPositionAndDate);
};

function getCurrentPositionAndDate(position) {

    latitude = position.coords.latitude.toString();
    longitude = position.coords.longitude.toString();
    currentDate = new Date(position.timestamp);
    console.log(latitude, longitude, currentDate)
    console.log(typeof latitude)
    fetchApi();
}

function fetchApi() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           // Typical action to be performed when the document is ready:
           jason = JSON.parse(xhttp.responseText);

           let weather = jason.currently.icon;
           let humidity = (jason.currently.humidity * 100).toString();
           let temperature = (parseInt(jason.currently.temperature - 30) / 2).toString();
           let precipProbability = (jason.currently.precipProbability * 100).toString();
           console.log(weather);
           
           divWeather.innerHTML = `<h1>${weather}</h1>`;
           divIcon.innerHTML = `<img src='image/${weather}.svg'>`;
           divTemperature.innerHTML = `<h3>${temperature} &#8451;</h3>`;
           divHumidity.innerHTML = `<h3>${humidity} %</h3>`;
           divPrecipProbability.innerHTML = `<h3>${precipProbability} %</h3>`;
        }
    };
    xhttp.open('GET', `https://cors-anywhere.herokuapp.com/https://api.darksky.net/forecast/[apikey]/${latitude},${longitude}`, true);
    xhttp.send();
};
function writeHtml() {
};




</script>

</body>
</html>