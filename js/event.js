function eventRegister(memberId, eventId) {
	data =  {
    	'name': 'insertEventRegister',
    	'memberId': memberId,
    	'eventId': eventId
    };

    $.post(
    	'ajax.php', 
    	data, 
    	function (response) {
	        if(response) {
	        	document.getElementById("eventRegisterBtnSuccess").style.display= 'block';
	        	document.getElementById("eventRegisterBtnFailure").style.display= 'none';
	        	document.getElementById("eventRegisterBtn").style.display= 'none';
	        }
	        else {
	        	document.getElementById("eventRegisterBtnSuccess").style.display= 'none';
	        	document.getElementById("eventRegisterBtnFailure").style.display= 'block';
	        }
    	}
    );

}

function initEventRegisterDisplays() {
	document.getElementById("eventRegisterBtnSuccess").style.display= 'block';
	document.getElementById("eventRegisterBtnFailure").style.display= 'none';
	document.getElementById("eventRegisterBtn").style.display= 'none';
}