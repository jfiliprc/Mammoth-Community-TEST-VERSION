<?php
session_start();
require_once 'conn/Database.php';

if (isset($_SESSION['user_id'])) {
    $userID = $_SESSION['user_id'];

    // Check if a file was uploaded
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['profile_picture']['name']);

        // Move the uploaded file to the desired location
        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $uploadFile)) {
            // Update the user's profile picture path in the database
            $stmt = $pdo->prepare("UPDATE users SET avatar = :avatar WHERE id = :user_id");
            $stmt->bindValue(':avatar', $uploadFile);
            $stmt->bindValue(':user_id', $userID);
            $stmt->execute();

            // Redirect back to the user's profile page
            header("Location: user-profile.php");
            exit();
        } else {
            echo "Failed to upload the file.";
        }
    } else {
        echo "No file uploaded or an error occurred.";
    }
} else {
    echo "Please log in to upload a profile picture.";
}
?>
