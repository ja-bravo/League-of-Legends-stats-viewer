
function Champion()
{
	var totalKills;
	var totalDeaths;
	var totalAssists;

	var doubleKills;
	var tripleKills;
	var quadraKills;
	var pentaKills;

	var gamesWon;
	var gamesLost;
	var totalGames;

	var turretsKilled;

	var totalMagicDamage;
	var totalPhysicalDamage;
	var totalDamageTaken;
	var totalDamageDealt;

	var image;
	var name;
	var title;
}

$(document).ready(function(){
	$("#championStats").hide();
	switch($("#icon")[0].dataset.tier)
	{
		case "BRONZE":
			$("#tier").attr("src","images/tiers/bronze.png");
			break;

		case "SILVER":
			$("#tier").attr("src","images/tiers/silver.png");
			break;

		case "GOLD":
			$("#tier").attr("src","images/tiers/gold.png");
			break;

		case "PLATINUM":
			$("#tier").attr("src","images/tiers/platinum.png");
			break;

		case "DIAMOND":
			$("#tier").attr("src","images/tiers/diamond.png");
			break;

		case "MASTER":
			$("#tier").attr("src","images/tiers/master.png");
			break;

		case "CHALLENGER":
			$("#tier").attr("src","images/tiers/challenger.png");
			break;
	}

	$(".champion").click(function(){
		$(".champion").hide(600);
		$("#info").hide(600);

		var champID = $(this)[0].dataset.id;
		var playerID = $("#summData")[0].dataset.id;
		var playerServer = $("#summData")[0].dataset.server;

		var image = $(this)[0].currentSrc;
		var name = $(this)[0].dataset.name;
		var title = $(this)[0].dataset.title;

		$.post("championData.php", {'ID': champID,'PLAYER_ID': playerID, 'SERVER': playerServer},function(response) {
			var result = jQuery.parseJSON(response);

			var champion = new Champion();
			champion.totalKills = result.totalChampionKills;
			champion.totalDeaths = result.totalDeathsPerSession;
			champion.totalAssists = result.totalAssists;

			champion.doubleKills = result.totalDoubleKills;
			champion.tripleKills = result.totalTripleKills;
			champion.quadraKills = result.totalQuadraKills;
			champion.pentakills  = result.totalPentaKills;

			champion.gamesWon = result.totalSessionsWon;
			champion.gamesLost = result.totalSessionsLost;
			champion.totalGames = result.totalSessionsPlayed;

			champion.turretsKilled = result.totalTurretsKilled;

			champion.totalMagicDamage = result.totalMagicDamageDealt;
			champion.totalPhysicalDamage = result.totalPhysicalDamageDealt;
			champion.totalDamageTaken = result.totalDamageTaken;
			champion.totalDamageDealt = result.totalDamageDealt;

			champion.image = image;
			champion.name = name;
			champion.title = title;

			displayStats(champion);
		});
	});

	$("#btn").click(function(){
		$("#championStats").hide(600);

		$("#info").show(1200);
		$(".champion").show(1200);
	});
});

function displayStats(champion)
{
	$("#champID").html("<img id=\"champIMG\" style=\"float: left;\" src=\""+champion.image+"\" height=\"64\" width=\"64\" valign=\"middle\"/>");
	
	if($(window).width() < 960)
	{
		$("#champID").append("<h4 id=\"champTitle\" >"+champion.name+", "+champion.title+"</h4>");
	}
	else
	{
		$("#champID").append("<h3 id=\"champTitle\" >"+champion.name+", "+champion.title+"</h3>");
	}

	$("#championStats").show(100);

}

function setUser(user,level)
{
	$("#user").html(user);
}

function displayChampion(title,name,id,image,times)
{
	$("#champions").append("<image class=\"champion\" data-title=\""+title+"\" data-id=\""+id+"\" data-name=\""+name+"\" data-timesPlayed=\""+times+"\" height=\"64\" width=\"64\" src=\"images/champions/"+image+"\" valign=\"middle\"/>");
}

function showError()
{
	$("#champions").html("<h1> This player has no ranked games this season, play some to track!");
}
