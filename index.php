<?php
session_start();
include "db.php";
include "includes/header.php";

$sql = "SELECT * FROM events";
$result = mysqli_query($conn, $sql);
?>

<h2>Available Events 🎉</h2>

<?php

while($row = mysqli_fetch_assoc($result)){

    echo "
    <div class='card'>

        <h3>🎊 ".$row['title']."</h3>

        <p>📅 Date:
        ".$row['date']."</p>

        <p>🎟 Seats:
        ".$row['seats']."</p>

        <a href='book.php?id=".$row['id']."'
        class='btn'>
        Book Now
        </a>

    </div>
    ";
}

include "includes/footer.php";
?>