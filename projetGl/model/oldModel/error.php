<?php
	
	// manage all the Information of the web site
	class Information {

		// the variables
		private $_error;
		private $_name;
		private $_description;

		// the constructor
		public function __construct() {
		    $nbArgs = func_num_args();
		    $args = func_get_args();
		    switch($nbArgs) {
		        case 3:
		            $this->constructor3Args($args[0],$args[1],$args[2]);
		            break;
		        case 2:
		            $this->constructor2Args($args[0],$args[1]);
		            break;
		         default:
		            break;
		    }
		}
	 	private function constructor3Args($error, $name, $description) {
			$this->_error = $error;
			$this->_name = $name;
			$this->_description = $description;
		}
	 	private function constructor2Args($name, $description) {
	 		$this->_error = false;
			$this->_name = $name;
			$this->_description = $description;
		}

		// the getter
		public function isError() {
			return $this->_error;
		}

		// return the formated message of the information (with out html format)
		public function getMessage() {
			$strRet = $this->_name . ' : ' . $this->_description;
			if ($this->_error) {
				$strRet = 'Error ' . $strRet;
			}
			else  {
				$strRet = 'Information ' . $strRet;
			}
				deleteCurrentError();
			return $strRet;
		}
	}

	// return true if they are no information false in other case
	function isInformation() {
		if (!isset($_SESSION["information"])) {
			return true;
		}
		else {
			return false;
		}
	}

	// set the curent information
	function setCurrentInformation($information) {
		$_SESSION["information"] = $information;
	}

	// delete the current information of the system
	function deleteCurrentInformation() {
		unset($_SESSION["information"]);
	}

?>