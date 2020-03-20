<?php
// Include config file
require_once "includes/config.php";
 
// Define variables and initialize with empty values


$password = "";
$confirm_password = "";
$category = "";
$businessname = "";
$managername = "";
$addressline1 = "";
$addressline2 = "";
$postcode = "";
$menuid = 0;
$businessname_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["businessname"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM Businesses WHERE Business_ID = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_businessname);
            
            // Set parameters
            $param_businessname = trim($_POST["businessname"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $businessname_err = "This username is already taken.";
                } else{
                    $businessname = trim($_POST["businessname"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
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

    $businessname = $_POST["businessname"];
    $category = $_POST["category"];
	$managername = $_POST["managername"];
	$addressline1 = $_POST["addressline1"];
	$addressline2 = $_POST["addressline2"];
	$postcode = $_POST["postcode"];
	// Might delete later
	$menuid = $_POST["menuid"];
    
    // Check input errors before inserting in database
    if(empty($businessname_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO Businesses (Password, Category,Name, Manager_Name, Address1, Address2, Postcode, Menu_ID) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){

            
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssss",  $param_password, $param_category, $param_businessname, $param_managername, $param_address1, $param_address2, $param_postcode, $param_menu_ID);
            
            // Set parameters
            $param_businessname = $businessname;
			$param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
			$param_category = $category;
			$param_managername = $managername;
			$param_addressline1 = $addressline1;
			$param_addressline2 = $addressline2;
			$param_postcode = $postcode;
            
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/site.css">
</head>
<body>
<?php require 'includes/header.php' ?>    
    <div class="form-wrapper">
        <h2 style="text-align: center;">Sign Up</h2>
        <p style="text-align: center;">Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Business Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $businessname; ?>">
                <span class="help-block"><?php echo $businessname_err; ?></span>
            </div>  
            <div class="form-group <?php echo (!empty($businessname_err)) ? 'has-error' : ''; ?>">
                <label>Food Category</label>
                <input type="text" name="category" class="form-control" value="<?php echo $category; ?>">
				<span class="help-block"><?php echo $businessname_err; ?></span>
            </div>  
            <div class="form-group <?php echo (!empty($businessname_err)) ? 'has-error' : ''; ?>">
                <label>Manager Name</label>
                <input type="text" name="managername" class="form-control" value="<?php echo $managername; ?>">
                <span class="help-block"><?php echo $businessname_err; ?></span>
            </div>   
            <div class="form-group <?php echo (!empty($businessname_err)) ? 'has-error' : ''; ?>">
                <label>Address1</label>
                <input type="text" name="address1" class="form-control" value="<?php echo $businessname; ?>">
                <span class="help-block"><?php echo $businessname_err; ?></span>
            </div>    
			<div class="form-group <?php echo (!empty($businessname_err)) ? 'has-error' : ''; ?>">
                <label>Address2</label>
                <input type="text" name="address2" class="form-control" value="<?php echo $businessname; ?>">
                <span class="help-block"><?php echo $businessname_err; ?></span>
            </div> 
			<div class="form-group <?php echo (!empty($businessname_err)) ? 'has-error' : ''; ?>">
                <label>Postcode</label>
                <input type="text" name="postcode" class="form-control" value="<?php echo $businessname; ?>">
                <span class="help-block"><?php echo $businessname_err; ?></span>
            </div> 
			<div class="form-group <?php echo (!empty($businessname_err)) ? 'has-error' : ''; ?>">
                <label>Menu ID</label>
                <input type="text" name="Menu_ID" class="form-control" value="<?php echo $businessname; ?>">
                <span class="help-block"><?php echo $businessname_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
<?php require 'includes/footer.php' ?>    
</body>
</html>