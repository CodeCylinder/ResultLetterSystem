<?php
	function fetch_data()
	{
		$output='';
		$con = mysqli_connect("localhost","root","", "dbrms");
		if (isset($_POST['regindexno'])){
		$year =$_POST['year'];
		$regindexno=$_POST['regindexno'];
		$query="SELECT * FROM tblexamresult WHERE IndexNo='$regindexno' OR RegNo='$regindexno' AND ExamYear='$year'";
		$result=mysqli_query($con,$query);
									
		if($row= mysqli_fetch_array($result))
		{		
			$output.='<h4 align="right">'.date("Y-m-d").'</h4>
					<h3 align="center"><u>STATEMENT OF RESULTS</u></h3>
					<p align="justify">This is to certify that <b>Ms./Mr. ' .$row["InitName"].'</b> has appeared for the Final Examination conducted by the Department of Technical Education & Training
						in<b> December '.$row["ExamYear"].'</b> under the<b> Index No ' .$row["IndexNo"].'</b> having followed the <b>Six-Month, Full Time, '.$row["CourseName"].' in '.$row["ExamMedium"].'
						 Medium</b> and has obtained the results indicated against the following subjects</p>
					<table border="0" cellpadding="2">
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
					<br><br>
					<table>
					<tr>
						<th>Final Result :</th>
						<td><b>'.$row["FinalResult"].'</b></td>
					</tr>
					</table>
					<br><br><br>
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
      	$regindexno =$_POST['regindexno'];
		$year =$_POST['year'];
	  require_once('tcpdf/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("Final Exam-Six-Month");  
      $obj_pdf->SetHeaderData(PDF_HEADER_LOGO, 18, 5, PDF_HEADER_LOGO_WIDTH, array(0,0,0), array(255,255,255),'', 'JPEG', '', 'N', false, 300, 'R', false, false, 0, false, false, false);
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');
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
      <table border="0" cellspacing="0" cellpadding="0">';  
      $content .= fetch_data();  
      $content .= '</table>' ;	  
      $obj_pdf->writeHTML($content);
	  $obj_pdf->Output('finalsixmonth.pdf', 'I');
 }
	
?>


<!DOCTYPE HTML>
<html>
<head> <title>Statement of Result</title>
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
<h3 align="center" style="color:#C65353"><p>Generate Final Statement of Result</p><p>for Six-Month Courses</p></h3>
<br></div>
<div id="divform1" >
	<form  class="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<br>
				<label>Index No/Reg.No</label><input type="text" name="regindexno" placeholder="Type here..."><br><br>
				<label>Exam Year</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="year" placeholder="Type Year.." ><br><br>
				
                <input type="submit" name="create_pdf" class="btn btn-danger" value="Generate Result in PDF" />    
	</form>
									<?php
						  
                     echo fetch_data(); 					 
                     ?>
	</div>
</body>
</html> 
