<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signIn'])) {
    // Get form data
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'account system');
    
    // Check connection
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }
    
    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, fName, lName, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        // Verify password (assuming passwords are hashed)
        if (password_verify($password, $user['password'])) {
            // Login successful
            // Start session and store user data
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['fName'] . ' ' . $user['lName'];
            $_SESSION['user_email'] = $user['email'];
            
            // Redirect to dashboard
            header("Location: dashboard.php");
            exit;
        } else {
            // Check if password is stored without hashing (for backward compatibility)
            if ($password == $user['password']) {
                // Login successful but password is not hashed
                // Start session and store user data
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['fName'] . ' ' . $user['lName'];
                $_SESSION['user_email'] = $user['email'];
                
                // Redirect to dashboard
                header("Location: dashboard.php");
                exit;
            } else {
                // Incorrect password
                header("Location: index.html?error=invalid_password");
                exit;
            }
        }
    } else {
        // User not found
        header("Location: index.html?error=user_not_found");
        exit;
    }
    
    $stmt->close();
    $conn->close();
} else {
    // Redirect to the form if accessed directly
    header("Location: index.html");
    exit;
}
?>
