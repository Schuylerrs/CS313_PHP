

function toggleVisibility()
{
	var e = document.getElementById("displayedText");
	if (e.style.display == "block")
	{
		e.style.display = "none";	
	}
	else
	{
		e.style.display = "block";
	}
}

function handleUpdateClick()
{
	var text = $("#textInput").val();
	var color = $("#colorInput").val();

	if (confirm("Are you sure you want to update?") == true)
	{
		appendText(text);
		updateColor(color);
	}
}

function appendText(text)
{	
	var e = $("#displayedText");
	text = e.text() + text;
	e.text(text);
}

function updateColor(color)
{
	var e = $("#displayedText");
	e.css("background-color", color);	
}