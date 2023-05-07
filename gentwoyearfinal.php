<?php

	function fetch_data()
	{
		$output='';
		$con = mysqli_connect("localhost","root","", "dbrms");
		if (isset($_POST['coname']) AND isset($_POST['inre']) AND isset($_POST['year1']) AND isset($_POST['year2'])){
		$coname =$_POST['coname'];
		$inre =$_POST['inre'];
		$year1 =$_POST['year1'];
		$year2 =$_POST['year2'];
		$query="SELECT * FROM tblexamresult WHERE CourseName='$coname' AND IndexNo='$inre' ORDER BY Semester ASC " ;
		$result=mysqli_query($con,$query) or die(mysqli_error($con));
		
			while($row= mysqli_fetch_array($result))
			{	
				if (($row["IndexNo"]="$inre") && ($row["Semester"]="Semester 1") && ($row["ExamYear"]="$year1")){
			$output.='
					<tr>
						<td rowspan="12" width="15%" align="center">'.$year1.'</td>
						<td rowspan="12" width="15%" align="center">Semester 01</td>
						<td width="40%">'.$row["Subject1"].'</td>
						<td width="15%">'.$row["Result1"].'</td>
						<td rowspan="12" width="15%" align="center">'.$row["FinalResult"].'</td>
					</tr>
					<tr>
						<td >'.$row["Subject2"].'</td>
						<td >'.$row["Result2"].'</td>
					</tr>
					<tr>
						<td >'.$row["Subject3"].'</td>
						<td >'.$row["Result3"].'</td>
					</tr>
					<tr>
						<td >'.$row["Subject4"].'</td>
						<td >'.$row["Result4"].'</td>
					</tr>
					<tr>
						<td >'.$row["Subject5"].'</td>
						<td >'.$row["Result5"].'</td>
					</tr>
					<tr>
						<td >'.$row["Subject6"].'</td>
						<td >'.$row["Result6"].'</td>
					</tr>
					<tr>
						<td >'.$row["Subject7"].'</td>
						<td >'.$row["Result7"].'</td>
					</tr>
					<tr>
						<td >'.$row["Subject8"].'</td>
						<td >'.$row["Result8"].'</td>
					</tr>
					<tr>
						<td >'.$row["Subject9"].'</td>
						<td >'.$row["Result9"].'</td>
					</tr>
					<tr>
						<td >'.$row["Subject10"].'</td>
						<td >'.$row["Result10"].'</td>
					</tr>
					<tr>
						<td >'.$row["Subject11"].'</td>
						<td >'.$row["Result11"].'</td>
					</tr>
					<tr>
						<td >'.$row["Subject12"].'</td>
						<td >'.$row["Result12"].'</td>
					</tr>
				';}
					if (($row["IndexNo"]="$inre") && ($row["Semester"]="Semester 2") && ($row["ExamYear"]="$year2")){
			$output.='
					<tr>
						<td rowspan="12" width="15%" align="center">'.$year2.'</td>
						<td rowspan="12" width="15%" align="center">Semester 02</td>
						<td width="40%">'.$row["Subject1"].'</td>
						<td width="15%">'.$row["Result1"].'</td>
						<td rowspan="12" width="15%" align="center">'.$row["FinalResult"].'</td>
					</tr>
					<tr>
						<td >'.$row["Subject2"].'</td>
						<td >'.$row["Result2"].'</td>
					</tr>
					<tr>
						<td >'.$row["Subject3"].'</td>
						<td >'.$row["Result3"].'</td>
					</tr>
					<tr>
						<td >'.$row["Subject4"].'</td>
						<td >'.$row["Result4"].'</td>
					</tr>
					<tr>
						<td >'.$row["Subject5"].'</td>
						<td >'.$row["Result5"].'</td>
					</tr>
					<tr>
						<td >'.$row["Subject6"].'</td>
						<td >'.$row["Result6"].'</td>
					</tr>
					<tr>
						<td >'.$row["Subject7"].'</td>
						<td >'.$row["Result7"].'</td>
					</tr>
					<tr>
						<td >'.$row["Subject8"].'</td>
						<td >'.$row["Result8"].'</td>
					</tr>
					<tr>
						<td >'.$row["Subject9"].'</td>
						<td >'.$row["Result9"].'</td>
					</tr>
					<tr>
						<td >'.$row["Subject10"].'</td>
						<td >'.$row["Result10"].'</td>
					</tr>
					<tr>
						<td >'.$row["Subject11"].'</td>
						<td >'.$row["Result11"].'</td>
					</tr>
					<tr>
						<td >'.$row["Subject12"].'</td>
						<td >'.$row["Result12"].'</td>
					</tr>
				';
					}
		return $output;
			}
		}
	}
	 if(isset($_POST["create_pdf"]))  
 {  
		$coname =$_POST['coname'];
		$inre =$_POST['inre'];
		$year =$_POST['year1'];
		$year =$_POST['year2'];
		$con = mysqli_connect("localhost","root","", "dbrms");
		$query="SELECT * FROM tblexamresult WHERE CourseName='$coname' AND IndexNo='$inre' ORDER BY Semester ASC " ;
		$result=mysqli_query($con,$query) or die(mysqli_error($con));
		$row= mysqli_fetch_array($result);
      require_once('tcpdf/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("Result Sheet");  
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');  
	  $obj_pdf->SetHeaderMargin('1');
      $obj_pdf->SetFooterMargin('1'); 
      $obj_pdf->SetMargins('2','1','1','1');  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 2);  
      $obj_pdf->SetFont('helvetica', '', 12);  
      $obj_pdf->AddPage();  
      $content = '';  
      $content .= ' <h4 align="right">'.date("Y-m-d").'</h4>	  
      <h3 align="center"><u>To whom it may concern</u></h3>
		<h4>Course :'.$coname.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Medium :'.$row['ExamMedium'].'</h4>
		<h4>Name : '.$row['FullName'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Index No :'.$inre.'</h4>	  	  
      <table border="1" cellspacing="1" cellpadding="1">
	  <tr>
		<th align="center" width="15%"><b>Subject</b></th>
		<th align="center" width="15%"><b>Result</b></th>
		<th align="center" width="40%"><b>Subject</b></th>
		<th align="center" width="15%"><b>Result</b></th>
		<th align="center" width="15%"><b>Final Result</b></th>
	</tr>';  
      $content .= fetch_data();  
      $content .= '</table>';	  
      $obj_pdf->writeHTML($content);
      $obj_pdf->Output('genfinaltwoyr.pdf', 'I');
 }
	
?>


<!DOCTYPE HTML>
<html>
<head> <title>Result Sheet-Two-Year-Final-PDF</title>
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
<h3 align="center" style="color:#C65353"><p>Generate Final Result Sheet </p><p>for Two-Year Courses</p></h3>
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
			<label>Index No/Reg.No</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="inre" placeholder="Type Index No.." ><br><br>
			<label>Semester 01 Exam Year</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="year1" placeholder="Type Year.." ><br><br>
			<label>Semester 02 Exam Year</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="year2" placeholder="Type Year.." ><br><br>
					<?php
						  
                     echo fetch_data(); 					 
                     ?>
			<br><br>
			<input type="submit" name="create_pdf" class="btn btn-danger" value="Generate Report in PDF" />    
			</form>
	</div>
</body>
</html> 
