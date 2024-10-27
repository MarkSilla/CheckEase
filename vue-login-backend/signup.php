<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
require 'db.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, username, email, dob, gender, contact, password, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt->execute([$firstname, $lastname, $username, $email, $dob, $gender, $contact, $hashedPassword, $role])) {
      
        echo json_encode(["success" => true, "message" => "Registration successful!"]);
    } else {
        
        echo json_encode(["success" => false, "message" => "Registration failed. Please try again."]);
    }
} else {
   
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
