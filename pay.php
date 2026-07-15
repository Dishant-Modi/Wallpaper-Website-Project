<?php
include("payme.php");

$fname = $_POST['fname'] ?? '';
$email = $_POST['email'] ?? '';
$cname = $_POST['cname'] ?? '';
$address = $_POST['address'] ?? '';
$cnumber = $_POST['cnumber'] ?? '';
$city = $_POST['city'] ?? '';
$exp = $_POST['exp'] ?? '';
$state = $_POST['state'] ?? '';
$zipcode = $_POST['zipcode'] ?? '';
$year = $_POST['year'] ?? '';
$cvv = $_POST['cvv'] ?? '';

$stmt = $mysqli->prepare("INSERT INTO `payment` (`fname`, `email`, `cname`, `address`, `cnumber`, `city`, `exp`, `state`, `zipcode`, `year`, `cvv`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssssss", $fname, $email, $cname, $address, $cnumber, $city, $exp, $state, $zipcode, $year, $cvv);
if (!$stmt->execute()) {
    die("Couldn't enter data: " . $stmt->error);
}
$stmt->close();
header("location: thankyou.php");
$mysqli->close();
?>
