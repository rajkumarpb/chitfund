<?php
   mysql_connect('localhost','root','jaiyog');
   mysql_select_db('chitfund');
   $exp ='';
   $er1 ='';
   session_start();
    if(isset($_POST['submit']))
    {
      $name = $_POST['username'];
      $password = $_POST['password'];
      if($name&&$password)
      {
         $result = mysql_query("select name, password,idtype FROM login WHERE name = '".$name."' AND  password = '".$password."'");
         $numrows=mysql_num_rows($result);
         if($numrows<>0)
         {
             while($row=mysql_fetch_assoc($result))
             {
               $check_username=$row['name'];
               $check_password=$row['password'];
               $check_id=$row['idtype'];
               if($name == $check_username && $password == $check_password && $check_id == 1)
               {
                 $_SESSION['is_logged_in']=true;
                 $_SESSION['username']=$name;
                 $_SESSION['id'] = 1;
                 header("Location:adminmenu.php");
                 exit;
                }
                else
                {
                  $_SESSION['is_logged_in']=true;
                  $_SESSION['username']=$name;
                  $_SESSION['id'] = 0;
                  header("Location:usermenu.php");
                  exit;
                }
             }
          }
          else
            $er1 = 'Invalid username and password';
      }
      else
       $er1 = 'Invalid username and password';
    }
?>
<!DOCTYPE html>
<html>
<head>
<title>Login Form</title>
<link href="main1.css" rel="stylesheet" type="text/css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html"; charset="utf-8" />
</head>
<body>
  <div class="wrap">
    <h1 class="text" id="welcome">Welcome. <span>please login.</span></h1><br><br>
    <div id = "er1"><?php echo $er1;?></div>
    <form action="" method="post" autocomplete="off">
      <input id="name" name="username" placeholder="username" type="text"><br><br><br>
      <input id="password" name="password" placeholder="**********" type="password"><br><br><br>
      <div id="login">
       <input name="submit" type="submit" value=" Login ">
      </div>
    </form>
</div>
</body>
</html>
