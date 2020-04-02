
<?php include('controller.php') ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <style media="screen">
    body{
      font-family: Arial,Helvetica,sans-serif;
      background: #f1f1f1;
    }
      .register{
        margin-left: 50%;
      }
      table{
        border: solid 1px #f2dede; ;
        padding: 5px;
        margin-bottom: 10px;
        border-radius: 3px;
      }
      a{
        list-style: none;
        text-decoration: none;
        color: #000;
      }
      a:hover{
        color:Red;
      }
      .errors{
        width: 50%;
        margin-top:20px;
        margin-left: 25%;
        margin-right: 25%;
        padding: 10px;
        border: 1px solid #a94442;
        color: #a94442;
        background: #f2dede;
        border-radius: 5px;
        text-align: center;
      }
    </style>
  </head>
  <body>
    <div class="container">
        <form class="signin" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
            <table align="center">
                <tr>
                  <td>Username:</td>
                  <td><input type="text" name="username" placeholder="Enter your Username"> </td>
                </tr>
                <tr>
                  <td>Password:</td>
                  <td><input type="password" name="password" placeholder="Enter your Password"> </td>
                </tr>
                <tr style="margin-top:10px;">
                  <td><button type="submit" name="Login">Login</button> </td>
                </tr>
            </table>
          <div class="register">
            <label for="register"><a href="register.php">Register</a></label>
          </div><?php display_error(); ?>
        </form>
    </div>
  </body>
</html>
