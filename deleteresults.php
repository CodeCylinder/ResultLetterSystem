<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<title>Delete Form</title>
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
<script>
function deleteFunction() {
    var r = confirm("Are you sure you want to delete this record? This action cannot be undone!");
    if (r == false) {
        window.close();
    }
}
</script>
</head>

<body>
<form class="form1" method="post" action="">
<div id ="modalheader" width ="100px" style="background:">
<h3 align="center" style="color:#FFFFFF"> Delete Record</h3>
</div>
<div id="box">

    
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
				$InitName=$res['InitName'];
				$FullName=$res['FullName'];
				$NIC=$res['NIC'];
				$CourseName=$res['CourseName'];
				$Semester=$res['Semester'];
				$ExamYear=$res['ExamYear'];
				$ExamMedium=$res['ExamMedium'];

?>
    
	<table>
    		<form class="form1" method="post" action="">
    	<tr>
        	<th>Index No</th>
            <td><input type="text" name="index" value="<?php echo $index; ?>" /></td>
        </tr>
        <tr>
        	<th>Name</th>
            <td><input type="text" name="name1" value="<?php echo $InitName; ?>"/></td>
        </tr>
        <tr>
        	<th>NIC No</th>
            <td><input type="text" name="nic" value="<?php echo $NIC; ?>" /></td>
        </tr>
        <tr>
        	<th>Exam Year</th>
            <td><input type="text" name="eyear" value="<?php echo $ExamYear; ?>" /></td>
        </tr>
        <tr>
        	<th>Exam Medium</th>
            <td><input type="text" name="emedium" value="<?php echo $ExamMedium; ?>"/></td>
        </tr>
        <tr>
        	<th>Course</th>
            <td><input type="text" name="course" value="<?php echo $CourseName; ?>" /></td>
        </tr>


        <tr>
            <td colspan="2" align="center">
            <input type="submit" name="btndelete" onClick="deleteFunction()" value="Delete"/>
            </td>
        </tr>
    </table>
    </form>
	</div>
        <?php
			if (isset($_POST['btndelete'])){
				$index = $_GET['index'];  
			            
			
			$con = mysqli_connect("localhost","root","","dbrms") or die ("could not connect to mysql");
			if (!$con)
			  {
			  die('Could not connect: ' . mysqli_error());
			  }

			mysqli_select_db($con,"dbrms")or die ("no database");
			
			$i = mysqli_query($con, "delete from tblexamresult where IndexNo='$index' and Semester='$Semester'");
			$j = mysqli_query($con, "delete from tblstudents where IndexNo='$index' and Semester='$Semester'");
			if($i==true || $j==true){
			echo "<script language='javascript'>";
			echo "alert('Record Deleted Successfully');";
			echo "window.opener.location.reload();";
			echo "close();";
            echo "</script>";
			
			// echo "<script language='javascript'>";
			// echo "confirm('Are you sure you want to delete this record? This action cannot be undone.')";
			// echo "alert('Record Deleted Successfully');";
            // echo "window.close();";
            // echo "</script>";
			// echo "<META HTTP-EQUIV='Refresh' Content='0; URL=homepagedt.php'>";
			}
			//header('Location::index.php');
			//exit;
			//mysql_close();
			}
    ?>
</body>
</html>