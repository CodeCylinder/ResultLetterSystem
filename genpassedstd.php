<?php

	function fetch_data()
	{
		$output='';
		$con = mysqli_connect("localhost","root","", "dbrms");
		if (isset($_POST['coname']) AND isset($_POST['semes']) AND isset($_POST['year'])AND isset($_POST['med']) ){
		$coname =$_POST['coname'];
		$semes =$_POST['semes'];
		$year =$_POST['year'];
		$med =$_POST['med'];
		$query="SELECT * FROM tblstudents WHERE CourseName='$coname' AND Semester='$semes' AND ExamYear='$year' ORDER BY RegNo ASC " ;
		$result=mysqli_query($con,$query) or die(mysqli_error($con));
			while($row= mysqli_fetch_array($result))
			{		
			$output.='<tr>
						<td>'.$row["RegNo"].'</td>
						<td>'.$row["IndexNo"].'</td>
						<td>'.$row["FullName"].'</td>
						<td>'.$row["NIC"].'</td>
						<td>'.$row["FinalResult"].'</td>
					</tr>';
			}
		return $output;
			}
		
	}
	 if(isset($_POST["create_pdf"]))  
 {  
		$coname =$_POST['coname'];
		$semes =$_POST['semes'];
		$year =$_POST['year'];
		$med=$_POST['med'];
      require_once('tcpdf/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("Passed-out Students");  
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins('2','1','1','1');  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(true);  
      $obj_pdf->SetAutoPageBreak(TRUE, 1);  
      $obj_pdf->SetFont('helvetica', '', 12);  
      $obj_pdf->AddPage();  
      $content = '';  
      $content .= '<h4 align="right">'.date("Y-m-d").'</h4>	  
      <h3 align="center"><u>List of Passed-out Students</u></h3><br /><br /> 
		<h4>Course :  '.$coname.'</h4>
		<h4>Year :   '.$year.'</h4>
		<h4>Semester/Year : '.$semes.'</h4>
		<h4>Medium : '.$med.'</h4>		
      <table border="0.5" cellspacing="1" cellpadding="1">
	  <tr align="center">
		<th width="12%"><b>Reg. No</b></th>
		<th width="12%"><b>Index No</b></th>
		<th width="40%"><b>Full Name</b></th>
		<th width="14%"><b>NIC No</b></th>
		<th width="12%"><b>Final Result</b></th>
	  </tr>';  
      $content .= fetch_data();  
      $content .= '</table>';	  
      $obj_pdf->writeHTML($content);
      $obj_pdf->Output('studentlist.pdf', 'I');
 }
	
?>


<!DOCTYPE HTML>
<html>
<head> <title>Passed-out Students</title>
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
</style>
</head>
<body>
<div class="modal-header" id ="modalheader" >
<h3 align="center" style="color:#C65353"><p>Generate List</p> of Passed-out Students<p>based on name of the Course</p></h3>
<br></div>
<div id="divform1" align="justify">
	<form  class="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<label>Name of the Course </label>
			<select name="coname">
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
			<br><br>
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
			</select><br><br>
			
			<label>Medium</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<select name="med">
			<option selected disabled>Select Medium</option>
			<option value="Sinhala">Sinhala</option>
			<option value="Tamil">Tamil</option>
			<option value="English">English</option>
			<option value="Korean">Korean</option>
			<option value="Japanese">Japanese</option>
			<option value="Other">Other</option>
			</select><br><br>
			
			<label>Exam Year</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="year" placeholder="Type Year.." >
					<?php
						  
                     echo fetch_data(); 					 
                     ?>
			<br><br>
			<input type="submit" name="create_pdf" class="btn btn-danger" value="Generate Report in PDF" />    
			</form>
	</div>
</body>
</html> 
