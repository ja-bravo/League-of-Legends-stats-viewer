<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> stats</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">	
	<link rel="stylesheet" href="css/style.css"/>
	<link href='http://fonts.googleapis.com/css?family=Arvo:700italic' rel='stylesheet' type='text/css'>
</head>
<body>
	<header class="container">
		<div class="col-xs-12">
			<h1 id="title"> Statistics</h1>
		</div>
	</header>

	<section class="container main">
		<div id="summonerInfo">
			<div id="summImg" class="summInfo">
				<image height="64" width="64" src="http://avatar.leagueoflegends.com/euw/tr0yz.png" valign="middle"/>
			</div>
			<div id="summName" class="summInfo">
				<h3 id="user"> </h3>
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
	
	if(isset($_REQUEST['summoner']))
	{
		include("functions.php");
		$summoner = $_REQUEST['summoner'];
		$server = $_REQUEST['server'];

		setSummoner($summoner,$server);

		echo $rankedLeague;
		echo "<script> setUser(\"$summoner\",\"$level\"); </script>";
	}


 ?>