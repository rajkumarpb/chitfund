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
   $ex='';
?>
<!DOCTYPE html>
<html>
<head>
<title>உறுப்பினரை குரூப்பில் சேர்த்தல்</title>
<link href="main.css" rel="stylesheet" type="text/css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html"; charset="utf-8" />
</head>
<body>
  <div class = "grid">
    <div style="clear: both">
      <h3 style="float:right"> <a href = "adminlogout.php" style="margin-left:10px">logout</a></h3>
      <h3 style="float:right" ><?php echo 'Welcome Admin/User : '.$_SESSION['username'];?></h3>
      <h1 style="float:left"><a href = "linkmembergroup1.php">Back</a></h1>
   </div>
    <div style="clear: both">
      <h1 style="float:right"><a href = "adminmenu.php"> Admin Home </a></h1>
      <h1 style="float:right "><a href = "usermenu.php" style="margin-right:10px"> User Home </a></h1>
    </div>
   <?php
  $ex ='';
  if(isset($_GET['ex']))
   $ex=$_GET['ex'];
   if($ex=='delete')
   {
     $name = $_GET['name'];
     $id = $_GET['memberid'];
     $groupid = $_GET['groupid'];
     $sql = mysql_query("select *from auction where groupid = '$groupid' and chitinstallno = '1' and installamount <> 'Null'");
     $numrows=mysql_num_rows($sql);
     if($numrows > 0)
     {
       echo '<script type = "text/javascript">alert("Already Auction is Running.You can not delete this member in this group");</script>';
     }
     else
     {
       mysql_query("delete from membergroupauction where groupid = '$groupid' and memberid = '$id'");
       mysql_query("delete from membergroup where groupid = '$groupid' and memberid = '$id'");
      echo '<script type = "text/javascript">alert("Unlink the member in this group");</script>';
     }
   ?>
     <br><br><br>
     <h1 align="center">உறுப்பினரை குரூப்பில் சேர்த்தல்</h1><br>
     <div class = "table-scroll1">
     <table align = "center" width = "600" border = "7" cellpadding ="6" cellspacing="6">
      <tr align = "center">
        <th>குரூப் பெயரின் தேர்வு </th>
        <th>செயல்</th>
     </tr>
    <?php
     $name =$_GET['name'];
     $id = $_GET['memberid'];
     $groupid = $_GET['groupid'];
     $groupexcludelist='';
     $s12 = mysql_query("select groupid from membergroup where memberid = '$id'");
      while($row = mysql_fetch_assoc($s12))
         {
           $groupid = $row['groupid'];
           if ($groupexcludelist == null)
           {
             $groupexcludelist = "'".$groupid."'";

           }
           else {
             $groupexcludelist = $groupexcludelist.","."'".$groupid."'";
           }

         }

         if ($groupexcludelist != null)
         {

           $sq112 = mysql_query("select groupid,groupname,symbolicname from groupinfo where groupid not in ($groupexcludelist)");
         }
         else{
          $sq112 = mysql_query("select groupid,groupname,symbolicname from groupinfo ");
         }
           while($row112 = mysql_fetch_assoc($sq112))
           {
            echo "<tr align='center'>
                 <td>".$row112['symbolicname']."</td>
                 <td align = 'center'>
                   <a href='link.php?ex=add&groupid=".$row112['groupid']."&name=".$name."&memberid=".$id."'>ADD</a>
                 </td>
                </tr>";
           }


   ?>
 </table></div><br><br><br>
     <h1 align="center"> உறுப்பினர் இருக்கும் குரூப்</h1><br><br>
     <div class = "table-scroll1">
     <table align = "center" width = "600" border = "7" cellpadding ="6" cellspacing="6">
      <tr align = "center">
        <th>உறுப்பினர் பெயர்</th>
        <th>குரூப்பின் பெயர்</th>
        <th>செயல்</th>
     </tr>
 <?php
  $s5 = mysql_query("select groupid from membergroup where memberid ='$id'");
  while($row = mysql_fetch_assoc($s5))
  {
    $id1 = $row['groupid'];
    $s0 = mysql_query("select groupid,groupname,symbolicname from groupinfo where groupid = '$id1'");
    while($r = mysql_fetch_assoc($s0))
    {
       echo "<tr align='center'>
               <td>".$name."</td>
               <td>".$r['symbolicname']."</td>
               <td align = 'center'>
                 <a href='link.php?ex=delete&groupid=".$r['groupid']."&name=".$name."&memberid=".$id."'>delete</a>
               </td>
           </tr>";
     }
  }
 ?>
    </table></div>
<?php  }
else{
   if($ex=='add')
   {
     $name = $_GET['name'];
     $id = $_GET['memberid'];
     $groupid = $_GET['groupid'];
     $sq0 = mysql_query("select *from membergroup where groupid = '$groupid'");
     $norows = mysql_num_rows($sq0);
     $s = mysql_query("select *from groupinfo where groupid = '$groupid'");
     while($rsql = mysql_fetch_assoc($s))
     if($rsql['totalmembers'] > $norows)
     {
        $sql1 = mysql_query("select *from membergroup where groupid = '$groupid' and memberid = '$id'");
       $numrows=mysql_num_rows($sql1);
        if($numrows==0){
            date_default_timezone_set('Asia/Calcutta');
            $date = date('y-m-d');
            $query = mysql_query("insert into membergroup(memberid,groupid,entrydt)values('$id','$groupid','$date')");
            $q = mysql_query("select groupid from membergroup where groupid = '$groupid' and memberid = '$id'");
             while($row=mysql_fetch_assoc($q))
             $groupid1= $row['groupid'];
             $qu = mysql_query("select auctionid,groupid,chitinstallno,installamount from auction where groupid = '$groupid1'");
             while($r=mysql_fetch_assoc($qu))
             {
                     $auctionid = $r['auctionid'];
                     $groupid1 = $r['groupid'];
                     $chitinstallno = $r['chitinstallno'];
                     date_default_timezone_set('Asia/Calcutta');
                     $date = date('y-m-d');
                     $sql = mysql_query("insert into membergroupauction(auctionid,groupid,memberid,chitinstallno,entrydt)values('$auctionid','$groupid1','$id','$chitinstallno','$date')");
                }
            }
        else
            echo '<script type = "text/javascript">alert(" Member added Already");</script>';
      }
      else
          echo '<script type = "text/javascript">alert(" You do not add more....");</script>';
    ?>
     <br><br><br>
     <h1 align="center">உறுப்பினரை குரூப்பில் சேர்த்தல்</h1><br>
     <div class = "table-scroll1">
     <table align = "center" width = "600" border = "7" cellpadding ="6" cellspacing="6">
      <tr align = "center">
        <th>குரூப் பெயரின் தேர்வு </th>
        <th>செயல்</th>
     </tr>
    <?php
     $name =$_GET['name'];
     $id = $_GET['memberid'];
     $groupid = $_GET['groupid'];
     $groupexcludelist='';
     $s12 = mysql_query("select groupid from membergroup where memberid = '$id'");
      while($row = mysql_fetch_assoc($s12))
         {
           $groupid = $row['groupid'];
           if ($groupexcludelist == null)
           {
             $groupexcludelist = "'".$groupid."'";

           }
           else {
             $groupexcludelist = $groupexcludelist.","."'".$groupid."'";
           }

         }
         if ($groupexcludelist != null)
         {

           $sq112 = mysql_query("select groupid,groupname,symbolicname from groupinfo where groupid not in ($groupexcludelist)");
         }
         else{
          $sq112 = mysql_query("select groupid,groupname,symbolicname from groupinfo");
         }
           //$sq112 = mysql_query("select groupid,groupname,symbolicname from groupinfo where groupid not in ($groupexcludelist)");
           while($row112 = mysql_fetch_assoc($sq112))
           {
            echo "<tr align='center'>
                 <td>".$row112['symbolicname']."</td>
                 <td align = 'center'>
                   <a href='link.php?ex=add&groupid=".$row112['groupid']."&name=".$name."&memberid=".$id."'>ADD</a>
                 </td>
                </tr>";
           }


   ?>
</table></div><br><br><br>
     <h1 align="center"> உறுப்பினர் இருக்கும் குரூப்</h1><br><br>
     <div class = "table-scroll1">
     <table align = "center" width = "600" border = "7" cellpadding ="6" cellspacing="6">
      <tr align = "center">
        <th>உறுப்பினர் பெயர்</th>
        <th>குரூப்பின் பெயர்</th>
        <th>செயல்</th>
     </tr>
<?php
  $s5 = mysql_query("select groupid from membergroup where memberid ='$id'");
  while($row = mysql_fetch_assoc($s5))
  {
    $id1 = $row['groupid'];
    $s0 = mysql_query("select groupid,groupname,symbolicname from groupinfo where groupid = '$id1'");
    while($r = mysql_fetch_assoc($s0))
    {
       echo "<tr align='center'>
               <td>".$name."</td>
               <td>".$r['symbolicname']."</td>
               <td align = 'center'>
                 <a href='link.php?ex=delete&groupid=".$r['groupid']."&name=".$name."&memberid=".$id."'>delete</a>
               </td>
           </tr>";
     }
  }
?>
 </table></div>
 <?php
}

else{  if ($ex != 'delete')?>
  <br><br><br>
  <h1 align="center">உறுப்பினரை குரூப்பில் சேர்த்தல்</h1><br>
  <div class = "table-scroll1">
  <table align = "center" width = "600" border = "7" cellpadding ="6" cellspacing="6">
   <tr align = "center">
     <th>குரூப் பெயரின் தேர்வு</th>
     <th>செயல்</th>
  </tr>
  <?php
  if(isset($_GET['exp']))
    $exp=$_GET['exp'];
   if($exp=='list')
   {
    $name =$_GET['name'];
    $id = $_GET['memberid'];
    $sql1 = mysql_query("select *from membergroup where memberid = '$id'");
    $numrows=mysql_num_rows($sql1);
      if($numrows==0){
          $sq = mysql_query("select groupid,groupname,symbolicname from groupinfo");
          while($row1 = mysql_fetch_assoc($sq))
          {
           echo "<tr align='center'>
                <td>".$row1['symbolicname']."</td>
                <td align = 'center'>
                  <a href='link.php?ex=add&groupid=".$row1['groupid']."&name=".$name."&memberid=".$id."'>ADD</a>
                </td>
               </tr>";
          }
      }
      else {
        $s = mysql_query("select groupid from membergroup where memberid = '$id'");
        $groupexcludelist='';
        while($row = mysql_fetch_assoc($s))
        {
          $groupid = $row['groupid'];
          if ($groupexcludelist == null)
                  $groupexcludelist = "'".$groupid."'";
          else
            $groupexcludelist = $groupexcludelist.","."'".$groupid."'";

        }
          $sq1 = mysql_query("select groupid,groupname,symbolicname from groupinfo where groupid not in($groupexcludelist)");
          while($row1 = mysql_fetch_assoc($sq1))
          {
           echo "<tr align='center'>
                <td>".$row1['symbolicname']."</td>
                <td align = 'center'>
                  <a href='link.php?ex=add&groupid=".$row1['groupid']."&name=".$name."&memberid=".$id."'>ADD</a>
                </td>
               </tr>";
          }
      }

  }
  ?></table></div>
  <br><br><br>
       <h1 align="center">உறுப்பினர் இருக்கும் குரூப்</h1><br><br>
       <div class = "table-scroll1">
       <table align = "center" width = "600" border = "7" cellpadding ="6" cellspacing="6">
        <tr align = "center">
          <th>உறுப்பினர் பெயர்</th>
          <th>குரூப்பின் பெயர்</th>
          <th>செயல்</th>
       </tr>
  <?php
    $s5 = mysql_query("select groupid from membergroup where memberid ='$id'");
    while($row = mysql_fetch_assoc($s5))
    {
      $id1 = $row['groupid'];
      $s0 = mysql_query("select groupid,groupname,symbolicname from groupinfo where groupid = '$id1'");
      while($r = mysql_fetch_assoc($s0))
      {
         echo "<tr align='center'>
                 <td>".$name."</td>
                 <td>".$r['symbolicname']."</td>
                 <td align = 'center'>
                   <a href='link.php?ex=delete&groupid=".$r['groupid']."&name=".$name."&memberid=".$id."'>delete</a>
                 </td>
             </tr>";
       }
    }
  }
  ?>
</table></div>
<?php } ?>
</div>
</body>
</html>
