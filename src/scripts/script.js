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

	$(document).on('keyup', function(e) 
 	{
	    if (e.which == 13 || e.keyCode == 13) 
	    {
	        $("#search").click();
	    }
	});
});