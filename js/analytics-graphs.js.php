<script type='text/javascript'>
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(webPref);
  google.charts.setOnLoadCallback(visitDur);
  google.charts.setOnLoadCallback(usrMetr);
  google.charts.setOnLoadCallback(visitByHour);
  google.charts.setOnLoadCallback(deviceMetr);

  function webPref() {
    var data = google.visualization.arrayToDataTable([
      ['Month', 'Visit', 'Bounce'],
      <?php
        $j = 0;
        while($i != 0) {
          echo "['".$month[$j]."', ".$visits[$j].", ".$bounces[$j]."],";
          $j++;
          $i--;
        }
      ?>
    ]);


    var options = {
      title: 'Website Performance',
      titleTextStyle:{
        fontSize: 18
      },
      curveType: 'function',
      legend: { position: 'bottom' }
    };

    var chart = new google.visualization.LineChart(document.getElementById('web_perf'));

    chart.draw(data, options);
  }

  function visitDur() {
    var data = google.visualization.arrayToDataTable([
      ['Month', 'Visit Duration'],
      <?php
        while($j != 0) {
          echo "['".$month[$i]."', ".$visits_dur[$i]."],";
          $j--;
          $i++;
        }
      ?>
    ]);

    var options = {
      title: 'Avg. Visit Duration (min)',
      titleTextStyle:{
        fontSize: 18
      },
      curveType: 'function',
      legend: { position: 'bottom' }
    };

    var chart = new google.visualization.LineChart(document.getElementById('visit_dur'));

    chart.draw(data, options);
  }

  function usrMetr() {
    var data = google.visualization.arrayToDataTable([
      ['Month', 'User'],
      <?php
        while($i != 0) {
          echo "['".$month[$j]."', ".$user_number[$j]."],";
          $j++;
          $i--;
        }
      ?>
    ]);

    var options = {
      title: 'User Growth',
      titleTextStyle:{
        fontSize: 18
      },
      curveType: 'function',
      legend: { position: 'bottom' }
    };

    var chart = new google.visualization.LineChart(document.getElementById('usr_metr'));

    chart.draw(data, options);
  }

  function visitByHour() {
    var data = google.visualization.arrayToDataTable([
      ['Time', 'Visits'],
      <?php 
        while($visits_per_hour_rows=mysqli_fetch_assoc($ana_visits_per_hour_result)){
          echo "[".nullFinder($visits_per_hour_rows["hour"]).", ".nullFinder($visits_per_hour_rows["visits"])."],";
        }
      ?>
    ]);

    var options = {
      title: 'Visits Per Hour Of The Day',
      titleTextStyle:{
        fontSize: 18
      },
      curveType: 'function',
      legend: { position: 'bottom' }
    };

    var chart = new google.visualization.LineChart(document.getElementById('visit_by_hour'));

    chart.draw(data, options);
  }

  function deviceMetr() {

    var data = google.visualization.arrayToDataTable([
      ['Device', 'Visit'],
      <?php
        while($row_device = mysqli_fetch_assoc($ana_device_result)) {
      ?>
      ['Desktop',     <?php echo nullFinder($row_device['desktop']); ?>],
      ['Laptop',      <?php echo nullFinder($row_device['laptop']); ?>],
      ['Tablet',      <?php echo nullFinder($row_device['tablet']); ?>],
      ['Smart Phone', <?php echo nullFinder($row_device['smart_phone']); ?>],
      <?php } ?>
    ]);

    var options = {
      title: 'Visits by Device',
      titleTextStyle:{
        fontSize: 18
      },
      pieHole: .5
    };

    var chart = new google.visualization.PieChart(document.getElementById('device_metr'));

    chart.draw(data, options);
  }
</script>