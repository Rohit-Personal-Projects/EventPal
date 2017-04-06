<?php

	class Member {
		var $MemberId;
		var $FirstName;
		var $LastName;
		var $EMail;
		var $Phone;
		var $Bio;
		var $FacebookUrl;
		var $TwitterUrl;
		var $Password;

		var $Address;

		

		public function __construct($MemberId, $FirstName, $LastName, $EMail, $Phone, $Bio, $FacebookUrl, $TwitterUrl, $Password, $Street, $City, $Zip, $State, $Country) {
			$this->MemberId=$MemberId;
			$this->FirstName=$FirstName;
			$this->LastName=$LastName;
			$this->EMail=$EMail;
			$this->Phone=$Phone;
			$this->Bio=$Bio;
			$this->FacebookUrl=$FacebookUrl;
			$this->TwitterUrl=$TwitterUrl;
			$this->Password=$Password;
			$this->Address = new Location($Street, $City, $Zip, $State, $Country);
		}

		public static function Basic($MemberId, $FirstName, $LastName) {
			$instance = new self();
			$instance->MemberId=$MemberId;
			$instance->FirstName=$FirstName;
			$instance->LastName=$LastName;
			return $instance;
		}

	}

?>

