<?php

	/*
		Get the value of the particular parameter from the current page's query string
	*/
	function getQueryStringValue($param) {
		$parts = parse_url($_SERVER['REQUEST_URI']);
        parse_str($parts['query'], $queryString);
        return $queryString[$param];
	}

	/*
		Convert to the form in which the database needs it
	*/
	function formatDate($date) {
		$dateObj = DateTime::createFromFormat('d/m/Y', $date);
		return $dateObj->format('Y-m-d');
	}

	/*
		Convert the date from string to a DateTime object
		Used to convert the date from the date-picker
	*/
	function getDatePickerDateTimeObject($date) {
		return DateTime::createFromFormat('d/m/Y', $date);
	}


	function getDatabaseDateTimeObject($date) {
		return DateTime::createFromFormat('Y-m-d', $date);
	}


	function getNextEventDate($startDate, $endDate, $days) {

	}


	function dateDisplayFormat($date) {
		return $date->format('M') . ' ' . $date->format('d') . ', ' . $date->format('Y');
	}


	function getDaysAsString($dayIndicesString) {
		$daysOfWeekMap = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
		$dayIndicesArray = explode(",", $dayIndicesString);

		$daysString = '';

		foreach($dayIndicesArray as $dayIndex) {
			if($dayIndex >= 0 && $dayIndex <= 6) {
				$daysString .= $daysOfWeekMap[$dayIndex] . ', ';
			}
		}
		return substr($daysString, 0, -2);
	}

?>