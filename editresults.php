<?php
$con = mysqli_connect("localhost","root","") or die ("could not connect to mysql");
if (!$con)
  {
  die('Could not connect: ' . mysqli_error());
  }

mysqli_select_db($con,"dbrms")or die ("no database");

if (isset($_REQUEST['index'])){
$index = $_GET['index']; }

$result = mysqli_query($con, "SELECT * FROM tblexamresult WHERE IndexNo='$index'");
$res = mysqli_fetch_array($result);
if (!$result) 
		{
		die('Error: '. mysql_error($con));#("Error: Data not found..");
		}
				$RegNo=$res['RegNo'];
				$InitName=$res['InitName'];
				$FullName=$res['FullName'];
				$NIC=$res['NIC'];
				$CourseName=$res['CourseName'];
				$Semester=$res['Semester'];
				$ExamYear=$res['ExamYear'];
				$ExamMedium=$res['ExamMedium'];

// if(isset($_POST['save']))
// {	
	// $name1 =$_POST['name1'];
	// $fname =$_POST['fname'];
	// $nic =$_POST['nic'];
	// $courses =$_POST['courses'];
	// $semester =$_POST['semester'];
	// $eyear =$_POST['eyear'];
	// $medium =$_POST['medium'];
	

	// mysqli_query($con, "UPDATE tblexamresult SET FullName='$fname', InitName='$name1', NIC='$nic', Semester='$semester', ExamYear='$eyear',
							// ExamMedium='$medium', CourseName='$courses' WHERE IndexNo='$index'")
// or die(mysqli_error($con));

            // echo "<script language='javascript'>";
            // echo "alert('Database Successfully Updated ');";
			// echo "window.location.href = '/homepage.php';";
            // echo "</script>";

// //	header("Location: homepage.php");			
// }
// mysqli_close($con);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script language="JavaScript" type="text/javascript">

</script>
</head>

<style type="text/css">
.form1{
    max-width: 600px;
    background: #EFEFEF;
    padding: 10px;
    box-shadow: 1px 1px 25px rgba(0, 0, 0, 0.35);
    border-radius: 10px;
    border: 6px solid #C65353;
}

.form1 input[type="button"], 
.form1 input[type="submit"] {
    -moz-box-shadow: inset 0px 1px 0px 0px #3985B1;
    -webkit-box-shadow: inset 0px 1px 0px 0px #3985B1;
    box-shadow: inset 0px 1px 0px 0px #3985B1;
    background-color: #C65353;
    border: 1px solid #17445E;
    display: inline-block;
    cursor: pointer;
	width:100%;
    color: #FFFFFF;
    padding: 8px 18px;
    text-decoration: none;
    font: 16px Arial, Helvetica, sans-serif;
}
.form1 input[type="button"]:hover, 
.form1 input[type="submit"]:hover {
    background: linear-gradient(to bottom, #2D77A2 5%, #337DA8 100%);
    background-color: #D27979;
}
table {
  border-collapse: collapse;
  width: 90%;
  margin-left:10px;
}
th, td {
  padding: 1rem;
  text-align: left;
  border: 0px solid #C65353;
}
#modalheader{
height: 80px;
    background-color: #C65353; /* For browsers that do not support gradients */
    background-image: linear-gradient(to bottom right, #C65353, #D27979);
}
</style>

<body>
<form class="form1" method="post" action="editresults1.php">
<div id ="modalheader" width ="100px" style="background:">
<h3 align="center" style="color:#FFFFFF"> Update Details</h3>
</div>
</hr>
</hr>
<div>
        <table>
		    <tr> 
                <td>Registered No</td>
                <td><input type="text" name="regno" value="<?php echo $RegNo;?>"></td>
            </tr>
            <tr> 
                <td>Name with Initial</td>
                <td><input type="text" name="name1" value="<?php echo $InitName;?>"></td>
            </tr>
            <tr> 
                <td>Full Name</td>
                <td><input type="text" name="fname" value="<?php echo $FullName;?>"></td>
            </tr>
            <tr> 
                <td>NIC No</td>
                <td><input type="text" name="nic" value="<?php echo $NIC;?>"></td>
            </tr>
			<tr> 
                <td>Course Name</td>
                <td><input type="text" name="courses" value="<?php echo $CourseName;?>"></td>
            </tr>
			<tr> 
                <td>Semester</td>
                <td><input type="text" name="semester" value="<?php echo $Semester;?>"></td>
            </tr>
			<tr> 
                <td>Exam Year</td>
                <td><input type="text" name="eyear" value="<?php echo $ExamYear;?>"></td>
            </tr>
			<tr> 
                <td>Exam Medium</td>
                <td><input type="text" name="medium" value="<?php echo $ExamMedium;?>"></td>
            </tr>
	<tr>
	<td><input type="hidden" name="index" value="<?php echo $index;?>"/></td>
	<td><input type="submit" name="save" value="save" /></td>
	</tr>
	<script language="JavaScript" type="text/javascript">

</script>

</table>
</div>	
</form>
</body>
</html>
