<?php

	function fetch_data()
	{
		$output='';
		$con = mysqli_connect("localhost","root","", "dbrms");
		if (isset($_POST['inre']) AND isset($_POST['acyr1']) AND isset($_POST['acyr2']) AND isset($_POST['exyear1']) AND isset($_POST['exyear2']) AND isset($_POST['exmonth1']) AND isset($_POST['exmonth2'])){
		$inre =$_POST['inre'];
		$acyr1 =$_POST['acyr1'];
		$acyr2 =$_POST['acyr2'];
		$exyear1 =$_POST['exyear1'];
		$exyear2 =$_POST['exyear2'];
		$exmonth1 =$_POST['exmonth1'];
		$exmonth2 =$_POST['exmonth2'];
		$query="SELECT * FROM tblexamresult WHERE IndexNo='$inre' OR RegNo='$inre' AND ExamYear='$exyear1'" ;
		$result=mysqli_query($con,$query) or die(mysqli_error($con));
			while($row= mysqli_fetch_array($result))
			{		
			$output.='<h4 align="right">'.date("Y-m-d").'</h4>
					<h3 align="center"><u>STATEMENT OF RESULTS</u></h3>
					<p align="justify" style="font-size:100%">This is to certify that <b>Ms./Mr. ' .$row["InitName"]. '(Reg. No. '.$row["RegNo"].')</b>has followed the one year full time course leading to <b>'.$row["CourseName"].'
					 </b>(National Vocational Qualification - Level 5/Level 6) at this Institute during the academic years of <b>'.$acyr1.'</b> to <b>'.$acyr2.'</b>.</p><br>
					<p align="justify" style="font-size:100%">He/She has appeared for Written Examination in all the semesters conducted by the Department of Technical Education & Training under the<b> Index No ' .$row["IndexNo"].'</b> in <b>'.$exmonth1.' '.$exyear1.' and <b>'.$exmonth2.' '.$exyear2.'</b> in <b>'.$row["ExamMedium"].'
						 Medium</b> and has obtained the results indicated against the subjects stated in the annexure.</p><br>
					<p align="justify" style="font-size:100%">The student will be eligible to sit for the final assessment only after successful completion of the written examinations and the six-month industrial training. The formal NVQ certificate will be 
					issued by the Tertiary & Vocational Education Commission (TVEC) after completing the final assessment.</p>
					<br><br><br><br>
					<hr>
					<table>
					<tr>
					<td width="50%"></td>
					<td width="50%"></td>
					</tr>
					<tr>
					<td width="50%"></td>
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
			
		return $output;
			}
		}
	}
	
	 if(isset($_POST["create_pdf"]))  
 {  
		$inre =$_POST['inre'];
		$exyear1 =$_POST['exyear1'];
		$exyear2 =$_POST['exyear2'];
		$acyr1 =$_POST['acyr1'];
		$acyr2 =$_POST['acyr2'];
		$exmonth1 =$_POST['exmonth1'];
		$exmonth2 =$_POST['exmonth2'];
      require_once('tcpdf/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("Level 5 & 6 - Final Letter");  
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
      $content .= '';  
      $content .= fetch_data();  
      $content .= '';	  
      $obj_pdf->writeHTML($content);
      $obj_pdf->Output('level56letter.pdf', 'I');
 }
	
?>


<!DOCTYPE HTML>
<html>
<head> <title>Level 5 & 6 Final Letter-PDF</title>
<style type="text/css">
.form1{
	margin:35px 10px 10px 10px;
    width: 730px;
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
<h3 align="center" style="color:#C65353">Generate Statement Letter for Level 5 & 6 - Final</h3>
<br></div>
<div id="divform1">
	<form  class="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<label>Index No/Reg.No</label><input type="text" name="inre" placeholder="Type Index.." ><br><br>
			<label>Academic Years</label>&nbsp;&nbsp;<input type="text" name="acyr1" placeholder="Starting Year.." ><label> to </label><input type="text" name="acyr2" placeholder="Ending Year.." >
			<br><br>
			<label>Semester 01 Examination</label><br>
			<label>Year</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="exyear1" placeholder="Exam Year.." ><br><br>
			<label>Month </label>
			<select name="exmonth1" >
				<option value="" selected disabled>Select Month</option>
				<option value="January">January</option>
				<option value="February">February</option>
				<option value="March">March</option>
				<option value="April">April</option>
				<option value="May">May</option>
				<option value="June">June</option>
				<option value="July">July</option>
				<option value="August">August</option>
				<option value="September">September</option>
				<option value="October">October</option>
				<option value="November">November</option>
				<option value="December">December</option>
			</select><br><br>
			<label>Semester 02 Examination</label><br>
			<label>Year</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="exyear2" placeholder="Exam Year.." ><br><br>
			<label>Month </label>
			<select name="exmonth2" >
				<option value="" selected disabled>Select Month</option>
				<option value="January">January</option>
				<option value="February">February</option>
				<option value="March">March</option>
				<option value="April">April</option>
				<option value="May">May</option>
				<option value="June">June</option>
				<option value="July">July</option>
				<option value="August">August</option>
				<option value="September">September</option>
				<option value="October">October</option>
				<option value="November">November</option>
				<option value="December">December</option>
			</select><br><br>
					<?php
						  
                     echo fetch_data(); 					 
                     ?>
			<br><br>
			<input type="submit" name="create_pdf" class="btn btn-danger" value="Generate Report in PDF" />    
			</form>
	</div>
</body>
</html> 
