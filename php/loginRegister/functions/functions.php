<?php
/*================ Helper Function =============*/
function clean ($string){
  return htmlentities($string);
}
function redirect ($location){
     header("Location: {$location}");
}

function set_message($message){
    if(!empty($message)){
        $_SESSION['message'] = $message;
    }else{
      echo $message = "";
    }
}

function display_message(){
    if (isset($_SESSION['message'])){
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

function token_generator(){
    $token = $_SESSION['token'] = md5(uniqid(mt_rand(),true));
    return $token;
}

function email_exist($email){
    $sql = "SELECT id FROM users WHERE email='$email' ";
    $result = query($sql);
    if(row_count($result)==1){
        return true;
    }else{
        return false;
    }
}

function username_exist($username){
    $sql = "SELECT id FROM users WHERE email='$username' ";
    $result = query($sql);
    if(row_count($result)==1){
        return true;
    }else{
        return false;
    }
}
/*================ Validation Function =============*/

function validate_user_regs(){
    $errors = [];
    $min = 3;
    $max = 20;

    if ($_SERVER['REQUEST_METHOD'] == "POST"){

             $first_name =  clean($_POST['first_name']);
             $last_name  =  clean($_POST['last_name']);
             $username = clean($_POST['username']);
             $email = clean($_POST['email']);
             $password = clean($_POST['password']);
             $confirm_password = clean($_POST['confirm_password']);

             if (strlen($first_name) < $min){
                 $errors[] = "First Name Can Not Be Less Than {$min} Characters";
             }

             if (strlen($first_name) > $max){
                  $errors[] = "First Name Can Not Be More Than {$max} Characters";
             }

             if (strlen($last_name) < $min){
                  $errors[] = "Last Name Can Not Be Less Than {$min} Characters";
             }

             if (strlen($last_name) > $max){
                  $errors[] = "Last Name Can Not Be More Than {$max} Characters";
             }
        if (strlen($username) < $min){
            $errors[] = "Username Can Not Be Less Than {$min} Characters";
        }
        if($password !== $confirm_password ){
            $errors[] = "Password do not match";
        }
        if(email_exist($email)){
            $errors[] = "Email exist";
        }
        if(username_exist($username)){
            $errors[] = "Username already taken";
        }

             if (empty(!$errors)){
                 foreach ($errors as $error){
                   echo $error;
                 }
             }else{
                 if(register_user($first_name,$last_name,$username,$email,$password)){
                     set_message("<p class='btn btn-success'> Please Check Your Email For Registerd</p>");
                     redirect("index.php");
                 }
             }
    }
}

function register_user($first_name,$last_name,$username,$email,$password){
    $first_name = escape($first_name);
    $last_name = escape($last_name);
    $username = escape($username);
    $email = escape($email);
    $password = escape($password);


    if (email_exist($email)){
        return false;
    }elseif (username_exist($username)){
        return false;
    }else{
        $password = md5($password);
        $validation_code = md5($username);
        $sql = "INSERT INTO users(first_name, last_name, username, email, password, validation_code, active) VALUES ('$first_name','$last_name','$username','$email','$password','$validation_code',0)";
        $result = query($sql);
        confirm($result);
        return true;
    }


}





























































