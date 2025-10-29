<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT username, email, gender, mobile, country FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email, $gender, $mobile, $country);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>User Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        <h3>Hello, <?php echo htmlspecialchars($username); ?>!</h3>
      </div>
      <div class="card-body">
        <p><strong>Your Email:</strong> <?php echo htmlspecialchars($email); ?></p>
        <p><strong>Your Gender:</strong> <?php echo htmlspecialchars($gender); ?></p>
        <p><strong>Your Mobile:</strong> <?php echo htmlspecialchars($mobile); ?></p>
        <p><strong>Your Country:</strong> <?php echo htmlspecialchars($country); ?></p>
        <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
      </div>
    </div>
  </div>
</body>
</html>
