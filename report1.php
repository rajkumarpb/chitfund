<?php
   mysql_connect('localhost','root','jaiyog');
   mysql_select_db('chitfund');
   $exp ='';
   $msg ='';
?>
<!DOCTYPE html>
<html>
<head>
<title>Member Auction Entry</title>
<link href="main.css" rel="stylesheet" type="text/css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html"; charset="utf-8" />
</head>
<body>
  <br><br><br><br><br><br>
  <h1 align="center"> Member Auction Entry</h1><br><br><br>
  <table align = "center" width = "800" border = "1" cellpadding ="1" cellspacing="1">
   <tr align = "center">
     <th>Member Name </th>
    <th>Group Name </th>
    <th>Chit Amount</th>
    <th>Auction Amount</th>
    <th>Chit Install No.</th>
    <th>Payable Amount</th>
    <th>Paid/or Not</th>
  </tr>
  <?php
        $member = $_POST['member'];
        $group = $_POST['group'];
        $noofinstall = $_POST['noofinstall'];
       $s5 = mysql_query("select memberid,membername from memberinfo where memberid= '$member'");
     while($row = mysql_fetch_assoc($s5))
     {
       $memberid = $row['memberid'];
       $membername = $row['membername'];
       $s0 = mysql_query("select memberid,groupid from membergroup where groupid = $group");
        while($r = mysql_fetch_assoc($s0))
        {
          $memberid = $r['memberid'];
          $groupid = $r['groupid'];
          $s = mysql_query("select groupname,chitamount from groupinfo where groupid = '$groupid'");
          $s2 = mysql_query("select chitinstallno,payable,status from membergroupauction where groupid = '$groupid' and memberid = '$memberid'");
          while($r1 = mysql_fetch_assoc($s2))
          {
          if($r1['status'] == 'NULL')
           $r1['status'] = 'Not Paid';
          else
          $r1['status'] = 'Paid';

          while($r0 = mysql_fetch_assoc($s))
             {
               $sq = mysql_query("select auctionamount from auction where chitinstallno = '".$r1['chitinstallno']."'");
                while($r = mysql_fetch_assoc($sq))
                {
           echo "<tr align='center'>
              <td>".$membername."</td>
               <td>".$r0['groupname']."</td>
               <td>".$r0['chitamount']."</td>
               <td>".$r['auctionamount']."</td>
               <td>".$r1['chitinstallno']."</td>
               <td>".$r1['payable']."</td>
               <td ".$r1['status']."</td>
            </tr>";
            exit;
          }
        }
       }
   }
 }

?>
</table>
</body>
</html>
