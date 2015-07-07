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
		var server = "euw";

		$.post("index.php",{user: summoner,server: server});
	});
});


$(document).bind("ajaxSend", function () {
}).bind("ajaxStop", function () {
            $("#summonerInfo").load("summoner.php");
});