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
  <title>அறிக்கை</title>
  <link href="main.css" rel="stylesheet" type="text/css">
  <META HTTP-EQUIV="Content-Type" CONTENT="text/html"; charset="utf-8" />
  </head>
  <body>
    <script type="text/javascript">
    function printPage(){
           var tableData = '<table border="1">'+document.getElementsByTagName('table')[0].innerHTML+'</table>';
           var data = '<button onclick="window.print()">Print this page</button>'+tableData;
           myWindow=window.open('','','width=800,height=600');
           myWindow.innerWidth = screen.width;
           myWindow.innerHeight = screen.height;
           myWindow.screenX = 0;
           myWindow.screenY = 0;
           myWindow.document.write(data);
           myWindow.focus();
       };
     </script>
    <div class="grid">
      <div style="clear: both">
        <h3 style="float:right"> <a href = "adminlogout.php" style="margin-left:10px">logout</a></h3>
        <h3 style="float:right" ><?php echo 'Welcome Admin : '.$_SESSION['username'];?></h3>
        <h1 style="float:left"><a href = "transaction.php" style ="margin-left:30px">Back</a></h1>
     </div>
      <div style="clear: both">
        <h1 style="float:right"> <a href = "adminmenu.php" style="margin-left:20px">Admin Home </a></h1>
        <h1 style="float:right"> <a href = "usermenu.php"> User Home</a><h1>
        <input name="print" type = "submit" value = "Print" onclick="printPage();">
      </div>

    <div class="wrap1">
      <br><h1 class="text" id="welcome"align = "center">தேதி வாரி பணவரவு அறிக்கை</h1><br>
      <div class = "print-scroll">
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
            $fromdt1 = $_POST['auctiondt'];
            $a = explode('/',$fromdt1);
            $fromdt= $a[2].'/'.$a[1].'/'.$a[0];
            $todt1 = $_POST['auctiondt1'];
            $a1 = explode('/',$todt1);
            $todt = $a1[2].'/'.$a1[1].'/'.$a1[0];
            $s = mysql_query("select *from membergroupauction where paiddt between '$fromdt' and '$todt'");
            while($r = mysql_fetch_assoc($s))
            {
               $memberid = $r['memberid'];
               $sql = mysql_query("select *from memberinfo where memberid = $memberid");
               while($row = mysql_fetch_assoc($sql))
               $membername = $row['membername'];
               $paiddt1 = $r['paiddt'];
               $a = explode('-',$paiddt1);
               $paiddt = $a[2].'/'.$a[1].'/'.$a[0];
               $groupid = $r['groupid'];
               $sq = mysql_query("select *from groupinfo where groupid = '$groupid'");
               $sq1 = mysql_query("select *from auction where groupid = '$groupid'");
               while($r2 = mysql_fetch_assoc($sq1))
               {
               $auctionamount = $r2['auctionamount'];
               while($r1 = mysql_fetch_assoc($sq))
               {
                   echo "<tr align='center'>
                   <td>".$membername."</td>
                   <td>".$r1['groupname']."</td>
                   <td>".$r1['chitamount']."</td>
                   <td>".$auctionamount."</td>
                   <td>".$r['chitinstallno']."</td>
                   <td>".$r['payable']."</td>
                   <td>".$paiddt."</td>
                   <td>".$r['status']."</td>
                 </tr>";
               }
            }
          }
    ?>
  </table>
  </div>
</body>
  </html>
