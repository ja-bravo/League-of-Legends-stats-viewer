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
	$playerServer;


	function setSummoner($summonerName,$server)
	{
		global $apiKey, $playerID, $name, $iconID, $level, $playerServer,$rankedLeague,$rankedTier;
		$playerServer = $server;
		$summonerName = str_replace(' ','',$summonerName); // So if the user has spaces in it, it works.

		$url = 'https://'.$server.'.api.pvp.net/api/lol/'.$server.'/v1.4/summoner/by-name/' . $summonerName . '?api_key=' . $apiKey;
		$response = @file_get_contents($url);

		if(requestFailed($response,$url))
		{
			$error = error_get_last();
			$error = $error['message'];

			$errorCode = substr($error,strpos($error,"/1.1")+5,3);
			handleError($errorCode,$url,"name and playerID");
			return;
		}

		$stats = json_decode($response)->$summonerName;
		$playerID = $stats->id;
		$name = $stats->name;
		$iconID = $stats->profileIconId;
		$level = $stats->summonerLevel;

		$url = 'https://'.$playerServer.'.api.pvp.net/api/lol/'.$playerServer.'/v2.5/league/by-summoner/'.$playerID.'?api_key='.$apiKey;		
		$response = @file_get_contents($url);

		if(requestFailed($response,$url))
		{
			$error = error_get_last();
			$error = $error['message'];

			$errorCode = substr($error,strpos($error,"/1.1")+5,3);
			
			if($errorCode == "404" || $errorCode == "503")
			{
				handleError(405,$url,"league and tier");
			}
			else
			{
				handleError($errorCode,$url,"league and tier");
			}
			return;
		}

		$league = json_decode($response)->$playerID;

		$rankedLeague = $league[0]->name;
		$rankedTier = $league[0]->tier;
	}

	function requestFailed($response,$url) 
	{
		if(!$response)
		{
			return true;
		}
		return false;
	}

	function handleError($errorCode,$url,$part)
	{
		echo "<script> handleError($errorCode); </script>";
		$time = time();
		$time = date("H:i:s | d-m-y");
		$url = substr($url,0,strlen($url) - 36);
		error_log("ERROR: $errorCode @ $time | $part | URL: $url**REDACTED** \r\n",3,"log/log.txt");
	}
 ?>