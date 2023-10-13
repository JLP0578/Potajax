@extends('layouts.app')

@section('content')

    @manager
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

        <div class="card" style="width: 400px;">
		  <div class="card-body">
		    <h2 class="card-title text-center"> Nombre total de visites </h2>
		    <h3 class="card-text text-center mt-4"> {{ $allVisits }} </h3>
		  </div>
		</div>

        <div class="divContainer">
        	<canvas id="chart"></canvas>
        </div>

	    <script type="text/javascript">
	    	let myChart = document.getElementById('chart').getContext('2d');

	    	var visits = @json($visits);

        	var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        	var currentMonth = new Date().getMonth();

        	var orderedMonth = months.slice(currentMonth-6).concat(months.slice(0, currentMonth+1));

	    	let lineChart = new Chart(myChart, {
	    		type: 'line',
	    		data: {
	    			labels: orderedMonth,
	    			datasets: [{
	    				label: 'Nombre de visites par mois',
	    				data: orderedMonth.map((month)=> {return visits?.[month]}),
	    				fill: false,
                        borderColor: "rgb(255, 0, 0)",
                        lineTension: 0.1
	    			}]
	    		},
	    		options: {
	    			scales: {
	    				yAxes: [{
	    					ticks: {
	    						beginAtZero: true
	    					}
	    				}]
	    			}
	    		}
	    	});
	    </script>
    @endmanager

@endsection
