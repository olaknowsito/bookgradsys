<?php 
	Class QuarterRecord {
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
        
        public function isQuarterExist($user_id, $quarter, $year) {
            $query = mysqli_query($this->con, "SELECT * FROM `quarter_records` WHERE user_id = '$user_id' AND quarter = '$quarter' AND year = '$year'");
            return mysqli_num_rows($query);
        }
        
        public function addQuarter($user_id, $quarter, $year) {
            $query = mysqli_query($this->con, "INSERT INTO quarter_records (user_id, year, quarter) VALUES ('$user_id', '$year', '$quarter')");
            return mysqli_insert_id($this->con);
		}

		public function delQuarter($user_id, $quarter_num, $year) {
            $query = mysqli_query($this->con, "DELETE FROM `quarter_records` WHERE user_id='$user_id' AND quarter = '$quarter_num' AND year = '$year'");
            return;
		}
		public function getQuarterId($user_id, $quarter_num, $year) {
			$query = mysqli_query($this->con, "SELECT id FROM `quarter_records` WHERE user_id='$user_id' AND quarter = '$quarter_num' AND year = '$year'");
			$row = mysqli_fetch_array($query);
            return $row['id'];
		}
    }
?>