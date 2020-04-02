<?php include('controller.php') ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Register</title>
    <style media="screen">
      body{
        color: 555;
        font-family: Arial,Helvetica,sans-serif;
        height: 100%;
        background: linear-gradient(to bottom, #00ccff 22%, #ff3399 94%)
      }
      .container{
        width: 60%;
        margin: auto;
        overflow: hidden;
      }
      #register-form{
        margin-top: 5em;
        margin-left: 30%;
        width: 40%;
        text-align: center;
        background: grey;
        color:#fff;
        border: 1px solid grey;
        border-radius: 7px;
      }
      #information{
        margin-left: 5px;
        text-align:justify;
          margin: 5px;
        font-size: 17px;
      }
      #information label{
        padding-left: 50px;
      }
      #information input{
        float: right;
      }
      #information select{
        margin-left: 29px;
        font-size: 17px;
      }
      #register{
        margin-top: 10px;
        background: #ff7f50;
        font-size: 17px;
        padding-left: 10px;
        padding-right: 10px;
        border-style: solid;
        font-weight: 400;
      }
      #register:hover{
        background: grey;
        color: white;
      }
      input[name=age]{
        margin-right: 129px;
        width: 3em;
      }
      .back{
        margin: 10px;
        float: none;

      }
      .back a{
        color: black;
        text-decoration: none;
      }
      .back a:hover{
        color: Red;
        text-decoration: none;
      }
      #register-form h1{
        background: #ff7f50;
        margin: 0;
        width: 100%;
        margin-bottom: 10px;
        margin-top: 10px;
        line-height: 1.6em;
      }

      .accountinfo{
        margin-top: 5px;
        margin-right: 10px;
        padding-right: 8px;
        float:  right;
      }
      .accountinfo input{
        width: 155px;
      }
      #info{
        font-size: 20px;
        float: left;
        background: #ddd;
        color: black;
        line-height: 1.5em;
        width: 100%;
        margin: 0;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div id="register-form">
          <h1>REGISTER</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <div id="information">
            <label for="information">First Name:</label>
            <input type="text" name="firstname">
          </div>
          <div id="information">
            <label for="information">Last Name:</label>
            <input type="text" name="lastname">
          </div>
          <div class="account">
          <label for="account" id="info">ACCOUNT INFO</label>
            <div id="user" class="accountinfo">
              <label for="account">Username:</label>
              <input type="text" name="user">
            </div>
          <div id="pass" class="accountinfo">
            <label for="account">Password:</label>
            <input type="password" name="pass">
          </div>
          <div id="confirmpass" class="accountinfo">
            <label for="account">Confirm Password:</label>
            <input type="password" name="confirmpass">
          </div>
          </div>
          <button id="register" type="submit" name="register" onsubmit="return false">Register</button>
        </form><?php display_error();
        echo $msg; ?>
        <div class="back">
          <a href="index.php">Back to Login</a>
        </div>
      </div>
    </div>
  </body>
</html>
