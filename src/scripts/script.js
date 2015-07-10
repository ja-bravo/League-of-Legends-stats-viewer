function checkInput()
{
	var input = $("#input");
	
	if(input.val())
	{
		$("#readyIcon").attr('class','glyphicon glyphicon-ok-circle');
	}
	else
	{
		$("#readyIcon").attr('class','glyphicon glyphicon-remove-circle');
	}
}

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

	$(".error").hide();

	$('#search').click(function() {
		$("#serverError").hide();
		$("#nameError").hide();

		var summoner = $("#input").val();
	
		var servers = $(".serverOption");
		var server;

		for(var i = 0; i < servers.length; i++)
		{
			if(servers[i].dataset.chosen == "true")
			{
				server = servers[i].innerHTML;
			}
		}

		if(server == undefined || summoner == "")
		{
			if (summoner == "")
			{
				$("#nameError").show();
			}
			
			if(server == undefined)
			{
				$("#serverError").show();
			}
		}
		else
		{
			if(server == "Europe West")
			{
				server = "euw";
			}
			else if(server == "North America")
			{
				server = "na";
			}
			else
			{
				server = "eune";
			}

			location.href = "summoner.php?summoner="+summoner+"&server="+server;
		}
	});

	$(".serverOption").click(function() {
		var servers = $(".serverOption");

		for(var i = 0; i < servers.length; i++)
		{
			servers[i].dataset.chosen = "false";
		}

		this.dataset.chosen = "true";

		$("#chosenServer").html(this.innerHTML + " <span class=\"glyphicon glyphicon-collapse-down\"></span>");
	});

	$(".champion").click(function() {
		$("#champions").fadeOut(500);
	});
});

function setUser(user,level)
{
	$("#user").html(user);
}

function displayChampion(name,image,times)
{
	$("#champions").append("<image class=\"champion\" data-name=\""+name+"\" data-timesPlayed=\""+times+"\" height=\"64\" width=\"64\" src=\"images/champions/"+image+"\" valign=\"middle\"/>");
}

function showError(type)
{
	$("#champions").html("<h1> This player has no ranked games this season, play some to track!");
}

function displayStats()
{
	
}