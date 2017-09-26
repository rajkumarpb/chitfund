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
   <link rel="stylesheet" href="main2.css">
   <link href="css/lato.css" rel="stylesheet">
   <title>Menu</title>
   <META HTTP-EQUIV="Content-Type" CONTENT="text/html"; charset="utf-8" />
 </head>
 <body>
   <div class="grid">
     <h3><?php echo 'Welcome User : '.$_SESSION['username'];?>
     <br><br><a href = "adminlogout.php">Click here to logout</a></h3>
     <div class="row">
       <div class="col-6"><img src="images/Chit-Fund.jpg" width = 140 height = 140></div>
       <div class="col-6" style ="text-align:left;">
         <h1>ஆதிபராசக்தி ஏழாயிரம்பண்ணை நாடார்</h1>
         <h2>பாத்தியப்பட்ட சிட் பண்டு</h2>
       </div>
     </div>
     <div class="row" align = "center">
       <div class="col-4">
            <image src ="images/preview.jpg"width = 180 height = 180>
           <p><h4><a href = "auctioninfo.php">ஏலப்பதிவு</a></h4></p>
       </div>
       <div class="col-4">
         <image src ="images/pc_user_icon_by_ornorm-d4winao.png" width = 180 height = 180>
         <p><h4><a href = "entry.php">உறுப்பினர்களின் ஏலத்தவணை பதிவு  </a></h4> </p>
      </div>
      <div class="col-4">
        <image src ="images/download.jpg" width = 180 height = 180>
        <p><h4><a href = "reportsmenu.php">அறிக்கை</a></h4> </p>
     </div>
   </div>
 </div>
 </body>
 </html>
