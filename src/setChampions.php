<?php 
	include("connection.php");
	include("functions.php");
	$playerID = $_POST['PLAYER_ID'];
	$playerServer = $_POST['SERVER'];

	getRankedStats();
	function getRankedStats()
	{
		global $apiKey,$playerID,$playerServer;

		$url = 'https://'.$playerServer.'.api.pvp.net/api/lol/'.$playerServer.'/v1.3/stats/by-summoner/'.$playerID.'/ranked?season=SEASON2015&api_key='.$apiKey;
		$response = file_get_contents($url);

		if(requestFailed($response,$url))
		{
			$error = error_get_last();
			$error = $error['message'];

			$errorCode = substr($error,strpos($error,"/1.1")+5,3);
			handleError($errorCode,$url);
			return;
		}

		$rankedStats = json_decode($response);
		$championsPlayed = $rankedStats->champions;

		$url = 'https://global.api.pvp.net/api/lol/static-data/'.$playerServer.'/v1.2/champion?champData=image&api_key='.$apiKey;
		$response = file_get_contents($url);
		
		if(requestFailed($response,$url))
		{
			$error = error_get_last();
			$error = $error['message'];

			$errorCode = substr($error,strpos($error,"/1.1")+5,3);
			handleError($errorCode,$url);
			return;
		}

		$champions = json_decode($response)->data;

		$playerChampions = array();
		foreach( $champions as $key => $champion ) 
		{
			foreach( $championsPlayed as $key => $championPlayed ) 
			{
				if($championPlayed->id == $champion->id)
				{
					$champ = new Champion();

					$champ->name = $champion->name;
					$champ->id = $champion->id;
					$champ->title = $champion->title;
					$champ->image = $champion->image->full;
					$champ->stats = $championPlayed->stats;
					array_push($playerChampions,$champ);
					break;
				}
			}
		}

		usort($playerChampions,"sortChamps");
		echo json_encode($playerChampions);
	}

	function sortChamps($c1, $c2)
	{
		return ($c1->stats->totalSessionsPlayed < $c2->stats->totalSessionsPlayed);
	}
 ?>