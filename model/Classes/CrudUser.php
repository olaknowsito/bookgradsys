<?php 
	Class CrudUser {
		private $con;
		private $list_of_students;
		private $points_history;

		public function __construct() {
			$timezone = date_default_timezone_set('Asia/Manila');
			$connection = new ConnectDb();
			$this->con = $connection->dbConnection();
			$this->list_of_students = mysqli_query($this->con, "SELECT * FROM users ORDER BY id DESC");
			// var_dump($this->list_of_employees);
		}

		public function getUsers() {
			// var_dump($this->list_of_students);
			$result = mysqli_fetch_assoc($this->list_of_students);
			if (!empty($result)){
				return $this->list_of_students;
			} else {
				return false;
			}
		}


	}

?>