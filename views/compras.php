<?php
require '../connections/configODBC.php';
require '../php_library/biblioteca.php';
require '../php_controller/dataAccessObject.php';

require '../php_controller/UserDaoMysql.php';
session_start();
if ($_SESSION['permissao'] == 1 || $_SESSION['permissao'] == 2 || $_SESSION['permissao'] == 3 || $_SESSION['permissao'] == 6) {
  $UserDao = new UserDaoMysql($pdo);
  $isLogged = $UserDao->isLogged($_SESSION['email']);
  if (!$isLogged) {
    header('Location:/dashboard/MGpiscinas/myFirstDashboard/views/login.php');
    exit;
  }


  $dados = comprasAccessData();

  class QtAnoDia
  {
    public $Ano_02; // Ano atual -2 anos
    public $Ano_01; // Ano atual -1 ano
    public $Ano_00; // Ano atual 

    public function  __construct()
    {
      $this->Ano_02 = 0;
      $this->Ano_01 = 0;
      $this->Ano_00 = 0;
    }
  }

  $year = date('Y');

  for ($c = 0; $c <= 11; $c++) {
    $arrayObjMesesAno[] = new QtAnoDia();
  }

  while (odbc_fetch_row($dados)) :
    for ($c = 1; $c <= 12; $c++) :
      $explode_data = explode("-", odbc_result($dados, "DT_ENTRADA"));
      $resulth_total = odbc_result($dados, "TOTAL");
      if ($c === intval($explode_data[1])) {
        if ($explode_data[0] == $year - 2) {
          $arrayObjMesesAno[$c - 1]->Ano_02 += $resulth_total;
        } elseif ($explode_data[0] == $year - 1) {
          $arrayObjMesesAno[$c - 1]->Ano_01 += $resulth_total;
        } elseif ($explode_data[0] == $year) {
          $arrayObjMesesAno[$c - 1]->Ano_00 += $resulth_total;
        }
      }
    endfor;
  endwhile;
} else {
  header('Location:/dashboard/MGpiscinas/myFirstDashboard/views/login.php');
  exit;
}
?>

<title>Compras</title>
<script type="text/javascript" src="../node_modules/chart.js/dist/Chart.js"></script>
<script>
  google.charts.load('current', {
    'packages': ['bar']
  });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Year', '<?php echo $year - 2; ?>', '<?php echo $year - 1; ?>', '<?php echo $year; ?>'],

      <?php
      for ($c = 1; $c <= 12; $c++) :
        $mesNome = findNomeMes($c) ?> //php_library/biblioteca.php
        ['<?= $mesNome ?>', <?= $arrayObjMesesAno[$c - 1]->Ano_02 ?>, <?= $arrayObjMesesAno[$c - 1]->Ano_01 ?>, <?= $arrayObjMesesAno[$c - 1]->Ano_00 ?>],
      <?php endfor; ?>
    ]);

    var options = {
      legend: {
        position: 'in'
      },
      fontName: 'IBM Plex Mono',
      chart: {
        title: 'Relatório de compras',
      }
    };
    var chart = new google.charts.Bar(document.getElementById('dashboard-grafico-compras'));
    chart.draw(data, google.charts.Bar.convertOptions(options));
  }
</script>
</script>

<?php include 'all.php'; ?>

<div class="right-side-dashboard">
  <div class="top-dashboard-mobile left-icon">
    <div class="top-dashboard">
      <i class="fas fa-shopping-cart"></i>
      <span>Compras</span>
    </div>
    <div class="open-close-mobile">
      <div class="open-close-mobile-icon">
        <i class="fas fa-align-justify"></i>
      </div>
    </div>
  </div>

  <div class="content-dashboard compras">
  
    <canvas id="dashboard-grafico-compras" class="dashboard-grafico-compras"></canvas>
    <script>
      var ctx = document.querySelector('#dashboard-grafico-compras').getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [
            <?php for($x=1; $x<=12; $x++) : ?>
              '<?= $x ?>',
            <?php  endfor ?>
          ],
          datasets: [{
              label: '<?= $year -2 ?>',
              data: [
                <?php for($c=1; $c<=12; $c++) : ?> 
                  '<?= $arrayObjMesesAno[$c - 1]->Ano_02 ?>',
                <?php endfor ?>
              ],
              backgroundColor: 'rgba(255, 99, 132, 0.4)',
              borderColor:'rgba(255, 99, 132, 1)',
              borderWidth: 1
            },

            {
              label: '<?= $year -1 ?>',
              data: [
                <?php for($c=1; $c<=12; $c++) : ?> 
                  '<?= $arrayObjMesesAno[$c - 1]->Ano_01 ?>',
                <?php endfor ?>
              ],
              backgroundColor:'rgba(54, 162, 235, 0.4)',
              borderColor:'rgba(54, 162, 235, 1)',
              borderWidth: 1
            },
            
            {
              label: '<?= $year ?>',
              data: [
                <?php for($c=1; $c<=12; $c++) : ?> 
                  '<?= $arrayObjMesesAno[$c - 1]->Ano_00 ?>',
                <?php endfor ?>
              ],
              backgroundColor:'rgba(75, 192, 192, 0.4)',
              borderColor: 'rgba(75, 192, 192, 1)',
              borderWidth: 1
            }
          ]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    </script>

  </div>
</div>
</div>

<script src="../plugins/jquery-3.5.1/jquery-3.5.1.js"></script>
<script src="../plugins/bootstrap-4.5.3/js/bootstrap.min.js"></script>
<script src="../plugins/fontawesome5.15.1/js/all.min.js"></script>
<script src="../js/all.js"></script>
<script type="module" src="../js/script.js"></script>
</body>

</html>