<?php

		$con = mysqli_connect("localhost","root","", "dbrms");
		if (isset($_POST['coname']) AND isset($_POST['semes']) AND isset($_POST['year'])){
		$coname =$_POST['coname'];
		$semes =$_POST['semes'];
		$year =$_POST['year'];
		$query="SELECT * FROM tblexamresult WHERE CourseName='$coname' AND Semester='$semes' AND ExamYear='$year' ORDER BY RegNo ASC " ;
		$result=mysqli_query($con,$query) or die(mysqli_error($con));
		$row= mysqli_fetch_array($result);	
			echo'
				<h2 align="center"><u>View Individual Records</u></h2>
				<h4>Course :  '.$coname.'</h4>
				<h4>Year :   '.$year.'</h4>
				<h4>Semester : '.$semes.'</h4>
				<h4>Medium : '.$row['ExamMedium'].'</h4>
					<table border="1" cellspacing="1" cellpadding="1"><tr>
						<th align="left">Index No:</th>
						<td><input type="text" name="indx" value="'.$row['IndexNo'] .'"/></td></tr>
						<tr><th align="left">Reg No:</th>
						<td><input type="text" name="reg" value="'. $row['RegNo'].'"/></td></tr>
						<tr><th align="left">Full Name:</th>
						<td><input type="text" name="fname" value="'.$row['FullName'].'" /></td></tr>
						<tr><th align="left">Name with Initial:</th>
						<td><input type="text" name="iname" value="'.$row['InitName'].'" /></td></tr>
						<tr><th align="left">NIC:</th>
						<td><input type="text" name="nic" value="'.$row['NIC'].'" /></td>
					</tr>
					</table>
					<br>
					<table>
					<tr>
						<th>Subject:</th>
						<th>Result:</th>
					</tr>
					<tr>
						<th><input type="text" name="cour" value="'.$row['Subject1'].'" /></th>
						<th><input type="text" name="cour" value="'.$row['Result1'].'" /></th>
					</tr>
					<tr>
						<th><input type="text" name="cour" value="'.$row['Subject2'].'" /></th>
						<th><input type="text" name="cour" value="'.$row['Result2'].'" /></th>
					</tr>
					<tr>
						<th><input type="text" name="cour" value="'.$row['Subject3'].'" /></th>
						<th><input type="text" name="cour" value="'.$row['Result3'].'" /></th>
					</tr>
					<tr>
						<th><input type="text" name="cour" value="'.$row['Subject4'].'" /></th>
						<th><input type="text" name="cour" value="'.$row['Result4'].'" /></th>
					</tr>
					<tr>
						<th><input type="text" name="cour" value="'.$row['Subject5'].'" /></th>
						<th><input type="text" name="cour" value="'.$row['Result5'].'" /></th>
					</tr>
					<tr>
						<th><input type="text" name="cour" value="'.$row['Subject6'].'" /></th>
						<th><input type="text" name="cour" value="'.$row['Result6'].'" /></th>
					</tr>
					<tr>
						<th><input type="text" name="cour" value="'.$row['Subject7'].'" /></th>
						<th><input type="text" name="cour" value="'.$row['Result7'].'" /></th>
					</tr>
					<tr>
						<th><input type="text" name="cour" value="'.$row['Subject8'].'" /></th>
						<th><input type="text" name="cour" value="'.$row['Result8'].'" /></th>
					</tr>
					<tr>
						<th><input type="text" name="cour" value="'.$row['Subject9'].'" /></th>
						<th><input type="text" name="cour" value="'.$row['Result9'].'" /></th>
					</tr>
					<tr>
						<th><input type="text" name="cour" value="'.$row['Subject10'].'" /></th>
						<th><input type="text" name="cour" value="'.$row['Result10'].'" /></th>
					</tr>
					<tr>
						<th><input type="text" name="cour" value="'.$row['Subject11'].'" /></th>
						<th><input type="text" name="cour" value="'.$row['Result11'].'" /></th>
					</tr>
					<tr>
						<th><input type="text" name="cour" value="'.$row['Subject12'].'" /></th>
						<th><input type="text" name="cour" value="'.$row['Result12'].'" /></th>
					</tr>
					</table>
					<br>';
				while ($row= mysqli_fetch_array($result)){
					echo '
					<div class="tab-pane">
						<a href="#" class="previous">&laquo; Previous</a>
						<a href="#" class="next">Next &raquo;</a>
					</div>
						';
						
							// echo'
					// <tr>
						// <td>'.$row["RegNo"].'</td>
						// <td>'.$row["IndexNo"].'</td>
						// <td>'.$row["InitName"].'</td>
						// <td>'.$row["FullName"].'</td>
						// <td>'.$row["NIC"].'</td>
						// <td>'.$row["Result1"].'</td>
						// <td>'.$row["Result2"].'</td>
						// <td>'.$row["Result3"].'</td>
						// <td>'.$row["Result4"].'</td>
						// <td>'.$row["Result5"].'</td>
						// <td>'.$row["Result6"].'</td>
						// <td>'.$row["Result7"].'</td>
						// <td>'.$row["Result8"].'</td>
						// <td>'.$row["Result9"].'</td>
						// <td>'.$row["Result10"].'</td>
						// <td>'.$row["Result11"].'</td>
						// <td>'.$row["Result12"].'</td>
						
					// </tr>
					//';
			//}
	
		}
		}
	
