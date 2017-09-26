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
     <div style="clear: both">
       <h3 style="float:right"> <a href = "adminlogout.php" style="margin-left:10px">logout</a></h3>
       <h3 style="float:right" ><?php echo 'Welcome Admin : '.$_SESSION['username'];?></h3>
       <h3 style="float:left"> <a href = "adminmenu.php" style="margin-left:20px">Admin Home </a></h3>
       <h3 style="float:left"> <a href = "usermenu.php" style="margin-left:20px"> User Home</a><h3>
    </div>

     <div class="row">
       <div class="col-6"><img src="images/Chit-Fund.jpg" width = 140 height = 140></div>
       <div class="col-6" style ="text-align:left;">
         <h1>ஆதிபராசக்தி ஏழாயிரம்பண்ணை நாடார்</h1>
         <h2>பாத்தியப்பட்ட சிட் பண்டு</h2>
       </div>
     </div>
     <div class="row" align = "center">
       <div class="col-3">
          <image src ="images/Logistics.png" width = 180 height = 180>
          <p><h4><a href = "allmemreport1.php">அனைத்து உறுப்பினர்களின் அறிக்கை</a></h4></p>
        </div>
        <div class="col-3">
            <image src ="images/download (1).jpg"width = 180 height = 180>
            <p><h4><a href = "singlepersonreport.php">தனி நபரின் அறிக்கை</a></h4></p>
        </div>
        <div class="col-3">
          <image src ="images/images (1).jpg" width = 180 height = 180>
          <p><h4><a href = "transaction.php">தேதி வாரி பணவரவு அறிக்கை</a></h4></p>
        </div>
        <div class="col-3">
          <image src ="images/images.png" width = 180 height = 180>
          <p><h4><a href = "groupwiseMemeberList.php">உறுப்பினரின் குரூப் லிஸ்ட்</a></h4></p>
        </div>
     </div>
   <div class="row" align = "center">
      <div class="col-4">
        <image src ="images/images.jpg" width = 180 height = 180>
        <p><h4><a href = "edit.php">மாற்றங்கள்(Paid ----> Unpaid)</a></h4></p>
      </div>
      <div class="col-4">
         <image src ="images/images1.jpg" width = 180 height = 180>
         <p><h4><a href = "print.php">அனைத்து உறுப்பினர்களின் ரசீது அச்சு</a></h4></p>
       </div>
       <div class="col-4">
         <image src ="images/virtual-printer-logo.jpg" width = 180 height = 180>
         <p><h4><a href = "printsingle.php">தனி நபரின் ரசீது அச்சு</a></h4></p>
       </div>
  </div>
  </div>

 </body>
 </html>
