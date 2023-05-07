<?php
$con = mysqli_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysqli_error($con));
  }
mysqli_select_db($con, "dbrms"); 
if (isset($_POST['submit']))
	{	 
 // //validation - empty fields
        if (empty ($_POST['index']) or empty($_POST['name1']) or empty($_POST['fname']) or empty($_POST['nic']) or empty($_POST['semester']) or empty($_POST['eyear']) or empty($_POST['medium']) or empty($_POST['courses']) or empty($_POST['subject1']) 
			or empty($_POST['Result1']) or empty($_POST['subject2']) or empty($_POST['Result2']) or empty($_POST['finres'])) 
			{
				$message = "Error ! You are trying to enter BLANK DATA";
				echo "<script type='text/javascript'>alert('$message');";
				echo 'window.location.href = "homepage.php";';
				echo '</script>';
			}
		else{
		$sql = "INSERT INTO tblexamresult(IndexNo, RegNo, FullName, InitName, NIC, Semester, ExamYear, ExamMedium, CourseName, Subject1, Result1,
					Subject2, Result2, Subject3, Result3, Subject4, Result4, Subject5, Result5, Subject6, Result6, Subject7, Result7, Subject8, 
					Result8, Subject9, Result9, Subject10, Result10, Subject11, Result11, Subject12, Result12,FinalResult) 
					VALUES ('$_POST[index]', '$_POST[regno]', '$_POST[fname]','$_POST[name1]','$_POST[nic]','$_POST[semester]','$_POST[eyear]',
					'$_POST[medium]','$_POST[courses]','$_POST[subject1]','$_POST[Result1]','$_POST[subject2]','$_POST[Result2]','$_POST[subject3]',
					'$_POST[Result3]','$_POST[subject4]','$_POST[Result4]','$_POST[subject5]','$_POST[Result5]','$_POST[subject6]','$_POST[Result6]',
					'$_POST[subject7]','$_POST[Result7]','$_POST[subject8]','$_POST[Result8]','$_POST[subject9]','$_POST[Result9]','$_POST[subject10]',
					'$_POST[Result10]','$_POST[subject11]','$_POST[Result11]','$_POST[subject12]','$_POST[Result12]','$_POST[finres]')";
				
		$sql2 = "INSERT INTO tblstudents(IndexNo, RegNo, FullName, InitName, NIC, Semester, ExamYear, ExamMedium, CourseName, FinalResult) VALUES ('$_POST[index]','$_POST[regno]','$_POST[fname]','$_POST[name1]','$_POST[nic]','$_POST[semester]','$_POST[eyear]','$_POST[medium]','$_POST[courses]','$_POST[finres]')";

		if (!mysqli_query($con, $sql)) 
		  {
		  die('Error: ' . mysqli_error($con));
		  }
		else if(!mysqli_query($con, $sql2))
		  {
		  die('Error: ' . mysqli_error($con));
		  }
		echo "<script type='text/javascript'>alert('Record Submitted Successfully!')</script>";
		echo "<script type='text/javascript'>window.location.href = 'homepage.php';</script>";
		//mysql_close($con)

		}
	}
// $name1=(isset($_POST['name1']));
// $fname=(isset($_POST['fname']));
// $nic=(isset($_POST['nic']));
// $regno=(isset($_POST['regno']));
// $index=(isset($_POST['index']));
// $courses =(isset($_POST['courses']));
// $semester =(isset($_POST['semester']));
// $eyear =(isset($_POST['eyear']));
// $medium =(isset($_POST['medium']));
// $subject1 =(isset($_POST['subject1']));
// $result1 =(isset($_POST['Result1']));
// $subject2 =(isset($_POST['subject2']));
// $result2 =(isset($_POST['Result2']));
// $subject3 =(isset($_POST['subject3']));
// $result3 =(isset($_POST['Result3']));
// $subject4 =(isset($_POST['subject4']));
// $result4 =(isset($_POST['Result4']));
// $subject5 =(isset($_POST['subject5']));
// $result5 =(isset($_POST['Result5']));
// $subject6 =(isset($_POST['subject6']));
// $result6 =(isset($_POST['Result6']));
// $subject7 =(isset($_POST['subject7']));
// $result7 =(isset($_POST['Result7']));
// $subject8 =(isset($_POST['subject8']));
// $result8 =(isset($_POST['Result8']));
// $subject9 =(isset($_POST['subject9']));
// $result9 =(isset($_POST['Result9']));
// $subject10 =(isset($_POST['subject10']));
// $result10 =(isset($_POST['Result10']));
// $subject11 =(isset($_POST['subject11']));
// $result11 =(isset($_POST['Result11']));
// $subject12 =(isset($_POST['subject12']));
// $result12 =(isset($_POST['Result12']));
// $finres =(isset($_POST['finres']));
?> 



