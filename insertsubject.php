<?php 

$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("dbrms", $con);

$sql="INSERT INTO tblsubjects (SubjectNo,SubjectName) VALUES ('$_POST[sno]','$_POST[sname]')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

echo "<script type='text/javascript'>alert('Record Submitted Successfully!')</script>";
echo "<script type='text/javascript'>window.location.href = 'homepage.php#manage-s';</script>";
mysql_close($con)

?>


