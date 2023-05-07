<?php

	function fetch_data()
	{
		$output='';
		$con = mysqli_connect("localhost","root","", "dbrms");
		if (isset($_POST['inre']) AND isset($_POST['year']) AND isset($_POST['acyr1']) AND isset($_POST['acyr2']) AND isset($_POST['semes'])){
		$inre =$_POST['inre'];
		$year =$_POST['year'];
		$acyr1 =$_POST['acyr1'];
		$acyr2 =$_POST['acyr2'];
		$semes =$_POST['semes'];
		$query="SELECT * FROM tblexamresult WHERE IndexNo='$inre' AND Semester='$semes' AND ExamYear='$year' " ;
		$result=mysqli_query($con,$query) or die(mysqli_error($con));
			while($row= mysqli_fetch_array($result))
			{		
			$output.='<h4 align="right">'.date("Y-m-d").'</h4>
					<h3 align="center"><u>STATEMENT OF RESULTS</u></h3>
					<p align="justify">This is to certify that <b>Ms./Mr. ' .$row["InitName"]. '(Reg. No. '.$row["RegNo"].')</b> has /is being followed the three-year part time course leading to <b>'.$row["CourseName"].'
					 </b>(National Vocational Qualification - Level 5) at this Institute for three consecutive academic years commenced from <b>'.$acyr1.'</b> to <b>'.$acyr2.'</b>.</p>
					<p align="justify">He/She has appeared for the <b> First /Second/ Third Year ('.$semes.') </b>Written Examination conducted by the Department of Technical Education & Training under the<b> Index No ' .$row["IndexNo"].'</b> in <b>December '.$row["ExamYear"].'</b> in <b>'.$row["ExamMedium"].'
						 Medium</b> and has obtained the results indicated against the following subjects.</p>
					<table border="0" cellpadding="1">
					<tr>
						<th align="center" width="60%"><b><u>Subject</u></b></th>
						<th align="center" width="40%"><b><u>Result</u></b></th>
					</tr>
					<tr>
						<td width="60%">'.$row["Subject1"].'</td>
						<td width="40%">'.$row["Result1"].'</td>
					</tr>
					<tr>
						<td width="60%">'.$row["Subject2"].'</td>
						<td width="40%">'.$row["Result2"].'</td>
					</tr>
					<tr>
						<td width="60%">'.$row["Subject3"].'</td>
						<td width="40%">'.$row["Result3"].'</td>
					</tr>
					<tr>
						<td width="60%">'.$row["Subject4"].'</td>
						<td width="40%">'.$row["Result4"].'</td>
					</tr>
					<tr>
						<td width="60%">'.$row["Subject5"].'</td>
						<td width="40%">'.$row["Result5"].'</td>
					</tr>
					<tr>
						<td width="60%">'.$row["Subject6"].'</td>
						<td width="40%">'.$row["Result6"].'</td>
					</tr>
					<tr>
						<td width="60%">'.$row["Subject7"].'</td>
						<td width="40%">'.$row["Result7"].'</td>
					</tr>
					<tr>
						<td width="60%">'.$row["Subject8"].'</td>
						<td width="40%">'.$row["Result8"].'</td>
					</tr>
					<tr>
						<td width="60%">'.$row["Subject9"].'</td>
						<td width="40%">'.$row["Result9"].'</td>
					</tr>
					<tr>
						<td width="60%">'.$row["Subject10"].'</td>
						<td width="40%">'.$row["Result10"].'</td>
					</tr>
					<tr>
						<td width="60%">'.$row["Subject11"].'</td>
						<td width="40%">'.$row["Result11"].'</td>
					</tr>
					<tr>
						<td width="60%">'.$row["Subject12"].'</td>
						<td width="40%">'.$row["Result12"].'</td>
					</tr>
					</table>
					<table>
					<tr>
						<th>Final Result :</th>
						<td><b>'.$row["FinalResult"].'</b></td>
					</tr>
					</table>
					<br><br>
					<table>
					<tr>
					<td width="50%">Checked by : .........................</td>
					<td width="50%"></td>
					</tr>
					<tr>
					<td width="50%"></td>
					<td width="50%"></td>
					</tr>
					<tr>
					<td width="50%" align="left">..............................</td>
					<td width="50%" align="left">..............................</td>
					</tr>
					<tr>
					<td width="50%" align="left">Registrar</td>
					<td width="50%" align="left">Director/Principal</td>
					</tr>
					</table>
					';
			}
		return $output;
			}
		
	}
	 if(isset($_POST["create_pdf"]))  
 {  
		$inre =$_POST['inre'];
		$year =$_POST['year'];
		$acyr1 =$_POST['acyr1'];
		$acyr2 =$_POST['acyr2'];
      require_once('tcpdf/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("NCT Semester Statement");  
      $obj_pdf->SetHeaderData(PDF_HEADER_LOGO, 18, 5, PDF_HEADER_LOGO_WIDTH, array(0,0,0), array(255,255,255),'', 'JPEG', '', 'N', false, 300, 'R', false, false, 0, false, false, false);
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('Helvetica');
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	  $obj_pdf->SetFooterData(array(0,0,0), array(0,0,0));
	  $obj_pdf->SetY(-5);	  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '9', PDF_MARGIN_RIGHT, PDF_MARGIN_TOP);  
      $obj_pdf->setPrintHeader(true);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 1);  
      $obj_pdf->SetFont('helvetica', '', 12);  
      $obj_pdf->AddPage();
      $content = '';  
      $content .= ' 	  
      <table border="0" cellspacing="0" cellpadding="0">
		';  
      $content .= fetch_data();  
      $content .= '</table>';	  
      $obj_pdf->writeHTML($content);
      $obj_pdf->Output('nctsemester.pdf', 'I');
 }
	
?>


<!DOCTYPE HTML>
<html>
<head> <title>Statement of Result</title>
<style type="text/css">
.form1{
	margin:35px 10px 10px 10px;
    width: 700px;
	display:block;
	align:justify;
    background: #EFEFEF;
    padding: 10px;
    box-shadow: 1px 1px 25px rgba(0, 0, 0, 0.35);
    border-radius: 10px;
    border: 6px solid #C65353;
	float:left;
}
 
.form1 input[type="text"],
.form1 select {
    background-color: #efefef;
    border: 2px solid #C65353;
    display: inline;
	width:50;
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
<h3 align="center" style="color:#C65353"><p>Generate Statement of Result</p><p>for Semesters in NCT Courses</p></h3>
<br></div>
<div id="divform1">
	<form  class="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<label>Index No/Reg.No</label><input type="text" name="inre" placeholder="Type Index.." ><br><br>
			<label>Exam Year &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><input type="text" name="year" placeholder="Type Exam Year.." ><br><br>
			<label>Semester &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
			<select name="semes" >
				<option value="" selected disabled>Select Semester</option>
				<option value="Semester 1">Semester 1</option>
				<option value="Semester 2">Semester 2</option>
				<option value="Semester 3">Semester 3</option>
			</select><br><br>
			<label>Academic Years</label>&nbsp;<input type="text" name="acyr1" placeholder="Starting Year.." > to <input type="text" name="acyr2" placeholder="Ending Year.." >
			<br><br>
					<?php
						  
                     echo fetch_data(); 					 
                     ?>
			<br><br>
			<input type="submit" name="create_pdf" class="btn btn-danger" value="Generate Report in PDF" />    
			</form>
	</div>
</body>
</html> 
