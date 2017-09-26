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
   $er1='';
   if(isset($_GET['exp']))
     $exp=$_GET['exp'];
    if($exp=='add')
    {
      if(isset($_POST['category']) && !empty($_POST['category']))
      {
      $name = $_POST['ownname'];
      $cate = $_POST['category'];
      if($name && $cate)
      {
      $result = mysql_query("select *from groupowner WHERE responsename = '".$name."'");
       $numrows=mysql_num_rows($result);
         if($numrows>0)
            echo '<script type = "text/javascript">alert("User Name already Exits");</script>';
          else
          {
            date_default_timezone_set('Asia/Calcutta');
            $date = date('y-m-d');
            $sql1=mysql_query("insert into groupowner(responsename,headcate,entrydt)values('$name','$cate','$date')");
            echo '<script type = "text/javascript">alert("New Thalaivar/others added Successfully");</script>';
          }
        }
      else {
          echo'<script type = "text/javascript">alert("Invalid Data");</script>';
        }
     }
        else
        echo'<script type = "text/javascript">alert("Invalid Data");</script>';
    }
    if ($exp=='delete')
    {
      $id = $_GET['responseid'];
      $num = 1;
       mysql_query("update userlogin set id =$num := $num+1");
       mysql_query("alter TABLE userlogin AUTO_INCREMENT = 1");
      $del_query1 = mysql_query("Delete from groupowner where responseid = '$id'");
      if($del_query1)
        $msg = 'Delete the record';
      else
         $msg = 'Error';
    }
    if ($exp=='editsave')
    {

     $name = $_POST['ownname'];
     $new_id=$_POST['responseid'];
     date_default_timezone_set('Asia/Calcutta');
     $date = date('y-m-d');
     $upd_query1 = mysql_query("update groupowner set responsename='$name',entrydt = '$date' where responseid = '$new_id'" );
     if($upd_query1)
       echo '<script type = "text/javascript">alert("Update Successfully");</script>';
     else
       echo '<script type = "text/javascript">alert("Error");</script>';
    }
?>
<!DOCTYPE html>
<html>
<head>
<title>குரூப் தலைவர் விவரங்கள்</title>
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
      <h1 style="float:right"><a href = "adminmenu.php">Home </a></h1>
    </div>
  <?php
   if ($exp=='update')
   {
    $id = $_GET['responseid'];
    $up_query = mysql_query("select *from groupowner where responseid= '$id'");
    $up_row = mysql_fetch_assoc($up_query);
  ?>

    <h1 align="center">குரூப் தலைவர் விவரங்கள்</h1>
    <form action = 'responsibility.php?exp=editsave' method = "POST" autocomplete="off">
      <fieldset style='width:auto;margin:auto;' class='members'>
        <legend>குரூப் தலைவர் விவரங்கள்</legend><br>
        <div class="row">
          <br><br><div><label for ="ownname"> தலைவரின் பெயர் மாற்றம்</label>
                <input id="name" name="ownname" value = "<?PHP echo $up_row['responsename']?>" type="text"></div>
              </div>
                <div class="row">
             <br><br><br><div id="login">
               <input name="submit" type="submit" value="மாற்றம்  ">
            </div>
          </fieldset>

            <input type='hidden' name="responseid" value=<?php echo $id;?> >
    </form>
  </div>
  <?php }else {
  ?>

    <h1 class="text" id="welcome"align = "center">குரூப் தலைவர் விவரங்கள் </h1><br><br>
    <div id = "er1"><?php echo $er1;?></div>
  <form action="responsibility.php?exp=add" method="post" autocomplete="off">
    <fieldset style='width:auto;margin:auto;' class='members'>
      <legend>குரூப் தலைவர் விவரங்கள்</legend><br>
      <div class="row">
          <br><br><div><label for ="ownname">புதுத்தலைவரின் பெயர்*</label><input id="ownname" name="ownname" type="text"></div>
          <div><label> Type* </label><br><input type="radio" id = "cate" name="category" value="H">தலைவர் <br>
                <input type="radio" id = "cate" name="category" value="O"> மற்றவர்கள்<br>

         </div>
          <div class="row">
          <br><br><br><div align = "right"><input name="submit" type="submit" value="புதிய சேர்ப்பு"></div>
          </div>
    </fieldset>

  </form>
  <?php } ?>
  * symbol இருக்கும் Boxல் கட்டாயம் Data கொடுக்க வேண்டும்.
  <h1 align="center">தற்போதைய தலைவர்கள்</h1>
  <div class = "print-scroll1">
  <table align = "center" width = "600" border = "7" cellpadding ="6" cellspacing="6">
   <tr align = "center">
       <th>தலைவர்களின் பெயர்கள் </th>
       <th> செயல்</th>
    </tr>
    <?php
          $sqlq = mysql_query("select *from groupowner where headcate = 'H'");
           while($row = mysql_fetch_assoc($sqlq))
          {
            echo "<tr align='center'>
                  <td>".$row['responsename']."</td>
                  <td align = 'center'>
                  <a href='responsibility.php?exp=update&responseid=".$row['responseid']."'>மாற்றம்</a>
                  </td>
               </tr>";
           }
      ?>
    </table>
  </div>
      <h1 align="center">தற்போதைய மற்றவர்கள்</h1>
      <div class = "print-scroll1">
      <table align = "center" width = "600" border = "7" cellpadding ="6" cellspacing="6">
       <tr align = "center">
           <th>மற்றவர்களின் பெயர்கள் </th>
           <th> செயல்</th>
        </tr>
        <?php
              $sqlq1 = mysql_query("select *from groupowner where headcate = 'O'");
              while($row = mysql_fetch_assoc($sqlq1))
              {
                echo "<tr align='center'>
                      <td>".$row['responsename']."</td>
                      <td align = 'center'>
                      <a href='responsibility.php?exp=update&responseid=".$row['responseid']."'>மாற்றம்</a>
                      </td>
                   </tr>";
               }
          ?>
  </table>
</div>
</div>
</body>
</html>
