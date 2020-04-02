<?php include('../controller.php');
islogin();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="ples.css">
    <title>Welcome Admin</title>
    <script>
function startTime() {
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  m = checkTime(m);
  s = checkTime(s);
  document.getElementById('time').innerHTML =
  h + ":" + m + ":" + s;
  var t = setTimeout(startTime, 500);
}
function checkTime(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}
</script>
  </head>
  <body onload="startTime()">
    <div class="container">
      <div id="low-header">
        <li><a href="admin.php?logout='1'">log-out</a></li>
      </div>
      <div id="header">
        <h1>Time Management</h1>
      </div>
      <div id="timedate">
          <li id="time"></li>
          <li> <?php echo date("d/m/Y"); ?></li>
        </div>
        <div class="status">
          <label for="status">Status:</label>
          <select class="average" name="average">
            <option value="perweek">Weekly</option>
            <option value="permonth">Monthly</option>
          </select>
          <br>
          <table>
            <tr>
              <td>AVG SLEEPING TIME:</td>
              <td><output name="avgsleepresult"></output> </td>
            </tr>
            <tr>
              <td>AVG WORKING TIME : </td>
              <td><output name="avgworkingresult"></output> </td>
            </tr>
            <tr>
              <td>AVG EATING TIME : </td>
              <td><output name="avgworkingresult"></output> </td>
            </tr>
            <tr>
              <td>AVG PLAYING TIME : </td>
              <td><output name="avgworkingresult"></output> </td>
            </tr>
          </table>
        </div>
        <div class="SetContainer">
          <form id="Timer" action="admin.php" method="post">
            <label>Set-Timer</label>
            <br>
              <button id="modalSleepbtn" class="modalSleepbtn">Sleeping Time</button>
              <div class="modalSleep" id="smodal">
                <div class="Smodal-content">
                  <span class="sclosebtn">&times;</span>
                  <p>Hello I'm modal</p>
                </div>
              </div>
          </form>
        </div>
    </div>
  </body>
</html>
