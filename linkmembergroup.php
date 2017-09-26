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
<title>உறுப்பினரையும் குரூப்பையும் இணைத்தல்</title>
<link href="main.css" rel="stylesheet" type="text/css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html"; charset="utf-8" />
<script type = "text/javascript" src = "js/jquery.min.js"></script>
<script >
$(document).ready(function(){
  var left = $('#box').position().left;
  var top = $('#box').position().top;
  var width = $('#box').width;

  $('#search_result').css('left',left).css('top',top+32).css('width',width);

  $('#search_box').keyup(function(){
     var value = $(this).val();
      if(value != ''){
        $.post('search.php',{value: value},function(data){
          $("#search_result").html(data);
        });
      }
  });
});
</script>
</head>
<body>
  <div class="grid">
  <h3><br><?php echo 'Welcome User : '.$_SESSION['username'];?>
  <br><br><a href = "adminlogout.php">Click here to logout</a></h3>
  <div class="wrap1">
    <h1 align = "right"><a href = "adminmenu.php">Home</a></h1>
    <br><h1 class="text" id="welcome"align = "center">உறுப்பினரையும் குரூப்பையும் இணைத்தல்</h1><br><br>

    <fieldset style='width:auto;margin:auto;' class='link'>
      <legend>உறுப்பினரையும் குரூப்பையும் இணைத்தல்</legend><br>
      <div class="row">
        <br><br>
         <span id = "box"><label for ="mname">உறுப்பினரின் பெயர் ஆரம்பிக்கும் எழுத்து</label><input id="search_box" name="membername" type="text"></span><br>
         <div id = "search_result"></div>
      </div>

    </fieldset>
</div>
</body>
</html>
