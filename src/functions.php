<?php
	// Global variables
	$apiKey = "00b6c5c7-b3cf-4798-b8b9-36cc9512eeb7";
	$id;
	$name;
	$iconID;
	$level;

	function setSummoner($summonerName,$server)
	{
		global $apiKey, $id, $name, $iconID, $level;

		$url = 'https://'.$server.'.api.pvp.net/api/lol/'.$server.'/v1.4/summoner/by-name/' . $summonerName . '?api_key=' . $apiKey;
		$response = file_get_contents($url);

		$stats = json_decode($response)->$summonerName;

		$id = $stats->id;
		$name = $stats->name;
		$iconID = $stats->profileIconId;
		$level = $stats->summonerLevel;
	}
 ?>