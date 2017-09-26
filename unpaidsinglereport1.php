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
<title> தனி நபரின் அறிக்கை</title>
<link href="main.css" rel="stylesheet" type="text/css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html"; charset="utf-8" />
</head>
<body>
  <div class="grid">
  <h3><br><?php echo 'Welcome Admin/User : '.$_SESSION['username'];?>
  <br><br><a href = "adminlogout.php">Click here to logout</a></h3>
  <h1 align ="right"><a href = "adminmenu.php">Admin Home</a><br>
    <a href = "usermenu.php">User Home</a></h1></div>
  <br>
  <h1 align="center">தவணைத்தொகைக் கட்டாத தனி நபரின் அறிக்கை</h1><br><br><br>
  <div class = "table-scroll">
  <table align = "center" width = "940" border = "7" cellpadding ="6" cellspacing="6">
   <tr align = "center">
     <th>உறுப்பினரின் பெயர்</th>
    <th>குரூப்பின் பெயர்</th>
    <th>சீட்டுத்தொகை</th>
    <th>ஏலத்தொகை</th>
    <th>தவணை</th>
    <th>செலுத்த வேண்டிய பணம்</th>
    <th>செலுத்திய தேதி</th>
    <th>Paid/orNot</th>
  </tr>
  <?php
        $member = $_POST['member'];
        $s5 = mysql_query("select memberid,membername from memberinfo where memberid= '$member'");
      while($row = mysql_fetch_assoc($s5))
      {
        $memberid = $row['memberid'];
        $membername = $row['membername'];
        $s0 = mysql_query("select memberid,groupid from membergroup where memberid = $memberid");
         while($r = mysql_fetch_assoc($s0))
         {
           $memberid = $r['memberid'];
           $groupid = $r['groupid'];
           $s = mysql_query("select symbolicname,groupname,chitamount from groupinfo where groupid = '$groupid'");
           while($r0 = mysql_fetch_assoc($s))
           {
           $s2 = mysql_query("select groupid,chitinstallno,payable,status,paiddt from membergroupauction where groupid = '$groupid' and memberid = '$memberid' and payable <> 'null'");
           while($r1 = mysql_fetch_assoc($s2))
           {
             if($r1['payable'] <> 'null')
             {
             $paiddt = date_format(new DateTime($r1['paiddt']),'d/m/Y' );
             if($paiddt == '30/11/-0001')
             {
               $paiddt = '00-00-0000';
             }
             $sq = mysql_query("select auctionamount from auction where chitinstallno = '".$r1['chitinstallno']."' and groupid = '".$r1['groupid']."'");
             while($r = mysql_fetch_assoc($sq))
             {
                if($r1['status'] <> 'Paid' and $r['auctionamount'] <> 'null')
                {
                  $status = 'UnPaid';
                echo "<tr align='center'>
               <td>".$membername."</td>
                <td>".$r0['symbolicname']."</td>
                <td>".$r0['chitamount']."</td>
                <td>".$r['auctionamount']."</td>
                <td>".$r1['chitinstallno']."</td>
                <td>".$r1['payable']."</td>
                <td>".$paiddt."</td>
                <td>".$status."</td>
             </tr>";
           }
         }
         }
       }
      }
    }
  }

 ?>
 </table>
</div>
<h1 align= "right"><a href = "singlepersonreport.php">Back</a></h1>
</body>
 </html>
