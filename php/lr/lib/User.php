<?php 
 include_once 'Session.php';
 include 'Database.php';


 class User{
 	private $db;
 	public function __construct(){
 		$this->db = new Database();

 	}

 	public function userRegistration($data){
 		$name = $data['name'];
 		$username = $data['username'];
 		$email = $data['email'];
 		$password = $data['password'];

 		$check_email = $this->checkEmail($email);

 		if ($name == "" OR $username == "" OR $email == "" OR $password == "") {
 			$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Field Must Not Be Empty</div>";
 			return $msg; 		
 		}

 		if (strlen($username) < 3 ) {
 			$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Username is too short</div>";
 			return $msg; 		
 		}elseif (!preg_match("/^[a-z0-9_-]+/i",$username)) {
 			$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Username is Invalid</div>";
 			return $msg;
 		}

 		if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
 			$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Invalid Email</div>";
 			return $msg;
 		}

 		if ($check_email == true) {
 			$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Email Already Exist</div>";
 			return $msg;
 		}
 		if (strlen($password) < 8 ) {
 			$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Password is too short</div>";
 			return $msg; 		
 		}


        $password = md5($data['password']);

 		$sql = "INSERT INTO lr_table (name, username, email, password) VALUES (:name, :username, :email, :password)";
 		$query = $this->db->pdo->prepare($sql);
 		$query->bindValue(':name', $name);
 		$query->bindValue(':username', $username);
 		$query->bindValue(':email', $email);
 		$query->bindValue(':password', $password);
 		$result = $query->execute();

 		if ($result) {
 			$msg = "<div class='alert alert-success'><strong>Success ! </strong>You have been registered</div>";
 			return $msg;
 		}else{
 			$msg = "<div class='alert alert-danger'><strong>Error ! </strong>There have been problem for registeration</div>";
 			return $msg;
 		}

 	}

 	public function checkEmail($email){
 		$sql = "SELECT email FROM lr_table WHERE email = :email";
 		$query = $this->db->pdo->prepare($sql);
 		$query->bindValue(':email', $email);
 		$query->execute();
 		if ($query->rowCount() > 0) {
 			return true;
 		}else{
 			return false;
 		}
 	}

    public function getLogin($email, $password){
    	$sql = "SELECT * FROM lr_table WHERE email = :email AND password = :password LIMIT 1";
 		$query = $this->db->pdo->prepare($sql);
 		$query->bindValue(':email', $email);
 		$query->bindValue(':password', $password);
 		$query->execute();
 		$result = $query->fetch(PDO::FETCH_OBJ);
 		return $result;
    }

 	public function userLogin($data){
        $email = $data['email'];
 		$password = md5($data['password']);

 		$check_email = $this->checkEmail($email);

 		if ($email == "" OR $password == "") {
 			$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Field Must Not Be Empty</div>";
 			return $msg; 		
 		}

 		if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
 			$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Invalid Email</div>";
 			return $msg;
 		}

 		if ($check_email == false) {
 			$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Email Not Exist</div>";
 			return $msg;
 		}

 		$result = $this->getLogin($email, $password);

 		if ($result) {
 			Session::init();
 			Session::set("login", true);
 			Session::set("id", $result->id);
 			Session::set("name", $result->name);
 			Session::set("username", $result->username);
 			Session::set("loginmsg", "<div class='alert alert-success'><strong>Success ! </strong>You are logged in</div>");
 			header("Location:index.php");
 		}else{
 			$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Data Not Found</div>";
 			return $msg;
 		}

 	}

 	public function getUserData(){
 		$sql = "SELECT * FROM lr_table ORDER BY id DESC";
 		$query = $this->db->pdo->prepare($sql);
 		$query->execute();
 		$result = $query->fetchAll();
 		return $result;
 	}

 	public function getUserById($id){
 		$sql = "SELECT * FROM lr_table WHERE id = :id LIMIT 1";
 		$query = $this->db->pdo->prepare($sql);
 		$query->bindValue(':id', $id);
 		$query->execute();
 		$result = $query->fetch(PDO::FETCH_OBJ);
 		return $result;
 	}

 	public function userUpdate($id, $data){
        $name = $data['name'];
 		$username = $data['username'];
 		$email = $data['email'];

 		$check_email = $this->checkEmail($email);

 		if ($name == "" OR $username == "" OR $email == "") {
 			$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Field Must Not Be Empty</div>";
 			return $msg; 		
 		}

 		if (strlen($username) < 3 ) {
 			$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Username is too short</div>";
 			return $msg; 		
 		}elseif (!preg_match("/^[a-z0-9_-]+/i",$username)) {
 			$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Username is Invalid</div>";
 			return $msg;
 		}

 		if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
 			$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Invalid Email</div>";
 			return $msg;
 		}


 		$sql = "UPDATE lr_table SET name = :name, username = :username, email = :email WHERE id = :id";
 		$query = $this->db->pdo->prepare($sql);
 		$query->bindValue(':name', $name);
 		$query->bindValue(':username', $username);
 		$query->bindValue(':email', $email);
 		$query->bindValue(':id', $id);
 		$result = $query->execute();

 		if ($result) {
 			$msg = "<div class='alert alert-success'><strong>Success ! </strong>Update Sucessfully</div>";
 			return $msg;
 		}else{
 			$msg = "<div class='alert alert-danger'><strong>Error ! </strong>There have been problem for update</div>";
 			return $msg;
 		}


 	}

 	public function userDelete($id){
       

        $sql = "DELETE FROM lr_table WHERE id = :id";
 		$query = $this->db->pdo->prepare($sql);
 		$query->bindValue(':id', $id);
 		$result = $query->execute();
 		header("Location: index.php");

 		
 	}
    
    public function checkPassword($id, $oldpassword){
    	$password = md5($oldpassword);
        $sql = "SELECT * FROM lr_table WHERE id = :id AND password = :password";
 		$query = $this->db->pdo->prepare($sql);
 		$query->bindValue(':id', $id);
 		$query->bindValue(':password', $password);
 		$query->execute();
 		if ($query->rowCount() > 0) {
 			return true;
 		}else{
 			return false;
 		}
    }

 	public function changePassword($id, $data){
        $oldpassword = $data['oldpassword'];
        $newpassword = $data['newpassword'];
 		
        if ($newpassword == "" OR $oldpassword == "") {
 			$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Field Must Not Be Empty</div>";
 			return $msg; 		
 		}
 	

 	$chc_password = $this->checkPassword($id, $oldpassword);

 	if ($chc_password == false) {
 		$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Password not exist.</div>";
 			return $msg;
 	}

 	if (strlen($newpassword) < 8 ) {
 			$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Password is too short</div>";
 			return $msg; 		
 		}
       
        $password = md5($newpassword);

 	    $sql = "UPDATE lr_table SET password = :password WHERE id = :id";
 		$query = $this->db->pdo->prepare($sql);
 		$query->bindValue(':password', $password);
 		$query->bindValue(':id', $id);
 		$result = $query->execute();

 		if ($result) {
 			$msg = "<div class='alert alert-success'><strong>Success ! </strong>Password Changed Sucessfully</div>";
 			return $msg;
 			
 		}else{
 			$msg = "<div class='alert alert-danger'><strong>Error ! </strong>There have been problem for password changed </div>";
 			return $msg;
 		}
 	}
 }



 
 ?>