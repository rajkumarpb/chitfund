<?php
 session_start();
 if (isset($_SESSION['username']) && ($_SESSION['id']))
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
  <?php echo 'நீங்கள் அட்மின்னாக இருந்தால் லாகின் பெயர் மற்றும் பாஸ்வோர்ட் கொடுத்தால் மட்டுமே உங்களால் இந்த பக்கத்தை பார்க்க முடியும்';
  echo '<a href="adminlogin.php"> login First</a>';
   ?><br><br><br><br>
  <?php echo 'நீங்கள் user ஆக இருந்தால் இந்த பக்கத்தை பார்க்க முடியாது';
   echo '<a href="adminlogin.php"> login First</a>';
   die();
 }

 ?>
 <!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="main2.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <title>Menu</title>
    <META HTTP-EQUIV="Content-Type" CONTENT="text/html"; charset="utf-8" />
  </head>
  <body>
    <div class="grid">
      <div style="clear: both">
        <h3 style="float:right"> <a href = "adminlogout.php" style="margin-left:10px">logout</a></h3>
        <h3 style="float:right" ><?php echo 'Welcome Admin : '.$_SESSION['username'];?></h3>
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
             <image src ="images/preview.jpg"width = 180 height = 180>
            <p><h4><a href = "auctioninfo.php">ஏலப்பதிவு</a></h4></p>
        </div>
        <div class="col-3">
          <image src ="images/pc_user_icon_by_ornorm-d4winao.png" width = 180 height = 180>
          <p><h4><a href = "entry11.php">உறுப்பினர்களின் ஏலத்தவணை பதிவு  </a></h4> </p>
       </div>
        <div class="col-3">
          <image src ="images/edit_male_user_98373.jpg"width = 180 height = 180>
          <p><h4><a href = "userregister.php">கணக்காளர் விவரம்(சேர்க்கை)</a></h4></p>
        </div>
        <div class="col-3">
         <image src ="images/user-icon-512.png"width = 180 height = 180>
         <p><h4><a href = "responsibility.php">குரூப் தலைவர் விவரங்கள்</a></h4></p>
        </div>
      </div>
      <div class="row" align = "center">
      <div class="col-3">
        <image src ="images/18c6a5a73518c26ed46c1c488acdc5c1.jpg"width = 180 height = 180>
        <p><h4><a href = "groupinfo.php">புதிய குரூப் சேர்ப்பு</a></h4></p>
      </div>
        <div class="col-3">
           <image src ="images/user-group-icon.png"width = 180 height = 180>
           <p><h4><a href = "memberinfo.php">உறுப்பினர்கள் சேர்ப்பு</a></h4></p>
         </div>
         <div class="col-3">
             <image src ="images/HiRes_0.jpg"width = 180 height = 180>
             <p><h4><a href = "linkmembergroup1.php">உறுப்பினரையும் குரூப்பையும் இணைத்தல்</a></h4></p>
         </div>
         <div class="col-3">
           <image src ="images/download.jpg" width = 180 height = 180>
           <p><h4><a href = "reportsmenu.php">அறிக்கை</a></h4> </p>
        </div>
    </div>

</div>
</body>
</html>
