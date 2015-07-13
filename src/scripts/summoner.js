
function Champion()
{
	var id;
	var image;
	var name;
	var title;
	var stats;
}

var champions = [];
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
		console.log(response);
		var result = jQuery.parseJSON(response);
		for(var i = 0; i < result.length; i++)
		{
			var champion = new Champion();
		
			champion.id = result[i].id;
			champion.image = result[i].image;
			champion.name = result[i].name;
			champion.title = result[i].title;
			champion.stats = result[i].stats;

			champions.push(champion);
			displayChampion(champion.title,champion.name,champion.id,champion.image);
		}
	});
}

$(document).bind("ajaxSend", function(){
	$("#champions").html("<image id=\"loading\" src=\"images/loading.gif\" style=\"margin: auto; width: 99%;height: 30px;\"/>");
 }).bind("ajaxComplete", function(){
	$("#loading").hide();
 });