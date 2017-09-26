<?php

   mysql_connect('localhost','root','jaiyog');
   mysql_select_db('chitfund');
   $exp ='';
   $er = '';
   $er1='';
   if(isset($_GET['exp']))
     $exp=$_GET['exp'];
    if($exp=='register')
    {
      $name = $_POST['username'];
      $password = $_POST['password'];
      if($name&&$password)
      {
         $result = mysql_query("select *from login WHERE name = '".$name."' and idtype = 0" );
         $numrows=mysql_num_rows($result);
         if($numrows>0)
           $er = 'User Name already Exits';
          else
          {
            $sql1=mysql_query("insert into login(idtype,name,password)values('0','$name','$password')");
           }

      }
      else
           $er1 = 'Invalid username and password';
    }
    if ($exp=='delete')
    {
      $id = $_GET['id'];
      $num = 1;
       mysql_query("update userlogin set id =$num := $num+1");
       mysql_query("alter TABLE userlogin AUTO_INCREMENT = 1");
      $del_query1 = mysql_query("Delete from login where id = '$id'");
      if($del_query1)
        $msg = 'Delete the record';
      else
         $msg = 'Error';
    }
    if ($exp=='editsave')
    {

     $name = $_POST['username'];
     $password = $_POST['password'];
     $new_id=$_POST['id'];
     $upd_query1 = mysql_query("update login set name='$name',password='$password' where id = '$new_id' and idtype = 0" );
     if($upd_query1)
       $msg = 'Update Successfully';
     else
        $msg = 'Error';
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
  <?php
   if ($exp=='update')
   {
    $id = $_GET['id'];
    $up_query = mysql_query("select *from login where id= '$id'");
    $up_row = mysql_fetch_assoc($up_query);
  ?>
    <div class="wrap">
    <h1 align="center">Update User account</h1>
    <form action = 'userregister.php?exp=editsave' method = "POST" autocomplete="off">
      <input id="name" name="username" value = "<?PHP echo $up_row['name']?>" type="text"><br><br><br>
      <input id="password" name="password" value="<?PHP echo $up_row['password']?>" type="password"><br><br><br>
      <input type='hidden' name="id" value=<?php echo $id;?> ><br><br><br>
      <div id="login">
       <input name="submit" type="submit" value=" Register ">
       <a href ="adminmenu.php">Back To Admin Menu</a>
       </div>
    </form>
  </div>
  <?php }else {
  ?>
  <div class="wrap">
    <h1 class="text" id="welcome">New User register </h1><br><br>
    <div id = "er"><?php echo $er;?></div>
    <div id = "er1"><?php echo $er1;?></div>
   <form action="userregister.php?exp=register" method="post" autocomplete="off">
      <input id="name" name="username" placeholder="username" type="text"><br><br><br>
      <input id="password" name="password" placeholder="**********" type="password"><br><br><br>
      <div id="login">
       <input name="submit" type="submit" value=" Register ">
       <a href ="adminmenu.php">Back To Admin Menu</a>
       </div>
   </form>
  </div>
  <?php } ?>
   <h1 align="center">User Account</h1>
   <table align = "center"width = "600" border = "7" cellpadding ="6" cellspacing="6">
    <tr>
       <th>Id</th>
        <th> Name </th>
        <th> Password </th>
        <th> Action </th>
     </tr>
     <?php
           $sqlq = "select *from login";
           $records = mysql_query($sqlq);
          while($row = mysql_fetch_assoc($records))
           {
             if($row['idtype']== 0)
             {
              echo "<tr>
                   <td> ".$row['id']."</td>
                   <td>".$row['name']."</td>
                   <td>".$row['password']."</td>
                   <td align = 'center'>
                     <a href='userregister.php?exp=delete&id=".$row['id']."'>DELETE</a>
                     <a href='userregister.php?exp=update&id=".$row['id']."'>UPDATE</a>
                   </td>
                </tr>";
              }
          }
       ?>
   </table>
</body>
</html>
