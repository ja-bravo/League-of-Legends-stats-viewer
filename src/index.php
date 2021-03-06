<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>League Of Legends Stats Tracker</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">	
	<link rel="stylesheet" href="css/style.css"/>
	<link href='http://fonts.googleapis.com/css?family=Arvo:700italic' rel='stylesheet' type='text/css'>
</head>
<body>
	<header class="container">
		<div class="col-xs-12">
			<h1>League Of Legends Statistics Tracker</h1>
		</div>
	</header>
	<section class="container main">
		<div id="headerBar" class="row">
			<div class="col-xs-3">
				
			</div>
			<div class="col-xs-6">
				<p>Enter your summoner name and start tracking!</p>
			</div>
			<div class="col-xs-3">
				
			</div>
		</div>
		<div id="inputBar" class="row">
			<article class="col-xs-12">
				<div class="input-group">
					<div class="input-group-btn">
				        <button type="button" id="chosenServer" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Server <span class="glyphicon glyphicon-collapse-down"></span></button>
				        <ul class="dropdown-menu">
				          <li><a href="#" class="serverOption" data-chosen="false">Europe West</a></li>
				          <li><a href="#" class="serverOption" data-chosen="false">Europe East and Nordic</a></li>
				          <li><a href="#" class="serverOption" data-chosen="false">North America</a></li>
				        </ul>
		      		</div>
			  		<input type="text" onchange="checkInput()" id="input" class="form-control" placeholder="Enter your summoner name...">
			  		<div class="input-group-btn">
				        <button type="button" id="search" class="btn btn-default">Search <span id="readyIcon" class="glyphicon glyphicon-remove-circle"></span></button>
		      		</div>
				</div>

				<div id="errors">
					<div id="serverError" class="error">
						<p> You need to select a server! </p>
					</div>

					<div id="nameError" class="error">
						<p> You need to enter a sumoner name! </p>
					</div>
				</div>
			</article>
		</div>
		
		<div id="bottomBar" class="row">
			<div class="col-xs-3">
				
			</div>
			<div class="col-xs-6">
			</div>
			<div class="col-xs-3">
				
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