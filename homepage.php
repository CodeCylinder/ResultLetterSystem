<?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("dbrms", $con);

// Initialize the session
session_start();
// login successful, then assign session 
   //$_SESSION["usertype"] = "admin";   
// or for normal user
  // $_SESSION["loggedin"] = "user";
   
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Home Page</title>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script language="JavaScript" src="js/dtjs.js" type="text/javascript"></script>
<link href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
<link rel="stylesheet" href="css/homestyle.css">

<link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8" language="javascript" src="js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8" language="javascript" src="js/DT_bootstrap.js"></script>
<style>
/*text box add button*/
btn:active,
button#add:active
{
    background:#C65353;
}
button#add:focus
{
    background:#C65353;
}

body{
background-image:url("images/cotmaradana3.png") ;
			 background-repeat: no-repeat;
				background-position: center;
				background-size: 100% 100%;
				background-attachment: fixed;
}

</style>

 <script>

$('a.btn').on('click', function(e) {
    e.preventDefault();
    var url = $(this).attr('href');
    $(".modal-body").php('<iframe width="100%" height="100%" frameborder="0" scrolling="no" allowtransparency="true" src="'+url+'"></iframe>');
});

function showHideDiv(ele) {
				var srcElement = document.getElementById(ele);
				if (srcElement != null) {
					if (srcElement.style.display == "block") {
						srcElement.style.display = 'none';
					}
					else {
						srcElement.style.display = 'block';
					}
					return false;
				}
			}			

$(document).ready(function() {
$('#confbtn').click(function(){
//$("input:radio[name=options]").attr("disabled",true); // all disabled
$("#editbtn,#dltbtn").attr("disabled",true); // single option disabled
//$("#opt1,#opt2").attr("disabled",true); // Two  options disabled
})

})


 </script>



</head>
<body>
    <div class="page-header" >
	<ul class="nav navbar-nav navbar-right">
      <li><a href="resetpass.php" class="btn btn-default" style="color:#C65353"><span class="glyphicon glyphicon-user" style ="font-size:20px;color:#C65353"></span>   Reset Password</a></li>
      <li><a href="logout.php" class="btn btn-default" style="color:#C65353"><span class="glyphicon glyphicon-log-in" style ="font-size:20px;color:#C65353"></span>   Log Out</a></li>
    </ul>
	<!--<ul class="nav navbar-nav navbar-right">
      <li><a href="resetpass.php" class="btn btn-default" ><span class="glyphicon glyphicon-user"></span><b> Reset Password</b></a></li>
      <li><a href="logout.php" class="btn btn-default"><span class="glyphicon glyphicon-log-in"></span><b>   Sign Out</b></a></li>
    </ul>-->
        <h2 style="font-family:Helvetica">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h2><h3 style="color:#C65353; font-family:Helvetica; font-weight:bold;">Welcome to Student Result Management System</h3>
	
    </div>
  
<nav>
 <div class="container">
  <ul class="nav nav-tabs nav-justified">
	<li class="nav-item"><a class="nav-link active" id="add-tab" data-toggle="tab" href="#add" role="tab" aria-controls="add" aria-selected="true">ADD RESULT</a></li>
	
	<li class="nav-item dropdown">
	<a class="nav-link dropdown-toggle" id="manage-tab" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">VIEW / FILTER RESULTS <i class="fa fa-caret-down"></i></a>
	<ul class="dropdown-menu" style="width:220px">
      <?php
		if(isset($_SESSION["usertype"]) && !empty($_SESSION["usertype"]) && $_SESSION["usertype"]=="admin"){
		?>
		<li><a class="dropdown-item" href="#manage-dt" data-toggle="tab" style="background-color:#C65353; color: #FFFFFF; font-weight:bold; font-size:16;" onMouseOver="this.style.color='#ECC6C6'" onMouseout="this.style.color='#FFF'">FILTER DATA TABLE</a></li>
		<?php
		}
		?>
	  <li><a class="dropdown-item" href="#edit" data-toggle="tab" style="background-color:#C65353; color: #FFFFFF; font-weight:bold; font-size:16;" onMouseOver="this.style.color='#ECC6C6'" onMouseout="this.style.color='#FFF'">VIEW DATA TABLE</a></li>
	</ul>
	</li>
	
	
	
	<li class="nav-item dropdown">
	<a class="nav-link dropdown-toggle" id="manage-tab" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">MANAGE DATABASE &nbsp;<i class="fa fa-caret-down"></i></a>
	<ul class="dropdown-menu" style="width:230px">
	  <li><a class="dropdown-item" href="#manage-c" data-toggle="tab" style="background-color:#C65353; color: #FFFFFF; font-weight:bold; font-size:16;" onMouseOver="this.style.color='#ECC6C6'" onMouseout="this.style.color='#FFF'">MANAGE COURSES</a></li>
      <li><a class="dropdown-item" href="#manage-s" data-toggle="tab" style="background-color:#C65353; color: #FFFFFF; font-weight:bold; font-size:16;" onMouseOver="this.style.color='#ECC6C6'" onMouseout="this.style.color='#FFF'">MANAGE SUBJECTS</a></li>
	</ul>
	</li>
	
	<li class="nav-item"><a class="nav-link" id="print-tab" data-toggle="tab" href="#print" role="tab" aria-controls="print" aria-selected="false">STATEMENT OF RESULT</a></li>   
	<li class="nav-item"><a class="nav-link" id="report-tab" data-toggle="tab" href="#report" role="tab" aria-controls="report" aria-selected="false">GENERATE REPORTS</a></li>
	</ul>
