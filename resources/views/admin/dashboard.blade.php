@extends('admin.layouts.app')

@section('css')
    <style>
        canvas{
			-moz-user-select: none;
			-webkit-user-select: none;
			-ms-user-select: none;
		}
		.chart-container {
			width: 500px;
			margin-left: 40px;
			margin-right: 40px;
			margin-bottom: 40px;
		}
		.container {
			display: flex;
			flex-direction: row;
			flex-wrap: wrap;
			justify-content: center;
		}
    </style>
@endsection

@section('content')
    <h1>DASHBOARD</h1>

	<br><br>
	<br><br>
	<h2>Active Products: {{ $active_products }}</h2>
	<br>
	<h2>COMMODITY COST: {{ $commodity_cost }}</h2>
	
	<div class="container tbg-white tflex">
	</div>
	
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <script src="https://www.chartjs.org/samples/latest/utils.js"></script>
    <script>
   function createConfig(gridlines, title) {
			return {
				type: 'line',
				data: {
					labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
					datasets: [{
						label: 'My First dataset',
						backgroundColor: window.chartColors.red,
						borderColor: window.chartColors.red,
						data: [10, 30, 39, 20, 25, 34, 0],
						fill: false,
					}, {
						label: 'My Second dataset',
						fill: false,
						backgroundColor: window.chartColors.blue,
						borderColor: window.chartColors.blue,
						data: [18, 33, 22, 19, 11, 39, 30],
					}]
				},
				options: {
					responsive: true,
					title: {
						display: true,
						text: title
					},
					scales: {
						xAxes: [{
							gridLines: gridlines
						}],
						yAxes: [{
							gridLines: gridlines,
							ticks: {
								min: 0,
								max: 100,
								stepSize: 10
							}
						}]
					}
				}
			};
		}

		window.onload = function() {
			var container = document.querySelector('.container');

			[{
				title: 'Display: true',
				gridLines: {
					display: true
				}
			}, {
				title: 'Display: false',
				gridLines: {
					display: false
				}
			}, {
				title: 'Display: false, no border',
				gridLines: {
					display: false,
					drawBorder: false
				}
			}, {
				title: 'DrawOnChartArea: false',
				gridLines: {
					display: true,
					drawBorder: true,
					drawOnChartArea: false,
				}
			}, {
				title: 'DrawTicks: false',
				gridLines: {
					display: true,
					drawBorder: true,
					drawOnChartArea: true,
					drawTicks: false,
				}
			}].forEach(function(details) {
				var div = document.createElement('div');
				div.classList.add('chart-container');

				var canvas = document.createElement('canvas');
				div.appendChild(canvas);
				container.appendChild(div);

				var ctx = canvas.getContext('2d');
				var config = createConfig(details.gridLines, details.title);
				new Chart(ctx, config);
			});
		};
    </script>    
@endsection