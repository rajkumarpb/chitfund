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
   $exp='';

   $symbolicname='';
   if(isset($_GET['exp']))
        $exp=$_GET['exp'];
       if($exp=='add')
       {
         if((isset($_POST['gname']) && !empty($_POST['gname']))and (isset($_POST['chitamount']) && !empty($_POST['chitamount'])) and (isset($_POST['auctiondate']) && !empty($_POST['auctiondate'])) and (isset($_POST['totmem']) && !empty($_POST['totmem'])))
        {
         $groupname = $_POST['gname'];
         $chitamount = $_POST['chitamount'];
         $auctiondt1= $_POST['auctiondate'];
         $a = explode('/',$auctiondt1);
         $auctiondt = $a[2].'/'.$a[1].'/'.$a[0];
         $totalmembers = $_POST['totmem'];
         $symbolicname = $_POST['gname'].'-'.$_POST['auctiondate'];
         $result = mysql_query("select *from groupinfo WHERE groupname = '".$groupname."' and auctiondt = '".$auctiondt."'" );
           $numrows=mysql_num_rows($result);
            if($numrows>0)
             { echo '<script type = "text/javascript">alert("The Group is already formed");</script>';
              }
             else
             {
               date_default_timezone_set('Asia/Calcutta');
               $date = date('y-m-d');
               $sql1=mysql_query("insert into groupinfo(symbolicname,groupname,chitamount,auctiondt,totalmembers,entrydt)values('$symbolicname','$groupname','$chitamount','$auctiondt','$totalmembers','$date')");
               if($sql1)
                   echo '<script type = "text/javascript">alert("New Group added Successfully");</script>';
                 else
                  echo '<script type = "text/javascript">alert("Error");</script>';
               $sql = mysql_query("select *from groupinfo WHERE auctiondt = '".$auctiondt."' and symbolicname = '$symbolicname'");
               while($row = mysql_fetch_assoc($sql))
               {
               $groupid = $row['groupid'];
              for($i=1;$i<=$row['totalmembers'];$i++)
              {
               $sq = mysql_query("insert into auction(groupid,chitinstallno,auctiondt)values('$groupid','$i','0000-00-00')");
              }
             }
           }

       }
       else
          echo '<script type = "text/javascript">alert("Invalid Data");</script>';;

  }
  if ($exp=='editsave')
  {
     $gname = $_POST['gname'];
     $chitamount=$_POST['chitamount'];
     $totmem=$_POST['totmem'];
     $auctiondt1 = $_POST['auctiondate'];
     $a = explode('/',$auctiondt1);
     $auctiondt = $a[2].'/'.$a[1].'/'.$a[0];
     $id = $_POST['groupid'];
     $symbolicname = $_POST['gname'].'-'.$_POST['auctiondate'];
     $sql = mysql_query("select *from auction where groupid = '$id' and chitinstallno = '1' and installamount <> 'Null'");
     $numrows=mysql_num_rows($sql);
     if($numrows == 0)
     {
     date_default_timezone_set('Asia/Calcutta');
     $date = date('y-m-d');
     $upd_query1 = mysql_query("update groupinfo set symbolicname = '$symbolicname',groupname='$gname',chitamount = '$chitamount',totalmembers='$totmem',auctiondt='$auctiondt',entrydt ='$date'where groupid = '$id'" );
    if($upd_query1)
         echo '<script type = "text/javascript">alert("Update Successfully");</script>';
    else
         echo '<script type = "text/javascript">alert("Error");</script>';
       }
       else {
         echo '<script type = "text/javascript">alert("Already Auction is Running.You can not edit");</script>';
       }
   }
   ?>
