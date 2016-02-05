<?php

	// import the connect to DB
	// require_once('./settings.php');

	class User {

		private $_pseudo;
		private $_pseudoCrypt;
		private $_password;

		public function __construct($pseudo, $password) {
			$this->_pseudo = $pseudo;
			$this->_password = $password;
		}

		// getters
		public function getPseudo() {
			return $this->_pseudo;
		}
		public function getPseudoCrypt() {
			return $this->_pseudoCrypt;
		}

		// connect the user to the DB (and check the pseudo and password and the mysql db)
		public function connection() {
			if (connectMySql()) {
				$sql = 'SELECT md5(pseudo) as pseudo FROM user where pseudo = \'' . $this->_pseudo . '\' and password = md5(\'' . $this->_password . '\');';

				$source = $_SESSION["link"]->query($sql);

				if ($result = $source->fetch_assoc()) {
					$this->_pseudoCrypt = $result["pseudo"];
					$_SESSION["user"] = $this;
				}
			    else {
					setCurrentError(new Error("Login", "The couple account / password is unknown"));
					return false;
			    }
			}
			else {
				setCurrentError(new Error("Connection", "We are not connect to the DB"));
				return false;
			}
		}

		// disconnect the user to the website (erase the session user)
		public function disconnect() {
			if (isset($_SESSION["user"])) {
				unset($_SESSION["user"]);
				return true;
			}
			else {
				return false;
			}
		}

		// create a new user with the
		public function createUser() {
			if (connectMySql()) {
				$sql = 'INSERT INTO user (pseudo, password) values (\'' . $this->_pseudo . '\', md5(\'' . $this->_password . '\'));';
				$_SESSION["link"]->query($sql);
			}
			else {
				setCurrentError(new Error("Connection", "We are not connect to the DB"));
				return false;
			}
		}
	}

	// check is the user is connect or not and return the result
	function connectUser() {
		if (isset($_SESSION["user"])) {
			return true;
		}
		else {
			return false;
		}
	}

?>
