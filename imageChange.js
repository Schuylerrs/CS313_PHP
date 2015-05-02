$(document).ready(
	function()
	{
		$(".hover").mouseover(function()
		{
			$(".hover").css("width", "80%");	
		});
 		
 		$(".hover").mouseout(function()
 		{
			$(".hover").css("width", "75%");
   		});
	});