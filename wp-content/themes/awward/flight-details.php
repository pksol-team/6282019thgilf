<?php 

/* Template Name: Flight Details */ 

get_header(); ?>
<div class="row">
  <div class="col-md-12">
	<br>
	<br>

	<?php 
	
		$appId = '856acead';
		$appKey = '42227f258e3e30fa2bdbb1e572599d25';

		$flightId = $_GET['flightId'];

		$flight_json = file_get_contents('https://api.flightstats.com/flex/flightstatus/rest/v2/json/flight/status/'.$flightId.'?appId='.$appId.'&appKey='.$appKey);

		$flight_data = json_decode($flight_json, true);

		function convert_seconds($seconds, $type) 
		{
			$dt1 = new DateTime("@0");
			$dt2 = new DateTime("@$seconds");

			if($type == 'mins') {
				return $dt1->diff($dt2)->format('%i mins');
			} elseif($type == 'hours')  {
				return $dt1->diff($dt2)->format('%h hours');
			} else {
				return $dt1->diff($dt2)->format('%hh %imins');
			}

		}
	
	?>

	<section class="flight-details">
		<div class="historical-flight-header">
			<div class="status-header flight-status-box">
				<div class="content-wrapper">
					<h1 class="carrier-text-style">(<?= $flight_data['appendix']['airlines'][0]['fs']; ?>) <?= $flight_data['appendix']['airlines'][0]['name']; ?> <?= $flight_data['flightStatus']['flightNumber']; ?> Flight Details</h1>
					<!-- <p class="status-text-style ">On time | Departed</p> -->
				</div>
			</div>
		</div>
		<div class="historicalFlightInformation">
			<div class="row main_box_row">
				<div class="col-xs-12 col-sm-6 flightCell flight-ticket " style="text-align:center;margin-bottom:10px">
					<h2 class="flight-ticket-header  departureArrivalTitle">Departure</h2>
					<div>
						<div class="airportDiv">
							<h2 class="airportCodeTitle"><?= $flight_data['flightStatus']['departureAirportFsCode']; ?></h2>
							<p class="airportNameSubtitle">
							
							<?php 
							 
								foreach($flight_data['appendix']['airports'] as $key => $airport_data)  {

									if( $flight_data['flightStatus']['departureAirportFsCode'] == $airport_data['fs']) {
										$departure_airport_key = $key;
									}

								}

								if($departure_airport_key == 1) {
									$arrival_airport_key = 0;
								} else {
									$arrival_airport_key = 1;
								}
							 
								echo $flight_data['appendix']['airports'][$departure_airport_key]['name']; ?>, <?php if($flight_data['appendix']['airports'][$departure_airport_key]['stateCode']) echo $flight_data['appendix']['airports'][$departure_airport_key]['stateCode'].','; ?> <?= $flight_data['appendix']['airports'][$departure_airport_key]['countryCode'];

								$depart_latitude = $flight_data['appendix']['airports'][$departure_airport_key]['latitude'];
								$depart_longitude = $flight_data['appendix']['airports'][$departure_airport_key]['longitude'];
								
								$time_zone_depart = json_decode(json_encode(simplexml_load_string(file_get_contents('http://api.timezonedb.com/v2.1/get-time-zone?key=SGGF9TL1616V&by=position&lat='.$depart_latitude.'&lng='.$depart_longitude))));
							 
							?>

							

							</p>


						</div>
						<div class="innerStyle departure">
							<div class="times" style="border-bottom:1px solid white">
								<p class="title">Flight Gate Times</p>

								<?php
									$departure_gate_date_time_schedule = new DateTime($flight_data['flightStatus']['operationalTimes']['scheduledGateDeparture']['dateLocal']);
								?>

								<p class="date"> <?= $departure_gate_date_time_schedule->format('d-M-Y'); ?></p>
								<div class="timeBlock" style="width:50%;display:inline-block">
									<p class="title">Scheduled</p>
									<div>
										<h4 style="display:inline-block;margin:0;font-weight:bold"><?= $departure_gate_date_time_schedule->format('H:i'); ?></h4>
										<p class="timeDetails" style="padding-left:1px;text-transform:uppercase"> </p>
										<p class="timeDetails" style="padding-left:2px;text-transform:uppercase"><span>&nbsp;</span><?= $time_zone_depart->abbreviation; ?></p>
									</div>
								</div>
								<div class="timeBlock" style="width:50%;display:inline-block">

									<?php

										$departure_gate_date_time_actual_or_estimated_value = '--';

										$actual_or_estimated = '';

										$actual_or_estimated_date = '';

										if($flight_data['flightStatus']['operationalTimes']['actualGateDeparture']['dateLocal'] == NULL) {
											
											$actual_or_estimated = 'estimated';
											$actual_or_estimated_date = $flight_data['flightStatus']['operationalTimes']['estimatedGateDeparture']['dateLocal'];
											$departure_gate_date_time_actual_or_estimated_value = (new DateTime($actual_or_estimated_date))->format('H:i');
											
										} else {

											$actual_or_estimated = 'actual';
											$actual_or_estimated_date = $flight_data['flightStatus']['operationalTimes']['actualGateDeparture']['dateLocal'];
											$departure_gate_date_time_actual_or_estimated_value = (new DateTime($actual_or_estimated_date))->format('H:i');

										}

									?>

									<p class="title"><?= ucfirst($actual_or_estimated); ?></p>
									<div>
										<h4 style="display:inline-block;margin:0;font-weight:bold"><?= $departure_gate_date_time_actual_or_estimated_value; ?></h4>
										
										<?php if ($departure_gate_date_time_actual_or_estimated_value != '--'): ?>
											<p class="timeDetails" style="padding-left:1px;text-transform:uppercase"> </p>
											<p class="timeDetails" style="padding-left:2px;text-transform:uppercase"><span>&nbsp;</span><?= $time_zone_depart->abbreviation; ?></p>
										<?php endif ?>

									</div>


								</div>

								<?php 

									$total_departure_delay = $flight_data['flightStatus']['delays']['departureGateDelayMinutes'];

									if($flight_data['flightStatus']['delays']['departureGateDelayMinutes'] == NULL) {

										$total_departed_converted_time = '-';

									} else {

										if($total_departure_delay > 60) {
	
											$total_departed_converted_time = convert_seconds($total_departure_delay*60, 'all')."\n";
	
										} elseif($total_departure_delay == 60) {
	
											$total_departed_converted_time = convert_seconds($total_departure_delay*60, 'hours')."\n";
	
										} else {
	
											$total_departed_converted_time = convert_seconds($total_departure_delay*60, 'mins')."\n";
	
										}

									}

								?>
								
								<p class="delayText">Total Departure Delay: <?= $total_departed_converted_time; ?></p>
							</div>
							<div class="times" style="border-bottom:1px solid white">
								<p class="title">Flight Runway Times</p>

								<?php

									$runway_scheduled_date_time = new DateTime($flight_data['flightStatus']['operationalTimes']['flightPlanPlannedDeparture']['dateLocal']);

								?>

								<p class="date"><?= $runway_scheduled_date_time->format('d-M-Y'); ?></p>
								<div class="timeBlock" style="width:50%;display:inline-block">
									<p class="title">Scheduled</p>
									<div>
										<h4 style="display:inline-block;margin:0;font-weight:bold"><?= $runway_scheduled_date_time->format('H:i'); ?></h4>
										<p class="timeDetails" style="padding-left:1px;text-transform:uppercase"> </p>
										<p class="timeDetails" style="padding-left:2px;text-transform:uppercase"><span>&nbsp;</span><?= $time_zone_depart->abbreviation; ?></p>
									</div>
								</div>

								<div class="timeBlock" style="width:50%;display:inline-block">

									<?php

										$departure_runway_date_time_actual_or_estimated_value = '--';

										$actual_or_estimated = '';

										$actual_or_estimated_date = '';

										if($flight_data['flightStatus']['operationalTimes']['actualRunwayDeparture']['dateLocal'] == NULL) {

											$actual_or_estimated = 'estimated';
											$actual_or_estimated_date = $flight_data['flightStatus']['operationalTimes']['estimatedRunwayDeparture']['dateLocal'];
											$departure_runway_date_time_actual_or_estimated_value = (new DateTime($actual_or_estimated_date))->format('H:i');

										} else {

											$actual_or_estimated = 'actual';
											$actual_or_estimated_date = $flight_data['flightStatus']['operationalTimes']['actualRunwayDeparture']['dateLocal'];
											$departure_runway_date_time_actual_or_estimated_value = (new DateTime($actual_or_estimated_date))->format('H:i');

										}

									?>

									
									<p class="title"><?= ucfirst($actual_or_estimated); ?></p>
									<div>
										<h4 style="display:inline-block;margin:0;font-weight:bold"><?= $departure_runway_date_time_actual_or_estimated_value; ?></h4>

										<?php if ($departure_runway_date_time_actual_or_estimated_value != '--'): ?>
											<p class="timeDetails" style="padding-left:1px;text-transform:uppercase"> </p>
											<p class="timeDetails" style="padding-left:2px;text-transform:uppercase"><span>&nbsp;</span><?= $time_zone_depart->abbreviation; ?></p>
										<?php endif ?>

									</div>

								</div>
								
								
								<?php 

									$total_departure_runway_delay = $flight_data['flightStatus']['delays']['departureRunwayDelayMinutes'];

									if($flight_data['flightStatus']['delays']['departureRunwayDelayMinutes'] == NULL) {

										$total_departed_converted_time = '-';

									} else {

										if($total_departure_runway_delay > 60) {

											$total_departed_runway_converted_time = convert_seconds($total_departure_runway_delay*60, 'all')."\n";

										} elseif($total_departure_runway_delay == 60) {

											$total_departed_runway_converted_time = convert_seconds($total_departure_runway_delay*60, 'hours')."\n";

										} else {

											$total_departed_runway_converted_time = convert_seconds($total_departure_runway_delay*60, 'mins')."\n";

										}

									}

								?>

								<p class="delayText">Runway Delay: <?= $total_departed_runway_converted_time; ?></p>


							</div>
							<div class="row additionalInfo">
								<div class="col-xs-3 col-md-4 col-sm-4 terminalBlock">
									<p class="title">Terminal</p>
									
									<?php 
										$depart_terminal = $flight_data['flightStatus']['airportResources']['departureTerminal'];
									?>
									<h4 class="detail"> <?= ($depart_terminal != NULL) ? $depart_terminal : '-' ;  ?> </h4>

								</div>
								<div class="col-xs-3 col-md-4 col-sm-4 gateBlock">
									<p class="title">Gate</p>
									<?php 
										$depart_gate = $flight_data['flightStatus']['airportResources']['departureGate'];
									?>
									<h4 class="detail"> <?= ($depart_gate != NULL) ? $depart_gate : '-' ;  ?> </h4>
								</div>
							</div>
							<div class="row moreDetails">
								<div class="col-xs-12 col-sm-6 col-md-6 craftTypeBlock">
									<p class="title">Craft Type</p>
									<p class="subtitle"><?= $flight_data['appendix']['equipments'][0]['name']; ?></p>
									<h4 class="detail"><?= $flight_data['appendix']['equipments'][0]['iata']; ?></h4>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-6 flightTimeBlock">
									<p class="title">Flight Time</p>
									<p class="subtitle">Scheduled</p>

									<?php 
										$schedule_minute = $flight_data['flightStatus']['flightDurations']['scheduledBlockMinutes'];
									?>
									<h4 class="detail"> <?= ($schedule_minute != NULL) ? substr(convert_seconds($schedule_minute*60, 'all'), 0, -3) : '-' ;  ?> </h4>

								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 flightCell flight-ticket " style="text-align:center;margin-bottom:10px">
					<h2 class="flight-ticket-header  departureArrivalTitle">Arrival</h2>
					<div>
						<div class="airportDiv">
							<h2 class="airportCodeTitle"><?= $flight_data['flightStatus']['arrivalAirportFsCode']; ?></h2>
							
							<p class="airportNameSubtitle">

							<?php 

								echo $flight_data['appendix']['airports'][$arrival_airport_key]['name']; ?>, <?php if($flight_data['appendix']['airports'][$arrival_airport_key]['stateCode']) echo $flight_data['appendix']['airports'][$arrival_airport_key]['stateCode'].','; ?> <?= $flight_data['appendix']['airports'][$arrival_airport_key]['countryCode'];

								$arrival_latitude = $flight_data['appendix']['airports'][$arrival_airport_key]['latitude'];
								$arrival_longitude = $flight_data['appendix']['airports'][$arrival_airport_key]['longitude'];

								$time_zone_arrival = json_decode(json_encode(simplexml_load_string(file_get_contents('http://api.timezonedb.com/v2.1/get-time-zone?key=SGGF9TL1616V&by=position&lat='.$arrival_latitude.'&lng='.$arrival_longitude))));

							?>

							</p>



						</div>
						<div class="innerStyle ">
							<div class="times" style="border-bottom:1px solid white">
								<p class="title">Flight Gate Times</p>

								<?php
									$arrival_gate_date_time_schedule = new DateTime($flight_data['flightStatus']['operationalTimes']['scheduledGateArrival']['dateLocal']);
								?>

								<p class="date"> <?= $arrival_gate_date_time_schedule->format('d-M-Y'); ?></p>


								<div class="timeBlock" style="width:50%;display:inline-block">
									<p class="title">Scheduled</p>
									<div>
										<h4 style="display:inline-block;margin:0;font-weight:bold"><?= $arrival_gate_date_time_schedule->format('H:i'); ?></h4>
										<p class="timeDetails" style="padding-left:1px;text-transform:uppercase"> </p>
										<p class="timeDetails" style="padding-left:2px;text-transform:uppercase"><span>&nbsp;</span><?= $time_zone_arrival->abbreviation; ?></p>
									</div>
								</div>
								<div class="timeBlock" style="width:50%;display:inline-block">

									<?php

										$arrival_gate_date_time_actual_or_estimated_value = '--';

										$actual_or_estimated = '';

										$actual_or_estimated_date = '';

										if($flight_data['flightStatus']['operationalTimes']['actualGateArrival']['dateLocal'] == NULL) {

											$actual_or_estimated = 'estimated';
											$actual_or_estimated_date = $flight_data['flightStatus']['operationalTimes']['estimatedGateArrival']['dateLocal'];
											$arrival_gate_date_time_actual_or_estimated_value = (new DateTime($actual_or_estimated_date))->format('H:i');

										} else {

											$actual_or_estimated = 'actual';
											$actual_or_estimated_date = $flight_data['flightStatus']['operationalTimes']['actualGateArrival']['dateLocal'];
											$arrival_gate_date_time_actual_or_estimated_value = (new DateTime($actual_or_estimated_date))->format('H:i');

										}

									?>

									<p class="title"><?= ucfirst($actual_or_estimated); ?></p>
									<div>
										<h4 style="display:inline-block;margin:0;font-weight:bold"><?= $arrival_gate_date_time_actual_or_estimated_value; ?></h4>

										<?php if ($arrival_gate_date_time_actual_or_estimated_value != '--'): ?>
											<p class="timeDetails" style="padding-left:1px;text-transform:uppercase"> </p>
											<p class="timeDetails" style="padding-left:2px;text-transform:uppercase"><span>&nbsp;</span><?= $time_zone_arrival->abbreviation; ?></p>
										<?php endif ?>

									</div>


								</div>

								<?php 

									$total_departure_delay = $flight_data['flightStatus']['delays']['arrivalGateDelayMinutes'];

									if($flight_data['flightStatus']['delays']['arrivalGateDelayMinutes'] == NULL) {

										$total_arrival_converted_time = '-';

									} else {

										if($total_departure_delay > 60) {

											$total_arrival_converted_time = convert_seconds($total_departure_delay*60, 'all')."\n";

										} elseif($total_departure_delay == 60) {

											$total_arrival_converted_time = convert_seconds($total_departure_delay*60, 'hours')."\n";

										} else {

											$total_arrival_converted_time = convert_seconds($total_departure_delay*60, 'mins')."\n";

										}

									}

								?>

								<p class="delayText">Total Arrival Delay: <?= $total_arrival_converted_time; ?></p>		

							</div>
							
							<div class="times" style="border-bottom:1px solid white">
								<p class="title">Flight Runway Times</p>

								<?php

									$runway_scheduled_arrival_date_time = new DateTime($flight_data['flightStatus']['operationalTimes']['flightPlanPlannedArrival']['dateLocal']);

								?>

								<p class="date"><?= $runway_scheduled_arrival_date_time->format('d-M-Y'); ?></p>
								<div class="timeBlock" style="width:50%;display:inline-block">
									<p class="title">Scheduled</p>
									<div>
										<h4 style="display:inline-block;margin:0;font-weight:bold"><?= $runway_scheduled_arrival_date_time->format('H:i'); ?></h4>
										<p class="timeDetails" style="padding-left:1px;text-transform:uppercase"> </p>
										<p class="timeDetails" style="padding-left:2px;text-transform:uppercase"><span>&nbsp;</span><?= $time_zone_arrival->abbreviation; ?></p>
									</div>
								</div>

								<div class="timeBlock" style="width:50%;display:inline-block">

									<?php

										$arrival_runway_date_time_actual_or_estimated_value = '-';

										$actual_or_estimated = '';

										$actual_or_estimated_date = '';

										if($flight_data['flightStatus']['operationalTimes']['actualRunwayArrival']['dateLocal'] == NULL) {

											$actual_or_estimated = 'estimated';
											$actual_or_estimated_date = $flight_data['flightStatus']['operationalTimes']['estimatedRunwayArrival']['dateLocal'];
											$arrival_runway_date_time_actual_or_estimated_value = (new DateTime($actual_or_estimated_date))->format('H:i');

										} else {

											$actual_or_estimated = 'actual';
											$actual_or_estimated_date = $flight_data['flightStatus']['operationalTimes']['actualRunwayArrival']['dateLocal'];
											$arrival_runway_date_time_actual_or_estimated_value = (new DateTime($actual_or_estimated_date))->format('H:i');

										}

									?>


									<p class="title"><?= ucfirst($actual_or_estimated); ?></p>
									<div>
										<h4 style="display:inline-block;margin:0;font-weight:bold"><?= $arrival_runway_date_time_actual_or_estimated_value; ?></h4>

										<?php if ($arrival_runway_date_time_actual_or_estimated_value != '--'): ?>
											<p class="timeDetails" style="padding-left:1px;text-transform:uppercase"> </p>
											<p class="timeDetails" style="padding-left:2px;text-transform:uppercase"><span>&nbsp;</span><?= $time_zone_arrival->abbreviation; ?></p>
										<?php endif ?>

									</div>

								</div>


								<?php 

									$total_arrival_runway_delay = $flight_data['flightStatus']['delays']['arrivalRunwayDelayMinutes'];

									if($flight_data['flightStatus']['delays']['arrivalRunwayDelayMinutes'] == NULL) {

										$total_departed_converted_time = '-';

									} else {

										if($total_arrival_runway_delay > 60) {

											$total_arrival_runway_converted_time = convert_seconds($total_arrival_runway_delay*60, 'all')."\n";

										} elseif($total_arrival_runway_delay == 60) {

											$total_arrival_runway_converted_time = convert_seconds($total_arrival_runway_delay*60, 'hours')."\n";

										} else {

											$total_arrival_runway_converted_time = convert_seconds($total_arrival_runway_delay*60, 'mins')."\n";

										}

									}

								?>

								<p class="delayText">Runway Delay: <?= $total_arrival_runway_converted_time; ?></p>


							</div>


							<div class="row additionalInfo">
								<div class="col-xs-3 col-md-4 col-sm-4 terminalBlock">
									<p class="title">Terminal</p>
									
									<?php 
										$arrival_terminal = $flight_data['flightStatus']['airportResources']['arrivalTerminal'];
									?>
									<h4 class="detail"> <?= ($arrival_terminal != NULL) ? $arrival_terminal : '-' ;  ?> </h4>
									

								</div>
								<div class="col-xs-3 col-md-4 col-sm-4 gateBlock">
									<p class="title">Gate</p>
									<?php
										$arrival_gate = $flight_data['flightStatus']['airportResources']['arrivalGate'];
									?>
									<h4 class="detail"> <?= ($arrival_gate != NULL) ? $arrival_gate : '-' ;  ?> </h4>
								</div>
								<div class="col-xs-6 col-sm-4 col-md-4 baggageBlock">
									<p class="title">Baggage Claim</p>

									<?php
										$baggage = $flight_data['flightStatus']['airportResources']['baggage'];
									?>
									<h4 class="detail"> <?= ($baggage != NULL) ? $baggage : '-' ;  ?> </h4>

								</div>
							</div>
							<div class="row moreDetails">
								<div class="col-xs-12 col-sm-6 col-md-6 tailNumberBlock">
									<p class="title">Tail Number</p>
									<p class="subtitle"></p>								
									<h4 class="detail"><?= $flight_data['flightStatus']['flightEquipment']['tailNumber']; ?></h4>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-6 flightTimeBlock">
									<p class="title">Flight Time</p>
									<p class="subtitle">Actual</p>

									<?php 
										$schedule_actual_minute = $flight_data['flightStatus']['flightDurations']['blockMinutes'];
									?>
									<h4 class="detail"> <?= ($schedule_actual_minute != NULL) ? substr(convert_seconds($schedule_actual_minute*60, 'all'), 0, -3) : '-' ;  ?> </h4>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>






  </div>
  <div class="col-md-4">
    <?php get_sidebar(); ?>		
  </div>
</div>
<?php get_footer(); ?>