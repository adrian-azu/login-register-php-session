<?php
session_start();
include( "config.php");
global $servername;
global $username;
global $password;
global $dbname;
global $conn;
global $user;
global $errors=array();;
global $newuser,$fname,$lname,$pass1,$pass2,$msg;

global $msg="";
if($_SERVER["REQUEST_METHOD"] == "POST"){
  if (isset($_POST['Login'])) {
    login();
  }
}
function login(){
  global $servername;
  global $username;
  global $password;
  global $dbname;
  global $conn;
  global $errors,$user,$pass;
$id= $username= $password= $firstname=$roles= $lastname="";
  if (empty(trim($_POST['username']))) {
    array_push($errors,"Username is required!");
  }else{
      $user=trim($_POST['username']);
  }
  if (empty(trim($_POST['password']))) {
      array_push($errors,"Password is required!");
  }else{
      $pass=trim($_POST['password']);
  }
  if(strlen($user)>0 && strlen($pass)>0 && empty($errors)){
    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $param_username);
    $param_username = $user;
    if($stmt->execute()){
    $stmt->store_result();
    }
    if($stmt->num_rows == 1){
      $stmt->bind_result($id,$username,$password,$roles,$firstname,$lastname);
      $stmt->fetch();
      echo $username;
      echo "<br>";
      echo $stmt->bind_result($id,$username,$password,$roles,$firstname,$lastname);
      echo $password;
      echo "<br>";
      echo $pass;
      echo "<br>";
      echo md5($pass);
      $pass=md5($pass);
      if($pass===$password)
       {
         if($roles=='admin' || $roles=='Admin'){
           $_SESSION['user']=$user;
           $_SESSION['userid']=$id;
             header("location: admin/admin.php");
         }else{
           $_SESSION['user']=$user;
           $_SESSION['userid']=$id;
           $_SESSION['Username']=$username;
           echo $_SESSION['user'];
           header("location: welcome.php");
         }
         }else{
         array_push($errors,"Incorrect password");
       }
      }else{
      array_push($errors,"Account not found!");
    }
  }
}
function display_error(){
  global $errors;
  if(count($errors)>0){
    echo '<div class="errors">';
    foreach ($errors as $error) {
          echo $error . '<br>';
    }
    echo '</div>';
  }
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(isset($_POST['register'])){
    register();
  }
}

function register(){

if (empty(trim($_POST['firstname']))){
  array_push($errors,"First Name is required");
}else{
  $fname=trim($_POST['firstname']);
}
if (empty(trim($_POST['lastname']))){
  array_push($errors,"Last Name is required");
}else{
  $lname=trim($_POST['lastname']);
}
if (empty(trim($_POST['user']))){
  array_push($errors,"Username is required");
}else{
  $newuser=trim($_POST['user']);
}
if(!empty(trim($_POST['pass'])) && !empty(trim($_POST['confirmpass']))){
  $pass1=trim($_POST['pass']);
  $pass2=trim($_POST['confirmpass']);
  if($pass1!=$pass2){
    array_push($errors, "Password not match!");
    $match=false;
  }else {
    $match=true;
  }
}
else {
  array_push($errors, "Password is required");
}

if(empty($errors)){
  $sql_u = "SELECT * FROM users WHERE username='$newuser'";
  $res_u=$conn->query($sql_u);
  if ($res_u->num_rows > 0) {
    array_push($errors, "Username already taken");
  }else{
    $pass1=md5($pass1);
    $sql = "INSERT INTO users (username, password, firstname, lastname)
    VALUES ('$newuser', '$pass1', '$fname', '$lname')";
    if ($conn->query($sql) === TRUE) {
      $msg="successfully created!";
      $_SESSION['firstname']=$fname;
      $_SESSION['lastname']=$lname;
      $_SESSION['username']=$newuser;
      $_SESSION['passw']=$pass1;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
      $conn->close();
    }
  }
}
function islogin(){
  if (empty($_SESSION['user'])){
    session_destroy();
    unset($_SESSION['user']);
    header("location: ../index.php");
  }
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../index.php");
  echo $_SESSION['user'];
}
function fillin(){
  global $servername;
  global $username;
  global $password;
  global $dbname;
  global $conn;
  global $errors,$user,$pass;
  global $newuser,$fname,$lname,$pass1,$pass2,$msg;


}
?>
