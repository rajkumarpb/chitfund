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
<title>தவணைப்பதிவு</title>
<link href="main.css" rel="stylesheet" type="text/css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html"; charset="utf-8" />
</head>
<body>
  <div class="grid">
    <div style="clear: both">
      <h3 style="float:right"> <a href = "adminlogout.php" style="margin-left:10px">logout</a></h3>
      <h3 style="float:right" ><?php echo 'Welcome Admin : '.$_SESSION['username'];?></h3>

   </div>
    <div style="clear: both">
      <h1 style="float:right"> <a href = "adminmenu.php" style="margin-left:20px">Admin Home </a></h1>
      <h1 style="float:right"> <a href = "usermenu.php"> User Home</a><h1>
    </div>
     <br><br><br><h1 class="text" id="welcome"align = "center">உறுப்பினர்களின் ஏலத்தவணை பதிவு </h1><br>

         <div class = "print-scroll1">
         <table align = "center" width = "600" border = "7" cellpadding ="6" cellspacing="6">
          <tr align = "center">
              <th>உறுப்பினர்களின் பெயர் </th>
              <th> செயல்</th>
            </tr>
              <?php
                    $sqlq = "select *from memberinfo";
                    $records = mysql_query($sqlq);
                   while($row = mysql_fetch_assoc($records))
                    {

                    echo "<tr align='center'>
                            <td>".$row['membername']."</td>
                            <td align = 'center'>
                            <a href = 'entry1.php?exp=list&memberid=".$row['memberid']."&name=".$row['membername']."'>உறுப்பினரின் விவரம்</a>
                            </td>
                           </tr>";
                     }
                ?>
             </table>
           </div>
        </div>
      </body>
    </html>
