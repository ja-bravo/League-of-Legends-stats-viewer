<?php
	// Global variables
	$apiKey = "00b6c5c7-b3cf-4798-b8b9-36cc9512eeb7";
	$id;
	$name;
	$iconID;
	$level;
	$rankedLeague;
	$idToImg = array();
	$playerServer;

	function setSummoner($summonerName,$server)
	{
		global $apiKey, $id, $name, $iconID, $level,$rankedLeague,$playerServer;
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
		$id = $stats->id;
		$name = $stats->name;
		$iconID = $stats->profileIconId;
		$level = $stats->summonerLevel;
	}

	function setRankedStats()
	{
		global $apiKey,$id,$idToImg,$playerServer;
		$totalGames;
		$url = 'https://'.$playerServer.'.api.pvp.net/api/lol/'.$playerServer.'/v1.3/stats/by-summoner/'.$id.'/ranked?season=SEASON2015&api_key='.$apiKey;
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
			$id = $champion->id;
		    $image = $champion->image;
		    
		    $idToImg[$id] = $image->full;
		}

		echo "<script>";
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
				echo "displayChampion(\"$idToImg[$champID]\",\"$championStat->totalSessionsPlayed\");";
			}
		}
		echo "</script>";
	}

	function get_http_response_code($url) 
	{
	    $headers = get_headers($url);
	    return substr($headers[0], 9, 3);
	}
 ?>