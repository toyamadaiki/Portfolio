<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    <?php
      session_start();
      $nyuji = $_SESSION['nyuji'];
      $youji = $_SESSION['youji'];
      $syougaku_tei = $_SESSION['syougaku_tei'];
      $syougaku_kou = $_SESSION['syougaku_kou'];
      $tyuugaku = $_SESSION['tyuugaku'];
      $koukou = $_SESSION['koukou'];
      
      

      ?>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = google.visualization.arrayToDataTable([
        ['Task', '寄贈冊数'],
        ['乳児向け', <?php echo $nyuji; ?>], 
        ['幼児向け',      <?php echo $youji; ?>],
        ['小学校低~中学年',  <?php echo $syougaku_tei; ?>],
        ['小学校中~高学年', <?php echo $syougaku_kou; ?>],
        ['中学生',    <?php echo $tyuugaku; ?>],
        ['高校生',    <?php echo $koukou; ?>]
      ]);

      var options = {
        title: '年代別統計情報',
        // bars: 'horizontal'. // Add this line to change the chart type to horizontal bars
        hAxis: {format: '#'}
      };

      var chart = new google.visualization.BarChart(document.getElementById('piechart')); // Change this line to create a BarChart instead of a PieChart

      chart.draw(data, options);
    }
  </script>
  <title>寄贈図書統計</title>
</head>
<body>
  <div id="piechart" style="width: 900px; height: 500px;"></div>
  <a href="isbncheck.html">戻る</a>
</body>