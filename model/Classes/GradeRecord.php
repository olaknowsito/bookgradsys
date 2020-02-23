<?php 
	Class GradeRecord {
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

        public function addGrade($user_id, $quarter_id, $grade, $grade_category) {
            $query = mysqli_query($this->con, "INSERT INTO grade_records (user_id, qr_id, grade, grade_category) VALUES ('$user_id', '$quarter_id', '$grade', '$grade_category')");
			return mysqli_insert_id($this->con);
		}
    }
?>