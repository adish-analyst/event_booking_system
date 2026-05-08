<?php
session_start();
include 'db.php';
include 'includes/header.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM events WHERE id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if($row['seats'] > 0){

    $newSeats = $row['seats'] - 1;
    mysqli_query($conn, "UPDATE events SET seats=$newSeats WHERE id=$id");

    $user = $_SESSION['user'];
    mysqli_query($conn, "INSERT INTO bookings (event_id, name) VALUES ($id, '$user')");

    echo "
    <div class='success-box'>
        <h2>🎉 Booking Successful!</h2>
        <p>You have successfully booked <b>".$row['title']."</b></p>
        <a href='index.php' class='btn'>Go Back</a>
    </div>
    ";

} else {

    echo "
    <div class='error-box'>
        <h2>❌ No Seats Available</h2>
        <a href='index.php' class='btn'>Go Back</a>
    </div>
    ";
}

include 'includes/footer.php';
?>