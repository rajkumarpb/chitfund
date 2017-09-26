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
   $exp = '';
   $status = '';
?>
<!DOCTYPE html>
<html>
<head>
<title>வரவு</title>
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
  <br>
  <br><br><br><h1 align="center">உறுப்பினரின் ஏலத்தொகை வரவு</h1><br>
  <div class = "print-scroll">
  <table align = "center" width = "950" border = "7" cellpadding ="6" cellspacing="6">
   <tr align = "center">
     <th>உறுப்பினரின் பெயர் </th>
    <th>குரூப்பின் பெயர் </th>
    <th>சீட்டுத்தொகை</th>
    <th>ஏலத்தொகை</th>
    <th>தவணைகள்</th>
    <th>செலுத்திய தொகை</th>
    <th>செலுத்திய தேதி</th>
    <th> Status </th>
  </tr>

  <?php
  if(isset($_GET['exp']))
    $exp=$_GET['exp'];
   if($exp=='paid')
   {
     $id = $_GET['memberid'];
     $auctionid = $_GET['auctionid'];
     $name =$_GET['name'];
     $groupname = $_GET['groupname'];
     $groupid = $_GET['groupid'];
     $chitinstallno = $_GET['chitinstallno'];
     $chitamount = $_GET['chitamount'];
     date_default_timezone_set('Asia/Calcutta');
     $paiddt = date('y-m-d');
     $a = explode('-',$paiddt);
     $result = $a[2].'/'.$a[1].'/'.$a[0];
     $sql = mysql_query("update membergroupauction set status = 'Paid',paiddt = '$paiddt' where auctionid = $auctionid and memberid = $id");
     $s5 = mysql_query("select memberid,groupid from membergroup where memberid ='$id'and groupid = '$groupid'");
     while($row = mysql_fetch_assoc($s5))

        $id1 = $row['groupid'];
        $s0 = mysql_query("select groupid,chitamount,groupname from groupinfo where groupid = '$id1'");
        while($r = mysql_fetch_assoc($s0))
        {
          $s2 = mysql_query("select auctionid,chitinstallno,auctionamount,installamount from auction where groupid = '$id1' and chitinstallno = '$chitinstallno'");
          while($r1 = mysql_fetch_assoc($s2))
          {
            $auctionid = $r1['auctionid'];
            $s1 = mysql_query("update membergroupauction set payable = ".$r1['installamount'].",amountpaid =".$r1['installamount']."  where auctionid = $auctionid ");

          echo "<tr align='center'>
              <td>".$name."</td>
               <td>".$r['groupname']."</td>
               <td>".$r['chitamount']."</td>
               <td>".$r1['auctionamount']."</td>
               <td>".$r1['chitinstallno']."</td>
               <td>".$r1['installamount']."</td>
               <td>".$result."</td>
                <td>Paid</td>
               </tr>";

        }

    }
   }
   ?>
 </table>
 </div>

</body>
   </html>
