<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $mobile = $_POST['mobile'];
    $country = $_POST['country'];

    if ($password !== $confirm_password) {
        echo "<div class='w3-panel w3-red w3-round'>Passwords do not match.</div>";
    } else {
        $check = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $check->bind_param("s", $username);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            echo "<div class='w3-panel w3-red w3-round'>Username already exists.</div>";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, password, email, gender, mobile, country) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $username, $hashed_password, $email, $gender, $mobile, $country);

            if ($stmt->execute()) {
                header("Location: login.php");
                exit;
            } else {
                echo "<div class='w3-panel w3-red w3-round'>Error: " . $stmt->error . "</div>";
            }
        }
    }
}
?>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<div class="w3-container w3-card w3-light-grey w3-margin">
  <h2>Sign Up</h2>
  <form method="POST" class="w3-container">
    <label class="w3-text-blue">Username</label>
    <input class="w3-input w3-border" type="text" name="username" required>

    <label class="w3-text-blue">Email</label>
    <input class="w3-input w3-border" type="email" name="email" required>

    <label class="w3-text-blue">Gender</label>
    <select class="w3-select w3-border" name="gender" required>
      <option value="" disabled selected>Choose your gender</option>
      <option value="Male">Male</option>
      <option value="Female">Female</option>
      <option value="Other">Other</option>
    </select>

    <label class="w3-text-blue">Mobile</label>
    <input class="w3-input w3-border" type="text" name="mobile" required>

    <label class="w3-text-blue">Country</label>
    <input class="w3-input w3-border" type="text" name="country" required>

    <label class="w3-text-blue">Password</label>
    <input class="w3-input w3-border" type="password" name="password" required>

    <label class="w3-text-blue">Confirm Password</label>
    <input class="w3-input w3-border" type="password" name="confirm_password" required>

    <button class="w3-button w3-blue w3-margin-top" type="submit">Sign Up</button>
  </form>
</div>
<div class="w3-container w3-margin-top">
  <p>Already have an account? <a href="login.php" class="w3-text-blue">Click here to log in</a></p>
</div>

