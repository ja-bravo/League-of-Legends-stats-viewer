<?php
	include("champion.php");
	// Global variables
	$apiKey = "00b6c5c7-b3cf-4798-b8b9-36cc9512eeb7";
	$playerID;
	$name;
	$iconID;
	$level;
	$rankedLeague;
	$rankedTier;
	$idToImg = array();
	$champToTimes = array();
	$playerServer;


	function setSummoner($summonerName,$server)
	{
		global $apiKey, $playerID, $name, $iconID, $level, $playerServer,$rankedLeague,$rankedTier;
		$playerServer = $server;
		$summonerName = str_replace(' ','',$summonerName); // So if the user has spaces in it, it works.

		$url = 'https://'.$server.'.api.pvp.net/api/lol/'.$server.'/v1.4/summoner/by-name/' . $summonerName . '?api_key=' . $apiKey;
		if(get_http_response_code($url) != "200")
		{
			echo "<script> alert(\"Player not found\"); </script>";
			return;
		}

		$response = file_get_contents($url);

		$stats = json_decode($response)->$summonerName;
		$playerID = $stats->id;
		$name = $stats->name;
		$iconID = $stats->profileIconId;
		$level = $stats->summonerLevel;

		$url = 'https://'.$playerServer.'.api.pvp.net/api/lol/'.$playerServer.'/v2.5/league/by-summoner/'.$playerID.'?api_key='.$apiKey;
		if(get_http_response_code($url) != "200")
		{
			echo "<script> alert(\"Error: ".get_http_response_code($url) . "\"); </script>";
			return;
		}
		
		$response = file_get_contents($url);
		$league = json_decode($response)->$playerID;

		$rankedLeague = $league[0]->name;
		$rankedTier = $league[0]->tier;
	}

	function setRankedStats()
	{
		global $apiKey,$playerID,$idToImg,$playerServer,$champToTimes;

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
		echo "<script>";
		foreach($champToTimes as $champion => $value)
		{
			if(isset($value->timesPlayed))
			{
				echo "displayChampion(\"$value->name\",\"$value->image\",\"$value->timesPlayed\");";
			}
		}
		echo "</script>";
	}

	function sortChamps($c1, $c2)
	{
		return ($c1->timesPlayed < $c2->timesPlayed);
	}

	function get_http_response_code($url) 
	{
	    $headers = get_headers($url);
	    return substr($headers[0], 9, 3);
	}
 ?>