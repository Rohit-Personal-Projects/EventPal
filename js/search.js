function applyFilter(elementId, filterType) {
	var checkboxes = document.getElementsByName(elementId);
	
	if(checkboxes.length == 0) {
		alert("Please select at least one value");
	}
	else {
		
		var values = "";
		for(var resInd = 0; resInd < checkboxes.length; resInd++) {
			if (checkboxes[resInd].checked) {
				values += checkboxes[resInd].value + ",";
			}
		}
		values = values.slice(0, -1);
		
		window.location.href = updateURLParameter(window.location.href, filterType, values);
		
	}

}


function applyFilter2(elementId, filterType) {
	var resultSet = document.getElementById(elementId + "_chosen").getElementsByClassName("result-selected");
	console.log(resultSet.length);
	if(resultSet.length == 0) {
		alert("Please select at least one value");
	}
	else {
		//console.log(resultSet);

		var optionSet = document.getElementById(elementId);
		var optionsDict = {};
		for(var optInd = 0; optInd < optionSet.length; optInd++) {
			optionsDict[optionSet[optInd].innerHTML] = optionSet[optInd].value;
		}
		//console.log(optionsDict);

		var values = "";
		for(var resInd = 0; resInd < resultSet.length; resInd++) {
			values += optionsDict[resultSet[resInd].innerHTML] + ",";
		}
		values = values.slice(0, -1);
		//console.log(values);

		window.location.href = updateURLParameter(window.location.href, filterType, values);
	}

}

function updateURLParameter(url, param, paramVal){
    var newAdditionalURL = "";
    var tempArray = url.split("?");
    var baseURL = tempArray[0];
    var additionalURL = tempArray[1];
    var temp = "";
    if (additionalURL) {
        tempArray = additionalURL.split("&");
        for (var i=0; i<tempArray.length; i++){
            if(tempArray[i].split('=')[0] != param){
                newAdditionalURL += temp + tempArray[i];
                temp = "&";
            }
        }
    }

    var rows_txt = temp + "" + param + "=" + paramVal;
    return baseURL + "?" + newAdditionalURL + rows_txt;
}
