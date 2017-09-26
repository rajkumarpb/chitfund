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
   $exp='';
   $msg='';
   $er1='';
   $chitamount='';
   $totmembers='';
   $perperson='';
    $commission='';
    $withcommission = 0;
    $discount = 0;
    if(isset($_GET['exp']))
    $exp=$_GET['exp'];
    if($exp=='add')
    {
     if((isset($_POST['auctiondt']) && !empty($_POST['auctiondt']))and (isset($_POST['auctionamount']) && !empty($_POST['auctionamount']) || ($_POST['auctionamount'] == '0')) and (isset($_POST['groupname']) && !empty($_POST['groupname'])) and (isset($_POST['noofinstall']) && !empty($_POST['noofinstall'])))
     {
     $auctiondt = $_POST['auctiondt'];
     $a = explode('/',$auctiondt);
     $result = $a[2].'/'.$a[1].'/'.$a[0];
     $auctionamount = $_POST['auctionamount'];
     $groupid = $_POST['groupname'];
     $noofinstall = $_POST['noofinstall'];
     $q1 = mysql_query("select *from groupinfo where groupid = '$groupid'");
     while($r1 = mysql_fetch_assoc($q1))
     $totmem = $r1['totalmembers'];
     $sq0 = mysql_query("select *from membergroup where groupid = '$groupid'");
     $numrows=mysql_num_rows($sq0);
     if($numrows == $totmem)
     {
     $sq = mysql_query("select *from groupinfo where groupid = '".$groupid."'");
     while($row = mysql_fetch_assoc($sq))
     {
     $chitamount = $row['chitamount'];
     $totmembers = $row['totalmembers'];
     }
     $perperson = $chitamount / $totmembers;
     $commission = $chitamount * (3 /100);
     if ($auctionamount > $commission)
     {
       $withcommission = $auctionamount - $commission;
       $discount = $withcommission / $totmembers;
     }
     elseif ($auctionamount < $commission and $auctionamount > 0)
     {
       $withcommission = $commission - $auctionamount;
       $discount = $withcommission / $totmembers;
     }
     elseif ($auctionamount == 0){
       $discount = 0;
     }
     else {
        // popup an error message
     }


     $installamount = $perperson - $discount;


       date_default_timezone_set('Asia/Calcutta');
        $date = date('y-m-d');
        $sql1=mysql_query("update auction set auctiondt = '$result',auctionamount = $auctionamount,commission= $commission,discount = $discount,installamount= $installamount,entrydt = '$date' where chitinstallno = '".$noofinstall."' and groupid = '".$groupid."'");
        $sq = mysql_query("update membergroupauction set status = 'Unpaid',payable = $installamount,paiddt='0000/00/00' where chitinstallno = '".$noofinstall."' and groupid = '".$groupid."'");
            if($sql1)
                echo '<script type = "text/javascript">alert("Auction added Successfully");</script>';
              else
                 echo '<script type = "text/javascript">alert("Error");</script>';
      }else
        echo '<script type = "text/javascript">alert("Total Number of Members is not liked properly in this group");</script>';

    }
        else
           echo '<script type = "text/javascript">alert("Invalid Data");</script>';;

    }

      if ($exp=='editsave')
      {
        $auctionamount = $_POST['auction'];
        $install = $_POST['installno'];
        $id = $_POST['groupid'];
        $sql = mysql_query("select *from membergroupauction where groupid = '$id' and chitinstallno = '$install' and status = 'Paid'");
        $numrows=mysql_num_rows($sql);
        if($numrows > 0)
        {
          echo '<script type = "text/javascript">alert("Already Members Paid in this Auction.You can not edit");</script>';
        }
        else {
          $sq = mysql_query("select *from groupinfo where groupid = '".$id."'");
          while($row = mysql_fetch_assoc($sq))
          {
          $chitamount = $row['chitamount'];
          $totmembers = $row['totalmembers'];
          }
          $perperson = $chitamount / $totmembers;
          $commission = $chitamount * (3 /100);
          if ($auctionamount > $commission)
          {
            $withcommission = $auctionamount - $commission;
            $discount = $withcommission / $totmembers;
          }
          elseif ($auctionamount < $commission and $auctionamount > 0)
          {
            $withcommission = $commission - $auctionamount;
            $discount = $withcommission / $totmembers;
          }
          elseif ($auctionamount == 0){
            $discount = 0;
          }
          else {
             // popup an error message
          }


          $installamount = $perperson - $discount;
          date_default_timezone_set('Asia/Calcutta');
           $date = date('y-m-d');
          $upd_query1 = mysql_query("update auction set auctionamount = '$auctionamount',commission= $commission,discount = $discount,installamount= $installamount,entrydt = '$date' where chitinstallno = '".$install."' and groupid = '".$id."'");
          $sq = mysql_query("update membergroupauction set status = 'Unpaid',payable = $installamount,paiddt='0000/00/00' where chitinstallno = '".$install."' and groupid = '".$id."'");
           if($upd_query1)
              echo '<script type = "text/javascript">alert("Update Successfully");</script>';
         else
              echo '<script type = "text/javascript">alert("Error");</script>';

        }
      }

?>
<!DOCTYPE html>
<html>
<head>
<title>ஏலப்பதிவு</title>
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
$(document).ready(function () {

               $('#auctiondt').datepicker({
                   format: "dd/mm/yyyy"
               });

           });
