<?php
session_start();
if (isset($_SESSION['username']))
{

}
else {
   ?>
  <!DOCTYPE html>
 <html>
 <head>
     <link rel="stylesheet" href="main2.css">
     <link href="css/lato.css" rel="stylesheet">
     <title>Menu</title>
     <link href="main1.css" rel="stylesheet" type="text/css">
     <META HTTP-EQUIV="Content-Type" CONTENT="text/html"; charset="utf-8" />
   </head>
   <body>
     <div class="grid"><br><br><br><br><br><br><br><br><br><br>
  <?php  echo 'லாகின் பெயர் மற்றும் பாஸ்வோர்ட் கொடுத்தால் மட்டுமே உங்களால் இந்த பக்கத்தை பார்க்க முடியும்';
  echo '<a href="adminlogin.php"> login First</a>';
  die();
}
   mysql_connect('localhost','root','jaiyog');
   mysql_select_db('chitfund');
?>
<!DOCTYPE html>
<html>
<head>
<title>அறிக்கை</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="main.css" rel="stylesheet" type="text/css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html"; charset="utf-8" />
</head>
<script type = "text/javascript" src = "js/jquery.min.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="css/datepicker.css">
<script>
$(document).ready(function () {
     $('#auctiondt').datepicker({
     format: "dd/mm/yyyy"
   });
 });
$(document).ready(function () {
  $('#auctiondt1').datepicker({
  format: "dd/mm/yyyy"
  });
  });
</script>
<body>
  <div class="grid">
    <div style="clear: both">
      <h3 style="float:right"> <a href = "adminlogout.php" style="margin-left:10px">logout</a></h3>
      <h3 style="float:right" ><?php echo 'Welcome Admin : '.$_SESSION['username'];?></h3>

   </div>
    <div style="clear: both">
      <h1 style="float:right"> <a href = "adminmenu.php" style="margin-left:20px">Admin Home </a></h1>
      <h1 style="float:right"> <a href = "usermenu.php"> User Home</a><h1>

    </div><br>
    <br><h1 class="text" id="welcome"align = "center">தேதி வாரி பணவரவு அறிக்கை</h1><br>
    <form action ="transaction1.php" method = "post" autocomplete="off">
    <fieldset style='width:auto;margin:auto;' class='members'>
      <legend>அறிக்கை</legend><br>
      <div class="row">
        <div><label for = "auctiondt" >பணவரவுதேதிFrom(DD/MM/YYYY)</label><input id = "auctiondt" name = "auctiondt" type ="text"></div>
        <div><label for = "auctiondt1">பணவரவுதேதிTo(DD/MM/YYYY)</label><input id = "auctiondt1" name = "auctiondt1" type ="text"></div>
      </div>
      <div align ="right"><p><input name="submit" type = "submit" value = "அறிக்கை"></p></div>
    </fieldset>
  </form>
</div>
</body>
</html>
