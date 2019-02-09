<?php 

class Database{

	private $host ="localhost";
	// private $user = "id7878809_nafee_flight";
	// private $password ="08059506214";
	// private $name = "id7878809_nafee_flight";

	private $user = "root";
	private $password ="";
	private $name = "nafeeflight";
	private $conn;


	function __construct(){
		$this->conn = $this->connectDB();
	}

	function connectDB()	{
		$conn = mysqli_connect($this->host, $this->user, $this->password, $this->name);
		return $conn;
	}

	function recursive($rand){
		if ($rand = $db_rand) {
			return recursive($rand);
		}
	}

	function insertQuery($query){
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die('QUERY FAILED ' . mysqli_error($this->conn));
		}else{
			return $result;
		}
	}

	function insertQueryWithId($query){
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die('QUERY FAILED ' . mysqli_error($this->conn));
		}else{
			return mysqli_insert_id();
		}
	}

	function secureInput($data){
		$data = trim($data);
		$data = htmlspecialchars($data);
		$data = stripslashes($data);
		return $data;
	}

	function secureSQL($value){
		$value = mysqli_real_escape_string($this->conn, $value);
		return $value;
	}

	function selectQuery($query){
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("QUERY FAILED " . mysqli_error($this->conn));
		}else{
			return $result;
		}
	}
	
	function numRows($query){
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			die("QUERY FAILED " . mysqli_error($this->conn));
		}else{
			$rowcount = mysqli_num_rows($result);
			return $rowcount;
		}
	}	

	function protectPassword($password){
		$hash = "$2y$10$";
		$salt = "iwantthepasswordtobe22";
		$hash_salt = $hash . $salt;
		$password = crypt($password, $hash_salt);
		return $password;
	}

	function updatePassword($query){
		$result= mysqli_query($this->conn, $query);
		if (!$result) {
			die("QUERY FAILED " . mysqli_error($this->conn));
		}else{
			return $result;
		}
	}

	function updateQuery($query){
		$result= mysqli_query($this->conn, $query);
		if (!$result) {
			die("QUERY FAILED " . mysqli_error($this->conn));
		}else{
			return $result;
		}
	}

	function changePassword($query){
		$result= mysqli_query($this->conn, $query);
		if (!$result) {
			die("QUERY FAILED " . mysqli_error($this->conn));
		}else{
			return $result;
		}
	}

}
/*end of class database*/


 ?>