<!--<ul class="nav navbar-nav navbar-right">
      <li><a href="resetpass.php"><span class="glyphicon glyphicon-user"></span><b> Reset Password</b></a></li>
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span><b>   Sign Out</b></a></li>
    </ul>-->
<br>
<div class="tab-content">
<div id="add" class="tab-pane fade in active">
<div class="form-style-10" id="resultform">
<form action="insertresult.php" method="POST">

<div class="section"><span>1</span>Student Details : </div>
    <div class="inner-wrap">
	    <label>Index No </label>			<input type="text" name="index" style="width: 450px;"/><br>		
		<label>Name with Initials</label>	<input type="text" name="name1" style="width: 450px;"/><br>
        <label>Full Name</label> 			<input type="text" name="fname" style="width: 450px;"/><br>
        <label>National ID No</label> 		<input type="text" name="nic" style="width: 450px;"/><br>
		<label>Register No </label>		<input type="text" name="regno" style="width: 450px;"/><br>
		
		 <label>Semester</label>
		<select name="semester" style="width: 450px;">
			<option selected disabled>Select Semester</option>
			<option value="Final">Final</option>
			<option value="Final">1<sup>st</sup> Year</option>
			<option value="Final">2<sup>nd</sup> Year</option>
			<option value="Semester 1">Semester 1</option>
			<option value="Semester 2">Semester 2</option>
			<option value="Semester 3">Semester 3</option>
			<option value="Semester 4">Semester 4</option>
		  </select><br>

		
		
		<label>Year	</label>
		<select name="eyear" style="width: 450px;">
			<option selected disabled>Select Year</option>
			<option value="2025">2025</option>
			<option value="2024">2024</option>
			<option value="2023">2023</option>
			<option value="2022">2022</option>
			<option value="2021">2021</option>
			<option value="2020">2020</option>
			<option value="2019">2019</option>
			<option value="2018">2018</option>
			<option value="2017">2017</option>
			<option value="2016">2016</option>
			<option value="2015">2015</option>
			<option value="2014">2014</option>
			<option value="2013">2013</option>
			<option value="2012">2012</option>
			<option value="2011">2011</option>
			<option value="2010">2010</option>
			<option value="2009">2009</option>
			<option value="2008">2008</option>
			<option value="2007">2007</option>
			<option value="2006">2006</option>
			<option value="2005">2005</option>
			<option value="2004">2004</option>
			<option value="2003">2003</option>
			<option value="2002">2002</option>
			<option value="2001">2001</option>
			<option value="2000">2000</option>
			<option value="1999">1999</option>
			<option value="1998">1998</option>
			<option value="1997">1997</option>
			<option value="1996">1996</option>
			<option value="1995">1995</option>
			<option value="1994">1994</option>
			<option value="1993">1993</option>
			<option value="1992">1992</option>
			<option value="1991">1991</option>
			<option value="1990">1990</option>
			<option value="1989">1989</option>
			<option value="1988">1988</option>
			<option value="1987">1987</option>
			<option value="1986">1986</option>
			<option value="1985">1985</option>
			<option value="1984">1984</option>
			<option value="1983">1983</option>
			<option value="1982">1982</option>
			<option value="1981">1981</option>
			<option value="1980">1980</option>
			<option value="1979">1979</option>
			<option value="1978">1978</option>
			<option value="1977">1977</option>
			<option value="1976">1976</option>
			<option value="1975">1975</option>
			<option value="1974">1974</option>
			<option value="1973">1973</option>
			<option value="1972">1972</option>
			<option value="1971">1971</option>
			<option value="1970">1970</option>
			<option value="1969">1969</option>
			<option value="1968">1968</option>
			<option value="1967">1967</option>
			<option value="1966">1966</option>
			<option value="1965">1965</option>
			<option value="1964">1964</option>
			<option value="1963">1963</option>
			<option value="1962">1962</option>
			<option value="1961">1961</option>
			<option value="1960">1960</option>
	</select><br>

		
	<label>Medium</label>
		<select name="medium" style="width: 450px;">
			<option selected disabled>Select Medium</option>
			<option value="Sinhala">Sinhala</option>
			<option value="Tamil">Tamil</option>
			<option value="English">English</option>
			<option value="Korean">Korean</option>
			<option value="Japanese">Japanese</option>
			<option value="Other">Other</option>
		  </select>
	</div>
