<?php get_header(); ?>
<div class="row">
  <div class="col-md-12">
    <main id="content">
      <?php if ( is_singular() ) {
        echo '<h1 class="entry-title">';
        } else {
        echo '<h2 class="entry-title">';
        } ?>
    	<?php the_title(); ?>
      <?php if ( is_singular() ) {
        echo '</h1>';
        } else {
        echo '</h2>';
        } ?>
      <ul class="address-info">
		<li>
          <p><i class="fa fa-pencil-square-o"></i> <a href="#respond">Leave a Review </a> </p>
        </li>  
      </ul>

	<?php 
	  
		$airport_id = get_the_ID();

		$iata = get_post_meta($airport_id, 'iata', true);	
		$icao = get_post_meta($airport_id, 'icao', true);	
		$city = get_post_meta($airport_id, 'city', true);	
		$countryName = get_post_meta($airport_id, 'countryName', true);	

		$fs = get_post_meta($airport_id, 'fs', true);	
		
		$regionName = get_post_meta($airport_id, 'regionName', true);	
		$timeZoneRegionName = get_post_meta($airport_id, 'timeZoneRegionName', true);	


		$latitude = get_post_meta($airport_id, 'latitude', true);	
		$longitude = get_post_meta($airport_id, 'longitude', true);
	 
	?>

		<table class="airport_meta_data table-striped table-bordered">

			<?php if ($iata != ""): ?>
				<tr>
					<td>IATA</td>
					<td><?= $iata; ?></td>
				</tr>
			<?php endif ?>

			<?php if ($icao != ""): ?>
				<tr>
					<td>ICAO</td>
					<td><?= $icao; ?></td>
				</tr>
			<?php endif ?>

			<?php if ($city != ""): ?>
				<tr>
					<td>City</td>
					<td><?= $city; ?></td>
				</tr>
			<?php endif ?>

			<?php if ($countryName != ""): ?>
				<tr>
					<td>Country</td>
					<td><?= $countryName; ?></td>
				</tr>
			<?php endif ?>

			<?php if ($region != ""): ?>
				<tr>
					<td>Region</td>
					<td><?= $region; ?></td>
				</tr>
			<?php endif ?>

			<?php if ($timeZoneRegionName != ""): ?>
				<tr>
					<td>Time Zone Region Name</td>
					<td><?= $timeZoneRegionName; ?></td>
				</tr>
			<?php endif ?>

		</table>

		<br>

		<div class="map-container">
			<div id="map2"></div>
		</div>

		<br>


      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <?php if( have_rows('slider_images') ): ?>
      <div id="airlineslider" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <?php $count = 0; ?>
          <?php while( have_rows('slider_images') ): the_row(); 
            $image = get_sub_field('slider_img');  
            $count++;
            ?>
          <div class="carousel-item<?php if($count == 1){echo ' active';}?> ">
            <img src="<?php echo $image; ?>" alt="#" >
          </div>
          <?php endwhile; ?>
        </div>
        <a class="carousel-control-prev" href="#airlineslider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#airlineslider" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
        </a>
      </div>
      <?php endif; ?>

		<?php 

			$appId = '856acead';
			$appKey = '42227f258e3e30fa2bdbb1e572599d25';

			// $Airport_flights = file_get_contents('https://api.flightstats.com/flex/airports/rest/v1/json/all?appId='.$appId.'&appKey='.$appKey);
			$Airport_flights = file_get_contents('https://api.flightstats.com/flex/fids/rest/v1/json/'.$fs.'/departures?appId='.$appId.'&appKey='.$appKey.'&requestedFields=flightid%20originCity%2CdestinationCity%2CairlineName%2CairlineLogoUrlPng%2CairlineCode%2CflightNumber%2Ccity%2CcurrentTime%2Cgate%2Cremarks&lateMinutes=15&useRunwayTimes=false&excludeCargoOnlyFlights=false');

			$Airport_flights_array = json_decode($Airport_flights, true)['fidsData'];

			// var_dump($Airport_flights_array);

			// foreach($airport_array as $airport) {


		?>

		<?php if (count($Airport_flights_array) > 0): ?>
		
		<table id="flights_table">
			<thead>
			<tr>
				<th>Flight Number</th>
				<th>Airline</th>
				<th>Name (Code)</th>
				<th>Departure</th>
				<th>Arrival</th>
				<th>Time</th>
				<th>Details</th>
			</tr>
			</thead>

			
			<tbody>
			<?php foreach ($Airport_flights_array as $key => $airports_flight_data): ?>

			<tr>
				<td><?= $airports_flight_data['flightNumber']; ?></td>
				<td> <img src="<?= $airports_flight_data['airlineLogoUrlPng']; ?>" width="100" alt="<?= $airports_flight_data['airlineName']; ?>"></td>
				<td><?= $airports_flight_data['airlineName']; ?>  (<?= $airports_flight_data['airlineCode']; ?>)</td>
				<td><?= $airports_flight_data['originCity']; ?> </td>
				<td><?= $airports_flight_data['destinationCity']; ?> </td>
				<td><?= $airports_flight_data['currentTime']; ?> </td>
				<td> <a  href="/flight-detail/?flightId=<?= $airports_flight_data['flightId']; ?>" class="button" >View</button> </td>
			</tr>
			<?php endforeach; ?>
			</tbody>
		</table>

		<?php endif ?>





      <?php get_template_part( 'entry' ); ?>
      <?php if ( comments_open() && ! post_password_required() ) { comments_template( '', true ); } ?>
      <?php endwhile; endif; ?>
      <footer class="footer">
        <?php get_template_part( 'nav', 'below-single' ); ?>
      </footer>
      <?php echo do_shortcode(' '); ?>
    </main>
  </div>
  <div class="col-md-4">
    <?php get_sidebar(); ?>		
  </div>
</div>

<script>
	function initMap() {
		var myLatLng = { lat: <?= $latitude; ?>, lng: <?= $longitude ?> };

		var map = new google.maps.Map(document.getElementById('map2'), {
			zoom: 18,
			center: myLatLng,
			mapTypeId: 'satellite'
		});

		var marker = new google.maps.Marker({
			position: myLatLng,
			map: map,
			title: "<?= get_the_title(); ?>"
		});
	}
</script>

<script>
	$(document).ready( function () {
		$('#flights_table').DataTable();
	} );
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCeD3LSJjBsUHiKv7IHUomkYIdbzF1b1pk&callback=initMap"></script>
<?php get_footer(); ?>