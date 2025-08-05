<?php
$fName = $_POST["fName"];
$lName = $_POST["lName"];
$email = $_POST["email"];
$password = $_POST["password"];

$conn = new mysqli('localhost','root', '', 'account system');
if($conn->connect_error){
    header("Location: index.html?register_error=connection_failed");
    exit;
}

// Check if email already exists
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Email already exists
    header("Location: index.html?register_error=email_taken");
    exit;
} else {
    // Email is available, proceed with registration

    $stmt = $conn->prepare("INSERT INTO users (fName, lName, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss",$fName, $lName, $email, $password);
    
    if($stmt->execute()){
        header("Location: index.html?register_success=true");
        exit;
    } else{
        header("Location: index.html?register_error=insert_failed");
        exit;
    }
}

$stmt->close();
$conn->close();
?>
