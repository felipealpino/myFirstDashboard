<?php
require '../connections/configODBC.php';
require '../php_library/biblioteca.php';
require '../php_controller/dataAccessObject.php';

require '../php_controller/UserDaoMysql.php';
session_start();

$UserDao = new UserDaoMysql($pdo);
$isLogged = $UserDao->isLogged($_SESSION['email']);
if(!$isLogged){
    header('Location:/dashboard/MGpiscinas/myFirstDashboard/views/login.php');
    exit;
}


$dados = comprasAccessData();

class QtAnoDia {
  public $Ano_02; // Ano atual -2 anos
  public $Ano_01; // Ano atual -1 ano
  public $Ano_00; // Ano atual 

  public function  __construct() {
    $this->Ano_02 = 0;
    $this->Ano_01 = 0;
    $this->Ano_00 = 0;
  }
}

$year = date('Y');

for ($c=0; $c<=11; $c++){
  $arrayObjMesesAno[] = new QtAnoDia(); 
}

while (odbc_fetch_row($dados)):
  for($c=1; $c<=12; $c++):
    $explode_data = explode("-",odbc_result($dados,"DT_ENTRADA"));
    $resulth_total = odbc_result($dados,"TOTAL");
    if ($c === intval($explode_data[1])) {
      if($explode_data[0] == $year-2){
        $arrayObjMesesAno[$c-1]->Ano_02 += $resulth_total;
      } elseif ($explode_data[0] == $year-1){
        $arrayObjMesesAno[$c-1]->Ano_01 += $resulth_total;
      } elseif ($explode_data[0] == $year){
        $arrayObjMesesAno[$c-1]->Ano_00 += $resulth_total;
      }
    }
  endfor;
endwhile;

?>

<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/all.css">
  <link rel="stylesheet" href="../plugins/bootstrap-4.5.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="../plugins/fontawesome5.15.1/css/all.min.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script>
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Year', '<?php echo $year-2;?>', '<?php echo $year-1;?>', '<?php echo $year;?>'],
    
    <?php
      for($c=1; $c<=12; $c++): 
        $mesNome = findNomeMes($c) ?> //php_library/biblioteca.php
        ['<?=$mesNome?>', <?=$arrayObjMesesAno[$c-1]->Ano_02?>, <?=$arrayObjMesesAno[$c-1]->Ano_01 ?>, <?=$arrayObjMesesAno[$c-1]->Ano_00?>],
    <?php endfor; ?>
      
        // ['Janeiro', 1000, 400, 200],
        // ['Fevereiro', 1170, 460, 250],
        // ['Março', 660, 1120, 300],
        // ['Abril', 1030, 540, 350],
        // ['Maio', 1030, 540, 350],
        // ['Junho', 1030, 540, 350],
        // ['Julho', 1030, 540, 350],
        // ['Agosto', 1030, 540, 350],
        // ['Setembro', 1030, 540, 350],
        // ['Outubro', 1030, 540, 350],
        // ['Novembro', 1030, 540, 350],
        // ['Dezembro', 1030, 540, 350],
      ]);

      var options = {
        legend: {position:'in'},
        chart: {
          title: 'Relatório de compras',
        }
      };
      var chart = new google.charts.Bar(document.getElementById('dashboard-grafico-compras'));
      chart.draw(data, google.charts.Bar.convertOptions(options));
    }
  </script>
  </script>

      <?php include 'all.php';?>

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
          <div id="dashboard-grafico-compras" class="dashboard-grafico-compras"></div>
        </div>
      </div>
  </div>

  <script src="../plugins/jquery-3.5.1/jquery-3.5.1.js"></script>
  <script src="../plugins/bootstrap-4.5.3/js/bootstrap.min.js"></script>
  <script src="../plugins/fontawesome5.15.1/js/all.min.js"></script>
  <script src="../js/all.js"></script>
  <script src="../js/googleCharts.js"></script>
</body>
</html>