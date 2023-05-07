<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: homepage.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $usertype = "";
$username_err = $password_err = "";

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password, usertype FROM tblusers WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $usertype);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            $_SESSION["usertype"] = $usertype;
                            // Redirect user to welcome page
                            header("location: homepage.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
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
    <title>User Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style type="text/css">
        body{
			font: 14px sans-serif;
			font-color:#FFFFFF;
			background:#EFEFEF;
			 background-image:url("images/cotmaradana13.jpg"), url("images/cotmaradananew.jpg") ;
			 background-repeat: no-repeat;
				background-position: left, right;
				background-size: 50% 100%, 50% 100%;
				background-attachment: fixed;
				
			}
		* {
			margin: auto; 
			padding: 1px; 
			box-sizing: border-box;
			}
			
        .wrapper{
			width: 400px; padding: 20px;
			background-color:#C65353;
			border-radius: 30px;
			background-position: center;
			}
			
		input[type=submit] {
			width: 100%;
			background-color: #f7f2b4;
			color: #C65353;
			font-size:18px;
			font-weight:bold;
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
				color: #FFFFFF;
			}
			help-block{
				color:#FFFFFF;
			}
			
			
    </style>
</head>
<body>
<br>
<h1 style="color:#FFFFFF; font-family:pristina; text-align:center "> Sri Lanka College of Technology, Colombo 10</h1>
<h2 style="color:#FFFFFF; font-family:Helvetica; text-align:center" > Printing Confirmation of Results for Students</h2>
<br><br>
    <div class="wrapper">
        <h3 style="color:#FFFFFF">User Log in</h3><hr>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>" >
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block" style="color:#FFFFFF;"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block" style="color:#FFFFFF"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Log-in">
            </div>
            <a href="adminlogin.php" target="">Create a New User </a>
        </form>
    </div>    
</body>
</html>