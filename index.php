<?php
// My api key
	$apiKey = "f4060f365289ad66bcfe2b1bce8d42d4";
	
	function fetch_weacher_forecast($api_key, $city) {
		$googleApiUrl = "api.openweathermap.org/data/2.5/forecast?q=" . $city . "&cnt=7&lang=en&units=metric&APPID=" . $api_key;
	    
	    // request api
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_VERBOSE, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$response = curl_exec($ch);
		curl_close($ch);

		// use json_decode() function to convert the JSON string into a PHP object
		$data = json_decode($response);
		return $data;
	}
	
	if(isset($_GET["city"])) {
		$city = $_GET["city"];
	}else {
		$city = 'xiangyang';
	}
	$data = fetch_weacher_forecast($apiKey, $city);

	$today = $data->list[0];
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Weather</title>
		<!--bootstrap-css-->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!--My css style-->
		<link rel="stylesheet" href="css/styles.css">
		<!-- title icon-->
		<link type="image/x-icon" rel="icon" href="images/icon.png">

	</head>

	<body class="bg">

		<div class="container">
		<div class="row">
				<div class="col-lg-12 topTitle">
					<!-- city title -->
					<span class="cityTitle"><?php echo(ucfirst($city)); ?></span>
				    
				    <!-- dropdown button -->
					<button class="btn btn-danger dropdown-toggle changeBtn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					  Change City
					</button>
					<!-- dropdown menu -->
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					  <a class="dropdown-item" href="index.php?city=Xiangyang">Xiangyang,China</a >
					  <a class="dropdown-item" href="index.php?city=Wuhan">Wuhan,China</a >
					  <a class="dropdown-item" href="index.php?city=Shanghai">Shanghai,China</a >
					  <a class="dropdown-item" href="index.php?city=Beijing">Beijing,China</a>
					  <a class="dropdown-item" href="index.php?city=Tokyo,Japan">Tokyo,Japan</a>
					  <a class="dropdown-item" href="index.php?city=London,UK">London,UK</a>
					  <a class="dropdown-item" href="index.php?city=Birmingham,UK">Birmingham,UK</a>
					  <a class="dropdown-item" href="index.php?city=New York,USA">New York,USA</a>
					  <a class="dropdown-item" href="index.php?city=Los Angeles,USA">Los Angeles, USA</a>
					  <a class="dropdown-item" href="index.php?city=Sydney,Australia">Sydney,Australia</a>
					</div>
			   </div>
		
			<div class="row currentWeather">
				<!-- date -->
				<section class="col-lg-4 col-md6 col-sm-6 col-6">
					<p class="weekTitle"><?php echo date("l") ?></p>
					<p class="dateTitle"><?php echo date("d M yy",time()) ?></p>
					<img class="icon" src="http://openweathermap.org/img/wn/<?php echo $today->weather[0]->icon; ?>@2x.png" alt="Icon">
					<p class="weather"><?php echo ucwords($today->weather[0]->description); ?></p>
				</section>
                <!-- max/min tem -->
				<section class="col-lg-4 col-md-6 col-sm-6 col-6 tem-title">
					<?php echo round($today->main->temp_max); ?>°C</br>
					<?php echo round($today->main->temp_min); ?>°C
				</section>
                
                <!-- weather detial -->
				<section class="col-lg-4 col-md-12 col-sm-12 col-12 tem-detail">
					<p>Current: <strong><?php echo round($today->main->temp); ?>°C </strong></p>
					<p>Feels like: <strong><?php echo round($today->main->feels_like); ?>°C </strong></p>
					<p>Pressure: <strong><?php echo round($today->main->pressure); ?> hPa </strong></p>
					<p>Humidity: <strong><?php echo round($today->main->humidity); ?> % </strong></p>
					<p>Wind speed: <strong><?php echo round($today->wind->speed); ?> m/s </strong></p>
				</section>
                 
                 <!-- forecast weather in 6 days -->
				<?php $today = $data->list[1]; ?>
				<section class="col-lg-2 col-md-4 col-sm-6 col-6 forecast">
					<p class="weekSubtitle"><?php echo date("l", time()+86400)?></p>
					<p class="dateSubtitle"><?php echo date("d M",time()+86400) ?></p>
					<img class="item" src="http://openweathermap.org/img/wn/<?php echo $today->weather[0]->icon; ?>@2x.png" alt="Icon">
					<div class="subtitle"><?php echo ucwords($today->weather[0]->description); ?></div>
					<h5><?php echo round($today->main->temp_max); ?>°C</h5>
					<h5><?php echo round($today->main->temp_min); ?>°C</h5>
				</section>
				<?php $today = $data->list[2]; ?>
				<section class="col-lg-2 col-md-4 col-sm-6 col-6 forecast">
					<p class="weekSubtitle"><?php echo date("l", time()+86400*2)?></p>
					<p class="dateSubtitle"><?php echo date("d M",time()+86400*2) ?></p>
					<img class="item" src="http://openweathermap.org/img/wn/<?php echo $today->weather[0]->icon; ?>@2x.png" alt="Icon">
					<div class="subtitle"><?php echo ucwords($today->weather[0]->description); ?></div>
					<h5><?php echo round($today->main->temp_max); ?>°C</h5>
					<h5><?php echo round($today->main->temp_min); ?>°C</h5>
				</section>
				<?php $today = $data->list[3]; ?>
				<section class="col-lg-2 col-md-4 col-sm-6 col-6 forecast">
					<p class="weekSubtitle"><?php echo date("l", time()+86400*3)?></p>
					<p class="dateSubtitle"><?php echo date("d M",time()+86400*3) ?></p>
					<img class="item" src="http://openweathermap.org/img/wn/<?php echo $today->weather[0]->icon; ?>@2x.png" alt="Icon">
					<div class="subtitle"><?php echo ucwords($today->weather[0]->description); ?></div>
					<h5><?php echo round($today->main->temp_max); ?>°C</h5>
					<h5><?php echo round($today->main->temp_min); ?>°C</h5>
				</section>
				<?php $today = $data->list[4]; ?>
				<section class="col-lg-2 col-md-4 col-sm-6 col-6 forecast">
					<p class="weekSubtitle"><?php echo date("l", time()+86400*4)?></p>
					<p class="dateSubtitle"><?php echo date("d M",time()+86400*4) ?></p>
					<img class="item" src="http://openweathermap.org/img/wn/<?php echo $today->weather[0]->icon; ?>@2x.png" alt="Icon">
					<div class="subtitle"><?php echo ucwords($today->weather[0]->description); ?></div>
					<h5><?php echo round($today->main->temp_max); ?>°C</h5>
					<h5><?php echo round($today->main->temp_min); ?>°C</h5>
				</section>
				<?php $today = $data->list[5]; ?>
				<section class="col-lg-2 col-md-4 col-sm-6 col-6 forecast">
					<p class="weekSubtitle"><?php echo date("l", time()+86400*5)?></p>
					<p class="dateSubtitle"><?php echo date("d M",time()+86400*5) ?></p>
					<img class="item" src="http://openweathermap.org/img/wn/<?php echo $today->weather[0]->icon; ?>@2x.png" alt="Icon">
					<div class="subtitle"><?php echo ucwords($today->weather[0]->description); ?></div>
					<h5><?php echo round($today->main->temp_max); ?>°C</h5>
					<h5><?php echo round($today->main->temp_min); ?>°C</h5>
				</section>
				<?php $today = $data->list[6]; ?>
				<section class="col-lg-2 col-md-4 col-sm-6 col-6 forecast">
					<p class="weekSubtitle"><?php echo date("l", time()+86400*6)?></p>
					<p class="dateSubtitle"><?php echo date("d M",time()+86400*6) ?></p>
					<img class="item" src="http://openweathermap.org/img/wn/<?php echo $today->weather[0]->icon; ?>@2x.png" alt="Icon">
					<div class="subtitle"><?php echo ucwords($today->weather[0]->description); ?></div>
					<h5><?php echo round($today->main->temp_max); ?>°C</h5>
					<h5><?php echo round($today->main->temp_min); ?>°C</h5>
				</section>
			</div>
			<!-- row -->
		</div>
		<!-- content container -->
		
		<!--bootstrap js&jquery-->
	<!--bootstrap js&jquery-->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	</body>

</html>