<?php
include("contact.php");

$firstname = $_POST['firstname'] ?? '';
$lastname = $_POST['lastname'] ?? '';
$phone = $_POST['phone'] ?? '';
$email = $_POST['email'] ?? '';
$messages = $_POST['messages'] ?? '';

$stmt = $mysqli->prepare("INSERT INTO `contact-data` (`firstname`, `lastname`, `phone`, `email`, `messages`) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $firstname, $lastname, $phone, $email, $messages);
if (!$stmt->execute()) {
    die("Couldn't enter data: " . $stmt->error);
}
$stmt->close();
header("location: home.php");
$mysqli->close();
?>
