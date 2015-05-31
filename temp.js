function validateForm()
{
  	var sleepHours = document.getElementById("sleepHours");
  	var cardioHours = document.getElementById("cardioHours");
  	var weightInput = document.getElementById("weightInput");

  	var valid = true;
  	
  	if (sleepHours.value == "")
  	{
  		document.getElementById("sleepWarn").style.display = "block";
  		valid = false;
  	}
  	else
  	{
  		document.getElementById("sleepWarn").style.display = "none";	
  	}

  	if (cardioHours.value == '')
  	{
  		document.getElementById("cardioWarn").style.display = "block";
  		valid = false;
  	}
  	else
  	{
  		document.getElementById("cardioWarn").style.display = "none";	
  	}

  	if (weightInput.value == '')
  	{
  		document.getElementById("weightWarn").style.display = "block";
  		valid = false;
  	}
  	else
  	{
  		document.getElementById("weightWarn").style.display = "none";	
  	}

  	return valid;
}