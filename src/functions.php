<?php
	include("champion.php");
	include("connection.php");

	// Global variables
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

	function get_http_response_code($url) 
	{
	    $headers = get_headers($url);
	    return substr($headers[0], 9, 3);
	}
 ?>