<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            header("Location: profile.php");
        } else {
            echo "<div class='w3-panel w3-red w3-round'>Invalid password.</div>";
        }
    } else {
        echo "<div class='w3-panel w3-red w3-round'>User not found.</div>";
    }
}
?>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<div class="w3-container w3-card w3-light-grey w3-margin">
  <h2>Login</h2>
  <form method="POST" class="w3-container">
    <label class="w3-text-blue">Username</label>
    <input class="w3-input w3-border" type="text" name="username" required>
    <label class="w3-text-blue">Password</label>
    <input class="w3-input w3-border" type="password" name="password" required>
    <button class="w3-button w3-blue w3-margin-top" type="submit">Login</button>
  </form>
</div>
<!-- Add this below the login form -->
<p class="w3-margin-top">Don't have an account? <a href="signup.php">Sign up here</a></p>

