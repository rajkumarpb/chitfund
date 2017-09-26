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
   $msg='';
   $er1='';
   $er='';
   if(isset($_GET['exp']))
     $exp=$_GET['exp'];
    if($exp=='add')
    {
      if((isset($_POST['membername']) && !empty($_POST['membername']))and (isset($_POST['responsename']) && !empty($_POST['responsename'])))
      {
      $name = $_POST['membername'];
      $fatname = $_POST['mfatname'];
      $address = $_POST['address'];
      $phone = $_POST['phone'];
      $email  =$_POST['email'];
      $ownername = $_POST['responsename'];
      $result = mysql_query("select *from memberinfo WHERE membername = '$name'");
      $numrows=mysql_num_rows($result);
      if($numrows>0)
        echo '<script type = "text/javascript">alert("This member already Exits");</script>';
      else
          {
            $sql = mysql_query("select *from groupowner where responsename = '".$ownername."'");
            while($row = mysql_fetch_assoc($sql))
            $id = $row['responseid'];
            date_default_timezone_set('Asia/Calcutta');
            $date = date('y-m-d');
            $sql1=mysql_query("insert into memberinfo(membername,memberfatname,address,phone,email,responseid,entrydt)values('$name','$fatname','$address','$phone','$email','$id','$date')");
             if($sql1)
                 echo '<script type = "text/javascript">alert("New Member added Successfully");</script>';
               else
                echo '<script type = "text/javascript">alert("Error");</script>';

         }
      }
        else
          echo '<script type = "text/javascript">alert("Invalid Data");</script>';
      }

      if ($exp=='editsave')
    {

     $name = $_POST['membername'];
     $new_id=$_POST['memberid'];
     date_default_timezone_set('Asia/Calcutta');
     $date = date('y-m-d');
     $upd_query1 = mysql_query("update memberinfo set membername='$name',entrydt='$date' where memberid = '$new_id'" );
     if($upd_query1)
       echo '<script type = "text/javascript">alert("Update Successfully");</script>';
     else
       echo '<script type = "text/javascript">alert("Error");</script>';
    }
   ?>
<!DOCTYPE html>
<html>
<head>
<title>உறுப்பினர் சேர்ப்பு</title>
<link href="main.css" rel="stylesheet" type="text/css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html"; charset="utf-8" />
<script type = "text/javascript" src = "js/jquery.min.js"></script>
<script >
function onlyAlphabets(e, t) {
            try {
                if (window.event) {
                    var charCode = window.event.keyCode;
                }
                else if (e) {
                    var charCode = e.which;
                }
                else { return true; }
                if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123)|| (charCode == 46))
                    return true;
                else
                    return false;
            }
            catch (err) {
                alert(err.Description);
            }
        }
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
  </script>
</head>
<body>
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
    $id = $_GET['memberid'];
    $up_query = mysql_query("select *from memberinfo where memberid= '$id'");
    $up_row = mysql_fetch_assoc($up_query);
  ?>
    <h1 align="center">உறுப்பினர்களின் மாற்றம்</h1>
    <form action = 'memberinfo.php?exp=editsave' method = "POST" autocomplete="off">
      <fieldset style='width:auto;margin:auto;' class='members'>
        <legend>உறுப்பினர்களின் மாற்றம்</legend><br>
        <div class="row">
          <br><br><div><label for ="membername"> உறுப்பினர் பெயர் மாற்றம்</label>
                <input id="name" name="membername" value = "<?PHP echo $up_row['membername']?>" type="text" maxlength = '15' onkeypress="return onlyAlphabets(event,this);"></div>
              </div>
                <div class="row">
             <br><br><br><div id="login">
               <input name="submit" type="submit" value="மாற்றம்  ">
            </div>
          </fieldset>

            <input type='hidden' name="memberid" value=<?php echo $id;?> >
    </form>
  </div>
  <?php }else {
  ?>

  <h1 class="text" id="welcome"align = "center">புதிய உறுப்பினர் சேர்ப்பு </h1><br><br>
  <?php echo $er1;?><br>
  <form action="memberinfo.php?exp=add" method="post" autocomplete="off">
    <fieldset style='width:auto;margin:auto;' class='members'>
      <legend>உறுப்பினர் சேர்ப்பு</legend><br>
      <div class="row">
         <br><br>
          <div><label for ="mname">உறுப்பினர் பெயர்*</label><input id="mname" name="membername" type="text" maxlength = '15' onkeypress="return onlyAlphabets(event,this);" ></div>
          <div><label for ="mfatname">உறுப்பினர்அப்பாபெயர்</label><input id="mfatname" name="mfatname" type="text" onkeypress="return onlyAlphabets(event,this);"></div>
            <div><label for ="address">முகவரி</label><input id="address" name="address" type="text"></div>
        </div>
         <div class="row">
          <br><br><div><label for = "phone">போன் நம்பர்</label><input id="phone" name="phone" type="text" value = 0 onkeypress="return onlyNos(event,this);"></div>
          <div><label for = "email" >ஈமெயில் </label><input id = "email" name = "email" type ="text"></div>
          <div><label for ="responsename">உறுப்பினரின்தலைவர்பெயர்*</label>
          <label><select name = "responsename" style="font-size:15px;background: #68add8;  width:250px;
          height:40px;"><option></option>
              <?php
                 $sql = "select *from groupowner";
                 $record = mysql_query($sql);
                while($row = mysql_fetch_assoc($record))
                {

              ?>
              <option name = "responsename" id = "<?php echo $row['responsename'];?>"><?php echo $row['responsename'];?></option>
              <?php } ?>
            </select></label>
          </div>
      </div>
        <div class ="row"><br><br>
           <div id="login" align="right" ><input name="submit" type="submit" value="சேர்ப்பு"></div>
      </div>
     </fieldset><br>
     </form>
      * symbol இருக்கும் Boxல் கட்டாயம் Data கொடுக்க வேண்டும்.
     <?php } ?>
     <br><h1 align="center">தற்போதைய உறுப்பினர்கள்</h1>
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
                        <a href='memberinfo.php?exp=update&memberid=".$row['memberid']."'>மாற்றம்</a>
                        </td>
                       </tr>";
                 }
            ?>
         </table>
       </div>
    </div>
  </body>
</html>
