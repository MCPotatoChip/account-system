<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1 class="form-title">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
        
        <div class="user-info">
            <h2>User Information</h2>
            <p><i class="fas fa-user"></i> Name: <?php echo htmlspecialchars($_SESSION['user_name']); ?></p>
            <p><i class="fas fa-envelope"></i> Email: <?php echo htmlspecialchars($_SESSION['user_email']); ?></p>
        </div>
        
        <form method="post" action="logout.php" style="margin-top: 2rem;">
            <input type="submit" class="btn" value="Log Out" name="logout">
        </form>
    </div>
</body>
</html>
