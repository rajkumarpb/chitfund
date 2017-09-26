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
   $msg ='';
?>
<!DOCTYPE html>
<html>
<head>
<title>தவணைப்பதிவு</title>
<link href="main.css" rel="stylesheet" type="text/css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html"; charset="utf-8" />
<script type='text/javascript'>
    function myFunction() {
        alert("Amount Paid");
        return true;
    }
</script>
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
  <h1 align="center"> உறுப்பினரின் ஏலத்தொகை பதிவு</h1><br>
  <div class = "print-scroll">
  <table align = "center" width = "950" border = "7" cellpadding ="6" cellspacing="6">
   <tr align = "center">
     <th>உறுப்பினரின் பெயர் </th>
    <th>குரூப்பின் பெயர் </th>
    <th>சீட்டுத்தொகை</th>
    <th>ஏலத்தொகை</th>
    <th>கமிசன்</th>
    <th>தள்ளு</th>
    <th>தவணைகள்</th>
    <th>செலுத்த வேண்டியத்தொகை</th>
    <th>பணவரவு</th>
  </tr>
  <?php
  if(isset($_GET['exp']))
    $exp=$_GET['exp'];
   if($exp=='detail')
   {
     $name =$_GET['name'];
     $groupname = $_GET['groupname'];
     $groupid = $_GET['groupid'];
     $chitamount = $_GET['chitamount'];
     $id = $_GET['memberid'];
     $s0 = mysql_query("select groupid,chitamount,groupname from groupinfo where groupid = '$groupid'");
     while($r = mysql_fetch_assoc($s0))
      {
          $s2 = mysql_query("select groupid,auctionid,chitinstallno,auctionamount,commission,discount,installamount from auction where groupid = '$groupid' and (auctionamount <> 'Null' or auctionamount = 0)");
          while($r1 = mysql_fetch_assoc($s2))
          {
            $chitinstallno = $r1['chitinstallno'];
            $auctionid = $r1['auctionid'];
            $gid = $r1['groupid'];
            $sq = mysql_query("select *from membergroupauction where auctionid = '$auctionid' and groupid = $gid and memberid = $id and chitinstallno = '$chitinstallno' and (status is null or status = 'Unpaid')");
            while($rw = mysql_fetch_assoc($sq))
             echo "<tr align='center'>
              <td>".$name."</td>
               <td>".$r['groupname']."</td>
               <td>".$r['chitamount']."</td>
               <td>".$r1['auctionamount']."</td>
               <td>".$r1['commission']."</td>
               <td>".$r1['discount']."</td>
               <td>".$r1['chitinstallno']."</td>
               <td>".$r1['installamount']."</td>

              <td align = 'center' onclick ='myFunction();'>
                 <a href='receive.php?exp=paid&auctionid=$auctionid&memberid=$id&name=$name&groupname=$groupname&groupid=$groupid&chitamount=$chitamount&chitinstallno=$chitinstallno'>Pay</a>
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
