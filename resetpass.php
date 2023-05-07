<?php
// Initialize the session
session_start();
 
//Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE tblusers SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
        body{
			margin:8px 3px 3px 3px;
			font: 14px sans-serif;
			font-color:#FFFFFF;
			//background:#EFEFEF;
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
			width: 400px; 
			padding: 10px;
			background-color:#C65353;
			border-radius: 20px;
			background-position: center;
			}
			
		input[type=text] {
			display: inline;
			float: right;
			width: 60%;
			background-color: #FFFFFF;
			color: #C65353;
			}
			
		input[type=password] {
			display: inline;
			float: right;
			width: 60%;
			background-color: #FFFFFF;
			color: #C65353;
			}
		
		input[type=submit] {
			width: 100%;
			background-color: #f7f2b4;
			color: #C65353;
			font-weight:bold;
			padding: 8px 10px;
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

		input[type=reset] {
			width: 30%;
			float: left;
			background-color: #f7f2b4;
			color: #C65353;
			font-weight:bold;
			padding: 8px 10px;
			margin: 8px 0;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}

		input[type=reset]:hover {
			background-color: #f7f09e;
			color: #C65353;
			font-weight:bold;

		}

			h1 { 
				display: block;
				font-size: 2.5em;
				font-weight: bold;
			}
			
			h3 {
				font-family:Calibri;				
				display: block;
				font-weight: bold;
				color:#FFFFFF;
			}
			
			label {
				font-family: Tahoma;
				font-size: 18px;
				color:#FFFFFF;
				}
			p {
				font-family: Tahoma;
				font-size: 15px;
				color: #FFFFFF;
				align-text:left;
			}
			
			a{
				font-family: Tahoma;
				font-size: 16px;
				color: #f7f2b4;
				font-weight: bold;
				align-text:left;
			}
			
    </style>
</head>
<body>
<br>
<h1 style="color:#C65353; font-family:pristina; text-align:center "> Sri Lanka College of Technology, Colombo 10</h1>
<h2 style="color:#C65353; font-family:Helvetica; text-align:center" > Student Results Management System</h2>
<br>
    <div class="wrapper">
        <h3>Reset Password</h3>
		<hr>
        <p>Please fill out this form to reset your password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a href="login.php">Cancel</a>
            </div>
        </form>
    </div>    
</body>
</html>