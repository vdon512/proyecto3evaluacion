
<!DOCTYPE html>
<html lang="es" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Alumno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="\app\public\css\listar.css" rel="stylesheet">
    <script
			  src="https://code.jquery.com/jquery-3.6.4.js"
			  integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
			  crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
    
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>

  
   <script>
  var dni_alumno = "<?php echo $_SESSION['dni']; ?>";
  var nom_alumno = "<?php echo $_SESSION['nombre']; ?>";
  var email_alumno="<?php echo $_SESSION['email']; ?>";
</script>

    </head>
    <body> 
      
      <header>
  <nav class="navbar navbar-expand-lg" style="background-color: #E8E8E8;">
    
    <div class="container-fluid">
        
        <a class="navbar-brand mt-2 mt-lg-0" href="#">
            <h5 class="pt-1"><?php echo "Hola alumno: ".$_SESSION['nombre']. " email: ".$_SESSION['email'];?></h5>
        </a>
        
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>    
        <div class=" ms-auto" id="navbarSupportedContent">     
            <button id="logoutBtn">Cierrar sessión</button>
           
                </div>
      </div>
</nav>
</header>

<script>
  // agregamo0s un controlador de eventos para el botón con el id "blogoutBtn"
  document.getElementById("logoutBtn").addEventListener("click", function() {
    // se envía una solicitud HTTP POST a logout
    fetch("alumno/logout", {
      //method: "POST"
    }).then(function(response) {
      // redirige a la página de inicio de sesión
      window.location.href = "/App/app/index.php/inicio/principal";
    }).catch(function(error) {
      console.log(error);
    });
  });
</script>

      


      <div class="contenedor">
<canvas id="grafo"></canvas>
</div>
<script>
   function crearGrafico(fecha, notas) {
      const $grafo=document.querySelector("#grafo");
   
   const datos={
    label: "Notas del alumno",
    data:notas,
    borderColor: 'rgba(54,162,235,1)',
    backgroundColor: 'crimson',
    borderWidth: 1,
    cubicInterpolationMode: 'monotone'
   };
   new Chart($grafo, {
    type: 'line',
      data: {
        labels: fecha,
        datasets: [
         datos,
        ]
      },
      options:{
        scales:{
            yAxes:[{
                ticks:{
                    beginAtZero:true
                }
            }],

        },
      }
    }
  );
    }
   
   document.addEventListener('DOMContentLoaded', () => {
    fetch("alumno/datos_grafico?dni=" + dni_alumno)
    .then(response => response.json())
    .then(data => {
      var fechas = [];
      var notas = [];
      let i; 
      for (i = 0; i < data.length-1; i++) {
        fechas.push(data[i]['fecha']);
      notas.push(data[i]['nota']);
       }
       fechas.reverse(); // invertir el orden de los elementos en el array fechas
    notas.reverse(); // invertir el orden de los elementos en el array notas
    
      crearGrafico(fechas, notas);
    })

});
   
</script>


      <script>
 
      fetch("alumno/probar?dni=" + dni_alumno)
        .then(response => response.json())
        .then(data => {
          
          document.getElementById("resultado").innerHTML = "";
         
    
    // crear la tabla
    var table = document.createElement("table");
    table.classList.add("table");
    
    var header = table.createTHead();
    header.classList.add("thead-dark");
    var row = header.insertRow(0);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    cell1.innerHTML = "<b>Día</b>";
    cell2.innerHTML = "<b>Hora</b>";
    cell3.innerHTML = "<b>Asignatura</b>";
    
    // agregamos los datos a la tabla
    var tbody = table.createTBody();
    for (var i = 0; i < data.length; i++) {
      var row = tbody.insertRow(i);
      var cell1 = row.insertCell(0);
      var cell2 = row.insertCell(1);
      var cell3 = row.insertCell(2);
      cell1.innerHTML = data[i].d_clase;
      cell2.innerHTML = data[i].h_clase;
      cell3.innerHTML = data[i].t_clase;
    }
    
    // agregamos la tabla al contenedor
    document.getElementById("resultado").appendChild(table);
    document.getElementById("btn").addEventListener("click", function() {
    // generamos el archivo PDF
    const doc = new jsPDF();
     doc.text("Horrario de "+nom_alumno, 10, 10);
     doc.autoTable({ html: '#resultado table' });
     doc.save('tabla3.pdf');
    });
        })
        .catch(error => console.error(error));
    
          
    </script>
    
  
</script>

     
     
<div id="resultado" class="w-50 p-3 container d-flex align-items-center justify-content-center"></div>

<div class="w-50 p-3 container d-flex align-items-center justify-content-center">
<button id="btn" class="me-4">Imprimir el horrario</button>
  <button id="recursoBtn">Obtener Recursos</button> 
    <ul id="enlaces" class="mx-4 list-group">
   </ul>
</div>
<script>
  
  const recursoBtn = document.getElementById('recursoBtn');
  const enlacesUl = document.getElementById('enlaces');
  enlacesUl.classList.add("list-group");
  let ruta_pdf;

  recursoBtn.addEventListener('click', () => {
    fetch("alumno/get_recurso?email=" + email_alumno)
      .then(response => response.json())
      .then(data => {
       // const ruta_pdf = data.type;
       for (let i = 0; i < data.length; i++) {
        const ruta_pdf = data[i]['recurso'];
        const asignatura_pdf = data[i]['asignatura'];
        const enlace = document.createElement('a');
        enlace.href = ruta_pdf;
        enlace.download = ruta_pdf;
        enlace.type = 'application/pdf';
       // enlace.innerText = 'Descargar recurso ' + i;
        enlace.innerText = asignatura_pdf + i;
        const enlaceLi = document.createElement('li');
        enlaceLi.classList.add("list-group-item");
        enlaceLi.appendChild(enlace);
        enlacesUl.appendChild(enlaceLi);
      }
      })
      .catch(error => {
        console.error(error);
       
      });
  });
  
</script>

<footer class="text-center fixed-bottom">
                  
             
                  <div class="text-center p-3">
                      © Curso 2022/2023   
                  </div>
                 
              </footer>
</body>



 
</html>