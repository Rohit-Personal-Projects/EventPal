<?php

	function getQueryStringValue($param) {
		$parts = parse_url($_SERVER['REQUEST_URI']);
        parse_str($parts['query'], $queryString);
        return $queryString[$param];
	}

?>