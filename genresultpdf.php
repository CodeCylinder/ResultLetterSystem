<?php
	function fetch_data()
	{
		$output='';
		$con = mysqli_connect("localhost","root","", "dbrms");
		if (isset($_POST['regindexno'])){
		$regindexno =$_POST['regindexno'];
		$semes =$_POST['semes'];
		$year =$_POST['year'];
		$query="SELECT * FROM tblexamresult WHERE IndexNo='$regindexno' OR RegNo='$regindexno' AND Semester='$semes' AND ExamYear='$year'";
		$result=mysqli_query($con,$query);
									
		if($row= mysqli_fetch_array($result))
		{		
			$output.='<h4 align="right">'.date("Y-m-d").'</h4>
				<h3 align="center"><u>To whom it may concern</u></h3>
				<br>
				<caption><h4><u>Student Information</u></h4></caption>
				<table>
					<tr>
						<th>Index No</th>
						<td><b>'.$row["IndexNo"].'</b></td>
					</tr>
					<tr>
						<th>Name</th>
						<td><b>'.$row["FullName"].'</b></td>
					</tr>
					<tr>
						<th>Registered No</th>
						<td><b>'.$row["RegNo"].'</b></td>
					</tr>
					<tr>
						<th>NIC No</th>
						<td><b>'.$row["NIC"].'</b></td>
					</tr>
					<tr>
						<th>Course</th>
						<td><b>'.$row["CourseName"].'</b></td>
					</tr>
					<tr>
						<th>Semester</th>
						<td><b>'.$row["Semester"].'</b></td>
					</tr>
					<tr>
						<th>Medium</th>
						<td><b>'.$row["ExamMedium"].'</b></td>
					</tr>
					</table>
					<caption><h4><u>Results Obtained</u></h4></caption>
					<table border="0" cellpadding="1">
					<tr>
						<th align="center" width="60%"><b>Subject</b></th>
						<th align="center" width="40%"><b>Result</b></th>
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
						<td>'.$row["Result3"].'</td>
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
					<caption><h4><u>Qualification Status</u></h4></caption>
					<table>
					<tr>
						<th>Final Result</th>
						<td><b>'.$row["FinalResult"].'</b></td>
					</tr>
					</table>
		';
		return $output;
		}
	}
	}
	 if(isset($_POST["create_pdf"]))  
 {  
		$regindexno =$_POST['regindexno'];
		$semes =$_POST['semes'];
		$year =$_POST['year'];
      require_once('tcpdf/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("Result Sheet");  
      $obj_pdf->SetHeaderData(PDF_HEADER_LOGO, 18, 5, PDF_HEADER_LOGO_WIDTH, array(0,0,0), array(255,255,255),'', 'JPEG', '', 'N', false, 300, 'R', false, false, 0, false, false, false);
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');
	 // html_content = ("<h6><i>This is a System Generated Document and does not carry a signature</i></h6>". date("dS M Y H:i") );  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	  $obj_pdf->SetFooterData(array(0,0,0), array(0,0,0));
	  $obj_pdf->SetY(-5);	  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '9', PDF_MARGIN_RIGHT, PDF_MARGIN_TOP);  
      $obj_pdf->setPrintHeader(true);  
      $obj_pdf->setPrintFooter(true);  
      $obj_pdf->SetAutoPageBreak(TRUE, 1);  
      $obj_pdf->SetFont('helvetica', '', 12);  
      $obj_pdf->AddPage();
      $content = '';  
      $content .= ' 
      <table border="0" cellspacing="0" cellpadding="0">';  
      $content .= fetch_data();  
      $content .= '</table>' ;	  
      $obj_pdf->writeHTML($content);
	  $obj_pdf->Output('result.pdf', 'I');
 }
	
?>


<!DOCTYPE HTML>
<html>
<head> <title>Result Sheet-Individual-PDF</title>
<style type="text/css">
.form1{
	margin:35px 10px 10px 10px;
    width: 600px;
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
    display: inline-block;
	width:200;
	height:10;
    color: #C65353;
    padding: 8px 18px;
    text-decoration: none;
    font: 16px Arial, Helvetica, sans-serif;
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
<h3 align="center" style="color:#C65353"><p>Generate Individual Result Sheet</p><p>based on NIC Number or Exam Index Number</p></h3>
<br></div>
<div id="divform1" >
	<form  class="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<br>
				<label>Index No</label>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="regindexno" placeholder="Type here..."><br><br>
				<label>Exam Year</label><input type="text" name="year" placeholder="Type Year.." ><br><br>
				<label>Semester</label>&nbsp;&nbsp;&nbsp;&nbsp;
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
                <input type="submit" name="create_pdf" class="btn btn-danger" value="Generate Result in PDF" />    
	</form>
									<?php
						  
                     echo fetch_data(); 					 
                     ?>
	</div>
</body>
</html> 
