<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "e_commerse";


    $conn = new mysqli($servername, $username, $password, $dbname);

 
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        $successMessage = "Thank you for contacting us, $name. We will get back to you shortly.";
        header("Location: contact.php?message=" . urlencode($successMessage));
        exit();
    } else {
        $errorMessage = "An error occurred while sending your message. Please try again.";
        header("Location: contact.php?message=" . urlencode($errorMessage));
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
