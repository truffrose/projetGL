<?php
	
	// manage all the error of the web site
	class Error {

		// the variables
		private $_fatal;
		private $_name;
		private $_description;

		// the constructor
		public function __construct() {
		    $nbArgs = func_num_args();
		    $args = func_get_args();
		    switch($nbArgs) {
		        case 3:
		            $this->construct3($args[0],$args[1],$args[2]);
		            break;
		        case 2:
		            $this->construct2($args[0],$args[1]);
		            break;
		         default:
		            break;
		    }
		}
	 	private function construct3($fatal, $name, $description) {
			$this->_fatal = $fatal;
			$this->_name = $name;
			$this->_description = $description;
		}
	 	private function construct2($name, $description) {
	 		$this->_fatal = true;
			$this->_name = $name;
			$this->_description = $description;
		}

		// the getter
		public function isFatal() {
			return $this->_fatal;
		}
		public function getName() {
			return $this->_name;
		}
		public function getDescription() {
			return $this->_description;
		}

		// return the formated message of the error (with out html format)
		public function getMessage() {
			$strRet = $this->_name . ' : ' . $this->_description;
			if ($this->_fatal) {
				$strRet = 'Fatal Error ' . $strRet;
			}
			else  {
				$strRet = 'Warning ' . $strRet;
			}
				deleteCurrentError();
			return $strRet;
		}
	}

	// return true if they are no error false in other case
	function isError() {
		if (!isset($_SESSION["error"])) {
			return true;
		}
		else {
			return false;
		}
	}

	// set the curent error
	function setCurrentError($error) {
		$_SESSION["error"] = $error;
	}

	// delete the current error of the system
	function deleteCurrentError() {
		unset($_SESSION["error"]);
	}

?>