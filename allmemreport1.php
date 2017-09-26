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
<link href="main.css" rel="stylesheet" type="text/css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html"; charset="utf-8" />
</head>
<body>
  <div class="grid">
    <div style="clear: both">
      <h3 style="float:right"> <a href = "adminlogout.php" style="margin-left:10px">logout</a></h3>
      <h3 style="float:right" ><?php echo 'Welcome Admin : '.$_SESSION['username'];?></h3>

   </div>
    <div style="clear: both">
      <h1 style="float:right"> <a href = "adminmenu.php" style="margin-left:20px">Admin Home </a></h1>
      <h1 style="float:right"> <a href = "usermenu.php"> User Home</a><h1>
    </div>
    <br><br><br><h1 class="text" id="welcome"align = "center">அனைத்து உறுப்பினர்களின் அறிக்கை</h1><br><br>
    <form action ="allmemreport.php" method = "post" autocomplete="off">
    <fieldset style='width:auto;margin:auto;' class='members'>
      <legend>அறிக்கை</legend><br>
      <div class="row">
          <br><br><div><label for = "ownername" >தலைவரின்பெயர்</label>
            <label><select id = "owner" name = "ownername" style="font-size:15px;background: #68add8;  width:250px;
            height:40px;"><option>-----தலைவரின்பெயர்-----</option>
                <?php
                  $sql =mysql_query("select *from groupowner");
                  while($row = mysql_fetch_assoc($sql))
                  {
                ?>
                  <option name = "ownername" value = "<?php echo $row['responseid'];?>"><?php echo $row['responsename'];?></option>
                <?php } ?>
             </select>
             </div>
             <div><label for = "group" >குரூப்பின் பெயர்</label>
             <select id = "group" name = "group" style="font-size:15px;background: #68add8;  width:250px;
             height:40px;"><option>-----குரூப்பின் பெயர்-----</option>
             <?php
               $sql =mysql_query("select *from groupinfo");
               while($row = mysql_fetch_assoc($sql))
               {
             ?>
               <option name = "group" value = "<?php echo $row['groupid'];?>"><?php echo $row['symbolicname'];?></option>
             <?php } ?>
          </select>
          </div>
          <div><label for ="paid">Status</label>
          <label><select id = "paid" name = "paid" style="font-size:15px;background: #68add8;  width:250px;
          height:40px;"><option value = "all">All</option><option value = "paid">Paid</option><option value = "unpaid">UnPaid</option>
          </select></label></div>
             <div><p><input name="submit" type = "submit" value = "விவரங்கள்"></p></div>
            </div>
      </fieldset>
      </form>
  </div>
</body>
</html>
