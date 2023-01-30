<!DOCTYPE html>
<html>
  <head>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body>
    <div id="container">
      <div class="chart_container">
        <div id="pie_chart" style="width: 100%; height: 400px;"></div>
      </div>
      <div class="chart_container">
        <div id="year-selector">
          <label for="year">Viti:</label>
          <select id="year">
            <option value="2023">2023</option>
            <option value="2022">2022</option>
            <option value="2021">2021</option>
          </select>
        </div>
        <div id="bar-chart" style="width: 100%; height: 400px;"></div>
      </div>
    </div>
    
    <script>
      $(document).ready(function() {
        $("#year").change(function() {
          const selectedYear = $(this).val();
          updateBarChart(selectedYear);
        });

        function updatePieChart() {
          $.getJSON('data.php', function (data) {
            Highcharts.chart('pie_chart', {
              chart: {
                  plotBackgroundColor: null,
                  plotBorderWidth: null,
                  plotShadow: false,
                  type: 'pie'
              },
              title: {
                  text: 'Poroite e Produkteve'
              },
              series: [{
                  name: 'Numri i Porosive',
                  colorByPoint: true,
                  data: data.map(item => {
                    return {
                      name: item.name,
                      y: item.orders
                    }
                  })
              }]
            });
          });
        }
        
        function updateBarChart(selectedYear) {
          $.getJSON(`data.php?query=orders&year=${selectedYear}`, function(data) {
            Highcharts.chart("bar-chart", {
              chart: {
                type: "bar"
              },
              title: {
                text: "Porosite e Produkteve sipas Muajve"
              },
              xAxis: {
                categories: data.map(item => item.month),
              },
              yAxis: {
                min: 0,
                title: {
                  text: "Numri i Porosive"
                }
              },
              series: [
                {
                  name: "Numri i Porosive",
                  data: data.map(item => item.orders)
                }
              ]
            });
          });
        }

        updatePieChart();
        updateBarChart($("#year").val());
      });
    </script>
  </body>
</html>
