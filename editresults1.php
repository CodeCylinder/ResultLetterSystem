<?php
$con = mysqli_connect("localhost","root","") or die ("could not connect to mysql");
if (!$con)
  {
  die('Could not connect: ' . mysqli_error());
  }

mysqli_select_db($con,"dbrms")or die ("no database");

if (isset($_REQUEST['index'])){
$index = $_POST['index'];
$semester = $_POST['semester']; }

$result = mysqli_query($con, "SELECT * FROM tblexamresult WHERE IndexNo='$index' AND Semester='$semester'");
$res = mysqli_fetch_array($result);
if (!$result) 
		{
		die('Error: '. mysqli_error($con));#("Error: Data not found..");
		}
				$RegNo=$res['RegNo'];
				$InitName=$res['InitName'];
				$FullName=$res['FullName'];
				$NIC=$res['NIC'];
				$CourseName=$res['CourseName'];
				$Semester=$res['Semester'];
				$ExamYear=$res['ExamYear'];
				$ExamMedium=$res['ExamMedium'];

if(isset($_POST['save']))
{	
	$regno=$_POST['regno'];
	$name1 =$_POST['name1'];
	$fname =$_POST['fname'];
	$nic =$_POST['nic'];
	$courses =$_POST['courses'];
	$semester =$_POST['semester'];
	$eyear =$_POST['eyear'];
	$medium =$_POST['medium'];
	

	mysqli_query($con, "UPDATE tblexamresult SET RegNo='$regno', FullName='$fname', InitName='$name1', NIC='$nic', ExamYear='$eyear',
							ExamMedium='$medium', CourseName='$courses' WHERE IndexNo='$index' AND Semester='$semester'")
or die(mysqli_error($con));

	mysqli_query($con, "UPDATE tblstudents SET RegNo='$regno', FullName='$fname', InitName='$name1', NIC='$nic', ExamYear='$eyear',
							ExamMedium='$medium', CourseName='$courses' WHERE IndexNo='$index' AND Semester='$semester'")
or die(mysqli_error($con));

            echo "<script language='javascript'>";
            echo "alert('Result Database and Student Database Successfully Updated ');";
			echo "window.opener.location.reload();";
			echo "close();";
            echo "</script>";


//	header("Location: homepage.php");			
}
mysqli_close($con);
?>