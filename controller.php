<?php
session_start(); //start session for the user
include( "config.php"); //include database connection
$update=false;
$errors=array();
$user="";
$pass="";
$newuser="";
$fname= $lname= $pass1= $pass2="";
$msg="";
$roles="";
$id=0;


if($_SERVER["REQUEST_METHOD"] == "POST"){ //check if request is POST method
  if (isset($_POST['Login'])) { //Check if POST login is triggered
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
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $param_username);
    $param_username = $user;
    if($stmt->execute()){ //if successfully executed
    $stmt->store_result();
    }
    if($stmt->num_rows == 1){
      $stmt->bind_result($id,$username,$password,$roles,$firstname,$lastname);
      $stmt->fetch();
      $pass=md5($pass);
      if($pass===$password)
       {
         session_start(); //start session for the user
         if($roles=='admin' || $roles=='Admin'){
           $_SESSION['user']=$user; //store username and id to session
           $_SESSION['userid']=$id;
             header("location: admin/admin.php");
         }else{
           session_start(); //start session for the user
           $_SESSION['user']=$user;
           $_SESSION['userid']=$id;
           $_SESSION['Username']=$username;
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
  global $servername;
  global $username;
  global $password;
  global $dbname;
  global $conn;
  global $user, $errors;
  global $newuser,$fname,$lname,$pass1,$pass2,$msg;
  $roles="user";
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
    $sql = "INSERT INTO users (roles,username, password, firstname, lastname)
    VALUES ('$roles','$newuser', '$pass1', '$fname', '$lname')";
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
    session_destroy(); //Remove session
    unset($_SESSION['user']); //Delete user session
    header("location: ../index.php");
  }
}
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../index.php");
  echo $_SESSION['user'];
}
if(isset($_GET['delete'])){
$id=$_GET['delete'];
  $conn->query("DELETE FROM users WHERE id=$id")or die($conn->error());
  $_SESSION['message']="User Deleted";
  $_SESSION['msg_type']="danger";
}

if(isset($_GET['edit']) && !empty($_GET['edit'])){
  $update=true;
  $sql="SELECT * FROM users WHERE id=?";
  if ($stmt=$conn->prepare($sql)) {

    $stmt->bind_param("i",$param_id);
    $param_id=$_GET["edit"];
      if($stmt->execute()){

        $result=$stmt->get_result();
        if ($result->num_rows==1) {

          $row = $result->fetch_array(MYSQLI_ASSOC);
          $fname=$row['firstname'];
          $lname=$row['lastname'];
          $user=$row['username'];
          $roles=$row['firstname'];
        }else{
          array_push($errors, $stmt->error());
          exit();
        }
      }
      else {

        array_push($errors, "Something went wrong" . $stmt->error());
      }
    }else{

    array_push($errors, $conn->error());
    $stmt->close();
    $conn->close();
  }
}

if(isset($_POST['update']))
{
  $fname=$_POST['firstname'];
  $lname=$_POST['lastname'];
  $roles=$_POST['roles'];
  $user=$_POST['user'];
  $pass=$_POST['password'];
  $pass1=$_POST['new-pass'];
  $pass2=$_POST['confirmpass'];
  $pass=md5($pass);
  $sql_u="SELECT * FROM users WHERE id=?";
  $stmt = $conn->prepare($sql_u);
  $stmt->bind_param("i", $param_id);
  $param_id=$id;
  if($stmt->execute()){
    $stmt->store_result();
  }if($stmt->num_rows == 1){
    $stmt->bind_result($id,$username,$password,$roles,$firstname,$lastname);
    $stmt->fetch();
    $pass=md5($pass);
    if($pass===$password)
    {
      if($pass1==$pass2){
        $pass=md5($pass1);
        $sql = "UPDATE users SET firstname=$fname, lastname=$lname, roles=$roles,password=$pass WHERE username=?";
        $stmt = $conn->prepare($sql);
        $conn->query($sql);
      }
      else{
        array_push($errors, "New Password not match");
      }
    }else{
      array_push($errors, "Incorrect Password");
    }
  }
}
?>
