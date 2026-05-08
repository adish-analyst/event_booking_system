<?php
session_start();
include "db.php";
include "includes/header.php";

$error = "";
$success = "";

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users
            WHERE email='$email'
            AND password='$password'";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_assoc($result);

        $_SESSION['user'] = $row['name'];

        $success = "✅ Login Successful!";

        header("refresh:2;url=index.php");

    } else {

        $error = "❌ Invalid Email or Password!";
    }
}
?>

<div class="auth-container">

<h2>Welcome Back 👋</h2>

<?php
if($error){
    echo "<p style='color:red;'>$error</p>";
}

if($success){
    echo "<p style='color:lightgreen;'>$success</p>";
}
?>

<form method="POST" class="auth-form">

<input type="email"
name="email"
placeholder="📧 Email"
required>

<input type="password"
name="password"
placeholder="🔒 Password"
required>

<button type="submit" name="login">
Login
</button>

</form>

<p>
New user?
<a href="/my_web/register.php">Create account</a>
</p>

</div>

<?php include "includes/footer.php"; ?>