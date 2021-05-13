<?php
include_once('templates/iniciar-html.php');
$localidad = $_GET['localidad'];
?>
<h1>Estadísticas de hurto a personas en Bogotá 2021</h1>
<div id="municipiotxt">Selecciona una localidad</div>
<div id="lienzo"></div>

<!-- <img src="img/mapa.svg"> -->
<div class="grafica">
  <div class="chart-container" style="position: relative; height:600px; width:800px">
  <?php echo '<h1>'.$localidad.'</h1>'; ?>
    <canvas id="myChart"></canvas>
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
        data: {
          labels: ['Enero', 'Febrero', 'Marzo'],
          datasets: [{
            label: 'Hurtos Bogotá',
            data: /* ylabels */ [500, 1000, 2000],
            backgroundColor: [
              '#ffd166'
            ],
            borderColor: [
              '#fff'
            ],
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          scales: {
            xAxes: [{
              gridLines: {
                display: true,
                color: "#FFF"
              }
            }],
            yAxes: [{
              gridLines: {
                display: true,
                color: "#FFF"
              }
            }]
          }
        }
    });
  }

  /* async function getData() {
      const response = await fetch('exportar.csv');
      const data = await response.text();
      //let aux = 1;
      for (let index = 1; index < 7; index++) {
          let contador = 0;
          const table = data.split('\n').slice(1);
          table.forEach(row => {
              const columns = row.split(';');
              const producto = columns[3];
              const temp = columns[2];

              if (index == temp) {
                  contador++;
              } 
          });
          ylabels.push(contador);
      }
      console.log(ylabels);
  } */
</script>


<?php
echo $localidad;
include_once('templates/terminar-html.php');
?>