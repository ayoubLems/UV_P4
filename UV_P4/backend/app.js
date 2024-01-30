let apiKey;
let polyline;
let map;

function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: { lat: 0, lng: 0 },
    zoom: 2,
  });

  function addMarker(location, title) {
    new google.maps.Marker({
      position: location,
      map: map,
      title: title,
    });
  }

  function centerMap(location) {
    map.setCenter(location);
  }

  function getUserLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function (position) {
        const userLocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude,
        };

        addMarker(userLocation, 'Votre position');

        centerMap(userLocation);
      }, function () {
        console.error('Erreur de géolocalisation.');
      });
    } else {
      console.error('La géolocalisation n\'est pas prise en charge par votre navigateur.');
    }
  }

  function startTracking() {
    if (navigator.geolocation) {
      navigator.geolocation.watchPosition(updatePosition, handleLocationError);
    } else {
      alert("La géolocalisation n'est pas prise en charge par votre navigateur.");
    }
  }

  function handleLocationError(error) {
    switch (error.code) {
      case error.PERMISSION_DENIED:
        alert("L'utilisateur a refusé la demande de géolocalisation.");
        break;
      case error.POSITION_UNAVAILABLE:
        alert("Les informations de localisation ne sont pas disponibles.");
        break;
      case error.TIMEOUT:
        alert("La demande de géolocalisation a expiré.");
        break;
      default:
        alert("Une erreur inconnue s'est produite lors de la géolocalisation.");
        break;
    }
  }

  function updatePosition(position) {
    const currentLatLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

    if (!polyline) {
      polyline = new google.maps.Polyline({
        path: [currentLatLng],
        geodesic: true,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 2,
        map: map,
      });
    } else {
      const path = polyline.getPath();
      path.push(currentLatLng);
      polyline.setPath(path);
    }
  }

  // Récupérez la clé API depuis le serveur en utilisant une requête AJAX
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "get_api_key.php", true);

  xhr.onload = function () {
    if (xhr.status === 200) {
      apiKey = xhr.responseText;
      if (apiKey) {
        loadGoogleMaps();
      } else {
        console.error('La clé API n\'a pas été trouvée');
      }
    } else {
      console.error('Erreur lors de la récupération de la clé API');
    }
  };

  xhr.send();

  function loadGoogleMaps() {
    const script = document.createElement('script');
    script.src = `https://maps.googleapis.com/maps/api/js?key=${apiKey}&callback=initMap`;
    script.defer = true;
    document.head.appendChild(script);
  }

  // Appel initial pour obtenir la clé API
  getUserLocation();
}
