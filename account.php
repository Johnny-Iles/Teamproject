<?php
// Initialize the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Account</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/site.css">
</head>
<body>
<?php require 'includes/header.php' ?>
    <div class="main-container">
        <h1>Hi, <?php echo htmlspecialchars($_SESSION["username"]); ?></h1>
        <p>
            <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
            <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
        </p>
    </div>
<?php require 'includes/footer.php' ?> 
</body>
</html>