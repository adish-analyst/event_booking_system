<?php
session_start();
include "db.php";
include "includes/header.php";

$error = "";
$success = "";

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if($password != $confirm){

        $error = "Passwords do not match!";

    } else {

        $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

        if(mysqli_num_rows($check) > 0){

            $error = "Email already registered!";

        } else {

            mysqli_query($conn,
            "INSERT INTO users(name,email,password)
            VALUES('$name','$email','$password')");

            $success = "✅ Registration Completed Successfully! Redirecting to Login...";

header("refresh:2;url=login.php");
        }
    }
}
?>

<div class="auth-container">

<h2>Create Account ✨</h2>

<?php
if($error){
    echo "<p style='color:red;'>$error</p>";
}

if($success){
    echo "<p style='color:green;'>$success</p>";
}
?>

<form method="POST" class="auth-form">

<input type="text"
name="name"
placeholder="👤 Full Name"
required>

<input type="email"
name="email"
placeholder="📧 Email"
required>

<input type="password"
name="password"
placeholder="🔒 Password"
required>

<input type="password"
name="confirm_password"
placeholder="🔐 Confirm Password"
required>

<button type="submit" name="register">
Register
</button>

</form>

<p style="margin-top:15px;">
Already have account?
<a href="/my_web/login.php">Login</a>
</p>

</div>

<?php include "includes/footer.php"; ?>