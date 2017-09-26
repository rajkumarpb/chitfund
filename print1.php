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
<title>Receipt</title>
<link href="main.css" rel="stylesheet" type="text/css" >
<META HTTP-EQUIV="Content-Type" CONTENT="text/html"; charset="utf-8" />
</head>
<body>
  <div class="grid">
  <div style="clear: both">
    <h3 style="float:right"> <a href = "adminlogout.php" style="margin-left:10px">logout</a></h3>
    <h3 style="float:right" ><?php echo 'Welcome Admin/User : '.$_SESSION['username'];?></h3>
    <h1 style="float:left"><a href = "print.php">Back</a></h1>
 </div>
  <div style="clear: both">
    <h1 style="float:left"><a href="javascript:void(0);" onclick="printPage();">Print</a></h1>
    <h1 style="float:right"><a href = "adminmenu.php"> Admin Home </a></h1>
    <h1 style="float:right "><a href = "usermenu.php" style="margin-right:10px"> User Home </a></h1>
  </div>
  <h1 align="center"> ரசீது</h1>
  <div class="print-scroll2">
    <table align = "center" width = "940" border = "1" style="border-collapse:seperate;empty-cells:hide"  cellpadding ="6" cellspacing="6">
  <tr>
  <?php
        $group = $_POST['group'];
        $noofinstall = $_POST['noofinstall'];
        $s11 = mysql_query("select symbolicname,groupname,chitamount from groupinfo where groupid = $group");
        $cellcount=0;
        $print_head=0;
        while($r11 = mysql_fetch_assoc($s11))
        {
          $groupname = $r11['groupname'];
          $chitamount = $r11['chitamount'];
        $s5 = mysql_query("select memberid,status from membergroupauction where groupid = $group and chitinstallno = $noofinstall");
        while($row = mysql_fetch_assoc($s5))
        {
          if($row['status'] <> 'Paid')
          {
         $memberid = $row['memberid'];
         $s0 = mysql_query("select membername,responseid from memberinfo where memberid = $memberid");
         while($r = mysql_fetch_assoc($s0))
         {
           $membername = $r['membername'];
           $responseid = $r['responseid'];
           $s = mysql_query("select responsename from groupowner where responseid = '$responseid'");
           while($r0 = mysql_fetch_assoc($s))
           {
             $responsename = $r0['responsename'];
             $s2 = mysql_query("select auctionamount,auctiondt,installamount,discount from auction where groupid = '$group' and chitinstallno = '$noofinstall'");

             while($r1 = mysql_fetch_assoc($s2))
             {
               if ($print_head == 1) {
                 echo "<DIV style=\"page-break-after:always\"></DIV>";
                 echo "<table align = \"center\" width = \"940\" border = \"1\" style=\"border-collapse:seperate;empty-cells:hide\" cellpadding =\"6\" cellspacing=\"6\">";
                 echo "<tr>";
                 $print_head=0;
               }

               $auctionamount = $r1['auctionamount'];
               $installamount = $r1['installamount'];
               $result = $r1['auctiondt'];
               $a = explode('-',$result);
               $date1 = $a[2].'/'.$a[1].'/'.$a[0];
               $discount = $r1['discount'];
               $amount = $discount + $installamount;
               date_default_timezone_set('Asia/Calcutta');
               $date = date("d/m/y", strtotime("first Sunday of next month".date('M')." ".date('Y').""));
               echo "<td>
                <table >
                <tr><td><span style='font-size:110%;'>தேதி </span>&nbsp&nbsp &nbsp &nbsp &nbsp &nbsp&nbsp<b><span style='font-size:150%;'>".$date1."</span></b></td></tr><tr></tr><tr></tr><tr></tr><tr></tr>
                <tr><td><span style='font-size:110%;'>பெயர்</span>&nbsp &nbsp &nbsp &nbsp &nbsp <b><span style='font-size:140%;'>".$membername."</span></b></td></tr><tr></tr><tr></tr><tr></tr><tr></tr>
                <tr><td><span style='font-size:110%;'>தவணை</span>&nbsp &nbsp &nbsp <b> <span style='font-size:160%;'> ".$noofinstall."</span></b></td></tr><tr></tr><tr></tr><tr></tr><tr></tr>
                <tr><td><span style='font-size:110%;'>குரூப்</span>&nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp&nbsp<b><span style='font-size:160%;'>".$groupname."</span></b></td></tr><tr></tr><tr></tr><tr></tr><tr></tr>
                <tr><td><span style='font-size:110%;'>சீட்டுத்தொகை</span> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp&nbsp<b><span style='font-size:180%;'>".$chitamount."</span></b></td></tr><tr></tr><tr></tr><tr></tr><tr></tr>
                <tr><td><span style='font-size:110%;'>ஏலத்தொகை</span>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <b><span style='font-size:180%;'>".$auctionamount."</span></b></td></tr><tr></tr><tr></tr><tr></tr><tr></tr>
                <tr><td><span style='font-size:110%;'>தவணைத்தொகை&nbsp </span> &nbsp &nbsp<b><span style='font-size:180%;'>".$amount."</span></b></td></tr><tr></tr><tr></tr><tr></tr><tr></tr>
                <tr><td><span style='font-size:110%;'>தள்ளுத்தொகை</span> &nbsp &nbsp &nbsp &nbsp  &nbsp&nbsp<b> <span style='font-size:180%;'>".$discount."</span></b></td></tr><tr></tr><tr></tr><tr></tr><tr></tr>
                <tr><td>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp<b>--------------------------</b></td></tr>
                <tr><td><span style='font-size:110%;'>செலுத்த வேண்டிய </span></td></tr>
                <tr><td><span style='font-size:110%;'>தொகை</span> &nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp&nbsp&nbsp&nbsp<b><span style='font-size:180%;'>".$installamount."</span></b></td></tr><tr></tr><tr></tr><tr></tr><tr></tr>
                <tr><td>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp<b>-------------------------</b></td></tr>
                <tr><td><span style='font-size:110%;'>அடுத்த ஏலம் </span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp &nbsp &nbsp<b><span style='font-size:150%;'>".$date."</b></span></td></tr><tr></tr><tr></tr><tr></tr><tr></tr>
                <tr><td></tr></td>
                <h1><tr><td>&nbsp &nbsp &nbsp<span style='font-size:120%;'>ஞாயிற்றுக்கிழமை இரவு 7 மணி</span></h1>

                </table>
                </td>";
                $cellcount=$cellcount+1;
                if(($cellcount % 2) <> 0)
                {
                   echo "<td style = 'padding: 15px;'></td>";
                }
                if(($cellcount % 4) == 0){
                  echo "</tr>";
                  echo "</table>";
                  $print_head=1;
                  //echo "<table align = \"center\" width = \"940\" border = \"7\" cellpadding =\"6\" cellspacing=\"6\">";
                  //echo "<tr>";
                }
                else if (($cellcount % 2) == 0 ) {
                  echo "</tr>";
                  echo "<tr>";
                  echo "</tr>";
                  echo "<tr>";
                  echo "</tr>";
                  echo "<tr>";
                  echo "</tr>";
                  echo "<tr>";
                  echo "</tr>";
                  echo "<tr>";
                  echo "</tr>";
                  echo "<tr>";
                }
             }
         }
       }
      }
    }
  }

 ?>
</tr>
 </table>
 <script type="text/javascript">
  function printPage(){
         var list = document.getElementsByClassName('print-scroll2');
         var i;
         var tableData='';
        for (i = 0; i < list.length; i++) {
            tableData = tableData + list[i].innerHTML ;
        }
  //      document.write(tableData);
         var data = '<button onclick="window.print()">Print this page</button>'+tableData;
         myWindow=window.open('','','width=800,height=600');
         myWindow.innerWidth = screen.width;
         myWindow.innerHeight = screen.height;
         myWindow.screenX = 0;
         myWindow.screenY = 0;
         myWindow.document.write(data);
         myWindow.focus();
     };
  </script>​​​​​​
</div>
  </body>
</html>