<!DOCTYPE html>
<html>
<head>
<title>குரூப் விவரங்கள்</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="main.css" rel="stylesheet" type="text/css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html"; charset="utf-8" />
</head>
<script type = "text/javascript" src = "js/jquery.min.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="css/datepicker.css">
<script>
function onlyNos(e, t) {
    try {
        if (window.event) {
            var charCode = window.event.keyCode;
        }
        else if (e) {
            var charCode = e.which;
        }
        else { return true; }
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
    catch (err) {
        alert(err.Description);
    }
}
$(function () {
               $('#auctiondate').datepicker({
                   format: "dd/mm/yyyy"
               });

           });
</script>
<body><br>
  <div class="grid">
    <div style="clear: both">
      <h3 style="float:right"> <a href = "adminlogout.php" style="margin-left:10px">logout</a></h3>
      <h3 style="float:right" ><?php echo 'Welcome Admin : '.$_SESSION['username'];?></h3>

   </div>
    <div style="clear: both">
      <h1 style="float:right"><a href = "adminmenu.php"> Home </a></h1>
    </div>
    <?php
     if ($exp=='update')
     {
      $groupid = $_GET['groupid'];
      $up_query = mysql_query("select *from groupinfo where groupid = '$groupid'");
      $up_row = mysql_fetch_assoc($up_query);
      $a = explode('-',$up_row['auctiondt']);
      $a1 = $a[2].'/'.$a[1].'/'.$a[0];
    ?>
      <h1 align="center">குரூப்பின் மாற்றங்கள்</h1>
      <form action = 'groupinfo.php?exp=editsave' method = "POST" autocomplete="off">
        <fieldset style='width:auto;margin:auto;' class='members'>
          <legend></legend><br>
          <div class="row">
            <br><br><div><label for = "gcode" > குரூப்பின் பெயர்*</label><input id = "gcode" name = "gname" value = "<?PHP echo $up_row['groupname']?>"type ="text" readonly = "readonly"></div>
              <div><label for ="chitamount">சீட்டுத்தொகை*</label><input id="chitamount" name="chitamount" type="text" value ="<?PHP echo $up_row['chitamount']?>" onkeypress="return onlyNos(event,this);"></div>
           </div>
           <div class="row">
             <div><label for = "totmem">சீட்டு உறுப்பினர்களின் எண்ணிக்கை *</label><input id="totmem" name="totmem" type="text" value="<?PHP echo $up_row['totalmembers']?>" readonly = "readonly" onkeypress="return onlyNos(event,this);"></div>

              <br><br><div><label for = "auctiondate">குரூப் ஆரம்ப தேதி(DD/MM/YYYY)*</label><input id = "auctiondate" name = "auctiondate" value = "<?PHP echo $a1?>"type ="text" readonly = "readonly"></div>
          </div>
            <div ALIGN = "Right"><input name="submit" type="submit" value="மாற்றம்  "></div>
            </fieldset>

              <input type='hidden' name="groupid" value=<?php echo $groupid;?>>
      </form>
    </div>
    <?php } else {
    ?>
  <h1 class="text" id="welcome"align = "center">புதிய குரூப் சேர்ப்பு</h1><br>
  <form action="groupinfo.php?exp=add" method="post" autocomplete="off">
    <fieldset style='width:auto;margin:auto;' class='members' >
      <legend>குரூப் விவரங்கள்</legend><br>
      <div class="row">
          <br><br><div><label for = "gcode" > குரூப்பின் பெயர்*</label><input id = "gcode" name = "gname" type ="text"></div>
          <div><label for ="chitamount">சீட்டுத்தொகை*</label><input id="chitamount" name="chitamount" type="text"  onkeypress="return onlyNos(event,this);"></div>
       </div>
       <div class="row">
         <div><label for = "totmem">சீட்டு உறுப்பினர்களின் எண்ணிக்கை *</label><input id="totmem" name="totmem" type="text"  onkeypress="return onlyNos(event,this);"></div>
          <br><br><div><label for = "auctiondate">குரூப் ஆரம்ப தேதி(DD/MM/YYYY)*</label><input id = "auctiondate" name = "auctiondate" type ="text"></div>
      </div>
        <div ALIGN = "Right"><input name="submit" type="submit" value="குரூப் சேர்ப்பு "></div>
    </fieldset>
    * symbol இருக்கும் Boxல் கட்டாயம் data கொடுக்க வேண்டும்.
    <?php } ?>
    <br><br><h1 align="center">தற்போதைய குரூப் நிலவரங்கள்</h1>
    <div class = "print-scroll">
    <table align = "center" width = "950" border = "7" cellpadding ="6" cellspacing="6">
     <tr align = "center">
         <th>குரூப்பின் பெயர் </th>
         <th>சீட்டுத்தொகை</th>
         <th>குரூப் ஆரம்ப தேதி(DD/MM/YYYY) </th>
         <th>சீட்டு உறுப்பினர்களின் எண்ணிக்கை</th>
         <th>செயல்</th>
    </tr>
      <?php
            $sqlq = "select *from groupinfo";
            $records = mysql_query($sqlq);
           while($row = mysql_fetch_assoc($records))
            {
              $result = $row['auctiondt'];
              $a = explode('-',$result);
              $date = $a[2].'/'.$a[1].'/'.$a[0];
              echo "<tr align='center'>
                    <td>".$row['symbolicname']."</td>
                    <td>".$row['chitamount']."</td>
                    <td>".$date."</td>
                    <td>".$row['totalmembers']."</td>
                    <td align = 'center'>
                    <a href='groupinfo.php?exp=update&groupid=".$row['groupid']."'>மாற்றம்</a>
                    </td>
                   </tr>";
             }
        ?>
     </table>
   </div>
  </form>
</div>
</div>
</body>
</html>
