<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> stats</title> <!-- Add summoner name -->
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">	
	<link rel="stylesheet" href="css/style.css"/>
	<link href='http://fonts.googleapis.com/css?family=Arvo:700italic' rel='stylesheet' type='text/css'>

	<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="scripts/script.js"></script> 	
	<script src="scripts/summoner.js"></script>
</head>
<body>
	<?php 
		if(isset($_REQUEST['summoner']))
		{
			include("functions.php");
			$summoner = $_REQUEST['summoner'];
			$server = $_REQUEST['server'];

			setSummoner(strtolower($summoner),$server);

		}
 	?>
	<header class="container">
		<div class="row">
			<div class="col-xs-12 col-md-3">
				<h1 id="title"> Statistics</h1>
			</div>

			<div id="inputBar2" class="col-xs-12 col-md-9">
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
		</div>
	</header>

	<section class="container main">
		<div id="summonerInfo" class="row">
			<div id="summImg" class="summInfo">
				<image id="tier" style="position: absolute; z-index: 100;" src="" id="tier" height="70" width="70">
				<image id="icon" data-tier="<?php echo $rankedTier; ?>" height="64" width="64" src="images/profileIcon/<?php echo $iconID; ?>.png" valign="middle"/>
				<div id="level"><span><?php echo $level; ?></span></div>
			</div>
			<div id="summName" class="summInfo">
				<h3 id="user"><?php echo $name; ?></h3>
				<h4 id="league"><?php echo $rankedLeague; ?></h4>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-1">
				
			</div>

			<div class="col-xs-10" id="info" style="text-align: center;">
				<h1 style="margin: 0;">Champions played on ranked</h1>
				<h2 style="margin: 0;">Click to see the stats</h2>
			</div>

			<div class="col-xs-1"></div>
		</div>
		<div class="row">
			<div class="col-xs-1">
			
			</div>
			<div id="champions" class="col-xs-10">
			
			</div>
			<div class="col-xs-1">
			
			</div>
		</div>

		<div id="championStats">
			<div class="row">
				<div class="col-xs-0 col-md-2">
					
				</div>
				<div class="col-xs-12 col-md-8">
					<div id="champID"></div>
				</div>

				<div class="col-xs-12 col-md-2">
					<button type="button" class="btn btn-primary btn-lg" id="btn">Show all champions</button>
				</div>
				<hr class="separator"/>
			</div>

			<div class="row">
				<div class="col-xs-12">
					<div id="totalGames"><div id="victory"></div><div id="defeat"></div></div>
					<div id="winLossBar"><div id="winBar"></div><div id="lossBar"></div></div>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-2">
				</div>

				<div id="winPercentage" class="col-xs-8">

				</div>

				<div class="col-xs-2">
				</div>
			</div>

			<div class="row">
				<div class="col-xs-2">
				</div>

				<div id="stats" class="col-xs-12 col-md-8">
					<h1 style="text-align: center;">Stats per game</h1>
					<table >
	                    <tr>
	                        <th>KDA</th>
							<th>Total Damage</th>
							<th>Creeps</th>
	                    </tr>
	                    <tr>
	                       <td id="tKDA"></td>
							<td id="tDamage"></td>
							<td id="tCreeps"></td>
	                    </tr>
	                </table>
					
					<h1 style="text-align: center;">Total</h1>
					<table>
						<tr>
							<th>Double Kills</th>
							<th>Triple Kills</th>
							<th>Quadra Kills</th>
							<th>Penta Kills</th>
						</tr>

						<tr>
							<td id="tDK"></td>
							<td id="tTK"></td>
							<td id="tQK"></td>
							<td id="tPK"></td>
						</tr>
					</table>
				</div>

				<div  class="col-xs-2">
				</div>
			</div>
		</div>
		

		<div class="row">
			<footer class="col-xs-12">
				<h4>© 2015 Jose Antonio Bravo</h4>
			</footer>
		</div>
	</section>
	
	<div id="summData" data-id="<?php echo $playerID ?>" data-name="<?php echo  strtolower($summoner)?>" data-server="<?php echo $server ?>"></div>
</body>
</html>