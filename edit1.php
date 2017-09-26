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
<title>மாற்றம்</title>
<link href="main.css" rel="stylesheet" type="text/css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html"; charset="utf-8" />
</head>
<body>
  <div class="grid">
      <div style="clear: both">
        <h3 style="float:right"> <a href = "adminlogout.php" style="margin-left:10px">logout</a></h3>
        <h3 style="float:right" ><?php echo 'Welcome Admin : '.$_SESSION['username'];?></h3>
        <h1 style="float:left"><a href = "edit.php">Back</a></h1>
     </div>
      <div style="clear: both">
        <h1 style="float:right"> <a href = "adminmenu.php" style="margin-left:20px">Admin Home </a></h1>
        <h1 style="float:right"> <a href = "usermenu.php"> User Home</a><h1>
      </div>
  <br><br><br>
  <div class = "print-scroll">
  <h1 align="center"> மாற்றம்</h1><br>
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
     <th>செயல்</th>
   </tr>
  <?php
        $group = $_POST['group'];
        $member = $_POST['member'];
        $qu = mysql_query("select membername from memberinfo where memberid = '$member'");
        while($ro = mysql_fetch_assoc($qu))
        $membername = $ro['membername'];
        $sq12 = mysql_query("select *from membergroupauction where groupid = '$group' and memberid = '$member'");
        while($r12 = mysql_fetch_assoc($sq12))
        $s = mysql_query("select symbolicname,groupname,chitamount from groupinfo where groupid = '$group'");
          while($r0 = mysql_fetch_assoc($s))
          {
            $s2 = mysql_query("select groupid,chitinstallno,payable,status,paiddt from membergroupauction where groupid = '$group' and memberid = '$member'and payable <> 'null'");
            while($r1 = mysql_fetch_assoc($s2))
           {
             $paiddt1 = $r1['paiddt'];
             $a = explode('-',$paiddt1);
             $paiddt = $a[2].'/'.$a[1].'/'.$a[0];
             if($r1['payable'] <> 'null')
           {
            $sq = mysql_query("select auctionamount from auction where chitinstallno = '".$r1['chitinstallno']."' and groupid = '".$r1['groupid']."'");
             while($r = mysql_fetch_assoc($sq))
             {
               if( $r1['status'] == 'Paid' and $r['auctionamount'] <> 'null')
               {
                   $status = "Paid";
                   echo "<tr align='center'>
                       <td>".$membername."</td>
                       <td>".$r0['symbolicname']."</td>
                       <td>".$r0['chitamount']."</td>
                       <td>".$r['auctionamount']."</td>
                      <td>".$r1['chitinstallno']."</td>
                      <td>".$r1['payable']."</td>
                      <td>".$paiddt."</td>
                      <td>".$status."</td>
                      <td align = 'center'>
                      <a href='edit2.php?exp=update&groupid=".$group."&memberid=".$member."&groupname=".$r0['symbolicname']."&membername=".$membername."&chit=".$r0['chitamount']."&install=".$r1['chitinstallno']."&payable=".$r1['payable']."&status=".$status."'>மாற்றம்</a></td>
                 </tr>";
              }
          }
       }
    }
  }

?>
   </table>
 </div>
    </body>
</html>
