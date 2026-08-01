<?php
// Start session
session_start();

// Database connection
$server = "localhost";
$username = "root";
$password = "";
$database = "e_commerse";

$conn = new mysqli($server, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and retrieve user input
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Fetch user credentials from the database
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($user_id, $hashed_password);
    $stmt->fetch();

    if ($user_id && password_verify($password, $hashed_password)) {
        // Login successful: set session variables
        $_SESSION['isLoggedIn'] = true;
        $_SESSION['username'] = $username; // Store username

        // Redirect to the dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        // Login failed
        echo "<script>alert('Invalid username or password!'); window.location.href = 'index.html';</script>";
    }
// Add this to your login validation script
$_SESSION['last_activity'] = time(); // Update the timestamp on user activity
$timeout_duration = 1800; // 30 minutes
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
    session_unset();
    session_destroy();
    header("Location: index.html");
    exit();
}

    $stmt->close();
}

$conn->close();
?>
