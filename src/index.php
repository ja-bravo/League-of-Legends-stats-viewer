<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>League Of Legends Stats Tracker</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">	
	<link rel="stylesheet" href="css/style.css"/>
</head>
<body>
	<header class="container">
		<div class="col-xs-12">
			<h1>League Of Legends Statistics Tracker</h1>
		</div>
	</header>
	<section class="container main">
		<div id="inputBar" class="row">
			<article class="col-xs-12">
				<div class="input-group">
					<div class="input-group-btn">
				        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Server <span class="glyphicon glyphicon-collapse-down"></span></button>
				        <ul class="dropdown-menu">
				          <li><a href="#" class="serverOption">Europe West</a></li>
				          <li><a href="#" class="serverOption">Europe East & Nordic</a></li>
				          <li><a href="#" class="serverOption">North America</a></li>
				        </ul>
		      		</div>
			  		<input type="text" onchange="checkInput()" id="input" class="form-control" placeholder="Enter your summoner name...">
			  		<div class="input-group-btn">
				        <button type="button" id="search" class="btn btn-default">Search <span id="readyIcon" class="glyphicon glyphicon-remove-circle"></span></button>
		      		</div>
				</div>
			</article>
		</div>
		
		<div class="container">
			<div class="summonerInfo">
			</div>
		</div>
		
		<div class="row">
			<footer class="col-xs-12">
				<h4>© 2015 Jose Antonio Bravo</h4>
			</footer>
		</div>
	</section>

	
	<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="scripts/script.js"></script>
</body>
</html>

<?php 
	include("functions.php");

	setSummoner("tr0yz","euw");

	echo "$id \n";
	echo "$name \n";
	echo "$iconID \n";
	echo "$level \n";
?>