<br>
<div class="section"><span>2</span>Course, Subjects & Results : </div>
    <div class="inner-wrap">
        <label>Course </label>
		  <select name="courses" style="width: 450px;">
		  <?php 
			$records = mysql_query("SELECT CourseName FROM tblcourses ");
			echo '<option selected disabled>Select Course</option>';
			while ($row = mysql_fetch_array($records)) {
			echo "<option value='" . $row['CourseName'] ."'>" . $row['CourseName'] ."</option>";
				}
			?>
		</select>
	</div>
	<br>
    <div class="inner-wrap">
	<div>
		<table border="0" style="overflow: hidden; border-collapse: separate; border-spacing: 10px;">
		<tr>
		<td width="65%">
		Subject 01 &nbsp;&nbsp;<select name="subject1" style="display:inline-block; width: 300px; color:#000000">
		  <?php 
			 $records = mysql_query("SELECT SubjectName FROM tblsubjects ");
			 echo '<option selected disabled>Select Subject</option>';
			while ($row = mysql_fetch_array($records)) {
			echo "<option value='" . $row['SubjectName'] ."'>" . $row['SubjectName'] ."</option>";
				}
			?>
		</select><br>
		</td>
		<td width="35%">
		Result 01 &nbsp;&nbsp;<select name="Result1" style="display:inline-block; color:#000000">
			<option selected disabled>Select Result</option>
			<option value="Distinction">Distinction</option>
			<option value="Merit">Merit</option>
			<option value="Credit">Credit</option>
			<option value="Pass">Pass</option>
			<option value="Referred">Referred</option>
			<option value="Absent">Absent</option>
			<option value="Withhold">Withhold</option>
		  </select>
		</td>
		</tr>
		<tr>
		<td width="65%">
		  Subject 02 &nbsp;&nbsp;<select name="subject2" style="display:inline-block; width: 300px; color:#000000">
		  <?php 
			 $records = mysql_query("SELECT SubjectName FROM tblsubjects ");
			 echo '<option selected disabled>Select Subject</option>';
			while ($row = mysql_fetch_array($records)) {
			echo "<option value='" . $row['SubjectName'] ."'>" . $row['SubjectName'] ."</option>";
				}
			?>
		</select>
		</td>
		<td width="35%">
		Result 02 &nbsp;&nbsp;<select name="Result2" style="display:inline-block; color:#000000">
			<option selected disabled>Select Result</option>
			<option value="Distinction">Distinction</option>
			<option value="Merit">Merit</option>
			<option value="Credit">Credit</option>
			<option value="Pass">Pass</option>
			<option value="Referred">Referred</option>
			<option value="Absent">Absent</option>
			<option value="Withhold">Withhold</option>
		  </select>
		</td>
		</tr>
		<tr>
		<td width="65%">
		  Subject 03 &nbsp;&nbsp;<select name="subject3" style="display:inline-block; width: 300px; color:#000000">
		  <?php 
			 $records = mysql_query("SELECT SubjectName FROM tblsubjects ");
			 echo '<option selected disabled>Select Subject</option>';
			while ($row = mysql_fetch_array($records)) {
			echo "<option value='" . $row['SubjectName'] ."'>" . $row['SubjectName'] ."</option>";
				}
			?>
		</select>
		</td>
		<td width="35%">

		Result 03 &nbsp;&nbsp;<select name="Result3" style="display:inline-block; color:#000000">
			<option selected disabled>Select Result</option>
			<option value="Distinction">Distinction</option>
			<option value="Merit">Merit</option>
			<option value="Credit">Credit</option>
			<option value="Pass">Pass</option>
			<option value="Referred">Referred</option>
			<option value="Absent">Absent</option>
			<option value="Withhold">Withhold</option>
		  </select>
		</td>
		</tr>
		<tr>
		<td width="65%">
		  Subject 04 &nbsp;&nbsp;<select name="subject4" style="display:inline-block; width: 300px; color:#000000">
		  <?php 
			 $records = mysql_query("SELECT SubjectName FROM tblsubjects ");
			 echo '<option selected disabled>Select Subject</option>';
			while ($row = mysql_fetch_array($records)) {
			echo "<option value='" . $row['SubjectName'] ."'>" . $row['SubjectName'] ."</option>";
				}
			?>
		</select>
		</td>
		<td width="35%">

		Result 04 &nbsp;&nbsp;<select name="Result4" style="display:inline-block; color:#000000">
			<option selected disabled>Select Result</option>
			<option value="Distinction">Distinction</option>
			<option value="Merit">Merit</option>
			<option value="Credit">Credit</option>
			<option value="Pass">Pass</option>
			<option value="Referred">Referred</option>
			<option value="Absent">Absent</option>
			<option value="Withhold">Withhold</option>
		  </select>
		</td>
		</tr>
		<tr>
		<td width="65%">
		  Subject 05 &nbsp;&nbsp;<select name="subject5" style="display:inline-block; width: 300px; color:#000000">
		  <?php 
			 $records = mysql_query("SELECT SubjectName FROM tblsubjects ");
			 echo '<option selected disabled>Select Subject</option>';
			while ($row = mysql_fetch_array($records)) {
			echo "<option value='" . $row['SubjectName'] ."'>" . $row['SubjectName'] ."</option>";
				}
			?>
		</select>
		</td>
		<td width="35%">

		Result 05 &nbsp;&nbsp;<select name="Result5" style="display:inline-block; color:#000000">
			<option selected disabled>Select Result</option>
			<option value="Distinction">Distinction</option>
			<option value="Merit">Merit</option>
			<option value="Credit">Credit</option>
			<option value="Pass">Pass</option>
			<option value="Referred">Referred</option>
			<option value="Absent">Absent</option>
			<option value="Withhold">Withhold</option>
		  </select>
		</td>
		</tr>
		<tr>
		<td width="65%">
		  Subject 06 &nbsp;&nbsp;<select name="subject6" style="display:inline-block; width: 300px; color:#000000">
		  <?php 
			 $records = mysql_query("SELECT SubjectName FROM tblsubjects ");
			 echo '<option selected disabled>Select Subject</option>';
			while ($row = mysql_fetch_array($records)) {
			echo "<option value='" . $row['SubjectName'] ."'>" . $row['SubjectName'] ."</option>";
				}
			?>
		</select>
		</td>
		<td width="35%">

		Result 06 &nbsp;&nbsp;<select name="Result6" style="display:inline-block; color:#000000">
			<option selected disabled>Select Result</option>
			<option value="Distinction">Distinction</option>
			<option value="Merit">Merit</option>
			<option value="Credit">Credit</option>
			<option value="Pass">Pass</option>
			<option value="Referred">Referred</option>
			<option value="Absent">Absent</option>
			<option value="Withhold">Withhold</option>
		  </select>
		</td>
		</tr>
		<tr>
		<td width="65%">
		  Subject 07 &nbsp;&nbsp;<select name="subject7" style="display:inline-block; width: 300px; color:#000000">
		  <?php 
			 $records = mysql_query("SELECT SubjectName FROM tblsubjects ");
			 echo '<option selected disabled>Select Subject</option>';
			while ($row = mysql_fetch_array($records)) {
			echo "<option value='" . $row['SubjectName'] ."'>" . $row['SubjectName'] ."</option>";
				}
			?>
		</select>
		</td>
		<td width="35%">

		Result 07 &nbsp;&nbsp;<select name="Result7" style="display:inline-block; color:#000000">
			<option selected disabled>Select Result</option>
			<option value="Distinction">Distinction</option>
			<option value="Merit">Merit</option>
			<option value="Credit">Credit</option>
			<option value="Pass">Pass</option>
			<option value="Referred">Referred</option>
			<option value="Absent">Absent</option>
			<option value="Withhold">Withhold</option>
		  </select>
		</td>
		</tr>
		<tr>
		<td width="65%">
		  Subject 08 &nbsp;&nbsp;<select name="subject8" style="display:inline-block; width: 300px; color:#000000">
		  <?php 
			 $records = mysql_query("SELECT SubjectName FROM tblsubjects ");
			 echo '<option selected disabled>Select Subject</option>';
			while ($row = mysql_fetch_array($records)) {
			echo "<option value='" . $row['SubjectName'] ."'>" . $row['SubjectName'] ."</option>";
				}
			?>
		</select>
		</td>
		<td width="35%">

		Result 08 &nbsp;&nbsp;<select name="Result8" style="display:inline-block; color:#000000">
			<option selected disabled>Select Result</option>
			<option value="Distinction">Distinction</option>
			<option value="Merit">Merit</option>
			<option value="Credit">Credit</option>
			<option value="Pass">Pass</option>
			<option value="Referred">Referred</option>
			<option value="Absent">Absent</option>
			<option value="Withhold">Withhold</option>
		  </select>
		</td>
		</tr>
		<tr>
		<td width="65%">
		  Subject 09 &nbsp;&nbsp;<select name="subject9" style="display:inline-block; width: 300px; color:#000000">
		  <?php 
			 $records = mysql_query("SELECT SubjectName FROM tblsubjects ");
			 echo '<option selected disabled>Select Subject</option>';
			while ($row = mysql_fetch_array($records)) {
			echo "<option value='" . $row['SubjectName'] ."'>" . $row['SubjectName'] ."</option>";
				}
			?>
		</select>
		</td>
		<td width="35%">

		Result 09 &nbsp;&nbsp;<select name="Result9" style="display:inline-block; color:#000000">
			<option selected disabled>Select Result</option>
			<option value="Distinction">Distinction</option>
			<option value="Merit">Merit</option>
			<option value="Credit">Credit</option>
			<option value="Pass">Pass</option>
			<option value="Referred">Referred</option>
			<option value="Absent">Absent</option>
			<option value="Withhold">Withhold</option>
		  </select>
		</td>
		</tr>
		<tr>
		<td width="65%">
		  Subject 10 &nbsp;&nbsp;<select name="subject10" style="display:inline-block; width: 300px; color:#000000">
		  <?php 
			 $records = mysql_query("SELECT SubjectName FROM tblsubjects ");
			 echo '<option selected disabled>Select Subject</option>';
			while ($row = mysql_fetch_array($records)) {
			echo "<option value='" . $row['SubjectName'] ."'>" . $row['SubjectName'] ."</option>";
				}
			?>
		</select>
		</td>
		<td width="35%">

		Result 10 &nbsp;&nbsp;<select name="Result10" style="display:inline-block; color:#000000">
			<option selected disabled>Select Result</option>
			<option value="Distinction">Distinction</option>
			<option value="Merit">Merit</option>
			<option value="Credit">Credit</option>
			<option value="Pass">Pass</option>
			<option value="Referred">Referred</option>
			<option value="Absent">Absent</option>
			<option value="Withhold">Withhold</option>
		  </select>
		</td>
		</tr>
		<tr>
		<td width="65%">
		  Subject 11 &nbsp;&nbsp;<select name="subject11" style="display:inline-block; width: 300px; color:#000000">
		  <?php 
			 $records = mysql_query("SELECT SubjectName FROM tblsubjects ");
			 echo '<option selected disabled>Select Subject</option>';
			while ($row = mysql_fetch_array($records)) {
			echo "<option value='" . $row['SubjectName'] ."'>" . $row['SubjectName'] ."</option>";
				}
			?>
		</select>
		</td>
		<td width="50%">

		Result 11 &nbsp;&nbsp;<select name="Result11" style="display:inline-block; color:#000000">
			<option selected disabled>Select Result</option>
			<option value="Distinction">Distinction</option>
			<option value="Merit">Merit</option>
			<option value="Credit">Credit</option>
			<option value="Pass">Pass</option>
			<option value="Referred">Referred</option>
			<option value="Absent">Absent</option>
			<option value="Withhold">Withhold</option>
		  </select>
		</td>
		</tr>
		<tr>
		<td width="65%">
		  Subject 12 &nbsp;&nbsp;<select name="subject12" style="display:inline-block; width: 300px; color:#000000">
		  <?php 
			 $records = mysql_query("SELECT SubjectName FROM tblsubjects ");
			 echo '<option selected disabled>Select Subject</option>';
			while ($row = mysql_fetch_array($records)) {
			echo "<option value='" . $row['SubjectName'] ."'>" . $row['SubjectName'] ."</option>";
				}
			?>
		</select>
		</td>
		<td width="35%">
		Result 12 &nbsp;&nbsp;<select name="Result12" style="display:inline-block; color:#000000">
			<option selected disabled>Select Result</option>
			<option value="Distinction">Distinction</option>
			<option value="Merit">Merit</option>
			<option value="Credit">Credit</option>
			<option value="Pass">Pass</option>
			<option value="Referred">Referred</option>
			<option value="Absent">Absent</option>
			<option value="Withhold">Withhold</option>
		  </select>
		</td>
		</tr>
		</table>
	</div>
	</div>
	<br>
    <div class="section"><span>3</span>Final Result :</div>
	<div class="inner-wrap">
	<div>	
		<label>Final Grade	 </label>
		<select name="finres" style="width: 450px">
		<option selected disabled>Select Result</option>
			<option value="Distinction">Distinction</option>
			<option value="Credit">Credit</option>
			<option value="Merit">Merit</option>
			<option value="Pass">Pass</option>
			<option value="Pass">Referred</option>
			<option value="Pass">Fail</option>
			<option value="Qualified">Qualified</option>
			<option value="Not Qualified">Not Qualified</option>
		  </select>
	</div>
    </div>
		<br>
		<!--<div class="section"><span>4</span>Qualification Status :</div>
	    <div class="inner-wrap">
		<label>Qualification Status	 </label>
		<select name="qualify">
		<option selected disabled>Select Qualification</option>
			<option value="Qualified">Qualified</option>
			<option value="Not Qualified">Not Qualified</option>
			<option value="Referred">Referred</option>
			<option value="Fail">Fail</option>
		  </select>

		</div>-->
		<br>
    <div class="button-section">
     <input type="submit" name="submit" />
    </div>

