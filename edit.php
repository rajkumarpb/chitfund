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
<title>Report Form</title>
<link href="main.css" rel="stylesheet" type="text/css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html"; charset="utf-8" />
</head>
<script type = "text/javascript" src = "js/jquery.min.js"></script>
<script>
function getgroup(val)
 {
   $.ajax({
     type: "POST",
     url: "getmember.php",
     data: 'groupid='+val,
     success: function(data){
       $("#member").html(data);
     }
   });
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
    <br><br><h1 class="text" id="welcome"align = "center">Report</h1><br><br>
    <form action ="edit1.php" method = "post" autocomplete="off">
    <fieldset style='width:auto;margin:auto;' class='members'>
      <legend>Report</legend><br>
      <div class="row">
          <br><br><div><label for = "group" >குரூப்பின் பெயர்</label>
               <label><select id = "group" name = "group" style="font-size:15px;background: #68add8;  width:250px;
               height:40px;" onchange = "getgroup(this.value);"><option>-----குரூப்பின் பெயர்-----</option>
               <?php
                 $sql =mysql_query("select *from groupinfo");
                 while($row = mysql_fetch_assoc($sql))
                 {
               ?>
                 <option name = "groupname" value = "<?php echo $row['groupid'];?>"><?php echo $row['symbolicname'];?></option>
               <?php } ?>
             </select></label></div>
             <div><label for ="member">உறுப்பினர்களின்பெயர்</label>
               <label><select id = "member" name = "member" style="font-size:15px;background: #68add8;  width:250px;
               height:40px;" ><option>-----உறுப்பினர்களின் பெயர்-----</option>
               </select></label></div>
               <div><input name="submit" type = "submit" value = "மாற்றம்"></div>
            </div>
      </fieldset>
    </form>
  </div>
  </body>
</html>