function getinstallno(val)
 {
   $.ajax({
     type: "POST",
     url: "get_noofinstall.php",
     data: 'groupid='+val,
     success: function(data){
       $("#noofinstall").html(data);

      }
   });
}

function getno(val)
 {
   if(val == "1")
       {
         $("#auctionamount").val("0");
         document.getElementById("auctionamount").readOnly = true;
       }
       else {
         $("#auctionamount").val("");
         document.getElementById("auctionamount").readOnly = false;
       }

}
</script>
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
    <?php
     if ($exp=='update')
     {
      $groupid = $_GET['groupid'];
      $chitinstallno = $_GET['installno'];
      $auctionamount = $_GET['auctionamount'];
      $up_query = mysql_query("select *from auction where groupid = '$groupid' and chitinstallno = '$chitinstallno'");
      $up_row = mysql_fetch_assoc($up_query);

    ?>
      <h1 align="center">ஏலத்தொகை மாற்றங்கள்</h1>
      <form action = 'auctioninfo.php?exp=editsave' method = "POST" autocomplete="off">
        <fieldset style='width:auto;margin:auto;' class='members'>
          <legend></legend><br>
          <div class="row">
            <br><br><div><label for = "gcode" > ஏலத்தொகை*</label><input id = "auction" name = "auction" value = "<?PHP echo $up_row['auctionamount']?>"type ="text"></div>
           </div>
          <div ALIGN = "Right"><input name="submit" type="submit" value="மாற்றம்  "></div>
            </fieldset>
              <input type='hidden' name="groupid" value=<?php echo $groupid;?>>
              <input type='hidden' name="installno" value=<?php echo $chitinstallno;?>>
      </form>
    </div>
    <?php } else {

    ?>
  <br><h1 class="text" id="welcome"align = "center">ஏலப்பதிவு </h1><br>
    <form action ="auctioninfo.php?exp=add" method = "post" autocomplete="off">
    <fieldset style='width:auto;margin:auto;' class='members'>
      <legend>ஏல விவரங்கள்</legend><br>
      <div class="row">
          <br><br><div><label for = "groupname" >குரூப்பின் பெயர்*</label>
            <label><select id = "groupname" name = "groupname" style="font-size:15px;background: #68add8;  width:250px;
            height:40px;" onchange = "getinstallno(this.value);" ><option>-----குரூப்பின் பெயர்-----</option>
                <?php
                   $sql =mysql_query("select *from groupinfo");
                   while($row = mysql_fetch_assoc($sql))
                   {
                ?>
                <option name = "groupname" value = "<?php echo $row['groupid'];?>"><?php echo $row['symbolicname'];?></option>
                <?php } ?>
              </select>
                </div>
              <div><label for ="noofinstall">தவணை*</label>
                <label><select id = "noofinstall" name = "noofinstall" style="font-size:15px;background: #68add8;  width:250px;
                height:40px;" onchange = "getno(this.value);" ><option>------ தவணை-------</option>
                </select></label></div>
      </div>
      <div class="row">
          <br><br><div><label for = "auctiondt" >ஏலத்தேதி(DD/MM/YYYY)*</label><input id = "auctiondt" name = "auctiondt" type ="text"></div>
          <div><label for ="auctionamount">ஏலத்தொகை*</label><input id="auctionamount" name="auctionamount" type="text" onkeypress="return onlyNos(event,this);"></div>
      </div>
       <div id="login" align="right" ><input name="submit" type="submit" value="சேர்ப்பு"></div>
    </fieldset><br>
    * symbol இருக்கும் Boxல் கட்டாயம் data கொடுக்க வேண்டும்.
  <?php } ?>
    <br><h1 align="center">தற்போதைய ஏல நிலவரங்கள்</h1>
    <div class = "print-scroll">
    <table align = "center" width = "950" border = "7" cellpadding ="6" cellspacing="6">
     <tr align = "center">
         <th>குரூப்பின் பெயர் </th>
         <th>தவணை</th>
         <th>ஏலத்தேதி தேதி(DD/MM/YYYY) </th>
         <th>ஏலத்தொகை</th>
         <th>செயல்</th>
    </tr>
      <?php
            $sqlq = "select *from auction";
            $records = mysql_query($sqlq);
           while($row = mysql_fetch_assoc($records))
            {
              $groupid = $row['groupid'];
              $result = $row['auctiondt'];
              $a = explode('-',$result);
              $date = $a[2].'/'.$a[1].'/'.$a[0];
              $sql = mysql_query("select symbolicname from groupinfo where groupid = '$groupid'");
              while($ro = mysql_fetch_assoc($sql))
              $symbolicname = $ro['symbolicname'];
           echo "<tr align='center'>
                    <td>".$symbolicname."</td>
                    <td>".$row['chitinstallno']."</td>
                    <td>".$date."</td>
                    <td>".$row['auctionamount']."</td>
                    <td align = 'center'>
                    <a href='auctioninfo.php?exp=update&groupid=".$row['groupid']."&installno=".$row['chitinstallno']."&auctionamount=".$row['auctionamount']."'>மாற்றம்</a>
                    </td>
                   </tr>";
             }
        ?>
     </table>
   </div>
  </form>
</div>

</html>