</form>
</div>
</div>



<!--=================END OF ADD RESULT PAGE========================================-->	
	
<div id="edit" class="tab-pane fade">
<div class="row-fluid">
        <div class="span12">
            <div class="container">

                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                            <thead>
                                <tr>
								<?php
								if(isset($_SESSION["usertype"]) && !empty($_SESSION["usertype"]) && $_SESSION["usertype"]=="admin"){
								?>
								<th>Edit</th>
								<th>Delete</th>
								<?php
								}
								?>
								<th>Index No</th>
								<th>Registered No</th>								
								<th>Name with Initial</th>
								<th>Full Name</th>								
								<th>NIC No</th>
								<th>Course Name</th> 
								<th>Semester</th> 
								<th>Exam Year</th> 
								<th>Exam Medium</th>
								<th>Subject1</th>
								<th>Result1</th>
								<th>Subject2</th> 
								<th>Result2</th>
								<th>Subject3</th> 
								<th>Result3</th> 
								<th>Subject4</th>
								<th>Result4</th> 
								<th>Subject5</th>
								<th>Result5</th>
								<th>Subject6</th>
								<th>Result6</th>
								<th>Subject7</th>
								<th>Result7</th>
								<th>Subject8</th>
								<th>Result8</th>
								<th>Subject9</th>
								<th>Result9</th>
								<th>Subject10</th>
								<th>Result10</th>
								<th>Subject11</th>
								<th>Result11</th>
								<th>Subject12</th>								
								<th>Result12</th>
								<th>Final Grade</th> 
                                </tr>
                            </thead>
                            <tbody>
								<tr>
								<?php
								$result= mysql_query("select * from tblexamresult order by IndexNo DESC") or die (mysqli_error($con));
								while ($res= mysql_fetch_array ($result) ){
								$index=$res['IndexNo'];
								if(isset($_SESSION["usertype"]) && !empty($_SESSION["usertype"]) && $_SESSION["usertype"]=="admin"){
								echo"<td><a data-toggle='modal' class='btn btn-warning btn-sm' id=\"editbtn\" onClick=\"window.open('editresults.php?index=$res[IndexNo]','Update Course Details','width=600,height=600')\"><span class='glyphicon glyphicon-edit' style='font-size:18px;color:#FFFFFF;'></span></a></td>";
								echo"<td><a data-toggle='modal' class='btn btn-danger btn-sm' id=\"dltbtn\" onClick=\"window.open('deleteresults.php?index=$res[IndexNo]','Delete Course Details','width=600,height=600')\"><span class='glyphicon glyphicon-trash' style='font-size:18px;color:#FFFFFF;'></span></a></td>";
								}
								echo "<td>".$res['IndexNo']."</td>";
								echo "<td>".$res['RegNo']."</td>";
								echo "<td>".$res['InitName']."</td>";
								echo "<td>".$res['FullName']."</td>";
								echo "<td>".$res['NIC']."</td>";
								echo "<td>".$res['CourseName']."</td>";
								echo "<td>".$res['Semester']."</td>";
								echo "<td>".$res['ExamYear']."</td>";
								echo "<td>".$res['ExamMedium']."</td>";
								echo "<td>".$res['Subject1']."</td>";
								echo "<td>".$res['Result1']."</td>";
								echo "<td>".$res['Subject2']."</td>";
								echo "<td>".$res['Result2']."</td>";        
								echo "<td>".$res['Subject3']."</td>";
								echo "<td>".$res['Result3']."</td>";
								echo "<td>".$res['Subject4']."</td>";
								echo "<td>".$res['Result4']."</td>";
								echo "<td>".$res['Subject5']."</td>";
								echo "<td>".$res['Result5']."</td>";
								echo "<td>".$res['Subject6']."</td>";
								echo "<td>".$res['Result6']."</td>";
								echo "<td>".$res['Subject7']."</td>";
								echo "<td>".$res['Result7']."</td>";
								echo "<td>".$res['Subject8']."</td>";
								echo "<td>".$res['Result8']."</td>";
								echo "<td>".$res['Subject9']."</td>";
								echo "<td>".$res['Result9']."</td>";
								echo "<td>".$res['Subject10']."</td>";
								echo "<td>".$res['Result10']."</td>";
								echo "<td>".$res['Subject11']."</td>";
								echo "<td>".$res['Result11']."</td>";
								echo "<td>".$res['Subject12']."</td>";
								echo "<td>".$res['Result12']."</td>";
								echo "<td>".$res['FinalResult']."</td>";
								?>
										
								</tr>

								<?php } ?>
                            </tbody>
                        </table>


          
        </div>
        </div>
    </div>
    </div>


