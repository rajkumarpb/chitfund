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
<title></title>
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
  <h3><br><?php echo 'Welcome User/Admin : '.$_SESSION['username'];?>
  <br><br><a href = "adminlogout.php">Click here to logout</a></h3>
  <h1 align ="right"><a href = "adminmenu.php">Admin Home</a><br>
    <a href = "usermenu.php">User Home</a></h1></div>
    <div align ="right"><p><input name="print" type = "submit" value = "Print" onclick="printPage();"></p></div>
  <br>
  <h1 align="center">தவணைத்தொகைக் கட்டாதவர்களின் அறிக்கை</h1><br><br><br>
  <div class = "table-scroll">
  <table align = "center" width = "950" border = "7" cellpadding ="6" cellspacing="6">
   <tr align = "center">
     <th>உறுப்பினர்களின் பெயர் </th>
    <th>குரூப்பின் பெயர் </th>
    <th>சீட்டுத்தொகை</th>
    <th>ஏலத்தொகை</th>
    <th>தவணைகள்</th>
    <th>செலுத்த வேண்டியத்தொகை</th>
    <th>Status</th>
  </tr>
  <?php
    $responseid = $_POST['ownername'];
    $s5 = mysql_query("select memberid,membername from memberinfo where responseid= '$responseid'");
     while($row = mysql_fetch_assoc($s5))
     {
       $memberid = $row['memberid'];
       $membername = $row['membername'];
       $mys = mysql_query("select groupid,memberid from membergroup where memberid = '$memberid'");
          while($rmys = mysql_fetch_assoc($mys))
          {
             $memberid = $rmys['memberid'];
             $groupid = $rmys['groupid'];
             $s = mysql_query("select symbolicname,groupname,chitamount from groupinfo where groupid = '$groupid'");
             while($r0 = mysql_fetch_assoc($s))
             {
            $s2 = mysql_query("select groupid,chitinstallno,payable,status from membergroupauction where groupid = '$groupid' and memberid = '$memberid'and payable <> 'null'");
          while($r1 = mysql_fetch_assoc($s2))
          {
            if($r1['payable'] <> 'null')
            {
               $sq = mysql_query("select auctionamount from auction where chitinstallno = '".$r1['chitinstallno']."' and groupid = '".$r1['groupid']."'");
                while($r = mysql_fetch_assoc($sq))
                {
                  if( $r1['status']<> 'Paid' and $r['auctionamount'] <> 'null')
                  {
                      $status = "UnPaid";
                      echo "<tr align='center'>
                          <td>".$membername."</td>
                          <td>".$r0['symbolicname']."</td>
                          <td>".$r0['chitamount']."</td>
                          <td>".$r['auctionamount']."</td>
                         <td>".$r1['chitinstallno']."</td>
                         <td>".$r1['payable']."</td>
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
<h1 align = "right"><a href = "reportall.php">Back</a></h1>
</body>
</html>
