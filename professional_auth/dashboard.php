<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include_once 'includes/header.php'; 
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Dashboard</h3>
                </div>
                <div class="card-body">
                    <h4 class="text-center">Welcome, <?php echo $_SESSION['user_name']; ?>!</h4>
                    <p class="text-center">Your User ID is: <?php echo $_SESSION['user_id']; ?></p>
                    <div class="d-grid mt-4">
                        <a href="logout.php" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'includes/footer.php'; ?>