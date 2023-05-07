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
				<style>
				body{
					background-image:url("images/cotmaradana3.png") ;
					background-repeat: no-repeat;
					background-position: center;
					background-size: 100% 100%;
					background-attachment: fixed;
					font-family:Helvetica;
					color:#000000;
				}
				table {
				  border-collapse: collapse;
				  width: 100%;
				}
				th, td {
				  padding: 0.5rem;
				  text-align: center;
				  border: 1px solid #000000;
				  
				}
				</style>
				<br>
				<h3>Course :  '.$coname.'</h3>
				<h3>Year :   '.$year.'</h3>
				<h3>Semester : '.$semes.'</h3>
				<h3>Medium : '.$row['ExamMedium'].'</h3>
				<div style="overflow-x:auto; overflow-y:auto;">
				<table cellspacing="0" cellpadding="0" style="font-family:verdana; font-size:13; color:#000000;">
				<tr align="center">
						<th>Reg. No</th>
						<th>Index No</th>
						<th>Name with Initials</th>
						<th>Full Name</th>
						<th>NIC</th>
						<th>'.$row['Subject1'].'</th>
						<th>'.$row['Subject2'].'</th>
						<th>'.$row['Subject3'].'</th>
						<th>'.$row['Subject4'].'</th>
						<th>'.$row['Subject5'].'</th>
						<th>'.$row['Subject6'].'</th>
						<th>'.$row['Subject7'].'</th>
						<th>'.$row['Subject8'].'</th>
						<th>'.$row['Subject9'].'</th>
						<th>'.$row['Subject10'].'</th>
						<th>'.$row['Subject11'].'</th>
						<th>'.$row['Subject12'].'</th>

					</tr>';
						$query1="SELECT * FROM tblexamresult WHERE CourseName='$coname' AND Semester='$semes' AND ExamYear='$year'" ;
						$result1=mysqli_query($con,$query1) or die(mysqli_error($con));
						while ($res= mysqli_fetch_array($result1))	{
					echo '<tr>
						<td>'.$res["RegNo"].'</td>
						<td>'.$res["IndexNo"].'</td>
						<td>'.$res["InitName"].'</td>
						<td>'.$res["FullName"].'</td>
						<td>'.$res["NIC"].'</td>
						<td>'.$res["Result1"].'</td>
						<td>'.$res["Result2"].'</td>
						<td>'.$res["Result3"].'</td>
						<td>'.$res["Result4"].'</td>
						<td>'.$res["Result5"].'</td>
						<td>'.$res["Result6"].'</td>
						<td>'.$res["Result7"].'</td>
						<td>'.$res["Result8"].'</td>
						<td>'.$res["Result9"].'</td>
						<td>'.$res["Result10"].'</td>
						<td>'.$res["Result11"].'</td>
						<td>'.$res["Result12"].'</td>
						
					</tr>
					
					';
			}
		}
	
?>
