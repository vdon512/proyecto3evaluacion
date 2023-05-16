<!DOCTYPE html>
<html lang="es" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Como llegar </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
// Initialize and add the map
function initMap() {
  // The location of Uluru
  const uluru = { lat: -25.344, lng: 131.031 };
  // The map, centered at Uluru
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 4,
    center: uluru,
  });
  // The marker, positioned at Uluru
  const marker = new google.maps.Marker({
    position: uluru,
    map: map,
  });
}

window.initMap = initMap;

const form = document.getElementById("directions-form");
form.addEventListener("submit", function(event) {
  event.preventDefault();
  const origin = document.getElementById("origin").value;
  const destination = document.getElementById("destination").value;
  const mode = document.getElementById("mode").value;
  const directionsService = new google.maps.DirectionsService();
  const directionsRenderer = new google.maps.DirectionsRenderer();
  directionsRenderer.setMap(map);
  const request = {
    origin: origin,
    destination: destination,
    travelMode: mode
  };
  directionsService.route(request, function(result, status) {
    if (status === "OK") {
      directionsRenderer.setDirections(result);
    }
  });
});
</script>

  <style>
    #directions-form {
      margin-top: 1em;
    }
  
    #map {
      height: 400px;
      width: 100%;
    }
  


</style>
  </head>
  <body class="ver">
  <header>
  <nav class="navbar navbar-expand-lg" style="background-color: #E8E8E8;">
    
    <div class="container-fluid">
        
        <a class="navbar-brand mt-2 mt-lg-0" href="#">
            <h5 class="pt-1" style="color: gray;font-family: Georgia, serif;font-size:25px;">Hola Usuario</h5>
        </a>
        
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>    
        <div class=" ms-auto" id="navbarSupportedContent">     
            <button id="volverBtn" style="border:0;color: gray;font-family: Georgia, serif;font-size:25px">Volver</button>
           
                </div>
      </div>
</nav>
</header>
<script>
  // agregamo0s un controlador de eventos para el botón con el id "volverBtn"
  document.getElementById("volverBtn").addEventListener("click", function() {
    
   
      // redirige a la página de inicio de sesión
      window.location.href = "/App/app/index.php/inicio/principal";
    
  });
</script>

<div id="map">
    hola ver
</div>
<div class="container">
  <form id="directions-form">
    <div class="mb-3">
      <label for="origin" class="form-label">Origen</label>
      <input type="text" class="form-control" id="origin" name="origin" required>
    </div>
    <div class="mb-3">
      <label for="destination" class="form-label">Destino</label>
      <input type="text" class="form-control" id="destination" name="destination" required>
    </div>
    <div class="mb-3">
      <label for="mode" class="form-label">Medio de transporte</label>
      <select class="form-control" id="mode" name="mode" required>
        <option value="driving">Automóvil</option>
        <option value="walking">Andando</option>
        <option value="bicycling">Bicicleta</option>
        <option value="transit">Transporte público</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Buscar ruta</button>
  </form>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAnYfZ3tgMlKOAkjdj-9Op65hDxzXaF4AU&libraries=places&callback=initMap" defer></script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&v=weekly" defer></script>

 <footer class="text-center fixed-bottom">
                  
             
                  <div class="text-center p-3" style=" background-color: #d6d5d5;color: rgb(146, 146, 146);font-family: Georgia, serif;font-weight:lighter;font-size:20px;">
                      © Curso 2022/2023   
                  </div>
                 
              </footer>

  </body>
</html>
