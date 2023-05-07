<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $usertype ="";
$username_err = $password_err = $confirm_password_err = $usertype_err ="";
$param_password = $param_usertype = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM tblusers WHERE username = ? ";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
			
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
	
	// Validate user role
    if(empty(trim($_POST["usertype"]))){
        $usertype_err = "Please select a user role.";     
    } else{
        $usertype = trim($_POST["usertype"]);
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($usertype_err)){
                    // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_usertype = $usertype;
			
        // Prepare an insert statement
        $sql = "INSERT INTO tblusers (username, password, usertype) VALUES ('$param_username', '$param_password', '$param_usertype')";
         
        if($stmt = mysqli_query($link, $sql)){
            // Bind variables to the prepared statement as parameters
           /// mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password, $param_usertype) ;
			
            // Attempt to execute the prepared statement
            //if($stmt){
                // Redirect to login page
				//header("location: login.php");
				echo "<script language='javascript'>";
				echo "alert('New User Created Successfully');";
				echo "window.opener.location.reload();";
				echo "close();";
				echo "</script>";
            } else{
				die (mysqli_error($link));
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        //mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
        body{
			margin:8px 3px 3px 3px;
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
			width: 500px; 
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
			
			h2 { 
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
				font-size: 15px;
				color: #f7f09e;
				font-weight: bold;
				align-text:left;
			}
			
    </style>
</head>
<body>
<br>
<h2 style="color:#C65353; font-family:pristina;" align="center"> Sri Lanka College of Technology, Colombo 10</h2>
<h1 style="color:#C65353; font-family:Ubuntu-Regular;" align="center" > Student Results Management System</h1>
<br>
    <div class="wrapper">
        <h3>Sign Up New User</h3>
		<hr>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block" style="color:#111788"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block" style="color:#111788"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block" style="color:#111788"><?php echo $confirm_password_err; ?></span>
            </div>
			<div class="form-group <?php echo (!empty($usertype_err)) ? 'has-error' : ''; ?>">
                <label>User Role</label>
				<select name="usertype">
					<option selected></option>
					<option value="admin">Admin</option>
					<option value="user">User</option>
				</select>
                <span class="help-block" style="color:#111788"><?php echo $usertype_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-primary" value="Reset">
            </div>
			<br>
			<br>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;Already have an account? <a href="login.php">Login here</a></p>
        </form>
    </div>    
</body>
</html>