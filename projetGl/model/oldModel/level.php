<?php

	// import the connect to DB
	// require_once('./settings.php');

	class Level {

		private $_id;
		private $_name;
		private $_title;
		private $_description;

		public function __construct($id, $name, $title, $description) {
			$this->_id = $id;
			$this->_name = $name;
			$this->_title = $title;
			$this->_description = $description;
		}

		// getters
		public function getId() {
			return $this->_id;
		}
		public function getName() {
			return $this->_name;
		}
		public function getTitle() {
			return $this->_title;
		}
		public function getDescription() {
			return $this->_description;
		}

	}

    // get a double array with the level (id + name)
    function getAllLevels() {
        if (connectMySql()) {
            $sql = 'SELECT id, name FROM level;';
            if ($_SESSION["link"]->multi_query($sql)) {
                do {
                    if ($result = $_SESSION["link"]->store_result()) {
                        while ($row = $result->fetch_row()) {
                            $arrReturn[$row[0]] = $row[1];
                        }
                        $result->free();
                    }
                } while (($_SESSION["link"]->more_results()) && ($_SESSION["link"]->next_result()));
                return $arrReturn;
            }
            else {
                setCurrentError(new Error("Level", "We are not connect to the DB"));
                return false;
            }
        }
        else {
            setCurrentError(new Error("Level", "We are not connect to the DB"));
            return false;
        }
    }

	// return an object level from is id
	function getLevel($id) {
		$sql = 'SELECT id, name, title, description FROM level where id = ' . $id . ';';
		if ($_SESSION["link"]->multi_query($sql)) {
			do {
				if ($result = $_SESSION["link"]->store_result()) {
					$row = $result->fetch_row();
					$retVal = new Level($row[0], $row[1], $row[2], $row[3]);
					$result->free();
					return $retVal;
				}
			} while (($_SESSION["link"]->more_results()) && ($_SESSION["link"]->next_result()));
			return $arrReturn;
		}
		else {
			setCurrentError(new Error("Level", "We are not connect to the DB"));
			return false;
		}
	}

?>
