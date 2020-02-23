<?php 
	Class ConnectDb {
		private $con;

		public function dbConnection() {
			$this->con = mysqli_connect("localhost", "homestead", "secret", "edukasyon");
			return $this->con;
		}
	}

?>