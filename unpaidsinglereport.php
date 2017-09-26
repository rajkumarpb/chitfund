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
<title>அறிக்கை</title>
<link href="main.css" rel="stylesheet" type="text/css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html"; charset="utf-8" />
</head>
<script type = "text/javascript" src = "js/jquery.min.js"></script>
<script>
function getowner(val)
 {
   $.ajax({
     type: "POST",
     url: "get-owner.php",
     data: 'responseid='+val,
     success: function(data){
       $("#member").html(data);
     }
   });
}
function getmember(val)
 {
   $.ajax({
     type: "POST",
     url: "get-member.php",
     data: 'memberid='+val,
     success: function(data){
       $("#group").html(data);
     }
   });
}
</script>
<body>
  <div class="grid">
  <h3><br><br><?php echo 'Welcome Admin/User : '.$_SESSION['username'];?>
  <br><br><a href = "adminlogout.php">Click here to logout</a></h3>
  <h1 align ="right"><a href = "adminmenu.php">Admin Home</a>
    <h1 align ="right"><a href = "usermenu.php">User Home</a></h1>
    <br><h1 class="text" id="welcome"align = "center">தவணைத்தொகைக் கட்டாத தனி நபரின் அறிக்கை</h1><br>
    <form action ="unpaidsinglereport1.php" method = "post" autocomplete="off">
    <fieldset style='width:auto;margin:auto;' class='members'>
      <legend>அறிக்கை</legend><br>
      <div class="row">
          <br><br><div><label for = "ownername" >தலைவரின் பெயர்</label>
            <label><select id = "owner" name = "ownername" style="font-size:15px;background: #68add8;  width:250px;
            height:40px;" onchange = "getowner(this.value);"><option>-----தலைவரின் பெயர்-----</option>
                <?php
                  $sql =mysql_query("select *from groupowner");
                  while($row = mysql_fetch_assoc($sql))
                  {
                ?>
                  <option name = "ownername" value = "<?php echo $row['responseid'];?>"><?php echo $row['responsename'];?></option>
                <?php } ?>
             </select>
             </div>
             <div><label for ="member">உறுப்பினரின்பெயர்</label>
               <label><select id = "member" name = "member" style="font-size:15px;background: #68add8;  width:250px;
               height:40px;" onchange ="getmember(this.value);" ><option>-----உறுப்பினரின் பெயர்-----</option>
               </select></label></div>
      </div>
      <div align = "right"><p><input name="submit" type = "submit" value = "அறிக்கை"></p></div>
    </fieldset>
    </form>
</div>
</body>
</html>
