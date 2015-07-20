
function Champion()
{
	var id;
	var image;
	var name;
	var title;
	var stats;
}

var champions = [];
var requestCode;
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

	$("#champions").on('click','.champion',function(){	
		$(".champion").hide(400);
		$("#info").hide(400);
		displayStats(champions[this.dataset.id]);
	});

	$("#btn").click(function(){
		$("#championStats").hide(400);

		$("#info").show(600);
		$(".champion").show(600);
	});

	switch (requestCode)
 	{
 		case 404:
 			$("#info").html("<h1 style=\"text-align: center;\"> 404 not found </h1>");
 			$("#champions").html("<h3 style=\"text-align: center;\">  This summoner is not registered. </h3>");
 			$("#champions").append("<h3 style=\"text-align: center;\">  Please check the server/spelling </h3>");
 			$("#summonerInfo").hide();
 			break;

		case 405:
			$("#info").hide();
			$("#tier").hide();
 			$("#champions").html("<h3 style=\"text-align: center;\">  This summoner has not played any ranked game. </h3>");
 			break;

 		case 429:
 			$("#info").html("<h1 style=\"text-align: center;\"> 429 Rate limit exceeded </h1>");
 			$("#champions").html("<h3 style=\"text-align: center;\">  Sorry, we have exceeded the rate limit. Check again in a while! </h3>");
 			$("#summonerInfo").hide();
 			$(".champion").hide();
 			break;

 		default:
 			break;
 	}
});

function displayStats(champion)
{
	var stats = champion.stats;
	$("#champID").html("<img id=\"champIMG\" style=\"float: left;\" src=\"images/champions/"+champion.image+"\" height=\"64\" width=\"64\" valign=\"middle\"/>");
	
	if($(window).width() < 960)
	{
		$("#champID").append("<h4 id=\"champTitle\" >"+champion.name+", "+champion.title+"</h4>");
		$("#btn").css("width","100%");
		$("#btn").css("margin","10px 0 15px 0");
		$("#victory").html(stats.totalSessionsWon);
		$("#defeat").html(stats.totalSessionsLost);
	}
	else
	{
		$("#champID").append("<h3 id=\"champTitle\" >"+champion.name+", "+champion.title+"</h3>");
		$("#victory").html(stats.totalSessionsWon + " Wins");
		$("#defeat").html(stats.totalSessionsLost + " Losses");
	}	

	$("#winBar").css("width",stats.totalSessionsWon/stats.totalSessionsPlayed*100+"%");
	$("#lossBar").css("width",stats.totalSessionsLost/stats.totalSessionsPlayed*100+"%");

	$("#winPercentage").html((stats.totalSessionsWon/stats.totalSessionsPlayed*100).toFixed(0)+"%");

	var medianKills =  stats.totalChampionKills/stats.totalSessionsPlayed;
	var medianDeaths = stats.totalDeathsPerSession/stats.totalSessionsPlayed;
	var medianAssists = stats.totalAssists/stats.totalSessionsPlayed;
	var kdaRatio = ((medianKills + medianAssists)/medianDeaths).toFixed(2);

	var medianCS = stats.totalMinionsKilled/stats.totalSessionsPlayed;

	$("#tKDA").html(medianKills.toFixed(2)+" / "+medianDeaths.toFixed(2)+" / "+medianAssists.toFixed(2));
	$("#tDamage").html((stats.totalDamageDealt/stats.totalSessionsPlayed).toFixed(0));
	$("#tCreeps").html((stats.totalMinionKills/stats.totalSessionsPlayed).toFixed(0));

	
	$("#tDK").html(stats.totalDoubleKills);
	$("#tTK").html(stats.totalTripleKills);
	$("#tQK").html(stats.totalQuadraKills);
	$("#tPK").html(stats.totalPentaKills);
	$("#championStats").show(800);

}

function setUser(user,level)
{
	$("#user").html(user);
}

function displayChampion(title,name,id,image)
{
	$("#champions").append("<image class=\"champion\" data-title=\""+title+"\" data-id=\""+id+"\" data-name=\""+name+"\" height=\"64\" width=\"64\" src=\"images/champions/"+image+"\" valign=\"middle\"/>");
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
		
		for(var i = 0; i < result.length; i++)
		{
			var champion = new Champion();
		
			champion.id = result[i].id;
			champion.image = result[i].image;
			champion.name = result[i].name;
			champion.title = result[i].title;
			champion.stats = result[i].stats;

			champions[champion.id] = champion;
			displayChampion(champion.title,champion.name,champion.id,champion.image);
		}
	});
}

$(document).bind("ajaxSend", function(){
	$("#champions").html("<image id=\"loading\" src=\"images/loading.gif\" style=\"margin: auto; width: 99%;height: 30px;\"/>");
 }).bind("ajaxComplete", function(){
	$("#loading").hide();
 });

function handleError(errorCode)
{
 	requestCode = errorCode;
}