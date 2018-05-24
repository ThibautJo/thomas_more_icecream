(function (drupalSettings) {
  console.log(drupalSettings.chart_data);

  google.charts.load('current', {'packages': ['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  var output = [['Isjes en wafels', 'Orders']];

  var charData = drupalSettings.chart_data;

  for(var data in charData){
    console.log(data);
    output.push([data, charData[data]]);
  }

  console.log(output);

  function drawChart() {
    var data = google.visualization.arrayToDataTable(output);

    var options = {
      title: 'Bestelde wafels/ijsjes'
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('chart'));

    chart.draw(data, options);
  }

})(drupalSettings);