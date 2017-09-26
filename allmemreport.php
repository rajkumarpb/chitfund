<?php
session_start();
if (isset($_SESSION['username']))
{

}
else{
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
<title>அனைத்து உறுப்பினர்களின் அறிக்கை</title>
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
    <div class="grid">
    <div style="clear: both">
      <h3 style="float:right"> <a href = "adminlogout.php" style="margin-left:10px">logout</a></h3>
      <h3 style="float:right" ><?php echo 'Welcome Admin : '.$_SESSION['username'];?></h3>
      <h1 style="float:left"><a href = "allmemreport1.php" style = "margin-left:30px">Back</a></h1>
   </div>
    <div style="clear: both">
      <h1 style="float:right"> <a href = "adminmenu.php" style="margin-left:20px">Admin Home </a></h1>
      <h1 style="float:right"> <a href = "usermenu.php"> User Home</a><h1>
      <input name="print" type = "submit" value = "Print" onclick="printPage();">
    </div>
  <div class = "print-scroll">
  <br><h1 align="center">அனைத்து உறுப்பினர்களின் அறிக்கை</h1><br>
    <table align = "center" width = "980" border = "7" cellpadding ="6" cellspacing="6">
   <tr align = "center">
     <th>உறுப்பினர்களின் பெயர் </th>
    <th>குரூப்பின் பெயர் </th>
    <th>சீட்டுத்தொகை</th>
    <th>ஏலத்தொகை</th>
    <th>தவணைகள்</th>
    <th>செலுத்த வேண்டியத்தொகை</th>
    <th>செலுத்திய தேதி</th>
    <th>Status</th>
  </tr>
<?php
    $responseid = $_POST['ownername'];
    $gid = $_POST['group'];
    $query = $_POST['paid'];

    $s5 = mysql_query("select memberid,membername from memberinfo where responseid= '$responseid'");
     while($row = mysql_fetch_assoc($s5))
     {
       $memberid = $row['memberid'];
       $membername = $row['membername'];
       $mys = mysql_query("select groupid,memberid from membergroup where memberid = '$memberid' and groupid = '$gid'");
          while($rmys = mysql_fetch_assoc($mys))
          {
             $memberid = $rmys['memberid'];
             $groupid = $rmys['groupid'];
             $s = mysql_query("select symbolicname,groupname,chitamount from groupinfo where groupid = '$groupid'");
             while($r0 = mysql_fetch_assoc($s))
             {
               if ($query == 'paid') {
                 $ar1 = 'Paid';
               }
               elseif ($query == 'unpaid') {
                 $ar1 = 'Unpaid';
               }else{
                 $st=array('Paid','Unpaid');
                 $ar1 = join("','",$st);
               }
              $s2 = mysql_query("select groupid,chitinstallno,payable,status,paiddt from membergroupauction where groupid = '$groupid' and memberid = '$memberid' and status in('$ar1')");
              while($r1 = mysql_fetch_assoc($s2))
             {
               $paiddt = $r1['paiddt'];
               $a = explode('-',$paiddt);
               $result = $a[2].'/'.$a[1].'/'.$a[0];
               if($result == '30/11/-0001')
               {
                 $result = '00/00/0000';
               }
                $sq = mysql_query("select auctionamount from auction where chitinstallno = '".$r1['chitinstallno']."' and groupid = '".$r1['groupid']."'");
                while($r = mysql_fetch_assoc($sq))
                {
                  if($r1['status'] <> 'Paid')
                  {
                    $status = 'UnPaid';
                  }
                  else {
                    $status = 'Paid';
                  }
                      echo "<tr align='center'>
                          <td>".$membername."</td>
                          <td>".$r0['symbolicname']."</td>
                          <td>".$r0['chitamount']."</td>
                          <td>".$r['auctionamount']."</td>
                         <td>".$r1['chitinstallno']."</td>
                         <td>".$r1['payable']."</td>
                         <td>".$result."</td>
                         <td>".$status."</td>
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
