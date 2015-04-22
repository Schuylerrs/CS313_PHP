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
				var text = document.getElementById("textInput").value;
				var color = document.getElementById("colorInput").value;
				appendText(text);
				updateColor(color);
			}

			function appendText(text)
			{	
				var e = document.getElementById("displayedText");
				e.innerHTML += text;
			}

			function updateColor(color)
			{
				var e = document.getElementById("displayedText");
				e.style.backgroundColor = color;	
			}