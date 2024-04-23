<script type="text/javascript">
  google.charts.load("current", {packages:['corechart']});
  google.charts.setOnLoadCallback(balanceOverview);

  function balanceOverview() {
    var data = google.visualization.arrayToDataTable([
      ['Month', 'Revenue', 'Expenses'],
      <?php
        $i = 0;
        while ($i < 12) {
          echo "['".nullFinder($month[$i])."', ".nullFinder($revenue[$i]).", ".nullFinder($expenses[$i])."],";
          $i++;
        }
      ?>
    ]);

    var options = {
      title: 'Balance Overview',
      curveType: 'function',
      titleTextStyle:{
        fontSize: 18
      },
      width: 1068,
      height: 400,
      legend: { position: 'bottom' }
    };

    var chart = new google.visualization.LineChart(document.getElementById('balance-overview'));

    chart.draw(data, options);
  }
</script>