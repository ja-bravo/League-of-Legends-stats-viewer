<?php 
	include("functions.php");

	$playerID = 19150065; //$_POST['PLAYER_ID'];
	$playerServer = "euw"; //$_POST['SERVER'];

	setRankedStats();
	function setRankedStats()
	{
		global $apiKey,$playerID,$playerServer;
		$champToTimes = array();
		$idToImg = array();

		$url = 'https://'.$playerServer.'.api.pvp.net/api/lol/'.$playerServer.'/v1.3/stats/by-summoner/'.$playerID.'/ranked?season=SEASON2015&api_key='.$apiKey;
		if(get_http_response_code($url) != "200")
		{
			echo "<script> showError(\"noRanked\"); </script>";
			return;
		}

		$response = file_get_contents($url);
		$rankedStats = json_decode($response);

		$championsPlayed = $rankedStats->champions;

		$url = 'https://global.api.pvp.net/api/lol/static-data/euw/v1.2/champion?champData=image&api_key='.$apiKey;
		if(get_http_response_code($url) != "200")
		{
			echo "<script> alert(\"Error: ".get_http_response_code($url) . "\"); </script>";
			return;
		}
		
		$response = file_get_contents($url);
		$champions = json_decode($response)->data;

		foreach ($champions as $champion) 
		{
			$champ = new Champion();
			$id = $champion->id;
		    $image = $champion->image;
		    
		    $idToImg[$id] = $image->full;

		    $champ->name = $champion->name;
		    $champ->title = $champion->title;
		    $champ->id = $id;
		    $champ->image = $image->full;

		    $champToTimes[$champ->id] = $champ;
		}

		for($i = 0; $i < count($championsPlayed); $i++)
		{
			$championStat = $championsPlayed[$i]->stats;
			$champID = $championsPlayed[$i]->id;
			if($champID == 0)
			{
				$totalGames = $championStat->totalSessionsPlayed;
			}
			else
			{
				$champToTimes[$champID]->timesPlayed = $championStat->totalSessionsPlayed;
			}
		}

		usort($champToTimes,"sortChamps");
		$max = count($champToTimes);
		for($i = 0; $i < $max; $i++)
		{
			if(empty($champToTimes[$i]->timesPlayed))
			{
				unset($champToTimes[$i]);
			}
		}

		echo json_encode($champToTimes);
	}

	function sortChamps($c1, $c2)
	{
		return ($c1->timesPlayed < $c2->timesPlayed);
	}
 ?>