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
	$('#search').click(function() {
		var summoner = $("#input").val();
	
		var servers = $(".serverOption");

		for(var i = 0; i < servers.length; i++)
		{
			console.log(servers[i].dataset.chosen);
		}
	});
});