<!--====================================END OF EDIT RESULTS PAGE===================================-->	
	
	
	<div id="manage-dt" class="tab-pane fade">
		<div class="form-style-10">
			<form action="filterdata.php" target="_blank" method="POST">				
			<div class="section" style="font-size:22px; font-weight:bold; font-family:Helvetica;"> View Records of a Selected Course : </div>
			<br>
				<div class="inner-wrap">			
					<label>Exam Year</label><input type="text" name="year" placeholder="Type Year.." style="width:500px;"><br>
					<label>Name of the Course </label>
					<select name="coname" style="width:500px;">
					<?php 
					$con = mysql_connect("localhost","root","");
					if (!$con)
					  {
					  die('Could not connect: ' . mysql_error());
					  }

					mysql_select_db("dbrms", $con);
					$records = mysql_query("SELECT CourseName FROM tblcourses ");
					echo '<option selected disabled>Select Course</option>';
					while ($row = mysql_fetch_array($records)) {
					echo "<option value='" . $row['CourseName'] ."'>" . $row['CourseName'] ."</option>";
						}
					?>
					</select>
					<br>
					<label>Semester</label>
					<select name="semes"  style="width:500px;">
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
					<div class="button-section"><input type="submit" value="View Students" name="btnstd"></div>
				</div>
			</form>
			</div>
			</div>
	
	
    <div id="manage-c" class="tab-pane fade">
		<div class="form-style-10">
			<form action="insertcourse.php" method="POST">	
			<div class="col-sm-6" style="float:right;">
				<a  class='btn btn-warning btn-lg' onClick="window.open('editcourse.php','Update Course Details','width=600,height=500')"><i class="fa fa-edit"></i> <span>EDIT COURSE</span></a>&nbsp;&nbsp;
				<a  class='btn btn-danger btn-lg' onClick="window.open('deletecourse.php','Delete Course Details','width=600,height=500')"><i class="fa fa-trash"></i> <span>DELETE COURSE</span></a>
			</div>			
			<div class="section" style="font-size:22px; font-weight:bold; font-family:Helvetica;"> Add New Course to Database : </div>
			<br>
				<div class="inner-wrap">			
					<label>Course Code</label><input type="text" name="ccode" style="width:500px;"/><br>
					<label>Course Name</label><input type="text" name="cname"style="width:500px;" /><br>

				<label>Course Medium</label>
					<select name="cmedium" style="width:500px;">
					<option selected disabled>Select Medium</option>
						<option value="Sinhala">Sinhala</option>
						<option value="Tamil">Tamil</option>
						<option value="English">English</option>
						<option value="Korean">Korean</option>
						<option value="Japanese">Japanese</option>
					 </select>
					<br><br>
					<span> <input type="radio" name="ctype" value="Full Time" style="transform: scale(1.5)">&nbsp;&nbsp;Full Time</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<span> <input type="radio" name="ctype" value="Part Time" style="transform: scale(1.5)">&nbsp;&nbsp;Part Time</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<br><br>
					<div class="button-section"><input type="submit" name="submit" /></div>
				</div>
			</form>
			</div>
			</div>

 <div id="manage-s" class="tab-pane fade">
	<div class="form-style-10">
			<form action="insertsubject.php" method="POST">
			<div class="col-sm-6" style="float:right;">
				<a  class='btn btn-warning btn-lg' onClick="window.open('editsubject.php','Update Subject Details','width=600,height=500')"><i class="fa fa-edit"></i> <span>EDIT SUBJECT<span></a>&nbsp;&nbsp;
				<a  class='btn btn-danger btn-lg' onClick="window.open('deletesubject.php','Delete Subject Details','width=600,height=500')"><i class="fa fa-trash"></i> <span>DELETE SUBJECT</span></a>						
			</div>
				<div class="section" style="font-size:22px; font-weight:bold; font-family:Helvetica;">Add New Subject to Database : </div>
				<br>
				<div class="inner-wrap">
					<label>Subject Code</label> <input type="text" name="sno" style="width:500px;"/><br>
					<label>Subject Name</label><input type="text" name="sname" style="width:500px;"/>
					<br><br>
					<div class="button-section"><input type="submit" name="submit" /></div>
				</div>
			</form>
		</div>
    </div>

	
