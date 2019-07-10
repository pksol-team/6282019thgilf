<?php 

/* Template Name: Flight Search */ 

get_header(); ?>

<section class="flight-search">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="top-heading">
					<h3>Flight Tracker</h3>
				</div>
			</div>
		</div><!-- End Row -->
	</div><!-- End Container -->
	<div class="container">
		<div class="row search-box">
			<div class="col-md-12">
				<div class="search-flight">
					<h5>Search By Flight</h5>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
				   <label for="searchflight">Airline</label>
				   <input type="text" class="form-control" name="search" id="searchflight" placeholder="Example: AA or American Airlines">
				</div>
				<div class="form-group">
				   <br>
				   <label for="flightnumber">Date</label>
				   <input id="datepicker" placeholder="Pick Your Date">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
				   <label for="flightnumber">Airline</label>
				   <input type="text" class="form-control" name="number" id="flightnumber" placeholder="Example: 200">
	            </div>
			</div>
			<div class="col-md-4">
				<h4>Result</h4>
			</div>
			<div class="col-md-12">
				<button class="btn btn-success">Search</button>
			</div>
		</div>
	</div>
	
	<div class="container">
		<div class="row search-box">
			<div class="col-md-12">
				<div class="search-flight">
					<h5>Search by Airport or Route</h5>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
				   <label for="departureairport">Departure Airport</label>
				   <input type="text" class="form-control" name="search" id="departureairport "placeholder="Example: PDX or Portland International Airport">
				</div>
				<br>
				<div class="form-group">
					<label for="searchairline">Airline</label>
					 <input type="text" class="form-control" name="search" id="searchairline" placeholder="Example: AA or American Airlines">
				</div>
				<div class="form-group my-time">
                    <label class="timepicker">Time Picker</label>
                    <input id="start" name="start" type="text" required="required" class="form-control start">
                </div>
			</div>
			<div class="col-md-4">
	            <div class="form-group">
				   <label for="arrivalairport">Arrival Airport</label>
				   <input type="text" class="form-control" name="number" id="arrivalairport" placeholder="Example: PDX or Portland International Airport">
				</div>
				<br>
				<div class="form-group">
				   <label for="flightnumber">Date</label>
				   <input id="datepicker-2" placeholder="Pick Your Date">
				</div>
			</div>
			<div class="col-md-4">
				<h4>Result</h4>
			</div>
			<div class="col-md-12">
				<button class="btn btn-success">Search</button>
			</div>
		</div>
	</div>
</section><!-- End Section -->
<script>
$(document).ready(function () {
    $('#datepicker').datepicker({
      uiLibrary: 'bootstrap'
    });
	$('#datepicker-2').datepicker({
      uiLibrary: 'bootstrap'
    });
});
</script>
<script>
$('.start, .end').timepicker({
      showInputs: false,
	  minuteStep: 1,
  });
</script>
<?php get_sidebar(); ?>
<?php get_footer(); ?>