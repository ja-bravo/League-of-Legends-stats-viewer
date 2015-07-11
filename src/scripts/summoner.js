$(document).ready(function(){
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
		$(this).show("slow");

		var champID = $(this)[0].dataset.id;
		var playerID = $("#summData")[0].dataset.id;
		var playerServer = $("#summData")[0].dataset.server;

		$.post("championData.php", {'ID': champID,'PLAYER_ID': playerID, 'SERVER': playerServer},function(response) {
			alert(response);
		});
	});
});

function setUser(user,level)
{
	$("#user").html(user);
}

function displayChampion(name,id,image,times)
{
	$("#champions").append("<image class=\"champion\" data-id=\""+id+"\" data-name=\""+name+"\" data-timesPlayed=\""+times+"\" height=\"64\" width=\"64\" src=\"images/champions/"+image+"\" valign=\"middle\"/>");
}

function showError()
{
	$("#champions").html("<h1> This player has no ranked games this season, play some to track!");
}

function displayStats()
{
	
}
