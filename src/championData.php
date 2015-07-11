<?php 
	include("functions.php");

	$championID = $_POST['ID'];
	$playerID = $_POST['PLAYER_ID'];
	$server = $_POST['SERVER'];

	$url = 'https://'.$server.'.api.pvp.net/api/lol/'.$server.'/v1.3/stats/by-summoner/'.$playerID.'/ranked?season=SEASON2015&api_key='.$apiKey;

	if(get_http_response_code($url) != "200")
	{
		echo "<script> showError(\"noRanked\"); </script>";
		return;
	}

	$response = file_get_contents($url);
	$rankedStats = json_decode($response);

	$championsPlayed = $rankedStats->champions;
	$champion;
	for($i = 0; $i < count($championsPlayed); $i++)
	{
		if($championsPlayed[$i]->id == $championID)
		{
			$champion = $championsPlayed[$i]->stats;
			break;
		}
	}

	echo json_encode($champion);
 ?>