?>
<!--

<!DOCTYPE HTML>
<html>
<head> <title>Result Sheet-Individual-PDF</title>
<style type="text/css">
.form1{
	margin:35px 10px 10px 10px;
    width: 700px;
	display:block;
    background: #EFEFEF;
    padding: 10px;
    box-shadow: 1px 1px 25px rgba(0, 0, 0, 0.35);
    border-radius: 10px;
    border: 6px solid #C65353;
}
 
.form1 input[type="text"],
.form1 select {
    background-color: #efefef;
    border: 2px solid #C65353;
    display: inline;
	width:200;
	height:10;
    color: #C65353;
    padding: 8px 18px;
    text-decoration: none;
    font: 16px Arial, Helvetica, sans-serif;
	-webkit-box-sizing: border-box; /* For legacy WebKit based browsers */
     -moz-box-sizing: border-box; /* For legacy (Firefox 29) Gecko based browsers */
    box-sizing: border-box;
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
	width:50%;
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
  font-size:20px;
  font-weight: bold;
  color:#C65353;
  border: 0px solid #C65353;
}
#modalheader{
	height: 85px;
	font:Helvetica;
	border:5px solid #C65353;
    border-radius: 10px ;
    background-color: #efefef; /* For browsers that do not support gradients 
    background-image: linear-gradient(to bottom right, #C65353, #D27979);*/
	width:100%;
}

th.rotate {
  /* Something you can count on */
  height: 100px;
  white-space: nowrap;
  transform: 
    /* Magic Numbers */
    translate(25px, 51px)
    /* 45 is really 360 - 45 */
    rotate(270deg);
  width: 10px;
  border-bottom: 1px solid #ccc;
}

</style>
</head>
<body>
<div class="modal-header" id ="modalheader" >
<h3 align="center" style="color:#C65353"><p>Generate Students List</p><p>based on name of the Course</p></h3>
<br></div>
<div id="divform1" align="justify">
	<form  class="form1" action="<?php //echo $_SERVER['PHP_SELF']; ?>" method="post">
			<label>Name of the Course </label>
			<select name="coname">
			<?php 
			// $con = mysql_connect("localhost","root","");
			// if (!$con)
			  // {
			  // die('Could not connect: ' . mysql_error());
			  // }

			// mysql_select_db("dbrms", $con);
			// $records = mysql_query("SELECT CourseName FROM tblcourses ");
			// echo '<option selected disabled>Select Course</option>';
			// while ($row = mysql_fetch_array($records)) {
			// echo "<option value='" . $row['CourseName'] ."'>" . $row['CourseName'] ."</option>";
				// }
			?>
			</select>
			<br><br>
			<label>Exam Year</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="year" placeholder="Type Year.." ><br><br>
			<label>Semester</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<select name="semes" >
			<option selected disabled>Select Semester</option>
			<option value="Final">Final</option>
			<option value="Final">1<sup>st</sup> Year</option>
			<option value="Final">2<sup>nd</sup> Year</option>
			<option value="Semester 1">Semester 1</option>
			<option value="Semester 2">Semester 2</option>
			<option value="Semester 3">Semester 3</option>
			<option value="Semester 4">Semester 4</option>
			</select>

			<br><br>
			<input type="submit" name="create_pdf" class="btn btn-danger" value="View Students" />    
			</form>
	</div>
</body>
</html>-->