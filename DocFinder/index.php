<?php
// Initialize the session
session_start();
 $_SESSION["loggedin"] = false;
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcomepage.php");
    exit;
}
 
// Include config file
require_once "configdatabase.php";
 
// Define variables and initialize with empty values
$username = $password = "";
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
        $password = $_POST["password"];
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT `username`,`password` FROM `user_accounts` WHERE `username`='$username'";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $username = $row["username"];
                        $hashed_password = $row["password"];
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            $password_err = "fuck password you entered was not valid.";
                            header("location: welcomepage.php");
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
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
}
?>


<html>
   
   <head>
      <title>Login Page</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
        
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	
      <div align = "center"> 
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
               
               <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "post">
                  <label>Username  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = "Log In"/><br />
               </form>
               
               <a href="forgotpassword.php">Forgot Password?</a>
                
					
            </div>
             <span class="help-block"><?php echo $password_err; ?></span>
             <span class="help-block"><?php echo $username_err; ?></span>
             <div style = "width:300px; border: solid 1px #333333; " align = "center">
                 
                 <form action="signup.php">
         <button type="submit">Sign Up</button>
      </form>
          
          </div>
				
         </div>
          
			
      </div>

   </body>
</html>

