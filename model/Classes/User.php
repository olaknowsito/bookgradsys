<?php 
	Class User {
		private $con;
		private $list_of_users;
		private $points_history;

		public function __construct() {
			$timezone = date_default_timezone_set('Asia/Manila');
			$connection = new ConnectDb();
			$this->con = $connection->dbConnection();
			$this->list_of_students = mysqli_query($this->con, "SELECT * FROM users ORDER BY user_id DESC");
			// $this->points_history = mysqli_query($this->con, "SELECT * FROM points_history ORDER BY points_id DESC");
			// var_dump($this->list_of_employees);
        }

        public function isUserExist($name) {
			$query = mysqli_query($this->con, "SELECT * FROM `users` WHERE full_name = '$name'");
            return mysqli_num_rows($query);
		}

		public function addUser($name) {
			$query = mysqli_query($this->con, "INSERT INTO users (full_name) VALUES ('$name')");
			return mysqli_insert_id($this->con);
		}

		public function getUserId($name) {
			$query = mysqli_query($this->con, "SELECT id FROM `users` WHERE full_name = '$name'");
			$row = mysqli_fetch_array($query);
            return $row['id'];
		
			
		}
    }
?>