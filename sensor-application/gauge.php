<html>
  <head>
		<title>Guage Chart</title>
  </head>
  <body>
    <div id="chart_div" style="width: 400px; height: 120px;"></div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
       google.charts.load('current', {'packages':['gauge']});
       google.charts.setOnLoadCallback(chartStart);


			 var chartManager = {

				 data: "",
				 chart: "",
				 options: {
					 width: 400, height: 120,
					 redFrom: 90, redTo: 100,
					 yellowFrom:75, yellowTo: 90,
					 minorTicks: 5
				 },

				 init: function(){
					 this.data = new google.visualization.arrayToDataTable([
	           ['Label', 'Value'],
	           ['Temperature', 5],
	           ['Humidity', 5],
	         ]);
					 this.chart = new google.visualization.Gauge(document.getElementById('chart_div'));
					 this.chart.draw(this.data, this.options);
					 setTimeout(function(){
						 chartManager.refreshGauges();
					 }, 5000);
				 },

				 refreshGauges: function(){
						this.chart.draw(this.data, this.options);
						setTimeout(function(){
							chartManager.getData();
						}, 5000);
				 },

				 getData: function(){
					 var scope = this;
					 	$.get( "api/sensorData.php", function( data ) {
					  	scope.data = new google.visualization.arrayToDataTable($.parseJSON( data ));
					  	console.log( "Load was performed." );
							chartManager.refreshGauges();
						});
				 },
			 };

			 function chartStart(){
				 chartManager.init();
			 }

     </script>
  </body>
</html>
