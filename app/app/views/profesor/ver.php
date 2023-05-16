
<!DOCTYPE html>
<html lang="es" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script
			  src="https://code.jquery.com/jquery-3.6.4.js"
			  integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
			  crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        
   
    <link href="\app\public\css\ver.css" rel="stylesheet">
    <title>Profesor</title>
    <script>
  var tipo_prof = "<?php echo $_SESSION['tipo']; ?>";
</script>
    </head>
    <body> 
    <header>
  <nav class="navbar navbar-expand-lg">
    
    <div class="container-fluid">
        
        <a class="navbar-brand mt-2 mt-lg-0" href="#">
            <h5 class="pt-1"><?php echo "Hola profesor de ".$_SESSION['tipo']." : ".$_SESSION['nombre'];?></h5>
        </a>
        
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>    
        <div class=" ms-auto" id="navbarSupportedContent">     
            <button id="btn">Cierrar sessión</button>
           
                </div>
      </div>
</nav>
</header>


      <main>
        <div class="container" >

<table class="table">
<thead>
    <tr>
      <th scope="col">Día de la semana</th>
      <th scope="col">Horas</th>
      
    </tr>
  </thead>
<tbody>
<?php   
  
  $horarios_por_dia = array();

    foreach ($nombre as $horario) {
        $dia = $horario['dia'];
        if (!isset($horarios_por_dia[$dia])) {
            $horarios_por_dia[$dia] = array();
        }
        $horarios_por_dia[$dia][] = $horario['hora'];
    }
    
    // imprimimos los resultados
    foreach ($horarios_por_dia as $dia => $horas) {
      echo "<tr><td>$dia</td>";
      foreach ($horas as $hora) {
        echo "<td>$hora</td>";
      }
      echo "</tr>";
    }
  ?>
  </tbody>
  </table>

    
    <div><ul id="resultado" class="list-group">La lista de alumnos</ul></div>
   
  </div>
  
  <script>
      window.addEventListener("DOMContentLoaded", (event) => {
  const todo = document.querySelectorAll('.table tbody tr td');
  todo.forEach(td => {
    td.addEventListener("click", (event) => {
      const hora = td.innerText;
      const dia = td.parentNode.firstChild.innerText;  
      fetch(`profesor/tabla_alumnos?&dia=${dia}&hora=${hora}&tipo=${tipo_prof}`)
        .then(response => response.json())
        .then(data => {
          // Limpiar los resultados anteriores
          const ul = document.getElementById('resultado');
          ul.innerHTML = '';
          // Mostrar los nuevos resultados en la página
          for (let i=0; i < data.length; i++) {
            const li = document.createElement('li');
            li.innerText = data[i].nombre + " " + data[i].apellidos + " - " + data[i].email;
            ul.appendChild(li);
          }
        })
        .catch(error => console.error(error));
    });
  });
});
     </script> 
     
     <script>
  // agregamo0s un controlador de eventos para el botón con el id "btn"
  document.getElementById("btn").addEventListener("click", function() {
    // se envía una solicitud HTTP POST a logout.php
    fetch("profesor/logout", {
      //method: "POST"
    }).then(function(response) {
      // redirige a la página de inicio de sesión
      window.location.href = "/App/app/index.php/inicio/principal";
    }).catch(function(error) {
      console.log(error);
    });
  });
</script>
</div>

<div class="container">
        <div class="row justify-content-center">
<form action="http://localhost:8080/App/app/index.php/profesor/moveFile" method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="EmailAlumno" class="form-label">Email del alumno</label>
    <input type="email" class="form-control" id="alumnoEmail" aria-describedby="emailHelp" name="email" id="email">
  </div>
  <div class="mb-3">
  <label for="formFile" class="form-label">Documento</label>
  <input class="form-control" type="file" id="formFile" name="archivo">
</div>
  <button type="submit" class="btn btn-outline-secondary" name="enviar">Añadir</button>
</form>
<?php if(isset($_SESSION['error_message'])): ?>
  <div id="error-message" class="alert alert-danger" role="alert">
    <?php echo $_SESSION['error_message']; ?>
  </div>
  <?php unset($_SESSION['error_message']); ?>
<?php endif; ?>
<?php if(isset($_SESSION['success_message'])): ?>
  <div class="alert alert-success" role="alert">
    <?php echo $_SESSION['success_message']; ?>
  </div>
  <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

</div>
</div>

      </main>
   <footer class="text-center fixed-bottom">
                  
             
                  <div class="text-center p-3">
                      © Curso 2022/2023   
                  </div>
                 
              </footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script>
  // para que el mensaje de error se oculta después de 8 segundos
  setTimeout(function() {
    var errorMessage = document.getElementById('error-message');
    var successMessage = document.getElementById('success-message');
    if (errorMessage) {
      errorMessage.style.display = 'none';
    }
    if (successMessage) {
      errorMessage.style.display = 'none';
    }
  }, 8000);
</script>

</body>
 
</html>