<div id="print" class="tab-pane fade">
<div class="form-style-10">
			<form action="" method="POST">
				<div class="section" style="font-size:20px; font-weight:bold; font-family:Helvetica;">Click the Icon for Desired Report</div>
				<div class="inner-wrap">
					<table style="border-collapse:separate; border-spacing:0 45px; margin-top:-15px;">
												
						<tr>
						<td style='font-size:20px;font-weight:bold;color:#C65353;'>Final Statement (Six-Month Courses)</td>
						<td width="50%" align="center"><a data-toggle='modal' class='btn btn-success btn-lg' onClick="window.open('finalsixmonth.php','Generate Result in PDF','width=800,height=800')"><span class='glyphicon glyphicon-save-file' style='font-size:20px;color:#FFFFFF;'></span></a></td>
						</tr>
						
						<tr>
						<td style='font-size:20px;font-weight:bold;color:#C65353;'>Final Statement (One-Year Courses)</td>
						<td width="50%" align="center"><a data-toggle='modal' class='btn btn-success btn-lg' onClick="window.open('finaloneyear.php','Generate Result in PDF','width=800,height=800')"><span class='glyphicon glyphicon-save-file' style='font-size:20px;color:#FFFFFF;'></span></a></td>
						</tr>
						
						<tr>
						<td style='font-size:20px;font-weight:bold;color:#C65353;'>1<sup>st</sup> Year Statement (Two-Year Courses)</td>
						<td width="50%" align="center"><a data-toggle='modal' class='btn btn-success btn-lg' onClick="window.open('sem1twoyear.php','Generate Result in PDF','width=800,height=800')"><span class='glyphicon glyphicon-save-file' style='font-size:20px;color:#FFFFFF;'></span></a></td>
						</tr>
						
						<tr>
						<td style='font-size:20px;font-weight:bold;color:#C65353;'>Final Statement (Two-Year Courses)</td>
						<td width="50%" align="center"><a data-toggle='modal' class='btn btn-success btn-lg' onClick="window.open('finaltwoyear.php','Generate Result in PDF','width=800,height=800')"><span class='glyphicon glyphicon-save-file' style='font-size:20px;color:#FFFFFF;'></span></a></td>
						</tr>
						
						<tr>
						<td style='font-size:20px;font-weight:bold;color:#C65353;'>NCT - Semester Statement</td>
						<td width="50%" align="center"><a data-toggle='modal' class='btn btn-success btn-lg' onClick="window.open('nctsem123.php','Generate Result in PDF','width=800,height=800')"><span class='glyphicon glyphicon-save-file' style='font-size:20px;color:#FFFFFF;'></span></a></td>
						</tr>
						
						<tr>
						<td style='font-size:20px;font-weight:bold;color:#C65353;'>Level 5 & 6 - Semester Statement</td>
						<td width="50%" align="center"><a data-toggle='modal' class='btn btn-success btn-lg' onClick="window.open('level56sem.php','Generate Result in PDF','width=800,height=800')"><span class='glyphicon glyphicon-save-file' style='font-size:20px;color:#FFFFFF;'></span></a></td>
						</tr>
						
						<tr>
						<td style='font-size:20px;font-weight:bold;color:#C65353;'>Level 5 & 6 - Final Statement Letter</td>
						<td width="50%" align="center"><a data-toggle='modal' class='btn btn-success btn-lg' onClick="window.open('level56final.php','Generate Result in PDF','width=800,height=800')"><span class='glyphicon glyphicon-save-file' style='font-size:20px;color:#FFFFFF;'></span></a></td>
						</tr>
					</table>
				</div>
			</form>
