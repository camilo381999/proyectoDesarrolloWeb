<?php
include_once('templates/iniciar-html.php');
include_once('Datos.php');

$actual_link = "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
//echo $actual_link;
$porciones = explode("?", $actual_link);
//echo count($porciones);
$localidad = "";
$localidadDB = "";
$datos = new Datos();

if (count($porciones) > 1) {
  $localidad = $_GET['localidad'];

  switch ($localidad) {
    case 'Usaquen':
      $localidadDB = '01 - USAQUÉN';
      break;
    case 'Chapinero':
      $localidadDB = '02 - CHAPINERO';
      break;
    case 'Santafé':
      $localidadDB = '03 - SANTA FE';
      break;
    case 'San Cristobal':
      $localidadDB = '04 - SAN CRISTÓBAL';
      break;
    case 'Usme':
      $localidadDB = '05 - USME';
      break;
    case 'Tunjuelito':
      $localidadDB = '06 - TUNJUELITO';
      break;
    case 'Bosa':
      $localidadDB = '07 - BOSA';
      break;
    case 'Kennedy':
      $localidadDB = '08 - KENNEDY';
      break;
    case 'Fontibon':
      $localidadDB = '09 - FONTIBÓN';
      break;
    case 'Engativa':
      $localidadDB = '10 - ENGATIVÁ';
      break;
    case 'Suba':
      $localidadDB = '11 - SUBA';
      break;
    case 'Barrios unidos':
      $localidadDB = '12 - BARRIOS UNIDOS';
      break;
    case 'Teusaquillo':
      $localidadDB = '13 - TEUSAQUILLO';
      break;
    case 'Martires':
      $localidadDB = '14 - LOS MÁRTIRES';
      break;
    case 'Antonio Nariño':
      $localidadDB = '15 - ANTONIO NARIÑO';
      break;
    case 'Puente aranda':
      $localidadDB = '16 - PUENTE ARANDA';
      break;
    case 'La candelaria':
      $localidadDB = '17 - CANDELARIA';
      break;
    case 'Rafael uribe':
      $localidadDB = '18 - RAFAEL URIBE URIBE';
      break;
    case 'Ciudad Bolivar':
      $localidadDB = '19 - CIUDAD BOLÍVAR';
      break;
    case 'Sumapaz':
      $localidadDB = '99 - SIN LOCALIZACION';
      break;
  }
  $hurtos = $datos->selectByLocalidad($localidadDB);
  $modalidad = $datos->selectModalidadByLocalidad($localidadDB);
  $momento = $datos->selectMomentoByLocalidad($localidadDB);
} else {
  $localidad = "Bogotá";
  $hurtos = $datos->selectAll();
  $modalidad = $datos->selectModalidad();
  $momento = $datos->selectMomento();
}
?>
<h1>Estadísticas de hurto a personas en Bogotá 2021</h1>

<div class="container">
  <div class="row">
    <!-- mapa -->
    <div class="col-md-5 col-sm-12 col-xs-12">
      <div id="municipiotxt">Selecciona una localidad</div>
      <div class="center-block">
        <div id="map">
          <script src="js/main.js"></script>
        </div>
      </div>
    </div>

    <!-- Otros datos de analisis -->
    <div class="col-md-7 col-sm-12 col-xs-12">
      <?php echo '<h3>' . $localidad . '</h3>'; ?><br>
      <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Modalidad de hurto</h5>
          <h6 class="card-subtitle mb-2 text-muted">Las 3 modalidades mas comunes de hurto en <?php echo $localidad; ?> son: </h6>
          <p class="card-text">1. <?php echo $modalidad[0][0]; ?></p>
          <p class="card-text">2. <?php echo $modalidad[1][0]; ?></p>
          <p class="card-text">3. <?php echo $modalidad[2][0]; ?></p>
        </div>
      </div>
<br>
      <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Momento del día</h5>
          <h6 class="card-subtitle mb-2 text-muted">El momento del día en que mas hurtos se presentan en <?php echo $localidad; ?> es en la: </h6>
          <p class="card-text"><?php echo $momento[0]; ?></p>
        </div>
      </div>
    </div>

    <!-- Grafica de barras -->
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="grafica">
        <div class="chart-container" style="position: relative; height:600px; width:800px">
          <canvas id="myChart"></canvas>
        </div>
      </div>
    </div>
  </div>





</div>





<script>
  const ylabels = [];
  chartIt();
  async function chartIt() {
    //await getData();
    const ctx = document.getElementById('myChart').getContext('2d');

    const myChart = new Chart(ctx, {
      type: 'bar',
      options: {
        plugins: {
          /*title: {
            display: true,
            text: 'Custom Chart Title',
            color: '#fff'
          },
          legend: {
            display: true,
            labels: {
              color: '#fff'
            }
          }*/
        },
        scales: {
          xAxes: [{
            gridLines: {
              color: "rgba(0, 0, 0, 0)",
            }
          }],
          yAxes: [{
            gridLines: {
              color: "rgba(0, 0, 0, 0)",
            }
          }]
        }
      },
      data: {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril'],
        datasets: [{
          label: 'Hurtos Bogotá',
          data: /* ylabels */ [<?php echo $hurtos[0]; ?>, <?php echo $hurtos[1]; ?>, <?php echo $hurtos[2]; ?>, <?php echo $hurtos[3]; ?>],
          backgroundColor: [
            '#ffd166'
          ],
          borderColor: [
            '#fff'
          ],
          borderWidth: 1
        }]
      }

    });
  }
</script>


<?php
echo $localidad;
include_once('templates/terminar-html.php');
?>