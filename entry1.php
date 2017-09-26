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
   $exp ='';
?>
<!DOCTYPE html>
<html>
<head>
<title>தவணைப்பதிவு</title>
<link href="main.css" rel="stylesheet" type="text/css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html"; charset="utf-8" />
</head>
<body>
  <div class="grid">

      <div style="clear: both">
        <h3 style="float:right"> <a href = "adminlogout.php" style="margin-left:10px">logout</a></h3>
        <h3 style="float:right" ><?php echo 'Welcome Admin : '.$_SESSION['username'];?></h3>
        <h1 style="float:left"><a href = "entry11.php">Back</a></h1>
     </div>
      <div style="clear: both">
        <h1 style="float:right"> <a href = "adminmenu.php" style="margin-left:20px">Admin Home </a></h1>
        <h1 style="float:right"> <a href = "usermenu.php"> User Home</a><h1>
      </div>

  <br><br><br>
  <h1 align="center"> உறுப்பினரின் ஏலத்தவணை விவரங்கள்</h1><br>
  <div class = "print-scroll1">
  <table align = "center" width = "900" border = "7" cellpadding ="6" cellspacing="6">
   <tr align = "center">
     <th>உறுப்பினரின் பெயர்</th>
    <th>குரூப்பின் பெயர்</th>
    <th>சீட்டுத்தொகை</th>
    <th>செயல்</th>
  </tr>
  <?php
  if(isset($_GET['exp']))
    $exp=$_GET['exp'];
   if($exp=='list')
   {
     $name =$_GET['name'];
     $id = $_GET['memberid'];
      $s5 = mysql_query("select groupid from membergroup where memberid ='$id'");
      while($row = mysql_fetch_assoc($s5))
      {
         $id1 = $row['groupid'];
         $s0 = mysql_query("select groupid,chitamount,symbolicname from groupinfo where groupid = '$id1'");
         while($r = mysql_fetch_assoc($s0))
         {
           echo "<tr align='center'>
               <td>".$name."</td>
                <td>".$r['symbolicname']."</td>
                <td>".$r['chitamount']."</td>
                <td align = 'center'>
                  <a href='entry2.php?exp=detail&memberid=".$id."&name=".$name."&groupid=".$r['groupid']."&groupname=".$r['symbolicname']."&chitamount=".$r['chitamount']."'>விவரங்கள்</a>
                </td>
             </tr>";
          }
      }
  }
 ?>
  </table>
</div>

</div>
</body>
</html>