</div>
</div>



    <div id="report" class="tab-pane fade">
		<div class="form-style-10">
			<form action="" method="POST">
				<div class="section" style="font-size:20px; font-weight:bold; font-family:Helvetica;">Click the Icon for Desired Report</div>
				<div class="inner-wrap">
					<table style="border-collapse:separate; border-spacing:0 45px; margin-top:-15px;">
						<tr>
						<td style='font-size:20px;font-weight:bold;color:#C65353;'>Result Sheet - Individual </td>
						<td width="50%" align="center"><a data-toggle='modal' class='btn btn-success btn-lg' onClick="window.open('genresultpdf.php','Generate Result in PDF','width=800,height=700')"><span class='glyphicon glyphicon-save-file' style='font-size:20px;color:#FFFFFF;'></span></a></td>
						</tr>
						
						<tr>
						<td style='font-size:20px;font-weight:bold;color:#C65353;'>Result Sheet - Two-Year - Final </td>
						<td width="50%" align="center"><a data-toggle='modal' class='btn btn-success btn-lg' onClick="window.open('gentwoyearfinal.php','Generate Result in PDF','width=800,height=700')"><span class='glyphicon glyphicon-save-file' style='font-size:20px;color:#FFFFFF;'></span></a></td>
						</tr>
						
						<tr>
						<td style='font-size:20px;font-weight:bold;color:#C65353;'>Result Sheet - NCT - Final </td>
						<td width="50%" align="center"><a data-toggle='modal' class='btn btn-success btn-lg' onClick="window.open('gennctfinal.php','Generate Result in PDF','width=800,height=800')"><span class='glyphicon glyphicon-save-file' style='font-size:20px;color:#FFFFFF;'></span></a></td>
						</tr>
						
						<tr>
						<td style='font-size:20px;font-weight:bold;color:#C65353;'>Passed-out Students </td>
						<td width="50%" align="center"><a data-toggle='modal' class='btn btn-success btn-lg' onClick="window.open('genpassedstd.php','Generate Result in PDF','width=800,height=800')"><span class='glyphicon glyphicon-save-file' style='font-size:20px;color:#FFFFFF;'></span></a></td>
						</tr>
					</table>
				</div>
			</form>
</div>
</div>
	
	<div id="menu3" class="tab-pane fade">
      <h3>Menu 3</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
    </div>
	
    <div id="delete" class="tab-pane fade">
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
	</div>
	
	<div id="menu3" class="tab-pane fade">
      <h3>Menu 3</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
	</div>
	
    <div id="delete" class="tab-pane fade">
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
	
    <div id="menu3" class="tab-pane fade">
      <h3>Menu 3</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
    </div>
	
</div>
</nav>
<span class="copyright" style="float: right; width: 100%; font: 12px Arial, Helvetica, sans-serif; color: #4D4D4D; margin-top: 5px; text-align: right;">
    Designed and Developed by: G. Faheema Junaideen (ICT Officer), BSc (Hons) in Computing - Open University,United Kingdom &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;01st of November 2018
</span>
</body>
</html>