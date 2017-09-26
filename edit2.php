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
   if(isset($_GET['exp']))
    $exp=$_GET['exp'];
   if ($exp=='editsave')
   {
    $status = $_POST['status'];
    $chit = $_POST['chit'];
    $install = $_POST['install'];
    $payable = $_POST['payable'];
    $groupid = $_POST['groupid'];
    $memberid = $_POST['memberid'];
    if($status <>'Paid')
    {
    $upd_query = mysql_query("update membergroupauction set status='$status',paiddt = '0000-00-00',amountpaid = '0' where groupid = '$groupid' and memberid = '$memberid' and chitinstallno = '$install' and payable='$payable'" );
    if($upd_query)
      $msg = 'Update Successfully';
    else
       $msg = 'Error';
     }
    }
  ?>

<!DOCTYPE html>
<html>
<head>
<title>மாற்றம்</title>
<link href="main.css" rel="stylesheet" type="text/css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html"; charset="utf-8" />
</head>
<body>
  <div class="grid">
    <div style="clear: both">
      <h3 style="float:right"> <a href = "adminlogout.php" style="margin-left:10px">logout</a></h3>
      <h3 style="float:right" ><?php echo 'Welcome Admin : '.$_SESSION['username'];?></h3>
      <h1 style="float:left"><a href = "edit.php">Back</a></h1>
   </div>
    <div style="clear: both">
      <h1 style="float:right"> <a href = "adminmenu.php" style="margin-left:20px">Admin Home </a></h1>
      <h1 style="float:right"> <a href = "usermenu.php"> User Home</a><h1>
    </div>
  <?php
 if ($exp=='update')
{
 $groupname = $_GET['groupname'];
 $membername = $_GET['membername'];
 $chit = $_GET['chit'];
 $install = $_GET['install'];
 $payable = $_GET['payable'];
 $groupid = $_GET['groupid'];
 $memberid = $_GET['memberid'];
 $status = $_GET['status'];
 $up_query = mysql_query("select *from membergroupauction where groupid = '$groupid' and memberid = '$memberid'");
 $up_row = mysql_fetch_assoc($up_query);
?>
<br><br>
 <h1 align="center">மாற்றம்</h1>
 <form action = 'edit2.php?exp=editsave' method = "POST">
 <table align ="center">
 <tr>
       <td>உறுப்பினரின் பெயர் :</td>
       <td><input name= "mname" type="text" value= "<?PHP echo $membername?>" readonly="readonly"></td>
 </tr>
 <tr>
     <td>குரூப்பின் பெயர் :</td>
     <td><input name= "gname" type="text" value="<?PHP echo $groupname?>"  readonly="readonly"></td>
   </tr>
   <tr>
     <td>சீட்டுத்தொகை :</td>
     <td> <input name= "chit" type="text" value="<?PHP echo $chit?>" readonly="readonly"></td>
   </tr>
   <tr>
     <td>தவணை</td>
     <td><input name= "install" type="text" value="<?PHP echo $install?>" readonly="readonly"></td>
   </tr>
   <tr>
     <td>செலுத்த வேண்டிய பணம்</td>
     <td><input name= "payable" type="text" value="<?PHP echo $payable ?>" readonly="readonly"></td>
   </tr>
  <tr>
    <td>நிலவரம்</td>
    <td><input name= "status" type="text" value="<?PHP echo $status ?>" ></td>
   <tr>
     <td><input id = "groupid" name = "groupid" type="text"value="<?PHP echo $groupid ?>"></td>
     <td><input id = "memberid" name = "memberid" type="text"value="<?PHP echo $memberid ?>"></td>
     <td><input name= "add" type="submit" value = "மாற்றம்"></td>
     </tr>
 </table>
</form>
<?php }?>

</div>
</body>
</html>
