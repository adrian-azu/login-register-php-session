<?php include('controller.php');
echo "Hello" ." ". $newuser . ".";
if (isset($_GET['log-out'])) {
  session_destroy();
  unset($_SESSION['user']);
  header("location: index.php");
}
if (empty($_SESSION['user'])){
  session_destroy();
  header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="container">
      <div class="header">
        <h1>USER INTERFACE</h1>
        <li><a href="welcome.php?log-out='1'">log-out</a></li>
        
        <input type="submit" name="edit" value="Change password">
      </div>
      <div class="low-header">

      </div>
    </div>



  </body>
</html>
