
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Delete Subject</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
label {
  padding: 1rem;
  text-align: left;
  border: 0px solid #C65353;
}
#modalheader{
	height: 80px;
    border-radius: 10px;
    background-color: #C65353; /* For browsers that do not support gradients */
    background-image: linear-gradient(to bottom right, #C65353, #D27979);
	width:600px;
}
</style>

<body>
<div class="modal-header" id ="modalheader" width ="100px">
<h3 align="center" style="color:#FFFFFF"> Delete Subject</h3>
</div>


<?php
$con = mysqli_connect("localhost","root","") or die ("could not connect to mysql");
if (!$con)
  {
  die('Could not connect: ' . mysqli_error());
  }

mysqli_select_db($con,"dbrms")or die ("no database");

if (isset($_POST['search'])){
$subno =mysqli_real_escape_string($con,$_POST['subno']);

$sql = "SELECT * FROM tblsubjects WHERE SubjectNo='$subno'";
$result = mysqli_query($con, $sql);
if (!$result) 
		{
		die('Error: '. mysql_error($con));#("Error: Data not found..");
		}

while($row= mysqli_fetch_array($result))
{

?>
<div id="divform1" >
<form class="form1" action="" method="post">
			<table>
			<tr> 
                <td>Subject No</td>
                <td><input type="text" name="subno1" value="<?php echo $row['SubjectNo'];?>"></td>
            </tr>
			<tr> 
                <td>Subject Name</td>
                <td><input type="text" name="subname" value="<?php echo $row['SubjectName'];?>"></td>
            </tr>

	<tr>
		<td><input type="submit" name="delete" value="DELETE" /></td>
	<!--<td><button type="submit" id="delete" class='btn btn-danger btn-lg' onClick="return confirm('Are you sure you want to delete?')"><span class='glyphicon glyphicon-trash' style='font-size:16px;color:#FFFFFF;'> DELETE</span></a></td>     -->
	</tr>

</table>
	
</form>
</div>
<?php
}
}
?>


<form  class="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

				<label>Subject No </label>	
					<select name="subno" >
						<option value="">Select Subject No</option>
						<?php
						$result = mysqli_query($con, "SELECT SubjectNo FROM tblsubjects ORDER BY SubjectNo DESC ");
						while ($row = mysqli_fetch_array($result)) {
							echo "<option value='" . $row['SubjectNo'] ."'>" . $row['SubjectNo'] ."</option>";
						}
						?>        
					</select>						
			<button type="submit" name="search"><span class='glyphicon glyphicon-search' style='font-size:18px;color:#C65353;'></span></button>
				<!--<a data-toggle='modal' type="submit" name="search" class='btn btn-default' onClick="showDivFunction()" href="#divform1"><i class="fa fa-edit"></i> <span>SEARCH</span></a>&nbsp;&nbsp;-->
</form>
	
<?php


if (isset($_POST['delete'])){
$subno1 =mysqli_real_escape_string($con,$_POST['subno1']);
$subname =mysqli_real_escape_string($con,$_POST['subname']);


$sql = "DELETE FROM tblsubjects WHERE SubjectNo='$subno1'";
$result = mysqli_query($con, $sql);	

	// mysqli_query($con, "DELETE FROM tblsubjects WHERE SubjectNo='".$row['SubjectNo']."'")
// or die(mysqli_error($con));
if (!$result) 
		{
		die('Error: '. mysql_error($con));#("Error: Data not found..");
		}
		else{
            echo "<script language='javascript'>";
            echo "alert('Course Successfully Updated ');";
            echo "</script>";
		}
//	header("Location: homepage.php");			
}

?>
				</body>
</html>			
