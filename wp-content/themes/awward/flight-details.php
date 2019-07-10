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
		
	
	?>

	<?php /* 

		<section class="flight-details">
			<div class="historical-flight-header">
				<div class="status-header flight-status-box">
					<div class="content-wrapper">
						<h1 class="carrier-text-style">(<?= $flight_data['appendix']['airlines'][0]['fs']; ?>) <?= $flight_data['appendix']['airlines'][0]['name']; ?> <?= $flight_data['flightStatus']['flightNumber']; ?> Flight Details</h1>
						<p class="status-text-style green">On time | Departed</p>
					</div>
				</div>
			</div>
			<div class="historicalFlightInformation">
				<div class="row">
					<div class="col-xs-12 col-sm-6 flightCell flight-ticket green" style="text-align:center;margin-bottom:10px">
						<h2 class="flight-ticket-header green departureArrivalTitle">Departure</h2>
						<div>
							<div class="airportDiv">
								<h2 class="airportCodeTitle"><?= $flight_data['flightStatus']['departureAirportFsCode']; ?></h2>
								<p class="airportNameSubtitle"> <?= $flight_data['appendix']['airports'][1]['name']; ?>, <?= $flight_data['appendix']['airports'][1]['stateCode']; ?>, <?= $flight_data['appendix']['airports'][1]['countryCode']; ?></p>
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
											<p class="timeDetails" style="padding-left:2px;text-transform:uppercase"><span>&nbsp;</span>CDT</p>
										</div>
									</div>
									<div class="timeBlock" style="width:50%;display:inline-block">

										<?php
											$departure_gate_date_time_actual = new DateTime($flight_data['flightStatus']['operationalTimes']['actualGateDeparture']['dateLocal']);
										?>

										<p class="title">Actual</p>
										<div>
											<h4 style="display:inline-block;margin:0;font-weight:bold"><?= $departure_gate_date_time_actual->format('H:i'); ?></h4>
											<p class="timeDetails" style="padding-left:1px;text-transform:uppercase"> </p>
											<p class="timeDetails" style="padding-left:2px;text-transform:uppercase"><span>&nbsp;</span>CDT</p>
										</div>
									</div>

									<?php 
										
										$total_departure_delay = $flight_data['flightStatus']['delays']['departureGateDelayMinutes'];

									?>
									<p class="delayText">Total Departure Delay: <?= gmdate("i \h s \m\i\\n\s", $total_departure_delay); ?></p>
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
											<p class="timeDetails" style="padding-left:2px;text-transform:uppercase"><span>&nbsp;</span>CDT</p>
										</div>
									</div>

									<?php
										$runway_estimated_date_time = new DateTime($flight_data['flightStatus']['operationalTimes']['estimatedRunwayDeparture']['dateLocal']);
									?>
									<div class="timeBlock" style="width:50%;display:inline-block">
										<p class="title">Estimated</p>
										<div>
											<h4 style="display:inline-block;margin:0;font-weight:bold"><?= $runway_estimated_date_time->format('H:i'); ?></h4>
											<p class="timeDetails" style="padding-left:1px;text-transform:uppercase"> </p>
											<p class="timeDetails" style="padding-left:2px;text-transform:uppercase"><span>&nbsp;</span>CDT</p>
										</div>
									</div>
									<?php 
										
										$runway_delay = $flight_data['flightStatus']['delays']['departureRunwayDelayMinutes'];

									?>
									<p class="delayText">Runway Delay: <?= gmdate("i \h s \m\i\\n\s", $runway_delay); ?></p>
								</div>
								<div class="row additionalInfo">
									<div class="col-xs-3 terminalBlock">
										<p class="title">Terminal</p>
										<h4 class="detail">-</h4>
									</div>
									<div class="col-xs-3 gateBlock">
										<p class="title">Gate</p>
										<h4 class="detail">-</h4>
									</div>
								</div>
								<div class="row moreDetails">
									<div class="col-xs-12 col-sm-6 craftTypeBlock">
										<p class="title">Craft Type</p>
										<p class="subtitle"><?= $flight_data['appendix']['equipments'][0]['name']; ?></p>
										<h4 class="detail"><?= $flight_data['appendix']['equipments'][0]['iata']; ?></h4>
									</div>
									<div class="col-xs-12 col-sm-6 flightTimeBlock">
										<p class="title">Flight Time</p>
										<p class="subtitle">Scheduled</p>
										<h4 class="detail">-</h4>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 flightCell flight-ticket green" style="text-align:center;margin-bottom:10px">
						<h2 class="flight-ticket-header green departureArrivalTitle">Arrival</h2>
						<div>
							<div class="airportDiv">
								<h2 class="airportCodeTitle"><?= $flight_data['flightStatus']['arrivalAirportFsCode']; ?></h2>
								<!-- <p class="airportNameSubtitle">Peoria International Airport, IL, US</p> -->
								<p class="airportNameSubtitle"> <?= $flight_data['appendix']['airports'][0]['name']; ?>, <?= $flight_data['appendix']['airports'][0]['stateCode']; ?>, <?= $flight_data['appendix']['airports'][0]['countryCode']; ?></p>
							</div>
							<div class="innerStyle ">
								<div class="times" style="border-bottom:1px solid white">
									<p class="title">Flight Gate Times</p>

									<p class="date">03-Jul-2019</p>
									<div class="timeBlock" style="width:50%;display:inline-block">
										<p class="title">Scheduled</p>
										<div>
											<h4 style="display:inline-block;margin:0;font-weight:bold">--</h4>
										</div>
									</div>
									<div class="timeBlock" style="width:50%;display:inline-block">
										<p class="title">Actual</p>
										<div>
											<h4 style="display:inline-block;margin:0;font-weight:bold">--</h4>
										</div>
									</div>
									<p class="delayText">Total Arrival Delay: -</p>
								</div>
								<div class="times" style="border-bottom:1px solid white">
									<p class="title">Flight Runway Times</p>


										<?php
											$flight_Plan_Planned_Arrival = new DateTime($flight_data['flightStatus']['operationalTimes']['flightPlanPlannedArrival']['dateLocal']);
										?>

										<p class="date"><?= $flight_Plan_Planned_Arrival->format('d-M-Y'); ?></p>
										<div class="timeBlock" style="width:50%;display:inline-block">
											<p class="title">Scheduled</p>
											<div>
												<h4 style="display:inline-block;margin:0;font-weight:bold"><?= $flight_Plan_Planned_Arrival->format('H:i'); ?></h4>
												<p class="timeDetails" style="padding-left:1px;text-transform:uppercase"> </p>
												<p class="timeDetails" style="padding-left:2px;text-transform:uppercase"><span>&nbsp;</span>CDT</p>
											</div>
										</div>


									<div class="timeBlock" style="width:50%;display:inline-block">
										<p class="title">Actual</p>
										<div>
											<h4 style="display:inline-block;margin:0;font-weight:bold">--</h4>
										</div>
									</div>
									<p class="delayText">Runway Delay: -</p>
								</div>
								<div class="row additionalInfo">
									<div class="col-xs-3 terminalBlock">
										<p class="title">Terminal</p>
										<h4 class="detail">-</h4>
									</div>
									<div class="col-xs-3 gateBlock">
										<p class="title">Gate</p>
										<h4 class="detail">-</h4>
									</div>
									<div class="col-xs-6 baggageBlock">
										<p class="title">Baggage Claim</p>
										<h4 class="detail">-</h4>
									</div>
								</div>
								<div class="row moreDetails">
									<div class="col-xs-12 col-sm-6 tailNumberBlock">
										<p class="title">Tail Number</p>
										<p class="subtitle"></p>								
										<h4 class="detail"><?= $flight_data['flightStatus']['flightEquipment']['tailNumber']; ?></h4>
									</div>
									<div class="col-xs-12 col-sm-6 flightTimeBlock">
										<p class="title">Flight Time</p>
										<p class="subtitle"></p>
										<h4 class="detail">-</h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

	*/ ?>


	<section class="flight-details">
		<div class="historical-flight-header">
			<div class="status-header flight-status-box">
				<div class="content-wrapper">
					<h1 class="carrier-text-style">(<?= $flight_data['appendix']['airlines'][0]['fs']; ?>) <?= $flight_data['appendix']['airlines'][0]['name']; ?> <?= $flight_data['flightStatus']['flightNumber']; ?> Flight Details</h1>
					<p class="status-text-style green">On time | Departed</p>
				</div>
			</div>
		</div>
		<div class="historicalFlightInformation">
			<div class="row">
				<div class="col-xs-12 col-sm-6 flightCell flight-ticket green" style="text-align:center;margin-bottom:10px">
					<h2 class="flight-ticket-header green departureArrivalTitle">Departure</h2>
					<div>
						<div class="airportDiv">
							<h2 class="airportCodeTitle"><?= $flight_data['flightStatus']['departureAirportFsCode']; ?></h2>
							<p class="airportNameSubtitle"> <?= $flight_data['appendix']['airports'][1]['name']; ?>, <?php if($flight_data['appendix']['airports'][1]['stateCode']) echo $flight_data['appendix']['airports'][1]['stateCode'].','; ?> <?= $flight_data['appendix']['airports'][1]['countryCode']; ?></p>
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
										<p class="timeDetails" style="padding-left:2px;text-transform:uppercase"><span>&nbsp;</span>CDT</p>
									</div>
								</div>
								<div class="timeBlock" style="width:50%;display:inline-block">

									<?php
										$departure_gate_date_time_actual = new DateTime($flight_data['flightStatus']['operationalTimes']['actualGateDeparture']['dateLocal']);
									?>

									<p class="title">Actual</p>
									<div>
										<h4 style="display:inline-block;margin:0;font-weight:bold"><?= $departure_gate_date_time_actual->format('H:i'); ?></h4>
										<p class="timeDetails" style="padding-left:1px;text-transform:uppercase"> </p>
										<p class="timeDetails" style="padding-left:2px;text-transform:uppercase"><span>&nbsp;</span>CDT</p>
									</div>
								</div>

								<?php 

									$total_departure_delay = $flight_data['flightStatus']['delays']['departureGateDelayMinutes'];

								?>
								<p class="delayText">Total Departure Delay: <?= gmdate("i \h s \m\i\\n\s", $total_departure_delay); ?></p>
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
										<p class="timeDetails" style="padding-left:2px;text-transform:uppercase"><span>&nbsp;</span>CDT</p>
									</div>
								</div>

								<?php
									$runway_estimated_date_time = new DateTime($flight_data['flightStatus']['operationalTimes']['estimatedRunwayDeparture']['dateLocal']);
								?>
								<div class="timeBlock" style="width:50%;display:inline-block">
									<p class="title">Estimated</p>
									<div>
										<h4 style="display:inline-block;margin:0;font-weight:bold"><?= $runway_estimated_date_time->format('H:i'); ?></h4>
										<p class="timeDetails" style="padding-left:1px;text-transform:uppercase"> </p>
										<p class="timeDetails" style="padding-left:2px;text-transform:uppercase"><span>&nbsp;</span>CDT</p>
									</div>
								</div>
								<?php 

									$runway_delay = $flight_data['flightStatus']['delays']['departureRunwayDelayMinutes'];

								?>
								<p class="delayText">Runway Delay: <?= gmdate("i \h s \m\i\\n\s", $runway_delay); ?></p>
							</div>
							<div class="row additionalInfo">
								<div class="col-xs-3 col-md-4 col-sm-4 terminalBlock">
									<p class="title">Terminal</p>
									<h4 class="detail">-</h4>
								</div>
								<div class="col-xs-3 col-md-4 col-sm-4 gateBlock">
									<p class="title">Gate</p>
									<h4 class="detail">-</h4>
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
									<h4 class="detail">-</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 flightCell flight-ticket green" style="text-align:center;margin-bottom:10px">
					<h2 class="flight-ticket-header green departureArrivalTitle">Arrival</h2>
					<div>
						<div class="airportDiv">
							<h2 class="airportCodeTitle"><?= $flight_data['flightStatus']['arrivalAirportFsCode']; ?></h2>
							<!-- <p class="airportNameSubtitle">Peoria International Airport, IL, US</p> -->
							<p class="airportNameSubtitle"> <?= $flight_data['appendix']['airports'][0]['name']; ?>, <?php if($flight_data['appendix']['airports'][0]['stateCode']) echo $flight_data['appendix']['airports'][0]['stateCode'] .','; ?> <?= $flight_data['appendix']['airports'][0]['countryCode']; ?></p>
						</div>
						<div class="innerStyle ">
							<div class="times" style="border-bottom:1px solid white">
								<p class="title">Flight Gate Times</p>

								<p class="date">03-Jul-2019 sdfdaf</p>
								<div class="timeBlock" style="width:50%;display:inline-block">
									<p class="title">Scheduled</p>
									<div>
										<h4 style="display:inline-block;margin:0;font-weight:bold">--</h4>
									</div>
								</div>
								<div class="timeBlock" style="width:50%;display:inline-block">
									<p class="title">Actual</p>
									<div>
										<h4 style="display:inline-block;margin:0;font-weight:bold">--</h4>
									</div>
								</div>
								<p class="delayText">Total Arrival Delay: -</p>
							</div>
							<div class="times" style="border-bottom:1px solid white">
								<p class="title">Flight Runway Times</p>


									<?php
										$flight_Plan_Planned_Arrival = new DateTime($flight_data['flightStatus']['operationalTimes']['flightPlanPlannedArrival']['dateLocal']);
									?>

									<p class="date"><?= $flight_Plan_Planned_Arrival->format('d-M-Y'); ?></p>
									<div class="timeBlock" style="width:50%;display:inline-block">
										<p class="title">Scheduled</p>
										<div>
											<h4 style="display:inline-block;margin:0;font-weight:bold"><?= $flight_Plan_Planned_Arrival->format('H:i'); ?></h4>
											<p class="timeDetails" style="padding-left:1px;text-transform:uppercase"> </p>
											<p class="timeDetails" style="padding-left:2px;text-transform:uppercase"><span>&nbsp;</span>CDT</p>
										</div>
									</div>


								<div class="timeBlock" style="width:50%;display:inline-block">
									<p class="title">Actual</p>
									<div>
										<h4 style="display:inline-block;margin:0;font-weight:bold">--</h4>
									</div>
								</div>
								<p class="delayText">Runway Delay: -</p>
							</div>
							<div class="row additionalInfo">
								<div class="col-xs-3 col-md-4 col-sm-4 terminalBlock">
									<p class="title">Terminal</p>
									<h4 class="detail">-</h4>
								</div>
								<div class="col-xs-3 col-md-4 col-sm-4 gateBlock">
									<p class="title">Gate</p>
									<h4 class="detail">-</h4>
								</div>
								<div class="col-xs-6 col-sm-4 col-md-4 baggageBlock">
									<p class="title">Baggage Claim</p>
									<h4 class="detail">-</h4>
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
									<p class="subtitle"></p>
									<h4 class="detail">-</h4>
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