
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

	var minionsKilled;

	var image;
	var name;
	var title;
}

$(document).ready(function(){
	$("#championStats").hide();
	$("title").html($("#summData")[0].dataset.name + " stats");

	prepareChampions();
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

			champion.minionsKilled = result.totalMinionKills;

			champion.image = image;
			champion.name = name;
			champion.title = title;

			displayStats(champion);
		});
	});

	$("#btn").click(function(){
		$("#championStats").hide(600);

		$("#info").show(800);
		$(".champion").show(800);
	});
});

function displayStats(champion)
{
	$("#champID").html("<img id=\"champIMG\" style=\"float: left;\" src=\""+champion.image+"\" height=\"64\" width=\"64\" valign=\"middle\"/>");
	
	if($(window).width() < 960)
	{
		$("#champID").append("<h4 id=\"champTitle\" >"+champion.name+", "+champion.title+"</h4>");
		$("#btn").css("width","100%");
		$("#btn").css("margin","10px 0 15px 0");
		$("#victory").html(champion.gamesWon);
		$("#defeat").html(champion.gamesLost);
	}
	else
	{
		$("#champID").append("<h3 id=\"champTitle\" >"+champion.name+", "+champion.title+"</h3>");
		$("#victory").html(champion.gamesWon + " Wins");
		$("#defeat").html(champion.gamesLost + " Losses");
	}

	

	$("#winBar").css("width",champion.gamesWon/champion.totalGames*100+"%");
	$("#lossBar").css("width",champion.gamesLost/champion.totalGames*100+"%");

	$("#winPercentage").html((champion.gamesWon/champion.totalGames*100).toFixed(0)+"%");

	var medianKills =  champion.totalKills/champion.totalGames;
	var medianDeaths = champion.totalDeaths/champion.totalGames;
	var medianAssists = champion.totalAssists/champion.totalGames;

	var medianCS = champion.minionsKilled/champion.totalGames;

	$("#stats").html("<h3>"+ medianKills.toFixed(1)+"/"+medianDeaths.toFixed(1)+"/"+medianAssists.toFixed(1)+"</h3>");
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

function prepareChampions()
{
	var playerID = $("#summData")[0].dataset.id;
	var playerServer = $("#summData")[0].dataset.server;

	$.post("setChampions.php", {'PLAYER_ID': playerID, 'SERVER': playerServer},function(response) {
			var result = jQuery.parseJSON(response);
			console.dir(result);
	});
}