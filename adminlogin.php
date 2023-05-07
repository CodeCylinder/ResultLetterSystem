<!DOCTYPE HTML>
<html> 
<head> 
<title>Admin Log in</title> 
    <style type="text/css">
        body{
			font: 14px sans-serif;
			font-color:#FFFFFF;
			background:#EFEFEF;
			background-image:url("images/cotmaradana3.png") ;
			 background-repeat: no-repeat;
				background-position: center;
				background-size: 100% 100%;
				background-attachment: fixed;
			}
		* {
			margin: auto; 
			padding: 1px; 
			box-sizing: border-box;
			}
			
        .wrapper{
			width: 500px; padding: 20px;
			background-color:#C65353;
			border-radius: 30px;
			background-position: center;
			}
			
		input[type=text] {
			width: 60%;
			background-color: #FFFFFF;
			color: #C65353;
			}
			
		input[type=password] {
			width: 60%;
			background-color: #FFFFFF;
			color: #C65353;
			}
		
		input[type=submit] {
			width: 100%;
			background-color: #f7f2b4;
			color: #C65353;
			font-weight:bold;
			font-size:18px;
			padding: 14px 20px;
			margin: 8px 0;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}

		input[type=submit]:hover {
			background-color: #f7f09e;
			color: #C65353;
			font-weight:bold;

		}


			h1 { 
				display: block;
				font-size: 2.5em;
				font-weight: bold;
			}
			
			h2 { 
				display: block;
				font-size: 1.9em;
				font-weight: bold;
			}
			
			label {
				font-family: Tahoma;
				font-size: 18px;
				color:#FFFFFF;
				}
			p {
				font-family: Tahoma;
				font-size: 16px;
				color: #FFFFFF;
			}
			
			a{
				font-family: Tahoma;
				font-size: 15px;
				color: #f7f09e;
				font-weight: bold;
				align-text:left;
			}
			
    </style>
</head>
<body id="body-color">
<script type="text/javascript">
function check(form)//function to check userid & password
{
var un = document.myform.user.value;
var pw = document.myform.pass.value;

var valid = false;
var unArray = ["admin"];  // as many as you like - no comma after final entry
var pwArray = ["admin"];  // the corresponding passwords;
for (var i=0; i <unArray.length; i++) {
if ((un == unArray[i]) && (pw == pwArray[i])) {
valid = true;
break;
}
}
if (valid) {
window.open ("signup.php","signup new user","menubar=1,resizable=1,width=750,height=750");
return false;
}

 else
 {
   alert("Error Username or Password..")   //displays error message
  }
}
</script>
<br><br><br><br><br>
<h1 style="color:#C65353; font-family:pristina; text-align:center "> Sri Lanka College of Technology, Colombo 10</h1><br>
<h2 style="color:#C65353; font-family:Helvetica; text-align:center" > Student Results Management System</h2>
<br><br><br>
 

<div id="Sign-In" class="wrapper">
<h2 style="color:#FFFFFF; font-family:calibri;"><center>Admin Log in</center></h2>
		<hr>

<fieldset style="width:80%; border:0">
<br>
<br>
<form name="myform" method="POST" action="">
<label>Username</label>
<input type="text" name="user" size="40">
<br><br>
<label>Password </label>
<input type="password" name="pass" size="40">
<br><br><br>
<input id="button" type="submit" name="submit" value="Log-In" onclick="check(this.form)">
<br>
<br>
</form>
<a href="login.php">Back to User Log in</a>
</fieldset>
</div>
</body>
</html> 

