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
    <h3><br><?php echo 'Welcome User/Admin : '.$_SESSION['username'];?>
    <br><br><a href = "adminlogout.php">Click here to logout</a></h3>
    <h1 align ="right"><a href = "adminmenu.php">Admin Home</a><br>
      <a href = "usermenu.php">User Home</a></h1>
    <h1 class="text" id="welcome"align = "center">தவணைத்தொகைக் கட்டாதவர்களின் அறிக்கை</h1><br><br>
    <form action ="reportall1.php" method = "post" autocomplete="off">
    <fieldset style='width:auto;margin:auto;' class='members'>
      <legend>அறிக்கை</legend><br>
      <div class="row">
          <br><br><div><label for = "ownername" >தலைவரின் பெயர்</label>
            <label><select id = "owner" name = "ownername" style="font-size:15px;background: #68add8;  width:250px;
            height:40px;"><option>-----தலைவரின் பெயர்-----</option>
                <?php
                  $sql =mysql_query("select *from groupowner");
                  while($row = mysql_fetch_assoc($sql))
                  {
                ?>
                  <option name = "ownername" value = "<?php echo $row['responseid'];?>"><?php echo $row['responsename'];?></option>
                <?php } ?>
             </select>
             </div>
               <div><p><input name="submit" type = "submit" value = "விவரங்கள்"></p></div>
            </div>
      </fieldset>
      </form>
  </div>
  <div>
</body>
</html>
