<?php

/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */

class DB_Functions {

    private $conn;

    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $db = new Db_Connect();
        $this->conn = $db->connect();
		mysqli_set_charset($this->conn , "utf8");
    }

    // destructor
    function __destruct() {
        
    }

    /**
     * Storing new user
     * returns user details
     */
    public function storeUser($name,$lname,$email,$sex,$age,$password) {

        $stmt = $this->conn->prepare("INSERT INTO `consumer`(`fname`, `lname`, `email`, `sex`, `age`,`password`) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("ssssss", $name, $lname, $email, $sex, $age ,$password);
        $result = $stmt->execute();
        $stmt->close();

        // check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM `consumer` WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $user;
        } else {
            return false;
        }
    }

    /**
     * Get user by email and password
     */
    public function getUserByEmailAndPassword($email, $password) {

        $stmt = $this->conn->prepare("SELECT * FROM `consumer` WHERE email = ?");

        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

			$password_in_db = $user['password'];
            // check for password equality
            if ($password == $password_in_db) {
                // user authentication details are correct
                return $user;
            }
        } else {
            return NULL;
        }
    }

    /**
     * Check user is existed or not
     */
    public function isUserExisted($email) {
        $stmt = $this->conn->prepare("SELECT email from `consumer` WHERE email = ?");

        $stmt->bind_param("s", $email);

        $stmt->execute();

        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // user existed 
            $stmt->close();
            return true;
        } else {
            // user not existed
            $stmt->close();
            return false;
        }
    }

    /**
     * Encrypting password
     * @param password
     * returns salt and encrypted password
     */
	public function getDetailsUser($email){
		$stmt = $this->conn->prepare("SELECT * from `consumer` WHERE email = ?");
		$stmt->bind_param("s", $email);
		if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $user;

	}

}

	public function getbuffet($type_id){
		
	$sql= "SELECT p.title , p.rating , p.image , tb.type_id , tb.type_name FROM promotion p , type_buffet tb WHERE p.type_id = tb.type_id AND p.type_id = $type_id ORDER BY p.pro_id DESC ";

	$result = mysqli_query( $this->conn ,$sql);
	
	while ($row = mysqli_fetch_assoc($result)) {
		
		$array[] = $row;
	
		
	}
	return $array;
	
	
	
	}
}
?>
