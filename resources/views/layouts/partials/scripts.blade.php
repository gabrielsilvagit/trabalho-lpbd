<script src="{{ asset("js/jquery-1.11.1.min.js") }}"></script>
<script src="{{ asset("js/bootstrap.min.js") }}"></script>
<script src="{{ asset("js/chart.min.js") }}"></script>
<script src="{{ asset("js/chart-data.js") }}"></script>
<script src="{{ asset("js/easypiechart.js") }}"></script>
<script src="{{ asset("js/easypiechart-data.js") }}"></script>
<script src="{{ asset("js/bootstrap-datepicker.js") }}"></script>
<script src="{{ asset("js/custom.js") }}"></script>
<script src="{{ asset("/js/app.js") }}"></script>
<script>
		window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};
</script>
